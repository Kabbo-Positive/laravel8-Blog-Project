@extends('layouts.app')

@section('title',"$setting->meta_title")

@section('meta_description',"$setting->meta_description")

@section('meta_keyword',"$setting->meta_keyword")

@section('content')
    

<div class="bg-danger py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <div class="owl-carousel category-carousel owl-theme">
                    @foreach ($all_categories as $all_cate_item)
                    <div class="item">
                        <a href="{{ url('learn/'.$all_cate_item->slug) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/category/'.$all_cate_item->image) }}" alt="Image">
                                <div class="card-body text-center">
                                    <h5 class="text-dark">{{ $all_cate_item->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

        </div>
        </div>
    </div>
</div>

<div class="py-1 bg-gray">
    <div class="container">
        <div class="border text-center p-3">
            <h3>Advertise Here</h3>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Web Language Site</h4>
                <div class="underline"></div>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>All Categories List</h4>
                <div class="underline"></div>
                   
            </div>
            @foreach ($all_categories as $all_cate_item)
                <div class="col-md-3 mb-3">
                    <div class="card card-body">
                        <a href="{{ url('learn/'.$all_cate_item->slug) }}" class="text-decoration-none">
                            <h5 class="text-dark mb-0">{{ $all_cate_item->name }}</h5>
                        </a>
                    </div>
                </div>
           @endforeach
        </div>
    </div>
</div>


<div class="py-5 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Latest Posts</h4>
                <div class="underline"></div>
                   
            </div>
            <div class="col-md-8">
                @foreach ($latest_posts as $latest_post_item)
                    <div class="card card-body bg-gray shadow">
                        <a href="{{ url('learn/'.$latest_post_item->category->slug.'/'.$latest_post_item->slug) }}" class="text-decoration-none">
                            <h5 class="text-dark mb-0">{{ $latest_post_item->name }}</h5>
                        </a>
                        <h6>
                            Posted On: {{ Carbon\Carbon::parse($latest_post_item->created_at)->format('Y-m-d') }}
                        </h6>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="border text-center p-3">
                    <h3>Advertise Here</h3>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection