<?php
require __DIR__.'/views/header.php';
?>

<article>
    <h1>Create Account</h1>

    <form action="/app/auth/add.php" method="post">

        <div class="form-group">
            <?php if (isset($_SESSION['error'])): ?>
                <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input class="form-control" type="firstname" name="firstname" required value=
                <?php if (isset($_SESSION['firstnameSave'])):?>
                    "<?php echo $_SESSION['firstnameSave']?>"
                    <?php unset($_SESSION['firstnameSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input class="form-control" type="lastname" name="lastname" required value=
                <?php if (isset($_SESSION['lastnameSave'])):?>
                    "<?php echo $_SESSION['lastnameSave']?>"
                    <?php unset($_SESSION['lastnameSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email</label>
            <input class="form-control" type="email" name="email" required value=
                <?php if (isset($_SESSION['emailSave'])):?>
                    "<?php echo $_SESSION['emailSave']?>"
                    <?php unset($_SESSION['emailSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required value=
                <?php if (isset($_SESSION['usernameSave'])):?>
                    "<?php echo $_SESSION['usernameSave']?>"
                    <?php unset($_SESSION['usernameSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="confirmPassword">Confirm password:</label>
            <input class="form-control" type="password" name="confirmPassword" required>
        </div><!-- /form-group -->

        <button type="submit" name="add" class="btn btn-primary">Sign Up</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
