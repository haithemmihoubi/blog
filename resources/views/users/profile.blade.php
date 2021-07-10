@extends('layouts.app')
@section('content')

<div class="container justify-content-center" style="padding-top: 8%">

   @if(count($errors)>0)
     @foreach($errors as  $item )
            <div class="alert alert-danger" role="alert">
                {{ $item}}
            </div>
        @endforeach
    @endif


    <form  action="{{route('profile.update')}}"  method="POST">
        @csrf

@method('POST')
        <div class="form-group">
          <label for="exampleFormControlInput1">name</label>
          <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">password</label>
            <input type="password" class="form-control" name="password" value="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">confirm password</label>
            <input type="password" class="form-control" name="c_password" value="">
          </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">province</label>
            <input type="text" class="form-control" name="province" value="{{ $user->profile->province }}">
          </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">gender</label>
          <select class="form-control" name="gender">
            <option value="male">male</option>
            <option value="female">female</option>

          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">bio</label>
          <textarea class="form-control"  rows="3" name="bio">
         {!! $user->profile->bio !!}

          </textarea>
        </div>
<div>
 <button type="submit" class="btn btn-success" >update</button>

</div>

      </form>







</div>







@endsection
