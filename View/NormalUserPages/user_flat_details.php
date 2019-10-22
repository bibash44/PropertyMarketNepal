<?php
require("../../Modal/user_modal.php");
if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
}

//informing user that flat is already added to favourite list
if (isset($_SESSION['flatalreadyaddedtofavourite']) && $_SESSION['flatalreadyaddedtofavourite'] == "flat_already_added_to_favourite") {
    echo "<script> alert('Selected flat is already in your favourite list'); </script>";
    $_SESSION['flatalreadyaddedtofavourite']="";
}

//informing user that falt is added to favourite list
if (isset($_SESSION['flataddedtofavourite']) && $_SESSION['flataddedtofavourite'] == "flat_added_to_favourite") {
    echo "<script> alert('Selected flat added to favourite'); </script>";
    $_SESSION['flataddedtofavourite']="";
}


//informing user hat flat is already added to ordered flat
if (isset($_SESSION['flatalreadyaddedtoordered']) && $_SESSION['flatalreadyaddedtoordered'] == "flat_already_added_to_ordered") {
    echo "<script> alert('Selected flat is already in your ordered list'); </script>";
    $_SESSION['flatalreadyaddedtoordered'] = "";
}

//informing user that someone ha already ordered selected flat
if (isset($_SESSION['someonealreadyorderedflat']) && $_SESSION['someonealreadyorderedflat'] == "someone_already_ordered_flat") {
    echo "<script> alert('Someone has already placed the ordered for selected flat'); </script>";
    $_SESSION['someonealreadyorderedflat'] = "";
}

//informing user that selected flat is added to orderd list
if (isset($_SESSION['flataddedtoordered']) && $_SESSION['flataddedtoordered'] == "flat_added_to_ordered") {
    echo "<script> alert('Selected flat added to ordered list'); </script>";
    $_SESSION['flataddedtoordered'] = "";
}



    //selecting user details
    $user= new User;
    $useremail= $_SESSION['normaluser'];
    $user->SetEmail($useremail);
    $userdetails= $user->SelectSpecificUserDetails();

      //selecting logged in user messages
    $adminmessages = new AdminMessage;
    $email = $_SESSION['normaluser'];
    $adminmessages->SetUserEmail($email);
    $result = $adminmessages->SelectAdminMessages();
    $total_a_messages = mysqli_num_rows($result);


    //flat details
    $flatdetails= new Flat;
    $result2= $flatdetails->SelectFlatDetails();

    //userdetails
$username = "";
foreach ($userdetails as $key) {
    $username = $key['name'];
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>User flat details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_flat_details.css" />
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


        <!--favourite selling property details-->
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
         <?php foreach($userdetails as $key)
         {
             echo $key['name'];
         }?>
         
         </div>
        <div id="user_avatar"><img src="../photos/Logos/registered-user-message-logo.png"></div>
    </div>

    <!--body details-->
    <div id="page-body-details">
        <div id="body-details-heading"> <i class="fa fa-building"></i> Flat Details News Feed </div>

          

        <?php 

       foreach ($result2 as $key) { 
    
        ?>
        <form method="POST" action="../../Controller/user_controller.php">

        <!--flat details-->
        <div id="flat-details-box">
            <!--flat image-->
            <div id="flat-image">
                <img src="<?php echo"../".$key['image_path']; ?>" width="100%">
            </div>

            <!--flat information-->
            <div id="flat-info">

                <div id="flat-updated-date">

                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                  <?php echo $key['flat_updated_date']; ?>
                </div>

                <div id="flat-id">
                    <i class="fa fa-key" aria-hidden="true"></i> Flat Id: <b> <?php echo $key['flat_id']; ?> </b>
                </div>

                <div id="flat-location">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Location:
                    <b> <?php echo $key['flat_location']; ?>  </b>
                </div>

                <div id="flat-no-of-room">
                    <i class="fa fa-bed" aria-hidden="true"></i> No of room:
                    <b> <?php echo $key['no_of_room']; ?> </b>
                </div>

                <div id="flat-price">
                    <i class="fa fa-money" aria-hidden="true"></i> Price:
                    <b> Rs: <?php echo $key['flat_price']; ?> </b>
                </div>


                <div id="flat-discount">
                    <i class="fa fa-tag" aria-hidden="true"></i> Discount:
                    <b> <?php echo $key['discount_amount']; ?> %</b>
                </div>


                <div id="flat-description">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Description:
                    <b> <?php echo $key['flat_description']; ?>  </b>
                </div>

            </div>


            <!--buttons-->
            <div id="add-to-buttons">

                         <!--hidden user email -->
                        <input type="hidden" name="hidden-user-email" value="<?php echo $useremail; ?>">
                        <!--hidden flat id -->
                        <input type="hidden" name="hidden-flat-id" value="<?php echo $key['flat_id']; ?>">

                    <button type="submit" id="add-to-fav" name="add-flat-to-fav">
                        <i class="fa fa-heart" aria-hidden="true"></i> 
                        Add to favourite</button>

                    <button type="submit" id="place-order" name="place-flat-order">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            Place order</button>
              

                            </div>

                              <?php

                                //selecting comments
                                $flat_id = $key['flat_id'];
                                $comments = new Comment;
                                $comments->SetPropertyId($flat_id);
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
                       
                       <input type="hidden" value="<?php echo $key['flat_id']; ?>" name="commented-flat-id">

                         <!--hidden user name -->
                        <input type="hidden" name="user-name" value="<?php echo $username; ?>">

                         <input type="hidden" value="<?php echo $useremail; ?>" name="user-who-commented">

                    <input type="text" name="add-flat-comment" placeholder="Add a comment....">

                    <button type="submit" name="add-comment-in-flat-button"><i class="fa fa-send" aria-hidden="true"></i></button>
              
            </div>
        </div>
         </form>
        <?php }?>



</body>

</htm