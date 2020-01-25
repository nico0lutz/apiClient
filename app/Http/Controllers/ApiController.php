<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;

class ApiController extends Controller
{
    function getCurrUser(Request $request)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    function posts(Request $request)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/posts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    function myPosts(Request $request)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/myPosts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        var_dump('Hello');

        return json_decode($response->getBody(), true);
    }


    function addPost(Request $request)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');
        $params = ['title' => $request->title, 'content' => $request->content];

        $response = $client->request('POST', 'http://localhost:8000/api/addPost', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
            'form_params' => $params,
        ]);

        //return json_decode((string) $response->getBody(), true);
        return redirect('profile');
    }

    function editPost(Request $request)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');
        $params = ['id' => $request->id, 'title' => $request->title, 'content' => $request->content];

        $response = $client->request('PUT', 'http://localhost:8000/api/editPost', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
            'form_params' => $params,
        ]);

        // return json_decode((string) $response->getBody(), true);
        return redirect('profile');
    }

    function deletePost(Request $request, $id)
    {
        $client = new Client;
        //$accessToken = session('access_token');
        $accessToken = Storage::get('access_token');

        $response = $client->request('delete', 'http://localhost:8000/api/deletePost/'.$id, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);

        // return json_decode((string) $response->getBody(), true);
        return redirect('profile');
    }

}
