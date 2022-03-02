<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\admin\UrlRepository;

class UrlShortenController extends Controller
{
    private $urlShorten;

    public function __construct(UrlRepository $urlShorten)
    {
        $this->urlShorten = $urlShorten;
    }

    public function index()
    {
        return $this->urlShorten->index();
    }

    public function create()
    {
        return $this->urlShorten->create();
    }

    public function edit($id)
    {
        return $this->urlShorten->edit($id);
    }

    public function store(Request $request)
    {
        return $this->urlShorten->store($request);
    }

    public function destroy(Request $request, $id)
    {
        return $this->urlShorten->destroy($id);
    }
}
