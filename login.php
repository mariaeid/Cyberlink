<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/auth/login.php';
?>

<article>
    <h1>Login</h1>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" required
            value=<?php if (isset($_POST['email'])): ?>
                "<?php echo $email ?>"
            <?php endif; ?>>
            <small class="form-text text-muted">Please provide your email address</small>
            <?php if ($errorEmail): ?>
                <p class="alert alert-danger"><?php echo $errorEmail; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password</small>
            <?php if ($errorPw): ?>
                <p class="alert alert-danger"><?php echo $errorPw; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
