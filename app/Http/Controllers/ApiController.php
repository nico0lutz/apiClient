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
        $accessToken = Storage::get('access_token.txt');

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
        $accessToken = session('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/posts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

}
