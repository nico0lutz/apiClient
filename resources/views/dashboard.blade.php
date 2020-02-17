@extends('layouts.app')

<style>
tr, td {
    padding-right: 50px;
    padding-bottom: 20px;
}


</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <table>
                    <tr>
                    <td class="key"><b>Name</b></td><td>{{ $user['name'] }}</td>
                    </tr>
                    <tr>
                    <td class="key"><b>Email</b></td><td>{{ $user['email'] }}</td>
                    </tr>
                    <tr>
                    <td class="key"><b>Created at</b></td><td>{{ $user['created_at'] }}</td>
                    </tr>
                    </table><br>
                    <a href="/myPosts">Show my posts</a><br>
                    <a href="/feed">Show me all posts</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection