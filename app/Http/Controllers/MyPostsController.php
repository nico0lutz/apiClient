<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Storage;

use Illuminate\Http\Request;

class MyPostsController extends Controller
{   
    /**
     * Pulls all posts owned by the current user 
     * from an API and redirects to the myPosts view
     * in order to display them
     * 
     * @param Request
     * @return void
     */
    function index (Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/myPosts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        $myPosts = json_decode($response->getBody(), true);
        return view('myPosts', ['myPosts' => $myPosts]);
    }
}
