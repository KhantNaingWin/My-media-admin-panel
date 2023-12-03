<?php

namespace App\Http\Controllers;

use App\Models\Actionlog;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //trendPost
    public function trendPost(){
        $items = Actionlog::select('actionlogs.*','posts.*',DB::raw('COUNT(actionlogs.post_id) as post_count'))
        ->leftJoin('posts','posts.post_id','actionlogs.post_id')
        ->groupBy('actionlogs.post_id')
        ->get();
        // dd($items->toArray());
        return view('admin.trend_post.index',compact('items'));
    }
    public function trendPostDetails($id){
        $post=Post::where('post_id',$id)->first();
        return view('admin.trend_post.details',compact('post'));
    }
}
