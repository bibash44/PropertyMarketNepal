<?php 
session_start();
if (isset($_SESSION['userexist']) && $_SESSION['userexist']=="useralreadyexist") {
   echo "<script> alert('Email have been already taken, please choose a new one') </script>";
   $_SESSION['userexist']="";
}

 if (isset($_SESSION['userregistered']) && $_SESSION['userregistered']=="user_is_registered") {
    echo "<script> alert('You are registered, please login to continue') </script>";
    $_SESSION['userregistered']="";
}


 if (isset($_SESSION['errorlogin']) && $_SESSION['errorlogin']=="login_failed") {
    echo "<script> alert('invalid email and password, please try again') </script>";
    $_SESSION['errorlogin']="";
}

if (isset($_SESSION['normaluser'])) {
    header("location:NormalUserPages/index_user_page.php");
}

if (isset($_SESSION['adminuser'])) {
    header("location:AdminPages/admin_index_page.php");
   
}
?>




<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>

    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/signup-form.css">
    <link rel="stylesheet" type="text/css" href="css/login-form.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="javascript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript/javascript.js"></script>

    <div id="white-background"> </div>

    <!-- Start of login- form-->

    <div id="login-box">
        <div id="login-header">
            <div id="login-header-text1">Login</div>
            <div id="login-header-text2">Get access to your account</div>
            <div id="login-header-logo"><i class="fa fa-lock" aria-hidden="true"></i><img src="photos/Logos/Homapagelogo.png"></div>
        </div>

        <div id="login-input">
            <div id="close-login" title="close">X</div>
            <div id="login-form">

                <form method="POST" action="../Controller/user_controller.php">

                    <div id="login-username">
                      &nbsp; &nbsp; &nbsp;  <i class="fa fa-envelope" aria-hidden="true"></i> <input type="email" name="username" placeholder="Enter Email Address" required id="user-email">
                    </div>

                    <div id="login-password">
                        <i class="fa fa-lock" aria-hidden="true"></i> <input type="password" name="password" placeholder="Enter Password" required id="user-password">
                    </div>

                    <div id="forgot-password-link"><a href="ForgotPassword.php"> Forgot Password?, Click here</a></div>

                    <div id="login-button-press">
                        <input type="submit" name="user-login" value="Login">
                    </div>

                    <p id="new-user-signup-info"> Or are you new? </p>

                    <div id="go-to-singup-form"> Click here to sign up</div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of of login- form-->

    <!--start of sign up form-->
    <div id="signup-box">
        <div id="signup-header">
            <div id="signup-header-text1">Signup</div>
            <div id="signup-header-text2">Set up a new account</div>
            <div id="signup-header-logo"><i class="fa fa-user" aria-hidden="true"></i><img src="photos/Logos/Homapagelogo.png"></div>
        </div>

        <div id="signup-input">
            <div id="close-signup" title="close">X</div>
            <div id="signup-form">
                <form method="POST" action="../Controller/user_controller.php">

                    <div id="signup-name">
                    &nbsp; &nbsp; &nbsp; <i class="fa fa-user-circle-o" aria-hidden="true"></i> <input type="text" name="name" placeholder="Enter Your Name" required id="user-name" pattern="[A-Z a-z a-z A-Z]+" title="special charcater and number not allowed">
                    </div>

                    <div id="signup-email">
                        <i class="fa fa-envelope" aria-hidden="true"></i> <input type="email" name="email" placeholder="Enter Email Address" required id="user-email">
                    </div>

                    <div id="signup-phone">
                        <i class="fa fa-phone" aria-hidden="true"></i> <input type="text" name="phone-number" id="phone-number" placeholder="Enter Phone number" required pattern="([0-9 + -]+).{7,}" title="Enter a valid phone number">
                    </div>

                    <div id="security-code">
                        <i class="fa fa-key" aria-hidden="true"></i> <input type="text" name="security-code" placeholder="Enter the security code" id="security-code" required pattern=".{6,}" title="include 6 or more charcater">
                    </div>

                    <div id="signup-password">
                        <i class="fa fa-lock" aria-hidden="true"></i> <input type="password" name="password" placeholder="Enter Password" id="password" required
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and include at least 6 or more characters">
                    </div>

                    <div id="signup-button-press">
                        <input type="submit" name="user-signup" value="Sign up" id="new-user-signup">
                    </div>

                    <p id="got-a-account-text"> Or, already got a account </p>

                    <div id="go-to-login-form"> Click here to login</div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of of signup- form-->

    <header>
        <nav>
            <div id="nav-bar">
                <div id="site-logo">
                    <a href="index.php"><img src="photos/Logos/Homapagelogo.png"></a>
                </div>
                <div id="nav-bar-buttons-group">
                    <div id="login-button"> <i class="fa fa-sign-in"></i> Login </div>
                    <div id="signup-button"> <span class="glyphicon">&#xe008;</span> Signup </div>
                    <div id="contactus-button"> <a href="contact_us.php"> | Contact us  <i class="fa fa-phone" aria-hidden="true"></i> </a> </div>
                </div>
            </div>
        </nav>
    </header>

    <footer id="footer-div">
        <div id="footer-div-text">
            Property Markert Nepal pvt. Ltd. || Copyright &copy, <span id="CopyrightDate"></span> All right reserved
        </div>

    </footer>
    <script>
        var d = new Date();
        var y = d.getFullYear();
        var showDate = document.getElementById("CopyrightDate");
        showDate.innerHTML = y;
    </script>
</body>

</html>