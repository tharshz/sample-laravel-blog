<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('createdBy')->orderBy('id', 'desc')->paginate(12);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        Post::create($data);
        return redirect()->route('post.index')->with('success', 'Post has been created successfuly!');
    }
}