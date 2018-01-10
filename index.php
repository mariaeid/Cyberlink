<?php
require __DIR__.'/views/header.php';

$posts = allPosts($pdo);

?>

<div class="container-fluid">
    <div class="row welcome">
        <div class="col-md-10 py-2">
            <h3>Welcome to <?php echo $config['title']; ?></h3>
            <h6 class="py-3">Find and share your best links.</h6>
        </div>
        <div class="col-md-2">
            <?php if (isset($_SESSION['user'])): ?>
                <p class="pull-right">Logged in as: <?php echo $_SESSION['user']['username']; ?></p>
                <?php if (!isset($_SESSION['user']['picture'])): ?>
                    <img src="app/imgs/avatar_placeholder.png" class="img-thumbnail rounded-circle avatarSmall pull-right">
                <?php else : ?>
                    <img src="app/imgs/<?php echo $_SESSION['user']['picture']?>" class="img-thumbnail rounded-circle avatarSmall pull-right">
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['user'])): ?>
                <form action="/newSubmission.php" method="post">
                    <div class="form-group">
                        <button type="submit" name="newPost" class="btn btn-light">Add a new post</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<article>
    <?php foreach ($posts as $post): ?>
        <form action="app/posts/vote.php#<?php echo $post['title']; ?>" id="<?php echo $post['title']?>" method="post">
            <div class="border border-info p-3 m-3">
                <a id="<?php echo $post['title']?>" class="siteLink" href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['title']; ?></a>
                <p><?php echo $post['description']; ?></p>
                <p class="fontSmall"> Submitted by <?php echo $post['post_username']; ?></p>
                <div class="voteContainer">
                    <div class="upVotes">
                        <!-- Count of all upvotes on the post -->
                        <?php
                        $queryUpVotes = $pdo->query('SELECT COUNT(*) FROM votes WHERE direction="1" AND vote_post_id = :post_id');
                        $queryUpVotes->bindParam(':post_id', $post['post_id'], PDO::PARAM_STR);
                        $queryUpVotes->execute();
                        $upVotes = $queryUpVotes->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <p class="voteNumber pr-1"><?php echo $upVotes['COUNT(*)']; ?></p>
                        <!-- Count on all upvotes on the post by the signed in user -->
                        <?php if (isset($_SESSION['user'])):
                        $queryUpVotesUser = $pdo->query('SELECT * FROM votes WHERE direction="1" AND vote_post_id = :post_id AND vote_username = :username');
                        $queryUpVotesUser->bindParam(':post_id', $post['post_id'], PDO::PARAM_STR);
                        $queryUpVotesUser->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
                        $queryUpVotesUser->execute();
                        $upVotesUser = $queryUpVotesUser->fetch(PDO::FETCH_ASSOC);
                            if (empty($upVotesUser)): ?>
                                <button class="fa fa-thumbs-o-up fa-flag voteButton" aria-hidden="true" name="up" onsubmit=""></button>
                                <?php else: ?>
                                    <button class="fa fa-thumbs-o-up fa-flag voteButton voteButtonClicked" aria-hidden="true" name="up" onsubmit=""></button>
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fa fa-thumbs-o-up fa-pull-righ" aria-hidden="true"></i>
                        <?php endif ; ?>
                    </div>
                    <div class="downVotes">
                        <!-- Count of all upvotes on the post -->
                        <?php
                        $queryDownVotes = $pdo->query('SELECT COUNT(*) FROM votes WHERE direction="-1" AND vote_post_id = :post_id');
                        $queryDownVotes->bindParam(':post_id', $post['post_id'], PDO::PARAM_STR);
                        $queryDownVotes->execute();
                        $downVotes = $queryDownVotes->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <p class="voteNumber pr-1"><?php echo $downVotes['COUNT(*)']; ?></p>
                        <!-- Count on all downvotes on the post by the signed in user -->
                        <?php if (isset($_SESSION['user'])):
                        $queryDownVotesUser = $pdo->query('SELECT * FROM votes WHERE direction="-1" AND vote_post_id = :post_id AND vote_username = :username');
                        $queryDownVotesUser->bindParam(':post_id', $post['post_id'], PDO::PARAM_STR);
                        $queryDownVotesUser->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
                        $queryDownVotesUser->execute();
                        $downVotesUser = $queryDownVotesUser->fetch(PDO::FETCH_ASSOC);
                            if (empty($downVotesUser)): ?>
                                <button class="fa fa-thumbs-o-down fa-flag voteButton" aria-hidden="true" name="down" onsubmit=""></button>
                                <?php else: ?>
                                    <button class="fa fa-thumbs-o-down fa-flag voteButton voteButtonClicked" aria-hidden="true" name="down" onsubmit=""></button>
                            <?php endif; ?>
                        <?php else: ?>
                            <i class="fa fa-thumbs-o-up fa-pull-righ" aria-hidden="true"></i>
                        <?php endif ; ?>
                    </div>
                </div>
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
            </div>
        </form>
    <?php endforeach; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
