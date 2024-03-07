<?php

Class BulkProcessing extends Controller{
    public function home(){
        $_SESSION['last_action'] = time();
        require APP . 'view/_templates/header.php';
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
                            }
                        }
                        foreach ($programs as $program) {
                            
                            if ($program->name === $line_of_text[1]) {
                                
                                $line_of_text[1] = $program->id;
                            
                                break; 
                            }
                        }
                        foreach ($kcseResults as $kcseResult) {
                            
                            if ($kcseResult->name === $line_of_text[9]) {
                                
                                $line_of_text[9] = $kcseResult->id;
                             
                                break; 
                            }
                        }
                        foreach ($qualifications as $qualification) {
                            
                            if ($qualification->name === $line_of_text[10]) {
                                
                                $line_of_text[10] = $qualification->id;
                              
                                break; 
                            }
                        }
                        foreach ($institutions as $institution) {
                            
                            if ($institution->name === $line_of_text[11]) {
                                
                                $line_of_text[11] = $institution->id;
                               
                                break; 
                            }
                        }
                        $csv_data[] = $line_of_text;     
                }
             
                array_shift($csv_data);

           
                 $res = $this->insertCSVData($csv_data);
                   
                   
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
        
    
}
?>