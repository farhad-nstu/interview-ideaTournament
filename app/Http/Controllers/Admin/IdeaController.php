<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function index()
    {
    	$ideas = Idea::all();
    	return view('admin.ideas.index', compact('ideas'));
    }

    public function create()
    {
    	$data = null;
    	return view('admin.ideas.create', compact('data'));
    }

    public function edit($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id ){ exit('Bad Request!'); }

        $data = Idea::find($id);
        return view('admin.ideas.create', compact('data'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
         'name'=>'required|max:8',
         'email'=>'required',
         'idea' => 'required',
      ]);

      if($request->id) {
      	$idea = Idea::find($request->id);
      } else {
      	$idea = new Idea;
      }
    	$idea->name = $request->name;
    	$idea->email = $request->email;
    	$idea->status = $request->status;
    	$idea->idea = $request->idea;
    	$idea->save();
    	return redirect('admin/ideas');
    }
}
