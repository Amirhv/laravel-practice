@extends('layouts.app')

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif

    {{--
        {!! Form::open(['method' => 'post', 'action' => 'PostController@store' , 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'عنوان :') !!}
            {!! Form::text('title', null , ['class' => 'form-control', 'placeholder' => 'عنوان را بنوسید ...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'توضیحات :') !!}
            {!! Form::textarea('description', null , ['class' => 'form-control', 'placeholder' => 'توضیحات را بنوسید ...']) !!}
        </div>
        {!! Form::submit('ذخیره', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    --}}



    <form method="post" action="/post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="عنوان را وارد کنید">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" placeholder="توضیحات را وارد کنید" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="file">فایل</label>
            <input type="file" name="file" class="form-control-file" id="file">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">ثبت</button>
    </form>

@endsection

