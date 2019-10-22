<?php
require "../../Modal/user_modal.php";

if (!isset($_SESSION['adminuser'])) {
    header("location:../index.php");
}

if (isset($_SESSION['propertyalreadyexist']) && $_SESSION['propertyalreadyexist']=="existingproperty") {
    echo "<script> alert('Property already exist, enter a different Id'); </script>";
    $_SESSION['propertyalreadyexist']="";
}
if (isset($_SESSION['bestpropertyuploaded']) && $_SESSION['bestpropertyuploaded']=="property_uploaded") {
    echo "<script> alert('New property has been uploaded'); </script>";
    $_SESSION['bestpropertyuploaded']="";
}

if (isset($_SESSION['nophotobigsize']) && $_SESSION['nophotobigsize']=="not_a_photo_and_big_size") {
    echo "<script> alert('File size exceed 5MB or the selected file is not a photo'); </script>";
    $_SESSION['nophotobigsize']="";
}

if (isset($_SESSION['bestpropertydeleted']) && $_SESSION['bestpropertydeleted'] == "best_property_deleted") {
    echo "<script> alert('Selected Property Removed'); </script>";
    $_SESSION['bestpropertydeleted'] = "";
}


// messages of unregistered user
$unregisteredmessages = new UnregisteredMessage;
$result = $unregisteredmessages->SelectUrUserMessages();
$total_ur_message = mysqli_num_rows($result);

//messages of registered users

$registeredmessages = new UserMessage;
$result2 = $registeredmessages->SelectUserMessages();
$total_r_message = mysqli_num_rows($result2);

//best selling property 
$bestsellingproperty= new BestSellingProperty;
$result3= $bestsellingproperty->SelectPropertyDetails();

?>



    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Admin best selling property </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/admin_pages_css/admin_best_selling_property.css" />
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

            <div id="body-details-heading"> <i class="fa fa-thumbs-up"></i> Upload Best selling property </div>
            <!--best-selling-property details upload-->
            <div id="best-selling-property-box">
                <div id="best-selling-property-header">
                    <div id="best-selling-property-header-text1">Best Selling Property</div>
                    <div id="best-selling-property-header-text2">Upload a new best selling property</div>
                    <div id="best-selling-property-header-logo">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <img src="../photos/Logos/Homapagelogo.png">
                    </div>
                </div>

                <div id="best-selling-property-input">

                    <div id="best-selling-property-form">
                        <!--Sign up form-->
                        <form method="POST" action="../../Controller/admin_controller.php" enctype="multipart/form-data" class="upload-best-selling-property-form">
                            <!--check existing property-->
                            <div id="status-of-property" style="color: red;"> </div>

                            <div id="best-selling-property-id">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input type="text" id="id-of-best-selling-property" name="best-selling-property-id" placeholder="Enter property ID (eg: P123)" required pattern="[P][0-9]+" onblur="loadme()">
                            </div>
                            <div id="best-selling-property-name">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                <input type="text" name="best-selling-property-name" placeholder="Enter property name" required id="best-selling-property-name">
                            </div>


                            <div id="photo-of-best-selling-property">

                                <label id="best-selling-property-photo-for" for="best-selling-property-photo">
                                <i class="fa fa-photo"></i> Select a photo</label>
                                <input type="file" name="best-selling-property-photo" id="best-selling-property-photo" required>
                            </div>

                            <div id="best-selling-property-button-press">
                                <input type="submit" name="upload-best-selling-property-button" value="Upload" id="new-user-best-selling-property">
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- End of of signup- form-->
            <!--end of land details upload-->

            <!-- Edit best selling property details-->

            <div id="edit-best-selling-property">
                <div id="edit-best-selling-property-heading"><i class="fa fa-edit"></i> Delete Property </div>


              
                    <table>
                        <tr>
                            <th>Property ID</th>
                            <th>Property Name</th>
                            <th>Property Image</th>
                            <th>Updated at </th>
                            <th>Delete</th>

                        </tr>

                        <?php 
                    foreach ($result3 as $key) {
                        ?>
                        
                    <form method="POST" action="../../Controller/admin_controller.php" class="edit-best-selling-property-form">

                        <tr>
                            <!--property id value-->
                            <td>
                                <?php  echo $key['property_id']; ?>
                            </td>

                            <!-- property updated date-->
                            <td>
                                <?php echo $key['property_name']; ?> </td>

                            <!--property updated details -->

                            <td>
                                <?php echo $key['property_updated_date']; ?>
                            </td>

                            <td><img src="<?php echo"../".$key['image_path']; ?>" alt="best selling property images"> </td>


                            <!--delete land button-->
                            <td>
                                <div id="property-delete-button">
                                    <input type="hidden" name="property-id-to-delete" value="<?php echo $key['property_id'];?>">
                                    <button id="delete-property" type="submit" name="delete-property"> <i class="fa fa-trash"></i> Delete </button>
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