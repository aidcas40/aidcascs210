<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'fname' => 'string | required | between: 1, 25',
        'lname' => 'string | required | between: 1, 25',
        'social' => 'string',
        'picture' => 'string'
    ];

    // custom messages
    $messages = [
        'fname' => [
            'required' => 'You need to enter in your first name.',
        ],
        'lname' => [
            'required' => 'You need to enter in your last name.'
        ]
        
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('users-profile.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>