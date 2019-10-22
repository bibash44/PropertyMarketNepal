<?php
require "../../Modal/user_modal.php";


if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}

if (isset($_SESSION['flatexist']) && $_SESSION['flatexist'] == "flat_exist") {
    echo "<script> alert('flat already exist, enter a different id'); </script>";
    $_SESSION['flatexist'] = "";
}

//informing about the new flat uploaded
if (isset($_SESSION['flatuploaded']) && $_SESSION['flatuploaded'] == "flat_uploaded") {
    echo "<script> alert('New flat uploaded'); </script>";
    $_SESSION['flatuploaded'] = "";
}

//informing about the file type and photo size exceeding
if (isset($_SESSION['noflatphotobigsize']) && $_SESSION['noflatphotobigsize'] == "no_flat_photo_big_size") {
    echo "<script> alert('Selected file is not a photo or exceed more than 5MB'); </script>";
    $_SESSION['noflatphotobigsize'] = "";
}


if (isset($_SESSION['selectedflatremoved']) && $_SESSION['selectedflatremoved'] == "selected_flat_removed") {
    echo "<script> alert('Selected flat removed'); </script>";
    $_SESSION['selectedflatremoved'] = "";
}


if (isset($_SESSION['selectedflatupdated']) && $_SESSION['selectedflatupdated'] == "selected_flat_updated") {
    echo "<script> alert('Selected flat updated'); </script>";
    $_SESSION['selectedflatupdated'] = "";
}

// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);


//flat details
$flatdetails= new Flat;
$result3 =$flatdetails->SelectFlatDetails();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Admin flat details page </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_flat_details_page.css" />
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
                   <i class="fa fa-cart-arrow-down"></i>  Ordered property

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

            <div id="body-details-heading"> <i class="fa fa-building"></i> Upload Flat </div>

            <!--flat details upload-->
            <div id="flat-box">
                <div id="flat-header">
                    <div id="flat-header-text1">Flat</div>
                    <div id="flat-header-text2">Upload a new flat</div>
                    <div id="flat-header-logo">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <img src="../photos/Logos/Homapagelogo.png">
                    </div>
                </div>

                <div id="flat-input">

                    <div id="flat-form">
                        <!--Sign up form-->
                        <form method="POST" action="../../Controller/admin_controller.php" class="upload-flat-form" enctype="multipart/form-data">

                            <div id="flat-name">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input type="text" name="flat-id" placeholder="Enter flat ID (eg: F123)" required id="flat-id" pattern="[F][0-9]+">
                            </div>

                            <div id="flat-location">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" name="flat-location" placeholder="Enter flat location" required id="flat-location">
                            </div>


                            <div id="flat-number-of-room">
                                <i class="fa fa-bed" aria-hidden="true"></i>
                                <input type="number" name="flat-no-of-room" id="flat-number-of-room" placeholder="Enter number of room" required>
                            </div>

                            <div id="flat-price">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <input type="text" name="flat-price" placeholder="Enter flat price" required id="flat-price" pattern="[0-9]+">
                            </div>

                            <div id="flat-discount">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <input type="number" name="flat-discount" id="flat-discount-amount" placeholder="Enter discount amount" required>
                            </div>

                            <!--flat description-->
                            <div id="flat-description">
                                <i class="fa fa-pencil"></i>
                                <textarea required name="flat-description" placeholder="Flat description..."></textarea>
                            </div>

                            <div id="photo-of-flat">

                                <label id="flat-photo-for" for="flat-photo">
                                <i class="fa fa-photo"></i> Select a photo</label>
                                <input type="file" name="flat-photo" id="flat-photo" required>
                            </div>

                            <div id="flat-button-press">
                                <input type="submit" name="upload-flat-button" value="Upload" id="new-user-flat">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- End of of signup- form-->
            <!--end of flat details upload-->

            <!-- Available users and send message-->

            <div id="edit-flat">
                <div id="edit-flat-heading"><i class="fa fa-edit"></i> Edit flat Details </div>


               
                    <table>
                        <tr>
                            <th>Flat ID</th>
                            <th> Flat Photo </th>
                            <th>Flat Location </th>
                            <th>Number of room</th>
                            <th>Flat Price</th>
                            <th>Flat discount amount</th>
                            <th>Flat Description</th>
                            <th>Update</th>
                            <th>Delete</th>

                        </tr>

                        <?php 
                    foreach ($result3 as $key) {
                        ?>
                   <form method="POST" class="edit-flat-form" action="../../Controller/admin_controller.php"
                        <tr>
                            <!--flat id value-->
                            <td>
                                <?php echo $key['flat_id']; ?> </td>

                            <td> <img src="<?php echo" ../".$key['image_path']; ?>" alt="flat image"> </td>

                            <!-- flat location value-->
                            <td>
                                <?php echo $key['flat_location']; ?>
                            </td>


                            <!-- number of room in a flat-->
                            <td>
                                <!-- previous no of room value -->
                                <p>
                                    <?php echo $key['no_of_room']; ?> </p>
                                <!-- value to be updated -->
                                <input type="number" name="update-flat-no-of-room" required value="<?php echo $key['no_of_room']; ?>">

                            </td>

                            <!--flat price-->
                            <td>
                                <!--previous value-->
                                <p> Rs.
                                    <!-- value from database -->
                                    <?php echo $key['flat_price']; ?> </p>

                                <input type="text" name="update-flat-price" required pattern="[0-9]+" value="<?php echo $key['flat_price'];?>">

                            </td>

                            <!--flat discount amount-->
                            <td>
                                <!--previous value-->
                                <p>
                                    <?php  echo $key['discount_amount'];?>
                                    <!--percentage-->% </p>
                                <input type="number" name="update-flat-discount" required value="<?php echo $key['discount_amount'];?>">
                            </td>


                            <!--flat desription-->
                            <td>
                                <textarea placeholder="Enter description....." name="update-flat-description" required><?php echo $key['flat_description']; ?></textarea>

                            </td>

                            <!--update flat button-->
                            <td>
                                <input type="hidden" name="hidden-flat-id" value="<?php echo $key['flat_id']; ?>">
                                <div id="flat-update-button">
                                  
                                  <button id="update-flat" type="submit" name="update-flat"> <i class="fa fa-upload"></i> Update </button> 
                                </div>
                            </td>

                            <!--delete flat button-->
                            <td>
                                <div id="flat-delete-button">
                                  
                                   <button id="delete-flat" type="submit" name="delete-flat"> <i class="fa fa-trash"></i> Delete </button> 
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