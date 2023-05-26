<?php

$login = false;
$showError = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partials/_dbconnect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql  = "Select * from users where username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num;
    if ($num == 1) {
        $login = true;
        // echo "Login Successfully";
        session_start();
        $_SESSION['loggedin'] = true;
        // $_SESSION['loggedin'] = false;

        $_SESSION['username'] = $username;
        header("location: welcome.php");
    } else {
        $showError = "Invalid Credentials";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php' ?>

    <?php
    if ($login) {


        echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Successfully! </strong>You are Loged
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError) {
        echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong>' . $showError . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-4">
        <h1>login to our website</h1>

        <form method="post" action="/loginsystem/login.php">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>


            <button type="submit" class="btn btn-primary col-md-6">login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>