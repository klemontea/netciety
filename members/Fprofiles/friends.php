<?php isLoggedIn(); ?>

<?php
$name = (empty($f_fname)) ? ucfirst($f_username) : ucfirst($f_fname);
?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>
        <?php echo $name; ?>'s Friends
    </h2>
</div>

<div class="row">

    <?php
    // Check if you and this user are friend
    if (!isFriend($self_id, $f_id)) {

        echo "<h5 class='text-secondary mx-auto my-5'>You are not his/her friend. Make a friend with " . $name . " to view their friends.</h5>";
    } else {

        // Get all friends
        $query = "SELECT * FROM friendrequest 
            WHERE sender_id = $self_id AND request_status = 'accept' 
            OR receiver_id = $self_id AND request_status = 'accept'";
        $getFriends = mysqli_query($connection, $query);
        confirmQuery($getFriends);

        if (mysqli_num_rows($getFriends) == 0) {

            echo "<h5 class='mt-5 mx-auto'>" . $name . " hasn't made any friends yet.</h5>";
        } else {

            while ($row = mysqli_fetch_array($getFriends)) {

                // if sender id is not this user, then it's their friends
                if ($row['sender_id'] != $f_id) {

                    $friend_id = $row['sender_id'];
                    $username = getUsername($friend_id);
                    $fname = ucfirst(getFirstName($friend_id));
                    $lname = ucfirst(getLastName($friend_id));
                    $image = getImage($friend_id);

                    // if this sender id is this user, then use receiver id (their friends)
                } elseif ($row['sender_id'] == $f_id) {

                    $friend_id = $row['receiver_id'];
                    $username = getUsername($friend_id);
                    $fname = ucfirst(getFirstName($friend_id));
                    $lname = ucfirst(getLastName($friend_id));
                    $image = getImage($friend_id);
                }

    ?>

                <div class="media my-2 p-3 border w-100 mx-5 bg-light">

                    <!-- Profile picture -->
                    <a class="mr-4" href="../Fprofiles?user=<?php echo $username; ?>">
                        <img src="<?php echo (empty($image)) ? "../../images/memberphoto.png" : "../images/$image"; ?>" alt="Member Profile Picture" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                    </a>

                    <!-- Name & username -->
                    <div class="media-body">
                        <h5 class="mt-0 mb-1">
                            <a href="../Fprofiles?user=<?php echo $username; ?>" class="text-decoration-none">
                                <?php echo (empty($fname)) ? $username : $fname . " " . $lname; ?>
                            </a>
                        </h5>

                        <p class="text-secondary m-0"><i>@<?php echo $username; ?></i></p>
                    </div>
                </div>

    <?php
            }
        }
    }
    ?>

</div>