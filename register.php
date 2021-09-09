<?php
$connection = mysqli_connect('localhost', 'root', '', 'netciety');
?>

<?php
if (isset($_POST['register'])) {

    $firstname = ucfirst(mysqli_real_escape_string($connection, trim($_POST['fname'])));
    $lastname = ucfirst(mysqli_real_escape_string($connection, trim($_POST['lname'])));
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $repassword = mysqli_real_escape_string($connection, $_POST['repassword']);

    if (strlen($username) < 5) {
        $err = 'Username: Must contains at least 5 characters!';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }
    if (preg_match('/[\'^£$%&*()}{@#~>?<>,|=_+¬-]/', $username)) {
        $err = 'Username: Symbol is not allowed, alphanumeric only!';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }
    if ($username != trim($username) || strpos($username, ' ') == true) {
        $err = 'Username: Space is not allowed!';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }
    if ($password !== $repassword) {
        $err = 'Password: Retype Password is not the same with Password!';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }

    // Check for username & email existance in database
    $query = "SELECT * FROM member WHERE username = '$username'";
    $getQuery = mysqli_query($connection, $query);
    if (mysqli_num_rows($getQuery) > 0) {
        $err = 'Username already exist! Pick something else.';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }

    $query = "SELECT * FROM member WHERE member_email = '$email'";
    $getQuery = mysqli_query($connection, $query);
    if (mysqli_num_rows($getQuery) > 0) {
        $err = 'Email already exist! Pick something else.';
        header("Location: sign_up.php?rslt=fail&msg=$err");
        exit;
    }

    // All input valid, then register
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO member(username,member_fname,member_lname,member_email,member_password,member_date_creation) VALUES('$username', '$firstname', '$lastname', '$email', '$password', now())";
    if (!mysqli_query($connection, $query)) {
        echo ("Error description: " . mysqli_error($connection));
    }

    $scss = "Your account has been registered!";
    header("Location: sign_up.php?rslt=success&msg=$scss");
    exit;
}
