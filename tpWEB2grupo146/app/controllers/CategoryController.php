<?php
require_once './app/models/CategoryModel.php';
require_once './app/views/CategoryView.php';

class CategoryController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
    }

    public function showCategories() {
        $categories = $this->model->getCategories();
        $this->view->listCategories($categories);
    }

    public function showItemsByCategory($categoryId) {
        $categories = $this->model->getCategories();
        $validCategoryIds = array_column($categories, 'id');
    
        if (!in_array($categoryId, $validCategoryIds)) {
            $this->view->listItemsByCategory([]);
            return;
        }
        $items = $this->model->getItemsByCategory($categoryId);
        $this->view->listItemsByCategory($items);
    }
    

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $this->model->insertCategory($name);
            header('Location: ' . BASE_URL . 'categories');
        } else {
            $this->view->showAddCategoryForm();
        }
    }

    public function deleteCategory($categoryId) {
        $this->model->deleteCategory($categoryId);
        header('Location: ' . BASE_URL . 'categories');
    }

    public function editCategory($categoryId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $this->model->updateCategory($categoryId, $name);
            header('Location: ' . BASE_URL . 'categories');
        } else {
            $category = $this->model->getCategory($categoryId); 
            if ($category) {
                $this->view->showEditCategoryForm($category);
            } else {
                echo "Error: Categoría no encontrada.";
            }
        }
    }
    
}
