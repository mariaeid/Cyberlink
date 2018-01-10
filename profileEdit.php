<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Edit Profile</h1>

    <form action="app/auth/edit.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="firstname">First Name:</label>
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

        <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
        <button type="submit" name="cancel" class="btn btn-primary" formnovalidate>Cancel</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
