<?php isLoggedIn(); ?>

<div class="row">
    <div class="col">

        <h3 class="mt-5 mb-3 p-2 bg-warning rounded">Inbox</h3>

        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Status</th>
                    <th scope="col">View Message</th>
                    <th scope="col">Delete Message</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $self_id = $_SESSION['id'];

                // Get all inbox for this user
                $query = "SELECT * FROM messages 
                        WHERE message_to_id = $self_id AND message_receiver_visible = 1";
                $getInbox = mysqli_query($connection, $query);
                if (!$getInbox) {
                    die("ERROR: " . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_array($getInbox)) {

                    $msg_id = $row['message_id'];
                    $from_id = $row['message_from_id'];
                    $date = $row['message_date'];
                    $subject = $row['message_subject'];
                    $status = $row['message_read_status'];

                    $query = "SELECT username FROM member WHERE member_id = $from_id";
                    $getUsername = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($getUsername)
                ?>
                    <tr>
                        <td>
                            <?php echo $date; ?>
                        </td>
                        <td>
                            <?php echo ucfirst($row['username']); ?>
                        </td>
                        <td>
                            <?php echo $subject; ?>
                        </td>
                        <td>
                            <?php echo $status; ?>
                        </td>
                        <td>
                            <a href="read_inbox.php?mid=<?php echo $msg_id; ?>">
                                <button type="button" class="btn btn-sm btn-warning">View</button>
                            </a>
                        </td>
                        <td>
                            <a href="delete_msg.php?mid=<?php echo $msg_id; ?>&type=receiver">
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>

    </div>
</div>