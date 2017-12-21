<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Change Password</h1>

    <form action="app/auth/editPw.php" method="post">

        <div class="form-group">
            <label for="currentPassword">Current password:</label>
            <input class="form-control" type="password" name="currentPassword" value="<?php ?>" required>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="newPassword">New password:</label>
            <input class="form-control" type="password" name="newPassword" value="<?php ?>" required>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="confirmPassword">Confirm new password:</label>
            <input class="form-control" type="password" name="confirmPassword" value="<?php ?>" required>
        </div><!-- /form-group -->

        <button type="submit" name="editPw" class="btn btn-primary">Save Changes</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
