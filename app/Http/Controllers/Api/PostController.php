<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //PostAllList
    public function PostAllList(){
        $post=Post::get();
        return response()->json([
            'status'=>'success',
            'post'=>$post
        ]);
    }

    //categorySearch
    public function postSearch(Request $request){
        $post= Post::where('title','like','%'.$request->key.'%')->get();
         return response()->json([
             'key'=>$post->all()
         ]);
     }
     //postDetails
     public function postDetails(Request $request){
        $id=$request->postId;
        $post=Post::where('post_id',$id)->first();
        return response()->json([
            'post'=>$post
        ]);
     }
}
