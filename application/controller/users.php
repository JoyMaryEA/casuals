<?php

class Users extends Controller {
    public function login(){
        
        require APP . 'view/login/index.php';

        if (isset($_POST["Login"])) {
            
            
              $user_logged_in = $this->model->login($_POST["email"], $_POST["password"]);
             if (empty($user_logged_in)) {
                $no_user = 'Incorrect Email or Password'; //error msg
                header('location: ' . URL . 'users/login/index');
                exit;
            } else {
                session_start();
                $_SESSION["userId"] = $user_logged_in->u_id;
                $_SESSION["role"] = strval($user_logged_in->role);
               
                if (!empty($_SESSION["userId"]) && !empty($_SESSION["role"])){
                    
                        header('location: ' . URL . 'casuals/filter'  );
                        exit;
                    
                }
                
            }
         }

    }
    public function logout(){
        session_start();
    $_SESSION["userId"] = "";
    $_SESSION["role"] = "";
    session_destroy();
    header("Location: login/index.php");
    }
}