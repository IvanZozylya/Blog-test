@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary"><a href="{{route('admin.category.index')}}" style="color: white">Категории</a> {{$count_categories}}</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary"><a href="{{route('admin.article.index')}}" style="color: white">Материалы</a> {{$count_articles}}</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary"><a href="{{route('admin.user_managment.user.index')}}" style="color: white">Пользователи</a> {{$count_users}}</span></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="jumbotron">
                    <p><span class="label label-primary"><a href="#" style="color: white">Комментарии</a> {{$count_comments}}</span></p>
                </div>
            </div>
        </div>

    </div>
@endsection