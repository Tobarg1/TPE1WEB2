<?php
class CategoryView {
    public function listCategories($categories) {
        require './templates/categoryList.phtml';
    }

    public function listItemsByCategory($items) {
        require './templates/itemsByCategory.phtml';
    }

    public function showAddCategoryForm() {
        require './templates/addCategory.phtml';
    }

    public function showEditCategoryForm($category) {
        require './templates/editCategory.phtml';
    }
}
