<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('check.post',['only'=>['update','destroy']]);
        $this->middleware(['auth','verified'],['only'=>['create']]);
    }

    /**
     *
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = null;
        if($request->has('search'))
        {
            $posts = Post::getSearchPosts($request);
        }
        else {
            $posts = Post::getAllPosts();
        }
        if($posts->currentPage() > $posts->lastPage())
        {
            return redirect(route('post.index').'/?page='.$posts->lastPage());
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
        Post::createPost($request);
        return redirect(route('post.index'))->with("success","<strong>Пост успешно создан.</strong> Перенаправление на главную страницу успешно завершено.");
    }

    /**
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($post)
    {
        $post = Post::getShowPost($post);
        return view('posts.show',compact('post'));
    }

    /**
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($post)
    {
        $post = Post::getShowPost($post);
        return view('posts.edit',compact('post'));
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request,$id)
    {
        Post::updateCurrentPost($request,$id);
        return redirect()->route('post.show',$id)->with("success","<strong>Пост успешно обновлен.</strong> Перенаправление на обновленный пост успешно завершено.");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PostRequest $request)
    {
        Post::destroyCurrentPost($request);
        return redirect()->route('post.index')->with("destroy","<strong>Пост успешно удален.</strong> Перенаправление на главную страницу успешно завершено.");
    }
}
