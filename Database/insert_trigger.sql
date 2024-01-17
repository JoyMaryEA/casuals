CREATE TRIGGER before_insert_casuals
BEFORE INSERT ON casuals
FOR EACH ROW
BEGIN
    DECLARE max_casual_id INT;

    SELECT MAX(casual_id)
    INTO max_casual_id
    FROM casuals
    WHERE country = NEW.country AND program = NEW.program;

    IF max_casual_id IS NULL THEN
        SET max_casual_id = 0;
    END IF;

    SET NEW.casual_id = (NEW.country * 100000) + (max_casual_id + 1);
END

