<?php
require "../../Modal/user_modal.php";

if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}
if (isset($_SESSION['landexist']) && $_SESSION['landexist'] == "land_exist") {
    echo "<script> alert('land already exist, enter a different id'); </script>";
    $_SESSION['landexist'] = "";
}

//informing about the new land uploaded
if (isset($_SESSION['landuploaded']) && $_SESSION['landuploaded'] == "land_uploaded") {
    echo "<script> alert('New land uploaded'); </script>";
    $_SESSION['landuploaded'] = "";
}

//informing about the file type and photo size exceeding
if (isset($_SESSION['nolandphotobigsize']) && $_SESSION['nolandphotobigsize'] == "no_land_photo_big_size") {
    echo "<script> alert('Selected file is not a photo or exceed more than 5MB'); </script>";
    $_SESSION['nolandphotobigsize'] = "";
}

if (isset($_SESSION['selectedlandremoved']) && $_SESSION['selectedlandremoved'] == "selected_land_removed") {
    echo "<script> alert('Selected land removed'); </script>";
    $_SESSION['selectedlandremoved'] = "";
}


if (isset($_SESSION['selectedlandupdated']) && $_SESSION['selectedlandupdated'] == "selected_land_updated") {
    echo "<script> alert('Selected land updated'); </script>";
    $_SESSION['selectedlandupdated'] = "";
}


// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);


//land details
$landdetails= new Land;
$result3= $landdetails->SelectlandDetails();
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Admin Land details page </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_land_details_page.css" />
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
        </div>

        <!--body details-->
        <div id="page-body-details">

            <div id="body-details-heading"> <i class="fa fa-home"></i> Upload Land </div>

            <!--land details upload-->
            <div id="land-box">
                <div id="land-header">
                    <div id="land-header-text1">Land</div>
                    <div id="land-header-text2">Upload a new land</div>
                    <div id="land-header-logo">
                        <i class="fa fa-area-chart" aria-hidden="true"></i>
                        <img src="../photos/Logos/Homapagelogo.png">
                    </div>
                </div>

                <div id="land-input">

                    <div id="land-form">
                        <!--Sign up form-->
                        <form method="POST" class="upload-land-form" action="../../Controller/admin_controller.php" enctype="multipart/form-data">

                            <div id="land-name">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input type="text" name="land-id" placeholder="Enter land ID (eg: L123)" required id="land-id" pattern="[L][0-9]+">
                            </div>

                            <div id="land-location">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" name="land-location" placeholder="Enter land location" required id="land-location">
                            </div>

                            <div id="land-land-area">
                                <i class="fa fa-area-chart" aria-hidden="true"></i>
                                <input type="number" name="land-land-area" id="land-area-of-land" placeholder="Enter land area (in meter)" required>
                            </div>

                            <div id="land-price">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input type="text" name="land-price" placeholder="Enter land price" required id="land-price" pattern="[0-9]+">
                            </div>

                            <div id="land-discount">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <input type="number" name="land-discount" id="land-discount-amount" placeholder="Enter discount amount" required>
                            </div>

                            <!--land description-->
                            <div id="land-description">
                                <i class="fa fa-pencil"></i>
                                <textarea required name="land-description" placeholder="Land description..."></textarea>
                            </div>

                            <div id="photo-of-land">

                                <label id="land-photo-for" for="land-photo">
                                <i class="fa fa-photo"></i> Select a photo</label>
                                <input type="file" name="land-photo" id="land-photo" required>
                            </div>

                            <div id="land-button-press">
                                <input type="submit" name="upload-land-button" value="Upload" id="new-user-land">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- End of of signup- form-->
            <!--end of land details upload-->

            <!-- Available users and send message-->

            <div id="edit-land">
                <div id="edit-land-heading"><i class="fa fa-edit"></i> Edit Land Details </div>


           
                    <table>
                        <tr>
                            <th>land ID</th>
                            <th> Land Photo </th>
                            <th>land Location </th>
                            <th>Land Area</th>
                            <th>Land Price</th>
                            <th>Land discount amount</th>
                            <th>Land Description</th>
                            <th>Update</th>
                            <th>Delete</th>

                        </tr>

                        <?php 
                    foreach ($result3 as $key) {
                        ?>
                     <form method="POST" class="edit-land-form" action="../../Controller/admin_controller.php">

                        <tr>
                            <!--land id value-->
                            <td><?php echo $key['land_id']; ?></td>

                            <td> <img src="<?php echo"../".$key['image_path']; ?>"> </td>
                            <!-- land location value-->
                            <td><?php echo $key['land_location']; ?></td>


                            <!-- number of room in a land-->
                            <td>
                                <!-- previous no of room value -->
                                <p> <?php echo $key['land_area']; ?> Meter sq. </p>
                                <!-- value to be updated -->
                            
                            </td>

                            <!--land price-->
                            <td>
                                <!--previous value-->
                                <p> Rs.
                                    <!-- value from database --><?php echo $key['land_price']; ?> </p>

                                <input type="text" name="update-land-price" required pattern="[0-9]+" value="<?php echo $key['land_price'];?>">
                            </td>

                            <!--land discount amount-->
                            <td>
                                <!--previous value-->
                                <p> <?php echo $key['discount_amount']; ?>
                                    <!--percentage-->% </p>
                                <input type="number" name="update-land-discount" required value="<?php echo $key['discount_amount']; ?>">
                            </td>


                            <!--land desription-->
                            <td>
                                <textarea placeholder="Enter description....." name="update-land-description" required><?php echo $key['land_description']; ?></textarea>

                            </td>

                            <!--update land button-->
                            <td>
                                <input type="hidden" value="<?php echo $key['land_id']; ?>" name="hidden-land-id">

                                <div id="land-update-button">
                                    <button id="update-land" type="submit" name="update-land"> <i class="fa fa-upload"></i> Update </button>
                                </div>
                            </td>

                            <!--delete land button-->
                            <td>
                                <div id="land-delete-button">
                                    <button id="delete-land" type="submit" name="delete-land"> <i class="fa fa-trash"></i> Delete </button>
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

    </html