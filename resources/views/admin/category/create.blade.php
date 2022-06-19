@extends('layouts.master')

    @section('title','Add Category')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mt-4">Add Category</h4>
        </div>

        <div class="card-body">

            {{-- <div class="alert alert-danger">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach 
            </div>  
            @endif --}}
        

            <form action="{{ url('admin/add-category') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Category Slug</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea type="text" id="mySummernote" name="description" class="form-control" rows="10" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <h6>SEO Tags</h6>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">Meta Descriprion</label>
                    <textarea type="text" name="meta_description" class="form-control" rows="10" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea type="text" name="meta_keyword" class="form-control" rows="10" required></textarea>
                </div>

                <h6>Status Mode</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Navbar Status</label>
                        <input type="checkbox" name="navbar_status">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for=""> Status</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary float-end">Save Category</button>
                    </div>
               </div>

            </form>
        </div>
    </div>
</div>

@endsection