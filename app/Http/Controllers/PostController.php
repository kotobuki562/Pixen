<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function input()
    {
        return view('image.input');
    }

    public function upload(Request $request){
        $this->validates($request,[
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
            ]
        ]);

            if($request->file('file')->isValid([])){
            $path = $request->file->$store('public');

            $file_name = basename($path);
            $user_id = Auth::id();
            $new_post_data = new Post();
            $new_post_data->user_id = $user_id;
            $new_post_data->file_name = $file_name;
            $new_post_data->text = $text;

            $new_post_data->save();
            return redirect('/output');
        }else{
            return redirect()
            ->back()
            ->withInput()
            ->withErrors();
        }
    }
    
    public function output(){
        $user_id = Auth::id();
        $user_posts = Post::whereUser_id($user_id)->get();
        return view('post.output',['user_posts' => $user_posts]);
    }
}
