<?php isLoggedIn(); ?>

<div class="row">
    <div class="col">

        <!-- Header -->
        <div class="row mt-5 mb-3 d-flex bg-warning rounded justify-content-between align-items-center">

            <div class="col-10">
                <h3 class="py-2 m-0">Message You Have Sent</h3>
            </div>

            <div class="col-2 p-0 d-flex">
                <a href="../index.php?src=write_msg" class="w-100">
                    <button type="button" class="btn btn-primary btn-sm float-right mr-3">
                        Write Message
                    </button>
                </a>
            </div>

        </div>

        <!-- Table -->
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Status</th>
                    <th scope="col">View Message</th>
                    <th scope="col">Delete Message</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $self_id = $_SESSION['id'];
                $query = "SELECT * FROM messages 
                        WHERE message_from_id = $self_id AND message_sender_visible = 1";
                $getQuery = mysqli_query($connection, $query);
                if (!$getQuery) {
                    die("ERROR: " . mysqli_error($connection));
                }


                while ($row = mysqli_fetch_array($getQuery)) {

                    $msg_id = $row['message_id'];
                    $receiver_id = $row['message_to_id'];
                    $subject = $row['message_subject'];
                    $content = $row['message_content'];
                    $date = $row['message_date'];
                    $stats = $row['message_read_status'];

                    // Get username of receiver
                    $query = "SELECT username FROM member WHERE member_id = $receiver_id";
                    $getUsername = mysqli_query($connection, $query);
                    $receiver_username = mysqli_fetch_array($getUsername)['username'];
                ?>

                    <tr>
                        <td>
                            <?php echo $date; ?>
                        </td>
                        <td>
                            <?php echo $receiver_username; ?>
                        </td>
                        <td>
                            <?php echo $subject; ?>
                        </td>
                        <td>
                            <?php echo $stats; ?>
                        </td>
                        <td>
                            <a href="read_msg.php?mid=<?php echo $msg_id; ?>">
                                <button type="button" class="btn btn-sm btn-warning">View</button>
                            </a>
                        </td>
                        <td>
                            <a href="delete_msg.php?mid=<?php echo $msg_id; ?>&type=sender">
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