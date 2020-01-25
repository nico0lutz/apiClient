<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use InvalidArgumentException;
use GuzzleHttp\Client;
use Storage;
use App\User;
use Auth;


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
        $accessToken = $body['access_token'];

        //session(['access_token' => $access_token]);
        Storage::put('access_token', $accessToken);

        $this->loginApiUser();

        return redirect()->to('profile');
    }


    function loginApiUser()
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
        
        $conv_response= json_decode($response->getBody(), true);
        $name = $conv_response['name'];
        $email = $conv_response['email'];
        
        $userExist = User::where('email', $email)->first();

        if($userExist) {
            Auth::loginUsingId($userExist->id);
        }else {
            $user = new User;

            $user->name = $name;
            $user->email = $email;
            $user->password = md5(rand(1,10000));

            $user->save();

            Auth::loginUsingId($user->id);
        }
    }
}
