@extends('layouts.app')

@section('content')
    <a href="/upload">画像のアップロードに戻る</a>
    <br>
    @foreach ($user_posts as $user_post)
        <img src="{{ asset('storage/' . $user_post['file_name']) }}">
        <br>
    @endforeach
@endsection