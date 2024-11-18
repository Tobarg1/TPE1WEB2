<?php



function sessionAuthMiddleware($res, $requiredRole = null) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['ID_USER'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->user = $_SESSION['USER'];

        if (isset($_SESSION['USER_ROLE'])) {
            $res->user->role = $_SESSION['USER_ROLE'];
        } else {
            $res->user->role = null;
        }
        return;
    } else {
        header('Location: ' . BASE_URL . 'showLogin');
        exit();
    }
}
