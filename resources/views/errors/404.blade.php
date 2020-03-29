@extends('posts.layout',['title'=>'404,браток.'])
@section('content')
        <h2 class="card-header">Увы :(</h2>
        <img src="{{asset('img/404.jpg')}}" alt="Красавчик">
        <a href="{{route('post.index')}}" class="btn btn-success">На главную</a>
@endsection
