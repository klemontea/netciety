<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "/xampp/htdocs/netciety/db.php"; ?>
<?php include "/xampp/htdocs/netciety/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netciety :: Home</title>

    <!-- Load Bootstrap CSS -->
    <link href="/netciety/css/bootstrap.css" rel="stylesheet">
    <link href="/netciety/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="/netciety/css/bootstrap-grid.css" rel="stylesheet">

    <!-- Own CSS -->
    <!-- <link href="css/styles.css" rel="stylesheet"> -->
</head>

<body>

    <!-- Top Nav -->
    <nav class="navbar navbar-light bg-primary text-light">
        <a href="/netciety/members" class="navbar-brand text-light py-0 my-0">
            <h4>Netciety</h4>
        </a>

        <form class="form-inline my-lg-0 ml-auto mx-auto" method="post" action="/netciety/members/search.php">
            <div class="input-group bg-light rounded-lg">
                <input type="text" name='finding' class="form-control form-control-sm" placeholder="Find people">
                <div class="input-group-append">
                    <button class="btn btn-sm bg-success" type="submit" name="search">Search</button>
                </div>
            </div>
        </form>

        <div class="dropdown mr-1 text-light">
            <a class="btn btn-sm btn-dark px-3 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo (empty($_SESSION['fname'])) ?  ucfirst($_SESSION['username']) : $_SESSION['fname']; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right bg-warning text-light" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/netciety/members/dashboard/">Dashboard</a>
                <a class="dropdown-item" href="#">Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/netciety/sign_out.php">Sign Out</a>
            </div>
        </div>
    </nav>