@extends ('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Создание комментариев @endslot
            @slot('parent') Главная @endslot
            @slot('active') Комментарии @endslot
        @endcomponent

        <hr />

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{route('admin.comment.store')}}" class="form-horizontal" method="post">
            {{csrf_field()}}
            @include('admin.comments.partials.form')

            <input type="hidden" name="user_id" value="{{Auth::id()}}">
        </form>
    </div>
@endsection