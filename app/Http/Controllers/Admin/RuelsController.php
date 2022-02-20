<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\admin\RuelsRepository;
use App\Http\Requests\admin\RuleRequest;

class RuelsController extends Controller
{
    private $rule;

    public function __construct(RuelsRepository $rule)
    {
        $this->rule = $rule;
    }

    public function index()
    {
        return $this->rule->index();
    }

    public function create()
    {
        return $this->rule->create();
    }

    public function edit($id)
    {
        return $this->rule->edit($id);
    }

    public function store(RuleRequest $request)
    {
        return $this->rule->store($request);
    }

    public function destroy(Request $request, $id)
    {
        return $this->rule->destroy($id);
    }
}
