<?php include "../includes/header.php"; ?>
<?php include "../../db.php"; ?>

<?php
if (isset($_SESSION['id'])) {

    $self_id = $_SESSION['id'];

    if (isset($_GET['src'])) {

        $source = $_GET['src'];
    } else {

        $source = '';
    }

    /* Populate self details */
    $self_username = getUsername($self_id);
    $self_fname = ucfirst(getFirstName($self_id));
    $self_lname = ucfirst(getLastName($self_id));
    $self_image = getImage($self_id);
    $self_countFriend = getTotalFriend($self_id);
    $self_countPost = getTotalPost($self_id);
} else {

    header("../index.php");
}
?>

<div class="container bg-white">
    <div class="row">
        <div class="col-4 border-right">
            <img src=<?php echo (empty($self_image)) ? "../../images/memberphoto.png" : "../images/$self_image"; ?> alt="profile picture" class="img-thumbnail mx-auto d-block my-3 rounded" style="height:250px;">
        </div>

        <div class="col-8 d-flex flex-column justify-content-between">
            <div class="row mt-auto ml-3">
                <h2 class="mb-0"><?php echo usernameOrName($self_username, $self_fname, $self_lname); ?></h2>
            </div>
            <p class="ml-3 mb-1">@<?php echo $self_username; ?></p>

            <ul class="nav nav-tabs  d-flex justify-content-around">
                <li class="nav-item">
                    <a class="nav-link" href="/netciety/members/dashboard?src=posts">
                        Posts
                        <span class="badge badge-primary">
                            <?php echo $self_countPost; ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/netciety/members/dashboard?src=friends">
                        Friends
                        <span class="badge badge-primary">
                            <?php echo $self_countFriend; ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/netciety/members/dashboard?src=media">
                        Media
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/netciety/members/dashboard?src=message">
                        Message
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/netciety/members/dashboard?src=inbox">
                        Inbox
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- <div class="row p-0 bg-primary"> -->
    <div class="container">

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
            case 'message':
                include "message.php";
                break;
            case 'inbox':
                include "inbox.php";
                break;
            case 'sentMsg':
                include "sent_msg.php";
                break;
            default:
                include "posts.php";
        }
        ?>

    </div>
</div>

<?php include "../includes/footer.php"; ?>