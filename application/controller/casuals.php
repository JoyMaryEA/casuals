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
}