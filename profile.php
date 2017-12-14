<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];?></h1>

    <form action="/app/auth/pictureUpload.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <!-- Om bild inte finns - visa avatar placeholder-->
            <?php if (!isset($_SESSION['user']['picture'])): ?>
                <img src="app/imgs/avatar_placeholder.png" class="img-thumbnail" width="200px">
            <?php else : ?>
                <img src="app/imgs/<?php echo $_SESSION['user']['picture']?>" class="img-thumbnail" width="20%">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <input type="file" name="picture" accept=".png, .jpg">
            <button type="submit">Upload</button>
        </div>
    </form>
    <form action="/profileEdit.php" method="post">
        <div class="form-group">
            <h3>Biography</h3>
            <p><?php echo $_SESSION['user']['bio'] ?></p>
        </div>

        <div class="form-group">
            <button type="submit" name="edit" class="btn btn-primary">Edit profile</button>
        </div>

    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
