@extends('layouts.app')

@section('title','Category')
@section('content')
    <div class="container">
        <h1>List Categories: </h1>
        <div class="clearfix">
        @foreach($categories as $category)
            <div class="col-md-4 category-block">
                    <div class="category-block-content" onclick="window.location='{{ route('show_category', $category->slug) }}'">
                        <p class="category-title">{{$category->title}}</p>
                        <div class="text-center">
                            <img src="{{asset('images/uploads/categories/' .$category->image)}}" style="max-height: 250px; max-width: 250px;" alt="">
                        </div>
                        <span>Опубликовано: {{$category->created_at}}</span>
                    </div>
                </div>
        @endforeach
        </div>
        <div class="pagination row">
            <div class="pull-left">
                {{ $categories->links() }}</div>
        </div>
    </div>
@endsection