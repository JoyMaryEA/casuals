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
                $expireAfter = 30; 
                    if (isset($_SESSION['last_action'])) {
                       $secondsInactive = time() - $_SESSION['last_action'];
                       $expireAfterSeconds = $expireAfter;
                            if ($secondsInactive >= $expireAfterSeconds) {
                                    session_unset();
                                    session_destroy();
                                    header("Location: login/index.php"); exit; 
                                }
                    }

                $_SESSION['last_action'] = time();
               
                if (!empty($_SESSION["userId"]) && !empty($_SESSION["role"])){
                    
                        header('location: ' . URL . 'casuals/dashboard'  );
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
    require APP . 'view/login/index.php';
    }
}