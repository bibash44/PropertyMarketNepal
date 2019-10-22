<?php
require "../../Modal/user_modal.php";

if(!isset($_SESSION['adminuser'])){
    header("location:../index.php");
}

if(isset($_SESSION['messagesenttouser']) && $_SESSION['messagesenttouser']=="message_sent_to_user"){
    echo "<script> alert('Message is sent to the user'); </script>";
    $_SESSION['messagesenttouser']="";
}

// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);

//resgitered user details
$users= new User;
$result3= $users->SelectUserDetails();
$total_users= mysqli_num_rows($result3);

//house details
$housedetails= new House;
$roomdetails= new Room;
$flatdetails= new Flat;
$landdetails= new Land;


$totalhouse= mysqli_num_rows($housedetails->SelectHouseDetails());
$totalroom = mysqli_num_rows($roomdetails->SelectroomDetails());
$totalflat = mysqli_num_rows($flatdetails->SelectflatDetails());
$totalland = mysqli_num_rows($landdetails->SelectlandDetails());

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin index page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_index_page.css" />
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

            <div class="messages_details_page-nav">
                <a href="admin_registered_user_message.php">
                    <i class="fa fa-envelope"></i> Registered user
                    <span class="total-messages"> <?php echo $total_r_message; ?> </span>
                </a>
            </div>


            <div class="messages_details_page-nav">
                <a href="admin_unregistered_user_message.php">
                    <i class="fa fa-envelope"></i> Unregistered user
                    <span class="total-messages">  <?php  echo $total_ur_message;?> </span>
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


            <div id="logout">
                <form method="POST" action="../../Controller/admin_controller.php">
                    <!--logout admin from profile-->
                    <button type="submit" name="admin-logout">Logout <i class=" fa fa-power-off"></i></button>
                </form>
                <div id="admin_manual_page">
                    <a href="../AdminPages/admin_manaul_page.php"> Help ? </a> </div>
            </div>
        </div>

        <!--body details-->
        <div id="page-body-details">

            <div id="body-details-heading"> <i class="fa fa-dashboard"></i> Dashboard </div>

            <!--property details dashboard-->
            <div id="property-dashboard">

                <!--house details dashboard-->
                <div id="house-dashboard">
                    <div id="house-logo"><i class="fa fa-home"></i> </div>
                    <div id="house-number"> Houses <b> <?php echo $totalhouse; ?> </b> </div>
                </div>

                <!--flat details dashboard-->
                <div id="flat-dashboard">
                    <div id="flat-logo"> <i class="fa fa-building"></i> </div>
                    <div id="flat-number"> Flats <b> <?php echo $totalflat; ?> </b> </div>
                </div>

                <!--room details dashboard-->
                <div id="room-dashboard">
                    <div id="room-logo"> <i class="fa fa-bed"></i> </div>
                    <div id="room-number"> Rooms <b> <?php echo $totalroom; ?></b> </div>
                </div>

                <!--land dashboard-->
                <div id="land-dashboard">
                    <div id="land-logo"> <i class="fa fa-area-chart"></i> </div>
                    <div id="land-number"> Land <b> <?php echo $totalland; ?></b> </div>
                </div>
            </div>
            <!--end of property details-->

            <!-- Available users and send message-->

            <div id="available-users">
                <div id="available-users-heading">
                    <i class="fa fa-user"></i> Availbale users <span id="total-users"> <?php echo $total_users; ?> </span>
                </div>



                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email </th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Send Message</th>

                    </tr>
                    <?php 
                    foreach ($result3 as $key) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $key['name'];?> </td>
                        <td>
                            <?php echo $key['email'];?> </td>
                        <td>
                            <?php echo $key['phone_number']; ?> </td>

                        <td>
                            <form method="POST" action="../../Controller/admin_controller.php">
                                <textarea placeholder="Type message....." name="admin-message-to-user" required></textarea>
                        </td>

                        <td>
                            <div id="send-message-by-admin">
                                <input type="hidden" name="user-email" value="<?php echo $key['email']; ?>">
                                <button id="send-message-to-user" type="submit" name="send-message-to-user"> <i class="fa fa-send"></i> Send </button>
                            </div>
                        </td>
                        </form>
                    </tr <?php } ?>
                    ?>


                </table>


            </div>
            <!-- End of sending message to users-->
        </div>

    </body>

    </html>