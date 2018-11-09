@extends('layouts.app')

@section('title' , $category->title . " Ivan - Developer")

@section('content')
    <h4 class="btn btn-success label-info"><a href="{{route('create_article')}}" style="color:black">Create article</a></h4>
    <div class="container">
        @forelse($articles as $article)
            <div class="row">
                <div class="col-sm-12">
                    <h2><a href="{{route('show_article', $article->slug)}}">{{$article->title}}</a></h2>
                    <p>{!!$article->description_short!!}</p>
                </div>
            </div>
        @empty
            <h2 class="text-center">Пусто</h2>
        @endforelse
        {{$articles->links()}}
    </div>
@endsection