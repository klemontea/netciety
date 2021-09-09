<?php include "includes/header.php"; ?>
<?php isLoggedIn(); ?>

<!-- Body -->
<div class="container-fluid vh-100 d-flex flex-column">
    <div class="row mt-4">

        <!-- Left Bar -->
        <?php include "includes/leftbar.php"; ?>

        <!-- Middle -->
        <div class="col">
            <h3 class='p-2 text-primary'>Search Results</h3>

            <?php
            if (isset($_POST['search'])) {

                $search = $_POST['finding'];
                $query = "SELECT * FROM member WHERE username LIKE '%$search%' 
                        OR member_fname LIKE '%$search%'
                        OR member_lname LIKE '%$search%'";
                $getQuery = mysqli_query($connection, $query);
                confirmQuery($getQuery);

                if (mysqli_num_rows($getQuery) == 0) {

                    echo "<h5 class='mt-3 text-center'>No result!</h5>";
                } else {

                    echo "<ul class='list-unstyled'>";

                    while ($row = mysqli_fetch_assoc($getQuery)) {

                        $id = $row['member_id'];
                        $username = getUsername($id);
                        $fname = getFirstName($id);
                        $lname = getLastName($id);
                        $member_img = getImage($id);
            ?>

                        <li class="media p-2 mt-1 border border-primary border-left-0 border-right-0 border-top-0">
                            <a class="mr-4" href="Fprofiles?user=<?php echo $username; ?>">
                                <img src="<?php echo (empty($member_img)) ? "../images/memberphoto.png" : "images/$member_img"; ?>" alt="Member Profile Photo" class="border border-dark rounded-circle" style="width:45px; max-height:45px;">
                            </a>

                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="Fprofiles?user=<?php echo $username; ?>" class="text-decoration-none"><?php echo (empty($fname)) ? $username : $fname . " " . $lname; ?></a></h5>
                                <p class="text-secondary m-0"><i>@<?php echo $username; ?></i></p>
                            </div>
                        </li>

            <?php
                    }
                }
            }
            ?>
        </div>

        <!-- Right Bar -->
        <?php include "includes/rightbar.php"; ?>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>