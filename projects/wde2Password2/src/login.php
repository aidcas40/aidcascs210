<?php

if (is_user_logged_in()) {
    redirect_to('index.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

    // sanitize & validate user inputs
    [$inputs, $errors] = filter($_POST, [
        'username' => 'string | required',
        'password' => 'string | required'
    ]);

    // if validation error
    if ($errors) {
        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    // if login fails
    if (!login($inputs['username'], $inputs['password'])) {

        $errors['login'] = 'Invalid username or password';

        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    // login successfully
<<<<<<< HEAD
    //redirect_to('index.php');
    redirect_to('/aidcascs210/projects/wde3/html/index.html');
=======
    redirect_to('index.php');
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>