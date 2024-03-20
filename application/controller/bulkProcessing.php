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
        
        fputcsv($output, array('country', 'program', 'first_name', 'middle_name', 'last_name','id_no', 'phone_no','alt_phone_no', 'comment','kcse_results','qualification','institution','specialization','year_worked','duration_worked'));
     
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

                $expected_header = ['country','program','first_name','middle_name','last_name','id_no','phone_no','alt_phone_no','comment','kcse_results','qualification', 'institution', 'specialization','year_worked', 'duration_worked'];
                $header = fgetcsv($file_handle, 1024);
                if ($header !== $expected_header) {
                    //fclose($file_handle);
                    $err_msg=  "Error: Incorrect file format. Please select the correct template.";
                    header('Content-Type: application/json');
                    echo json_encode($err_msg);
                    exit();
                }

                   
                    $csv_data = array();
    

                    while (($line_of_text = fgetcsv($file_handle, 1024)) !== false) {
                        
                        foreach ($line_of_text as $index => &$value) {
                            if (empty(trim($value))) {
                                $value = null;
                            }
                        }
                        foreach ($countries as $country) {
                            
                            if ($country->name === $line_of_text[0]) {
                                
                                $line_of_text[0] = $country->id;
                              
                                break; 
                            }else{
                                $err_msg=  "Error: Country value $line_of_text[0] is not an acceptable country value. Please confirm data";
                                header('Content-Type: application/json');
                                echo json_encode($err_msg);
                                exit();
                            }
                        }
                        foreach ($programs as $program) {
                            
                            if ($program->name === $line_of_text[1]) {
                                
                                $line_of_text[1] = $program->id;
                            
                                break; 
                            }else{
                                $err_msg=  "Error: Program value $line_of_text[1] is not an acceptable program value. Please confirm data";
                                header('Content-Type: application/json');
                                echo json_encode($err_msg);
                                exit();
                            }
                        }
                        foreach ($kcseResults as $kcseResult) {
                            
                            if ($kcseResult->name === $line_of_text[9]) {
                                
                                $line_of_text[9] = $kcseResult->id;
                             
                                break; 
                            } else if ($line_of_text[9] == null){
                                break;
                            }
                            else{
                                $err_msg=  "Error: KCSE value $line_of_text[9] is not an acceptable KCSE value. Please confirm data";
                                header('Content-Type: application/json');
                                echo json_encode($err_msg);
                                exit();
                            }
                        }
                        foreach ($qualifications as $qualification) {
                            
                            if ($qualification->name === $line_of_text[10]) {
                                
                                $line_of_text[10] = $qualification->id;
                              
                                break; 
                            }else if ($line_of_text[10] == null){
                                break;
                            }else{
                                $err_msg=  "Error: qualification value $line_of_text[10] is not an acceptable qualification value. Please confirm data";
                                header('Content-Type: application/json');
                                echo json_encode($err_msg);
                                exit();
                            }
                        }
                        foreach ($institutions as $institution) {
                            
                            if ($institution->name === $line_of_text[11]) {
                                
                                $line_of_text[11] = $institution->id;
                               
                                break; 
                            }else if ($line_of_text[11] == null){
                                break;
                            }else{
                                $err_msg=  "Error: institution value $line_of_text[11] is not an acceptable institution value. Please confirm data";
                                header('Content-Type: application/json');
                                echo json_encode($err_msg);
                                exit();
                            }
                        }
                        $csv_data[] = $line_of_text;  
                    }   
                                         
                array_shift($csv_data);

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