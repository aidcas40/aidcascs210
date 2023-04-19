<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'stud_fname' => 'string | required | between: 1, 25',
        'stud_lname' => 'string | required | between: 1, 25',
        'stud_gender' => 'string | required | between: 1, 25',
        'stud_dob' => 'date | required',
        'stud_age' => 'numeric | required',
        'stud_email' => 'email | required | email | unique: users, email',
        'stud_cellnum' => 'numeric | required',
        'stud_enrolldate' => 'date | required',
        'stud_yearlvl' => 'string | required',
        'stud_program' => 'string | required',
        'stud_pic' => 'file| mimetypes:image/jpeg,image/png,image/gif | max:2048 | required'
    ];

    // custom messages
    $messages = [
        'stud_pic' => [
            'required' => 'You need to choose a photo'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('student-add.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (insert_student($inputs['stud_fname'], $inputs['stud_lname'], $inputs['stud_gender'], $inputs['stud_dob'], $inputs['stud_age'], $inputs['stud_email'], $inputs['stud_cellnum'], $inputs['stud_enrolldate'], $inputs['stud_yearlvl'], $inputs['stud_program'], $inputs['stud_pic'])) {

        redirect_with_message(
            'student-add.php',
            'Successfully added student.'
        );
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>