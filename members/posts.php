<?php isLoggedIn(); ?>

<!-- Writing form -->
<div class="row d-flex mr-1 rounded-lg border border-primary">

    <form class="w-100 d-flex flex-column" action="add_post.php" method="post" enctype="multipart/form-data">

        <div class="form-group m-3">
            <textarea type="text" name="content" class="form-control w-100" rows="3" placeholder="Write something"></textarea>
        </div>

        <div class="row px-3">

            <div class="col-9">
                <div class="input-group mb-3 w-75">
                    <!-- <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="uploadImage"> -->
                    <div class="custom-file">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark border-0"><img src="../images/picturelogo.png" alt="Picture logo" style="width:20px;"></span>
                        </div>
                        <input type="file" name="image" id="image">
                    </div>
                </div>
            </div>

            <div class="col-3">
                <button type="submit" name="post" class="btn btn-success btn-sm w-100">Post</button>
            </div>

        </div>

    </form>

</div>

<!-- Posted -->
<div class="row mr-1 mt-3 rounded-lg">

    <?php
    $self_id = $_SESSION['id'];

    // User can only see post of their friend and theirself
    $query = "SELECT * FROM posts WHERE post_user_id IN (
                            SELECT sender_id FROM friendrequest 
                                WHERE receiver_id = $self_id AND request_status = 'accept') 
                        OR post_user_id IN 
                            (SELECT receiver_id FROM friendrequest 
                                WHERE sender_id = $self_id AND request_status = 'accept')
                        OR post_user_id = $self_id 
                        ORDER BY post_id DESC";
    $postQuery = mysqli_query($connection, $query);

    while ($post_row = mysqli_fetch_array($postQuery)) {

        // Member attribute
        $user_id = $post_row['post_user_id'];
        $username = getUsername($user_id);
        $fname = ucfirst(getFirstName($user_id));
        $lname = ucfirst(getLastName($user_id));
        $user_img = getImage($user_id);

        // Post attribute
        $post_id = $post_row['post_id'];
        $content = $post_row['post_content'];
        $image = $post_row['post_image'];
        $date = $post_row['post_date'];
    ?>

        <!-- Post -->
        <div class="media mt-2 p-3 border border-dark rounded w-100">

            <!-- Profile picture -->
            <a href="Fprofiles?user=<?php echo $username; ?>" class="mr-4">
                <img src=<?php echo (empty($user_img)) ? "../images/memberphoto.png" : "images/$user_img"; ?> alt="member profile photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
            </a>

            <!-- Main body -->
            <div class="media-body">
                <div class="row d-flex">

                    <p class="m-0 pt-1 ml-3">
                        <strong>
                            <a href="Fprofiles?user=<?php echo $username; ?>" class="text-decoration-none text-info">
                                <?php echo empty($fname) ? ucfirst($username) : $fname . ' ' . $lname; ?>
                            </a>
                        </strong>
                    </p>

                    <?php if (isOwner($post_id)) { ?>

                        <a href="includes/delete_post.php?pid=<?php echo $post_id; ?>" class="ml-auto mr-3">
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
                <a href="post.php?pid=<?php echo $post_id; ?>&prev=main" class="text-decoration-none text-reset">
                    <p class="my-4"><?php echo $content; ?></p>
                </a>

                <!-- Comment & like -->
                <a href="post.php?pid=<?php echo $post_id; ?>&prev=main" class="text-decoration-none">
                    <div class="row d-flex justify-content-end">

                        <div class="col-xl-3 px-0 text-right">
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
    ?>
    <!-- before -->

</div>