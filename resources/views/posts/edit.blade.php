@extends('layouts.app')

@section('content')

    <h2>ویرایش پست</h2>
    <hr>
    <br>

    {{--  updating form  --}}
    {!! Form::model($post, ['method' => 'patch', 'action' => ['PostController@update', $post->id]]) !!}
    <div class="form-group">
        {!! Form::label('title','عنوان :') !!}
        {!! Form::text('title', $post->title ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description','توضیحات :') !!}
        {!! Form::textarea('description', $post->description ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('به روز رسانی', ['class' => 'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}

    {{--  deleting form  --}}
    {!! Form::model($post, ['method' => 'delete' , 'action' => ['PostController@destroy', $post->id]]) !!}
    <div class="form-group">
        {!! Form::submit('حذف',['class'=> 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
@endsection


