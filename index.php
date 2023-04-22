 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- ===== Iconscout CSS ===== -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

     <!-- ===== CSS ===== -->
     <link rel="stylesheet" href="./Assets/css/login.css">
     <link rel="stylesheet" href="./Assets/css/style.css">
     <link rel="stylesheet" href="./Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



     <!--<title>Login & Registration Form</title>-->
 </head>

 <body>

     <div class="container vh-100">
         <div class="d-flex justify-content-center h-100">
             <div class="user_card w-90 my-auto">
                 <div class="d-flex justify-content-center">
                     <div class="brand_logo_container">
                         <img src="./Assets/images/Voting-image-6-scaled.jpg" class="brand_logo" alt="Logo">
                     </div>
                 </div>

                 <?php
                    if (isset($_GET['sign-up'])) {
                    ?>
                     <div class="d-flex justify-content-center form_container">
                         <form method="POST">
                             <div class="input-group mb-3">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-user"></i></span>
                                 </div>
                                 <input type="text" name="R_name" class="form-control input_user" placeholder="UserName" required />
                             </div>
                             <div class="input-group mb-2">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-key"></i></span>
                                 </div>
                                 <input type="email" name="R_email" class="form-control input_pass" placeholder="Email" required />
                             </div>
                             <div class="input-group mb-2">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-key"></i></span>
                                 </div>
                                 <input type="password" name="R_pass" class="form-control input_pass" placeholder="Password" required />
                             </div>
                             <div class="input-group mb-2">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-key"></i></span>
                                 </div>
                                 <input type="password" name="RC_pass" class="form-control input_pass" placeholder="Confirm Password" required />
                             </div>

                             <div class="d-flex justify-content-center mt-3 login_container">
                                 <button type="submit" name="sign_up_btn" class="btn login_btn">Sign Up</button>
                             </div>
                         </form>
                     </div>

                     <div class="mt-4">
                         <div class="d-flex justify-content-center links text-white">
                             Already Created Account? <a href="index.php" class="ml-2 text-white">Sign In</a>
                         </div>
                     </div>
                 <?php
                    } else {
                    ?>
                     <div class="d-flex justify-content-center form_container">
                         <form method="POST">
                             <div class="input-group mb-3">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-user"></i></span>
                                 </div>
                                 <input type="text" name="L_name" class="form-control input_user" placeholder="UserName" required />
                             </div>
                             <div class="input-group mb-2">
                                 <div class="input-group-append">
                                     <span class="input-group-text"><i class="fas fa-key"></i></span>
                                 </div>
                                 <input type="Password" name="L_password" class="form-control input_pass" placeholder="Password" required />
                             </div>
                             <div class="d-flex justify-content-center mt-3 login_container">
                                 <button type="submit" name="loginBtn" class="btn login_btn">Login</button>
                             </div>
                         </form>
                     </div>

                     <div class="mt-4">
                         <div class="d-flex justify-content-center links text-white">
                             Don't have an account? <a href="?sign-up=1" class="ml-2 text-white">Sign Up</a>
                         </div>
                         <div class="d-flex justify-content-center links">
                             <a href="#" class="text-white">Forgot your password?</a>
                         </div>
                     </div>
                 <?php
                    }

                    ?>

                 <?php
                    if (isset($_GET['registered'])) {
                    ?>
                     <span class="bg-white text-success text-center my-4"> Your account has been created successfully! </span>
                 <?php
                    } else if (isset($_GET['invalid'])) {
                    ?>
                     <span class="bg-white text-danger text-center my-3"> Passwords mismatched, please try again! </span>
                 <?php
                    } else if (isset($_GET['not_registered'])) {
                    ?>
                     <span class="bg-white text-warning text-center my-3"> Sorry, you are not registered! </span>
                 <?php
                    } else if (isset($_GET['invalid_access'])) {
                    ?>
                     <span class="bg-white text-danger text-center my-3"> Invalid username or password! </span>
                 <?php
                    }
                    ?>

             </div>
         </div>
     </div>

     <script src="./Assets/js/jquery.min.js"></script>
     <script src="./Assets/js/bootstrap.min.js"></script>
 </body>

 </html>

 <?php

    require_once("Admin/Inc/config.php");

    if (isset($_POST['sign_up_btn'])) {
        $R_name = mysqli_real_escape_string($db, $_POST['R_name']);
        $R_email = mysqli_real_escape_string($db, $_POST['R_email']);
        $R_pass = mysqli_real_escape_string($db, sha1($_POST['R_pass']));
        $RC_pass = mysqli_real_escape_string($db, sha1($_POST['RC_pass']));
        $user_role = "Voter";

        //why use SHA1 (Secure Hash Algorithm)? because it's more secured than MD5


        if ($R_pass == $RC_pass) {
            //insert Query

            mysqli_query($db, "INSERT INTO users(name, email, password, user_role) VALUES('" . $R_name . "', '" . $R_email . "', '" . $R_pass . "' ,'" . $user_role . "')") or die(mysqli_error($db));

    ?>
         <script>
             location.assign("index.php?sign-up=1&registered=1");
         </script>

     <?php

        } else {
        ?>
         <script>
             location.assign("index.php?sign-up=1&invalid=1");
         </script>
         <?php

        }
        // <!-- if both passwords are correct then return to login page  -->

    } else if (isset($_POST['loginBtn'])) {
        // echo("<script>console.log('PHP: " . "testing" . "');</script>");

        $L_name = mysqli_real_escape_string($db, $_POST['L_name']);
        $L_password = mysqli_real_escape_string($db, sha1($_POST['L_password']));

        // echo("<script>console.log('PHP: " . $L_name . "');</script>");
        // echo("<script>console.log('PHP: " . $L_password . "');</script>");


        //query fetch /select


        $fetchingData = mysqli_query($db, "SELECT * FROM users WHERE name = '" . $L_name . "'") or die(mysqli_error($db));

        if (mysqli_num_rows($fetchingData) > 0) {
            $data = mysqli_fetch_assoc($fetchingData);

            if ($L_name == $data['name'] and $L_password == $data['password']) {
                session_start();
                $_SESSION['user_role'] = $data['user_role'];
                $_SESSION['L_name'] = $data['name'];


                if ($data['user_role'] == "Admin") {
                    $_SESSION['key'] = "Adminkey";
            ?>

                 <script>
                     location.assign("Admin/index.php")
                 </script>

             <?php

                } else {
                    $_SESSION['key'] = "Voterskey";

                ?>
                 <script>
                     location.assign("Voters/index.php")
                 </script>

             <?php

                }
            } else {
                ?>
             <script>
                 location.assign("index.php?invalid_access=1");
             </script>

         <?php

            }
        } else {

            ?>

         <script>
             location.assign("index.php?&not_registered=1");
         </script>

 <?php


        }
    }
    ?>

 <?php
    $data = "hi";
    echo ("<script>console.log('PHP: " . $data . "');</script>");

    ?>