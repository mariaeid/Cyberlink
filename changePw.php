<?php
require __DIR__.'/views/header.php';

?>

<article>
    <h1>Change Password</h1>

    <form action="/app/auth/editPw.php" method="post">

        <!-- Displaying error messages if there were any when the form was submitted -->
        <div class="form-group">
            <?php if (isset($_SESSION['error'])): ?>
                <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="currentPassword">Current password:</label>
            <input class="form-control" type="password" name="currentPassword" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="newPassword">New password:</label>
            <input class="form-control" type="password" name="newPassword" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="confirmPassword">Confirm new password:</label>
            <input class="form-control" type="password" name="confirmPassword" required>
        </div><!-- /form-group -->

        <button type="submit" name="editPw" class="btn btnColor">Save Changes</button>
        <button type="submit" name="cancel" class="btn btnColor" formnovalidate>Cancel</button>

    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
