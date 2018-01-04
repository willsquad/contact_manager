CREATE DATABASE contact_manager_2914 CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE users_1792 (
    u_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    u_fname VARCHAR(30),
    u_lname VARCHAR(30),
    u_email VARCHAR(50),
    u_pass CHAR(32),
    u_reg_time INT UNSIGNED,
    u_profile_pic VARCHAR(100) DEFAULT 'profile_icon.png',
    u_user_ip VARBINARY(16),
    u_unique_id CHAR(64),
    PRIMARY KEY (u_id),
    UNIQUE (u_unique_id),
    INDEX login (u_email, u_pass)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE contacts_8521 (
    c_id INT UNSIGNED NOT NULL AUTO_iNCREMENT,
    c_fname VARCHAR(30),
    c_lname VARCHAR(30),
    c_mname VARCHAR(30),
    c_email VARCHAR(50),
    c_phone VARCHAR(25),
    c_organization VARCHAR(50),
    c_jobTitle VARCHAR(50),
    c_workPhone VARCHAR(20),
    c_dob DATE,
    c_gender enum('M','F', 'O'), 
    c_profile_pic VARCHAR(100) DEFAULT 'profile_icon.png',
    c_website VARCHAR(50),
    c_linkedin VARCHAR(50),
    c_twitter VARCHAR(50),
    c_facebook VARCHAR(50),
    c_additionalSocial TEXT,
    c_additionalPhones TEXT,
    c_additionalEmails TEXT,
    c_unique_id CHAR(64),
    added_by_u_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (c_id),
    UNIQUE (c_unique_id),
    INDEX added_by (added_by_u_id),
    FULLTEXT INDEX fname (c_fname)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

/* Columns to add : Added time (INT), Favourite (1,0)  */