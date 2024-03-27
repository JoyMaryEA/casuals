<?php

Class BulkProcessing extends Controller{
    public function home(){
        $_SESSION['last_action'] = time();
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/left_nav.php';
        require APP . 'view/bulkProcessing/batchUploads.php';

    }
    public function downloadTemplate(){
        $_SESSION['last_action'] = time();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="CSDB_upload_template.csv"');
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array('Country', 'Program', 'First Name', 'Middle Name', 'Last Name','Id Number', 'Phone Number','Alternative Phone No', 'Comment','KCSE Results','Qualification','Institution','Specialization','Year Worked','Duration Worked'));
     
        fclose($output); 
    }
    public function uploadTemplate() {
        $_SESSION['last_action'] = time();
        
       $countries=$this->model->getAllStr("country");
       $programs =$this->model->getAllStr("program");
       $kcseResults =$this->model->getAllStr("kcse_results");
       $qualifications = $this->model->getAllStr("qualification");
       $institutions = $this->model->getAllStr("institution");
            if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                
                $file_handle = fopen($_FILES['file']['tmp_name'], "r");

                
    
                if ($file_handle !== false) {

                $expected_header = ['Country', 'Program', 'First Name', 'Middle Name', 'Last Name','Id Number', 'Phone Number','Alternative Phone No', 'Comment','KCSE Results','Qualification','Institution','Specialization','Year Worked','Duration Worked'];
                $header = fgetcsv($file_handle, 1024);
                if ($header !== $expected_header) {
                    //fclose($file_handle);
                    $err_msg=  "Error: Incorrect file format. Please select the correct template.";
                    header('Content-Type: application/json');
                    echo json_encode($err_msg);
                    exit();
                }

                   
                    $csv_data = array();
                    $currentYear = date('Y');
                        $line_no=1;
                    while (($line_of_text = fgetcsv($file_handle, 1024)) !== false) {
                        $line_no++;

                        foreach ($line_of_text as $index => &$value) {
                            if (empty(trim($value))) {
                                $value = null;
                            }
                        }
                        foreach ($countries as $country) {
                            
                            if ($country->name === $line_of_text[0]) {
                                
                                $line_of_text[0] = $country->id;
                              
                                break; 
                            }
                        }
                        if (!is_numeric($line_of_text[0])){
                            $err_msg=  "Error: Country value $line_of_text[0] in line $line_no is not an acceptable country value. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        foreach ($programs as $program) {
                            
                            if ($program->name === $line_of_text[1]) {
                                
                                $line_of_text[1] = $program->id;
                            
                                break; 
                            }
                        }
                        if(!is_numeric($line_of_text[1])){
                            $err_msg=  "Error: Program value $line_of_text[1] in line $line_no is not an acceptable program value. Please confirm data and re-upload" ;
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        if ( $line_of_text[5] != null &&( !preg_match('/^\d{8}$/', $line_of_text[5])) ){
                            $err_msg=  "Error: national id value $line_of_text[5] in line $line_no has to be 8 digits. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        if ( $line_of_text[6] != null &&( !preg_match('/^\d{12}$/', $line_of_text[6])) ){
                            $err_msg=  "Error: phone number value $line_of_text[6] in line $line_no has to be 12 digits. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        if ( $line_of_text[7] != null &&( !preg_match('/^\d{12}$/', $line_of_text[7])) ){
                            $err_msg=  "Error: alternative phone number value $line_of_text[7] in line $line_no has to be 12 digits. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        foreach ($kcseResults as $kcseResult) {
                            
                            if ($kcseResult->name === $line_of_text[9]) {
                                
                                $line_of_text[9] = $kcseResult->id;
                             
                                break; 
                            } 
                           
                        }
                        if(!is_null($line_of_text[9]) && !is_numeric($line_of_text[9])){
                            $err_msg=  "Error: KCSE value $line_of_text[9] in line $line_no is not an acceptable KCSE value. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        foreach ($qualifications as $qualification) {
                            
                            if ($qualification->name === $line_of_text[10]) {
                                
                                $line_of_text[10] = $qualification->id;
                              
                                break; 
                            }
                        }
                        if(!is_null($line_of_text[10]) && !is_numeric($line_of_text[10])){
                            $err_msg=  "Error: qualification value $line_of_text[10] in line $line_no is not an acceptable qualification value. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        foreach ($institutions as $institution) {
                            
                            if ($institution->name === $line_of_text[11]) {
                                
                                $line_of_text[11] = $institution->id;
                               
                                break; 
                            }
                           
                        }
                        if(!is_null($line_of_text[11]) && !is_numeric($line_of_text[11])){
                            $err_msg=  "Error: institution value $line_of_text[11] in line $line_no is not an acceptable institution value. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                       
                        if ( !is_null($line_of_text[13]) && !( intval($line_of_text[13])  >= 2013 && intval($line_of_text[13])  <= $currentYear)) {
                            $err_msg=  "Error: year worked value $line_of_text[13] in line $line_no has to be a valid year. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }
                        if ( !is_null($line_of_text[14] ) && !is_numeric(intval($line_of_text[14] )) ){
                            $err_msg=  "Error: duration worked value $line_of_text[14] in line $line_no has to be number of days. Please confirm data and re-upload";
                            header('Content-Type: application/json');
                            echo json_encode($err_msg);
                            exit();
                        }

                        array_push($csv_data, $line_of_text);
                    }   
                

                if (empty($csv_data)) {
                    $err_msg = "Error: No data in file. Please select the correct file.";
                    header('Content-Type: application/json');
                    echo json_encode($err_msg);
                    exit();
                }
                

           
                 $res = $this->insertCSVData($csv_data);
                
                 //echo $res;
                   
                    fclose($file_handle);
                } else {
                    echo "Error opening CSV file<br>";
                }
            } else {
                echo "Error uploading file: " . $_FILES['file']['error'] . "<br>";
            }
        }

        private function insertCSVData($csv_data) {
           
            $result = $this->model->bulkInserts($csv_data);
           
        }
        
    public function getRecentInserts(){
        $casuals= $this->model->getTodayInserts();
        header('Content-Type: application/json');
        echo json_encode($casuals);
        exit();

    }
}
?>