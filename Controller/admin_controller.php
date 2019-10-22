<?php 
require("../Modal/user_modal.php");
$user = new User;
// Admin logout

if (isset($_POST['admin-logout'])) {
    session_destroy();
    unset($_SESSION['adminuser']);
    header("location:../View/index.php");
}

//admin messages
$adminmessages= new AdminMessage;

if(isset($_POST['send-message-to-user'])){
    date_default_timezone_set('Asia/Kathmandu');
    $message_date = date("l jS \of F Y , h:i:s A");

    $message= $_POST['admin-message-to-user'];
    $user_email=$_POST['user-email'];

    $adminmessages->SetMessageDate($message_date);
    $adminmessages->SetMessage($message);
    $adminmessages->SetUserEmail($user_email);

    $adminmessages->EnterAdminMessages();

}

//best selling proprty details
$bestsellingproperty= new BestSellingProperty;

    if (isset($_POST['upload-best-selling-property-button'])) {

        date_default_timezone_set('Asia/Kathmandu');
        $property_updated_date = date("l jS \of F Y , h:i:s A");

        $property_id= $_POST['best-selling-property-id'];
        $property_name= $_POST['best-selling-property-name'];
        
        $property_photo_name= $_FILES['best-selling-property-photo']['name'];
        $property_photo_size= $_FILES['best-selling-property-photo']['size'];

        //photo path to be stored in folder
        $photo_moving_path= "../View/Photos/Best_selling_property_images/".$property_id."".$property_photo_name;

        //photo path to get upoaded in database
        $image_path_to_display= "Photos/Best_selling_property_images/".$property_id."".$property_photo_name;

        //extension of photo
        $photoextension= pathinfo($photo_moving_path, PATHINFO_EXTENSION);

        $bestsellingproperty->SetPropertyId($property_id);

        $count_property= $bestsellingproperty->CheckProperty();

        if ($count_property>0) {
        $_SESSION['propertyalreadyexist'] = "existingproperty";
        header("location:../View/AdminPages/admin_best_selling_property.php");
        }

  else if($photoextension=="jpg" || $photoextension=="gif" || $photoextension=="png" && $property_photo_size<619748){

   move_uploaded_file($_FILES['best-selling-property-photo']['tmp_name'], $photo_moving_path);

  $bestsellingproperty->SetPropertyId($property_id);
  $bestsellingproperty->SetPropertyName($property_name);
  $bestsellingproperty->SetPropertyUpdatedDate($property_updated_date);
  $bestsellingproperty->SetImagePath($image_path_to_display);

  $bestsellingproperty->UploadBestSellingProperty();
   }

     else{
      $_SESSION['nophotobigsize']="not_a_photo_and_big_size";
      header("location:../View/AdminPages/admin_best_selling_property.php");
        }
    }

//delete best selling property details
if (isset($_POST['delete-property'])) {
    $property_id= $_POST['property-id-to-delete'];
    $bestsellingproperty->SetPropertyId($property_id);
    
    $bestsellingproperty->RemoveProperty();

}

    //admin house details upload
    $housedetails= new House;
    if (isset($_POST['upload-house-button'])) {

    date_default_timezone_set('Asia/Kathmandu');
    $house_updated_date = date("l jS \of F Y , h:i:s A");

    $house_id = $_POST['house-id'];
    $house_location = $_POST['house-location'];
    $no_of_flat = $_POST['no-of-flat-in-house'];
    $no_of_room = $_POST['no-of-room-in-house'];
    $house_price = $_POST['house-price'];
    
    $house_description = $_POST['house-description'];
    $discount_amount = $_POST['house-discount'];

    $house_photo_name = $_FILES['photo-of-house']['name'];
    $house_photo_size = $_FILES['photo-of-house']['size'];
    
    //photo path to be stored in folder
    $photo_moving_path = "../View/Photos/house_photos/".$house_id."".$house_photo_name;

     //photo path to get upoaded in database
    $image_path_to_display = "Photos/house_photos/".$house_id."".$house_photo_name;

     //extension of photo
    $photoextension = pathinfo($photo_moving_path, PATHINFO_EXTENSION);

    $housedetails->SetHouseId($house_id);
    $counthouse= $housedetails->CheckProperty();
    
    if ($counthouse>0) {
        $_SESSION['houseexist']="house_exist";
        header("location:../View/AdminPages/admin_house_details_page.php");
    }

else if($photoextension=="jpg" || $photoextension=="gif" || $photoextension=="png" && $house_photo_size<6197480){
 move_uploaded_file($_FILES['photo-of-house']['tmp_name'], $photo_moving_path);

        $housedetails->SetHouseId($house_id);
        $housedetails->SetHouseLocation($house_location);
        $housedetails->SetNoOfFlat($no_of_flat);
        $housedetails->SetHousePrice($house_price);
        $housedetails->SetNoOfRoom($no_of_room);
        $housedetails->SetHousePrice($house_price);
        $housedetails->SetDiscountAmount($discount_amount);
        $housedetails->SetHouseDescription($house_description);
        $housedetails->SetImagePath($image_path_to_display);
        $housedetails->SetHouseUpdateDate($house_updated_date);

        $housedetails->UploadHouse();
    }

    else{
        $_SESSION['nohousephotobigsize']="no_house_photo_big_size";
        header("location:../View/AdminPages/admin_house_details_page.php");
    }

    }

    //update house details
    if (isset($_POST['update-house'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $house_updated_date = date("l jS \of F Y , h:i:s A");

    $house_id = $_POST['hidden-house-id'];
    $no_of_flat = $_POST['update-house-no-of-flat'];
    $no_of_room = $_POST['update-house-no-of-room'];
    $house_price = $_POST['update-house-price'];

    $house_description = $_POST['update-house-description'];
    $discount_amount = $_POST['update-house-discount'];

    $housedetails->SetHouseId($house_id);
    $housedetails->SetNoOfFlat($no_of_flat);
    $housedetails->SetNoOfRoom($no_of_room);
    $housedetails->SetHousePrice($house_price);
    $housedetails->SetDiscountAmount($discount_amount);
    $housedetails->SetHouseDescription($house_description);
    $housedetails->SetHouseUpdateDate($house_updated_date);

    $housedetails->UpdateHouseDetails();

    }

    //delete house details
    if (isset($_POST['delete-house'])) {
        $house_id= $_POST['hidden-house-id'];

        $housedetails->SetHouseId($house_id);
        $housedetails->RemoveHouse();
}

 //admin flat details upload
$flatdetails = new Flat;
if (isset($_POST['upload-flat-button'])) {

    date_default_timezone_set('Asia/Kathmandu');
    $flat_updated_date = date("l jS \of F Y , h:i:s A");

    $flat_id = $_POST['flat-id'];
    $flat_location = $_POST['flat-location'];
    $no_of_room = $_POST['flat-no-of-room'];
    $flat_price = $_POST['flat-price'];

    $flat_description = $_POST['flat-description'];
    $discount_amount = $_POST['flat-discount'];

    $flat_photo_name = $_FILES['flat-photo']['name'];
    $flat_photo_size = $_FILES['flat-photo']['size'];
    
    //photo path to be stored in folder
    $photo_moving_path = "../View/Photos/flat_photos/".$flat_id."".$flat_photo_name;

     //photo path to get upoaded in database
    $image_path_to_display = "Photos/flat_photos/".$flat_id."".$flat_photo_name;

     //extension of photo
    $photoextension = pathinfo($photo_moving_path, PATHINFO_EXTENSION);

    $flatdetails->SetflatId($flat_id);
    $countflat = $flatdetails->CheckProperty();

    if ($countflat > 0) {
        $_SESSION['flatexist'] = "flat_exist";
        header("location:../View/AdminPages/admin_flat_details_page.php");
    }
    
    else if($photoextension=="jpg" || $photoextension=="gif" || $photoextension=="png" && $flat_photo_size<6197480){
        move_uploaded_file($_FILES['flat-photo']['tmp_name'], $photo_moving_path);

        $flatdetails->SetflatId($flat_id);
        $flatdetails->SetflatLocation($flat_location);
        $flatdetails->SetflatPrice($flat_price);
        $flatdetails->SetNoOfRoom($no_of_room);
        $flatdetails->SetflatPrice($flat_price);
        $flatdetails->SetDiscountAmount($discount_amount);
        $flatdetails->SetflatDescription($flat_description);
        $flatdetails->SetImagePath($image_path_to_display);
        $flatdetails->SetflatUpdateDate($flat_updated_date);

        $flatdetails->Uploadflat();
    } 
    else {
        $_SESSION['noflatphotobigsize'] = "no_flat_photo_big_size";
        header("location:../View/AdminPages/admin_flat_details_page.php");
    }

}

     //update flat details
    if (isset($_POST['update-flat'])) {
        date_default_timezone_set('Asia/Kathmandu');
        $flat_updated_date = date("l jS \of F Y , h:i:s A");

        $flat_id = $_POST['hidden-flat-id'];
        $no_of_room = $_POST['update-flat-no-of-room'];
        $flat_price = $_POST['update-flat-price'];

        $flat_description = $_POST['update-flat-description'];
        $discount_amount = $_POST['update-flat-discount'];

        echo $flat_id;
    
       $flatdetails->SetflatId($flat_id);
        $flatdetails->SetNoOfRoom($no_of_room);
        $flatdetails->SetflatPrice($flat_price);
        $flatdetails->SetDiscountAmount($discount_amount);
        $flatdetails->SetflatDescription($flat_description);
        $flatdetails->SetflatUpdateDate($flat_updated_date);

        $flatdetails->UpdateflatDetails();

    }

   // delete flat details
    if (isset($_POST['delete-flat'])) {
        $flat_id = $_POST['hidden-flat-id'];
       
       $flatdetails->SetflatId($flat_id);
       $flatdetails->Removeflat();
    }

     //admin room details upload
    $roomdetails = new room;
    if (isset($_POST['upload-room-button'])) {

    date_default_timezone_set('Asia/Kathmandu');
    $room_updated_date = date("l jS \of F Y , h:i:s A");

    $room_id = $_POST['room-id'];
    $room_location = $_POST['room-location'];
    $room_area = $_POST['room-room-area'];
    $room_price = $_POST['room-price'];

    $room_description = $_POST['room-description'];
    $discount_amount = $_POST['room-discount'];

    $room_photo_name = $_FILES['room-photo']['name'];
    $room_photo_size = $_FILES['room-photo']['size'];
    
    //photo path to be stored in folder
    $photo_moving_path = "../View/Photos/room_photos/" . $room_id . "" . $room_photo_name;

     //photo path to get upoaded in database
    $image_path_to_display = "Photos/room_photos/" . $room_id . "" . $room_photo_name;

     //extension of photo
    $photoextension = pathinfo($photo_moving_path, PATHINFO_EXTENSION);

    $roomdetails->SetroomId($room_id);
    $countroom = $roomdetails->CheckProperty();

    if ($countroom > 0) {
        $_SESSION['roomexist'] = "room_exist";
        header("location:../View/AdminPages/admin_room_details_page.php");
    } 
    else if ($photoextension=="jpg" || $photoextension=="gif" || $photoextension=="png" && $room_photo_size<6197480){
        move_uploaded_file($_FILES['room-photo']['tmp_name'], $photo_moving_path);

        $roomdetails->SetroomId($room_id);
        $roomdetails->SetroomLocation($room_location);
        $roomdetails->SetroomPrice($room_price);
        $roomdetails->SetRoomArea($room_area);
        $roomdetails->SetroomPrice($room_price);
        $roomdetails->SetDiscountAmount($discount_amount);
        $roomdetails->SetroomDescription($room_description);
        $roomdetails->SetImagePath($image_path_to_display);
        $roomdetails->SetroomUpdateDate($room_updated_date);

        $roomdetails->Uploadroom();
    } else {
        $_SESSION['noroomphotobigsize'] = "no_room_photo_big_size";
        header("location:../View/AdminPages/admin_room_details_page.php");
    }

}

    //room update details
    if (isset($_POST['update-room'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $room_updated_date = date("l jS \of F Y , h:i:s A");

    $room_id = $_POST['hidden-room-id'];
    $room_price = $_POST['update-room-price'];

    $room_description = $_POST['update-room-description'];
    $discount_amount = $_POST['update-room-discount'];

    $roomdetails->SetroomId($room_id);
    $roomdetails->SetroomPrice($room_price);
    $roomdetails->SetDiscountAmount($discount_amount);
    $roomdetails->SetroomDescription($room_description);
    $roomdetails->SetroomUpdateDate($room_updated_date);

    $roomdetails->UpdateroomDetails();

}
//delete room details
if(isset($_POST['delete-room'])){
    $room_id = $_POST['hidden-room-id'];
    echo $room_id;

    $roomdetails->SetroomId($room_id);
    $roomdetails->Removeroom();
}

    //admin land details upload
    $landdetails = new Land;
    if (isset($_POST['upload-land-button'])) {

    date_default_timezone_set('Asia/Kathmandu');
    $land_updated_date = date("l jS \of F Y , h:i:s A");

    $land_id = $_POST['land-id'];
    $land_location = $_POST['land-location'];
    $land_area = $_POST['land-land-area'];
    $land_price = $_POST['land-price'];

    $land_description = $_POST['land-description'];
    $discount_amount = $_POST['land-discount'];

    $land_photo_name = $_FILES['land-photo']['name'];
    $land_photo_size = $_FILES['land-photo']['size'];
    
    //photo path to be stored in folder
    $photo_moving_path = "../View/Photos/land_photos/".$land_id."".$land_photo_name;

     //photo path to get upoaded in database
    $image_path_to_display = "Photos/land_photos/".$land_id."".$land_photo_name;

     //extension of photo
    $photoextension = pathinfo($photo_moving_path, PATHINFO_EXTENSION);

    $landdetails->SetlandId($land_id);
    $countland = $landdetails->CheckProperty();

    if ($countland > 0) {
        $_SESSION['landexist'] = "land_exist";
        header("location:../View/AdminPages/admin_land_details_page.php");
    }
    
    else if ($photoextension=="jpg" || $photoextension=="gif" || $photoextension=="png" && $land_photo_size<6197480){
        move_uploaded_file($_FILES['land-photo']['tmp_name'], $photo_moving_path);

        $landdetails->SetlandId($land_id);
        $landdetails->SetlandLocation($land_location);
        $landdetails->SetlandPrice($land_price);
        $landdetails->SetlandArea($land_area);
        $landdetails->SetlandPrice($land_price);
        $landdetails->SetDiscountAmount($discount_amount);
        $landdetails->SetlandDescription($land_description);
        $landdetails->SetImagePath($image_path_to_display);
        $landdetails->SetlandUpdateDate($land_updated_date);

        $landdetails->Uploadland();
    } 
    else {
        $_SESSION['nolandphotobigsize'] = "no_land_photo_big_size";
        header("location:../View/AdminPages/admin_land_details_page.php");
    }

}

     //update land details
     if (isset($_POST['update-land'])) {
        date_default_timezone_set('Asia/Kathmandu');
        $land_updated_date = date("l jS \of F Y , h:i:s A");

        $land_id = $_POST['hidden-land-id'];
        $land_price = $_POST['update-land-price'];

        $land_description = $_POST['update-land-description'];
        $discount_amount = $_POST['update-land-discount'];

        echo $land_id;
    
       $landdetails->SetlandId($land_id);
        $landdetails->SetlandPrice($land_price);
        $landdetails->SetDiscountAmount($discount_amount);
        $landdetails->SetlandDescription($land_description);
        $landdetails->SetlandUpdateDate($land_updated_date);

        $landdetails->UpdatelandDetails();
    }

   // delete land details
    if (isset($_POST['delete-land'])) {
        $land_id = $_POST['hidden-land-id'];
        echo $land_id;

       $landdetails->SetlandId($land_id);
       $landdetails->Removeland();
    }


//house order details
$orderhousedetails= new OrderedHouse;
if (isset($_POST['confirm-house-order'])) {

   $house_id=$_POST['hidden-house-id'];
   $useremail=$_POST['hidden-user-email'];
   $order_status="confirmed";

   $orderhousedetails->SethouseId($house_id);
   $orderhousedetails->SetUserEmail($useremail);
   $orderhousedetails->SetOrdereStatus($order_status);

   $orderhousedetails->UpdateHouseOrderStatus();
}

//flat order details
$orderflatdetails = new OrderedFlat;
if (isset($_POST['confirm-flat-order'])) {

    $flat_id = $_POST['hidden-flat-id'];
    $useremail = $_POST['hidden-user-email'];
    $order_status = "confirmed";

    $orderflatdetails->SetFlatId($flat_id);
    $orderflatdetails->SetUserEmail($useremail);
    $orderflatdetails->SetOrdereStatus($order_status);

    $orderflatdetails->UpdateflatOrderStatus();
}

//room order details
$orderroomdetails = new OrderedRoom;
if (isset($_POST['confirm-room-order'])) {

    $room_id = $_POST['hidden-room-id'];
    $useremail = $_POST['hidden-user-email'];
    $order_status = "confirmed";

    $orderroomdetails->SetRoomId($room_id);
    $orderroomdetails->SetUserEmail($useremail);
    $orderroomdetails->SetOrdereStatus($order_status);

    $orderroomdetails->UpdateroomOrderStatus();
}


//land order details
$orderlanddetails = new OrderedLand;
if (isset($_POST['confirm-land-order'])) {

    $land_id = $_POST['hidden-land-id'];
    $useremail = $_POST['hidden-user-email'];
    $order_status = "confirmed";

    $orderlanddetails->SetLandId($land_id);
    $orderlanddetails->SetUserEmail($useremail);
    $orderlanddetails->SetOrdereStatus($order_status);

    $orderlanddetails->UpdatelandOrderStatus();
}

?>