@extends('layouts.app') 
@section('content')
    <h1>Create Posts</h1>
    {{ Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) }}
        <div class='form-group'>
            {{Form::label('user_id','UserId')}}
            {{Form::text('user_id','',['class'=>'form-control','placeholder' => 'User Id'])}}
        </div>   
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}               
    {{ Form::close() }}
@endsection