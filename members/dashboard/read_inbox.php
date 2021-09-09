<?php include "../includes/header.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['mid'])) {

    $mid = $_GET['mid'];
    $query = "SELECT * FROM messages 
            WHERE message_id = $mid AND message_receiver_visible = 1";
    $getDetails = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($getDetails);
    $sender_id = $row['message_from_id'];
    $subject = $row['message_subject'];
    $date = $row['message_date'];
    $content = $row['message_content'];

    // Get sender username
    $query = "SELECT username FROM member WHERE member_id = $sender_id";
    $getUsername = mysqli_query($connection, $query);
    $username = mysqli_fetch_array($getUsername)['username'];

    // Update read status to read
    $query = "UPDATE messages SET message_read_status = 'read' WHERE message_id = $mid";
    $updateQuery = mysqli_query($connection, $query);
}
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-1 p-0">
            <a href="index.php?src=inbox"><button type="button" class="btn btn-outline-primary w-100">Back</button></a>
        </div>
    </div>

    <div class="row border border-dark bg-info rounded-lg w-75 mx-auto p-4 my-3">
        <div class="col-1 text-dark">
            <p>Sender</p>
            <p>Date</p>
            <p>Subject</p>
            <p>Message:</p>
        </div>
        <div class="col-11">
            <p>: <?php echo ucfirst($username); ?></p>
            <p>: <?php echo $date; ?></p>
            <p>: <?php echo $subject; ?></p>
        </div>
        <p class="border border-dark rounded-lg bg-light m-2 p-2 w-100">
            <?php echo $content; ?>
        </p>
    </div>
</div>