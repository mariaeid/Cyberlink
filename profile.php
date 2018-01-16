<?php require __DIR__.'/views/header.php'; ?>

<article>
    <div class="form-group">
        <h1><?php echo $_SESSION['user']['username'];?></h1>
        <h5><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];?></h5>
    </div>

    <form action="/app/auth/pictureUpload.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <!-- Om bild inte finns - visa avatar placeholder-->
            <?php if (!isset($_SESSION['user']['picture'])): ?>
                <img src="app/imgs/site/avatar_placeholder.png" class="img-thumbnail rounded-circle avatarLarge">
            <?php else : ?>
                <img src="app/imgs/avatar/<?php echo $_SESSION['user']['picture']?>" class="img-thumbnail rounded-circle avatarLarge">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <input type="file" name="picture" accept=".png, .jpg">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
    <form action="/profileEdit.php" method="post">
        <div class="form-group border p-3">
            <h3>Biography</h3>
            <p><?php echo $_SESSION['user']['bio'] ?></p>
        </div>

        <div class="form-group">
            <button type="submit" name="edit" class="btn btn-primary">Edit profile</button>
        </div>
    </form>
    <form action="/changePw.php" method="post">
        <div class="form-group">
            <button type="submit" name="changePw" class="btn btn-primary">Change password</button>
        </div>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
