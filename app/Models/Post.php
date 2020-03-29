<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return mixed
     * Вывод всех постов с пагинацией,сортировка по созданию поста в обратном порядке
     */
    protected static function getAllPosts()
    {
        return Post::orderBy('created_at', 'desc')->with('users.posts')->paginate(4);
    }

    /**
     * @param $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * Поиск поста(-ов) по : имени или тексту поста или заголовку
     */
    protected static function getSearchPosts($search)
    {
        $posts = Post::with('users.posts');
        return $posts->whereHas('users', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search->search . '%');
        })
            ->orWhere('title', 'LIKE', '%' . $search->search . '%')
            ->orWhere('descr', 'LIKE', '%' . $search->search . '%')
            ->paginate(4);
    }

    protected static function createPost($request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->short_title = Str::length($request->title) > 30 ? mb_substr($request->title, 0,
                30) . '...' : $request->title;
        $post->descr = $request->description;
        $post->author_id = rand(1,4);
        if ($request->file('img')) {
            $path = Storage::putFile('public',$request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }
        $post->save();
    }
}
