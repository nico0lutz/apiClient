<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use InvalidArgumentException;
use GuzzleHttp\Client;
use Storage;


class ApiLoginController extends Controller
{
    function login(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => 12,
            'redirect_uri' => 'http://localhost:8001/callback',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect('http://localhost:8000/oauth/authorize?'.$query);
    }

    function convertToAccessToken(Request $request)
    {
        $state = $request->session()->pull('state');

        /*throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );*/

        $http = new Client;

        $response = $http->post('http://localhost:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '12',
                'client_secret' => 'iVI7tpdiLYKUCijhbh9mm69M3g2cmwtaClH1Prxt',
                'redirect_uri' => 'http://localhost:8001/callback',
                'code' => $request->code,
            ],
        ]);
        
        $body = json_decode((string) $response->getBody(), true);
        $access_token = $body['access_token'];
        
        Storage::put('access_token.txt', $access_token);    

    }
}
