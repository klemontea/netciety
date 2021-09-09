<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netciety :: Registration</title>

    <!-- Load Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-reboot.css" rel="stylesheet">
    <link href="css/bootstrap-grid.css" rel="stylesheet">

    <!-- Own CSS -->
    <!-- <link href="css/styles.css" rel=B"stylesheet"> -->
</head>

<body>

    <div class="container-fluid bg-dark">
        <!-- Top Nav -->
        <div class="row">
            <h1 class="text-warning ml-4 my-2"><strong><a href='index.php' class="text-decoration-none text-reset">Netciety</a></strong></h1>
        </div>

        <!-- Form -->
        <div class="row h-100 d-flex justify-content-center align-items-center" style="background-image: url('images/index_background.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;">

            <form class="py-3 px-4 my-5 bg-dark text-white border border-secondary rounded d-flex flex-column" action="register.php" method="post">
                <h2>Sign Up</h2>
                <p class="mt-2">Please enter your details below.</p>

                <!-- Response -->
                <?php
                if (isset($_GET['rslt'])) {

                    if ($_GET['rslt'] == 'fail') {

                        $message = $_GET['msg'];
                        echo "<p class='text-danger mt-3 alert alert-danger px-2 py-1' role='alert'>$message</p>";
                    } else {

                        $message = $_GET['msg'];
                        echo "<p class='text-success mt-3 alert alert-success px-2 py-1' role='alert'>$message<a href='sign_in.php'> Sign In</a></p>";
                    }
                }
                ?>
                <!-- End Response -->

                <small class="text-warning mt-2">* = Field required!</small>
                <div class="form-group mt-1">
                    <label for="fname">First Name: (optional)</label>
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name: (optional)</label>
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label class="mb-0" for="username">Username*:</label>
                    <p class="text-warning p-0 m-0"><small>Alphanumeric only, 5 characters at least. Must not contain symbol!</small></p>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password*:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="repassword">Retype Password*:</label>
                    <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Retype Your Password" required>
                </div>
                <button type="submit" name='register' class="btn btn-success w-100 my-2 justify-center">Sign Up</button>

                <p class="text-right my-2">Already a member? <a href="sign_in.php">Login</a></p>
            </form>

        </div>

        <!-- Footer -->
        <div class="row mt-3 ml-1 text-light">
            <div class="col-8">
                <h2 class="text-warning">Netciety</h2>
                <p>&copy; 2021 - &infin; | Netciety</p>
            </div>
            <div class="col text-right">
                <h4 class="text-center">Follow Us</h4>
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