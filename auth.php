<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<?php
if (isset($_POST['login'])) {

    $username_email = mysqli_real_escape_string($connection, trim($_POST['username_email']));
    $password = mysqli_real_escape_string($connection, trim($_POST['password']));

    $query = "SELECT * FROM member 
            WHERE username = '$username_email' OR member_email = '$username_email'";
    $getQuery = mysqli_query($connection, $query);
    confirmQuery($getQuery);

    if (mysqli_num_rows($getQuery) == 1) {

        $user_row = mysqli_fetch_array($getQuery);
        $db_id = $user_row['member_id'];
        $db_username = $user_row['username'];
        $db_fname = $user_row['member_fname'];
        $db_lname = $user_row['member_lname'];
        $db_password = $user_row['member_password'];

        if (password_verify($password, $db_password)) {

            $_SESSION['id'] = $db_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['fname'] = $db_fname;
            $_SESSION['lname'] = $db_lname;

            header("Location: members");
            exit();
        } else {

            header("index.php");
            exit();
        }
    } else {

        header("index.php");
        exit();
    }
}
