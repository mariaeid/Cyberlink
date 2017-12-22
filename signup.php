<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/auth/add.php';
?>

<article>
    <h1>Create Account</h1>

    <form action="signup.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input class="form-control" type="firstname" name="firstname" required
            value=<?php if (isset($_POST['firstname'])): ?>
                "<?php echo $firstname ?>"
            <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input class="form-control" type="lastname" name="lastname" required
            value=<?php if (isset($_POST['lastname'])): ?>
                "<?php echo $lastname ?>"
            <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email</label>
            <input class="form-control" type="email" name="email" required
            value=<?php if (isset($_POST['email'])): ?>
                "<?php echo $email ?>"
            <?php endif; ?>>
            <?php if ($emailExists): ?>
                <p class="alert alert-danger"><?php echo $emailExists; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required
            value=<?php if (isset($_POST['username'])): ?>
                "<?php echo $username ?>"
            <?php endif; ?>>
            <?php if ($usernameExists): ?>
                <p class="alert alert-danger"><?php echo $usernameExists; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
