<?php
require "../../Modal/user_modal.php";

if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}
if (isset($_SESSION['roomexist']) && $_SESSION['roomexist'] == "room_exist") {
    echo "<script> alert('room already exist, enter a different id'); </script>";
    $_SESSION['roomexist'] = "";
}

//informing about the new room uploaded
if (isset($_SESSION['roomuploaded']) && $_SESSION['roomuploaded'] == "room_uploaded") {
    echo "<script> alert('New room uploaded'); </script>";
    $_SESSION['roomuploaded'] = "";
}

//informing about the file type and photo size exceeding
if (isset($_SESSION['noroomphotobigsize']) && $_SESSION['noroomphotobigsize'] == "no_room_photo_big_size") {
    echo "<script> alert('Selected file is not a photo or exceed more than 5MB'); </script>";
    $_SESSION['noroomphotobigsize'] = "";
}


if (isset($_SESSION['selectedroomremoved']) && $_SESSION['selectedroomremoved'] == "selected_room_removed") {
    echo "<script> alert('Selected room removed'); </script>";
    $_SESSION['selectedroomremoved'] = "";
}



if (isset($_SESSION['selectedroomupdated']) && $_SESSION['selectedroomupdated'] == "selected_room_updated") {
    echo "<script> alert('Selected room updated'); </script>";
    $_SESSION['selectedroomupdated'] = "";
}

// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages= new UserMessage;
$result2= $registeredmessages->SelectUserMessages();
$total_r_message= mysqli_num_rows($result2);

$roometails= new Room;
$result3= $roometails->SelectroomDetails();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Admin room details </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_room_details_page.css" />
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

            <div id="messages-list">
                User messages inbox</div>

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

            <div id="body-details-heading"> <i class="fa fa-bed"></i> Upload Room </div>

            <!--room details upload-->
            <div id="room-box">
                <div id="room-header">
                    <div id="room-header-text1">Room</div>
                    <div id="room-header-text2">Upload a new room</div>
                    <div id="room-header-logo">
                        <i class="fa fa-bed" aria-hidden="true"></i>
                        <img src="../photos/Logos/Homapagelogo.png">
                    </div>
                </div>

                <div id="room-input">

                    <div id="room-form">
                        <!--Sign up form-->
                        <form method="POST" class="upload-room-form" action="../../Controller/admin_controller.php" enctype="multipart/form-data">

                            <div id="room-name">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input type="text" name="room-id" placeholder="Enter room ID (eg: R123)" required id="room-id" pattern="[R][0-9]+">
                            </div>

                            <div id="room-location">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" name="room-location" placeholder="Enter room location" required id="room-location">
                            </div>

                            <div id="room-room-area">
                                <i class="fa fa-area-chart" aria-hidden="true"></i>
                                <input type="number" name="room-room-area" id="room-area-of-room" placeholder="Enter area of room (in meter)" required>
                            </div>

                            <div id="room-price">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input type="text" name="room-price" placeholder="Enter room price" required id="room-price" pattern="[0-9]+">
                            </div>

                            <div id="room-discount">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <input type="number" name="room-discount" id="room-discount-amount" placeholder="Enter discount amount" required>
                            </div>

                            <!--room description-->
                            <div id="room-description">
                                <i class="fa fa-pencil"></i>
                                <textarea name="room-description" placeholder="Room description..." required></textarea>
                            </div>

                            <div id="photo-of-room">

                                <label id="room-photo-for" for="room-photo">
                                <i class="fa fa-photo"></i> Select a photo</label>
                                <input type="file" name="room-photo" id="room-photo" required>
                            </div>

                            <div id="room-button-press">
                                <input type="submit" name="upload-room-button" value="Upload" id="new-user-room">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- End of of signup- form-->
            <!--end of room details upload-->

            <!-- Available users and send message-->

            <div id="edit-room">
                <div id="edit-room-heading"><i class="fa fa-edit"></i> Edit room Details </div>


                <form method="POST" class="edit-room-form" action="../../Controller/admin_controller.php">
                    <table>
                        <tr>
                            <th>Room ID</th>
                            <th>Room photo </th>
                            <th>Room Location </th>
                            <th>Room Area</th>
                            <th>Room Price</th>
                            <th>Room discount amount</th>
                            <th>Room Description</th>
                            <th>Update</th>
                            <th>Delete</th>

                        </tr>

                        <?php 
                    foreach ($result3 as $key) {
                        ?>
                        <tr>
                            <!--room id value-->
                            <td>
                                <?php echo $key['room_id']; ?>
                            </td>

                            <td> <img src="<?php echo"../".$key['image_path'];  ?>" alt="room photo"> </td>

                            <!-- room location value-->
                            <td>
                                <?php echo $key['room_location']; ?>
                            </td>


                            <!-- room area -->
                            <td>
                                <!-- previous no of room value -->
                                <p>
                                    <?php echo $key['room_area']; ?> Meter sq. </p>


                            </td>

                            <!--room price-->
                            <td>
                                <!--previous value-->
                                <p> Rs.
                                    <!-- value from database -->
                                    <?php echo $key['room_price']; ?> </p>

                                <input type="text" name="update-room-price" required pattern="[0-9]+" value="<?php echo $key['room_price']; ?>">
                            </td>

                            <!--room discount amount-->
                            <td>
                                <!--previous value-->
                                <p>
                                    <?php echo $key['discount_amount']; ?>
                                    <!--percentage-->% </p>
                                <input type="number" name="update-room-discount" required value="<?php echo $key['discount_amount']; ?>">
                            </td>


                            <!--room desription-->
                            <td>
                                <textarea placeholder="Enter description....." name="update-room-description" required> <?php echo $key['room_description']; ?></textarea>

                            </td>

                            <!--update room button-->
                            <td>
                                <input type="hidden" name="hidden-room-id" value="<?php echo $key['room_id']; ?>">
                                <div id="room-update-button">
                                    <button id="update-room" type="submit" name="update-room"> <i class="fa fa-upload"></i> Update </button>
                                </div>
                            </td>

                            <!--delete room button-->
                            <td>
                                <div id="room-delete-button">
                                    <button id="delete-room" type="submit" name="delete-room"> <i class="fa fa-trash"></i> Delete </button>
                                </div>
                            </td>

                        </tr>

                          </form>
                        <?php
                    }?>

                    </table>
              

            </div>
            <!-- End of sending message to users-->
        </div>

    </body>

    </html>