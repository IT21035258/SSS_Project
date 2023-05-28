<?php

session_start();
require_once("config.php");

if ($_SESSION['key'] != "AdminKey") {

    echo "<script> location.assign('logout.php'); </script>";
    die;
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Panel</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/style.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row bg-dark text-white">
            <div class="col-1">
                <img src="../Assets/images/vote1.jpg" width="90px">
            </div>

            <div class="col-10 my-auto">
                <h4> Online Voting System - <small> Welcome <?php echo $_SESSION['L_name']; ?></small></h4>

            </div>
        </div>