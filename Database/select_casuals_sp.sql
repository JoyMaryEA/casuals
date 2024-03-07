DELIMITER //
CREATE PROCEDURE selectAllCasuals (IN whereClauseStmt VARCHAR(255) )

BEGIN 
SET @sql = CONCAT('SELECT 
        c.casual_id, 
        c.middle_name, 
        c.first_name, 
        c.last_name, 
        c.id_no, 
        cn.name AS country_name, 
        c.country,
        c.phone_no, 
        p.name AS program_name,
        sp.program_id, 
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
        LEFT JOIN 
        country cn ON c.country = cn.id
    
        LEFT JOIN 
        kcse_results kc ON c.kcse_results = kc.id
        LEFT JOIN 
        institution i ON c.institution = i.id
        LEFT JOIN 
        qualification q ON c.qualification = q.id
        LEFT JOIN 
        staff_programs sp ON c.casual_id = sp.casual_id
        LEFT JOIN 
        program p ON sp.program_id = p.id
        WHERE ' , whereClauseStmt);
PREPARE stmt from @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END //
DELIMITER ;