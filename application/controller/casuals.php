<?php

class Casuals extends Controller{
          

    public function index()
    {
        $_SESSION['last_action'] = time();
        require APP . 'view/_templates/header.php';
       
        require APP . 'view/_templates/footer.php';
    }

    public function filter(){

        $_SESSION['last_action'] = time();
        $countries = $this->model->getAllstr("country");
        $programs =  $this->model->getAllstr("program");
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/filter.php';
            if (isset($_GET['message'])) {
                $msg = urldecode($_GET['message']);
                    if (strpos($msg, 'Error') === 0) {
                     echo '<div class="alert alert-danger" id="errorAlert" role="alert">
                        <strong>Error! </strong>' . $msg . '
                    </div>';
                       
                    } else {
                       echo '<div class="alert alert-success" id="successAlert" role="alert">
                                <strong>Success! </strong>' . $msg . '
                            </div>';
                    }
            }
       
    }
    
 public function filterAction(){
    $casuals= $this->model->filterCountryProgram($_POST["country"], $_POST["program"]);
    $results='';

        $countryName= 'all countries';
        $programName="all programs";
        if(!empty($_POST["country"])){
        $selectedCountryName=$this->model->getNameFromId($_POST["country"],'country');
        $countryName = $selectedCountryName->name;
        } 
        if(!empty($_POST["program"])){
        $selectedProgramName =$this->model->getNameFromId($_POST["program"],'program');
        $programName = $selectedProgramName->name;
        }
        $results = "Showing results for <strong>" . $countryName . "</strong> and <strong>" . $programName ."</strong>" ;   

    
    header('Content-Type: application/json'); 
        echo json_encode($casuals);
        exit;
      
  }
 

    public function search()
    {
        $_SESSION['last_action'] = time();
       
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/search.php';
       
    }

    public function searchAction(){
        $_SESSION['last_action'] = time();
        $search_str= trim($_POST["search_str"]);
        $casuals = $this->model->search($search_str);
        header('Content-Type: application/json'); 
        echo json_encode($casuals);
        exit;
    } 




    public function addCasual($casual_id = NULL){


        $countriesPhoneCode = $this->model->getCountryCode();
       $_SESSION['last_action'] = time();
       
            if (!empty($casual_id)){

                // getting variables needed to perform an edit on casuals and staff_programs table
                $casual = $this->model->getCasual($casual_id);
                $staffProgramsIdObj = $this->model->getStaffProgramsId($casual_id, $casual->program_id, $casual->duration_worked, $casual->year_worked);
            }
       $countries = $this->model->getAllstr("country");
       $programs =  $this->model->getAllstr("program");
       $institutions= $this->model->getAllstr("institution");
       $kcse_results = $this->model->getAllstr("kcse_results");
       $qualifications = $this->model->getAllstr("qualification");
       
        if (empty($casual)){
            if (isset($_POST["submit_add_casual"]))
            {
                
                if (empty($_POST["first_name"] ) || empty($_POST["last_name"]) || empty($_POST["id_no"]) || empty($_POST["phone_no"]) || empty($_POST["year_worked"]) || empty($_POST["duration_worked"]))
                {
                    $required="this field is required";
                } 
                else
                {
                    $first_name = trim($_POST["first_name"]);
                    $middle_name = !empty($_POST["middle_name"]) ?  $this->properCase($_POST["middle_name"]) : null;
                    $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $this->phoneEdit($_POST["alt_phone_no"],$_POST["alt_phone_country_code"]) : null;
                    $comment = !empty($_POST["comment"]) ?  $this->properCase($_POST["comment"] ): null;
                    $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
                    $specialization = !empty($_POST["specialization"]) ?  $this->properCase($_POST["specialization"] ): null;
                    $qualification = !empty($_POST["qualification"]) ? $_POST["qualification"] : null;
                    $institution = !empty($_POST["institution"]) ? $_POST["institution"] : null;
                    $phone_number= $this->phoneEdit($_POST["phone_no"],$_POST["phone_country_code"]);
                    //CHECK IF IT EXISTS FIRST 
                        $existingCasual = $this->model->getExistingCasual($phone_number,$_POST["id_no"]);
                        $existingCasualFirstName = $existingCasual-> first_name;
                        $existingCasualLastName = $existingCasual-> last_name;
                        $existingCasualProgram =$existingCasual-> program_name;
                        $existingCasualIdNo = !empty($existingCasual->id_no) ? $existingCasual->id_no : '[null]';
                        $existingCasualPhoneNo = !empty($existingCasual->phone_no) ? $existingCasual->phone_no : '[null]';
                            if (!empty($existingCasual))
                            {
                                $msg= `<p style='font-size:14px;'> Error, this casual already exists as: <strong> $existingCasualFirstName  $existingCasualLastName </strong> served in:<strong> $existingCasualProgram </strong> has National Id: <strong>$existingCasualIdNo </strong> and Phone Number:<strong> $existingCasualPhoneNo </strong> </p>`;
                            }
                            else
                            {
                            $msg = $this->model->insertCasual( $_POST["country"], $_POST["program"], $_POST["first_name"], $middle_name, $_POST["last_name"], $_POST["id_no"], $phone_number, $alt_phone_no, $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $qualification, $institution, $specialization 
                        );}
                            if(!empty($msg))
                            { 
                                header('location: ' . URL . '/casuals/addCasual?message=' . urlencode($msg));
                            }
                }
            }
            if (isset($_GET['message'])) {
                $msg = urldecode($_GET['message']);
            
                if (strpos($msg, 'Error') === 0) {
                    echo '<div class="alert alert-danger" id="errorAlert" role="alert">
                              <strong>Error! </strong>' . $msg . '
                          </div>';
                } else {
                    echo '<div class="alert alert-success" id="successAlert" role="alert">
                              <strong>Success! </strong>' . $msg . '
                          </div>';
                }
            }
         } 

        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/add_casual.php';
        require APP . 'view/_templates/footer.php';

    }

    public function deleteCasual($casual_id){
        $_SESSION['last_action'] = time();
        if (isset($casual_id)) 
        {
            $msg = $this->model->deleteCasual($casual_id);
                if(!empty($msg))
                {
                    if (strpos($msg, 'Casual') === 0) {
                        session_start();
                        $user_id = $_SESSION["userId"];
                        $action = 3;
                        $this->model->insertAudit($casual_id,$action, $user_id);
                    }
              header('location: ' . URL . '/casuals/filter?message=' . urlencode($msg));
            } 
        }
      
    
       
    }

    public function editCasual() {
        $_SESSION['last_action'] = time();
        $staffProgramsId = $_POST["staffProgramsId"];

        $countriesPhoneCode = $this->model->getCountryCode();

          //  $alt_phone_no = null; // buggy without setting it to null first
            $middle_name = !empty($_POST["middle_name"]) ? $this->properCase($_POST["middle_name"]) : null;
            $phone_no = !empty($_POST["phone_no"]) ? $this->phoneEdit($_POST["phone_no"],$_POST["phone_country_code"]) : null;
            $alt_phone_no = !empty($_POST["alt_phone_no"]) ? $this->phoneEdit($_POST["alt_phone_no"],$_POST["alt_phone_country_code"]) : null;
            $comment = !empty($_POST["comment"]) ?  $this->properCase($_POST["comment"]) : null;
            $kcse_results = !empty($_POST["kcse_results"]) ? $_POST["kcse_results"] : null;
            $specialization = !empty($_POST["specialization"]) ?  $this->properCase($_POST["specialization"]) : null;
            $qualification = !empty($_POST["qualification"]) ? $_POST["qualification"] : null;
            $institution = !empty($_POST["institution"]) ? $_POST["institution"] : null;

            $msg =  $this->model->editCasual($_POST["casual_id"], $_POST["country"], $_POST["program"], $_POST["first_name"],$middle_name, $_POST["last_name"], $_POST["id_no"], $phone_no, $alt_phone_no, $_POST["year_worked"], $_POST["duration_worked"], $comment, $kcse_results, $qualification, $institution, $specialization, $staffProgramsId ); //change to id
            
               if(!empty($msg)){
               
                header('Location: ' . URL . '/casuals/addCasual?message=' . urlencode($msg) );
              }else{
                //TODO: GO TO ERROR PAGE?
                header('location: ' . URL . '/users/login');
              }          
    }

 

    public function getCasualId() {
        $_SESSION['last_action'] = time();
        $country = intval($_POST['country']);
        $program = intval($_POST['program']);
        $lastCasualId=  $this->model->getCasualId($country,$program);
        $lastCasualId++;
        header('Content-Type: application/json');
        echo json_encode(['max_casual_id' => $lastCasualId]);
        exit();
    }

  

    public function insertReturnCasual($casual_id = NULL){
        $_SESSION['last_action'] = time();
        $programs =  $this->model->getAllstr("program");

        if (!empty($casual_id)){
            $casual = $this->model->getCasual($casual_id);
        }

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
                          <strong>Error! </strong>' . $msg . '
                      </div>';
            } else {
                echo '<div class="alert alert-success" id="successAlert" role="alert">
                          <strong>Success! </strong>' . $msg . '
                      </div>';
            }
        }
        require APP . 'view/casuals/return_casual.php';
        require APP . 'view/_templates/footer.php';
    }
      
    
    public function dashboard(){
        $_SESSION['last_action'] = time();
        require APP . 'view/_templates/header.php';
        require APP . 'view/casuals/dashboard.php';
        require APP . 'view/_templates/footer.php';
    }

    
    public function yearStaffNoData(){
        $yearStaffNo = $this->model->getStaffNumberByYear();
        header('Content-Type: application/json');
        echo json_encode($yearStaffNo);
        exit();
    }

    public function durationStaffNoData(){
        $durationStaffNo = $this->model->getStaffNumberByDuration();
        header('Content-Type: application/json');
        echo json_encode($durationStaffNo);
        exit();
    }
    public function programStaffNoData(){
       $programStaffNo = $this->model->getStaffNumberByProgram();
       header('Content-Type: application/json');
       echo json_encode($programStaffNo);
       exit();
   }


      
      private function phoneEdit($phone, $country) {
    
        if (substr($phone, 0, 1) === '0') {
         
            $phone = ltrim($phone, '0');
        } 
            $phone = $country . $phone;
        
        
        return $phone;
    }
    
     
    
    private function properCase($str) {
        $str = trim($str);
        $str = ucwords(strtolower($str));
    
        return $str;
    }



}



