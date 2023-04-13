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
INSERT INTO department VALUES ('AR01', 'Arts'), ('AS01', 'Arts and Science'), ('BU01', 'Business'),
('BM01', 'Business and Mathematics'), ('SC01', 'Science'), ('PE01', 'Primary Education') 

INSERT INTO program VALUES ('ENL01', 'English and Literature', 'AR01'), 
('ELH01', 'English Literature and History', 'AR01'), 
('BEL01', 'Biology and English Literature', 'AS01'),
('BSP01', 'Biology and Spanish', 'AS01'), 
('CSC01', 'Computer Science', 'AS01'), 
('ACC01', 'Accounting', 'BU01'),
('ACE01', 'Accounting and Economics', 'BU01'),
('ECO01', 'Economics', 'BU01'),
('MOB01', 'Management Of Business', 'BU01'),
('TSM01', 'Tourism Management', 'BU01'),
('ACM01', 'Accounting and Mathematics', 'BM01'),
('ECM01', 'Economics and Mathematics', 'BM01'),
('BCM01', 'Biology and Chemistry', 'SC01'),
('BMM01', 'Biology and Mathematics', 'SC01'),
('CMM01', 'Chemistry and Mathematics', 'SC01'),
('MPY01', 'Mathematics and Physics', 'SC01'),
('PTE01', 'Primary Teacher Education', 'PE01'); 