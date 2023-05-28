 <?php
    // required_once -> used to embed PHP code from another file. 
    require_once("Admin/Inc/config.php");

    $fetchingElections = mysqli_query($db, "SELECT * FROM elections") or die(mysqli_error($db));

    //mysqli_fetch_assoc -> function fetches a result row as an associative array.

    while ($data = mysqli_fetch_assoc($fetchingElections)) {
        $starting_date = $data['starting_date'];
        $ending_date = $data['ending_date'];
        $current_date = date("Y-m-d");
        $election_id = $data['id'];
        $status = $data['status'];



        // Active = Expire = Ending Date 
        //Inactive = Active = Starting Date


        if ($status == "Active") {
            //creates Date objects
            $date1 = date_create($current_date);
            $date2 = date_create($ending_date);
            //calculates the difference between Date objects
            $diff = date_diff($date1, $date2);
            // printing result in days format


            // echo var_dump((int)$diff->format("%R%a"));

            if ((int)$diff->format("%R%a") < 0) {

                // update
                mysqli_query($db, "UPDATE elections SET status= 'Expired' WHERE id = '" . $election_id . "' ") or die(mysqli_error($db));
            }
        } else if ($status == "InActive") {

            //creates Date objects
            $date1 = date_create($current_date);
            $date2 = date_create($starting_date);
            //calculates the difference between Date objects
            $diff = date_diff($date1, $date2);
            // printing result in days format


            echo (int)$diff->format("%R%a");

            if ((int)$diff->format("%R%a") <= 0) {
                // echo "Active";

                // update
                mysqli_query($db, "UPDATE elections SET status= 'Active' WHERE id = '" . $election_id . "' ") or die(mysqli_error($db));
            }
        }
    }


    ?>




 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title> Login - Online Voting System </title>
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
                         <img src="./Assets/images/vote1.jpg" class="brand_logo" alt="Logo">
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
        $R_pass = mysqli_real_escape_string($db, $_POST['R_pass']);
        $RC_pass = mysqli_real_escape_string($db, $_POST['RC_pass']);
        $user_role = "Voter";

        //why use SHA1 (Secure Hash Algorithm)? because it's more secured than MD5


        if ($R_pass == $RC_pass) {


            //Salt and Hashing password
            $RH_pass = password_hash($R_pass, PASSWORD_DEFAULT, ['cost => 12']);


            //insert Query
            mysqli_query($db, "INSERT INTO users(name, email, password, user_role) VALUES('" . $R_name . "', '" . $R_email . "', '" . $RH_pass . "' ,'" . $user_role . "')") or die(mysqli_error($db));

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
        $L_password = mysqli_real_escape_string($db, $_POST['L_password']);
        // echo "<script>alert('$L_name - $L_password')</script>";

        // echo("<script>console.log('PHP: " . $L_name . "');</script>");
        // echo("<script>console.log('PHP: " . $L_password . "');</script>");


        //query fetch /select

        $fetchingData = mysqli_query($db, "SELECT * FROM `users` WHERE `name` = '$L_name'");

        if (mysqli_num_rows($fetchingData) > 0) {
            $data = mysqli_fetch_assoc($fetchingData);



        ?>
         //Using password verify function -> grabs the hashed password (contains the salt and hashing algorithm) and adds the salt and hash to the L_password and compares with both passwords.




         <?Php
            echo "<script>console.log('Debug Objects: " . password_verify($L_password, $data['password']) . " " . $data['password'] . "' );</script>";

            if ($L_name == $data['name'] and password_verify($L_password, $data['password'])) {
                session_start();
                $_SESSION['user_role'] = $data['user_role'];
                $_SESSION['L_name'] = $data['name'];
                $_SESSION['user_id'] = $data['id'];


                if ($data['user_role'] == "Admin") {

                    $_SESSION['key'] = "AdminKey";
            ?>

                 <script>
                     location.assign("Admin/index.php?HomePage=1");
                 </script>

             <?php

                } else {
                    $_SESSION['key'] = "VotersKey";

                ?>
                 <script>
                     location.assign("Voters/index.php");
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

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>