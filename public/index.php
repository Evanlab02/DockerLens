<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <title>Docker Status</title>

    <link href="./assets/css/base.css" rel="stylesheet">
    <link href="./assets/css/components/SideMenu.css" rel="stylesheet">
    <link href="./assets/css/components/NavMenu.css" rel="stylesheet">
</head>

<body>
    <div class="dk-side-menu-wrapper">
        <div id="dk-side-menu" class="dk-side-menu">
            <a href="javascript:void(0)" class="dk-side-menu-close" onclick="closeSideNav()">&times;</a>
            <a href="/">Home</a>
            <a href="/containers">Containers</a>
        </div>
    </div>
    <div class="dk-nav-menu-wrapper">
        <nav id="dk-nav-menu" class="dk-nav-menu">
            <a href="javascript:void(0)" class="dk-side-menu-open" onclick="openSideNav()">Menu</a>
        </nav>
    </div>
    <div class="dk-content">
        <?php
        require_once __DIR__ . '/../vendor/autoload.php';

        use App\Controllers\ContainerController;
        use App\Controllers\OverviewController;

        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if ($uri === '') {
            $controller = new OverviewController();
            $controller->index();
        } else if ($uri === 'containers') {
            $controller = new ContainerController();
            $controller->index();
        } else {
            echo "404 Not Found";
        }
        ?>
    </div>
    <script src="./assets/js/base.js"></script>
    <script src="./assets/js/components/Menus.js"></script>
</body>

</html>