<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index',compact('posts'));
    }

    public function create()
    {
        $category = Category::where('status','0')->get();
        return view('admin.post.create',compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
        ]);

        $posts = new Post();
        $posts->category_id = $request->input('category_id');
        $posts->name = $request->input('name');
        $posts->slug = Str::slug($request->slug);
        $posts->description = $request->input('description');
        $posts->meta_description = $request->input('meta_description');
        $posts->meta_title = $request->input('meta_title');
        $posts->meta_keyword = $request->input('meta_keyword');
        $posts->status = $request->status == true ? '1':'0';
        $posts->created_by = Auth::user()->id;
        $posts->save();
        
        return redirect('admin/posts')->with('message','Post Added Successfully');
    }
    public function edit($post_id)
    {
        $category = Category::where('status','0')->get();
        $posts = Post::find($post_id);
        return view('admin.post.edit',compact('posts','category'));
    }

    public function update(Request $request, $post_id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
        ]);

        $posts = Post::find($post_id);
        $posts->category_id = $request->input('category_id');
        $posts->name = $request->input('name');
        $posts->slug = Str::slug($request->slug);
        $posts->description = $request->input('description');
        $posts->meta_description = $request->input('meta_description');
        $posts->meta_title = $request->input('meta_title');
        $posts->meta_keyword = $request->input('meta_keyword');
        $posts->status = $request->status == true ? '1':'0';
        $posts->created_by = Auth::user()->id;
        $posts->update();

        return redirect('admin/posts')->with('message','Post Updated Successfully');
    }


    public function delete($post_id)
    {
        $posts = Post::find($post_id);
        $posts->delete();
        return redirect('admin/posts')->with('message','Post Deleted Successfully');
    }
    
}
