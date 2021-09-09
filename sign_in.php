<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netciety :: Login</title>

    <!-- Load Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-reboot.css" rel="stylesheet">
    <link href="css/bootstrap-grid.css" rel="stylesheet">

    <!-- Own CSS -->
    <!-- <link href="css/styles.css" rel="stylesheet"> -->
</head>

<body>

    <div class="container-fluid bg-dark">
        <!-- Top Nav -->
        <div class="row">
            <h1 class="text-warning ml-4 my-2"><strong><a href='index.php' class="text-decoration-none text-reset">Netciety</a></strong></h1>
        </div>

        <!-- Form -->
        <div class="row h-100 d-flex justify-content-center align-items-center" style="background-image: url('images/index_background.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;">

            <form class="py-3 px-4 my-5 bg-dark text-white border border-secondary rounded d-flex flex-column" action="auth.php" method="post">
                <h2>Sign In</h2>

                <p class="mt-2 text-center">Welcome back!</p>

                <!-- Response -->
                <?php
                if (isset($_GET['msg'])) {

                    $message = $_GET['msg'];
                    echo "<p class='text-danger mt-3 alert alert-danger px-2 py-1' role='alert'>'$message'</p>";
                }
                ?>
                <!-- End Response -->

                <div class="form-group">
                    <label for="UsernameOrEmail">Username/Email</label>
                    <input type="text" id="UsernameOrEmail" name="username_email" class="form-control" placeholder="Enter username/email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                </div>
                <button type="submit" name='login' class="btn btn-success w-100 my-2 justify-center">Sign In</button>

                <p class="text-right my-2">Not a member? Sign up <a href="sign_up.php">here</a></p>
            </form>

        </div>
        <!-- Footer -->
        <div class="row mt-3 ml-1 text-light">
            <div class="col-8">
                <h2 class="text-warning">Netciety</h2>
                <p>&copy; 2021 - &infin; | Netciety</p>
            </div>
            <div class="col text-right">
                <h5 class="text-center">Follow Us</h5>
                <div class="row d-flex justify-content-around">
                    <a href="https://facebook.com" target="_blank" class="p-2 mr-3">
                        <img src="images/fb.png" class="bg-light rounded-circle" style="width: 20px; transform: scale(2);">
                    </a>
                    <a href="https://instagram.com" target="_blank" class="p-2 mr-3">
                        <img src="images/insta.png" style="width: 20px; transform: scale(2);;">
                    </a>
                    <a href="https://youtube.com" target="_blank" class="p-2 mr-3">
                        <img src="images/yt.png" style="width: 20px; transform: scale(2);">
                    </a>
                    <a href="https://twitter.com" target="_blank" class="p-2 mr-3">
                        <img src="images/twitter.png" style="width: 20px; transform: scale(2);">
                    </a>

                </div>
            </div>
        </div>

        <div class="row">
            <p class="text-light mx-auto mt-3">Created by <strong>klemontea</strong></p>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>