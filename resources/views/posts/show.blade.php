@extends('layouts.app')

@section('content')

    <h4>{{$post->title}}</h4>
    <p class="text-justify">{{$post->description}}</p>
    <img src="/images/{{$post->path}}" class="img-fluid rounded" style="height: 250px" alt="Responsive image">

    <br>
    <a class="btn btn-warning mt-2" href="{{route('post.edit', $post->id)}}">ویرایش</a>
@endsection
