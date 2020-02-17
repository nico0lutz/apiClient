<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;

class ApiController extends Controller
{   
    /**
     * Pulls the current user's data from the API.
     * 
     * @param Request
     * @return userData
     */
    function getCurrUser(Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');

        $response = $client->request('GET', 'http://localhost:8000/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ]
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Adds a post via API and returns to the myPosts view
     * 
     * @param Request
     */
    function addPost(Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');
        $params = ['title' => $request->title, 'content' => $request->content];

        $response = $client->request('POST', 'http://localhost:8000/api/addPost', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
            'form_params' => $params,
        ]);

        return redirect('myPosts');
    }

    /**
     * Edits a post via API with the parameters passed in the request
     * and returns to the myPosts view
     * 
     * @param Request
     */
    function editPost(Request $request)
    {
        $client = new Client;
        $accessToken = session('access_token');
        $params = ['id' => $request->id, 'title' => $request->title, 'content' => $request->content];

        $response = $client->request('PUT', 'http://localhost:8000/api/editPost', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
            'form_params' => $params,
        ]);

        return redirect('myPosts');
    }

    /**
     * Deletes a specified post via API and returns
     * to the myPosts view.
     * 
     * @param Request
     * @param id
     */
    function deletePost(Request $request, $id)
    {
        $client = new Client;
        $accessToken = session('access_token');

        $response = $client->request('delete', 'http://localhost:8000/api/deletePost/'.$id, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);

        return redirect('myPosts');
    }

}
