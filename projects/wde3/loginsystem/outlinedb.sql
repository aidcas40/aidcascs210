/*==========Create Table Statements=============*/
CREATE TABLE program
(
    prog_id           varchar(10) NOT NULL PRIMARY KEY,
    prog_name         varchar(20)  NOT NULL
);

CREATE TABLE student
(
    stud_id           int NOT NULL PRIMARY KEY,
    stud_fname        varchar(20)  NOT NULL,
    stud_lname        varchar(20) NOT NULL,
    stud_gender       tinyint(1) NOT NULL,
    stud_dob          date NOT NULL,
    stud_age          int NOT NULL,
    stud_email        varchar(255) NOT NULL,
    stud_cellnum      int NOT NULL,
    stud_enrolldate   date NOT NULL,
    stud_yearlvl      varchar(10) NOT NULL,
    stud_program      varchar(10) NOT NULL REFERENCES program(prog_id),
    stud_pic          LONBLOB NOT NULL 
);

CREATE TABLE instructor
(
    ins_id            int NOT NULL PRIMARY KEY,
    ins_fname         varchar(20)  NOT NULL,
    ins_lname         varchar(20) NOT NULL,
    ins_gender        tinyint(1) NOT NULL,
    ins_dob           date NOT NULL,
    ins_age           int NOT NULL,
    ins_email         varchar(255) NOT NULL,
    ins_cellnum       int NOT NULL
);

CREATE TABLE department
(
    dep_id            varchar(10) NOT NULL PRIMARY KEY,
    dep_name          varchar(20)  NOT NULL
);

CREATE TABLE course
(
    crs_id            int AUTO_INCREMENT PRIMARY KEY,
    crs_code          varchar(10) NOT NULL,
    crs_title         varchar(25)  NOT NULL,
    crs_credits       int NOT NULL,
    crs_department    varchar(10) NOT NULL REFERENCES department(dep_id)
);

CREATE TABLE section
(
    sec_id            varchar(10) PRIMARY KEY,
    sec_course        varchar(20)  NOT NULL REFERENCES course(crs_id),
    sec_instructor    int NOT NULL REFERENCES instructor(ins_id)
);

CREATE TABLE enrollement
(
    enroll_id         varchar(10) PRIMARY KEY,
    enroll_student    int NOT NULL REFERENCES student(stud_id),
    enroll_section    varchar(10) NOT NULL REFERENCES section(sec_id)
);

/*==========Insert Table Statements=============*/
