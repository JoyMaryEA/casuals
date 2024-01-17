<?php

class Casuals extends Controller{

    public function index()
    {
       $casuals = $this->model->getAllCasuals();
        if (isset($casual_id)) {
            $editAudit=  $this->model->getEditAudit($casual_id);
            $insertAudit =  $this->model->getInsertAudit($casual_id);
          }
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

       
            $casuals= $this->model->filterCountryProgram($_POST["country"], $_POST["program"]);
                  
         require APP . 'view/casuals/index.php';
         require APP . 'view/_templates/footer.php';
         }

         if (isset($_GET['message'])) {
            $msg = urldecode($_GET['message']);
            echo '<div class="alert alert-success" role="alert">
                      <strong>Success!</strong>' . $msg . '
                  </div>';
        }
       
    }
    
 

    public function search()
    {


        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
        
        if (isset($_POST["submit_search"])) {
            $casuals = $this->model->search($_POST["search_str"]);
            if (isset($casual_id)) {
                $editAudit=  $this->model->getEditAudit($casual_id);
                $insertAudit =  $this->model->getInsertAudit($casual_id);
              }
             require APP . 'view/casuals/index.php';
             require APP . 'view/_templates/footer.php';
         }
    }

    public function casualDetails($casual_id){


        $casual = $this->model->getCasual($casual_id); 
        if (isset($casual_id)) {
            $editAudit=  $this->model->getEditAudit($casual_id);
            $insertAudit =  $this->model->getInsertAudit($casual_id);
          }

    }

    public function addCasual($casual_id = NULL){
        $errors = [];
        $casual = $this->model->getCasual($casual_id);
       $countries = $this->model->getAllCountries();
       $programs =  $this->model->getAllPrograms();
       $institutions= $this->model->getAllInstitutions();
       $kcse_results = $this->model->getAllKcse();
        $qualifications = $this->model->getAllQualifications();

        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/add_casual.php';
        require APP . 'view/_templates/footer.php';


         if (empty($casual)){
            if (isset($_POST["submit_add_casual"])) {
                  
                $first_name = trim($_POST["first_name"]);
                
                if (empty($_POST["first_name"])){
                    $required="this field is required";

                } 
                else{
                    $msg = $this->model->insertCasual( $_POST["country"], $_POST["program"], $_POST["first_name"], $_POST["middle_name"], $_POST["last_name"], $_POST["id_no"], $_POST["phone_no"], $_POST["alt_phone_no"], $_POST["year_worked"], $_POST["duration_served"], $_POST["comment"], $_POST["kcse_results"], $_POST["qualification"], $_POST["institution"], $_POST["year_graduated"]

               
                );
                if(!empty($msg)){
                   session_start();
                   $user_id = $_SESSION["userId"];
                   $casual_id =$_POST["casual_id"];
                   $action = 1;
                   $this->model->insertAudit($casual_id, $action, $user_id);
                   
                   header('location: ' . URL . '/casuals/addCasual?message=' . urlencode($msg));
                }
                }
          
           
            }
            if (isset($_GET['message'])) {
                $msg = urldecode($_GET['message']);
                echo '<div class="alert alert-success" role="alert">
                          <strong>Success!</strong>' . $msg . '
                      </div>';
            }
         }
        
    }

    public function deleteCasual($casual_id){

        if (isset($casual_id)) {
            $msg = $this->model->deleteCasual($casual_id);
            if(!empty($msg)){
                

              session_start();
              $user_id = $_SESSION["userId"];
              $action = 3;
              $this->model->deleteAudit($casual_id,$action, $user_id);

              header('location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
            }
            else{
                echo '<div class="alert alert-success" role="alert">
              <strong>Error!</strong> error deleting user
              </div>  
              <script>$(".alert").alert("close"); </script>'; 
            }

           
        }
      
    
       
    }

    public function editCasual() {

        if (isset($_POST["submit_edit_casual"])) {

                $isChecked = isset($_POST['not_available']) && (int)$_POST['not_available'] === 0;  //CHECK LOGIC
                session_start();
                $user_id = $_SESSION["userId"];
                $casual_id =$_POST["casual_id"];
               
                $this->model->updateAudit($casual_id,$user_id);

                $this->model->editCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"], $_POST["middle_name"], $_POST["last_name"], $_POST["id_no"], $_POST["phone_no"], $_POST["alt_phone_no"], $_POST["year_worked"], $_POST["duration_served"], $_POST["comment"], $_POST["kcse_results"], $_POST["qualification"], $_POST["institution"], $_POST["year_graduated"]


            );
          
            
            }
            header('location: ' . URL . '/casuals/filter');

    }

    public function audit($casual_id){
        if (isset($casual_id)) {
          $editAudit=  $this->model->getEditAudit($casual_id);
          $insertAudit =  $this->model->getInsertAudit($casual_id);
        }
    }

    public function getCasualId() {
        $country = intval($_POST['country']);
        $program = intval($_POST['program']);
        $lastCasualId=  $this->model->getCasualId($country,$program);
        $lastCasualId++;
        header('Content-Type: application/json');
        echo json_encode(['max_casual_id' => $lastCasualId]);
        exit();
    }


}