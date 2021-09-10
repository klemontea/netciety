<?php include "includes/header.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['pid']) && isset($_GET['prev'])) {

    $self_id = $_SESSION['id'];
    $prev_page = $_GET['prev'];
    $pid = $_GET['pid'];

    if (isset($_GET['favor'])) {

        switch ($_GET['favor']) {
            case 'like':
                likePost($self_id, $pid);
                break;

            case 'unlike':
                dislikePost($self_id, $pid);
                break;
        }
    }

    $query = "SELECT * FROM posts WHERE post_id = $pid";
    $getPosts = mysqli_query($connection, $query);
    $post_row = mysqli_fetch_array($getPosts);

    // Post attribute
    $user_id = $post_row['post_user_id'];
    $username = getUsername($user_id);
    $fname = ucfirst(getFirstName($user_id));
    $lname = ucfirst(getLastName($user_id));
    $image = getImage($user_id);
    $content = $post_row['post_content'];
    $image = $post_row['post_image'];
    $date = $post_row['post_date'];
}
?>

<div class="container">

    <div class="row mt-3">
        <div class="col-1 p-0">
            <a href=<?php echo getLink($prev_page, $username); ?>>
                <button type="button" class="btn btn-outline-primary w-100">Back</button>
            </a>
        </div>
    </div>

    <div class="row rounded-lg w-50 mx-auto my-3">

        <!-- Post -->
        <div class="media mt-2 p-3 border w-100">
            <a class="mr-5" href="Fprofiles?user=<?php echo $username; ?>">
                <img src=<?php echo (empty($image)) ? "../images/memberphoto.png" : "images/$image"; ?> alt="Member Profile Photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
            </a>

            <div class="media-body">
                <div class="row d-flex">
                    <p class="m-0 pt-1">
                        <strong>
                            <a href="profile.php?user=<?php echo $username; ?>">
                                <?php echo usernameOrName($username, $fname, $lname); ?>
                            </a>
                        </strong>
                    </p>

                    <?php if (isOwner($pid)) { ?>

                        <a href="includes/delete_post.php?pid=<?php echo $pid; ?>" class="ml-auto mr-3">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                Delete
                            </button>
                        </a>
                    <?php
                    }
                    ?>
                </div>

                <small><i><?php echo $date; ?></i></small>

                <?php
                // Check if there is image posted
                if (!empty($image)) { ?>
                    <a href="post.php?pid=<?php echo $post_id; ?>&prev=main" class="text-decoration-none text-reset">
                        <div class="row mt-4">
                            <img src='images/<?php echo $image; ?>' alt='posted image' class='w-50 mx-auto border border-warning rounded-lg'>
                        </div>
                    </a>
                <?php
                }
                ?>

                <!-- Post Content -->
                <p class="my-3"><?php echo $content; ?></p>

                <div class="row d-flex justify-content-end">
                    <a href="#comment<?php echo $pid; ?>" class="mr-5 text-decoration-none" data-toggle="collapse" role="button">
                        Comment
                        <span class="badge badge-pill badge-primary">
                            <?php echo getCommentCount($pid); ?>
                        </span>
                    </a>

                    <a href="post.php?pid=<?php echo $pid; ?>&favor=<?php echo (isLike($self_id, $pid)) ? 'unlike' : 'like'; ?>&prev=<?php echo $prev_page; ?>" class="mr-5 text-decoration-none">
                        <?php
                        echo (isLike($self_id, $pid)) ? "<span class='text-danger'>Unlike</span>" : "<span class='text-success'>Like</span>";
                        ?>
                        <span class="badge badge-pill badge-primary">
                            <?php echo getLikeCount($pid); ?>
                        </span>
                    </a>
                </div>

                <!-- Comment form -->
                <form action="add_comment.php" method="post" class="w-100 mt-3">

                    <input type="text" name="prev" value="<?php echo $prev_page; ?>" hidden>
                    <input type="text" name="post_id" value="<?php echo $pid; ?>" hidden>

                    <div class="border-0">
                        <textarea class="rounded-lg px-3" name="comment" rows="2" style="min-width: 100%;"></textarea>
                    </div>

                    <div class="col d-flex justify-content-end">
                        <button type="submit" name="add_comment" class="btn btn-success btn-sm w-25 mr-3">Post</button>
                    </div>
                </form>

                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = $pid";
                $getComments = mysqli_query($connection, $query);

                while ($comment_row = mysqli_fetch_array($getComments)) {

                    $user_id = $comment_row['comment_user_id'];
                    $image = getImage($user_id);
                    $content = $comment_row['comment_content'];
                    $date = $comment_row['comment_date'];

                    // Get username & name
                    $query = "SELECT * FROM member WHERE member_id = $user_id";
                    $getUsers = mysqli_query($connection, $query);
                    $user_row = mysqli_fetch_array($getUsers);
                    $username = $user_row['username'];
                    $fname = $user_row['member_fname'];
                    $lname = $user_row['member_lname'];
                ?>

                    <!-- Comments -->
                    <div class="media mt-3 collapse show" id="comment<?php echo $pid; ?>">

                        <a class="mr-5" href="#">
                            <img src=<?php echo (empty($image)) ? "../images/memberphoto.png" : "images/$image"; ?> alt="Member Profile Picture" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                        </a>
                        <div class="media-body">
                            <p class="m-0 pt-1"><strong><a href=""><?php echo empty($fname) ? ucfirst($username) : $fname . ' ' . $lname; ?></a></strong></p>
                            <small><i><?php echo $date; ?></i></small>
                            <p class="my-3"><?php echo $content; ?></p>
                        </div>

                    </div>

                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>