<?php 

require("../../Modal/user_modal.php");

if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");

}


 //selecting logged in user messages
$adminmessages = new AdminMessage;
$email = $_SESSION['normaluser'];
$adminmessages->SetUserEmail($email);
$result = $adminmessages->SelectAdminMessages();
$total_a_messages = mysqli_num_rows($result);

//select specific user details
$userdetails= new User;
$userdetails->SetEmail($email);
$result2= $userdetails->SelectSpecificUserDetails();



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>User Index Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_admin_messages.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/w3schoolcss.css">



</head>

<body>
    <div id="side-var-bar">
        <div id="site-logo"> <img src="../photos/Logos/Homapagelogo.png"> </div>

        <div id="user_index_page">
            <a href="index_user_page.php">
                <i class="fa fa-home"></i> Home
            </a>
        </div>

        <!-- property list-->
        <div id="property-list"> Property list </div>

        <div id="house_details_page-nav">
            <a href="user_house_details.php">
                <i class="fa fa-home"></i> House
            </a>
        </div>

        <div id="flat_details_page-nav">
            <a href="user_flat_details.php">
                <i class="fa fa-building"></i> Flat
            </a>
        </div>
        <div id="room_details_page-nav">
            <a href="user_room_details.php">
                <i class="fa fa-bed"></i> Room
            </a>
        </div>
        <div id="land_details_page-nav">
            <a href="user_land_details.php">
                <i class="fa fa-area-chart"></i> Land
            </a>
        </div>


        <!-- User messages-->

        <div id="messages-list"> Admin messages inbox</div>

        <div class="messages_details_page-nav">
            <a href="user_admin_messages.php">
                <i class="fa fa-envelope"></i> Admin

            </a>
        </div>

        <!-- Oredered property details-->
        <div id="ordered-property"> Ordered property list</div>

        <div class="ordered_property_list">
            <a href="user_ordered_property.php">
                <i class="fa fa-cart-arrow-down"></i> Ordered property

            </a>
        </div>


        <!-- best selling property details-->
        <div id="favourite_property"> Favourite property list</div>

        <div id="favourite_property_list">
            <a href="user_favourite_property.php">
                <i class=" fa fa-heart "></i> Favourite property

            </a>
        </div>
    </div>

    <!--end of side nav bar-->
    <div id="horizontal-nav-bar">
        <div id="admin-status"><?php foreach($result2 as $key2){
            echo $key2['name'];
        } ?></div>
        <div id="admin_avatar">
            <img src="../photos/Logos/registered-user-message-logo.png">
        </div>

    </div>



    <!--body details-->
    <div id="page-body-details">

        <div id="admin-messages">
            <div id="admin-messages-heading">
                <i class="fa fa-envelope"></i> Admin messages
                <span id="total-messages"> <?php echo $total_a_messages; ?> </span>
            </div>

            <!--Start of message box-->
            <?php 
               foreach ($result as $key) {
                   ?>
            <div id="chat-boxes-contaier">
                <div id="user-logo">
                    <img src="../photos/Logos/admin_avatar.png">
                </div>
                <div id="chat-message-username"> Admin :</div>
                <div id="user-message-date">  <?php echo $key['message_date']; ?>
                </div>
                <div id="user-message"> <?php echo $key['message'];?> </div>

            </div>

            <?php
               } ?>
                <!--End of message box-->

        </div>
    </div>



</body>

</html>