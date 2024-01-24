USE casualsDB;

CREATE TABLE role(
id tinyint unsigned auto_increment  PRIMARY KEY,
name varchar(255) UNIQUE
);
CREATE TABLE users (
u_id tinyint unsigned auto_increment PRIMARY KEY ,
email VARCHAR(255) UNIQUE,
password VARCHAR(255) ,
role tinyint unsigned default 2,
FOREIGN KEY (role) REFERENCES role(id)
);


CREATE TABLE country (
id tinyint unsigned PRIMARY KEY auto_increment,
name varchar(255) UNIQUE,
phone_code varchar(3));
CREATE TABLE program(
id tinyint unsigned PRIMARY KEY auto_increment,
name varchar(255) UNIQUE
);

CREATE TABLE institution(
id tinyint unsigned PRIMARY KEY auto_increment,
name varchar(255) UNIQUE
);
CREATE TABLE qualification(
id tinyint unsigned PRIMARY KEY auto_increment,
name varchar(255) UNIQUE
);

CREATE TABLE kcse_results(
id tinyint unsigned PRIMARY KEY auto_increment,
name varchar(255) UNIQUE
);

CREATE TABLE casuals(
casual_id int auto_increment,
country tinyint unsigned NOT NULL,
program tinyint unsigned NOT NULL,
first_name varchar(255),
middle_name varchar(255),
last_name varchar(255),
id_no varchar(8) UNIQUE,
phone_no varchar(15) UNIQUE,
alt_phone_no varchar(15) UNIQUE,
year_worked year,
duration_worked int unsigned ,
comment	varchar(255),												
kcse_results tinyint unsigned,
qualification tinyint unsigned,
institution tinyint unsigned,
specialization varchar(255),
year_graduated year,
not_available BIT default 0,
PRIMARY KEY (casual_id,country,program),
FOREIGN KEY (country)REFERENCES country(id),
FOREIGN KEY (program) REFERENCES program(id),
FOREIGN KEY (institution) REFERENCES institution(id),
FOREIGN KEY (qualification) REFERENCES qualification(id),
FOREIGN KEY (kcse_results) REFERENCES kcse_results(id),
CONSTRAINT unique_name_combination UNIQUE (first_name, middle_name, last_name)										
);

CREATE TABLE action (
id tinyint PRIMARY KEY,
name varchar(255)
);

CREATE TABLE audit (
	id INT PRIMARY KEY auto_increment,
    casual_id INT,
    u_id tinyint unsigned REFERENCES users(u_id),
    action TINYINT,
     FOREIGN KEY (casual_id) REFERENCES casuals(casual_id),
    FOREIGN KEY (action) REFERENCES action(id)
);



