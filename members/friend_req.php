<?php include "../db.php"; ?>
<?php include "../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['answer']) && isset($_GET['origin']) && isset($_GET['target'])) {

    $sender_id = $_GET['origin'];
    $receiver_id = $_GET['target'];
    $answer = $_GET['answer'];
    $prev = $_GET['prev'];

    // Invitation request
    if ($answer == 'invite') {

        // Create a new request
        $query = "INSERT INTO friendrequest(sender_id,receiver_id,request_status,request_date) 
                VALUES($sender_id, $receiver_id, 'pending', now())";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        // The user decided to redo invitation or decline request
    } elseif ($answer == 'cancel' || $answer == 'nr') {

        $query = "DELETE FROM friendrequest 
                WHERE sender_id = $sender_id AND receiver_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);
        $username = getUsername($sender_id);

        // Check whether the response come from user profile or leftbar
        if ($_GET['back'] == 'y') {

            header("Location: index.php?src=friend_req_list");
            exit();
        } else {

            header("Location: profile.php?user=$username");
            exit();
        }

        // One of users decided to unfriend
    } elseif ($answer == 'unfriend') {

        $query = "DELETE FROM friendrequest 
                WHERE sender_id = $sender_id AND receiver_id = $receiver_id 
                OR sender_id = $receiver_id AND receiver_id = $sender_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        $query = "UPDATE member SET member_total_friend = member_total_friend - 1 
                WHERE member_id = $sender_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        $query = "UPDATE member SET member_total_friend = member_total_friend - 1 
                WHERE member_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        // User accept friend invitation
    } elseif ($answer == 'yr') {

        // Change status to accept
        $query = "UPDATE friendrequest SET request_status = 'accept' 
                WHERE sender_id = $sender_id AND receiver_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);
        $username = getUsername($sender_id);

        $query = "UPDATE member SET member_total_friend = member_total_friend + 1 
        WHERE member_id = $sender_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        $query = "UPDATE member SET member_total_friend = member_total_friend + 1 
        WHERE member_id = $receiver_id";
        $executeRequest = mysqli_query($connection, $query);
        confirmQuery($executeRequest);

        // Check whether the response come from user profile or leftbar
        if ($_GET['back'] == 'y') {

            header("Location: index.php?src=friend_req_list");
            exit();
        } else {

            header("Location: profile.php?user=$username");
            exit();
        }

        // Wrong parameter values
    } else {

        header("Location: index.php");
        exit();
    }

    // Done, back to page
    $username = getUsername($receiver_id);
    header("Location: Fprofiles?user=$username");
    exit();

    // Missing parameters
} else {

    header("Location: index.php");
}
