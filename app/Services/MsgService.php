<?php

namespace App\Services;

use GuzzleHttp\Client;

class MsgService
{
    public function send($param)
    {
        $header = [
            'headers' => [
                'X-LC-Id' => env('LC_APP_ID'),
                'X-LC-Key' => env('LC_APP_KEY'),
                'Content-Type' => 'application/json'
            ]
        ];

        $http = new Client($header);
        $response = $http->request('post', env('LC_REQUEST_URL'), $param);
        $code = $response->getStatusCode();
        return $code;
    }
}