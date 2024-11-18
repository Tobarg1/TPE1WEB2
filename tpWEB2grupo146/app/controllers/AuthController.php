<?php

require_once './app/views/AuthView.php';
require_once './app/models/UserModel.php';
require_once  './app/views/errorView.php';

class AuthController {
    private $view;
    private $modelusu;
    private $modelViajes;

    public function __construct(){     
    $this->view = new AuthView();
    $this->modelusu = new UserModel();
    $this->modelViajes = new ViajesModel();
    }

    public function showLogin(){
        return $this->view->showLogin();
    }
    

    public function login() {
        if (empty($_POST['user'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        if (empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $user = $_POST['user'];
        $password = $_POST['password'];
    
        $userFromDB = $this->modelusu->getUser($user);
    
        if (!$userFromDB) {
            return $this->view->showLogin('El usuario no existe');
        }
    
        if ($password === $userFromDB->password) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['USER'] = $userFromDB->user;
            $_SESSION['USER_ROLE'] = $userFromDB->role;
    
            header('Location: ' . BASE_URL . 'panel-admin');
            exit();
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'home');
        exit();
    }
    
    
    public function showPanel(){
        $viajes = $this->modelViajes->obtenerTodosViajes();
        $this->view->showAdminPanel($viajes);
    }
}
