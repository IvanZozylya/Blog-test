@extends('layouts.app')

@section('title' , $category->title . " Ivan - Developer")

@section('content')
    <div class="container">
        @if(Auth::user())
            <div class="row clearfix margin-bottom">
                <a class="btn btn-success pull-right " href="{{route('create_article')}}" style="color:black">Create
                    article</a>
            </div>
        @endif
        @forelse($articles as $article)
            <div class="row article-block" onclick="window.location='{{ route('show_article', $article->slug) }}'">
                <div class="col-md-2">
                    <img style="width:100px; height:100px; float:left; border-radius:50%; margin-right:25px;"
                         src="{{asset('/images/uploads/articles/' . $article->image)}}">
                </div>
                <div class="col-sm-10">
                    <span class="article-title">{{$article->title}}</span>
                    <span class="article-description">{!!$article->description_short!!}</span>
                    <span style="display:block;">Опубликовано: {{$article->created_at}}</span>
                    @foreach($users as $user)
                        @if($user->id == $article->created_by)
                            <span style="display:block;">Автор: {{$user->name}}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        @empty
            <h2 class="text-center">Пусто</h2>
        @endforelse
        {{$articles->links()}}
    </div>
@endsection