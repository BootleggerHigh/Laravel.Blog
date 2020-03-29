@extends('layouts.layout')
@section('title','Главная страница')
@section('content')
    @if(isset($_GET['search']))
        @if(!count($posts))
            <h2>Результат поиска {{$_GET['search']}} ничего не найдено </h2>
            <a href="{{route('post.index')}}" class="btn btn-outline-success">Отобразить все посты</a>
        @else
            <h2>Результат поиска {{$_GET['search']}} найдено {{$posts->total()}}</h2>
        @endif
    @endif
    <div class="row">
        @foreach($posts as $post)
            <div class="col-6">
                <div class="card">
                    <div class="card-header"><h2>{{$post->short_title}}</h2></div>
                    <div class="card-body">
                        <div class="card-img"
                             style="background-image: url({{$post->img ?? asset('img/start.jpg') }});">
                        </div>
                        <div class="card-author">
                            Автор: {{$post->users->name}}
                        </div>
                        <a href="#" class="btn btn-outline-dark">
                            Посмотреть пост
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {!! $posts->appends(Request::except('page'))->render() !!}
@endsection
