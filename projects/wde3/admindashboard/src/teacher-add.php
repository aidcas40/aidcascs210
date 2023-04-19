<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'tchr_fname' => 'string | required | between: 1, 25',
        'tchr_lname' => 'string | required | between: 1, 25',
        'tchr_gender' => 'string | required | between: 1, 25',
        'tchr_dob' => 'date | required',
        'tchr_age' => 'numeric | required',
        'tchr_email' => 'email | required | email | unique: users, email',
        'tchr_cellnum' => 'numeric | required',
        'tchr_department' => 'string | required',
        'tchr_pic' => 'file| mimetypes:image/jpeg,image/png,image/gif | max:2048 | required'
    ];

    // custom messages
    $messages = [
        'tchr_pic' => [
            'required' => 'You need to choose a photo'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('teacher-add.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (insert_teacher($inputs['tchr_fname'], $inputs['tchr_lname'], $inputs['tchr_gender'], $inputs['tchr_dob'], $inputs['tchr_age'], $inputs['tchr_email'], $inputs['tchr_cellnum'], $inputs['tchr_department'], $inputs['tchr_pic'])) {

        redirect_with_message(
            'teacher-add.php',
            'Successfully added teacher.'
        );
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>