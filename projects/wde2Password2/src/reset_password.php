<?php

<<<<<<< HEAD
$new_password = [];
$errors = [];
$new_password_errors = [];

if (is_post_request()) {
    // Sanitize and validate user inputs
    [$new_password, $new_password_errors] = filter($_POST, [
        'password' => 'string|required|secure',
        'password2' => 'string|required|same:password'
    ]);

    // If validation error
    if (!empty($new_password_errors)) {
        redirect_with('reset_password.php', [
            'errors' => $new_password_errors,
            'inputs' => $_POST
        ]);
    }

    $username = current_user();
    $email = current_email();
    if (update_user_password($username, $new_password['password'])) {
        success_email($email);
        //$errors['help'] = 'Successfully changed password!.';
        //if (!empty($errors)) {
            //redirect_to('reset_password.php');
            redirect_with_message(
                'reset_password.php', 
                'Successfully changed password.'
            );
        //}

    } else {
        $errors = [
            'message' => 'An error occurred while updating your password. Please try again.'
        ];
        redirect_with('reset_password.php', [
            'errors' => $errors,
            'inputs' => $_POST
        ]);
    }
    
=======
if (is_user_logged_in()) {
    redirect_to('index.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'email' => 'string | required | email',
        'token' => 'string | required',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password'
    ];

    $messages = [
        'password' => [
            'required' => 'Please enter a new password'
        ],
        'password2' => [
            'required' => 'Please confirm your new password',
            'same' => 'The password does not match'
        ]
    ];

    [$inputs, $errors] = filter($_GET, $fields, $messages);

    if ($errors) {
        redirect_with('reset_password.php', [
            'token' => $_GET['token'] ?? '',
            'errors' => $errors
        ]);
    }

    $email = $_GET['email'] ?? '';
    $token = $_GET['token'] ?? '';

    $query = "SELECT token FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $stored_token = $row['token'];

    if ($stored_token !== $token) {
        $errors['email'] = 'Invalid or expired password reset token';
        redirect_with('forgot_password.php', [
            'inputs' => ['email' => $email],
            'errors' => $errors
        ]);
    }

    /*if (!isset($_POST['email']) || empty($_POST['email'])) {
    $errors['email'] = 'Please provide an email address';
    redirect_with('forgot_password.php', [
    'inputs' => ['email' => $inputs['email']],
    'errors' => $errors
    ]);
    }*/

    /*if (!verify_password_reset_token($_GET['email'], $_GET['token'])) {
        $errors['email'] = 'Invalid or expired password reset token';
        redirect_with('forgot_password.php', [
            'inputs' => ['email' => $_GET['email']],
            'errors' => $errors
        ]);
    }*/

    if (isset($email) && reset_password($email, $inputs['password'])) {
        redirect_with_message(
            'login.php',
            'Your password has been reset successfully. Please log in with your new password.'
        );
    } else {
        $errors['email'] = 'Failed to reset password. Please try again later.';
        redirect_with('forgot_password.php', [
            'inputs' => ['email' => $email],
            'errors' => $errors
        ]);
    }
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}

<<<<<<< HEAD
// Check if the password was successfully changed and redirect with a success message
if (!empty($_GET['success'])) {
    $success_message = $_GET['success'];
    redirect_with_message('reset_password.php', $success_message, 'success');
}
=======
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
?>