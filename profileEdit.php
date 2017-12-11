<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Edit Profile</h1>

    <form action="app/auth/edit.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input class="form-control" type="text" name="firstname" value="<?php echo $_SESSION['user']['firstname'];?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input class="form-control" type="text" name="lastname" value="<?php echo $_SESSION['user']['lastname'];?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email:</label>
            <input class="form-control" type="text" name="email" value="<?php echo $_SESSION['user']['email'];?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username: </label>
            <input class="form-control" type="text" name="username" value="<?php echo $_SESSION['user']['username'];?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Bio:</label>
            <textarea name="bio" rows="8" cols="80"><?php echo $_SESSION['user']['bio'];?></textarea>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Picture: </label>
            <input type="text" name="picture" value="<?php echo $_SESSION['user']['picture'];?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Password: </label>
            <input class="form-control" type="password" name="password" value="">
        </div><!-- /form-group -->

        <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
