@extends('layouts.app')

@section('title')
    Create
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
        <form action={{ route('posts.store') }} method="POST">
            @csrf
            <div class="mb-3 mt-4">
                <label for="Text" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="Text" value={{ old('title') }}>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name= "description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
            </div>
            <label for="exampleformSelection" class="form-label">Post Creator</label>
            <select name= "user_id" class="form-select" aria-label="Default select example" id= "exampleformSelection">
                @foreach ($users as $user)
                    <option value={{ $user->id }}>{{ $user->name }}</option>
                @endforeach
            </select>
            <div class="mt-4"><button type="submit" class="btn btn-primary">Submit</button></div>
        </form>
    </div>
@endsection
