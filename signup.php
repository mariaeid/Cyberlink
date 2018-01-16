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
                <?php if (isset($_SESSION['save']['firstnameSave'])):?>
                    "<?php echo $_SESSION['save']['firstnameSave']?>"
                    <?php unset($_SESSION['save']['firstnameSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input class="form-control" type="lastname" name="lastname" required value=
                <?php if (isset($_SESSION['save']['lastnameSave'])):?>
                    "<?php echo $_SESSION['save']['lastnameSave']?>"
                    <?php unset($_SESSION['save']['lastnameSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email</label>
            <input class="form-control" type="email" name="email" required value=
                <?php if (isset($_SESSION['save']['emailSave'])):?>
                    "<?php echo $_SESSION['save']['emailSave']?>"
                    <?php unset($_SESSION['save']['emailSave']);?>
                <?php endif; ?>>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required value=
                <?php if (isset($_SESSION['save']['usernameSave'])):?>
                    "<?php echo $_SESSION['save']['usernameSave']?>"
                    <?php unset($_SESSION['save']['usernameSave']);?>
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

        <button type="submit" name="add" class="btn btnColor">Sign Up</button>
        <button type="submit" name="cancel" class="btn btnColor">Cancel</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
