/*==========Create Table Statements=============*/
CREATE TABLE department
(
    dep_id            varchar(10) NOT NULL PRIMARY KEY,
    dep_name          varchar(20)  NOT NULL
);

CREATE TABLE program
(
    prog_id           varchar(10) PRIMARY KEY,
    prog_name         varchar(20)  NOT NULL,
    prog_department   varchar(10) NOT NULL REFERENCES department(dep_id)
);

CREATE TABLE student
(
    stud_id           int auto_increment PRIMARY KEY,
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
    stud_pic          LONGBLOB NOT NULL 
);

CREATE TABLE teacher
(
    tchr_id            int auto_increment PRIMARY KEY,
    tchr_fname         varchar(20)  NOT NULL,
    tchr_lname         varchar(20) NOT NULL,
    tchr_gender        tinyint(1) NOT NULL,
    tchr_dob           date NOT NULL,
    tchr_age           int NOT NULL,
    tchr_email         varchar(255) NOT NULL,
    tchr_cellnum       int NOT NULL,
    tchr_department    varchar(10) NOT NULL REFERENCES department(dep_id),
    tchr_pic           LONGBLOB NOT NULL
);

CREATE TABLE course
(
    crs_id            varchar(10) PRIMARY KEY,
    crs_title         varchar(25)  NOT NULL,
    crs_credits       int NOT NULL,
    crs_program       varchar(10) NOT NULL REFERENCES program(prog_id)
);

CREATE TABLE section
(
    sec_id            varchar(10) PRIMARY KEY,
    sec_course        varchar(20) NOT NULL REFERENCES course(crs_id),
    sec_teacher       int NOT NULL REFERENCES teacher(tchr_id)
);

CREATE TABLE enrollement
(
    enroll_id         int auto_increment PRIMARY KEY,
    enroll_student    int NOT NULL REFERENCES student(stud_id),
    enroll_section    varchar(10) NOT NULL REFERENCES section(sec_id)
);

/*==========Insert Table Statements=============*/
