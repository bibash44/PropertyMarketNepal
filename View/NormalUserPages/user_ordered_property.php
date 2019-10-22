<?php

require("../../Modal/user_modal.php");

if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
}


if (isset($_SESSION['orderedhouseremoved']) && $_SESSION['orderedhouseremoved'] == "ordered_house_removed") {
    echo "<script> alert('Selected house removed from ordered house'); </script>";
    $_SESSION['orderedhouseremoved'] = "";
}

if (isset($_SESSION['orderedflatremoved']) && $_SESSION['orderedflatremoved'] == "ordered_flat_removed") {
    echo "<script> alert('Selected flat removed from ordered flat'); </script>";
    $_SESSION['orderedflatremoved'] = "";
}

if (isset($_SESSION['orderedroomremoved']) && $_SESSION['orderedroomremoved'] == "ordered_room_removed") {
    echo "<script> alert('Selected room removed from ordered room'); </script>";
    $_SESSION['orderedroomremoved'] = "";
}

if (isset($_SESSION['orderedlandremoved']) && $_SESSION['orderedlandremoved'] == "ordered_land_removed") {
    echo "<script> alert('Selected land removed from ordered land'); </script>";
    $_SESSION['orderedlandremoved'] = "";
}



 //selecting user details
$user = new User;
$useremail = $_SESSION['normaluser'];
$user->SetEmail($useremail);
$userdetails = $user->SelectSpecificUserDetails();

  //selecting logged in user messages
$adminmessages = new AdminMessage;
$email = $_SESSION['normaluser'];
$adminmessages->SetUserEmail($email);
$result = $adminmessages->SelectAdminMessages();
$total_a_messages = mysqli_num_rows($result);

//oredered house details
$orderedhouse= new OrderedHouse();
$orderedhouse->SetUserEmail($useremail);
$ordered_house_details= $orderedhouse->SelectSpecificOrderedHouse();
$count_ordered_house= mysqli_num_rows($ordered_house_details);


//oredered flat details
$orderedflat = new OrderedFlat();
$orderedflat->SetUserEmail($useremail);
$ordered_flat_details = $orderedflat->SelectSpecificOrderedflat();
$count_ordered_flat = mysqli_num_rows($ordered_flat_details);


//oredered room details
$orderedroom = new OrderedRoom();
$orderedroom->SetUserEmail($useremail);
$ordered_room_details = $orderedroom->SelectSpecificOrderedroom();
$count_ordered_room = mysqli_num_rows($ordered_room_details);


//oredered land details
$orderedland = new OrderedLand();
$orderedland->SetUserEmail($useremail);
$ordered_land_details = $orderedland->SelectSpecificOrderedland();
$count_ordered_land = mysqli_num_rows($ordered_land_details);


?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> User Ordered property</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_ordered_property.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/font-awesome.css" />

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
                    <span class="total-messages"> <?php echo $total_a_messages;  ?> </span>
                </a>
            </div>

            <!-- Oredered property details-->
            <div id="ordered-property"> Ordered property list</div>

            <div class="ordered_property_list">
                <a href="user_ordered_property.php">
                    <i class="fa fa-cart-arrow-down"></i> Ordered property

                </a>
            </div>


            <!--property details-->
            <div id="favourite_property"> Favourite property list</div>

            <div id="favourite_property_list">
                <a href="user_favourite_property.php">
                    <i class="fa fa-heart"></i> Favourite property

                </a>
            </div>
        </div>

        <!--end of side nav bar-->

        <div id="horizontal-nav-bar">
            <div id="user-status">
                <?php
        foreach ($userdetails as $key) {
            echo $key['name'];
        }

        ?>

            </div>
            <div id="user_avatar"><img src="../photos/Logos/registered-user-message-logo.png"></div>
        </div>
        <!--body details-->
        <div id="page-body-details">

            <!--house details heading-->
            <div id="house-details-heading"> <i class="fa fa-home"></i> Ordered house </div>

            <!--house details dashboard-->
            <div id="house-dashboard">
                <div id="house-logo"><i class="fa fa-home"></i> </div>
                <div id="house-number"> Houses <b> <?php echo $count_ordered_house; ?> </b> </div>
            </div>


            <div id="ordered-houses">
                <div id="ordered-houses-heading">
                    <i class="fa fa-home"></i> Ordered house details

                </div>



                <table>
                    <tr>

                        <th>House Id</th>
                        <th>House Location</th>
                        <th>House Price</th>
                        <th>House Description</th>
                        <th>Confirm status</th>
                        <th>Remove order</th>

                    </tr>
                    <?php 
                      foreach ($ordered_house_details as $key) {
                       ?>

                    <form method="POST" action="../../Controller/user_controller.php">
                        <tr>

                            <!--House Id-->
                            <td>
                                <?php echo $key['house_id']; ?> </td>
                            <!--House location-->
                            <td>
                                <?php echo $key['house_location']; ?> </td>
                            <td>Rs.
                                <!--House price-->
                                <?php echo $key['house_price']; ?>
                            </td>


                            <!--House description-->
                            <td>
                                <?php echo $key['house_description']; ?> </td>

                            <!--Confirm status-->
                            <td>
                                <?php
                              $order_status= $key['order_status'];
                            if($order_status== "Not confirmed"){

                        ?>
                                <span style="color: red;"><?php echo $key['order_status']; }?> </span>
                                 <?php
                           if ($order_status == "confirmed") {
                             ?>
                                     <span style="color: green;"><?php echo $key['order_status'];} ?> </span>
                            </td>

                            <!-- end of confirm satus-->


                            <!--Remove house order button-->
                            <td>
                              <input type="hidden" name="hidden-house-id" value="<?php echo $key['house_id']; ?>">

                             <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                <div id="remove-house-by-user">
                                    <button type="submit" name="remove-house-order">
                                        <i class="fa fa-trash"></i> Remove </button>
                                </div>
                            </td>
                        </tr>

                    </form>

                    <?php } ?>



                </table>
                </form>

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
                        <b> <?php echo $count_ordered_flat; ?> </b>
                    </div>
                </div>


                <div id="ordered-flats">
                    <div id="ordered-flats-heading">
                        <i class="fa fa-building"></i> Ordered flat details

                    </div>


                   
                        <table>
                            <tr>

                                <th>Flat Id</th>
                                <th>Flat Location</th>
                                <th>Flat Price</th>
                                <th>Flat Description</th>
                                <th>Confirm status</th>
                                <th>Remover order</th>

                            </tr>

                            <?php 
                            foreach ($ordered_flat_details as $key) {
                             ?>

                            <form method="POST" action="../../Controller/user_controller.php">

                            <tr>

                                <!--flat Id-->
                                <td> <?php echo $key['flat_id']; ?> </td>
                                <!--flat location-->
                                <td> <?php echo $key['flat_location']; ?></td>
                                <td>Rs.
                                    <!--flat price--><?php echo $key['flat_price']; ?>
                                </td>


                                <!--flat description-->
                                <td><?php echo $key['flat_description']; ?></td>

                            <!--Confirm status-->
                            <td>
                                <?php
                                $order_status = $key['order_status'];
                                if ($order_status == "Not confirmed") {

                                    ?>
                                <span style="color: red;"><?php echo $key['order_status'];} ?> </span>

                                 <?php
                                if ($order_status == "confirmed") {
                                    ?>
                                 <span style="color: green;"><?php echo $key['order_status'];} ?> </span>
                            </td>

                            <!-- end of confirm satus-->
                               

                                <!--remove flat order button-->
                                <td> 
                                    <input type="hidden" name="hidden-flat-id" value="<?php echo $key['flat_id']; ?>">

                                     <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                    <div id="remove-flat-by-user">
                                        <button id="" type="submit" name="remove-flat-order">
                                        <i class="fa fa-trash"></i> Remove </button>
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
                            <b> <?php echo $count_ordered_room; ?> </b>
                        </div>
                    </div>


                    <div id="ordered-rooms">
                        <div id="ordered-rooms-heading">
                            <i class="fa fa-bed"></i> Ordered room details

                        </div>

                            <table>
                                <tr>

                                    <th>Room Id</th>
                                    <th>Room Location</th>
                                    <th>Room Price</th>
                                    <th>Room Description</th>
                                    <th>Confirm status</th>
                                    <th>Remove order</th>

                                </tr>

                                <?php 
                                foreach ($ordered_room_details as $key) {
                                ?>

                                 <form method="POST" action="../../Controller/user_controller.php">

                                <tr>

                                    <!--room Id-->
                                    <td> <?php echo $key['room_id']; ?> </td>
                                    <!--room location-->
                                    <td><?php echo $key['room_location']; ?></td>
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
                                    <span style="color: red;"><?php echo $key['order_status'];} ?> </span>

                                   <?php
                                  if ($order_status == "confirmed") {
                                    ?>
                                 <span style="color: green;"><?php echo $key['order_status'];} ?> </span>
                            </td>

                            <!-- end of confirm satus-->
                               
                                    <!--remove room order button-->

                                    <td>

                                     <input type="hidden" name="hidden-room-id" value="<?php echo $key['room_id']; ?>">

                                     <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                        <div id="remove-room-by-user">
                                            <button id="" type="submit" name="remove-room-order">
                                <i class="fa fa-trash"></i> Remove </button>
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
                                <b> <?php echo $count_ordered_land; ?> </b>
                            </div>
                        </div>


                        <div id="ordered-lands">
                            <div id="ordered-lands-heading">
                                <i class="fa fa-area-chart"></i> Ordered land details

                            </div>


                           
                                <table>
                                    <tr>

                                        <th>Land Id</th>
                                        <th>Land Location</th>
                                        <th>Land Price</th>
                                        <th>Land Description</th>
                                        <th>Confirm status</th>
                                        <th>Remove order</th>

                                    </tr>
                                    <?php 
                                     foreach ($ordered_land_details as $key) {
                                     ?>

                                    <form method="POST" action="../../Controller/user_controller.php">               
                                    <tr>

                                        <!--land Id-->
                                        <td> <?php echo $key['land_id']; ?> </td>
                                        <!--land location-->
                                        <td> <?php echo $key['land_location']; ?></td>
                                        <td>Rs.
                                            <!--land price--><?php echo $key['land_price']; ?>
                                        </td>


                                        <!--land description-->
                                        <td><?php echo $key['land_description']; ?> </td>

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

                                        <!--remove land order button-->
                                        <td>

                                            <input type="hidden" name="hidden-land-id" value="<?php echo $key['land_id']; ?>">

                                             <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                            <div id="remove-land-by-user">
                                                <button id="" type="submit" name="remove-land-order">
                                <i class="fa fa-trash"></i> Remove </button>
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