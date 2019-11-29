<?php

namespace App\Services;

use GuzzleHttp\Client;

class RequestService
{
    private $baseUrl = 'http://hnbex.eu/api/v1/rates/daily/';

    private $client;

    public function __construct() 
    {
        $this->client = new Client();
    }

    public function makeRequest($date) 
    {
        $response = $this->client->request(
            'GET', $this->baseUrl, ['query' => "date={$date}"]
        );

        return json_decode((string) $response->getBody());
    }
}
