<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        $all_categories = Category::where('status','0')->get();
        $latest_posts = Post::with('category')->where('status','0')->orderBy('created_at','DESC')->get()->take(10);
        return view('frontend.index',compact('all_categories','latest_posts','setting'));
    }

    public function viewCategoryPost(string $category_slug)
    {
        $category = DB::table('categories')->where('slug',$category_slug)->where('status','0')->first();
        if($category)
        {
            $post = Post::with('user')->where('category_id',$category->id)->where('status','0')->paginate(2);
            return view('frontend.post.index',compact('post','category'));
        }
        else
        {
            return redirect('/');
        }
        
    }

    public function viewPost( string $category_slug, string $post_slug)
    {
        $category = DB::table('categories')->where('slug',$category_slug)->where('status','0')->first();
        if($category)
        {
            $post = Post::with('user')->where('category_id',$category->id)->where('slug',$post_slug)->where('status','0')->first();
            $latest_posts = Post::with('user')->where('category_id',$category->id)->where('status','0')->orderBy('created_at','DESC')->get()->take(10);
            return view('frontend.post.viewpost',compact('post','latest_posts'));
        }
        else
        {
            return redirect('/');
        }
    }
}
