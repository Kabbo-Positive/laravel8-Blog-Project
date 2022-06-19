<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $validator = Validator::make($request->all(),[
                'comment_body' => 'required|string',
            ]);
            if($validator->fails())
            {
                return redirect()->back()->with('message','Comment area is mandatory');
            }
            $post = Post::where('slug', $request->post_slug)->where('status','0')->first();
            if($post)
            {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body'=>$request->comment_body
                ]);
                return redirect()->back()->with('message','Comment Succesfully');
            }
            else
            {
                return redirect()->back()->with('message','No such post found');
            }
        }
        else
        {
            return redirect('login')->with('message','Login First to comment');
        }
    }


    public function delete(Request $request)
    {
        if(Auth::check())
        {
            $comment = Comment::where('id',$request->comment_id)
            ->where('user_id',Auth::user()->id)
            ->first();
            if($comment)
            {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment deleted Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong',
                ]);
            }
            
        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to delete this comment',
            ]);
        }
    }
}
