<?php

namespace App\Models;

use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $primaryKey = 'post_id';
    protected $fillable = ['author_id','title','short_title','img','descr'];
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

    /**
     * @param $request
     * Создание поста
     */
    protected static function createPost($request)
    {
        $post = new Post();
        $post = self::createOrEditPost($post,$request);
        $post->save();
    }

    /**
     * @param $id
     * @return mixed
     * Поиск поста
     */
    protected static function getShowPost($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     * Обновление поста
     */
    protected static function updateCurrentPost($request, $id)
    {
        $post = Post::findOrFail($id);
        $update_model = self::createOrEditPost($post,$request,1);
        return $post->update(array($update_model));
    }

    protected static function destroyCurrentPost($request)
    {
        $post = Post::findOrFail($request->id);
        unlink(public_path().$post->img);
        $post->delete();
    }

    /**
     * @param $model
     * @param $request
     * @param int $update
     * @return mixed
     * Базовый метод для  createPost updateCurrentPost (DRY)
     */
    private static function createOrEditPost($model,$request,$update=0)
    {
        $model->title = $request->title;
        $model->short_title = Str::length($request->title) > 30 ? mb_substr($request->title, 0,
                30) . '...' : $request->title;
        $model->descr = $request->description;
        if($update === 0)
        {
            $model->author_id = Auth::user()->id;
        }
        if ($request->file('img')) {
            if($update === 1)
            {
               unlink(public_path().$model->img);
            }
            $path = Storage::putFile('public',$request->file('img'));
            $url = Storage::url($path);
            $model->img = $url;
        }
        return $model;
    }
}
