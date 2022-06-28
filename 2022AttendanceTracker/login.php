<?php

session_start();
ob_start();

if (isset($_SESSION["login_user"]))
{
    header("location:sampleindex.php");
}

?>
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


    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><span class= "clas-candidate-icon"><img src="https://uat.workbank.com/images/recruiter.svg?v=1939">Welcome Back!</h1><span>
                                    </div>
                                    <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input  type="password" name="password" id="txtPassword" title="Password must contain: Minimum 8 characters atleast 1 Alphabet and 1 Number" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" />
                                        
                                        </div>


                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="remember_me" class="form-check-input subs-agree" id="signed"><label class="cls-checkbox">Keep me signed in <span class="cls-checkmark"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-right"><a href="forgot-password.html" aria-label="forgot password">Forgot Password?</a></div>
                                        </div>
                                       
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="login" value="login"> Login </button>
                                        <hr>

                                        <?php
                                            include_once("connection.php");

                                                if(ISSET($_POST['login'])){
                                                    $email = $_POST['email'];
                                                    $pass = md5($_POST['password']);

                                                    $sql = "SELECT password,username FROM tbllogin WHERE email = '".$email."';";
                                                    $query = mysqli_query($con,$sql) or die("Error".mysqli_error());
                                                    $fetch = mysqli_fetch_assoc($query);
                                                    $dbpass = $fetch['password'];
                                                    $user = $fetch['username'];
                                                    
                                                    if($pass == $dbpass){
                                                        $_SESSION['login_user'] = $user;
                                                        if (!empty($_POST["remember_me"]))
                                                        {
                                              
                                                            // Username is stored as cookie for 10 years as
                                                            // 10years * 365days * 24hrs * 60mins * 60secs
                                                            setcookie("user_login", $name, time() +
                                                                                (0 * 14 * 0 *  0 * 0));
                                              
                                                            // Password is stored as cookie for 10 years as 
                                                            // 10years * 365days * 24hrs * 60mins * 60secs
                                                            setcookie("user_password", $password, time() +
                                                                                (10 * 365 * 24 * 60 * 60));
                                              
                                                            // After setting cookies the session variable will be set
                                                            $_SESSION["name"] = $name;
                                              
                                                        }
                                                        else
                                                        {
                                                            if (isset($_COOKIE["user_login"]))
                                                            {
                                                                setcookie("user_login", "");
                                                            }
                                                            if (isset($_COOKIE["user_password"]))
                                                            {
                                                                setcookie("user_password", "");
                                                            }
                                                        }
                                                        header("location:sampleindex.php");
                                                    }else{?>

                                                        <script>
                                                            alert("Invalid email or password!");
                                                        </script>
                                                    <?php
                                                    }
                                                   
                                            }



                                        ?>
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
                                    
                                           
                                        </a>
                                    </form>
                                    <hr>
                                    
                                    <div class="text-center">
                                        <span>Not registered yet? <a href="register.php">Create an Account!</a></span>
                                    </div>
                                </div>
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
