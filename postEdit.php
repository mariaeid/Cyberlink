<?php
require __DIR__.'/views/header.php';

//Getting all posts by calling the function allPosts from functions.php
$posts = allPosts($pdo);
?>

<article>
    <h1>Edit post</h1>
    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
        <form action="app/posts/updateDelete.php" method="post">

            <div class="form-group">
                <label for="url">URL:</label>
                <input class="form-control" type="text" name="url" required
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['post_id']) : ?>
                        value="<?php echo $post['url']; ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="title" required
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['post_id']) : ?>
                        value="<?php echo $post['title']; ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="description">Description:</label>
                <?php foreach ($posts as $post): ?>
                    <?php if($_POST['post_id'] === $post['post_id']) : ?>
                        <textarea class="form-control" name="description" rows="8" cols="80" required><?php echo $post['description']; ?></textarea>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- /form-group -->

            <input class="form-control" type="hidden" name="id"
            <?php foreach ($posts as $post): ?>
                <?php if($_POST['post_id'] === $post['post_id']) : ?>
                    value="<?php echo $post['post_id']; ?>">
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="form-group">
                <button type="submit" name="edit" class="btn btnColor">Save Changes</button>
                <button type="submit" name="cancel" class="btn btnColor" formnovalidate>Cancel</button>
                <button type="submit" name="delete" class="btn btn-light" onclick="return confirmDeletePost();" formnovalidate ><i class="fa fa-trash-o fa-lg"></i> Delete</button>
            </div><!-- /form-group -->

        </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
