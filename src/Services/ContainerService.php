<?php

namespace App\Services;

use App\Clients\ContainerClient;
use App\Models\Container;

class ContainerService
{
    private $client;

    public function __construct()
    {
        $this->client = new ContainerClient();
    }

    public function getContainers()
    {
        $data = $this->client->getAllContainers();

        $containers = array_map(function ($item) {
            return new Container($item['Id'], $item['Names'][0], $item["Image"], $item["State"], $item['Status']);
        }, $data);

        return $containers;
    }
}
