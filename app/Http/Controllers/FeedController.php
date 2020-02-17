<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;

class FeedController extends Controller
{   
    /**
     * Pulls all posts from the API and redirects to the feed view
     * in order to display the data.
     * 
     * @param Request
     * @return void
     * 
     */
    function index(Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/posts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        $posts = json_decode($response->getBody(), true);
        return view('feed', ['posts' => $posts]);

    }
}
