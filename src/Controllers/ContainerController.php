<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Services\ContainerService;

class ContainerController
{
    private $service;
    private $twig;

    public function __construct()
    {
        $this->service = new ContainerService();

        $loader = new FilesystemLoader(__DIR__ . '/Templates');
        $this->twig = new Environment($loader);
    }

    public function index()
    {
        $containers = $this->service->getContainers();

        echo $this->twig->render('Containers/index.html.twig', [
            'containers' => $containers,
        ]);
    }
}
