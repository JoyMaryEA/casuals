<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }



//user methods
    public function login($email,$password){
        $sql="SELECT u_id,email,password,role FROM users where email=:email AND password=:password;";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email, ':password'=> $password);
        $query->execute($parameters);
        
   
        return $query->fetch();
    }


//causuals methods
   
    
    public function getCasual($casual_id)
    {
        $sql = " CALL selectAllCasuals(:whereClauseStmt)";
        $whereClauseStmt = "c.casual_id = $casual_id AND c.not_available = 0 LIMIT 1;";
        $query = $this->db->prepare($sql);
        $parameters = array(':whereClauseStmt' => $whereClauseStmt);
        $query->execute($parameters);
        return $query->fetch();
    }
    
    public function filterCountryProgram($country,$program)
    {
     

        $sql = " CALL selectAllCasuals(:whereClauseStmt)";

    if (!empty($country) && !empty($program)){

        $whereClauseStmt=" cn.id =$country AND p.id =$program AND not_available = 0;" ;
       $parameters = array(':whereClauseStmt' => $whereClauseStmt);

    } else if(empty($country) && !empty($program)){

        $whereClauseStmt=" p.id =$program AND not_available = 0;" ;
        $parameters = array(':whereClauseStmt' => $whereClauseStmt);

    }else if(!empty($country) && empty($program)){

        $whereClauseStmt= " cn.id =$country AND not_available = 0;" ;
        $parameters = array(':whereClauseStmt' => $whereClauseStmt);
    }
       
         $query = $this->db->prepare($sql);
        
         $query->execute($parameters);
         return $query->fetchAll();
    }
  
    
    public function search($search_str)
{
    $escaped_search_str = $this->db->quote('%' . $search_str . '%');

    $whereClauseStmt ="(c.first_name LIKE $escaped_search_str OR c.last_name LIKE $escaped_search_str OR c.casual_id LIKE $escaped_search_str OR c.phone_no LIKE  $escaped_search_str or c.id_no LIKE  $escaped_search_str )
    AND c.not_available = 0";
    $sql = " CALL selectAllCasuals(:whereClauseStmt)";

    $query = $this->db->prepare($sql);
    $parameters = array(
        ':whereClauseStmt' => $whereClauseStmt
    );

    $query->execute($parameters);

    return $query->fetchAll();
}
    // to get the countries, programs, institutions that populate the frontend
   public function getAllStr($str){
    $sql = "SELECT id, name FROM ";
    $sql = $sql . $str;
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
   }
   public function getCountryCode(){
    $sql = "SELECT id, name, phone_code FROM country ";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
   }
    public function insertCasual($country, $program, $first_name, $middle_name, $last_name, $id_no, $phone_no, $alt_phone_no, $year_worked, $duration_worked, $comment, $kcse_results, $qualification, $institution, $specialization
    ){
        
        
        $sql = "INSERT INTO casuals (country, program, first_name, middle_name, last_name, id_no, phone_no, alt_phone_no, comment, kcse_results, qualification, institution, specialization
        ) VALUES (:country, :program, :first_name, :middle_name, :last_name, :id_no, :phone_no, :alt_phone_no, :comment, :kcse_results, :qualification, :institution, :specialization)";
        $query = $this->db->prepare($sql);
        $parameters = array(':country' => $country, ':program' => $program, ':first_name' => $first_name, ':middle_name' => $middle_name, ':last_name' => $last_name, ':id_no' => $id_no, ':phone_no' => $phone_no, ':alt_phone_no' => $alt_phone_no, ':comment' => $comment, ':kcse_results' => $kcse_results, ':qualification' => $qualification, ':institution' => $institution, ':specialization' => $specialization
    );

        try {
            $queryResult = $query->execute($parameters);
               // entering data to staff_programs after a successful insert into casuals table
        if ($queryResult) {
         
            $lastInsertedId = $this->db->lastInsertId(); 
             
            $sqlStaffPrograms = "INSERT INTO staff_programs (casual_id, program_id, year_worked, duration_worked) Values (:casual_id, :program, :year_worked, :duration_worked);";
            $queryStaffPrograms = $this->db->prepare($sqlStaffPrograms);
            $parametersStaffPrograms = array(':casual_id'=> $lastInsertedId, ':program'=> $program, ':year_worked'=>$year_worked, ':duration_worked'=>$duration_worked);
                try {
                     // entering data to ausit after a successful insert into both casuals and staff_programs table
                    $queryResultStaffPrograms = $queryStaffPrograms->execute($parametersStaffPrograms);
                    if($queryResultStaffPrograms){
                        session_start();
                        $user_id = $_SESSION["userId"];
                        $action = 1;
                        $this->insertAudit($lastInsertedId, $action, $user_id);
                        return "Casual record added successfully!";
                    } else{
                        $errorInfo = $query->errorInfo();
                        return "Error adding casual record. {$errorInfo[2]}";
                    }
                    
                } catch (PDOException $e) {
                    return "Error: " . $e->getMessage();
                }
             

            
        } else {
            $errorInfo = $query->errorInfo();
            return "Error adding casual record. {$errorInfo[2]}";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


    public function deleteCasual($casual_id)
    {
        $sql = "UPDATE casuals SET not_available = 1 WHERE casual_id = :casual_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id);
      //  echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
    
    try {
        $queryResult = $query->execute($parameters);
        if ($queryResult) {
            return "Casual record deleted successfully!";
        } else {
            $errorInfo = $query->errorInfo();
            return "Error deleting casual record. . {$errorInfo[2]}";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }

    }

    public function editCasual($casual_id, $country, $program, $first_name, $middle_name, $last_name, $id_no, $phone_no, $alt_phone_no, $year_worked, $duration_worked, $comment, $kcse_results, $qualification, $institution, $specialization, $staffProgramsId) {
     
    
        
        $sqlEditCasual = "UPDATE casuals SET  first_name = :first_name, middle_name = :middle_name, last_name = :last_name, id_no = :id_no, phone_no = :phone_no, alt_phone_no = :alt_phone_no, comment = :comment, kcse_results = :kcse_results, qualification = :qualification, institution = :institution, specialization = :specialization WHERE casual_id = :casual_id";
        
        $query = $this->db->prepare($sqlEditCasual);
        $parametersEditCasual = array(
            ':casual_id' => $casual_id,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':last_name' => $last_name,
            ':id_no' => $id_no,
            ':phone_no' => $phone_no,
            ':alt_phone_no' => $alt_phone_no,
            ':comment' => $comment,
            ':kcse_results' => $kcse_results,
            ':qualification' => $qualification,
            ':institution' => $institution,
            ':specialization' => $specialization
        );
    
        try { 
            $queryEditCasualResult = $query->execute($parametersEditCasual);
            
           
            if ($queryEditCasualResult) {
                // update staff_programs table

                 try {
                    $updateStaffProgramsSuccess = $this->editStaffProgramsProgramValue($staffProgramsId,$program);
       
                    // update audit table
                        if ($updateStaffProgramsSuccess) {
                            session_start();
                            $user_id = $_SESSION["userId"];
                            $action = 2;
                            $this->insertAudit($casual_id,$action,$user_id);
                            return "Casual record edited successfully!";
                        } else {
                            $errorInfo = $query->errorInfo();
                            return "Error editing casual record . {$errorInfo[2]}";
                        }
                    
                 } catch (PDOException $e) {
                    return "Error: " . $e->getMessage();
                 }
                
            } else {
                $errorInfo = $query->errorInfo();
                 return "Error editing casual record. {$errorInfo[2]}";
            }
        } catch (PDOException $e) {
             return "Error: " . $e->getMessage();
        }
    }
    
    //enter into audit table, either insert, update/delete
    public function insertAudit($casual_id,$action,$u_id){
        $sql = "INSERT INTO audit (casual_id, action, u_id) VALUES (:casual_id, :action, :u_id);";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':action' => $action,':u_id' => $u_id );
        $query->execute($parameters);
       
    }

    public function getAudit($casual_id,$action){
        $sql = "SELECT a.timestamp, u.email, a.casual_id, a.action
        FROM audit a
        JOIN users u ON a.u_id = u.u_id
        WHERE a.casual_id = :casual_id and a.action=:action ;";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id , ':action'=> $action);
       // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
        return $query->fetch();
    }


    public function getCasualId($country,$program){
        $sql = "SELECT MAX(casual_id) FROM casuals where country = :country and program = :program;";
        $query = $this->db->prepare($sql);
        $parameters = array(':country' => $country,':program' => $program  );
       // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
        return $query->fetchColumn();
    }

    public function getExistingCasual($phone_no, $id_no){
        $sql = "SELECT DISTINCT  c.casual_id, first_name, last_name,id_no, phone_no, p.name AS program_name, sp.program_id 
        from casuals c  JOIN program p on p.id = c.program  JOIN staff_programs sp on sp.program_id=  
        c.program  where phone_no = :phone_no OR id_no = :id_no";
        $query = $this->db->prepare($sql);
        $parameters = array(':phone_no' => $phone_no, ':id_no' => $id_no );
        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
        return $query->fetch();
    }

    public function insertReturnCasual($casual_id, $program, $duration_worked, $year_worked) {
        $sql = "INSERT INTO staff_programs (casual_id, program_id, duration_worked, year_worked) VALUES (:casual_id, :program, :duration_worked,:year_worked);";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':program' => $program,':duration_worked' => $duration_worked, ':year_worked' => $year_worked );
        try { 
            $queryResult = $query->execute($parameters);
            
           
            if ($queryResult) {
                return "Casual record edited successfully!";
            } else {
                $errorInfo = $query->errorInfo();
            return "Error adding casual record. {$errorInfo[2]}";
            }
        } catch (PDOException $e) {
             return "Error: " . $e->getMessage();
        }
    }
// get staff_programs id then change the program_id there
    public function getStaffProgramsId($casual_id, $program, $duration_worked, $year_worked){
        $sql = "SELECT DISTINCT id from staff_programs where casual_id = :casual_id AND program_id = :program AND duration_worked=:duration_worked AND year_worked=:year_worked";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':program' => $program,':duration_worked' => $duration_worked, ':year_worked' => $year_worked );
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
        return $query->fetch();
    }

    private function editStaffProgramsProgramValue($staffProgramsId,$program){
        $sql = "UPDATE staff_programs SET program_id = :program WHERE id = :staffProgramsId";
        $query = $this->db->prepare($sql);
        $parameters = array(':staffProgramsId' => $staffProgramsId, ':program' => $program);
    //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  
        $queryResult = $query->execute($parameters);
       return $queryResult;
    }

    public function getStaffNumberByYear(){     
        $sql = "SELECT year_worked, count(casual_id) AS staff_no FROM staff_programs GROUP BY year_worked;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getStaffNumberByDuration(){
        $sql = "SELECT duration_worked, count(casual_id) AS staff_no FROM staff_programs GROUP BY duration_worked;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

        

    public function getStaffNumberByProgram(){
        $sql = "SELECT count(casual_id) AS staff_no , p.name FROM staff_programs sp join program p  where p.id = sp.program_id GROUP BY p.name;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
     }
}
