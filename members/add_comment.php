<?php session_start(); ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_POST['add_comment'])) {

    $id = $_SESSION['id'];
    $prev = $_POST['prev'];         // Keep record of where the link came from before post.php 
    $post_id = $_POST['post_id'];
    $content = $_POST['comment'];

    // Add comment
    $query = "INSERT INTO comments(comment_post_id,comment_user_id,comment_content,comment_date) 
            VALUES($post_id, $id, '$content', now())";
    $addComment = mysqli_query($connection, $query);
    confirmQuery($addComment);

    // Increment comment count
    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 
            WHERE post_id = $post_id";
    $incrementComment = mysqli_query($connection, $query);
    confirmQuery($incrementComment);

    header("Location: post.php?pid=$post_id&prev=$prev");
}

?>