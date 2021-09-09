<?php isLoggedIn(); ?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>Your Posts</h2>
</div>

<div class="row">

    <?php
    // Get all posts
    $query = "SELECT * FROM posts WHERE post_user_id = $self_id ORDER BY post_id DESC";
    $getPosts = mysqli_query($connection, $query);
    confirmQuery($getPosts);

    if (mysqli_num_rows($getPosts) == 0) {

        echo "<h5 class='mt-5 mx-auto'>You haven't made any posts yet.</h5>";
    } else {

        while ($row = mysqli_fetch_array($getPosts)) {

            // Post attribute
            $post_id = $row['post_id'];
            $content = $row['post_content'];
            $image = $row['post_image'];
            $date = $row['post_date'];
    ?>

            <div class="media mt-4 p-3 border border-dark rounded-lg mx-auto" style="width: 55%;">

                <!-- Profile picture -->
                <a class="mr-4" href="../Fprofiles?user=<?php echo $self_username; ?>">
                    <img src=<?php echo (empty($self_image)) ? "../../images/memberphoto.png" : "../images/$self_image"; ?> alt="Member Profile Photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                </a>

                <!-- Main body -->
                <div class="media-body">
                    <div class="row d-flex">

                        <p class="m-0 pt-1 ml-3">
                            <strong class='text-info'>
                                <a href="../Fprofiles?user=<?php echo $self_username; ?>" class="text-reset text-decoration-none">
                                    <?php echo usernameOrName($self_username, $self_fname, $self_lname); ?>
                                </a>
                            </strong>
                        </p>

                        <?php if (isOwner($post_id)) { ?>

                            <a href="../includes/delete_post.php?pid=<?php echo $post_id; ?>&prev=dash" class="ml-auto mr-3">
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

                        <a href="../post.php?pid=<?php echo $post_id; ?>&prev=dash" class="text-decoration-none text-reset">
                            <div class="row mt-4">
                                <img src='../images/<?php echo $image; ?>' alt='posted image' class='w-50 mx-auto border border-warning rounded-lg'>
                            </div>
                        </a>

                    <?php
                    }
                    ?>

                    <!-- Post Content -->
                    <a href="../post.php?pid=<?php echo $post_id; ?>&prev=dash" class="text-decoration-none text-reset">
                        <p class="my-3"><?php echo $content; ?></p>
                    </a>

                    <!-- Comment & like -->
                    <a href="../post.php?pid=<?php echo $post_id; ?>&prev=dash" class="text-decoration-none">
                        <div class="row d-flex justify-content-end">

                            <div class="col-xl-3 px-0 text-right text-info">
                                Comment
                                <span class="badge badge-pill badge-primary">
                                    <?php echo getCommentCount($post_id); ?>
                                </span>
                            </div>

                            <div class="col-xl-3 px-0 text-center">
                                <?php
                                echo (isLike($self_id, $post_id)) ? "<span class='text-danger'>Unlike</span>" : "<span class='text-success'>Like</span>";
                                ?>
                                <span class="badge badge-pill badge-primary">
                                    <?php echo getLikeCount($post_id); ?>
                                </span>
                            </div>

                        </div>
                    </a>

                </div>
            </div>
    <?php
        }
    }
    ?>
</div>