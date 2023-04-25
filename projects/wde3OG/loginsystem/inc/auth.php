<?php

/**
* Register a user
*
* @param string $email
* @param string $username
* @param string $password
* @param string $picture
* @param bool $is_admin
* @return bool
*/
function register_user(string $email, string $username, string $password, string $picture, string $activation_code, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, picture, is_admin, activation_code, activation_expiry)
            VALUES(:username, :email, :password, :picture, :is_admin, :activation_code,:activation_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':picture', $picture, PDO::PARAM_LOB);
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
            VALUES(:sfname, :slname, :sgender, :sdob, :sage, :semail, :scellnum, :senrolldate, :syearlvl, :sprogram, :spicture)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':sfname', $stud_fname);
    $statement->bindValue(':slname', $stud_lname);
    $statement->bindValue(':sgender', $stud_gender);
    $statement->bindValue(':sdob', $stud_dob);
    $statement->bindValue(':sage', $stud_age);
    $statement->bindValue(':semail', $stud_email);
    $statement->bindValue(':scellnum', $stud_cellnum);
    $statement->bindValue(':senrolldate', $stud_enrolldate);
    $statement->bindValue(':syearlvl', $stud_yearlvl);
    $statement->bindValue(':sprogram', $stud_program);
    $statement->bindValue(':spicture', $stud_pic, PDO::PARAM_LOB);

    return $statement->execute();
}

/**
* Insert teacher
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
    $sql = 'INSERT INTO teacher(tchr_fname, tchr_lname, tchr_gender, tchr_dob, tchr_age, tchr_email, tchr_cellnum, tchr_department, tchr_pic)
            VALUES(:fname, :lname, :gender, :dob, :age, :email, :cellnum, :department, :picture)';

    $statement = db()->prepare($sql);

    $statement->bindParam(':fname', $tchr_fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $tchr_lname, PDO::PARAM_STR);
    $statement->bindParam(':gender', $tchr_gender, PDO::PARAM_STR);
    $statement->bindParam(':dob', $tchr_dob, PDO::PARAM_STR);
    $statement->bindParam(':age', $tchr_age, PDO::PARAM_INT);
    $statement->bindParam(':email', $tchr_email, PDO::PARAM_STR);
    $statement->bindParam(':cellnum', $tchr_cellnum, PDO::PARAM_INT);
    $statement->bindParam(':department', $tchr_department, PDO::PARAM_STR);
    $statement->bindParam(':picture', $tchr_pic, PDO::PARAM_STR);

    return $statement->execute();
}


/**
* Insert student
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