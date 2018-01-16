<?php
require __DIR__.'/views/header.php';
?>

<article>
    <h1>Login</h1>

    <form action="/app/auth/login.php" method="post">

        <!-- Showing error message if the form has been submitted with errors -->
        <div class="form-group">
            <?php if (isset($_SESSION['error'])): ?>
                <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <!-- If a user has submitted the form with errors, the data previously entered is shown in the value of the field -->
            <input class="form-control" type="email" name="email" required value=
                <?php if (isset($_SESSION['emailSave'])):?>
                    "<?php echo $_SESSION['emailSave']?>"
                    <?php unset($_SESSION['emailSave']);?>
                <?php endif; ?>>
            <small class="form-text text-muted">Please provide your email address</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
