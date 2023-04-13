<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/forgot_password.php';
?>

<?php view('header', ['title' => 'CS210 - Aiden Castillo - Forgot Password']) ?>

<div class="section-title">
    <h2>Forgot Password Form</h2>
    <p>Please enter your email address to reset your password.</p>
</div>

<?php if (isset($success)) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php elseif (isset($error)) : ?>
    <div class="alert alert-error">
        <?= $error ?>
    </div>
<?php endif ?>

<form action="forgot_password.php" method="post">
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
        <small><?= $errors['email'] ?? '' ?></small>
    </div>
    <button type="submit">Reset Password</button>
</form>

<?php view('footer') ?>
<?php view('forg') ?>