<?php

/* if (is_user_logged_in()) {
redirect_to('index_admin.php');
} */

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'crs_code' => 'string | required | between: 1, 10',
        'crs_title' => 'string | required | between: 1, 40',
        'crs_credits' => 'int | required',
        'crs_program' => 'string | required',
    ];

    // custom messages
    $messages = [
        'crs_code' => [
            'required' => 'Enter a Course Code.'
        ],
        'crs_title' => [
            'required' => 'Enter a Course Title.'
        ],
        'crs_credits' => [
            'required' => 'Enter a Course Credits.'
        ],
        'crs_program' => [
            'required' => 'Select a Course Program.'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('course-add.php', [
            'inputs' => $inputs,
            //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (insert_course($inputs['crs_code'], $inputs['crs_title'], $inputs['crs_credits'], $inputs['crs_program'])) {

        $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
        $stmt = $pdo->query("SELECT MAX(crs_id) AS max_id FROM course");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $crs_id = $row['max_id'];
        redirect_to("course-update.php?crs_id=$crs_id");
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>