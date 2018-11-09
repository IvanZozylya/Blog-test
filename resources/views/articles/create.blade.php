@extends('layouts.app')

@section('content')

    <div class="container">

        <form class="form-horizontal" action="{{route('article.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{-- Form include --}}
            @include('articles.partials.form')

            <input type="hidden" name="created_by" value="{{Auth::id()}}">
        </form>
    </div>

@endsection