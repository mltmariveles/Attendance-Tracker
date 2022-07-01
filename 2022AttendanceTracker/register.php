<?php
include_once("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        .errmsg{
            font-size: 10px;
            color: red;
            }
            /* Chrome, Safari, Edge, Opera */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
                 }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>

</head>

<body class="bg-gradient-primary2">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">

                                <h1 class="h4 text-gray-900 mb-4"><span class= "clas-candidate-icon"><img src="https://uat.workbank.com/images/recruiter.svg?v=1939">Create an Account!</h1></span>
                            </div>
                            <form class="user" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name"  name="firstname">
                                            <?php

                                                if(ISSET($_POST['register'])){
                                                //input validation
                                                if (empty($_POST["firstname"])) 
                                                {
                                                        echo "<div class='errmsg'>*This is required</div>";
                                                } else {
                                                        $firstname = test_input($_POST["firstname"]);
                                                        // check if e-mail address is well-formed
                                                        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) 
                                                        {
                                                            echo "<div class='errmsg'> *Numbers and character are not allowed</div>";
                                                        }
                                                }
                                               } 
                                                ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" 
                                            placeholder="Last Name" name="lastname">
                                             <?php

                                                if(ISSET($_POST['register'])){
                                                //input validation
                                                if (empty($_POST["lastname"])) 
                                                {
                                                        echo "<div class='errmsg'>*This is required</div>";
                                                } else {
                                                        $lastname = test_input($_POST["lastname"]);
                                                        // check if e-mail address is well-formed
                                                        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname))
                                                        {
                                                            echo  "<div class='errmsg'> *Numbers and character are not allowed</div>";
                                                        }
                                                }
                                               } 
                                                ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="InputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name ="txtEmail"/>
                                                <?php
                                               
                                                if(ISSET($_POST['register'])){
                                                //input validation
                                                if (empty($_POST["txtEmail"])) 
                                                {
                                                        echo "<div class='errmsg'>*Email is required</div>";

                                                } else {
                                                        $email = test_input($_POST["txtEmail"]);
                                                        // check if e-mail address is well-formed

                                                        $sql = "SELECT email FROM tbllogin WHERE email = '".$email."';";
                                                        $result = mysqli_query($con,$sql) or die(mysqli_error($con));

                                                        if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while($row = $result->fetch_assoc()) {
                                                        echo  "<div class='errmsg'> *Email already exist</div>";
                                                        $_POST['txtEmail']="";
                                                      }
                                                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                                                        {
                                                            echo  "<div class='errmsg'> *Invalid email format</div>";
                                                        }

                                                }
                                               } 
                                     
                                                        
                                                ?>
                                </div>
                                <div class="form-group">
                                            <input type="number" name="contact" id="phone" class="form-control form-control-user" placeholder="Enter Phone Number..."  pattern="[0-9]*"/>
                                                <?php

                                                if(ISSET($_POST['register'])){
                                                //input validation
                                                if (empty($_POST["contact"])) 
                                                {
                                                        echo "<div class='errmsg'>*Phone is required</div>";
                                                } else {
                                                        $contact = test_input($_POST["contact"]);
                                                        // check if e-mail address is well-formed
                                                        if (preg_match('/^[0-9]{0,9}+$/', $contact)) 
                                                        {
                                                            echo  "<div class='errmsg'> *Invalid phone format</div>";
                                                        }
                                                }
                                               } 
                                                ?>

                                                <script>
                                                function myFunction() {
                                                  var x = document.getElementById("phone").maxLength;
                                                  
                                                }
                                                </script>
                                </div>
                                        
                                        <div class="form-group">
                                            <input name="txtPassword" type="password" id="txtPassword" class="form-control form-control-user"
                                                id="InputPassword" placeholder="Password"/> 
                                                <?php
                                                if(ISSET($_POST['register'])){
                                                    if (empty($_POST["txtPassword"])) 
                                                {
                                                        echo "<div class='errmsg'>*Password is required</div>";
                                                } else {
                                                        $password = test_input($_POST["txtPassword"]);
                                                        //check if password follows format
                                                        if (!preg_match('/[A-Za-z\d$!^(){}?\[\]<>~%@#&*+=_-]{8,40}$/', $_POST["txtPassword"]))
                                                            {

                                                                echo "<div class='errmsg'>*Password must have characters,numbers and special characters</div>";
                                                            }
                                                }
                                               }
                                                ?>                    
                                        </div>
                                        

                                <input type="submit" class="btn btn-primary btn-user btn-block" name="register" value="Register">
                                    
                                
                                
                                 <?php

                                 function test_input($data) 
                                                {
                                                $data = trim($data);
                                                $data = stripslashes($data);
                                                $data = htmlspecialchars($data);
                                                return $data;
                                                }

                                if(ISSET($_POST['register'])&&!empty($_POST['firstname'])&&!empty($_POST['lastname'])&&!empty($_POST['txtEmail'])&&!empty($_POST['txtPassword'])){
                                    $firstname = $_POST['firstname'];
                                    $lastname = $_POST['lastname'];
                                    $name = $firstname. ' '. $lastname;
                                    $email = $_POST['txtEmail'];
                                    $contact = $_POST['contact'];
                                    $password = md5($_POST['txtPassword']);
                             
                                    mysqli_query($con, "INSERT INTO tbllogin (username,contact,email, password)VALUES('".$name."','".$contact."','".$email."','".$password."')") or die(mysqli_error());
                                    echo "<h3 class='text-success'>User account registered!</h3>";
                                    header("location:login.php");
                                }else{

                                }


                                ?>







                                <hr>
                                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"  align="center"></div>
                                            <script>
                                              function onSignIn(googleUser) {
                                                // Useful data for your client-side scripts:
                                                var profile = googleUser.getBasicProfile();
                                                console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                                                console.log('Full Name: ' + profile.getName());
                                                console.log('Given Name: ' + profile.getGivenName());
                                                console.log('Family Name: ' + profile.getFamilyName());
                                                console.log("Image URL: " + profile.getImageUrl());
                                                console.log("Email: " + profile.getEmail());

                                                // The ID token you need to pass to your backend:
                                                var id_token = googleUser.getAuthResponse().id_token;
                                                console.log("ID Token: " + id_token);
                                              }
                                            </script>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>