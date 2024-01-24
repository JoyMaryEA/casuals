<?php
session_start();

if (empty($_SESSION["userId"]) && empty($_SESSION["role"])){
                    
    header('location: ' . URL . 'users/login'  );
    exit;

}
$expireAfter = 60; 
if (isset($_SESSION['last_action'])) {
    $secondsInactive = time() - $_SESSION['last_action'];

    $expireAfterSeconds = $expireAfter;
    if ($secondsInactive >= $expireAfterSeconds) {
        
        session_unset();
        session_destroy();
        header('location: ' . URL . '/users/login'); exit; 
    }

}
$_SESSION['last_action'] = time();
?>