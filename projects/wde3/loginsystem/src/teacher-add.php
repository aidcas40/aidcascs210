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
        'tchr_cellnum' => 'numeric | required',
        'tchr_department' => 'string | required',
        'tchr_pic' => 'string | required | between: 1, 255'
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
            'inputs' => $inputs,
            //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if ($_FILES['tchr_pic']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "/path/to/upload/directory/";
        $target_file = $target_dir . basename($_FILES["tchr_pic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is a valid image
        if (!empty($_FILES["tchr_pic"]["tmp_name"])) {
            $check = getimagesize($_FILES["tchr_pic"]["tmp_name"]);
            if ($check === false) {
                $errors['tchr_pic'] = 'Invalid image file';
            }
        } else {
            $errors['tchr_pic'] = 'You need to choose a photo';
        }


        // Check file size
        if ($_FILES["tchr_pic"]["size"] > 2048000) {
            $errors['tchr_pic'] = 'File is too large';
        }

        // Allow only certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $errors['tchr_pic'] = "Only JPG, JPEG, PNG & GIF files are allowed";
        }

        if (empty($errors)) {
            if (move_uploaded_file($_FILES["tchr_pic"]["tmp_name"], $target_file)) {
                $inputs['tchr_pic'] = $target_file;
            } else {
                $errors['tchr_pic'] = 'Error uploading file';
            }
        }
    } else {
        $errors['tchr_pic'] = 'You need to choose a photo';
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