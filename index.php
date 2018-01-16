<?php
require __DIR__.'/views/header.php';

//Getting all posts by calling the function allPosts from functions.php
$posts = allPosts($pdo);
?>

<div class="container-fluid">
    <div class="row welcome">
        <div class="col-md-10 py-2">
            <h3>Welcome to <?php echo $config['title']; ?></h3>
            <h6 class="py-3">Find and share your best links.</h6>
        </div>
        <div class="col-md-2">
            <!-- Checking if anyone is logged in and changes the site appearance and functions based on that -->
            <?php if (isset($_SESSION['user'])): ?>
                <p class="pull-right">Logged in as: <?php echo $_SESSION['user']['username']; ?></p>
                <?php if (!isset($_SESSION['user']['picture'])): ?>
                    <img src="app/imgs/site/avatar_placeholder.png" class="img-thumbnail rounded-circle avatarSmall pull-right">
                <?php else : ?>
                    <img src="app/imgs/avatar/<?php echo $_SESSION['user']['picture']?>" class="img-thumbnail rounded-circle avatarSmall pull-right">
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['user'])): ?>
                <form action="/newpost.php" method="post">
                    <div class="form-group">
                        <button type="submit" name="newPost" class="btn btn-light">Add a new post</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<article>
    <!-- Printing out all posts -->
    <?php foreach ($posts as $post): ?>
        <form action="app/posts/vote.php#<?php echo $post['title']; ?>" id="<?php echo $post['title']?>" method="post">
            <div class="border p-3 m-3">
                <a id="<?php echo $post['title']?>" class="siteLink" href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['title']; ?></a>
                <p><?php echo $post['description']; ?></p>
                <p class="fontSmall"> Submitted by <?php echo $post['username']; ?></p>
                <div class="voteContainer">
                    <div class="upVotes">
                        <!-- Count of all upvotes on the post -->
                        <?php $upVotes = allVotes($pdo, $post['post_id'], "1"); ?>
                        <p class="voteNumber pr-1"><?php echo $upVotes['COUNT(*)']; ?></p>
                        <!-- Count on all upvotes on the post by the signed in user -->
                        <?php if (isset($_SESSION['user'])):
                            $upVotesUser = allUserVotes($pdo, $post['post_id'], "1", $_SESSION['user']['user_id']);
                            if (empty($upVotesUser)): ?>
                                <button class="fa fa-arrow-circle-o-up fa-lg voteButton" aria-hidden="true" name="up" onsubmit=""></button>
                                <?php else: ?>
                                    <!-- If the user have upvoted the post aldready the vote button is given a new class  -->
                                    <button class="fa fa-arrow-circle-o-up fa-lg voteButton voteButtonUpClicked" aria-hidden="true" name="up" onsubmit=""></button>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- If not logged in you can't click on the votebutton -->
                            <i class="fa fa-arrow-circle-o-up fa-pull-righ voteButtonUpClicked" aria-hidden="true"></i>
                        <?php endif ; ?>
                    </div>
                    <div class="downVotes">
                        <!-- Count of all  downvotes on the post -->
                        <?php $downVotes = allVotes($pdo, $post['post_id'], "-1"); ?>
                        <p class="voteNumber pr-1"><?php echo $downVotes['COUNT(*)']; ?></p>
                        <!-- Count on all downvotes on the post by the signed in user -->
                        <?php if (isset($_SESSION['user'])):
                            $downVotesUser = allUserVotes($pdo, $post['post_id'], "-1", $_SESSION['user']['user_id']);
                            if (empty($downVotesUser)): ?>
                                <button class="fa fa-arrow-circle-o-down fa-lg voteButton" aria-hidden="true" name="down" onsubmit=""></button>
                                <?php else: ?>
                                    <!-- If the user have upvoted the post aldready the vote button is given a new class  -->
                                    <button class="fa fa-arrow-circle-o-down fa-lg voteButton voteButtonDownClicked" aria-hidden="true" name="down" onsubmit=""></button>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- If not logged in you can't click on the votebutton -->
                            <i class="fa fa-arrow-circle-o-down fa-pull-righ voteButtonDownClicked" aria-hidden="true"></i>
                        <?php endif ; ?>
                    </div>
                </div>
                <!-- Hidden input field to send along the post id when the form is submitted -->
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
            </div>
        </form>
    <?php endforeach; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
