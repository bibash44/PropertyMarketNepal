<?php
require "../../Modal/user_modal.php";


if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}
//checking if the house exist
if (isset($_SESSION['houseexist']) && $_SESSION['houseexist']=="house_exist") {
   echo "<script> alert('house already exist, enter a different id'); </script>";
    $_SESSION['houseexist']="";
}

//informing about the new house uploaded
if (isset($_SESSION['houseuploaded']) && $_SESSION['houseuploaded']=="house_uploaded") {
    echo "<script> alert('New house uploaded'); </script>";
    $_SESSION['houseuploaded']="";
}

//informing about the file type and photo size exceeding
if (isset($_SESSION['nohousephotobigsize']) && $_SESSION['nohousephotobigsize']=="no_house_photo_big_size") {
    echo "<script> alert('Selected file is not a photo or exceed more than 5MB'); </script>";
    $_SESSION['nohousephotobigsize']="";
}

//informing about deletion of house

if (isset($_SESSION['selectedhouseremoved']) && $_SESSION['selectedhouseremoved'] == "selected_house_removed") {
    echo "<script> alert('Selected House removed'); </script>";
    $_SESSION['selectedhouseremoved'] = "";
}



if (isset($_SESSION['selectedhouseupdated']) && $_SESSION['selectedhouseupdated'] == "selected_house_updated") {
    echo "<script> alert('Selected House updated'); </script>";
    $_SESSION['selectedhouseupdated'] = "";
}


// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);

//house details selection
$housedetails= new House;
$result3= $housedetails->SelectHouseDetails();

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Admin House Details </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_house_details_page.css" />
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

            <!-- Ordered property details-->
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
                  <i class="fa fa-thumbs-up"></i>  Best selling property

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

            <div id="body-details-heading"> <i class="fa fa-home"></i> Upload House </div>

            <!--house details upload-->
            <div id="house-box">
                <div id="house-header">
                    <div id="house-header-text1">House</div>
                    <div id="house-header-text2">Upload a new house</div>
                    <div id="house-header-logo">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <img src="../photos/Logos/Homapagelogo.png">
                    </div>
                </div>

                <div id="house-input">

                    <div id="house-form">
                        <!--Sign up form-->
                        <form method="POST" class="upload-house-form" enctype="multipart/form-data" action="../../Controller/admin_controller.php">

                            <div id="house-name">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input type="text" name="house-id" placeholder="Enter house ID (eg: H123)" required id="house-id" pattern="[H][0-9]+">
                            </div>

                            <div id="house-location">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" name="house-location" placeholder="Enter house location" required>
                            </div>

                            <div id="house-number-of-flat">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                <input type="number" name="no-of-flat-in-house" placeholder="Enter number of flat" required>
                            </div>

                            <div id="house-number-of-room">
                                <i class="fa fa-bed" aria-hidden="true"></i>
                                <input type="number" name="no-of-room-in-house" placeholder="Enter number of room" required>
                            </div>

                            <div id="house-price">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input type="text" name="house-price" placeholder="Enter house price" required pattern="[0-9]+">
                            </div>

                            <div id="house-discount">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <input type="number" name="house-discount" placeholder="Enter discount amount" required>
                            </div>

                            <!--House description-->
                            <div id="house-description">
                                <i class="fa fa-pencil"></i>
                                <textarea required name="house-description" placeholder="House description..."></textarea>
                            </div>

                            <div id="photo-of-house">

                                <label id="house-photo-for" for="house-photo">
                                <i class="fa fa-photo"></i> Select a photo</label>
                                <input type="file" name="photo-of-house" id="house-photo" required>
                            </div>

                            <div id="house-button-press">
                                <input type="submit" name="upload-house-button" value="Upload" id="new-user-house">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- End of of signup- form-->
            <!--end of house details upload-->

            <!-- Available users and send message-->

            <div id="edit-house">
                <div id="edit-house-heading"><i class="fa fa-edit"></i> Edit House Details </div>


              
                    <table>
                        <tr>
                            <th>House ID</th>
                            <th> House Photo </th>
                            <th>House Location </th>
                            <th>Number of flat</th>
                            <th>Number of room</th>
                            <th>House Price</th>
                            <th>House discount amount</th>
                            <th>House Description</th>
                            <th>Update</th>
                            <th>Delete</th>

                        </tr>

                        <?php 
                    foreach ($result3 as $key) {
                        ?>

                   <form method="POST" action="../../Controller/admin_controller.php" class="edit-house-form">
                        <tr>
                            <!--House id value-->
                            <td>
                                <?php echo $key['house_id']; ?>
                            </td>

                            <td> <img src="<?php echo " ../".$key['image_path'];?>" alt="house image"> </td>

                            <!-- House location value-->
                            <td>
                                <?php echo $key['house_location'];?>
                            </td>

                            <!-- number of flat in a house-->
                            <td>
                                <!-- previous no of flat value -->
                                <p>
                                    <?php echo $key['no_of_flat']; ?>
                                </p>
                                <!-- value to be updated -->
                                <input type="number" name="update-house-no-of-flat" value="<?php echo $key['no_of_flat'];?>" required> </td>


                            <!-- number of room in a house-->
                            <td>
                                <!-- previous no of room value -->
                                <p>
                                    <?php echo $key['no_of_room']; ?>
                                </p>
                                <!-- value to be updated -->
                                <input type="number" name="update-house-no-of-room" value="<?php echo $key['no_of_room']; ?>" required>
                            </td>

                            <!--House price-->
                            <td>
                                <!--previous value-->
                                <p> Rs.
                                    <!-- value from database -->
                                    <?php echo $key['house_price']; ?>
                                </p>

                                <input type="text" name="update-house-price" value="<?php echo $key['house_price']; ?>" pattern="[0-9]+" required>
                            </td>

                            <!--House discount amount-->
                            <td>
                                <!--previous value-->
                                <p>
                                    <?php echo $key['discount_amount']; ?>
                                    <!--percentage-->% </p>
                                <input type="number" name="update-house-discount" value="<?php echo $key['discount_amount']; ?>" required>
                            </td>


                            <!--House desription-->
                            <td>

                                <textarea placeholder="Enter description....." name="update-house-description" required>
                                    <?php echo $key['house_description']; ?>
                                </textarea>

                            </td>

                            <!--update house button-->
                            <td>
                                <input type="hidden" name="hidden-house-id" value="<?php echo $key['house_id']; ?>">

                                <div id="house-update-button">
                                  <button id="update-house" type="submit" name="update-house"> <i class="fa fa-upload"></i> Update </button> 
                 
                                </div>
                            </td>

                            <!--delete house button-->
                            <td>
                                <div id="house-delete-button">
                                    <button id="delete-house" type="submit" name="delete-house"> <i class="fa fa-trash"></i> Delete </button>
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