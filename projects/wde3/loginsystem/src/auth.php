<?php
function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, active, email
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function is_user_active($user)
{
    return (int) $user['active'] === 1;
}

function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);

    if ($user && is_user_active($user) && password_verify($password, $user['password'])) {
        // prevent session fixation attack
        session_regenerate_id();

        // set username in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        return true;
    }

    return false;
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}

function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login.php');
    }
}

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}

function send_activation_email(string $email, string $activation_code): void
{
    // create the activation link
    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        ->setUsername('aidencastillo41@gmail.com')
        ->setPassword('pbrsizrztfwtgdpl');

    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Registration Email'))
        ->setFrom(['aidencastillo41@gmail.com' => 'Activation Link'])
        ->setTo([$email])
        ->setBody(
            '<html>' .
            '<head><title>Registration Email</title></head>' .
            '<body>' .
            '<p style="font-family: Roboto, sans-serif; font-size: 20px;">Dear user,</p>' .
            '<p style="font-family: Roboto, sans-serif; font-size: 16px;">Thank you for registering with us! To activate your account, please click the link below:</p>' .
            '<p style="font-family: Roboto, sans-serif; font-size: 16px;">' . $activation_link . '</p>' .
            '<img src="https://media.istockphoto.com/id/1223088904/vector/flag-ribbon-welcome-old-school-flag-banner.jpg?s=612x612&w=0&k=20&c=7YSaR2mu9H2ezvyONvjtqf8HRTzBaya1wNYFfwAiW80=" width = "50%" height = "50%" alt="Logo">' .
            '<p style="font-family: Roboto, sans-serif; font-size: 16px;">Best regards,</p>' .
            '<p style="font-family: Roboto, sans-serif; font-size: 16px;">Aiden Castillo</p>' .
            '</body>' .
            '</html>',
            'text/html'
        );

    // Send the message
    $result = $mailer->send($message);
}

function delete_user_by_id(int $id, int $active = 0)
{
    $sql = 'DELETE FROM users
            WHERE id =:id and active=:active';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':active', $active, PDO::PARAM_INT);

    return $statement->execute();
}

function find_unverified_user(string $activation_code, string $email)
{

    $sql = 'SELECT id, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND email=:email';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // already expired, delete the in active user with expired activation code
        if ((int) $user['expired'] === 1) {
            delete_user_by_id($user['id']);
            return null;
        }
        // verify the password
        if (password_verify($activation_code, $user['activation_code'])) {
            return $user;
        }
    }

    return null;
}

function activate_user(int $user_id): bool
{
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}

/*============================== Forget Password Functions ==================================*/

function find_user_by_email(string $email)
{
    $sql = 'SELECT username, password, active, email
FROM users
WHERE email=:email';
    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function validate_token($email, $token)
{
    $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
    //$pdo = new PDO("mysql:host=sql206.byethost15.com;dbname=b15_33329860_LoginSystem", "b15_33329860", '$T0pDawg#54');
    $sql = "SELECT * FROM users WHERE email = :email AND token = :token
LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'token' => $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? true : false;
}

function login_without_password($email): bool
{
    // find the user by email
    $user = find_user_by_email($email);
    // check if the user exists and is active
    if (is_user_active($user)) {
        // prevent session fixation attack
// prevent session fixation attack
        session_regenerate_id();
        // set username in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    } 
    return false;
}

function current_email()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return null;
    }
    // Get the user's email address from the database
    $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
    //$pdo = new PDO("mysql:host=sql107.byethost7.com;dbname=b7_33470157_LoginSystem", "b7_33470157", "46kgdjbv");
    $stmt = $pdo->prepare("SELECT email FROM users WHERE username = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // Return the email address
    return $result['email'];
}

function update_user_password($username, $new_password)
{
    // Create a PDO instance
    $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
    //$pdo = new PDO("mysql:host=sql107.byethost7.com;dbname=b7_33470157_LoginSystem","b7_33470157", "46kgdjbv");
    $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
    // Prepare and execute the SQL statement to update the user's password
    $stmt = $pdo->prepare("UPDATE users SET password = :new_password WHERE username = :username");
    $stmt->bindParam(':new_password', $password_hash);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    // Check if the update was successful
    return $stmt->rowCount() > 0;
}
?>