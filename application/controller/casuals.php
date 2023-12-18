<?php

class Casuals extends Controller{

    public function index()
    {
        $casuals = $this->model->getAllCasuals();
        
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function filter(){
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
        require APP . 'view/_templates/footer.php';

        //TODO: DIFFERENT QUERIES FOR COUNTRY ONLY OR PROGRAM ONLY
        if (isset($_POST["submit_filter"])) {
           $casuals= $this->model->filter($_POST["country"], $_POST["program"]);
            require APP . 'view/casuals/index.php';
        }
       
    }
}