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

    .posts {
        margin: auto;
        width: 35%;
    }

    td {
        padding-bottom: 50px;
    }
</style>

@section('content')
<div class="center-headline">
    <h2>All Posts</h2>
</div>
<div class="posts">
    <table>
        @foreach ($posts as $p)
            <tr>
            <td>
                <h5>{{ $p['author'] }}</h5>
                <h4><b>{{ $p['title'] }}</b></h4>
                <p>{{ $p['content'] }}</p>
                <p>{{ $p['created_at'] }}</p>
            </td>
            </tr>
        @endforeach
    </table>
</div>

@endsection