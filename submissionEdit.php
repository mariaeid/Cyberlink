<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/store.php';

?>

<article>
    <h1>Edit Submission</h1>
    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <form action="app/posts/updateDelete.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="url">URL:</label>
                <input class="form-control" type="text" name="url"
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['id']) : ?>
                        value="<?php echo $post['url']; ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="title"
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['id']) : ?>
                        value="<?php echo $post['title']; ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="description">Description:</label>
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['id']) : ?>
                        <textarea class="form-control" name="description" rows="8" cols="80"><?php echo $post['description']; ?></textarea>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <input class="form-control" type="hidden" name="id"
            <?php foreach ($posts as $post): ?>
                <?php if($_POST['post_id'] === $post['id']) : ?>
                    value="<?php echo $post['id']; ?>">
                <?php endif; ?>
            <?php endforeach; ?>

            <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
            <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
