@extends('posts.layout',['title'=>'Создание поста'])
@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Создание поста</h3>
        @include('posts.parts.form')
    <input type="submit" value="Создать пост" class="btn btn-success btn-lg btn-block">
    </form>
@endsection
