<?php
require __DIR__.'/views/header.php';
// require __DIR__.'/app/auth/login.php';
?>

<article>
    <h1>Login</h1>

    <form action="/app/auth/login.php" method="post">

        <div class="form-group">
            <label for="email">Email</label>
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

        <div class="form-group">
            <?php if (isset($_SESSION['error'])): ?>
                <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
