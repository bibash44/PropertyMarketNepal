<?php
require("../../Modal/user_modal.php");
if (!isset($_SESSION['normaluser'])) {
    header("location:../index.php");
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


//userdetails
$username="";
foreach ($userdetails as $key) {
    $username=$key['name'];
}



//store search keyword and property category
$searchkeyword= $_SESSION['search-property-keyword'];
$property_category =$_SESSION['search-property-category'];

//search property objects
$searchhouse= new House;
$searchflat= new Flat;
$searchroom= new Room;
$searchland= new Land;


?>



    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>User Searched property Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/user_search_property_details.css" />
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


            <!-- favourite property details-->
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
            <div id="body-details-heading">
                <i class="fa fa-search"></i> Search Results
                <p> <b>Property Cateogry:</b>  <i> <?php echo $property_category; ?>  </i> </p>
               <p> <b>Searched Keyword:</b>  <i> <?php echo $searchkeyword; ?>  </i> </p>
            </div>



        <!-- seached house details -->
            <?php 
            if ($property_category=="House") {
                $searchhouse->SetSearchHouseKeyWord($searchkeyword);
                $search_house_details = $searchhouse->SearchHouse();
                $count_search_house = mysqli_num_rows($search_house_details);

            if ($count_search_house>0) {
             
              foreach ($search_house_details as $key) { 
           ?>

            <!--house details-->
            <div id="house-details-box">

                <!--house image-->
                <div id="house-image">
                    <img src="<?php echo"../".$key['image_path'];?>" width="100%">
                </div>

                <!--House information-->
                <div id="house-info">

                    <!-- house updated date-->
                    <div id="house-updated-date">

                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php echo $key['house_updated_date']; ?>
                    </div>

                    <div id="house-id">
                        <i class="fa fa-key" aria-hidden="true"></i> House Id: <b> <?php echo $key['house_id']; ?> </b>
                    </div>

                    <div id="house-location">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> Location:
                        <b> <?php echo $key['house_location']; ?> </b>
                    </div>

                    <div id="house-no-of-flat">
                        <i class="fa fa-building" aria-hidden="true"></i> No of flat:
                        <b> <?php echo $key['no_of_flat']; ?> </b>
                    </div>

                    <div id="house-no-of-room">
                        <i class="fa fa-bed" aria-hidden="true"></i> No of room:
                        <b> <?php echo $key['no_of_room']; ?> </b>
                    </div>

                    <div id="house-price">
                        <i class="fa fa-money" aria-hidden="true"></i> Price:
                        <b>Rs. <?php echo $key['house_price'];?> </b>
                    </div>


                    <div id="house-discount">
                        <i class="fa fa-tag" aria-hidden="true"></i> Discount:
                        <b> <?php echo $key['discount_amount']; ?> %</b>
                    </div>


                    <div id="house-description">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Description:
                        <b><?php echo $key['house_description']; ?></b>
                    </div>

                </div>

            </div>

            <?php 
         }    
        } 
        
        else {

            //if no value is found, dispay no result result 
        ?>

            <div id="no-search-results">
                <div id="no-search-result-heading">Search Result <i class="fa fa-search"></i></div>
                <div id="no-search-result-body">No Search Result Found</div>
                <div id="no-search-result-picture">
                    <i class="fa fa-frown-o"></i>
                </div>
                <p> <a href="index_user_page.php"> Try again </a> </p>
            </div>
        </div>

        <?php
     }
    }
?>
<!-- end of search house details -->


        <!-- seached flat details -->
            <?php 
            if ($property_category == "Flat") {
                $searchflat->SetSearchFlatKeyWord($searchkeyword);
                $search_flat_details = $searchflat->SearchFlat();
                $count_search_flat = mysqli_num_rows($search_flat_details);

                if ($count_search_flat > 0) {

                    foreach ($search_flat_details as $key) {
                        ?>

            <!--flat details-->
            <div id="flat-details-box">

                <!--flat image-->
                <div id="flat-image">
                    <img src="<?php echo "../".$key['image_path']; ?>" width="100%">
                </div>

                <!--flat information-->
                <div id="flat-info">

                    <!-- flat updated date-->
                    <div id="flat-updated-date">

                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php echo $key['flat_updated_date']; ?>
                    </div>

                    <div id="flat-id">
                        <i class="fa fa-key" aria-hidden="true"></i> flat Id: <b> <?php echo $key['flat_id']; ?> </b>
                    </div>

                    <div id="flat-location">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> Location:
                        <b> <?php echo $key['flat_location']; ?> </b>
                    </div>


                    <div id="flat-no-of-room">
                        <i class="fa fa-bed" aria-hidden="true"></i> No of room:
                        <b> <?php echo $key['no_of_room']; ?> </b>
                    </div>

                    <div id="flat-price">
                        <i class="fa fa-money" aria-hidden="true"></i> Price:
                        <b>Rs. <?php echo $key['flat_price']; ?> </b>
                    </div>


                    <div id="flat-discount">
                        <i class="fa fa-tag" aria-hidden="true"></i> Discount:
                        <b> <?php echo $key['discount_amount']; ?> %</b>
                    </div>


                    <div id="flat-description">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Description:
                        <b><?php echo $key['flat_description']; ?></b>
                    </div>

                </div>

            </div>

            <?php 
        }
    }
    
    else {

            //if no value is found, dispay no result result 
        ?>

            <div id="no-search-results">
                <div id="no-search-result-heading">Search Result <i class="fa fa-search"></i></div>
                <div id="no-search-result-body">Sorry no Search Result Found</div>
                <div id="no-search-result-picture">
                    <i class="fa fa-frown-o"></i>
                </div>
                <p> <a href="index_user_page.php"> Try again </a> </p>
            </div>
        </div> 

        <?php

    }
}
?>
<!-- end of search flat details -->



        <!-- seached room details -->
            <?php 
            if ($property_category == "Room") {
                $searchroom->SetSearchroomKeyWord($searchkeyword);
                $search_room_details = $searchroom->SearchRoom();
                $count_search_room = mysqli_num_rows($search_room_details);

                if ($count_search_room > 0) {

                    foreach ($search_room_details as $key) {
                        ?>

            
        <!--room details-->
        <div id="room-details-box">
            <!--room image-->
            <div id="room-image">
                <img src="<?php echo "../" . $key['image_path']; ?>" width="100%">
            </div>

            <!--room information-->
            <div id="room-info">

                <div id="room-updated-date">

                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php echo $key['room_updated_date']; ?>
                </div>

                <div id="room-id">
                    <i class="fa fa-key" aria-hidden="true"></i> Room Id: <b> <?php echo $key['room_id']; ?> </b>
                </div>

                <div id="room-location">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Location:
                    <b> <?php echo $key['room_location']; ?> </b>
                </div>

                <div id="room-area">
                    <i class="fa fa-area-chart" aria-hidden="true"></i> Area:
                    <b> <?php echo $key['room_area']; ?> sq. meter</b>
                </div>

                <div id="room-price">
                    <i class="fa fa-money" aria-hidden="true"></i> Price:
                    <b> Rs. <?php echo $key['room_price']; ?> </b>
                </div>


                <div id="room-discount">
                    <i class="fa fa-tag" aria-hidden="true"></i> Discount:
                    <b> <?php echo $key['discount_amount']; ?> %</b>
                </div>


                <div id="room-description">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Description:
                    <b><?php echo $key['room_description']; ?>  </b>
                </div>

            </div>


            </div>

            <?php 
        }
    } else {

            //if no value is found, dispay no result result 
        ?>

            <div id="no-search-results">
                <div id="no-search-result-heading">Search Result <i class="fa fa-search"></i></div>
                <div id="no-search-result-body">No Search Result Found</div>
                <div id="no-search-result-picture">
                    <i class="fa fa-frown-o"></i>
                </div>
                <p> <a href="index_user_page.php"> Try again </a> </p>
            </div>
        </div>

        <?php

    }
}
?>
<!-- end of search room details -->





        <!-- seached land details -->
            <?php 
            if ($property_category == "Land") {
                $searchland->SetSearchlandKeyWord($searchkeyword);
                $search_land_details = $searchland->SearchLand();
                $count_search_land = mysqli_num_rows($search_land_details);

                if ($count_search_land > 0) {

                    foreach ($search_land_details as $key) {
                        ?>

            
        <!--land details-->
        <div id="land-details-box">
            <!--land image-->
            <div id="land-image">
                <img src="<?php echo "../" . $key['image_path']; ?>" width="100%">
            </div>

            <!--land information-->
            <div id="land-info">

                <div id="land-updated-date">

                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php echo $key['land_updated_date']; ?>
                </div>

                <div id="land-id">
                    <i class="fa fa-key" aria-hidden="true"></i> land Id: <b> <?php echo $key['land_id']; ?> </b>
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
                    <b><?php echo $key['land_description']; ?>  </b>
                </div>

            </div>


            </div>

            <?php 
        }
    } else {

            //if no value is found, dispay no result result 
        ?>

            <div id="no-search-results">
                <div id="no-search-result-heading">Search Result <i class="fa fa-search"></i></div>
                <div id="no-search-result-body">No Search Result Found</div>
                <div id="no-search-result-picture">
                    <i class="fa fa-frown-o"></i>
                </div>
                <p> <a href="index_user_page.php"> Try again </a> </p>
            </div>
        </div>

        <?php

    }
}
?>
<!-- end of search land details -->


    </body>
    </html>