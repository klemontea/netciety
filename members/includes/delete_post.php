<?php session_start(); ?>
<?php include "../../db.php"; ?>
<?php include "../../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['pid'])) {

    $self_id = $_SESSION['id'];
    $post_id = $_GET['pid'];
    $prev = $_GET['prev'];

    // Remove post
    $query = "DELETE FROM posts WHERE post_id = $post_id";
    $deleteQuery = mysqli_query($connection, $query);
    confirmQuery($deleteQuery);

    // Update member post count
    $query = "UPDATE member SET member_total_post = member_total_post - 1 
            WHERE member_id = $self_id";
    $postCount = mysqli_query($connection, $query);
    confirmQuery($postCount);

    if ($prev == 'dash') {

        header("Location: ../dashboard");
        exit();
    } else {

        header("Location: ../index.php");
    }
}
