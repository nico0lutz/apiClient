@extends('layouts.app')

<style>
    .form {
        margin: 0 auto;
        width: 35%;
    }

    .center-headline {
        margin: auto;
        text-align: center;
    }

    .myPosts {
        margin: auto;
        width: 35%;
    }

    td {
        padding-bottom: 50px;
    }
</style>

@section('content')
    <div class="center-headline">
        <h2>Create Post</h2>
    </div>
    <div class="form">
        <form action="{{ url('addPost') }}" method="POST">
            @csrf
            <input name="title" type="text" placeholder="Title" required><br>
            <textarea name="content" cols="80" rows="10" placeholder="Content" required>
            </textarea><br>
            <input type="submit" value="Add Post">
        </form>
    
    </div>

    <div class="center-headline">
        <h2>My Posts</h2>
    </div>
    <div class="myPosts">
    <table>
        @foreach ($myPosts as $p)
            <tr>
            <td>
                <h5>{{ $p['author'] }}</h5>
                <h4><b>{{ $p['title'] }}</b></h4>
                <p>{{ $p['content'] }}</p>
                <p>{{ $p['created_at'] }}</p>
                <a href="deletePost/{{ $p['id'] }}">Delete</a>
                <a href="editPost/{{ $p['id'] }}/{{ $p['title'] }}/{{ $p['content'] }}">Edit</a>
            </td>
            </tr>
        @endforeach
    </table>
    
    </div>

@endsection