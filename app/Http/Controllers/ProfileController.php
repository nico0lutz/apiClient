<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Storage;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function index (Request $request)
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

        $myPosts = json_decode($response->getBody(), true);
        return view('profile', ['myPosts' => $myPosts]);
    }
}
