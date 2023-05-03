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
        'tchr_email' => 'email | required | email | unique: teacher, tchr_email',
        'tchr_cellnum' => 'numeric | required | between: 1, 7',
        'tchr_department' => 'string | required'
    ];

    // custom messages
    $messages = [
        'tchr_fname' => [
            'required' => 'First name is required.',
            'between' => 'First name must be between 1 and 25 characters.'
        ],
        'tchr_lname' => [
            'required' => "Last name is required.",
            'between' => 'Last name must be between 1 and 25 characters.'
        ],
        'stud_gender' => [
            'required' => 'Student gender is required.'
        ],
        'tchr_dob' => [
            'required' => 'Must choose a date of birth.'
        ],
        'tchr_age' => [
            'required' => 'Must enter in an age.'
        ],
        'tchr_email' => [
            'required' => 'Must enter in an email.',
            'unique' => "This email already exists"
        ],
        'tchr_cellnum' => [
            'required' => 'Must enter in a phone number.',
            'between' => 'Phone number must be 7 digits only.'
        ],
        'tchr_department' => [
            'required' => 'Must enter choose a department.'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('teacher-add.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    $data = mysqli_connect($host, $user, $password, $db);

    $tchr_fname = $_POST['tchr_fname'];
    $tchr_lname = $_POST['tchr_lname'];
    $tchr_gender = $_POST['tchr_gender'];
    $tchr_dob = $_POST['tchr_dob'];
    $tchr_age = $_POST['tchr_age'];
    $tchr_email = $_POST['tchr_email'];
    $tchr_cellnum = $_POST['tchr_cellnum'];
    $tchr_department = $_POST['tchr_department'];

    $file = $_FILES['tchr_pic']['name'];
    $dst = "./uploads/" . $file;
    $dst_db = "uploads/" . $file;
    move_uploaded_file($_FILES['tchr_pic']['tmp_name'], $dst);

    $sql = "INSERT INTO teacher(tchr_fname, tchr_lname, tchr_gender, tchr_dob, tchr_age, tchr_email, tchr_cellnum, tchr_department, tchr_pic)
    VALUES('$tchr_fname', '$tchr_lname', '$tchr_gender', '$tchr_dob', '$tchr_age', '$tchr_email', '$tchr_cellnum', '$tchr_department', '$dst_db')";

    $result = mysqli_query($data, $sql);
    
    if ($result) {
        $tchr_id = mysqli_insert_id($data);
        redirect_to("teacher-update.php?tchr_id=$tchr_id");
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
} 
?>