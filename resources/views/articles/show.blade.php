@extends('layouts.app')

@section('title', $article->title)
@section('meta_keyword', $article->meta_keyword)
@section('meta_description', $article->meta_description)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Title:</h1><h1 class="btn-primary"> <strong>{{$article->title}}</strong></h1>
               IMAGE:-------------------------------
                <hr>
                <h3>Short_description:</h3><h3 class="btn-primary"><strong>{!! $article->description_short !!}</strong></h3>
                <h3>Description:</h3><br>
                    <textarea class="btn-primary" name="" id="" cols="160" rows="10" readonly>{{$article->description}}</textarea>

                <h1>Author:<span class="btn-primary"> <strong>{{$user->name}}</strong></span></h1>
            </div>
        </div>
    </div>
@endsection