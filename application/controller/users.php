<?php

class Users extends Controller {
    public function login(){
        require APP . 'view/login/index.php';

        if (isset($_POST["Login"])) {
             $user_logged_in = $this->model->login($_POST["email"], $_POST["password"]);
             if (empty($user_logged_in)) {
                $no_user = 'Incorrect Email or Password'; //error msg
                header('location: ' . URL . 'login/index');
            } else {
                if ($user_logged_in->role === 'admin'){
                    header('location: ' . URL . 'casuals/admin_home');
                } else{
                    header('location: ' . URL . 'casuals/filter');
                }
            }
         }

    }
}