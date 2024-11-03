<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

function getContainers()
{
    $handler = new CurlHandler();
    $stack = HandlerStack::create($handler);

    $client = new Client([
        'base_uri' => 'http://host.docker.internal:2375/v1.47/', // Base URI for Docker API
        'handler' => $stack,
    ]);

    // Make a GET request to the Docker API to list containers
    $response = $client->request('GET', 'containers/json');

    $containers =  json_decode($response->getBody(), true);
    return $containers;
}

function createRows($containers)
{
    // Loop through each container and display relevant information
    foreach ($containers as $container) {
        echo "<tr>";
        echo "<td><a href='/pages/container.php?Id=" . $container['Id'] . "'>" . $container['Names'][0] . "</a></td>";
        echo "<td>" . $container["Image"] . "</td>";
        echo "<td>" . $container["State"] . "</td>";
        echo "<td>" . $container["Status"] . "</td>";
        echo "</tr>";
    }
}

$containers = null;

try {
    $containers = getContainers();
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
?>

<table>
    <thead>
        <tr>
            <th class="table-align-left">Name</th>
            <th class="table-align-left">Image</th>
            <th class="table-align-left">State</th>
            <th class="table-align-left">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        createRows($containers);
?>
    </tbody>
</table>