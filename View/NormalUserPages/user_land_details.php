<?php
require("../../Modal/user_modal.php");

if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
}
//informing user that land is already added to favourite list
if (isset($_SESSION['landalreadyaddedtofavourite']) && $_SESSION['landalreadyaddedtofavourite'] == "land_already_added_to_favourite") {
    echo "<script> alert('Selected land is already in your favourite list'); </script>";
    $_SESSION['landalreadyaddedtofavourite'] = "";
}

//informing user that land is added to favourite list
if (isset($_SESSION['landaddedtofavourite']) && $_SESSION['landaddedtofavourite'] == "land_added_to_favourite") {
    echo "<script> alert('Selected land added to favourite'); </script>";
    $_SESSION['landaddedtofavourite'] = "";
}

//informing user hat land is already added to ordered land
if (isset($_SESSION['landalreadyaddedtoordered']) && $_SESSION['landalreadyaddedtoordered'] == "land_already_added_to_ordered") {
    echo "<script> alert('Selected land is already in your ordered list'); </script>";
    $_SESSION['landalreadyaddedtoordered'] = "";
}

//informing user that someone ha already ordered selected land
if (isset($_SESSION['someonealreadyorderedland']) && $_SESSION['someonealreadyorderedland'] == "someone_already_ordered_land") {
    echo "<script> alert('Someone has already placed the ordered for selected land'); </script>";
    $_SESSION['someonealreadyorderedland'] = "";
}

//informing user that selected land is added to orderd list
if (isset($_SESSION['landaddedtoordered']) && $_SESSION['landaddedtoordered'] == "land_added_to_ordered") {
    echo "<script> alert('Selected land added to ordered list'); </script>";
    $_SESSION['landaddedtoordered'] = "";
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

$landdetails= new Land;
$result2= $landdetails->SelectlandDetails();

$username = "";
foreach ($userdetails as $key) {
    $username = $key['name'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>User Land Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_land_details.css" />
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
                <span class="total-messages"> <?php echo $total_a_messages; ?> </span>
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
                <i class="fa fa-heart"></i> Favourite property

            </a>
        </div>
    </div>

    <!--end of side nav bar-->

    <div id="horizontal-nav-bar">
        <div id="user-status"> <?php
        foreach ($userdetails as $key) {
            echo $key['name'];
        }
        ?></div>
        <div id="user_avatar"><img src="../photos/Logos/registered-user-message-logo.png"></div>
    </div>

    <!--body details-->
    <div id="page-body-details">
        <div id="body-details-heading"> <i class="fa fa-bed"></i> land Details News Feed </div>



      <?php 
      foreach ($result2 as $key) { 
      ?>
        <form method="POST" action="../../Controller/user_controller.php"> 
        <!--land details-->
        <div id="land-details-box">
            <!--land image-->
            <div id="land-image">
                <img src="<?php echo"../".$key['image_path']; ?>" width="100%">
            </div>

            <!--land information-->
            <div id="land-info">

                <div id="land-updated-date">

                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php echo $key['land_updated_date']; ?>
                </div>

                <div id="land-id">
                    <i class="fa fa-key" aria-hidden="true"></i> Land Id: <b> <?php echo $key['land_id']; ?> </b>
                </div>

                <div id="land-location">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Location:
                    <b> <?php echo $key['land_location']; ?> </b>
                </div>

                <div id="land-area">
                    <i class="fa fa-area-chart" aria-hidden="true"></i> Area:
                    <b> <?php echo $key['land_area']; ?> sq. meter</b>
                </div>

                <div id="land-price">
                    <i class="fa fa-money" aria-hidden="true"></i> Price:
                    <b> Rs. <?php echo $key['land_price']; ?> </b>
                </div>


                <div id="land-discount">
                    <i class="fa fa-tag" aria-hidden="true"></i> Discount:
                    <b> <?php echo $key['discount_amount']; ?> %</b>
                </div>


                <div id="land-description">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Description:
                    <b> <?php echo $key['land_description']; ?>  </b>
                </div>

            </div>


            <!--buttons-->
            <div id="add-to-buttons">
               
                       <!--hidden user email -->
                        <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">
                        <!--hidden house id -->
                        <input type="hidden" name="hidden-land-id" value="<?php echo $key['land_id']; ?>">

                    <button type="submit" id="add-to-fav" name="add-land-to-fav">
                        <i class="fa fa-heart" aria-hidden="true"></i> 
                        Add to favourite</button>

                    <button type="submit" id="place-order" name="place-land-order">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            Place order</button>
             

            </div>

                            <?php

                            //selecting comments
                            $land_id = $key['land_id'];
                            $comments = new Comment;
                            $comments->SetPropertyId($land_id);
                            $comment_details = $comments->DisplayComment();

                             foreach ($comment_details as $key2) {?>
                                <!--Add commet-->
                                <div id="commented-text">
                                <div id="comments">
                                <span id="comment-username"> <?php echo $key2['username']; ?>: </span>
                                <!--actual comment-->
                               <?php echo $key2['comment']; ?>
                            </div>
                            <p>
                                <div id="comment-date">
                                <?php echo $key2['comment_date']; ?>
                            </div>
                        </p>
                    </div>

                      <?php
                       }?>
                    <!--End of commented text-->

                 <!--place a new comment-->
                  <div id="comment-box">

                        <input type="hidden" value="<?php echo $key['land_id']; ?>" name="commented-land-id">

                         <!--hidden user name -->
                        <input type="hidden" name="user-name" value="<?php echo $username; ?>">

                         <input type="hidden" value="<?php echo $useremail; ?>" name="user-who-commented">

                    <input type="text" name="add-land-comment" placeholder="Add a comment....">

                    <button type="submit" name="add-comment-in-land-button"><i class="fa fa-send" aria-hidden="true"></i></button>
                
            </div>


        </div>
      </form>
        <?php }?>

</body>

</htm