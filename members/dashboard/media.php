<?php isLoggedIn(); ?>

<div class="row">
    <h2 class='my-3 ml-5 text-dark'>Your Photos</h2>
</div>

<div class="row d-flex flex-wrap justify-content-around">

    <?php
    $query = "SELECT * FROM images WHERE image_member_id = $self_id";
    $imageQuery = mysqli_query($connection, $query);
    confirmQuery($imageQuery);

    while ($row = mysqli_fetch_array($imageQuery)) {

        $img_id = $row['image_id'];
        $image = $row['image_picture'];

        if (!empty($image)) {

    ?>

            <div class="col-4">
                <div class="thumbnail mx-auto d-flex flex-column mt-4">
                    <img src=" ../images/<?php echo $image; ?>" alt="Lights" style="width:100%">

                    <div class="row d-flex justify-content-between px-3">
                        <button type=" button" class="btn btn-sm btn-outline-dark my-1" data-toggle="modal" data-target="#img<?php echo $img_id; ?>" style="width:40%;">
                            View
                        </button>

                        <a href="change_profile_picture.php?imgid=<?php echo $img_id; ?>&mid=<?php echo $self_id; ?>">
                            <button type="button" class="btn btn-sm btn-outline-dark my-1" style="width:100%;">
                                Set As Profile Picture
                            </button>
                        </a>
                    </div>
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
    ?>

</div>