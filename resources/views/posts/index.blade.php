@extends('layouts.app')

@section('content')

    <h2>پست ها</h2>
    <hr>
    <br>

    <ul>
        @foreach($posts as $post)
            <span>{{$post->user->name}}</span>
            <li><a href="{{route('post.show',$post->id)}}">{{$post->title}}</a></li>
            <br>
        @endforeach
    </ul>
@endsection()
