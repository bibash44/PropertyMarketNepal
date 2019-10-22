<?php
require "../../Modal/user_modal.php";
if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User Manual Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_manual_page.css">

    </head>

    <body>
        <div id="admin-manual-page-container">
            <div id="manual_heading">Admin User Help Page</div>
            <img src="../photos/Logos/AdminUserManualPage.jpg" alt="admin_manual_image">
        </div>
    </body>

    </html>