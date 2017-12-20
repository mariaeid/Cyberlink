<?php
require __DIR__.'/views/header.php';
?>

<article>

    <form action="/app/posts/store.php" method="post">
        <h4>Add link</h4>
        <div class="form-group">
            <label for="url">URL:</label>
            <input class="form-control" type="text" name="url">
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" rows="8" cols="80"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="store" class="btn btn-primary">Submit</button>
        </div>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
