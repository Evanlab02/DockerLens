<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <title>Containers</title>

    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/components/SideMenu.css" rel="stylesheet">
    <link href="/css/components/NavMenu.css" rel="stylesheet">
</head>

<body>
    <?php include("../components/SideMenu.php"); ?>
    <?php include("../components/NavMenu.php"); ?>
    <div class="dk-content">
        <h1>Containers</h1>
        <?php
        require '../vendor/autoload.php';

        use GuzzleHttp\Client;
        use GuzzleHttp\Handler\CurlHandler;
        use GuzzleHttp\HandlerStack;

        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);

        // Set up Guzzle to use the Unix socket
        $client = new Client([
            'base_uri' => 'http://host.docker.internal:2375/v1.47/', // Base URI for Docker API
            'handler' => $stack,
        ]);

        try {
            // Make a GET request to the Docker API to list images
            $response = $client->request('GET', 'containers/json');

            // Print response
            echo $response->getBody();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        ?>
    </div>
    <script src="/js/base.js"></script>
    <script src="/js/components/Menus.js"></script>
</body>

</html>