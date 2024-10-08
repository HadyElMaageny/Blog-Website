<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    public function index()
    {
        // selecgt * from posts;
        $postsFromDB = Post::all(); // collection object
        // dd($postsFromDB);
        // id, title, description, crested_at
        // $all_posts = [
        //     ['id' => 1, 'title' => 'HTML', 'posted_by' => "john", 'created_at' => "10/6/2024 2:59"],
        //     ['id' => 2, 'title' => 'CSS', 'posted_by' => "jane", 'created_at' => "10/7/2024 9:15"],
        //     ['id' => 3, 'title' => 'JavaScript', 'posted_by' => "alex", 'created_at' => "10/8/2024 14:30"],
        //     ['id' => 4, 'title' => 'PHP', 'posted_by' => "mike", 'created_at' => "10/9/2024 16:45"]
        // ];
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    public function show(Post $post)
    {
        // select * from posts where id = $postid
        // $singlePostFromDB = Post::findOrFail($postid); // Model Object

        // $singlePostFromDB = Post::where('id', $postid)->first();

        // $singlePostFromDB = Post::where('title', 'PHP')->get();
        // @dd($singlePostFromDB);

        // if (is_null($singlePostFromDB)) {
        //     return to_route('posts.index');
        // }

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        // $data = request()->all();

        request()->validate(
            [
                'title' => ['required', 'min:3'],
                'description' => ['required', 'min:5'],
                'user_id' => ['required', 'exists:users,id']
            ]
        );

        $title = request()->title;
        $description = request()->description;
        $postCreatorID = request()->user_id;
        $postCreatorName = User::find($postCreatorID)->name;
        // dd($postCreator);

        // $post = new Post;

        // $post->title = $title;
        // $post->description = $description;
        // $post->posted_by = $postCreator;

        // $post->save();

        Post::create([
            'title' => $title,
            'description' => $description,
            'posted_by' => $postCreatorName,
            'user_id' => $postCreatorID,
        ]);

        // dd($data, $title, $description, $postCreator);
        return to_route('posts.index');
    }

    public function edit($postid)
    {
        $post = Post::find($postid);
        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($postid)
    {
        request()->validate(
            [
                'title' => ['required', 'min:3'],
                'description' => ['required', 'min:5'],
                'user_id' => ['required', 'exists:users,id']
            ]
        );
        // $data = request()->all();

        $title = request()->title;
        $description = request()->description;
        $postCreatorID = request()->user_id;
        $postCreatorName = User::find($postCreatorID)->name;

        $post = Post::find($postid);

        // $post->title = $title;
        // $post->description = $description;
        // $post->posted_by = $postCreator;

        // $post->save();

        $post->update(
            [
                'title' => $title,
                'description' => $description,
                'posted_by' => $postCreatorName,
                'user_id' => $postCreatorID
            ]
        );

        // dd($title, $description, $postCreator);
        return to_route('posts.show', $postid);
    }

    public function destroy(Post $post)
    {
        $post = Post::find($post->id);

        $post->delete();
        // 1- Delete the Post from DB
        // 2- Redirect to posts.index

        // Post::where('id', $post->id)->delete();
        return to_route('posts.index');
    }
}
