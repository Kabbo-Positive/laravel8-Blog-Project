<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'description' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
        ]);

        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/category', $filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->slug);
        $category->description = $request->input('description');
        $category->meta_description = $request->input('meta_description');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->navbar_status = $request->navbar_status == true ? '1':'0';
        $category->status = $request->status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->save();
        
        return redirect('admin/category')->with('message','Category Added Successfully');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'description' => 'required',
            'meta_description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
        ]);

        $category = Category::find($category_id);
        if ($request->hasFile('image')) {

            $path = 'assets/uploads/category' . $category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/category', $filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->slug);
        $category->description = $request->input('description');
        $category->meta_description = $request->input('meta_description');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->navbar_status = $request->navbar_status == true ? '1':'0';
        $category->status = $request->status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->update();
        
        return redirect('admin/category')->with('message','Category Updated Successfully');
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->category_delete_id);
        if ($category->image) {
            $path = 'assets/uploads/category' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->posts()->delete();
        $category->delete();

        return redirect('admin/category')->with('message','Category Deleted with its Posts Successfully');
    }
}
