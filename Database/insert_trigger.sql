DELIMITER //
CREATE TRIGGER before_insert_casuals
BEFORE INSERT ON casuals
FOR EACH ROW
BEGIN
    DECLARE max_casual_id INT;
    SELECT casual_id
    INTO max_casual_id
    FROM casuals
    WHERE (phone_no = NEW.phone_no OR id_no = NEW.id_no)
      AND country = NEW.country;

    IF max_casual_id IS NOT NULL THEN
        SET NEW.casual_id = max_casual_id;
    ELSE
        SELECT MAX(casual_id)
        INTO max_casual_id
        FROM casuals
        WHERE country = NEW.country AND program = NEW.program;

        IF max_casual_id IS NULL THEN
            SET max_casual_id = 0;
            SET NEW.casual_id = (NEW.country * 100000) + (max_casual_id + 1);
        ELSE
            SET NEW.casual_id = max_casual_id + 1;
        END IF;
    END IF;
END;
//
DELIMITER ;

