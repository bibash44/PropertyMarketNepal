<?php 
require("../Modal/user_modal.php");
$user= new User;

//registering a user
if(isset($_POST['user-signup'])) {

    $name=$_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone-number'];
    $security_code = $_POST['security-code'];
    $password = $_POST['password'];
    
    $user->SetName($name);
    $user->SetEmail($email);
    $user->SetPhoneNumber($phone_number);
    $user->SetSecurityCode($security_code);
    $user->SetPassword($password);

    $user->Register();

}

// user login
if (isset($_POST['user-login'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $user->SetEmail($email);
    $user->SetPassword($password);

    $user->Login();
}

//logout normal user
if (isset($_POST['user-logout'])) {
    session_destroy();
    unset($_SESSION['normaluser']);
    header("location:../View/index.php");
}
//update user profile
if(isset($_POST['update-user-button'])){
    $name= $_POST['user-full-name'];
    $security_code=$_POST['user-secuirty-code'];
    $phone_number=$_POST['user-phone-number'];
    $email=$_SESSION['normaluser'];

    $user->SetName($name);
    $user->SetSecurityCode($security_code);
    $user->SetPhoneNumber($phone_number);
    $user->SetEmail($email);

    $user->UpdateUserDetails();
}
//changing user password
if (isset($_POST['user-forgotpassword'])) {
    $email= $_POST['email'];
    $security_code=$_POST['security-code'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    $user->SetEmail($email);
    $user->SetSecurityCode($security_code);
    $user->SetPassword($password);
    $user->SetCpassword($cpassword);

    $user->ForgotPassword();
}

//unregistered user message send message 
$unregistereduser= new UnregisteredMessage;
if(isset($_POST['uru-message'])){
    date_default_timezone_set('Asia/Kathmandu');
    $message_date= date("l jS \of F Y , h:i:s A");

    $name= $_POST['name'];
    $email=$_POST['email'];
    $phone_number=$_POST['phone'];
    $message= $_POST['message'];

    $unregistereduser->SetName($name);
    $unregistereduser->SetEmail($email);
    $unregistereduser->SetPhoneNumber($phone_number);
    $unregistereduser->SetMessageDate($message_date);
    $unregistereduser->SetMessage($message);

    $unregistereduser->EnterMessage();
}
//send message by a egistered user 
$regsiteredusermessage= new UserMessage;
if(isset($_POST['ru-message'])){
    date_default_timezone_set('Asia/Kathmandu');
    $message_date = date("l jS \of F Y , h:i:s A");

    $message= $_POST['message'];
    $user_email=$_POST['user_email'];

    $regsiteredusermessage->SetMessageDate($message_date);
    $regsiteredusermessage->SetMessage($message);
    $regsiteredusermessage->SetUserEmail($user_email);

    $regsiteredusermessage->EnterMessages();
}

//favourite house details
$favouritehousedetails= new FavouriteHouse;
if (isset($_POST['add-house-to-fav'])) {
  $user_email= $_POST['hidden-user-email'];
  $house_id=$_POST['hidden-house-id'];

  $favouritehousedetails->SetUserEmail($user_email);
  $favouritehousedetails->SetHouseId($house_id);

  $favouritehousedetails->AddFavouriteHouse();
}

if (isset($_POST['remove-house'])) {
    $user_email = $_POST['hidden-user-email'];
    $house_id = $_POST['hidden-house-id'];

    $favouritehousedetails->SetUserEmail($user_email);
    $favouritehousedetails->SetHouseId($house_id);

    $favouritehousedetails->RemoveFavouriteHouse();
}

//favourite flat details
$favouriteflatdetails = new FavouriteFlat;
if (isset($_POST['add-flat-to-fav'])) {
    $user_email = $_POST['hidden-user-email'];
    $flat_id = $_POST['hidden-flat-id'];

    $favouriteflatdetails->SetUserEmail($user_email);
    $favouriteflatdetails->SetflatId($flat_id);

    $favouriteflatdetails->AddFavouriteflat();
}

if (isset($_POST['remove-flat'])) {
    $user_email = $_POST['hidden-user-email'];
    $flat_id = $_POST['hidden-flat-id'];

    $favouriteflatdetails->SetUserEmail($user_email);
    $favouriteflatdetails->SetflatId($flat_id);

    $favouriteflatdetails->RemoveFavouriteflat();
}

//favourite room details
$favouriteroomdetails = new FavouriteRoom;
if (isset($_POST['add-room-to-fav'])) {
    $user_email = $_POST['hidden-user-email'];
    $room_id = $_POST['hidden-room-id'];

    $favouriteroomdetails->SetUserEmail($user_email);
    $favouriteroomdetails->SetroomId($room_id);

    $favouriteroomdetails->AddFavouriteroom();
}

if (isset($_POST['remove-room'])) {
    $user_email = $_POST['hidden-user-email'];
    $room_id = $_POST['hidden-room-id'];

    $favouriteroomdetails->SetUserEmail($user_email);
    $favouriteroomdetails->SetroomId($room_id);

    $favouriteroomdetails->RemoveFavouriteroom();
}

//favourite land details
$favouritelanddetails = new FavouriteLand;
if (isset($_POST['add-land-to-fav'])) {
    $user_email = $_POST['hidden-user-email'];
    $land_id = $_POST['hidden-land-id'];

    $favouritelanddetails->SetUserEmail($user_email);
    $favouritelanddetails->SetlandId($land_id);

    $favouritelanddetails->AddFavouriteland();
}
if (isset($_POST['remove-land'])) {
    $user_email = $_POST['hidden-user-email'];
    $land_id = $_POST['hidden-land-id'];

    $favouritelanddetails->SetUserEmail($user_email);
    $favouritelanddetails->SetlandId($land_id);

    $favouritelanddetails->RemoveFavouriteland();
}
//ordered house details
$orderedhouse= new OrderedHouse;
if (isset($_POST['place-house-order'])) {

    $house_id = $_POST['hidden-house-id'];
    $order_status = "Not confirmed";
    $user_email = $_POST['hidden-user-email'];

    $orderedhouse->SethouseId($house_id);
    $orderedhouse->SetOrdereStatus($order_status);
    $orderedhouse->SetUserEmail($user_email);

    $orderedhouse->AddToOrderedhouse();
}

if (isset($_POST['remove-house-order'])) {
    $house_id = $_POST['hidden-house-id'];
    $user_email = $_POST['hidden-user-email'];

    $orderedhouse->SethouseId($house_id);
    $orderedhouse->SetUserEmail($user_email);

    $orderedhouse->RemoveOrderedHouse();
}
//ordered flat details
$orderedflat = new OrderedFlat;
if (isset($_POST['place-flat-order'])) {
    $flat_id = $_POST['hidden-flat-id'];
    $order_status = "Not confirmed";
    $user_email = $_POST['hidden-user-email'];

    $orderedflat->SetFlatId($flat_id);
    $orderedflat->SetOrdereStatus($order_status);
    $orderedflat->SetUserEmail($user_email);

    $orderedflat->AddToOrderedFlat();
}
if (isset($_POST['remove-flat-order'])) {
    $flat_id = $_POST['hidden-flat-id'];
    $user_email = $_POST['hidden-user-email'];

    $orderedflat->SetflatId($flat_id);
    $orderedflat->SetUserEmail($user_email);

    $orderedflat->RemoveOrderedflat();

}

//ordered room details
$orderedroom = new OrderedRoom;
if (isset($_POST['place-room-order'])) {
    $room_id = $_POST['hidden-room-id'];
    $order_status = "Not confirmed";
    $user_email = $_POST['hidden-user-email'];

    $orderedroom->SetRoomId($room_id);
    $orderedroom->SetOrdereStatus($order_status);
    $orderedroom->SetUserEmail($user_email);

    $orderedroom->AddToOrderedRoom();
}
if (isset($_POST['remove-room-order'])) {
    $room_id = $_POST['hidden-room-id'];
    $user_email = $_POST['hidden-user-email'];

    $orderedroom->SetroomId($room_id);
    $orderedroom->SetUserEmail($user_email);

    $orderedroom->RemoveOreredRoom();
}
    // ordered land details
    $orderedland = new Orderedland;
    if (isset($_POST['place-land-order'])) {
    $land_id = $_POST['hidden-land-id'];
    $order_status = "Not confirmed";
    $user_email = $_POST['hidden-user-email'];

    $orderedland->SetlandId($land_id);
    $orderedland->SetOrdereStatus($order_status);
    $orderedland->SetUserEmail($user_email);

    $orderedland->AddToOrderedland();
}
    if (isset($_POST['remove-land-order'])) {
    $land_id = $_POST['hidden-land-id'];
    $user_email = $_POST['hidden-user-email'];

    $orderedland->SetlandId($land_id);
    $orderedland->SetUserEmail($user_email);

    $orderedland->RemoveOreredLand();
}
//comment ddetails
$commentdetails= new Comment;
//add comment in house
if (isset($_POST['add-comment-in-house-button'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $comment_date= date("l jS \of F Y , h:i:s A");

   $property_id = $_POST['commented-house-id'];
   $comment = $_POST['add-house-comment'];
   $useremail = $_POST['user-who-commented'];
   $username= $_POST['user-name']; 

   $commentdetails->SetPropertyId($property_id);
   $commentdetails->SetSetUsername($username);
   $commentdetails->SetComment($comment);
   $commentdetails->SetCommentDate($comment_date);
   $commentdetails->SetUserEmail($useremail);

   $commentdetails->PostHouseComment();
}
    //add comment in flat
    if (isset($_POST['add-comment-in-flat-button'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $comment_date = date("l jS \of F Y , h:i:s A");

    $property_id = $_POST['commented-flat-id'];
    $comment = $_POST['add-flat-comment'];
    $useremail = $_POST['user-who-commented'];
    $username = $_POST['user-name'];

    $commentdetails->SetPropertyId($property_id);
    $commentdetails->SetSetUsername($username);
    $commentdetails->SetComment($comment);
    $commentdetails->SetCommentDate($comment_date);
    $commentdetails->SetUserEmail($useremail);

    $commentdetails->PostFlatComment();
}
    //add comment in room
    if (isset($_POST['add-comment-in-room-button'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $comment_date = date("l jS \of F Y , h:i:s A");

    $property_id = $_POST['commented-room-id'];
    $comment = $_POST['add-room-comment'];
    $useremail = $_POST['user-who-commented'];
    $username = $_POST['user-name'];

    $commentdetails->SetPropertyId($property_id);
    $commentdetails->SetSetUsername($username);
    $commentdetails->SetComment($comment);
    $commentdetails->SetCommentDate($comment_date);
    $commentdetails->SetUserEmail($useremail);

    $commentdetails->PostRoomComment();
}

//add comment in land
if (isset($_POST['add-comment-in-land-button'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $comment_date = date("l jS \of F Y , h:i:s A");

    $property_id = $_POST['commented-land-id'];
    $comment = $_POST['add-land-comment'];
    $useremail = $_POST['user-who-commented'];
    $username = $_POST['user-name'];

    $commentdetails->SetPropertyId($property_id);
    $commentdetails->SetSetUsername($username);
    $commentdetails->SetComment($comment);
    $commentdetails->SetCommentDate($comment_date);
    $commentdetails->SetUserEmail($useremail);

    $commentdetails->PostLandComment();
}

// search property
$_SESSION['search-property-keyword']="";
$_SESSION['search-property-category'] = "";

if (isset($_POST['search-property-button'])) {
    $property_catrgory = $_POST['property-category'];
    $searchkeyword = $_POST['search-property-keyword'];

    $_SESSION['search-property-keyword']=$searchkeyword;
    $_SESSION['search-property-category'] = $property_catrgory;
    
    header("location:../View/NormalUserPages/user_search_property_details.php");
}
?>