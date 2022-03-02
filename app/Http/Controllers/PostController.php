<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $user;
     
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function get_post()
    {
        $posts = $this->user->posts()->get();
        return response()->json([
            'success' => true,
            'data' => $posts
        ], Response::HTTP_OK);
    }

    public function add_post(Request $request)
    {
    	$base64_str = substr($request->banner_image, strpos($request->banner_image, ",")+1);
        $image = base64_decode($base64_str);
        $safeName = Str::random(10).'.'.'png';
        Storage::disk('local')->put($safeName, $image);
        // $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // echo $storagePath.$safeName; 

        $data = $request->only('title');
        $validator = Validator::make($data, [
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $post = $this->user->posts()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
            'details' => $request->details,
            'banner_image' => $safeName
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], Response::HTTP_OK);
    }
}
