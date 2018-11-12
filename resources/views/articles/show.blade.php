@extends('layouts.app')

@section('title', $article->title)
@section('meta_keyword', $article->meta_keyword)
@section('meta_description', $article->meta_description)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$article->title}}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <img src="/images/uploads/articles/{{$article->image}}" alt="Image">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="app-label">Author:</label>
                    <div class="app-content">{{ $user->name }}</div>
                </div>
                <div class="form-group">
                    <label class="app-label">Short_description:</label>
                    <div class="app-content">{!! $article->description_short !!}</div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-12">
                <p class="app-content">{{$article->description}}</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h3>Коментарии</h3>
            </div>
        </div>
        @include('comments.comments_block', ['essence' => $article])
    </div>
@endsection