<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Blog;
use Validator;



class BlogController extends Controller
{
    public function showUser()
    {
        if(auth()->user()->hasRole(1))
        {
            $user = User::all();
            return response()->json(['data'=>$user],201);
        } else {
            $response =["message"=>"only Super Admin  can display all user"];
            return response($response,200);
        }
    }

    public function showBlogs()
    {
        if(auth()->user()->hasRole(1) || auth()->user()->hasRole(2) || auth()->user()->hasRole(3) || auth()->user()->hasRole(4))
        {
            $blog = Blog::all();
            return response()->json(['data'=>$blog],201);
        } else {
            return response()->json(["you dont have permission"]);
        }
    }
    public function CreateBlog(Request $request)
    {
        if(auth()->user()->hasRole(1) || auth()->user()->hasRole(2))
        {
            $validation = Validator::make($request->all(),[
                'title'=>'required|max:200',
                'description'=>'required|max:200',
                'content'=>'required|max:200',
            ]);

            if($validation->fails()) {
                return response()->json($validation->errors(),202);
            }
            
            $data = $request ->all();


            $data['title'] =$request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;

            $blog=Blog::create($data);
            
            return response()->json(['data'=>$blog],201);
        } else {

            $response =["message"=>"only Super Admin and Editor can create a blog"];
            
            return $response;
        }
    }

    public function EditBlog(Request $request, Blog $blog)
    {
        if(auth()->user()->hasRole(1) || auth()->user()->hasRole(2) || auth()->user()->hasRole(3))
        {
            $rules = [
                'title'=>'required|max:200',
                'description'=>'required|max:200',
                'content'=>'required|max:200',
            ];



            if($request->has('title')) {
                $blog->title = $request->title;
            }
            
            if($request->has('description')) {
                $blog->description = $request->description;
            }
            if($request->has('content')) {
                $blog->content = $request->content;
            }

            $blog->save();
            return $blog;
        } else{
            $response = ["message" => "Supper admin, Sub admin, Editor can update the post"];
            return response($response,200);
        }
    }
    public function DeleteBlog($id)
    {
        $blog=Blog::findOrFail($id);

        if(auth()->user()->hasRole(1) || auth()->user()->hasRole(2))
        {
            $blog->delete();
            return response()->json(['data'=>$blog]);
        }else {
            $response = ["message" => "You can not delete the post" ];
            return response($response,200);
        }
    }
}
