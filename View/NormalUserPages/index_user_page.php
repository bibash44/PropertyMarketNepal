<?php
require("../../Modal/user_modal.php");

if (!isset($_SESSION ['normaluser'])) {
    header("location:../index.php");
}


if (isset($_SESSION['userupdated']) && $_SESSION['userupdated'] == "user_details_updated") {
    echo "<script> alert('your profile is updated successfully') </script>";
    $_SESSION['userupdated'] = "";
}

     //selecting logged in user messages
    $adminmessages = new AdminMessage;
    $email = $_SESSION['normaluser'];
    $adminmessages->SetUserEmail($email);
    $result = $adminmessages->SelectAdminMessages();
    $total_a_messages = mysqli_num_rows($result);

// specific user details
    $specificuser= new User;
    $email= $_SESSION['normaluser'];
    $specificuser->SetEmail($email);
    $userdetails= $specificuser-> SelectSpecificUserDetails();

//best selling property details
//best selling property 
$bestsellingproperty = new BestSellingProperty;
$result3 = $bestsellingproperty->SelectPropertyDetails();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>User House Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/user_page_css/index_user_page.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/w3schoolcss.css">

        <script type="text/javascript" src="../javascript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
        <script type="text/javascript" src="../javascript/javascript.js"></script>
        <script type="text/javascript" src="../javascript/ajax2.js"></script>

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
            <div id="user-status">
                <!--Name of user-->
                <?php 
                foreach ($userdetails as $key) {
                echo $key['name'];
                }
                ?>

            </div>
            <div id="user_avatar"><img src="../photos/Logos/registered-user-message-logo.png"></div>


            <div id="search-box">
                <form method="POST" action="../../Controller/user_controller.php">
                    <select name="property-category">
                <option>House</option>
                <option>Flat</option>
                <option>Room</option>
                <option>Land</option>
            </select>
                    <input type="search" name="search-property-keyword" required placeholder="Type property id, price, location....">
                    <button type="submit" name="search-property-button"> <i class="fa fa-search"></i> </button>
                </form>
            </div>


            <div id="logout">
                <form method="POST" action="../../Controller/user_controller.php">
                    <button type="submit" name="user-logout"> Logout <i class=" fa fa-power-off"></i></button>
                </form>
                <div id="user_manual_page">
                    <a href="../NormalUserPages/user_manaul_page.php"> Help ? </a> </div>
            </div>
        </div>

        </div>

        <!--body details-->
        <div id="page-body-details">
            <!--Send message to admin box-->
            <div id="send-message-box">
                <div id="send-message-heading">

                    <i class="fa fa-envelope-open"></i> Leave a message
                    <button id="minimize-message-box" onclick="hidebox()"> <i class="fa fa-minus"></i> </button>
                </div>


                <div id="message-info"> </div>
                <?php 
                 foreach ($userdetails as $key) {
                                    
                ?>
                <div id="user-name">
                    <!--name of user -->
                    <?php echo $key['name']; ?>
                </div>

                <div id="email">
                    <!--email of user -->
                    <?php echo $key['email']; ?>
                </div>

                <div id="phone-number">
                    <!--name of user -->
                    <?php echo $key['phone_number'] ; }?>
                </div>

                <div id="message-area">

                    <textarea name="user-message" placeholder="Message*" id="user-message"></textarea>
                    <input type="hidden" id="email-user" value="<?php echo $key['email'] ?>">
                    <input type="submit" value="Send Message" id="send-message-to-admin">
                </div>

            </div>

            <div id="show-message-box">
                <button id="show-box" onclick="showbox()">  <i class="fa fa-envelope-open-o" aria-hidden="true"></i> Message </button>
            </div>
            <!--end of send message to admin box-->

            <div id="body-details-heading"> <i class="fa fa-star"></i> Best Selling Property </div>
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->

                <?php
                foreach ($result3 as $key) {
                    
                
                ?>
                    <div class="mySlides fade">
                        <img src="<?php echo"../".$key['image_path']; ?>" alt="best selling property images" style="width:100% ">
                        <div class="text">
                            <?php echo $key['property_name']; ?>
                        </div>
                    </div>

                    <?php }?>



                    <!-- Next and previous buttons -->
                    <a class="prev " onclick="plusSlides(-1) ">&#10094;</a>
                    <a class="next " onclick="plusSlides(1) ">&#10095;</a>
            </div>
            <br>

            <!--update profile-->
            <div id="user-update-profile">
                <div id="update-profile-heading">
                    <i class="fa fa-edit"></i> Update Profile </div>

                <div id="update-profile-form">

                    <form method="POST" action="../../Controller/user_controller.php">
                        <?php 
                        foreach ($userdetails as $key) {
                            
                        ?>
                        <p> <i class="fa fa-user" aria-hidden="true"></i> Name: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <input type="text" value="<?php echo $key['name'];?>" name="user-full-name" required pattern="[A-Z a-z a-z A-Z]+"> </p>

                        <p> <i class="fa fa-key" aria-hidden="true"></i> Security Code:
                            <input type="text" value="<?php echo $key['security_code'];?>" name="user-secuirty-code" required pattern=".{6,}"> </p>

                        <p> <i class="fa fa-phone" aria-hidden="true"></i> Phone number:
                            <input type="text" value="<?php echo $key['phone_number'];?>" name="user-phone-number" pattern="([0-9 + -]+).{7,}"></p>

                        <p><input type="submit" name="update-user-button" value="Update"></p>

                        <?php }?>
                    </form>
                </div>
            </div>


            <script>
                /* slides show of user homepage*/
                var slideIndex = 1;
                showSlides(slideIndex);

                // Next/previous controls
                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                // Thumbnail image controls
                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");

                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }

                    slides[slideIndex - 1].style.display = "block";

                }
                /*end of slide show os index page of user */

                /*show and hide message box*/
                var messagebox = document.getElementById("send-message-box");
                var show = document.getElementById("show-message-box");
                var hide = document.getElementById("minimize-message-box");

                function showbox() {
                    messagebox.style.display = "block";
                    show.style.display = "none";

                }

                function hidebox() {
                    messagebox.style.display = "none";
                    show.style.display = "block";
                }
            </script>

    </body>

    </html>