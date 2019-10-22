<?php
require("../Modal/user_modal.php");

if (isset($_SESSION['passwordupdated']) && $_SESSION['passwordupdated']=="new_password_updated") {
    echo "<script> alert('New password updated, please login to continue:) ')  </script>";
    $_SESSION['passwordupdated']="";
   
}


if (isset($_SESSION['passwordnotmatched']) && $_SESSION['passwordnotmatched'] == "password_not_matched") {
    echo "<script> alert('Password didnot match, please enter same password and try again !!') </script>";
    $_SESSION['passwordnotmatched']="";
   
}
if (isset($_SESSION['invalidsecuritycode']) && $_SESSION['invalidsecuritycode'] == "not_a_valid_code") {
    echo "<script> alert('Securty code and email didnot matched, please try again !!') </script>";
    $_SESSION['invalidsecuritycode']="";

}


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forgot Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/ForgotPassword.css">
        <script type="text/javascript" src="javascript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
        <script type="text/javascript" src="javascript/javascript.js"></script>
    </head>

    <body>
        <div id="form-heading">
            <div id="form-heading-text"> Forgot Password </div>
        </div>

        <div id="forgotpassword-box">
            <div id="forgotpassword-header">
                <div id="forgotpassword-header-text1">Forgot Password</div>
                <div id="forgotpassword-header-text2">Recover your password</div>
                <div id="forgotpassword-header-logo">
                    <i class="fa fa-unlock" aria-hidden="true"></i>
                    <img src="photos/Logos/Homapagelogo.png">
                </div>
            </div>


            <div id="forgotpassword-input">
                <div id="forgotpassword-form">
                    <form method="POST" action="../Controller/user_controller.php">

                        <div id="forgotpassword-email">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input type="email" name="email" placeholder="Enter Email Address" required id="user-email">
                        </div>

                        <div id="security-code">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <input type="text" name="security-code" placeholder="Enter the security code" id="security-code" required pattern=".{6,}" title="include 6 or more charcater">
                        </div>

                        <div id="forgotpassword-password">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" name="password" placeholder="Enter new password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and include at least 6 or more characters">
                        </div>

                        <div id="forgotpassword-cpassword">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <input type="password" name="cpassword" placeholder="Re-enter same password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and include at least 6 or more characters">
                        </div>

                        <div id="forgotpassword-button-press">
                            <input type="submit" name="user-forgotpassword" value="Reset Password" id="new-user-signup">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <header>
            <nav>
                <div id="nav-bar">
                    <div id="site-logo">
                        <a href="index.php">
                            <img src="photos/Logos/Homapagelogo.png">
                        </a>
                    </div>

                </div>
            </nav>
        </header>

        <footer id="footer-div">
            <div id="footer-div-text">
                Property Markert Nepal pvt. Ltd. || Copyright &copy,
                <span id="CopyrightDate"></span> All right reserved
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