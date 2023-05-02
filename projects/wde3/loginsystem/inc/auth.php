<?php

/**
* Register a user
*
* @param string $email
* @param string $username
* @param string $password
* @param bool $is_admin
* @return bool
*/
function register_user(string $email, string $username, string $password, string $activation_code, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code, activation_expiry)
            VALUES(:username, :email, :password, :is_admin, :activation_code,:activation_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    return $statement->execute();
}

/**
* Insert student
*
* @param string $stud_fname
* @param string $stud_lname
* @param string $stud_gender
* @param string $stud_dob
* @param int $stud_age
* @param string $stud_email
* @param int $stud_cellnum
* @param string $stud_enrolldate
* @param string $stud_yearlvl
* @param string $stud_program
* @param int $stud_age
* @param string $stud_pic
* @return bool
*/
function insert_student(string $stud_fname, string $stud_lname, string $stud_gender, string $stud_dob, int $stud_age, string $stud_email, int $stud_cellnum, string $stud_enrolldate, string $stud_yearlvl, string $stud_program, string $stud_pic): bool
{
    $sql = 'INSERT INTO student(stud_fname, stud_lname, stud_gender, stud_dob, stud_age, stud_email, stud_cellnum, stud_enrolldate, stud_yearlvl, stud_program, stud_pic)
            VALUES(:fname, :lname, :gender, :dob, :age, :email, :cellnum, :enrolldate, :yearlvl, :program, :pic)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':fname', $stud_fname);
    $statement->bindValue(':lname', $stud_lname);
    $statement->bindValue(':gender', $stud_gender);
    $statement->bindValue(':dob', $stud_dob);
    $statement->bindValue(':age', $stud_age);
    $statement->bindValue(':email', $stud_email);
    $statement->bindValue(':cellnum', $stud_cellnum);
    $statement->bindValue(':enrolldate', $stud_enrolldate);
    $statement->bindValue(':yearlvl', $stud_yearlvl);
    $statement->bindValue(':program', $stud_program);
    $statement->bindValue(':picture', $stud_pic, PDO::PARAM_LOB);

    return $statement->execute();
}

/**
* Insert student
*
* @param string $tchr_fname
* @param string $tchr_lname
* @param string $tchr_gender
* @param string $tchr_dob
* @param int $tchr_age
* @param string $tchr_email
* @param int $tchr_cellnum
* @param string $tchr_department
* @param int $tchr_age
* @param string $tchr_pic
* @return bool
*/
function insert_teacher(string $tchr_fname, string $tchr_lname, string $tchr_gender, string $tchr_dob, int $tchr_age, string $tchr_email, int $tchr_cellnum, string $tchr_department, string $tchr_pic): bool
{
    $sql = 'INSERT INTO teacher(tchr_fname, tchr_lname, tchr_gender, tchr_dob, tchr_age, tchr_email, tchre_cellnum, tchr_department, tchr_pic)
            VALUES(:fname, :lname, :gender, :dob, :age, :email, :cellnum, :department, :pic)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':fname', $tchr_fname);
    $statement->bindValue(':lname', $tchr_lname);
    $statement->bindValue(':gender', $tchr_gender);
    $statement->bindValue(':dob', $tchr_dob);
    $statement->bindValue(':age', $tchr_age);
    $statement->bindValue(':email', $tchr_email);
    $statement->bindValue(':cellnum', $tchr_cellnum);
    $statement->bindValue(':department', $tchr_department);
    $statement->bindValue(':picture', $tchr_pic, PDO::PARAM_LOB);

    return $statement->execute();
}

/**
* Insert course
*
* @param string $crs_code
* @param string $crs_title
* @param int $crs_credits
* @param string $crs_program
* @return bool
*/
function insert_course(string $crs_code, string $crs_title, int $crs_credits, string $crs_program): bool
{
    $sql = 'INSERT INTO course(crs_code, crs_title, crs_credits, crs_program)
            VALUES(:code, :title, :credits, :program)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':code', $crs_code);
    $statement->bindValue(':title', $crs_title);
    $statement->bindValue(':credits', $crs_credits);
    $statement->bindValue(':program', $crs_program);
    return $statement->execute();
}

?>