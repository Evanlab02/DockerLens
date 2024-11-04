<?php

namespace App\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;

class ContainerClient
{
    private $client;

    public function __construct()
    {
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);

        $this->client = new Client([
            'base_uri' => 'http://host.docker.internal:2375/v1.47/', // Base URI for Docker API
            'handler' => $stack,
        ]);
    }

    public function getAllContainers()
    {
        try {
            // Sending a GET request to the Docker API to retrieve all containers
            $response = $this->client->get('containers/json');

            // Return the response body as an array
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [];
        }
    }
}
