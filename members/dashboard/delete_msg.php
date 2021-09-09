<?php include "../../db.php"; ?>
<?php include "../../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['type']) && isset($_GET['mid'])) {

    $id = $_GET['mid'];

    if ($_GET['type'] == 'receiver') {

        // Remove visibility query
        $query = "UPDATE messages SET message_receiver_visible = 0 WHERE message_id = $id";
        $deleteQuery = mysqli_query($connection, $query);
        // Unread the messsage
        $query = "UPDATE messages SET message_read_status = 'read' WHERE message_id = $id";
        $readQuery = mysqli_query($connection, $query);

        header("Location: index.php?src=inbox");
        exit();
    } elseif ($_GET['type'] == 'sender') {

        // Remove visibility query
        $query = "UPDATE messages SET message_sender_visible = 0 WHERE message_id = $id";
        $deleteQuery = mysqli_query($connection, $query);
        // Unread the messsage
        $query = "UPDATE messages SET message_read_status = 'read' WHERE message_id = $id";
        $readQuery = mysqli_query($connection, $query);

        header("Location: index.php?src=message");
        exit();
    } else {

        header("Location: index.php");
        exit;
    }
}
