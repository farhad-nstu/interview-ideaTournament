<?php

namespace App\Repositories\admin;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\PricingRule;

class RuelsRepository
{
    public function index()
    {
    	$rules = PricingRule::orderBy('id', 'desc')->get();
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
    	$rule = "";
        return view('admin.rules.create', compact('rule'));
    }

    public function edit($id)
    {
    	$rule = PricingRule::find($id);
        return view('admin.rules.create', compact('rule'));
    }

    public function store($request)
    {
    	if($request->id) {
    		$rule = PricingRule::find($request->id);
    	} else {
    		$rule = new PricingRule;
    	}
    	
    	$rule->title = $request->title;
    	$rule->route = $request->route;
    	$rule->expired_date = $request->expired_date;
    	$rule->delivery_type = $request->delivery_type;
        $rule->shipping_cost = $request->shipping_cost;

    	$weight = $request->weight;
    	$firstPart = substr($weight, 0, strpos($weight, '-'));
    	$lastPart = substr($weight, strpos($weight, '-')+1);

    	$checkGmKg = preg_replace("/[^a-zA-Z]+/", "", $firstPart);
    	$checkFirstValue = preg_replace("/[^0-9]+/", "", $firstPart);
    	if($checkGmKg == "gm") {
    		$minWeight = $checkFirstValue;
    	} else {
    		$minWeight = $checkFirstValue * 1000;
    	}

    	$checkLastGmKg = preg_replace("/[^a-zA-Z]+/", "", $lastPart);
    	$checkLastValue = preg_replace("/[^0-9]+/", "", $lastPart);
    	if($checkLastGmKg == "gm") {
    		$maxWeight = $checkLastValue;
    	} else {
    		$maxWeight = $checkLastValue * 1000;
    	}

    	$rule->min_weight = $minWeight;
    	$rule->max_weight = $maxWeight;

    	$rule->save();
    	return redirect('admin/rules')->with('message', 'Data saved successfully');
    }

    public function destroy($id)
    {
    	$rule = PricingRule::find($id);
    	if($rule) {
    		$rule->delete();
    		return back()->with('message', 'Data deleted successfully');
    	} else {
    		return back()->with('error', 'Data not found');
    	}
    }
}
