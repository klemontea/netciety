<?php include "../../db.php"; ?>
<?php include "../../functions.php"; ?>
<?php isLoggedIn(); ?>

<?php
if (isset($_GET['imgid']) && isset($_GET['mid'])) {

    $img_id = $_GET['imgid'];
    $member_id = $_GET['mid'];

    // Get image name
    $query = "SELECT * FROM images WHERE image_id = $img_id";
    $imgQuery = mysqli_query($connection, $query);
    $img_row = mysqli_fetch_array($imgQuery);
    $image_name = $img_row['image_picture'];

    // Update member picture
    $query = "UPDATE member SET member_profile_photo = '$image_name' 
            WHERE member_id = $member_id";
    $updateQuery = mysqli_query($connection, $query);

    header("Location: index.php?src=media");
}
