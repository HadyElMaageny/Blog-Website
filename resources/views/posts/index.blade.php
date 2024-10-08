@extends('layouts.app')
@section('title')
    Index
@endsection

@section('content')
    <div class="text-center mt-4">
        <a href={{ route('posts.create') }} class="btn btn-success">Create Post</a>
    </div>
    <div class="container mt-4">
        <table class="table mx-auto" style="margin-left: 20px; margin-right: 20px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    {{-- @dd($posts, $post) --}}
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user ? $post->user->name : 'not found' }}</td>
                        <td>{{ $post->user ? $post->created_at->format('Y-m-d') : 'not found' }}</td>
                        <td>
                            <a href={{ route('posts.show', $post->id) }} class="btn btn-info">View</a>
                            <a href={{ route('posts.edit', $post->id) }} class="btn btn-primary">Edit</a>
                            <form style="display: inline" method="POST" action="{{ route('posts.destroy', $post->id) }}"
                                onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    return confirm('Are you sure you want to delete this post?');
                                }
                            </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
