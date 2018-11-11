@extends ('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Редактирование комментариев @endslot
            @slot('parent') Главная @endslot
            @slot('active') Комментарии @endslot
        @endcomponent

        <hr/>

        <form action="{{route('admin.comment.update', $comment)}}" class="form-horizontal" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            @include('admin.comments.partials.form')

            <input type="hidden" name="modified_by" value="{{Auth::id()}}">
        </form>
    </div>
@endsection