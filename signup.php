<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Create Account</h1>

    <form action="app/auth/add.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input class="form-control" type="firstname" name="firstname" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input class="form-control" type="lastname" name="lastname" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastname">Email</label>
            <input class="form-control" type="email" name="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
