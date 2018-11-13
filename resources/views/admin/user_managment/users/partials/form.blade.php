@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="Name"
       value="@if(old('name')){{old('name')}}@else{{$user->name or ""}}@endif" required>

<label for="">Email</label>
<input type="email" class="form-control" name="email" placeholder="Email"
       value="@if(old('email')){{old('email')}}@else{{$user->email or ""}}@endif" required>

<label for="">Password</label>
<input type="password" class="form-control" name="password">

<label for="">Confirm</label>
<input type="password" class="form-control" name="password_confirmation">

@if(isset($user->is_admin))
    @if($user->is_admin)
        <label class="form-check-label" for="gridCheck">
            Admin
        </label>
        <input type="checkbox" value="{{$user->is_admin}}" name="is_admin" checked>
    @else
    <input type="checkbox" name="is_admin" value="1">
    @endif
@endif

<hr/>

<input class="btn btn-primary" type="submit" value="Сохранить">