<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'stud_fname' => 'string | required | between: 1, 25',
        'stud_lname' => 'string | required | between: 1, 25',
        'stud_gender' => 'string | required',
        'stud_dob' => 'date | required',
        'stud_age' => 'numeric | required',
        'stud_email' => 'email | required | email | unique: student, stud_email',
        'stud_cellnum' => 'numeric | required | between: 1, 7',
        'stud_enrolldate' => 'date | required',
        'stud_yearlvl' => 'string | required',
        'stud_program' => 'string | required'
    ];

    // custom messages
    $messages = [
        'stud_fname' => [
            'required' => 'First name is required.',
            'between' => 'First name must be between 1 and 25 characters.'
        ],
        'stud_lname' => [
            'required' => 'Last name is required.',
            'between' => 'Last name must be between 1 and 25 characters.'
        ],
        'stud_gender' => [
            'required' => 'Student gender is required.'
        ],
        'stud_dob' => [
            'required' => 'Must choose a date of birth.'
        ],
        'stud_age' => [
            'required' => 'Must enter in an age.'
        ],
        'stud_email' => [
            'required' => 'Must enter in an email.',
            'unique' => "This email already exists"
        ],
        'stud_cellnum' => [
            'required' => 'Must enter in a phone number.',
            'between' => 'Phone number must be 7 digits only.'
        ],
        'stud_enrolldate' => [
            'required' => 'Must choose an enrollment date.'
        ],
        'stud_yearlvl' => [
            'required' => 'Must choose a year level.'
        ],
        'stud_program' => [
            'required' => 'Must choose a program.'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('student-add.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }
    
    $data = mysqli_connect($host, $user, $password, $db);

    $stud_fname = $_POST['stud_fname'];
    $stud_lname = $_POST['stud_lname'];
    $stud_gender = $_POST['stud_gender'];
    $stud_dob = $_POST['stud_dob'];
    $stud_age = $_POST['stud_age'];
    $stud_email = $_POST['stud_email'];
    $stud_cellnum = $_POST['stud_cellnum'];
    $stud_enrolldate = $_POST['stud_enrolldate'];
    $stud_yearlvl = $_POST['stud_yearlvl'];
    $stud_program = $_POST['stud_program'];

    $file = $_FILES['stud_pic']['name'];
    $dst = "./uploads/" . $file;
    $dst_db = "uploads/" . $file;
    move_uploaded_file($_FILES['stud_pic']['tmp_name'], $dst);

    $sql = "INSERT INTO student(stud_fname, stud_lname, stud_gender, stud_dob, stud_age, stud_email, stud_cellnum, stud_enrolldate, stud_yearlvl, stud_program, stud_pic)
    VALUES('$stud_fname', '$stud_lname', '$stud_gender', '$stud_dob', '$stud_age', '$stud_email', '$stud_cellnum', '$stud_enrolldate', '$stud_yearlvl', '$stud_program', '$dst_db')";

    $result = mysqli_query($data, $sql);
    
    if ($result) {
        $stud_id = mysqli_insert_id($data);
        redirect_to("student-update.php?stud_id=$stud_id");
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
?>