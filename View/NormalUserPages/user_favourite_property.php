<?php

require("../../Modal/user_modal.php");

if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
}

if (isset($_SESSION['favhouseremoved']) && $_SESSION['favhouseremoved'] == "fav_house_removed") {
    echo "<script> alert('Selected house removed from favourite'); </script>";
    $_SESSION['favhouseremoved']="";
}

if (isset($_SESSION['favflatremoved']) && $_SESSION['favflatremoved'] == "fav_flat_removed") {
    echo "<script> alert('Selected flat removed from favourite'); </script>";
    $_SESSION['favflatremoved'] = "";
}

if (isset($_SESSION['favroomremoved']) && $_SESSION['favroomremoved'] == "fav_room_removed") {
    echo "<script> alert('Selected room removed from favourite'); </script>";
    $_SESSION['favroomremoved'] = "";
}

if (isset($_SESSION['favlandremoved']) && $_SESSION['favlandremoved'] == "fav_land_removed") {
    echo "<script> alert('Selected land removed from favourite'); </script>";
    $_SESSION['favlandremoved'] = "";
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

//selecting favourite housedetails
$favhouse= new FavouriteHouse;
$favhouse->SetUserEmail($useremail);
$favhousedetails= $favhouse->SelectSpecificFavHouse();
$countfavhouse= mysqli_num_rows($favhousedetails);

//selecting favourite flatdetails
$favflat = new FavouriteFlat;
$favflat->SetUserEmail($useremail);
$favflatdetails = $favflat->SelectSpecificFavflat();
$countfavflat = mysqli_num_rows($favflatdetails);

//selecting favourite roomdetails
$favroom = new FavouriteRoom;
$favroom->SetUserEmail($useremail);
$favroomdetails = $favroom->SelectSpecificFavroom();
$countfavroom = mysqli_num_rows($favroomdetails);

//selecting favourite landdetails
$favland = new FavouriteLand;
$favland->SetUserEmail($useremail);
$favlanddetails = $favland->SelectSpecificFavland();
$countfavland = mysqli_num_rows($favlanddetails);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> User favourite property </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_favourite_property.css" />
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
                <span class="total-messages"> <?php echo $total_a_messages; ?> </span>
            </a>
        </div>

        <!-- Oredered property details-->
        <div id="ordered-property"> Ordered property list</div>

        <div class="ordered_property_list">
            <a href="user_ordered_property.php">
                <a href="user_ordered_property.php">
                    <i class="fa fa-cart-arrow-down"></i> Ordered property

                </a>
        </div>


        <!--  property details-->
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
        <div id="house-details-heading"> <i class="fa fa-home"></i> Favourite house </div>

        <!--house details dashboard-->
        <div id="house-dashboard">
            <div id="house-logo"><i class="fa fa-home"></i> </div>
            <div id="house-number"> Houses <b> <?php echo $countfavhouse; ?> </b> </div>
        </div>


        <div id="favourite-houses">
            <div id="favourite-houses-heading">
                <i class="fa fa-home"></i> Favourite house details

            </div>

                <table>
                    <tr>

                        <th>House Id</th>
                        <th>House Location</th>
                        <th>House Price</th>
                        <th>House Description</th>
                        <th>Remove from favourite</th>

                    </tr>

                    <?php 
                     foreach ($favhousedetails as $key) {
                      ?>

                      <form method="POST" action="../../Controller/user_controller.php">

                    <tr>

                        <!--House Id-->
                        <td> <?php echo $key['house_id']; ?> </td>
                        <!--House location-->
                        <td> <?php echo $key['house_location']; ?></td>
                        <td>Rs.
                            <!--House price--><?php echo $key['house_price']; ?>
                        </td>

                        <!--House description-->
                        <td><?php echo $key['house_description']; ?></td>

                        <!--remove favourite button-->
                        <td>
                            <input type="hidden" name="hidden-house-id" value="<?php echo $key['house_id']; ?>">

                             <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                            <div id="remove-house-by-user">
                                <button type="submit" name="remove-house">
                                        <i class="fa fa-trash"></i> Remove </button>
                            </div>
                        </td>
                     </tr>

                     </form>
                    <?php } 

                    ?>

                </table>
            </form>

            <!--End of favourite house details-->


            <!--favourite flat details-->
            <!--flat details heading-->
            <div id="flat-details-heading">
                <i class="fa fa-building"></i> Favourite flat </div>

            <!--flat details dashboard-->
            <div id="flat-dashboard">
                <div id="flat-logo">
                    <i class="fa fa-building"></i>
                </div>
                <div id="flat-number"> Flats
                    <b> <?php echo $countfavflat; ?> </b>
                </div>
            </div>


            <div id="favourite-flats">
                <div id="favourite-flats-heading">
                    <i class="fa fa-building"></i> Favourite flat details

                </div>


             
                    <table>
                        <tr>

                            <th>Flat Id</th>
                            <th>Flat Location</th>
                            <th>Flat Price</th>
                            <th>Flat Description</th>
                            <th>Remove from favourite</th>

                        </tr>

                        <?php 
                         foreach ($favflatdetails as $key) {
                         ?>

                            <form method="POST" action="../../Controller/user_controller.php">
                        <tr>

                            <!--flat Id-->
                            <td> <?php echo $key['flat_id']; ?> </td>
                            <!--flat location-->
                            <td> <?php echo $key['flat_location']; ?>l</td>
                            <td>Rs.
                                <!--flat price--><?php echo $key['flat_price']; ?>
                            </td>


                            <!--flat description-->
                            <td><?php echo $key['flat_description']; ?></td>


                            <!--remove favourite flat button-->
                            <td>

                            <input type="hidden" name="hidden-flat-id" value="<?php echo $key['flat_id']; ?>">

                             <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                <div id="remove-flat-by-user">
                                    <button id="" type="submit" name="remove-flat">
                                        <i class="fa fa-trash"></i> Remove </button>
                                </div>
                            </td>
                         </tr>

                         </form>

                         <?php } 
                        ?>
                        


                    </table>
                </form>
                <!--end of favourite flat details-->


                <!--room details heading-->
                <div id="room-details-heading">
                    <i class="fa fa-bed"></i> Favourite room </div>

                <!--room details dashboard-->
                <div id="room-dashboard">
                    <div id="room-logo">
                        <i class="fa fa-bed"></i>
                    </div>
                    <div id="room-number"> Rooms
                        <b> <?php echo $countfavroom; ?> </b>
                    </div>
                </div>


                <div id="favourite-rooms">
                    <div id="favourite-rooms-heading">
                        <i class="fa fa-bed"></i> Favourite room details

                    </div>


                   
                        <table>
                            <tr>

                                <th>Room Id</th>
                                <th>Room Location</th>
                                <th>Room Price</th>
                                <th>Room Description</th>
                                <th>Remove from favourite</th>

                            </tr>

                            <?php 
                            foreach ($favroomdetails as $key) {
                             ?>
                             
                            <form method="POST" action="../../Controller/user_controller.php">

                            <tr>

                                <!--room Id-->
                                <td> <?php echo $key['room_id']; ?> </td>
                                <!--room location-->
                                <td> <?php echo $key['room_location']; ?></td>
                                <td>Rs.
                                    <!--room price--><?php echo $key['room_price']; ?>
                                </td>


                                <!--room description-->
                                <td><?php echo $key['room_description']; ?></td>


                                <!--remove favourite room button-->
                                <td>
                                    
                            <input type="hidden" name="hidden-room-id" value="<?php echo $key['room_id']; ?>">

                             <input type="hidden" name="hidden--user-email" value="<?php echo $useremail; ?>">

                                    <div id="remove-room-by-user">
                                        <button id="" type="submit" name="remove-room">
                                <i class="fa fa-trash"></i> Remove </button>
                                    </div>
                                </td>
                            </tr>

                            </form>

                             <?php } ?>
                            

                        </table>
                    </form>
                    <!--end of favourite room details-->

                    <!--land details heading-->
                    <div id="land-details-heading">
                        <i class="fa fa-area-chart"></i> Favourite land </div>

                    <!--land details dashboard-->
                    <div id="land-dashboard">
                        <div id="land-logo">
                            <i class="fa fa-area-chart"></i>
                        </div>
                        <div id="land-number"> Lands
                            <b> <?php echo $countfavland; ?> </b>
                        </div>
                    </div>


                    <div id="favourite-lands">
                        <div id="favourite-lands-heading">
                            <i class="fa fa-area-chart"></i> Favourite land details

                        </div>


                   
                            <table>
                                <tr>

                                    <th>Land Id</th>
                                    <th>Land Location</th>
                                    <th>Land Price</th>
                                    <th>Land Description</th>
                                    <th>Remove from favourite</th>

                                </tr>

                                <?php 
                                 foreach ($favlanddetails as $key) {
                                 ?>

                                    <form method="POST" action="../../Controller/user_controller.php"> 

                                <tr>

                                    <!--land Id-->
                                    <td> <?php echo $key['land_id']; ?> </td>
                                    <!--land location-->
                                    <td> <?php echo $key['land_location']; ?> </td>
                                    <td>Rs.
                                        <!--land price--><?php echo $key['land_price']; ?> 
                                    </td>


                                    <!--land description-->
                                    <td><?php echo $key['land_description']; ?> </td>
                                    <!--Confirm status-->


                                    <!--remove favourte button-->
                                    <td>
                                        <input type="hidden" name="hidden-land-id" value="<?php echo $key['land_id']; ?>">

                                       <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">

                                        <div id="remove-land-by-user">
                                            <button id="" type="submit" name="remove-land">
                                         <i class="fa fa-trash"></i> Remove </button>
                                        </div>
                                    </td>
                                 </tr>
                                 
                                </form>

                                 <?php } ?>

                            </table>
                        
                        <!--end of favourite land details-->


                    </div>



</body>

</html>