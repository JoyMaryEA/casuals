<?php

class Casuals extends Controller{

    public function index()
    {
        $casuals = $this->model->getAllCasuals();
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function filter(){

        
        
       
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
             //TODO: DIFFERENT QUERIES FOR COUNTRY ONLY OR PROGRAM ONLY
        if (isset($_POST["submit_filter"])) {
            $casuals= $this->model->filter($_POST["country"], $_POST["program"]);
             require APP . 'view/casuals/index.php';
             require APP . 'view/_templates/footer.php';
         }

        }else{
            $this->index();
        
        }

       
       
    }
    
    public function admin_home()
    {
        $casuals = $this->model->getAllCasuals();
     
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/admin_home.php';
        require APP . 'view/_templates/footer.php';
    }

    public function search()
    {
        require APP . 'view/_templates/header.php';

        if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
        require APP . 'view/casuals/filter.php';
        }
        if (isset($_POST["submit_search"])) {
            $casuals= $this->model->search($_POST["search_str"]);
            
             require APP . 'view/casuals/index.php';
             require APP . 'view/_templates/footer.php';
         }
    }

    public function casualDetails($casual_id){


        $casual = $this->model->getCasual($casual_id); 


    }
}