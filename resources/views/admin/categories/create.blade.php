@extends ('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Создание категорий @endslot
            @slot('parent') Главная @endslot
            @slot('active') Категории @endslot
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
        <form action="{{route('admin.category.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('admin.categories.partials.form')

            <input type="hidden" name="created_by" value="{{Auth::id()}}">
        </form>
    </div>
@endsection