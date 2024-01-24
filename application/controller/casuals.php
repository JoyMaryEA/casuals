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
            if (strpos($msg, 'Error') === 0) {
                echo '<div class="alert alert-danger" id="errorAlert" role="alert">
                          <strong>Error!</strong>' . $msg . '
                      </div>';
            } else {
                echo '<div class="alert alert-success" id="successAlert" role="alert">
                          <strong>Success!</strong>' . $msg . '
                      </div>';
            }
        }
       
    }
    
 

    public function search()
    {


        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
        
        if (isset($_POST["submit_search"])) {

            $search_str= trim($_POST["search_str"]);
            $casuals = $this->model->search($search_str);
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
        if (empty($casual)){
            if (isset($_POST["submit_add_casual"])) {
                 
                
                
                if (empty($_POST["first_name"] ) || empty($_POST["last_name"]) || empty($_POST["id_no"]) || empty($_POST["phone_no"]) || empty($_POST["year_worked"]) || empty($_POST["duration_worked"])){
                    $required="this field is required";
                } elseif (
                    !($this->isValidPhoneNumber($_POST["phone_no"]) ||
                    (isset($_POST["alt_phone_no"]) && $this->isValidPhoneNumber($_POST["alt_phone_no"])))
                ) {
                    $wrong_phone = "Invalid phone number format";
                }
                else{
                    $first_name = trim($_POST["first_name"]);

                    $middle_name = !empty($_POST["middle_name"]) ?$_POST["middle_name"] : null;
                    $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $this->phoneEdit($_POST["alt_phone_no"],$_POST["country"]) : null;
                    $comment = !empty($_POST["comment"]) ? $_POST["comment"] : null;
                    $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
                    $year_graduated = !empty($_POST["year_graduated"]) ? $_POST["year_graduated"] : null;

                    $phone_number= $this->phoneEdit($_POST["phone_no"],$_POST["country"]);
                    
                    $msg = $this->model->insertCasual( $_POST["country"], $_POST["program"], $_POST["first_name"], $middle_name, $_POST["last_name"], $_POST["id_no"], $phone_number, $alt_phone_no, $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $_POST["qualification"], $_POST["institution"], $year_graduated 

               
                );
                if(!empty($msg)){
                    if (strpos($msg, 'Casual') === 0) {
                        session_start();
                        $user_id = $_SESSION["userId"];
                        $casual_id =$_POST["casual_id"];
                        $action = 1;
                        $this->model->insertAudit($casual_id, $action, $user_id);
                    }
                  
                   
                   header('location: ' . URL . '/casuals/addCasual?message=' . urlencode($msg));
                }
                }
          
           
            }
            if (isset($_GET['message'])) {
                $msg = urldecode($_GET['message']);
            
                if (strpos($msg, 'Error') === 0) {
                    echo '<div class="alert alert-danger" id="errorAlert" role="alert">
                              <strong>Error!</strong>' . $msg . '
                          </div>';
                } else {
                    echo '<div class="alert alert-success" id="successAlert" role="alert">
                              <strong>Success!</strong>' . $msg . '
                          </div>';
                }
            }
         }
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/add_casual.php';
        require APP . 'view/_templates/footer.php';


       
        
    }

    public function deleteCasual($casual_id){

        if (isset($casual_id)) {
            $msg = $this->model->deleteCasual($casual_id);
            if(!empty($msg)){
                if (strpos($msg, 'Casual') === 0) {
                    session_start();
                    $user_id = $_SESSION["userId"];
                    $action = 3;
                    $this->model->deleteAudit($casual_id,$action, $user_id);
                }

              

              header('location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
            } 
        }
      
    
       
    }

    public function editCasual() {

        if (isset($_POST["submit_edit_casual"])) {

            // if (empty($_POST["first_name"] ) || empty($_POST["last_name"]) || empty($_POST["id_no"]) || empty($_POST["phone_no"]) || empty($_POST["year_worked"]) || empty($_POST["duration_worked"])){
            //     $required="this field is required";
            // }
            // elseif (
            //     !($this->isValidPhoneEdited($_POST["phone_no"], $_POST["country"]) ||
            //     (isset($_POST["alt_phone_no"]) && $this->isValidPhoneEdited($_POST["alt_phone_no"], $_POST["country"])))
            // ) {
            //     $wrong_phone = "Invalid phone number format";
            // }
            // else{
                $first_name = trim($_POST["first_name"]);

                $middle_name = !empty($_POST["middle_name"]) ?$_POST["middle_name"] : null;
                $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $_POST["alt_phone_no"] : null;
                $comment = !empty($_POST["comment"]) ? $_POST["comment"] : null;
                $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
                $year_graduated = !empty($_POST["year_graduated"]) ? $_POST["year_graduated"] : null;

                //$phone_number= $this->phoneEdit($_POST["phone_no"],$_POST["country"]);
            
            $msg =  $this->model->editCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"], $middle_name, $_POST["last_name"], $_POST["id_no"],  $_POST["phone_no"], $alt_phone_no, $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $_POST["qualification"], $_POST["institution"], $year_graduated  );
            
               if(!empty($msg)){
                if (strpos($msg, 'Casual') === 0) {
                session_start();
                $user_id = $_SESSION["userId"];
                $casual_id =$_POST["casual_id"];
               
                $this->model->updateAudit($casual_id,$user_id);
                }
                
  
                header('location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
              }
            }
       // }
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

    function phoneEdit($phone,$country){
        $phone = substr($phone, 1);
        $countries = $this->model->getAllCountries();

        foreach ($countries as $countryInfo) {
            if ($countryInfo->id == $country) {
                $phone = $countryInfo->phone_code . $phone;
                break;
            }
        }
        return $phone;
    }
    private function isValidPhoneNumber($phone) {
        $valid_prefixes = ["01", "07", "06"];
        $prefix = substr($phone, 0, 2);
        $numeric_part = substr($phone, 2);
    
        return in_array($prefix, $valid_prefixes) && ctype_digit($numeric_part) && strlen($numeric_part) === 8;
    }
    function isValidPhoneEdited($phone, $countries) {
        $valid_prefixes = [];
    
        $countries = $this->model->getAllCountries();
        foreach ($countries as $countryInfo) {
            $valid_prefixes[] = $countryInfo->phone_code;
        }
    
        $prefix = substr($phone, 0, 2);
        $numeric_part = substr($phone, 2);
    
        return in_array($prefix, $valid_prefixes) && ctype_digit($numeric_part) && strlen($numeric_part) === 8;
    }
    

}