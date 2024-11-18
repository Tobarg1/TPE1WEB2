<?php
session_start();
require_once "./libs/response.php";
require_once "./app/middlewares/sessionAuthMiddleware.php";
require_once "./app/controllers/ControllerHome.php";
require_once "./app/controllers/productController.php";
require_once "./app/controllers/AuthController.php";

define ('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

switch($params[0]){
    case 'home':
        $controller = new HomeController();
        $controller -> showHome();
        break;
    case 'products-list':
        $controller = new productController();
        $controller->showViajes();
        break;
    case 'product-details':
        $controller = new productController();
        $controller->showViajesId($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'panel-admin':
        sessionAuthMiddleware($res, 'admin');
        $controller = new AuthController();
        $controller ->showPanel();
        break;
    case 'add-product':
        sessionAuthMiddleware($res);
        $controller = new productController();
        $controller->addProduct();
        break;
    case 'delete-product':
        sessionAuthMiddleware($res);
        $controller = new productController();
        $controller->eliminarViaje($params[1]);
        break;
    case 'update-product':
        sessionAuthMiddleware($res);
        $controller = new productController();
        $controller->actualizarViaje($params[1]);
        break;  
    case 'categories':
        $controller = new CategoryController();
        $controller->showCategories();
        break;
    case 'items-by-category':
        $controller = new CategoryController();
        $controller->showItemsByCategory($params[1]);
        break;
    case 'filter-products':
        $controller = new productController();
        $controller->filterByCategory();
        break;
        
    case 'add-category':
        $controller = new CategoryController();
        $controller->addCategory();
        break;
    case 'edit-category':
        $controller = new CategoryController();
        $controller->editCategory($params[1]);
        break;
    case 'delete-category':
        $controller = new CategoryController();
        $controller->deleteCategory($params[1]);
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
               
    }
    
