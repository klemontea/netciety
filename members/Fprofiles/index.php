<?php include "../includes/header.php"; ?>

<?php
if (isset($_GET['user'])) {

    $self_id = $_SESSION['id'];

    // Check if this user profile is yourself
    if ($_GET['user'] == $_SESSION['username']) {

        header("Location: ../dashboard/");
    }

    if (isset($_GET['src'])) {

        $source = $_GET['src'];
    } else {

        $source = '';
    }

    // Friend details query
    $f_username = $_GET['user'];
    $f_id = getID($f_username);
    $f_fname = ucfirst(getFirstName2($f_username));
    $f_lname = ucfirst(getLastName2($f_username));
    $f_image = getImage($f_id);
    $f_countFriend = getTotalFriend2($f_username);
    $f_countPost = getTotalPost2($f_username);
} else {

    header("Location: ../index.php");
}
?>

<div class="container bg-light">
    <div class="row">

        <div class="col-4 border-right">
            <img src="<?php echo (empty($f_image)) ? "../../images/memberphoto.png" : "../images/$f_image"; ?>" alt="profile picture" class="img-thumbnail mx-auto d-block my-3 rounded" style="height:250px;">
        </div>

        <div class="col-8 d-flex flex-column justify-content-between">
            <!-- Header name -->
            <div class="row mt-auto">
                <h2 class="mb-0 ml-3"><?php echo usernameOrName($f_username, $f_fname, $f_lname); ?></h2>
            </div>

            <!-- Username & Friend Status -->
            <div class="row d-flex">
                <div class="col-6 p-0">
                    <p class="ml-3 my-1">@<?php echo $f_username; ?></p>
                </div>

                <?php
                /* 
                Check whether the friendliness status (friend, pending, not friend, y/n decision) 
                between two members
                */

                // Check if they're already friend (2 pov)
                $query1 = "SELECT * FROM friendrequest 
                        WHERE (sender_id = $self_id AND receiver_id = $f_id AND request_status = 'accept')
                        OR (sender_id = $f_id AND receiver_id = $self_id AND request_status = 'accept')";
                $getQuery1 = mysqli_query($connection, $query1);
                confirmQuery($getQuery1);

                // Check if the request is pending (2 pov)
                // 1. POV: the request taker visit sender profile page
                $query2 = "SELECT * FROM friendrequest
                        WHERE sender_id = $f_id AND receiver_id = $self_id AND request_status = 'pending'";
                $getQuery2 = mysqli_query($connection, $query2);
                confirmQuery($getQuery2);

                // 2. POV: the request maker visit request taker profile page
                $query3 = "SELECT * FROM friendrequest 
                                WHERE sender_id = $self_id AND receiver_id = $f_id AND request_status = 'pending'";
                $getQuery3 = mysqli_query($connection, $query3);
                confirmQuery($getQuery3);

                if (mysqli_num_rows($getQuery1) == 1) { ?>

                    <div class="col-4">
                        <p class='m-0 p-0 text-right text-success'>Friend</p>
                    </div>
                    <div class="col-2 p-0 m-0">
                        <a href="../friend_req.php?answer=unfriend&origin=<?php echo $self_id; ?>&target=<?php echo $f_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                Unfriend
                            </button>
                        </a>
                    </div>

                <?php } else if (mysqli_num_rows($getQuery2) == 1) { ?>

                    <div class="col-6 p-0 m-0 text-right">
                        <a href="../friend_req.php?answer=nr&origin=<?php echo $f_id; ?>&target=<?php echo $self_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                Decline Friend Request
                            </button>
                        </a>
                        <a href="../friend_req.php?answer=yr&origin=<?php echo $f_id; ?>&target=<?php echo $self_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-success">
                                Accept Friend Request
                            </button>
                        </a>
                    </div>

                <?php } elseif (mysqli_num_rows($getQuery3) == 1) { ?>

                    <div class="col-4">
                        <p class='m-0 p-0 text-right'>Pending</p>
                    </div>
                    <div class="col-2 p-0 m-0">
                        <a href="../friend_req.php?answer=cancel&origin=<?php echo $self_id; ?>&target=<?php echo $f_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-warning">
                                Cancel
                            </button>
                        </a>
                    </div>

                <?php } else { ?>

                    <!-- If all the above false, then they are not friend -->
                    <div class="col-4">
                        <p class='m-0 p-0 text-right'>Not Friend</p>
                    </div>
                    <div class="col-2 p-0 m-0">
                        <a href="../friend_req.php?answer=invite&origin=<?php echo $self_id; ?>&target=<?php echo $f_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-success">
                                Add Friend
                            </button>
                        </a>
                    </div>

                <?php
                }
                ?>
            </div>

            <ul class="nav nav-tabs  d-flex justify-content-around">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?src=posts&user=<?php echo $f_username; ?>">
                        Posts <span class="badge badge-primary"><?php echo (isFriend($self_id, $f_id)) ? $f_countPost : ""; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?src=friends&user=<?php echo $f_username; ?>">
                        Friends <span class="badge badge-primary"><?php echo (isFriend($self_id, $f_id)) ? $f_countFriend : ""; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?src=media&user=<?php echo $f_username; ?>">
                        Media
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- <div class="row p-0 bg-primary"> -->
    <div class="container mt-3">

        <?php
        switch ($source) {
            case 'posts':
                include "posts.php";
                break;
            case 'friends':
                include "friends.php";
                break;
            case 'media':
                include "media.php";
                break;
            default:
                include "posts.php";
        }
        ?>

    </div>
</div>

<?php include "../includes/footer.php"; ?>