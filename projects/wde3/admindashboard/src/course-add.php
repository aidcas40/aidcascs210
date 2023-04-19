<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'crs_id' => 'string | required | between: 1, 10',
        'crs_title' => 'string | required | between: 1, 40',
        'crs_credits' => 'numeric | required',
        'crs_program' => 'string | required',
    ];

    // custom messages
    $messages = [
        'crs_id' => [
            'required' => 'Enter a Course Code.'
        ],
        'crs_title' => [
            'required' => 'Enter a Course Title.'
        ],
        'crs_credits' => [
            'required' => 'Enter a Course Credits.'
        ],
        'crs_proram' => [
            'required' => 'Select a Course Program.'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('course-add.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (insert_course($inputs['crs_id'], $inputs['crs_title'], $inputs['crs_credits'], $inputs['crs_program'])) {

        redirect_with_message(
            'course-add.php',
            'Successfully added course.'
        );
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>