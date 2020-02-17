<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;

class DashboardController extends Controller
{   
    /**
     * Pulls the user data of the current user from the API.
     * Redirects to the users dashboard in order to display the data.
     * 
     * @param Request
     * @return void
     */
    function index(Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        $user = json_decode((string) $response->getBody(), true);
        return view('dashboard', ['user' => $user]);
    }
}
