@extends('layouts.master')

    @section('title','Add Post')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Add Post
                <a href="{{ url('admin/add-post') }}" class="btn btn-primary float-end">Add Post</a>
            </h4>
        </div>

        <div class="card-body">

            {{-- <div class="alert alert-danger">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach 
            </div>  
            @endif --}}
        

            <form action="{{ url('admin/add-post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mt-3">
                    <label for="">Category</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="">--- Select Category---</option>
                        @foreach ($category as $cateitem)
                        <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Post Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Post Slug</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea type="text" id="mySummernote" name="description" class="form-control" rows="10" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Youtube Link</label>
                    <input type="text" name="yt_iframe" class="form-control" required>
                </div>

                <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Meta Descriprion</label>
                    <textarea type="text" id="mySummernote" name="meta_description" class="form-control" rows="10" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea type="text" id="mySummernote" name="meta_keyword" class="form-control" rows="10" required></textarea>
                </div>

                <h6>Status Mode</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for=""> Status</label>
                            <input type="checkbox" name="status">
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Save Post</button>
                    </div>
                    </div>
               </div>

            </form>
        </div>
    </div>
</div>

@endsection