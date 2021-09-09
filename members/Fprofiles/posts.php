<?php isLoggedIn(); ?>
<?php
$name = (empty($f_fname)) ? ucfirst($f_username) : ucfirst($f_fname);
?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>
        <?php echo $name; ?>'s Posts
    </h2>
</div>

<div class="row">

    <?php
    if (!isFriend($self_id, $f_id)) {

        echo "<h5 class='text-secondary mx-auto my-5'>You are not his/her friend. Make a friend with " . $name . " to view their posts.</h5>";
    } else {

        // Get all posts
        $query = "SELECT * FROM posts WHERE post_user_id = $f_id ORDER BY post_id DESC";
        $getPosts = mysqli_query($connection, $query);
        confirmQuery($getPosts);

        if (mysqli_num_rows($getPosts) == 0) {

            echo "<h5>" . $name . " hasn't made any posts yet.</h5>";
        } else {

            while ($row = mysqli_fetch_array($getPosts)) {

                // Post attribute
                $post_id = $row['post_id'];
                $content = $row['post_content'];
                $image = $row['post_image'];
                $date = $row['post_date'];
    ?>

                <div class="media mt-4 p-3 border border-info rounded-lg mx-auto" style="width: 55%;">

                    <a class="mr-5" href="#">
                        <img src="../../images/memberphoto.png" alt="Member Profile Photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                    </a>

                    <div class="media-body">

                        <p class="m-0">
                            <strong>
                                <a class="text-info text-decoration-none" href="">
                                    <?php echo usernameOrName($f_username, $f_fname, $f_lname); ?>
                                </a>
                            </strong>
                        </p>

                        <small><i><?php echo $date; ?></i></small>

                        <?php
                        // Check if there is image posted
                        if (!empty($image)) { ?>
                            <a href="../post.php?pid=<?php echo $post_id; ?>&prev=dash" class="text-decoration-none text-reset">
                                <div class="row mt-4">
                                    <img src='../images/<?php echo $image; ?>' alt='posted image' class='w-50 mx-auto border border-warning rounded-lg'>
                                </div>
                            </a>
                        <?php
                        }
                        ?>

                        <!-- Post content -->
                        <a href="../post.php?pid=<?php echo $post_id; ?>" class="text-decoration-none text-reset">
                            <p class="my-3"><?php echo $content; ?></p>
                        </a>

                        <a href="../post.php?pid=<?php echo $post_id; ?>" class="text-decoration-none">
                            <div class="row d-flex justify-content-end">
                                <!-- <a href="#comment<?php echo $post_id; ?>" class="mr-5 text-decoration-none" data-toggle="collapse" role="button"> -->
                                <div class="col-xl-3 px-0 text-right text-info">
                                    Comment
                                    <span class="badge badge-pill badge-primary">
                                        <?php echo getCommentCount($post_id); ?>
                                    </span>
                                </div>
                                <!-- </a> -->

                                <!-- <a href="" class="mr-5 text-decoration-none"> -->
                                <div class="col-xl-3 px-0 text-center">
                                    <?php
                                    echo (isLike($self_id, $post_id)) ? "<span class='text-danger'>Unlike</span>" : "<span class='text-success'>Like</span>";
                                    ?>
                                    <span class="badge badge-pill badge-primary">
                                        <?php echo getLikeCount($post_id); ?>
                                    </span>
                                </div>
                                <!-- </a> -->
                            </div>
                        </a>

                    </div>
                </div>

    <?php
            }
        }
    }
    ?>
</div>