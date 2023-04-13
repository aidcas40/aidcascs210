<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/reset_password.php';
<<<<<<< HEAD

=======
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
?>

<?php view('header', ['title' => 'CS210 - Aiden Castillo - Reset Password']) ?>

<div class="section-title">
    <h2>Reset Password</h2>
    <p>Please enter a new password.</p>
</div>

<<<<<<< HEAD
=======
<?php if (isset($success)) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php elseif (isset($errors)) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
<form action="reset_password.php" method="post">
    <input type="hidden" name="token" value="<?= $token ?>">
    <div>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password">
        <small><?= $errors['password'] ?? '' ?></small>
    </div>
    <div>
        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>"
               class="<?= error_class($errors, 'password2') ?>">
        <small><?= $errors['password2'] ?? '' ?></small>
    </div>
<<<<<<< HEAD
    <section>
        <button type="submit">Reset Password</button>
        <a href="login.php">Back to Login?</a>
    </section>
=======
    <button type="submit">Reset Password</button>
>>>>>>> f0a8d9797118f6c55fd71175daf6e2821372635b
</form>

<?php view('footer') ?>