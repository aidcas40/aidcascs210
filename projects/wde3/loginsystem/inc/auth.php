<?php

/**
* Register a user
*
* @param string $email
* @param string $username
* @param string $password
* @param bool $is_admin
* @param string $picture
* @return bool
*/
function register_user(string $email, string $username, string $password, string $activation_code, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false, string $picture = 'uploads/default.png'): bool
{
    $sql = 'INSERT INTO users(username, email, password, picture, is_admin, activation_code, activation_expiry)
            VALUES(:username, :email, :password, :picture, :is_admin, :activation_code,:activation_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':picture', $picture);
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $expiry));

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