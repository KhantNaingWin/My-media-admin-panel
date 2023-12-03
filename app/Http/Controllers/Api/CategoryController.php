<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //allCategory
    public function allCategory(Request $request){
        $category=Category::get();
        return  response()->json([
            'category'=>$category
        ]);
    }
    public function CategoryList(Request $request){
        $categoryList=Category::select('posts.*')
        ->join('posts','categories.category_id','posts.category_id')
        ->where('categories.title','LIKE','%'.$request->key.'%')
        ->get();
        return response()->json([
            'result'=>$categoryList
        ]);
    }
}
