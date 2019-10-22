<?php
require "../../Modal/user_modal.php";

if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Normal User Manual Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_manual_page.css">

    </head>

    <body>
        <div id="normal-manual-page-container">
            <div id="manual_heading">Normal User Help Page</div>
            <img src="../photos/Logos/NormalUserManualPage.jpg" alt="normal_user_manual_image">
        </div>
    </body>

    </html>