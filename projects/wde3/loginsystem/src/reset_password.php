<?php

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
    
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}

// Check if the password was successfully changed and redirect with a success message
if (!empty($_GET['success'])) {
    $success_message = $_GET['success'];
    redirect_with_message('reset_password.php', $success_message, 'success');
}
?>