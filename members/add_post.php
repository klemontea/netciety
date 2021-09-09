<?php session_start(); ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_POST['post'])) {

    $id = $_SESSION['id'];
    $content = $_POST['content'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    if (empty($post_image) && empty($content)) {

        header("Location: index.php");
        exit();
    }
    move_uploaded_file($post_image_temp, "images/$post_image");

    // Add post query
    $query = "INSERT INTO posts(post_user_id,post_content,post_image,post_date) 
            VALUES($id, '$content', '$post_image', now())";
    $addQuery = mysqli_query($connection, $query);
    confirmQuery($addQuery);

    // Update member post count
    $query = "UPDATE member SET member_total_post = member_total_post + 1
            WHERE member_id = $id";
    $postCount = mysqli_query($connection, $query);
    confirmQuery($postCount);

    // Create image
    $query = "INSERT INTO images(image_member_id,image_picture,image_date) 
            VALUES($id, '$post_image', now())";
    $imageQuery = mysqli_query($connection, $query);
    confirmQuery($imageQuery);

    header("Location: index.php");
    exit();
} else {

    header("Location: index.php");
}
