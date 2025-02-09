<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
class IndexController extends Controller
{
   function index() {
      $posts=Post::all();
    return view('social.posts',compact('posts'));
   }
   public function addPost(Request $request){
      $request->validate([
         'descripion' => 'nullable|text',
         // 'img' => 'nulable|image|jpg|png',
         // 'video' => 'nullable',
      ]);
      $user_id=Auth::user()->id;
      $request->merge(['user_id'=>1]);
      // dd($request->all());
      Post::create($request->all());
      return redirect()->route('home');

   }
   public function addLike(Request $request){
      $user_id=Auth::user()->id;
      $request->merge(['user_id'=>$user_id]);
     $like = Like::create($request->all());
      $like_count=Like::where('post_id',$like->post_id)->count();
return response()->json($like_count);
   }
   public function addComment(Request $request){
      $user_id=Auth::user()->id;
      $request->merge(['user_id'=>$user_id]);
      Comment::create($request->all());
      return redirect()->route('home');
   }
}
