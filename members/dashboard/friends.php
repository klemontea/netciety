<?php isLoggedIn(); ?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>Your Friends</h2>
</div>

<div class="row">

    <?php
    $self_id = $_SESSION['id'];
    $query = "SELECT * FROM friendrequest 
            WHERE sender_id = $self_id AND request_status = 'accept' 
            OR receiver_id = $self_id AND request_status = 'accept'";
    $getQuery = mysqli_query($connection, $query);
    confirmQuery($getQuery);

    if (mysqli_num_rows($getQuery) == 0) {

        echo "<h5 class='mt-5 mx-auto'>You haven't made any friends yet.</h5>";
    } else {

        while ($row = mysqli_fetch_array($getQuery)) {

            // if sender id is not you then it's your friend
            if ($row['sender_id'] != $self_id) {

                $friend_id = $row['sender_id'];
                $username = getUsername($friend_id);
                $fname = ucfirst(getFirstName($friend_id));
                $lname = ucfirst(getLastName($friend_id));
                $image = getImage($friend_id);

                // if this sender id is you then receiver id is ur friend
            } elseif ($row['sender_id'] == $self_id) {

                $friend_id = $row['receiver_id'];
                $username = getUsername($friend_id);
                $fname = ucfirst(getFirstName($friend_id));
                $lname = ucfirst(getLastName($friend_id));
                $image = getImage($friend_id);
            }
    ?>

            <div class="media my-2 p-3 border border-info rounded w-75 mx-auto">

                <a class="mr-4" href="../Fprofiles?user=<?php echo $username; ?>">
                    <img src="<?php echo (empty($image)) ? "../../images/memberphoto.png" : "../images/$image"; ?>" alt="Member Profile Photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                </a>

                <div class="media-body">
                    <div class="row d-flex align-items-center">

                        <!-- Name & username -->
                        <div class="col-9">
                            <h5 class="my-0">
                                <a href="../Fprofiles?user=<?php echo $username; ?>" class="text-decoration-none">
                                    <?php echo (empty($fname)) ? $username : $fname . " " . $lname; ?>
                                </a>
                            </h5>

                            <p class="text-secondary m-0"><i>@<?php echo $username; ?></i></p>
                        </div>

                        <!-- Unfriend button -->
                        <div class="col-3">
                            <a href="../friend_req.php?answer=unfriend&origin=<?php echo $self_id; ?>&target=<?php echo $friend_id; ?>">
                                <button class="btn btn-sm btn-outline-danger float-right">Unfriend</button>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

    <?php
        }
    }
    ?>

</div>