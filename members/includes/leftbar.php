<?php
// Get # of friend request
$self_id = $_SESSION['id'];

$query = "SELECT * FROM friendrequest 
        WHERE receiver_id = $self_id AND request_status = 'pending'";
$getQuery = mysqli_query($connection, $query);
$count = mysqli_num_rows($getQuery);

// Get if there's new inbox
$query = "SELECT * FROM messages 
        WHERE message_to_id = $self_id AND message_read_status = 'unread'";
$newMessage = mysqli_query($connection, $query);
?>

<div class="col-3">
    <a class="text-reset text-decoration-none" href="/netciety/members/dashboard">
        <p class="lead p-1 mb-0 border border-info rounded text-center text-primary">
            <strong>
                Hello, <?php echo usernameOrName($_SESSION['username'], $_SESSION['fname'], ''); ?>
            </strong>
        </p>
    </a>
    <ul class="list-group">
        <a class="text-decoration-none" href="/netciety/members">
            <li class="list-group-item list-group-item-action list-group-item-primary rounded-top border-0 px-3">
                Home
            </li>
        </a>
        <a class="text-decoration-none" href="./index.php?src=write_msg">
            <li class="list-group-item list-group-item-action list-group-item-primary rounded-top border-0 px-3">
                Write a Message
            </li>
        </a>
        <a class="text-decoration-none" href="dashboard?src=inbox">
            <li class="list-group-item list-group-item-action list-group-item-primary border-0 px-3">
                Inbox<?php echo (mysqli_num_rows($newMessage) > 0) ? "<span class='badge badge-pill badge-primary float-right px-2 m-1'>New</span>" : ""; ?>
            </li>
        </a>
        <a class="text-decoration-none" href="/netciety/members/?src=friend_req_list">
            <li class="list-group-item list-group-item-action list-group-item-primary border-0 px-3">
                Friend Request<span class="badge badge-pill badge-primary float-right m-1"><?php echo $count; ?></span>
            </li>
        </a>
    </ul>

    <a href="../../sign_out.php"><button type="button" class="btn btn-sm btn-outline-danger w-100 mt-4">Log Out</button></a>
</div>