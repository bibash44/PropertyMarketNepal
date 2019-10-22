<?php
require "../../Modal/user_modal.php";


if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}
if (isset($_SESSION['houseorderconfirmed']) && $_SESSION['houseorderconfirmed'] == "house_order_confirmed") {
    echo "<script> alert('selected house ordered confirmed'); </script>";
    $_SESSION['houseorderconfirmed'] = "";
}

if (isset($_SESSION['flatorderconfirmed']) && $_SESSION['flatorderconfirmed'] == "flat_order_confirmed") {
    echo "<script> alert('selected flat ordered confirmed'); </script>";
    $_SESSION['flatorderconfirmed'] = "";
}


if (isset($_SESSION['roomorderconfirmed']) && $_SESSION['roomorderconfirmed'] == "room_order_confirmed") {
    echo "<script> alert('selected room ordered confirmed'); </script>";
    $_SESSION['roomorderconfirmed'] = "";
}

if (isset($_SESSION['landorderconfirmed']) && $_SESSION['landorderconfirmed'] == "land_order_confirmed") {
    echo "<script> alert('selected land ordered confirmed'); </script>";
    $_SESSION['landorderconfirmed'] = "";
}
// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);


//ordered house
$orderhousedetails= new OrderedHouse;
$result3= $orderhousedetails->SelectAllOrderedHouse();
$countorderhouse= mysqli_num_rows($result3);

//ordered flat
$orderflatdetails= new OrderedFlat;
$result4= $orderflatdetails->SelectAllOrderedFlat();
$countorderflat= mysqli_num_rows($result4);

//ordered room
$orderroomdetails = new OrderedRoom;
$result5 = $orderroomdetails->SelectAllOrderedRoom();
$countorderroom = mysqli_num_rows($result5);

//ordered land
$orderlanddetails = new OrderedLand;
$result6 = $orderlanddetails->SelectAllOrderedland();
$countorderland = mysqli_num_rows($result6);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin ordered property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_ordered_property.css" />
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
                <span class="total-messages">  <?php echo $total_ur_message; ?> </span>
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

        <!--house details heading-->
        <div id="house-details-heading"> <i class="fa fa-home"></i> Ordered house </div>

        <!--house details dashboard-->
        <div id="house-dashboard">
            <div id="house-logo"><i class="fa fa-home"></i> </div>
            <div id="house-number"> Houses <b> <?php echo $countorderhouse; ?> </b> </div>
        </div>


        <div id="ordered-houses">
            <div id="ordered-houses-heading">
                <i class="fa fa-home"></i> Ordered house details

            </div>

                <table>
                    <tr>
                       
                        <th>Email </th>
                        <th>House Id</th>
                        <th>House Location</th>
                        <th>House Price</th>
                        <th>House Description</th>
                        <th>Confirm status</th>
                        <th>Confirm Order</th>

                    </tr>
                    <?php 
                     foreach ($result3 as $key) {
                     ?>

                    <form method="POST" action="../../Controller/admin_controller.php">

                    <tr>
                        
                        <!--User email-->
                        <td> <?php echo $key['useremail']; ?></td>
                        <!--House Id-->
                        <td> <?php echo $key['house_id']; ?> </td>
                        <!--House location-->
                        <td> <?php echo $key['house_location']; ?></td>
                        <td>Rs.
                            <!--House price--><?php echo $key['house_price']; ?>
                        </td>


                        <!--House description-->
                        <td> <?php echo $key['house_description']; ?></td>

                        <!--Confirm status-->
                            <td>
                                <?php
                                $order_status = $key['order_status'];
                                if ($order_status == "Not confirmed") {

                                    ?>
                                <span style="color: red;"><?php echo $key['order_status'];
                                                        } ?> </span>
                                 <?php
                                if ($order_status == "confirmed") {
                                    ?>
                                     <span style="color: green;"><?php echo $key['order_status'];
                                                            } ?> </span>
                            </td>

                            <!-- end of confirm satus-->

                            <!--Confirm house order button-->
                        <td>

                         <input type="hidden" name="hidden-house-id" value="<?php echo $key['house_id']; ?>">

                         <input type="hidden" name="hidden-user-email" value="<?php echo $key['useremail']; ?>">

                            <div id="confirm-house-order-by-admin">
                                <button id="" type="submit" name="confirm-house-order">
                                        <i class="fa fa-check"></i> Confirm </button>
                            </div>
                        </td>
                    </tr>

                     </form>

                     <?php } ?>
                    
                </table>
          

            <!--End of ordered house details-->


            <!--ordered flat details-->
            <!--flat details heading-->
            <div id="flat-details-heading">
                <i class="fa fa-building"></i> Ordered flat </div>

            <!--flat details dashboard-->
            <div id="flat-dashboard">
                <div id="flat-logo">
                    <i class="fa fa-building"></i>
                </div>
                <div id="flat-number"> Flats
                    <b> <?php echo $countorderflat; ?> </b>
                </div>
            </div>


            <div id="ordered-flats">
                <div id="ordered-flats-heading">
                    <i class="fa fa-building"></i> Ordered flat details

                </div>
               
                    <table>
                        <tr>
                          
                            <th>Email </th>
                            <th>Flat Id</th>
                            <th>Flat Location</th>
                            <th>Flat Price</th>
                            <th>Flat Description</th>
                            <th>Confirm status</th>
                            <th>Confirm Order</th>

                        </tr>
                        <?php 
                         foreach ($result4 as $key) {
                         ?>

                        <form method="POST" action="../../Controller/admin_controller.php">                     
                        <tr>
                            
                            <!--User email-->
                            <td> <?php echo $key['useremail']; ?></td>
                            <!--flat Id-->
                            <td> <?php echo $key['flat_id']; ?> </td>
                            <!--flat location-->
                            <td> <?php echo $key['flat_location']; ?></td>
                            <td>Rs.
                                <!--flat price--><?php echo $key['flat_price']; ?>
                            </td>


                            <!--flat description-->
                            <td><?php echo $key['flat_description']; ?> </td>

                               <!--Confirm status-->
                            <td>
                                <?php
                                $order_status = $key['order_status'];
                                if ($order_status == "Not confirmed") {

                                    ?>
                                <span style="color: red;"><?php echo $key['order_status'];
                                                        } ?> </span>
                                 <?php
                                if ($order_status == "confirmed") {
                                    ?>
                                     <span style="color: green;"><?php echo $key['order_status'];
                                                            } ?> </span>
                            </td>

                            <!-- end of confirm satus-->

                            <!--Confirm flat order button-->
                            <td> 
                                  <input type="hidden" name="hidden-flat-id" value="<?php echo $key['flat_id']; ?>">

                                 <input type="hidden" name="hidden-user-email" value="<?php echo $key['useremail']; ?>">

                                <div id="confirm-flat-order-by-admin">
                                    <button id="" type="submit" name="confirm-flat-order">
                                        <i class="fa fa-check"></i> Confirm </button>
                                </div>
                            </td>
                                                     
                        </tr> 

                       </form>

                        <?php } ?>
                    
                    </table>
                
                <!--end of ordered flat details-->


                <!--room details heading-->
                <div id="room-details-heading">
                    <i class="fa fa-bed"></i> Ordered room </div>

                <!--room details dashboard-->
                <div id="room-dashboard">
                    <div id="room-logo">
                        <i class="fa fa-bed"></i>
                    </div>
                    <div id="room-number"> rooms
                        <b> <?php echo $countorderroom; ?> </b>
                    </div>
                </div>


                <div id="ordered-rooms">
                    <div id="ordered-rooms-heading">
                        <i class="fa fa-bed"></i> Ordered room details

                    </div>


                        <table>
                            <tr>
                               
                                <th>Email </th>
                                <th>Room Id</th>
                                <th>Room Location</th>
                                <th>Room Price</th>
                                <th>Room Description</th>
                                <th>Confirm status</th>
                                <th>Confirm Order</th>

                            </tr>
                            <?php 
                             foreach ($result5 as $key) {
                             ?>

                              <form method="POST" action="../../Controller/admin_controller.php"> 

                            <tr>
                               
                                <!--User email-->
                                <td> <?php echo $key['useremail']; ?></td>
                                <!--room Id-->
                                <td> <?php echo $key['room_id']; ?> </td>
                                <!--room location-->
                                <td> <?php echo $key['room_location']; ?></td>
                                <td>Rs.
                                    <!--room price--><?php echo $key['room_price']; ?>
                                </td>


                                <!--room description-->
                                <td><?php echo $key['room_description']; ?></td>
                                
                                   <!--Confirm status-->
                            <td>
                                <?php
                                $order_status = $key['order_status'];
                                if ($order_status == "Not confirmed") {

                                    ?>
                                <span style="color: red;"><?php echo $key['order_status'];
                                                        } ?> </span>
                                 <?php
                                if ($order_status == "confirmed") {
                                    ?>
                                     <span style="color: green;"><?php echo $key['order_status'];
                                                            } ?> </span>
                            </td>

                            <!-- end of confirm satus-->

                                <!--Confirm room order button-->
                                <td>
                                 <input type="hidden" name="hidden-room-id" value="<?php echo $key['room_id']; ?>">

                                 <input type="hidden" name="hidden-user-email" value="<?php echo $key['useremail']; ?>">

                                    <div id="confirm-room-order-by-admin">
                                        <button id="" type="submit" name="confirm-room-order">
                                <i class="fa fa-check"></i> Confirm </button>
                                    </div>
                                </td>
                               </tr>
                               
                              </form>
                              
                               <?php } ?>
                    
                        </table>
                   
                    <!--end of ordered room details-->

                    <!--land details heading-->
                    <div id="land-details-heading">
                        <i class="fa fa-area-chart"></i> Ordered land </div>

                    <!--land details dashboard-->
                    <div id="land-dashboard">
                        <div id="land-logo">
                            <i class="fa fa-area-chart"></i>
                        </div>
                        <div id="land-number"> Lands
                            <b> <?php echo $countorderland; ?> </b>
                        </div>
                    </div>


                    <div id="ordered-lands">
                        <div id="ordered-lands-heading">
                            <i class="fa fa-area-chart"></i> Ordered land details

                        </div>


                        
                            <table>
                                <tr>
                                 
                                    <th>Email </th>
                                    <th>Land Id</th>
                                    <th>Land Location</th>
                                    <th>Land Price</th>
                                    <th>Land Description</th>
                                    <th>Confirm status</th>
                                    <th>Confirm Order</th>

                                </tr>

                                <?php 
                                 foreach ($result6 as $key) {
                                 ?>
                                 
                              <form method="POST" action="../../Controller/admin_controller.php"> 

                                <tr>
                                    
                                    <!--User email-->
                                    <td> <?php echo $key['useremail']; ?></td>
                                    <!--land Id-->
                                    <td>  <?php echo $key['land_id']; ?> </td>
                                    <!--land location-->
                                    <td>  <?php echo $key['land_location']; ?></td>
                                    <td>Rs.
                                        <!--land price--> <?php echo $key['land_price']; ?>
                                    </td>


                                    <!--land description-->
                                    <td> <?php echo $key['land_description']; ?></td>


                                          <!--Confirm status-->
                                 <td>
                                <?php
                                $order_status = $key['order_status'];
                                if ($order_status == "Not confirmed") {

                                    ?>
                                <span style="color: red;"><?php echo $key['order_status'];
                                  } ?> </span>

                                 <?php
                                if ($order_status == "confirmed") {
                                    ?>
                                     <span style="color: green;"><?php echo $key['order_status'];
                                     } ?> </span>
                                </td>

                              <!-- end of confirm satus-->

                                    <!--Confirm land order button-->
                                 <td>

                                  <input type="hidden" name="hidden-land-id" value="<?php echo $key['land_id']; ?>">

                                 <input type="hidden" name="hidden-user-email" value="<?php echo $key['useremail']; ?>">

                                        <div id="confirm-land-order-by-admin">
                                            <button id="" type="submit" name="confirm-land-order">
                                <i class="fa fa-check"></i> Confirm </button>
                                        </div>
                                    </td>
                                 </tr>

                                 </form>

                                  <?php } ?>
                             

                            </table>
                      
                        <!--end of ordered land details-->
                    </div>

</body>
</html>