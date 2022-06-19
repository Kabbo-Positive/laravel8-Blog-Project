@extends('layouts.master')

    @section('title','Edit Category')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Edit Category</h4>
        </div>

        <div class="card-body">

            {{-- <div class="alert alert-danger">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach 
            </div>  
            @endif --}}
        

            <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" value="{{ $category->name }}" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Category Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea type="text" id="mySummernote" name="description"  class="form-control" rows="10" required>{{ $category->description }}</textarea>
                </div>

                    @if ($category->image)
                        <img src="{{ asset('assets/uploads/category/'.$category->image) }}" width="50px" height="50px" alt="Img">
                    @endif
                    
                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" value="{{ $category->image }}" class="form-control" required>
                </div>

                <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Meta Descriprion</label>
                    <textarea type="text" name="meta_description"  class="form-control" rows="5" required>{{ $category->meta_description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea type="text" name="meta_keyword"  class="form-control" rows="5" required>{{ $category->meta_keyword }}</textarea>
                </div>

                <h6>Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Navbar Status</label>
                        <input type="checkbox" name="navbar_status" {{ $category->navbar_status == '1' ? 'Checked':'' }}>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for=""> Status</label>
                        <input type="checkbox" name="status" {{ $category->status == '1' ? 'Checked':'' }}>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
               </div>

            </form>
        </div>
    </div>
</div>

@endsection