<?php

class productView{

    public function listProducts($viajes, $categories) {
        require './templates/productList.phtml';
    }
    

    public function showDetails ($viaje){
     require "./templates/productDetail.phtml";
    }

    public function showFormAdd (){
        require "./templates/addProduct.phtml";
    }

    public function showFormDelete (){
        require "./templates/deleteProduct.phtml";
    }

    public function showFormUpdate ($viaje){
        require "./templates/updateProduct.phtml";
    }

}