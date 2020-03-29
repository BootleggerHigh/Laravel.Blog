@extends('posts.layout',['title'=>'Просмотр поста | '.$post->post_id])
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h2>{{$post->title}}</h2>
                <div class="card-button">
                    <a href="{{route('post.index')}}" class="btn btn-success">На главную</a>
                    <a href="{{route('post.edit',$post->post_id)}}" class="btn btn-warning">Редактировать пост</a>
                    <form action="{{route('post.destroy',$post->post_id)}}" method="POST"
                          onsubmit="if (confirm('Вы уверены,что стоит удалить данный пост?'))
                                    {return true} else {return false}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$post->post_id}}">
                        <input type="submit" class="btn btn-danger"  value="Удалить пост">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="card-img card-img_max"
                     style="background-image: url({{$post->img ?? asset('img/start.jpg') }});">
                </div>
                <div class="card-text">
                    {{$post->descr}}
                </div>
                <div class="card-author">
                    Автор: {{$post->users->name}}
                </div>
                <div class="card-created_at-date">
                    Дата публикации : {{$post->created_at->diffForHumans()}}
                </div>
                <div class="card-updated_at-date">
                    Последнее обновление публикации : {{$post->updated_at->diffForHumans()}}
                </div>
            </div>
        </div>
    </div>
@endsection
