<?php
class AuthView{
    public function showLogin($error = ''){
      require "./templates/form_login.phtml";
      }

      public function showAdminPanel($viajes){
        require './templates/panelAdmin.phtml';
    }
}
