<?php session_start(); ?>
<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_POST['send'])) {

    $from = $_SESSION['id'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Record message to database
    $query = "INSERT INTO messages(message_from_id,message_to_id,message_subject,message_content,
            message_date) VALUES($from, $to, '$subject', '$message', now())";
    $sendMessage = mysqli_query($connection, $query);
    if (!$sendMessage) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }

    header("Location: index.php?src=write_msg");
}
?>