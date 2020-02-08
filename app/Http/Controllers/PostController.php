<?php

namespace App\Http\Controllers;

use App\Events\PostViewEvent;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required|max:120',
            'description' => 'required',
            'file' => ['required', 'max:1024', 'mimes:jpeg,jpg,png']
        ], [
            'title.required' => 'لطفا عنوان مطلب خود را وارد کنید.',
            'title.max' => 'عنوان نباید بیشتر از ۳ کارکتر باشد.',
            'description.required' => 'لطفا توضیحات مطلب خود را وارد کنید.'
        ]);

        $post = new Post();
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move('images', $fileName);
            $post->path = $fileName;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = 1;
        $post->save();

        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        event(new PostViewEvent($post));
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //Policy
        $user = Auth::user();
        if ($user->can('update', $post)) {
            return view('posts.edit', compact(['post']));
        } else {
            return "you dont have permission to edit this post.";
        }

        //Gate
        /*
        if (Gate::allows('edit-post', $post)) {
            return view('posts.edit', compact(['post']));
        } else {
            return "you dont have permission to edit this post.";
        }
        */

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('post');
    }
}
