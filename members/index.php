<?php include "includes/header.php"; ?>
<?php isLoggedIn(); ?>

<?php if (isset($_GET['src'])) {
    $source = $_GET['src'];
} else {
    $source = '';
}
?>

<!-- Body -->
<div class="container-fluid vh-100 d-flex flex-column">
    <div class="row mt-4">

        <!-- Left Bar -->
        <?php include "includes/leftbar.php"; ?>

        <!-- Middle -->
        <div class="col-6">

            <?php
            switch ($source) {
                case 'comments':
                    include "comments.php";
                    break;
                case 'friend_req_list':
                    include "friend_req_list.php";
                    break;
                case 'write_msg':
                    include "write_msg.php";
                    break;
                default:
                    include "posts.php";
                    break;
            }
            ?>

        </div>

        <!-- Right Bar -->
        <?php include "includes/rightbar.php"; ?>

    </div>

    <div class="row mt-auto">
        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
    </div>