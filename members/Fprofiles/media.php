<?php isLoggedIn(); ?>
<?php
$name = (empty($f_fname)) ? ucfirst($f_username) : ucfirst($f_fname);
?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>
        <?php echo $name; ?>'s Photos
    </h2>
</div>

<div class="row d-flex flex-wrap justify-content-around">

    <?php
    // Check if you and this user are friend
    if (!isFriend($self_id, $f_id)) {

        echo "<h5 class='text-secondary mx-auto my-5'>You are not his/her friend. Make a friend with " . $name . " to view their photos.</h5>";
    } else {

        $query = "SELECT * FROM images WHERE image_member_id = $f_id";
        $imageQuery = mysqli_query($connection, $query);
        confirmQuery($imageQuery);

        while ($row = mysqli_fetch_array($imageQuery)) {

            $img_id = $row['image_id'];
            $image = getImage($img_id);

            if (!empty($image)) {

    ?>

                <!-- <div class="col-4">
                <div class="thumbnail w-75 mx-auto mt-4">
                    <a href="">
                        <img src="../images/<?php echo $image; ?>" alt="Lights" style="width:100%">
                    </a>
                </div>
            </div> -->
                <div class="col-4">
                    <div class="thumbnail mx-auto d-flex flex-column mt-4">
                        <img src=" ../images/<?php echo $image; ?>" alt="Lights" style="width:100%">

                        <button type=" button" class="btn btn-sm btn-outline-dark my-1" data-toggle="modal" data-target="#img<?php echo $img_id; ?>" style="width:40%;">
                            View
                        </button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="img<?php echo $img_id; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <img src="../images/<?php echo $image; ?>" alt="View photo" style="width: 720px;">
                    </div>
                </div>

    <?php
            }
        }
    }
    ?>

</div>