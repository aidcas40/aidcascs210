<?php
$inputs = [];
$errors = [];
class Database
{
    private static $instance = null;
    private $connection;
    private function __construct()
    {
        $dsn = 'mysql:host=localhost:3307;dbname=auth;charset=utf8mb4';
        $username = 'root';
        $password = '';
        // important insert your own database here!!!!!!!
        //$dsn = 'mysql:host=sql206.byethost15.com;dbname=b15_33329860_LoginSystem;charset=utf8mb4';
        //$username = 'b15_33329860';
        //$password = '$T0pDawg#54';
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            // handle connection error
        }
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->getConnection();
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
class User
{
    public static function validate_token($email, $token)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND token = :token LIMIT 1";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? true : false;
    }
    public static function set_token($email, $token)
    {
        $sql = "UPDATE users SET token = :token WHERE email = :email";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);
        return $stmt->rowCount() > 0;
    }
    public static function find_by_email($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return !empty($user); // return true if user is found, false otherwise
    }
}
if (is_post_request()) {
    // sanitize & validate user inputs
    [$inputs, $errors] = filter($_POST, [
        'email' => 'email | required | email ',
    ]);
    // if validation error
    if ($errors) {
        redirect_with('forgot.php', [
            'errors' => $errors,
        ]);
    }
    // check if email is in the database
    $email = $inputs['email'];
    $user = User::find_by_email($email); // assuming User is the model representing your users table
    if (!$user) {
        $errors['email'] = 'Email not found';
        redirect_with('forgot.php', [
            'errors' => $errors
        ]);
    } else {
        // get the user's email from the input form
        $email = $_POST['email'];
        // check if the email exists in the database
        if (User::find_by_email($email)) {
            // generate a unique token for the user
            $token = bin2hex(random_bytes(32));
            // set the token and email in the database
            User::set_token($email, $token);
            // create the URL with the embedded token
            $url =
                "http://localhost/projects/wde3/loginsystem/public/access-account.php?email=$email&token=$token"
            ;
            //$url =
            //    "http://aidcascs210.byethost15.com/projects/wde3/loginsystem/public/access-account.php?email=$email&token=$token"
            //;
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('aidencastillo41@gmail.com')
                ->setPassword('pbrsizrztfwtgdpl');
            $mailer = new Swift_Mailer($transport);
            // Create a message
            $message = (new Swift_Message('Forgot Password'))
                ->setFrom(['aidencastillo41@gmail.com' => 'Forgot Password Link'])
                ->setTo([$email])
                ->setBody(
                    '<html>' .
                    '<head>' .
                    '<style>' .
                    'h1 { font-family: Arial, sans-serif; font-size: 16px; }' .
                    '</style>' .
                    '</head>' .
                    '<body>' .
                    '<h1>Hi,<br>It seems you have forgotten your password. <br>Not to worry! Just
                        open this link (one time only):</h1>' .
                    '<h1>Click <a href="' . $url . '">here</a> to access your account.</h1>' .
                    '</body>' .
                    '</html>',
                    'text/html'
                );
            // Send the message
            $result = $mailer->send($message);

            //$errors['message'] = 'Check your email for instructions on how to log in.';
            redirect_with_message(
                'forgot_password.php', 
                'Please check your email to reset your password' 
                //['errors' => $errors,]
            );
        }
    }
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>