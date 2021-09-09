<?php include "../db.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['answer'])) {

    $answer = $_GET['answer'];
    $sender_id = $_GET['origin'];
    $receiver_id = $_GET['target'];

    if ($answer == 'yr') {

        $query = "UPDATE friendrequest SET request_status = 'accept' 
                WHERE sender_id = $sender_id AND receiver_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);
    } elseif ($answer == 'nr') {

        $query = "DELETE FROM friendrequest 
                WHERE sender_id = $sender_id AND receiver_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);
    } else {

        header("Location: index.php");
    }
}
?>

<div class="row">
    <h4 class='ml-2 text-dark'>Friend Request: Awaiting Your Response</h4>
</div>

<div class="row">
    <?php
    $self_id = $_SESSION['id'];

    $query = "SELECT * FROM member 
            WHERE member_id IN (SELECT sender_id FROM friendrequest 
                                WHERE receiver_id = $self_id AND request_status = 'pending')";
    $getRequest = mysqli_query($connection, $query);
    confirmQuery($getRequest);

    while ($row = mysqli_fetch_array($getRequest)) {

        $other_id = $row['member_id'];
        $fname = getFirstName($other_id);
        $lname = getLastName($other_id);
        $username = getUsername($other_id);
        $member_img = getImage($other_id);
    ?>

        <div class="media mt-2 p-2 border rounded-lg w-100 ml-2 mr-5 bg-light">

            <img src="<?php echo (empty($member_img)) ? "../images/memberphoto.png" : "images/$member_img"; ?>" alt="profile picture" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">

            <div class="media-body">
                <div class="row d-flex">
                    <h5 class="mt-0 mb-1 ml-3"><?php echo (empty($fname)) ? $username : $fname . " " . $lname; ?></h5>
                    <p class="ml-3 text-secondary">@<?php echo $username; ?></p>
                </div>
                <a href="friend_req.php?answer=yr&origin=<?php echo $other_id; ?>&target=<?php echo $self_id; ?>&back=y" class="mr-3 float-right">
                    <button type="button" class="btn btn-sm btn-outline-success">
                        Accept
                    </button>
                </a>
                <a href="friend_req.php?answer=nr&origin=<?php echo $other_id; ?>&target=<?php echo $self_id; ?>&back=y" class="mr-3 float-right">
                    <button type="button" class="btn btn-sm btn-outline-danger">
                        Decline
                    </button>
                </a>
            </div>

        </div>

    <?php
    }
    ?>

</div>