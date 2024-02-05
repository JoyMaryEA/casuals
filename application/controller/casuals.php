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


        $countries = $this->model->getAllstr("country");
        $programs =  $this->model->getAllstr("program");
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
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

        $countries = $this->model->getAllstr("country");
        $programs =  $this->model->getAllstr("program");

        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
        
        if (isset($_POST["submit_search"])) {

            $search_str= trim($_POST["search_str"]);
            $casuals = $this->model->search($search_str);
          
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
        $countries = $this->model->getAllstr("country");
        $programs =  $this->model->getAllstr("program");
       $institutions= $this->model->getAllstr("institution");
       $kcse_results = $this->model->getAllstr("kcse_results");
        $qualifications = $this->model->getAllstr("qualification");
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

                    $middle_name = !empty($_POST["middle_name"]) ?  $this->properCase($_POST["middle_name"]) : null;
                    $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $this->phoneEdit($_POST["alt_phone_no"],$_POST["country"]) : null;
                    $comment = !empty($_POST["comment"]) ?  $this->properCase($_POST["comment"] ): null;
                    $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
                    $specialization = !empty($_POST["specialization"]) ?  $this->properCase($_POST["specialization"] ): null;
                    $qualification = !empty($_POST["qualification"]) ? $_POST["qualification"] : null;
                    $institution = !empty($_POST["institution"]) ? $_POST["institution"] : null;

                    $phone_number= $this->phoneEdit($_POST["phone_no"],$_POST["country"]);
                    //CHECK IF IT EXISTS FIRST 
                    $existingCasual = $this->model->getExistingCasual($phone_number,$_POST["id_no"]);
                    if (!empty($existingCasual)){
                        $msg= "Error, this casual already exists";
                    }
                    else{
                    $msg = $this->model->insertCasual( $_POST["country"], $_POST["program"], $_POST["first_name"], $middle_name, $_POST["last_name"], $_POST["id_no"], $phone_number, $alt_phone_no, $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $qualification, $institution, $specialization 
                    
               
                );}
                if(!empty($msg)){ 
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
                    $this->model->newAudit($casual_id,$action, $user_id);
                }

              

              header('location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
            } 
        }
      
    
       
    }

    public function editCasual() {

        // if (isset($_POST["submit_edit_casual"])) {

            $middle_name = !empty($_POST["middle_name"]) ? $this->properCase($_POST["middle_name"]) : null;
            $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $this->phoneEdit($_POST["alt_phone_no"],$_POST["country"]) : null;
            $comment = !empty($_POST["comment"]) ?  $this->properCase($_POST["comment"]) : null;
            $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
            $specialization = !empty($_POST["specialization"]) ?  $this->properCase($_POST["specialization"]) : null;
            $qualification = !empty($_POST["qualification"]) ? $_POST["qualification"] : null;
            $institution = !empty($_POST["institution"]) ? $_POST["institution"] : null;

            $msg =  $this->model->editCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"],$middle_name, $_POST["last_name"], $_POST["id_no"], $_POST["phone_no"], $_POST["alt_phone_no"], $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $qualification, $institution, $specialization  );
            
               if(!empty($msg)){
               
                header('Location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
              }else{
                header('location: ' . URL . '/users/login');
              }
             
            //}
        
           
            
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

    function phoneEdit(&$phone, $country) {
        $phone = trim($phone); 
        $phone = ltrim($phone, '0'); 
    
        $countries = $this->model->getCountryCode();
    
        foreach ($countries as $countryInfo) {
            if ($countryInfo->id == $country) {
                $phoneCode = $countryInfo->phone_code;
                break;
            }
        }
        if (strpos($phone, $phoneCode) !== 0) {
       
            $phone = $phoneCode . $phone;
        }
    
        return $phone;
    }
    
    
    
    private function isValidPhoneNumber($phone) {
        $valid_prefixes = ["01", "07", "06"];
        $prefix = substr($phone, 0, 2);
        $numeric_part = substr($phone, 2);
    
        return in_array($prefix, $valid_prefixes) && ctype_digit($numeric_part) && strlen($numeric_part) === 8;
    }
  
    function properCase($str) {
        $str = trim($str);
        $str = ucwords(strtolower($str));
    
        return $str;
    }

    public function insertReturnCasual(){
        $programs =  $this->model->getAllstr("program");
        if (isset($_POST["submit_return_casual"])) {
          

            $casual = $this->model->getCasual(trim($_POST["casual_id"])); 
            if (!empty($casual)) {
                $msg = $this->model ->insertReturnCasual(trim($_POST["casual_id"]),trim($_POST["program"]), trim($_POST["duration_worked"]), trim($_POST["year_worked"]));
              } else{
                $msg = "Error This casual does not exist, insert a new record instead";
              }
              header('Location: ' . URL . '/casuals/insertReturnCasual?message=' . urlencode($msg));
        }



        require APP . 'view/_templates/header.php';

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
        require APP . 'view/casuals/return_casual.php';
        require APP . 'view/_templates/footer.php';
    }
       

}



