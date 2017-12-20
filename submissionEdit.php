<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/store.php';
?>

<article>
    <h1>Edit Submission</h1>

    <form action="app/posts/update.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="url">URL:</label>
            <input class="form-control" type="text" name="url" value="<?php echo $postId ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" value="<?php ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="bio" rows="8" cols="80"><?php ?></textarea>
        </div><!-- /form-group -->

        <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
