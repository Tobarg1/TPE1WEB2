<?php

require_once './app/views/productView.php';
require_once './app/models/ViajesModel.php';
require_once  './app/views/errorView.php';

class productController {
   private $prodView;
   private $viajeModel;
   private $errorView;

   public function __construct(){
   $this->prodView = new productView();
   $this->viajeModel = new ViajesModel();
   $this->errorView = new errorView();
  }

  public function showViajes() {
    $viajes = $this->viajeModel->obtenerTodosViajes();
    $categories = $this->viajeModel->getCategories(); 
    $this->prodView->listProducts($viajes, $categories);
}


public function showViajesId($id) {
    $viaje = $this->viajeModel->obtenerViajeId($id);

    if ($viaje) {
        $this->prodView->showDetails($viaje);
    } else {
        $this->errorView->showError("El viaje no existe.");
    }
}
public function filterByCategory() {
    $categories = $this->viajeModel->getCategories(); 
    if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
        $viajes = $this->viajeModel->getItemsByCategory($categoryId);
    } else {
        $viajes = $this->viajeModel->obtenerTodosViajes();
    }
    $this->prodView->listProducts($viajes, $categories);
}



public function addProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['origen']) && !empty($_POST['destino']) && !empty($_POST['fecha_viaje']) && !empty($_POST['id_colectivo']) && !empty($_POST['category_id'])) {
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $fecha_viaje = $_POST['fecha_viaje'];
            $id_colectivo = $_POST['id_colectivo'];
            $category_id = $_POST['category_id'];

            $this->viajeModel->agregarViaje($origen, $destino, $fecha_viaje, $id_colectivo, $category_id);
            header('Location: ' . BASE_URL . 'panel-admin');
        } else {
            $this->errorView->showError("Complete todos los campos");
        }
    } else {
        $this->prodView->showFormAdd();
    }
}


   public function eliminarViaje($id){
      $this->viajeModel-> eliminarViaje($id);
      header('Location: ' . BASE_URL . 'panel-admin');
   }
   public function actualizarViaje($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['origen']) && !empty($_POST['destino']) && !empty($_POST['fecha_viaje']) && !empty($_POST['id_colectivo']) && !empty($_POST['category_id'])) {
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $fecha_viaje = $_POST['fecha_viaje'];
            $id_colectivo = $_POST['id_colectivo'];
            $category_id = $_POST['category_id'];

            $this->viajeModel->actualizarViaje($origen, $destino, $fecha_viaje, $id_colectivo, $category_id, $id);
            header('Location: ' . BASE_URL . 'panel-admin');
        } else {
            $this->errorView->showError("Complete todos los campos");
        }
    } else {
        $viaje = $this->viajeModel->obtenerViajeId($id);
        $this->prodView->showFormUpdate($viaje);
    }
}

}
