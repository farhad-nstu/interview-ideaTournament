<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;
use App\Models\Tournament;
use Session;
use Mail;
use App\Mail\WinnerMail;

class HomeController extends Controller
{
    public function fetch_users()
    {
    	$users = User::all();
    	return view('front.allUser', compact('users'));
    }

    public function fetch_ideas()
    {
    	$ideas = Idea::with('user')->get();
    	return view('front.allIdea', compact('ideas'));
    }

    public function count_idea()
    {
    	$ideas = Idea::where('is_used', 0)->limit(8)->get()->unique('name');
    	if(count($ideas) >= 8) {
    		$tournament = new Tournament;
    		$tournament->title = "t1";
    		$tournament->phase = "first phase";
    		$tournament->start_time = date('Y-m-d H:i:s');
    		$rand_keys = array_rand($ideas->toArray(), 4);
    		$firstPhaseUSers = [];
    		for($i = 0; $i < count($rand_keys); $i++) {
    			$user_id = $ideas[$rand_keys[$i]]->user_id;
    			array_push($firstPhaseUSers, $user_id);
    		}
    		$tournament->first_winners = json_encode($firstPhaseUSers);
    		$tournament->save();
    		Session::push('s_tournaments.t_id', $tournament->id);
    		return true;
    	}
    }

    public function check_second_five_minute()
    {
    	$tournaments = Session::get('s_tournaments');
    	if(!empty($tournaments)) {
    		for ($i=0; $i < count($tournaments['t_id']); $i++) { 
    			$tournament = Tournament::where(['status' => 0, 'phase' => 'first phase', 'id' => $tournaments['t_id'][$i]])->first();
    			if($tournament) {
    				$tournament->phase = "second phase";
    				$firstWinners = json_decode($tournament->first_winners);
    				$rand_winners = array_rand($firstWinners, 2);

    				$secondPhaseUSers = [];
    				for($i = 0; $i < count($rand_winners); $i++) {
    					array_push($secondPhaseUSers, $firstWinners[$rand_winners[$i]]);
    				}
    				
    				$tournament->second_winners = json_encode($secondPhaseUSers);
    				$tournament->update();
    				Session::push('f_tournaments.t_id', $tournament->id);
    				
    			}

    			// if($tournaments['t_id'][$i] == $tournament->id) {

    			// } else {
    			// 	Session::push('s_tournaments.t_id', $tournaments['t_id'][$i]);
    			// }
    		}
    	}

    	return true;
    }

    public function check_final_five_minute()
    {
    	$tournaments = Session::get('f_tournaments');

    	if(!empty($tournaments)) {
    		for ($i=0; $i < count($tournaments['t_id']); $i++) { 
    			$tournament = Tournament::where(['status' => 0, 'phase' => 'second phase', 'id' => $tournaments['t_id'][$i]])->first();
    			if($tournament) {
    				$tournament->phase = "final phase";
    				$secondWinners = json_decode($tournament->second_winners);
    				$final_winners = array_rand($secondWinners, 1);
    				$tournament->final_winners = $secondWinners[$final_winners];
    				$tournament->status = 1;
    				$tournament->update();

    				$user = User::find($secondWinners[$final_winners]);
    				Mail::to($user->email)->send(new WinnerMail($tournament));
    			}

    			// if($tournaments['t_id'][$i] == $tournament->id) {

    			// } else {
    			// 	Session::push('f_tournaments.t_id', $tournaments['t_id'][$i]);
    			// }

    		}
    	}

    	return true;

    }
}
