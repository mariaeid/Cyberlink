<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app//auth/editPw.php';
?>

<article>
    <h1>Change Password</h1>

    <form action="changePw.php" method="post">

        <div class="form-group">
            <label for="currentPassword">Current password:</label>
            <input class="form-control" type="password" name="currentPassword" required>
            <?php if ($errorCurrent): ?>
                <p class="alert alert-danger"><?php echo $errorCurrent; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="newPassword">New password:</label>
            <input class="form-control" type="password" name="newPassword" required>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="confirmPassword">Confirm new password:</label>
            <input class="form-control" type="password" name="confirmPassword" required>
            <?php if ($errorNew): ?>
                <p class="alert alert-danger"><?php echo $errorNew; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <button type="submit" name="editPw" class="btn btn-primary">Save Changes</button>
        <button type="submit" name="cancel" class="btn btn-primary" formnovalidate>Cancel</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
