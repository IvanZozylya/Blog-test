@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary">Категории {{$count_categories}}</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary">Материалы {{$count_articles}}</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary">Посетители 0</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary">Сегодня 0</span></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <a class="btn btn-block btn-default" href="{{route('admin.category.create')}}">Создать категорию</a>
                @foreach($categories as $category)
                    <a href="{{route('admin.category.edit',$category)}}" class="list-group-item">
                        <h4 class="list-group-item">{{$category->title}}</h4>
                        <p class="list-group-item-text">
                            {{$category->articles()->count()}}
                        </p>
                    </a>
                @endforeach

            </div>
            <div class="col-sm-6">
                <a class="btn btn-block btn-default" href="{{route('admin.article.create')}}">Создать материал</a>
                @foreach($articles as $article)
                    <a href="{{route('admin.article.edit',$article)}}" class="list-group-item">
                        <h4 class="list-group-item">{{$article->title}}</h4>
                        <p class="list-group-item-text">
                           {{$article->categories()->pluck('title')->implode(', ')}}
                        </p>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endsection