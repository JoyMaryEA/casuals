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

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }
//---------------------------------------------------------------CASUAL STAFF DB

//user methods
    public function login($email,$password){
        $sql="SELECT u_id,email,password,role FROM users where email=:email AND password=:password;";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email, ':password'=> $password);
        $query->execute($parameters);
        
   
        return $query->fetch();
    }

//causuals methods
    public function getAllCasuals()
    {
        $sql = " SELECT 
        c.casual_id, 
        c.middle_name, 
        c.first_name, 
        c.last_name, 
        c.id_no, 
        cn.name AS country_name, 
        c.country,
        c.phone_no, 
        p.name AS program_name,
        c.program, 
        sp.year_worked,  
        sp.duration_worked,  
        c.comment, 
        c.alt_phone_no, 
        c.institution,
        c.kcse_results,
        c.specialization,
        c.alt_phone_no,
        c.qualification, 
        kc.name AS kcse_results_name, 
        i.name AS institution_name, 
        q.name AS qualification_name
    FROM 
        casuals c
    JOIN 
        country cn ON c.country = cn.id
    JOIN 
        program p ON c.program = p.id
    LEFT JOIN 
        kcse_results kc ON c.kcse_results = kc.id
    LEFT JOIN 
        institution i ON c.institution = i.id
    LEFT JOIN 
        qualification q ON c.qualification = q.id
    LEFT JOIN 
        staff_programs sp ON c.casual_id = sp.casual_id
        WHERE 
        c.not_available = 0";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getCasual($casual_id)
    {
        $sql = " SELECT 
        c.casual_id, 
        c.middle_name, 
        c.first_name, 
        c.last_name, 
        c.id_no, 
        cn.name AS country_name, 
        c.country,
        c.phone_no, 
        p.name AS program_name,
        c.program, 
        sp.year_worked,  
        sp.duration_worked,  
        c.comment, 
        c.alt_phone_no, 
        c.institution,
        c.kcse_results,
        c.specialization,
        c.alt_phone_no,
        c.qualification, 
        kc.name AS kcse_results_name, 
        i.name AS institution_name, 
        q.name AS qualification_name
    FROM 
        casuals c
    JOIN 
        country cn ON c.country = cn.id
    JOIN 
        program p ON c.program = p.id
    LEFT JOIN 
        kcse_results kc ON c.kcse_results = kc.id
    LEFT JOIN 
        institution i ON c.institution = i.id
    LEFT JOIN 
        qualification q ON c.qualification = q.id
    LEFT JOIN 
        staff_programs sp ON c.casual_id = sp.casual_id
        WHERE 
        c.casual_id = :casual_id 
        AND c.not_available = 0
    LIMIT 1;
    ";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id);
        $query->execute($parameters);
        return $query->fetch();
    }
    
    public function filterCountryProgram($country,$program)
    {
        $sql=" SELECT 
        c.casual_id, 
        c.middle_name, 
        c.first_name, 
        c.last_name, 
        c.id_no, 
        cn.name AS country_name, 
        c.country,
        c.phone_no, 
        p.name AS program_name,
        c.program, 
        sp.year_worked,  
        sp.duration_worked,  
        c.comment, 
        c.alt_phone_no, 
        c.institution,
        c.kcse_results,
        c.specialization,
        c.alt_phone_no,
        c.qualification, 
        kc.name AS kcse_results_name, 
        i.name AS institution_name, 
        q.name AS qualification_name
    FROM 
        casuals c
    JOIN 
        country cn ON c.country = cn.id
    JOIN 
        program p ON c.program = p.id
    LEFT JOIN 
        kcse_results kc ON c.kcse_results = kc.id
    LEFT JOIN 
        institution i ON c.institution = i.id
    LEFT JOIN 
        qualification q ON c.qualification = q.id
    LEFT JOIN 
        staff_programs sp ON c.casual_id = sp.casual_id
        WHERE ";

    if (!empty($country) && !empty($program)){
       $sql= $sql . " cn.id =:country AND p.id =:program AND not_available = 0;" ;
       $parameters = array(':country' => $country, ':program'=>$program);
    } else if(empty($country) && !empty($program)){
        $sql= $sql . " p.id =:program AND not_available = 0;" ;
        $parameters = array( ':program'=>$program);
    }else if(!empty($country) && empty($program)){
        $sql= $sql . " cn.id =:country AND not_available = 0;" ;
        $parameters = array(':country' => $country);
    }
       
         $query = $this->db->prepare($sql);
        
         $query->execute($parameters);
         return $query->fetchAll();
    }
  
    
    public function search($search_str)
{
    $sql = " SELECT 
    c.casual_id, 
    c.middle_name, 
    c.first_name, 
    c.last_name, 
    c.id_no, 
    cn.name AS country_name, 
    c.country,
    c.phone_no, 
    p.name AS program_name,
    c.program, 
    sp.year_worked,  
    sp.duration_worked,  
    c.comment, 
    c.alt_phone_no, 
    c.institution,
    c.kcse_results,
    c.specialization,
    c.alt_phone_no,
    c.qualification, 
    kc.name AS kcse_results_name, 
    i.name AS institution_name, 
    q.name AS qualification_name
FROM 
    casuals c
JOIN 
    country cn ON c.country = cn.id
JOIN 
    program p ON c.program = p.id
LEFT JOIN 
    kcse_results kc ON c.kcse_results = kc.id
LEFT JOIN 
    institution i ON c.institution = i.id
LEFT JOIN 
    qualification q ON c.qualification = q.id
LEFT JOIN 
    staff_programs sp ON c.casual_id = sp.casual_id
    WHERE  
        (c.first_name LIKE :first_name OR c.last_name LIKE :last_name OR c.casual_id LIKE :casual_id)
        AND c.not_available = 0";

    $query = $this->db->prepare($sql);
    $parameters = array(
        ':first_name' => '%' . $search_str . '%',
        ':last_name' => '%' . $search_str . '%',
        ':casual_id' => '%' . $search_str . '%'
    );

  //  echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 

    $query->execute($parameters);
   // $result = $query->fetchAll();
    //var_dump($result);
    //echo '[ Debug ] Parameters: ' . print_r($parameters, true);

    return $query->fetchAll();
}


    public function getAllCountries(){
        $sql = "SELECT id, name, phone_code FROM country;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllPrograms(){
        $sql = "SELECT id, name FROM program;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllInstitutions(){
        $sql = "SELECT id, name FROM institution;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllKcse(){
        $sql = "SELECT id, name FROM kcse_results;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getALLQualifications(){
        $sql = "SELECT id, name FROM qualification;";
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
        if ($queryResult) {
            $lastInsertedId = $this->db->lastInsertId(); 
             
            $sqlStaffPrograms = "INSERT INTO staff_programs (casual_id, program_id, year_worked, duration_worked) Values (:casual_id, :program, :year_worked, :duration_worked);";
            $query2 = $this->db->prepare($sqlStaffPrograms);
            $parameters2 = array(':casual_id'=> $lastInsertedId, ':program'=> $program, ':year_worked'=>$year_worked, ':duration_worked'=>$duration_worked);
                try {
                    $queryResult2 = $query2->execute($parameters2);
                    if($queryResult2){
                        session_start();
                        $user_id = $_SESSION["userId"];
                        $action = 1;
                        $this->insertAudit($lastInsertedId, $action, $user_id);
                        return "Casual record added successfully!";
                    } else{
                        $errorInfo = $query->errorInfo();
                        return "Error adding casual record. SQLSTATE: {$errorInfo[0]}, Error Code: {$errorInfo[1]}, Error Message: {$errorInfo[2]}";
                    }
                    
                } catch (PDOException $e) {
                    return "Error: " . $e->getMessage();
                }
             

            
        } else {
            $errorInfo = $query->errorInfo();
            return "Error adding casual record. SQLSTATE: {$errorInfo[0]}, Error Code: {$errorInfo[1]}, Error Message: {$errorInfo[2]}";
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
            return "Error deleting casual record. . Helper::debugPDO($sql, $parameters)";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }

    }

    public function editCasual($casual_id, $country, $program, $first_name, $middle_name, $last_name, $id_no, $phone_no, $alt_phone_no, $year_worked, $duration_worked, $comment, $kcse_results, $qualification, $institution, $specialization) {
     
        
        $sql = "UPDATE casuals SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, id_no = :id_no, phone_no = :phone_no, alt_phone_no = :alt_phone_no, comment = :comment, kcse_results = :kcse_results, qualification = :qualification, institution = :institution, specialization = :specialization WHERE casual_id = :casual_id;";
        
        $query = $this->db->prepare($sql);
        $parameters = array(
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
            $queryResult = $query->execute($parameters);
            
           
            if ($queryResult) {
                session_start();
                $user_id = $_SESSION["userId"];
                $this->model->updateAudit($casual_id,$user_id);
                return "Casual record edited successfully!  Helper::debugPDO($sql, $parameters)";
            } else {
                $errorInfo = $query->errorInfo();
            return "Error adding casual record. SQLSTATE: {$errorInfo[0]}, Error Code: {$errorInfo[1]}, Error Message: {$errorInfo[2]}";
            }
        } catch (PDOException $e) {
             return "Error: " . $e->getMessage();
        }
    }
    

    public function deleteAudit($casual_id,$action,$u_id){
        $sql = "INSERT INTO audit (casual_id, action, u_id) VALUES (:casual_id, :action, :u_id);";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':action' => $action,':u_id' => $u_id );
       // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
       
    }
    public function insertAudit($casual_id,$action, $u_id){
        $sql = "INSERT INTO audit (casual_id, action, u_id) VALUES (:casual_id, :action, :u_id);";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':action' => $action,':u_id' => $u_id );
       // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
       
    }
    public function updateAudit($casual_id,$u_id){
        $sql = " INSERT INTO audit (casual_id, action, u_id) VALUES (:casual_id, 2, :u_id);";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id,':u_id' => $u_id );
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
     
    }

    public function getEditAudit($casual_id){
        $sql = "SELECT a.timestamp, u.email, a.casual_id, a.action
        FROM audit a
        JOIN users u ON a.u_id = u.u_id
        WHERE a.casual_id = :casual_id and a.action=2 ;";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id );
       // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
        $query->execute($parameters);
        return $query->fetch();
    }
    public function getInsertAudit($casual_id){
        $sql = "SELECT a.timestamp, u.email, a.casual_id, a.action
        FROM audit a
        JOIN users u ON a.u_id = u.u_id
        WHERE a.casual_id = :casual_id and a.action=1 ;";
        $query = $this->db->prepare($sql);
        $parameters = array(':casual_id' => $casual_id );
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
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
}
