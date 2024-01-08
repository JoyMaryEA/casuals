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
        $countries = $this->model->getAllCountries();
        $programs =  $this->model->getAllPrograms();
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
             //TODO: DIFFERENT QUERIES FOR COUNTRY ONLY OR PROGRAM ONLY
        if (isset($_POST["submit_filter"])) {
            $casuals= $this->model->filter($_POST["country"], $_POST["program"]);
            
             require APP . 'view/casuals/index.php';
             require APP . 'view/_templates/footer.php';
         }

        
       
    }
    
 

    public function search()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
        
        if (isset($_POST["submit_search"])) {
            $casuals = $this->model->search($_POST["search_str"]);
             require APP . 'view/casuals/index.php';
             require APP . 'view/_templates/footer.php';
         }
    }

    public function casualDetails($casual_id){


        $casual = $this->model->getCasual($casual_id); 
 

    }

    public function addCasual($casual_id = NULL){
        $casual = $this->model->getCasual($casual_id);
       $countries = $this->model->getAllCountries();
       $programs =  $this->model->getAllPrograms();
       $institutions= $this->model->getAllInstitutions();
       $kcse_results = $this->model->getAllKcse();
        $qualifications = $this->model->getAllQualifications();

        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/add_casual.php';
        require APP . 'view/_templates/footer.php';

          if (!empty($casual)){
            if (isset($_POST["submit_add_casual"])) {

                $isChecked = isset($_POST['not_available']) && (int)$_POST['not_available'] === 0;  //CHECK LOGIC
                    
                $this->model->editCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"], $_POST["middle_name"], $_POST["last_name"], $_POST["id_no"], $_POST["phone_no"], $_POST["alt_phone_no"], $_POST["year_worked"], $_POST["duration_served"], $_POST["comment"], $_POST["kcse_results"], $_POST["qualification"], $_POST["institution"], $_POST["year_graduated"], $isChecked
            );
            }
          } else{
            if (isset($_POST["submit_add_casual"])) {

                $isChecked = isset($_POST['not_available']) && (int)$_POST['not_available'] === 0;  //CHECK LOGIC
                    
                $this->model->insertCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"], $_POST["middle_name"], $_POST["last_name"], $_POST["id_no"], $_POST["phone_no"], $_POST["alt_phone_no"], $_POST["year_worked"], $_POST["duration_served"], $_POST["comment"], $_POST["kcse_results"], $_POST["qualification"], $_POST["institution"], $_POST["year_graduated"], $isChecked
            );
            }
        }
        
    }

    public function deleteCasual($casual_id){
       
        if (isset($casual_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteCasual($casual_id);
        }
        else{
            require APP . 'view/_templates/footer.php';
        }
  
    }

    public function editCasual() {
        $casual = $this->model->getCasual($casual_id); 
       $countries = $this->model->getAllCountries();
       $programs =  $this->model->getAllPrograms();
       $institutions= $this->model->getAllInstitutions();
       $kcse_results = $this->model->getAllKcse();
        $qualifications = $this->model->getAllQualifications();

        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/add_casual.php';
        require APP . 'view/_templates/footer.php';
    }
}