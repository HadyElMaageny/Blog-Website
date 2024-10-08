@extends('layouts.app')

@section('title')
    Edit
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="container">
        <form method="POST" action={{ route('posts.update', $post->id) }}>
            @csrf
            @method('PUT')
            <div class="mb-3 mt-4">
                <label for="Text" class="form-label">Title</label>
                <input value={{ $post->title }} name="title" type="text" class="form-control" id="Text">

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name= "description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $post->description }}</textarea>
            </div>
            <label for="exampleformSelection" class="form-label">Post Creator</label>
            <select name= "user_id" class="form-select" aria-label="Default select example" id= "exampleformSelection">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if ($user->id == $post->user_id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <div class="mt-4"><button type="submit" class="btn btn-primary">Update</button></div>
        </form>
    </div>
@endsection
