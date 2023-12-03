<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //post
    public function post(){
        $post=Post::get();
        // dd($post->toArray());
        $category=Category::get();
        return view('admin.posts.index',compact('category','post'));
    }
    public function PostCreate(Request $request){
        // dd($request->all());
        $this->postValidationCheck($request);
            if(!empty($request->postImage)){
                $file=$request->file('postImage');
            $fileName=uniqid().'_'. $file->getClientOriginalName();
            // $file->move(public_path('defaultImage'.$fileName));
            $file->storeAs('public/'.$fileName);
            $getData=$this->getUserData($request,$fileName);
            }else{
                $getData=$this->getUserData($request,null);
            }



            $post=Post::create($getData);
            // dd($post->toArray());
            return redirect()->route('post');
    }
    //PostDelete
    public function PostDelete($id){
        $dbImage=Post::where('post_id',$id)->first();
        $dbImage=$dbImage->image;
        Post::where('post_id',$id)->delete();
            if (File::exists(public_path('storage/'.$dbImage))) {
                File::delete(public_path('storage/'.$dbImage));
            }
             return back();
    }
        //PostUpdatePage
        public function PostUpdatePage($id){
            $postUpdate=Post::where('post_id',$id)->first();
            $category=Category::get();
            $post=Post::get();
            return view('admin.posts.update',compact('postUpdate','category','post'));
        }
        //UpdatePost
        public function UpdatePost($id,Request $request){
            $this->postValidationCheck($request);
           $data = $this->GetUpdatePostData($request);
            if (isset($request->postImage)) {
               $this->postUpdateProcess($id,$request,$data);
            }else{
                Post::where('post_id',$id)->update($data);
            }
            return redirect()->route('post');
        }


        //postUpdateProcess
        private function postUpdateProcess( $id,$request,$data){
            $this->GetUpdatePostData($request);
            //Get from client
            $file=$request->file('postImage');
            $fileName=uniqid().$file->getClientOriginalName('postImage');

            $data['image']= $fileName;

            //Get from Database
            $image=Post::where('post_id',$id)->first();
            $dbImage=$image->image;

            //Delete from storage image
            if (File::exists('storage/'.$dbImage)) {
                File::delete('storage/'.$dbImage);
               $file->storeAs('public/'.$fileName);
            }
            Post::where('post_id',$id)->update($data);
        }
        //get update post data
        private function GetUpdatePostData($request){
                return [
                    'title'=>$request->postName,
                    'description'=>$request->postDescription,
                    'category_id'=>$request->postCategory,
                ];
        }

        // getUserData
        private function getUserData($request,$fileName){
            return [
                'title'=>$request->postName,
                'description'=>$request->postDescription,
                'image'=>$fileName,
                'category_id'=>$request->postCategory
            ];
        }
    //postValidationCheck
    private function postValidationCheck($request){
        $request->validate([
            'postName'=>'required',
            'postDescription'=>'required',
            'postCategory'=>'required'
        ]);
    }
}
