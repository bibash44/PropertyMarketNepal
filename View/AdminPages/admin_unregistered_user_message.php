<?php 
require("../../Modal/user_modal.php");

if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}


// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Unregistered user messages </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_unregistered_user_message.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/font-awesome.css" />

</head>

<body>
    <div id="side-var-bar">
        <div id="site-logo"> <img src="../photos/Logos/Homapagelogo.png"> </div>

        <div id="dashboard_page">
            <a href="admin_index_page.php">
                <i class="fa fa-dashboard"></i> Dashboard
            </a>
        </div>


        <!-- property list-->
        <div id="property-list"> Property list </div>

        <div id="house_details_page-nav">
            <a href="admin_house_details_page.php">
                <i class="fa fa-home"></i> House
            </a>
        </div>

        <div id="flat_details_page-nav">
            <a href="admin_flat_details_page.php">
                <i class="fa fa-building"></i> Flat
            </a>
        </div>
        <div id="room_details_page-nav">
            <a href="admin_room_details_page.php">
                <i class="fa fa-bed"></i> Room
            </a>
        </div>
        <div id="land_details_page-nav">
            <a href="admin_land_details_page.php">
                <i class="fa fa-area-chart"></i> Land
            </a>
        </div>


        <!-- User messages-->

        <div id="messages-list"> User messages inbox</div>

        <div class="messages_details_page-nav1">
            <a href="admin_registered_user_message.php">
                <i class="fa fa-envelope"></i> Registered user
                <span class="total-messages1"> <?php echo $total_r_message; ?> </span>
            </a>
        </div>


        <div class="messages_details_page-nav2">
            <a href="admin_unregistered_user_message.php">
                <i class="fa fa-envelope"></i> Unregistered user

            </a>
        </div>

        <!-- Oredered property details-->
        <div id="ordered-property"> Ordered property list</div>

        <div class="ordered_property_list">
            <a href="admin_ordered_property.php">
                <i class="fa fa-cart-arrow-down"></i> Ordered property

            </a>
        </div>

        <!-- best selling property details-->
        <div id="best_selling_property"> Best selling property list</div>

        <div id="best_selling_property_list">
            <a href="admin_best_selling_property.php">
                <i class="fa fa-thumbs-up"></i> Best selling property

            </a>
        </div>

    </div>

    <!--end of side nav bar-->

    <div id="horizontal-nav-bar">
        <div id="admin-status">Admin</div>
        <div id="admin_avatar"><img src="../photos/Logos/admin_avatar.jpg"></div>
    </div>

    <!--body details-->
    <div id="page-body-details">

        <!-- messages of user -->

        <div id="registered-user-messages">
            <div id="registered-user-messages-heading">
                <i class="fa fa-envelope"></i> Unregistered user messages
                <span id="total-messages"><?php echo $total=mysqli_num_rows($result) ?> </span>
            </div>

            <!--Start of message box-->
            <?php 
           foreach ($result as $key) {
               
           
               ?>
            <div id="chat-boxes-contaier">
                <div id="user-logo"><img src="../photos/Logos/registered-user-message-logo.png"></div>
                <div id="chat-message-username">
                    <?php echo $key['username']; ?>
                </div>
                <div id="user-message-date">
                    <?php echo $key['message_date']; ?> </div>
                <div id="user-message"> <?php  echo $key['message'];?>   </div>
                <div id="user-details">
                    <div id="user-email"><i class="fa fa-envelope"></i>
                        <?php echo $key['useremail']; ?>
                    </div>
                    <div id="user-phone-number"><i class="fa fa-phone"> <?php echo $key['userphone']; ?></i></div>

                </div>
            </div>

            <?php
           } ?>
                <!--End of message box-->

        </div>

    </div>

</body>

</html>