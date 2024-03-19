
DELIMITER //
CREATE TRIGGER before_insert_casuals
BEFORE INSERT ON casuals
FOR EACH ROW
BEGIN
    DECLARE max_casual_id INT;
    DECLARE new_casual_id VARCHAR(20);
    DECLARE casual_id_generated INT;
		SELECT MAX(gen_casual_id)
        INTO max_casual_id
        FROM casuals
        WHERE country = NEW.country AND program = NEW.program;

        IF max_casual_id IS NULL THEN
            SET max_casual_id = 0;
            SET casual_id_generated =  (NEW.country * 100000) + (max_casual_id + 1);
            SET NEW.gen_casual_id = casual_id_generated;
			
        ELSE
			SET casual_id_generated = max_casual_id + 1;
            SET NEW.gen_casual_id = casual_id_generated;
            
        END IF;
        SELECT CONCAT(
				CASE WHEN p.initials IS NOT NULL THEN CONCAT(p.initials, '-') ELSE '' END,
				casual_id_generated) INTO new_casual_id
				FROM program p
				WHERE p.id = NEW.program;

		SET NEW.casual_id = new_casual_id;
        
END;
//
DELIMITER ;
