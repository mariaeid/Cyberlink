<?php require __DIR__.'/views/header.php';?>

<article>
    <h1>Edit Profile</h1>

    <form action="app/auth/editDelete.php" method="post">

        <!-- Displaying error messages if there were any when the form was submitted -->
        <div class="form-group">
            <?php if (isset($_SESSION['error'])): ?>
                <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="firstname">First Name:</label>
            <!-- If a user has submitted the form with errors, the data previously entered is shown in the value of the field -->
            <input class="form-control" type="text" name="firstname" value="<?php echo $_SESSION['user']['firstname'];?>" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input class="form-control" type="text" name="lastname" value="<?php echo $_SESSION['user']['lastname'];?>" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email:</label>
            <input class="form-control" type="text" name="email" value="<?php echo $_SESSION['user']['email'];?>" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username: </label>
            <input class="form-control" type="text" name="username" value="<?php echo $_SESSION['user']['username'];?>" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Bio:</label>
            <textarea class="form-control" name="bio" rows="8" cols="80"><?php echo $_SESSION['user']['bio'];?></textarea>
        </div><!-- /form-group -->

        <button type="submit" name="edit" class="btn btnColor">Save Changes</button>
        <button type="submit" name="cancel" class="btn btnColor" formnovalidate>Cancel</button>
        <button type="submit" name="delete" class="btn btn-light" onclick="return confirmDeleteAccount();" formnovalidate ><i class="fa fa-trash-o fa-lg"></i> Delete</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
