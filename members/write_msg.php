<?php isLoggedIn(); ?>

<div class="row">
    <div class="col">
        <form action="send_msg.php" method="post" class="bg-light border border-primary rounded-lg px-3 py-3 w-75 mx-auto">

            <div class="form-group mb-1">
                <label for="to">To:</label>
                <select class="form-control" id="to" name='to'>
                    <option>Choose Friend</option>

                    <?php
                    $self_id = $_SESSION['id'];

                    // Gather all this user's friends
                    $query = "SELECT * FROM member WHERE member_id IN 
                                (SELECT receiver_id FROM friendrequest 
                                    WHERE sender_id = $self_id AND request_status = 'accept') 
                                OR member_id IN
                                (SELECT sender_id FROM friendrequest
                                    WHERE receiver_id = $self_id AND request_status = 'accept')";
                    $getQuery = mysqli_query($connection, $query);
                    if (!$getQuery) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($getQuery)) {

                        $id = $row['member_id'];
                        $username = ucfirst($row['username']);
                        echo "<option value=$id>$username</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="form-group mb-1">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control form-control-sm" id="subject" name="subject">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control form-control-sm" id="message" name="message" rows="2"></textarea>
            </div>

            <button type="submit" name="send" class="btn btn-success">Send</button>
        </form>
    </div>
</div>