<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //category
    public function category(){
        $category=Category::get();
        return view('admin.category.index',compact('category'));
    }
    //categoryCreate
    public function categoryCreate(Request $request){
        $this->categoryValidationCheck($request);
        Category::create([
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription
        ]);
        return back();
    }

    //CategoryDelete
    public function CategoryDelete($id){
        Category::where('category_id',$id)->delete();

        return back()->with('delete','Category Deleted!');
    }

    //CategorySearch
    public function CategorySearch(Request $request){
        $category=Category::orWhere('title','like','%'.$request->categorySearch.'%')
                            ->orWhere('description','like','%'.$request->categorySearch.'%')
                            ->get();
                            return view('admin.category.index',compact('category'));
    }
    //CategoryEdit
    public function CategoryEdit($id){
        $category=Category::get();
        $updateData=Category::where('category_id',$id)->first();
        // dd($updateData->toArray());
        return view('admin.category.edit',compact('category','updateData'));
    }
    //CategoryUpdate
    public function CategoryUpdate($id,Request $request){
        $this->categoryValidationCheck($request);
        $updatedata=$this->UpdateData($request);
        Category::where('category_id',$id)->update($updatedata);
        return redirect()->route('category');

    }

    //categoryValidationCheck
    private function categoryValidationCheck($request){
       return $request->validate([
            'categoryName'=>'required|unique:categories,title',
            'categoryDescription'=>'required'
        ]);
    }
    //update data
    private function UpdateData($request){
        return [
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription
        ];
    }
}
