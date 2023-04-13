<?php
<<<<<<< HEAD
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
        /*$dsn = 'mysql:host=sql206.byethost15.com;dbname=b15_33329860_LoginSystem;charset=utf8mb4';
        $username = 'b15_33329860';
        $password = '$T0pDawg#54';*/
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
                "http://localhost/aidcascs210/projects/wde2Password2/public/access-account.php?email=$email&token=$token"
            ;
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
=======

if (is_user_logged_in()) {
    redirect_to('index.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'email' => 'email | required | email | exists: users, email'
    ];

    $messages = [
        'email' => [
            'required' => 'Please enter your email address',
            'email' => 'Please enter a valid email address',
            'exists' => 'This email is not registered'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('forgot_password.php', [
            'inputs' => escape_html($inputs),
            'errors' => $errors
        ]);
    }

    $user = find_user_by_email($inputs['email']);

    if ($user) {
        $token = create_password_reset_token();
        create_password_reset($inputs['email'], $token);
        send_password_reset_email($user['email'], $token);
    }

    redirect_with_message(
        'forgot_password.php',
        'Please check your email to reset your password'
    );
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}

render('forgot_password.php', [
    'errors' => $errors,
    'inputs' => $inputs
]);
?>
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
