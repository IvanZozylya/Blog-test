@extends('layouts.app')

@section('title','Category')
@section('content')

    <h1>List Categories: </h1>
    <div class="container">
        @foreach($categories as $category)
            <h2><a href="{{route('show_category', $category->slug)}}">{{$category->title}}</a></h2>
            <li>Опубликовано: {{$category->created_at}}</li>
        @endforeach

    <div class="pagination pull-left">
        {{ $categories->links() }}
    </div>
    </div>
@endsection