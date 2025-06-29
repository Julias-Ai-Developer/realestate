<?php
$request = $_SERVER['REQUEST_URI'];

// Remove query string and leading/trailing slashes
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');

// Simple routing logic
switch ($path) {
    case '':
        require 'views/homepage.php';
        break;
    case 'homepage':
        require 'views/homepage.php';
        break;

    case 'tenants/view':
        require 'views/admin.php';
        break;

    case 'tenants/create':
        require 'views/addtenant.php';
        break;

    case 'tenants/save':
        require 'app/storetenants.php';
        break;

    // ....edit--
    case 'tenants/editView':
        require 'views/edit-view.php';
        break;

    case 'tenants/edit':
        require 'app/edit-tenants.php';
        break;

    case 'tenants/delete':
        require 'app/delete-tenants.php';
        break;

    case 'tenants/delete-views':
        require 'views/delete-views.php';
        break;

    case 'contact':
        require 'views/contact.php';
        break;

    case 'tests':
        require 'views/toaster.php';
        break;
    case 'checks':
        require 'views/test.php';
        break;

    case 'login':
        require 'app/login.php';
        break;
    case 'logout':
        require 'app/logout.php';
        break;
    case 'main':
        require 'partials/main.php';
        break;
    case 'error':
        require 'views/error.php';
        break;
    default:
        http_response_code(404);
          header('Location:/error');
        break;
}
