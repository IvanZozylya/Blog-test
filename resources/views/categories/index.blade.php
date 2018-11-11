@extends('layouts.app')

@section('title','Category')
@section('content')
    <div class="container">
        <h1>List Categories: </h1>
        @foreach($categories as $category)
            <div class="col-md-4 category-block">
                <div class="category-block-content" onclick="window.location='{{ route('show_category', $category->slug) }}'">
                    <p class="category-title">{{$category->title}}</p>
                    <span>Опубликовано: {{$category->created_at}}</span>
                </div>
            </div>
        @endforeach
        <div class="pagination pull-left">
            {{ $categories->links() }}
        </div>
    </div>
@endsection