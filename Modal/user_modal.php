<?php 
session_start();
require("database_connection.php");

class User extends DatabaseConnection{
private $name;
private $email;
private $phone_number;
private $security_code;
private $password;
private $cpassword;
private $usertype="normal";

public function SetName($name1){
$this->name= $name1;
}

public function SetEmail($email1){
$this->email= $email1;
}

public function SetPhoneNumber($phone_number1){
$this->phone_number=$phone_number1;
}

public function SetSecurityCode($security_code1){
$this->security_code=$security_code1;
}

public function SetPassword($password1)
{
$this->password=$password1;
}

public function SetCpassword($cpassword1){
$this->cpassword=$cpassword1;
}

public function Register(){

        $query = "select * from user where email='$this->email'";

        $result= mysqli_query($this->connection, $query);
        $count=mysqli_num_rows($result);

        if($count>=1){
        $_SESSION['userexist']="useralreadyexist";
         header("location:../View/index.php");
        }
        else{
            $query= "insert into user(email,name,phone_number,security_code,password,user_type)
            values('$this->email', '$this->name', '$this->phone_number','$this->security_code',
            '$this->password','$this->usertype')";
            mysqli_query($this->connection, $query);
            
         $_SESSION['userregistered']="user_is_registered";
         header("location:../View/index.php");
        }
}

    public function Login(){
    $query="select * from user where email='$this->email' && password='$this->password'";
    $result=mysqli_query($this->connection, $query);

    $count= mysqli_num_rows($result);

    if($count>0){
        $data= mysqli_fetch_array($result);

        $usertype= $data['user_type'];

        if ($usertype=="normal") {
           $_SESSION['normaluser']=$this->email;
           header("location:../View/NormalUserPages/index_user_page.php");
        }
        
        else{
           
            $_SESSION['adminuser']=$this->email;
           header("location:../View/AdminPages/admin_index_page.php");
        }

    }

    else{
       
        $_SESSION['errorlogin']="login_failed";
        header("location:../View/index.php");
    }
}

public function SelectSpecificUserDetails(){
    $query= "select * from user where email='$this->email'";
    $result=mysqli_query($this->connection, $query);
    return $result;

}
 public function SelectUserDetails()
 {
    $query = "select * from user where email not in('admin@gmail.com')";
    $result = mysqli_query($this->connection, $query);
     return $result;

 }
 public function UpdateUserDetails(){
     $query="update user set name='$this->name',phone_number='$this->phone_number',
     security_code='$this->security_code' 
     where email='$this->email'";
     $result= mysqli_query($this->connection, $query);
      echo $query;
     $_SESSION['userupdated']="user_details_updated";
     header("location:../View/NormalUserPages/index_user_page.php");
 }

 public function ForgotPassword(){
     $query="select * from user where email='$this->email' and
      security_code='$this->security_code'";
     $result= mysqli_query($this->connection, $query);

     $count= mysqli_num_rows($result);

     if($count>0){
       if($this->password==$this->cpassword){
           $updatequery="update user set password='$this->password' where email='$this->email'";
           mysqli_query($this->connection, $updatequery);
           echo $query;
           $_SESSION['passwordupdated']="new_password_updated";
           header("location:../View/ForgotPassword.php");
       }
       else{
           $_SESSION['passwordnotmatched']="password_not_matched";
           header("location:../View/ForgotPassword.php");
       }
    }
       else{
                $_SESSION['invalidsecuritycode'] = "not_a_valid_code";
               header("location:../View/ForgotPassword.php");
       }
     }
 }



   //unregisyered user messages class
 class UnregisteredMessage extends DatabaseConnection
{
     private $message_id;
     private $message;
     private $message_date;
     private $name;
     private $phone_number;
     private $email;

    public function SetMessageId($message_id1)
    {
        $this->message_id = $message_id1;
    }

    public function SetMessage($message1)
    {
        $this->message = $message1;
    }

    public function SetMessageDate($message_date1)
    {
        $this->message_date = $message_date1;
    }

     public function SetName($name1)
     {
     $this->name= $name1;
     }

    public function SetPhoneNumber($phone_number1)
    {
        $this->phone_number = $phone_number1;
    }

    public function SetEmail($email1)
    {
        $this->email = $email1;
    }

    public function EnterMessage(){
        $query = "insert into unregistered_user_message
        (message_id, username, useremail, userphone, message,message_date)
        values ('NULL', '$this->name', '$this->email','$this->phone_number', 
       '$this->message','$this->message_date')";
        mysqli_query($this->connection, $query);
    }

    public function SelectUrUserMessages(){
        $query= "select * from unregistered_user_message order by message_date desc";
        $result=mysqli_query($this->connection, $query);
        return $result;
    }
 }
 
 // registered user messages class
 class UserMessage extends DatabaseConnection{
     private $message_id;
     private $message;
     private $message_date;
     private $user_email;
    
    public function SetMessageID($message_id1)
    {
    $this->message_id= $message_id1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->user_email = $user_email1;
    }

    public function SetMessageDate($message_date1)
    {
        $this->message_date = $message_date1;
    }

    public function SetMessage($message1)
    {
        $this->message = $message1;
    }


    public function EnterMessages(){
        $query= "insert into user_message(message_id,message_date,message,useremail)
        values('NULL','$this->message_date', '$this->message', '$this->user_email') ";

        mysqli_query($this->connection, $query);
    }

    public function SelectUserMessages(){
        $query= "select u.email, u.name, u.phone_number,
         m.message, m.message_date
         from user_message m left join user u
         on u.email= m.useremail order by m.message_date desc";

         $result=mysqli_query($this->connection, $query);
         return $result;
    }
 }

    // admin message to user
    class AdminMessage extends DatabaseConnection{
    
    private $message_id;
    private $message_date;
    private $message;
    private $user_email;

    public function SetMessageID($message_id1)
    {
        $this->message_id= $message_id1;

    }

    public function SetMessageDate($message_date1)
    {
        $this->message_date = $message_date1;

    }

    public function SetMessage($message1)
    {
        $this->message = $message1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->user_email = $user_email1;

    }

    public function EnterAdminMessages(){

        $query="insert into admin_message(message_id, message, message_date, useremail)
        values('NULL','$this->message','$this->message_date','$this->user_email')";

        mysqli_query($this->connection, $query);
        $_SESSION['messagesenttouser']="message_sent_to_user";
        header("location:../View/AdminPages/admin_index_page.php");
    }

    public function SelectAdminMessages(){
        $query="select * from admin_message where useremail='$this->user_email'";

        $result= mysqli_query($this->connection, $query);
        return $result;
    }
}

    class BestSellingProperty extends DatabaseConnection{
    private $property_id;
    private $property_name;
    private $property_updated_date;
    private $image_path;

    public function SetPropertyId($property_id1)
    {
        $this->property_id=$property_id1;
    }

    public function SetPropertyName($property_name1)
    {
        $this->property_name = $property_name1;
    }

    public function SetPropertyUpdatedDate($property_updated_date1)
    {
        $this->property_updated_date = $property_updated_date1;
    }

    public function SetImagePath($image_path1)
    {
        $this->image_path = $image_path1;
    }


    public function CheckProperty(){
        $query1 = "select * from best_selling_property
         where property_id='$this->property_id'";
        $result = mysqli_query($this->connection, $query1);
        $count = mysqli_num_rows($result);
       return $count;
    }

    public function UploadBestSellingProperty(){
        $query2= "insert into best_selling_property (property_id, 
        property_name, property_updated_date, image_path)
        values('$this->property_id', '$this->property_name', 
        '$this->property_updated_date','$this->image_path')";

        mysqli_query($this->connection,$query2);
        $_SESSION['bestpropertyuploaded']="property_uploaded";
        header("location:../View/AdminPages/admin_best_selling_property.php");
    }

    public function SelectPropertyDetails(){
        $query= "select * from best_selling_property order by property_id desc";
        $result= mysqli_query($this->connection, $query);
        return $result;
    
    }

    public function RemoveProperty(){
        $query= "delete from best_selling_property where 
        property_id='$this->property_id'";
        mysqli_query($this->connection, $query);
        $_SESSION['bestpropertydeleted']="best_property_deleted";
        header("location:../View/AdminPages/admin_best_selling_property.php");
    }
}

//house details class
class House extends DatabaseConnection{
    private $house_id;
    private $house_location;
    private $no_of_flat;
    private $no_of_room;
    private $house_price;
    private $image_path;
    private $house_description;
    private $discount_amount;
    private $house_updated_date;

    private $search_house_keyword;

    public function SetHouseId($house_id1)
    {
        $this->house_id=$house_id1;
    }

    public function SetHouseLocation($house_location1)
    {
        $this->house_location = $house_location1;
    }

    public function SetNoOfFlat($no_of_flat1)
    {
        $this->no_of_flat= $no_of_flat1;
    }

    public function SetNoOfRoom($no_of_room1)
    {
        $this->no_of_room = $no_of_room1;
    }

    public function SetHousePrice($house_price1)
    {
        $this->house_price= $house_price1;
    }

    public function SetImagePath($image_path1)
    {
        $this->image_path = $image_path1;
    }
    public function SetHouseDescription($house_description1)
    {
        $this->house_description = $house_description1;
    }

    public function SetDiscountAmount($discount_amount1)
    {
        $this->discount_amount = $discount_amount1;
    }

   public function SetHouseUpdateDate($house_updated_date1)
    {
     $this->house_updated_date = $house_updated_date1;
    }

    public function SetSearchHouseKeyWord($search_house_keyword1){
       $this->search_house_keyword= $search_house_keyword1;
    }

    public function CheckProperty(){
        $query="select * from house where house_id='$this->house_id'";
        $result=mysqli_query($this->connection, $query);
        $count=mysqli_num_rows($result);
        return $count;
    }
    public function UploadHouse(){
        $query= "insert into house (house_id , house_location, no_of_flat,
        house_price,no_of_room,image_path,house_description,discount_amount,
        house_updated_date) values('$this->house_id','$this->house_location',
        '$this->no_of_flat','$this->house_price','$this->no_of_room',
        '$this->image_path','$this->house_description','$this->discount_amount',
        '$this->house_updated_date')";

        mysqli_query($this->connection, $query);
        $_SESSION['houseuploaded']="house_uploaded";
        header("location:../View/AdminPages/admin_house_details_page.php");

    }

    public function SelectHouseDetails(){
        $query="select * from house";
        $result=mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveHouse(){
        $query="delete from house where house_id='$this->house_id'";
        mysqli_query($this->connection, $query);

        $_SESSION['selectedhouseremoved']="selected_house_removed";
        header("location:../View/AdminPages/admin_house_details_page.php");
    }
   public function UpdateHouseDetails(){
       $query= "update house set no_of_flat='$this->no_of_flat',house_price='$this->house_price' ,
       no_of_room='$this->no_of_room', house_description='$this->house_description' ,
       discount_amount='$this->discount_amount', house_updated_date='$this->house_updated_date'
       where house_id='$this->house_id'";
        mysqli_query($this->connection, $query);

       $_SESSION['selectedhouseupdated']="selected_house_updated";
       header("location:../View/AdminPages/admin_house_details_page.php");
   }

   public function SearchHouse(){
     $query = "SELECT * FROM house WHERE CONCAT(house_id, house_price, house_location) 
     LIKE  '%".$this->search_house_keyword."%'";
     $result=mysqli_query($this->connection, $query);
     return $result;
   }

}

//flat details class
class Flat extends DatabaseConnection
{
    private $flat_id;
    private $flat_location;
    private $no_of_room;
    private $flat_price;
    private $image_path;
    private $flat_description;
    private $discount_amount;
    private $flat_updated_date;

    private $search_flat_keyword;
  
    public function SetflatId($flat_id1)
    {
        $this->flat_id = $flat_id1;
    }

    public function SetflatLocation($flat_location1)
    {
        $this->flat_location = $flat_location1;
    }

    public function SetNoOfRoom($no_of_room1)
    {
        $this->no_of_room = $no_of_room1;
    }

    public function SetflatPrice($flat_price1)
    {
        $this->flat_price = $flat_price1;
    }

    public function SetImagePath($image_path1)
    {
        $this->image_path = $image_path1;
    }
    public function SetflatDescription($flat_description1)
    {
        $this->flat_description = $flat_description1;
    }

    public function SetDiscountAmount($discount_amount1)
    {
        $this->discount_amount = $discount_amount1;
    }

    public function SetflatUpdateDate($flat_updated_date1)
    {
        $this->flat_updated_date = $flat_updated_date1;
    }

    public function SetSearchFlatKeyWord($search_flat_keyword1)
    {
        $this->search_flat_keyword = $search_flat_keyword1;
    }

    public function CheckProperty()
    {
       $query="select * from flat where flat_id='$this->flat_id'";
       $result= mysqli_query($this->connection, $query);
       $count = mysqli_num_rows($result);
       return $count;
    }

    public function UploadFlat()
    {
        $query = "insert into flat (flat_id , flat_location,
        flat_price, no_of_room, image_path, flat_description,
        discount_amount, flat_updated_date) values('$this->flat_id',
        '$this->flat_location','$this->flat_price','$this->no_of_room',
        '$this->image_path','$this->flat_description','$this->discount_amount',
        '$this->flat_updated_date')";

        mysqli_query($this->connection, $query);
       $_SESSION['flatuploaded'] = "flat_uploaded";
       header("location:../View/AdminPages/admin_flat_details_page.php");
    
    }

    public function SelectFlatDetails()
    {
        $query = "select * from flat";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveFlat()
    {
        $query = "delete from flat where flat_id='$this->flat_id'";
        mysqli_query($this->connection, $query);

        $_SESSION['selectedflatremoved'] = "selected_flat_removed";
        header("location:../View/AdminPages/admin_flat_details_page.php");
    }
    public function UpdateFlatDetails()
    {
        $query = "update flat set no_of_room='$this->no_of_room',
       flat_price='$this->flat_price', discount_amount='$this->discount_amount',
       flat_description='$this->flat_description', flat_updated_date='$this->flat_updated_date'
       where flat_id='$this->flat_id'";

        mysqli_query($this->connection, $query);

        $_SESSION['selectedflatupdated'] = "selected_flat_updated";
        header("location:../View/AdminPages/admin_flat_details_page.php");
    }

    public function SearchFlat()
    {
        $query = "SELECT * FROM flat WHERE CONCAT(flat_id, flat_price, flat_location) 
        LIKE  '%".$this->search_flat_keyword."%'";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

//room details class
class Room extends DatabaseConnection
{
    private $room_id;
    private $room_location;
    private $room_area;
    private $room_price;
    private $image_path;
    private $room_description;
    private $discount_amount;
    private $room_updated_date;

    private $search_room_keyword;

    public function SetroomId($room_id1)
    {
        $this->room_id = $room_id1;
    }

    public function SetroomLocation($room_location1)
    {
        $this->room_location = $room_location1;
    }

    public function SetRoomArea($room_area1)
    {
        $this->room_area = $room_area1;
    }

    public function SetroomPrice($room_price1)
    {
        $this->room_price = $room_price1;
    }

    public function SetImagePath($image_path1)
    {
        $this->image_path = $image_path1;
    }
    public function SetroomDescription($room_description1)
    {
        $this->room_description = $room_description1;
    }

    public function SetDiscountAmount($discount_amount1)
    {
        $this->discount_amount = $discount_amount1;
    }

    public function SetroomUpdateDate($room_updated_date1)
    {
        $this->room_updated_date = $room_updated_date1;
    }


    public function SetSearchRoomKeyWord($search_room_keyword1)
    {
        $this->search_room_keyword = $search_room_keyword1;
    }

    public function CheckProperty()
    {
        $query = "select * from room where room_id='$this->room_id'";
        $result = mysqli_query($this->connection, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function Uploadroom()
    {
        $query = "insert into room (room_id , room_location, room_price,
        room_area, image_path, room_description, discount_amount,
        room_updated_date) values('$this->room_id','$this->room_location',
        '$this->room_price','$this->room_area','$this->image_path',
        '$this->room_description','$this->discount_amount','$this->room_updated_date')";

        mysqli_query($this->connection, $query);
        $_SESSION['roomuploaded'] = "room_uploaded";
        header("location:../View/AdminPages/admin_room_details_page.php");
    }

    public function SelectroomDetails()
    {
        $query = "select * from room";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function Removeroom()
    {
        $query = "delete from room where room_id='$this->room_id'";
        mysqli_query($this->connection, $query);

        $_SESSION['selectedroomremoved'] = "selected_room_removed";
        header("location:../View/AdminPages/admin_room_details_page.php");
    }

    public function UpdateroomDetails()
    {
        $query = "update room set room_price='$this->room_price', 
        discount_amount='$this->discount_amount',
       room_description='$this->room_description', 
       room_updated_date='$this->room_updated_date'
       where room_id='$this->room_id'";

        mysqli_query($this->connection, $query);

        $_SESSION['selectedroomupdated'] = "selected_room_updated";
        header("location:../View/AdminPages/admin_room_details_page.php");

    }


    public function SearchRoom()
    {
        $query = "SELECT * FROM room WHERE CONCAT(room_id, room_price, room_location) 
        LIKE  '%".$this->search_room_keyword."%'";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

//land details class
class Land extends DatabaseConnection
{
    private $land_id;
    private $land_location;
    private $land_area;
    private $land_price;
    private $image_path;
    private $land_description;
    private $discount_amount;
    private $land_updated_date;

    private $search_land_keyword;

    public function SetlandId($land_id1)
    {
        $this->land_id = $land_id1;
    }

    public function SetlandLocation($land_location1)
    {
        $this->land_location = $land_location1;
    }

    public function SetlandArea($land_area1)
    {
        $this->land_area = $land_area1;
    }

    public function SetlandPrice($land_price1)
    {
        $this->land_price = $land_price1;
    }

    public function SetImagePath($image_path1)
    {
        $this->image_path = $image_path1;
    }
    public function SetlandDescription($land_description1)
    {
        $this->land_description = $land_description1;
    }

    public function SetDiscountAmount($discount_amount1)
    {
        $this->discount_amount = $discount_amount1;
    }

    public function SetlandUpdateDate($land_updated_date1)
    {
        $this->land_updated_date = $land_updated_date1;
    }

    public function SetSearchLandKeyWord($search_land_keyword1)
    {
        $this->search_land_keyword = $search_land_keyword1;
    }

    public function CheckProperty()
    {
        $query = "select * from land where land_id='$this->land_id'";
        $result = mysqli_query($this->connection, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function Uploadland()
    {
        $query = "insert into land (land_id , land_location,
        land_price, land_area, image_path, land_description,
        discount_amount, land_updated_date)
        values('$this->land_id','$this->land_location','
        $this->land_price','$this->land_area','$this->image_path',
       '$this->land_description','$this->discount_amount',
       '$this->land_updated_date')";

        mysqli_query($this->connection, $query);
        $_SESSION['landuploaded'] = "land_uploaded";
        header("location:../View/AdminPages/admin_land_details_page.php");
    }

    public function SelectlandDetails()
    {
        $query = "select * from land";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function Removeland()
    {
        $query = "delete from land where land_id='$this->land_id'";
        mysqli_query($this->connection, $query);

        $_SESSION['selectedlandremoved'] = "selected_land_removed";
        header("location:../View/AdminPages/admin_land_details_page.php");
    }
    public function UpdatelandDetails()
    {
       $query = "update land set land_price='$this->land_price',
       discount_amount='$this->discount_amount',
       land_description='$this->land_description', 
       land_updated_date='$this->land_updated_date'
       where land_id='$this->land_id'";

        mysqli_query($this->connection, $query);

        $_SESSION['selectedlandupdated'] = "selected_land_updated";
        header("location:../View/AdminPages/admin_land_details_page.php");

    }

    public function SearchLand()
    {
        $query = "SELECT * FROM land WHERE CONCAT(land_id, land_price, land_location) 
        LIKE  '%".$this->search_land_keyword ."%'";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
}

    //favourite house details
    class FavouriteHouse extends DatabaseConnection{
    private $house_id;
    private $useremail;

    public function SetHouseId($house_id1){
        $this->house_id= $house_id1;
    }
    public function SetUserEmail($user_email1){
        $this->useremail=$user_email1;
    }

    public function AddFavouriteHouse(){    

        $query= "select * from favourite_house
        where useremail='$this->useremail' 
        && house_id='$this->house_id'";

         $result= mysqli_query($this->connection,$query);
         $countfavhouse= mysqli_num_rows($result);

         if($countfavhouse>0){
           $_SESSION['housealreadyaddedtofavourite'] = "house_already_added_to_favourite";
            header("location:../View/NormalUserPages/user_house_details.php");
         }
         else{
        $query2= "insert into favourite_house (useremail, house_id)
        values('$this->useremail', '$this->house_id')";

        mysqli_query($this->connection, $query2);
        $_SESSION['houseaddedtofavourite']="house_added_to_favourite";
        header("location:../View/NormalUserPages/user_house_details.php");
         }
    }

    public function SelectSpecificFavHouse(){
        $query= "select fh.house_id, fh.useremail,
        h.house_location, h.house_price, h.house_description 
        from favourite_house fh left join house h
        on fh.house_id= h.house_id
        where fh.useremail='$this->useremail'";

        $result= mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveFavouriteHouse(){
        $query= "delete from favourite_house where 
        useremail='$this->useremail' && house_id='$this->house_id'";

        mysqli_query($this->connection, $query);

      $_SESSION['favhouseremoved']="fav_house_removed";
      header("location:../View/NormalUserPages/user_favourite_property.php");
    }
}


    //favourite flat details
    class FavouriteFlat extends DatabaseConnection{
    private $flat_id;
    private $useremail;

    public function SetflatId($flat_id1)
    {
        $this->flat_id = $flat_id1;
    }
    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddFavouriteflat(){
        $query = "select * from favourite_flat
         where useremail='$this->useremail' 
         && flat_id='$this->flat_id'";

        $result = mysqli_query($this->connection, $query);
        $countfavflat = mysqli_num_rows($result);

        if ($countfavflat > 0) {
          $_SESSION['flatalreadyaddedtofavourite'] = "flat_already_added_to_favourite";
           header("location:../View/NormalUserPages/user_flat_details.php");
        } 
        else {
            $query2 = "insert into favourite_flat (useremail, flat_id)
            values('$this->useremail', '$this->flat_id')";

            mysqli_query($this->connection, $query2);
            $_SESSION['flataddedtofavourite'] = "flat_added_to_favourite";
            header("location:../View/NormalUserPages/user_flat_details.php");
         }
 }

    public function SelectSpecificFavFlat()
    {
        $query = "select ff.flat_id, ff.useremail,
        f.flat_location, f.flat_price, f.flat_description 
        from favourite_flat ff left join flat f
        on ff.flat_id= f.flat_id
        where ff.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveFavouriteflat()
    {
        $query = "delete from favourite_flat where 
        useremail='$this->useremail' && flat_id='$this->flat_id'";

        mysqli_query($this->connection, $query);
        $_SESSION['favflatremoved'] = "fav_flat_removed";
        header("location:../View/NormalUserPages/user_favourite_property.php");
    }
}

    //favourite room details
    class FavouriteRoom extends DatabaseConnection{
    private $room_id;
    private $useremail;

    public function SetroomId($room_id1)
    {
        $this->room_id = $room_id1;
    }
    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddFavouriteroom() {
        $query = "select * from favourite_room
         where useremail='$this->useremail' 
         && room_id='$this->room_id'";

        $result = mysqli_query($this->connection, $query);
        $countfavroom = mysqli_num_rows($result);

        if ($countfavroom > 0) {
            $_SESSION['roomalreadyaddedtofavourite'] = "room_already_added_to_favourite";
            header("location:../View/NormalUserPages/user_room_details.php");
        } else {
            $query2 = "insert into favourite_room (useremail, room_id)
            values('$this->useremail', '$this->room_id')";

            mysqli_query($this->connection, $query2);
            $_SESSION['roomaddedtofavourite'] = "room_added_to_favourite";
            header("location:../View/NormalUserPages/user_room_details.php");
        }
    }

    public function SelectSpecificFavRoom()
    {
        $query = "select fr.room_id, fr.useremail,
        r.room_location, r.room_price, r.room_description 
        from favourite_room fr left join room r
        on fr.room_id= r.room_id
        where fr.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveFavouriteroom()
    {
        $query = "delete from favourite_room where 
        useremail='$this->useremail' && room_id='$this->room_id'";

        mysqli_query($this->connection, $query);
        $_SESSION['favroomremoved'] = "fav_room_removed";
        header("location:../View/NormalUserPages/user_favourite_property.php");
    }
}

    //favourite land details
    class FavouriteLand extends DatabaseConnection{
    private $land_id;
    private $useremail;

    public function SetlandId($land_id1)
    {
        $this->land_id = $land_id1;
    }
    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddFavouriteland() {
    $query = "select * from favourite_land
    where useremail='$this->useremail' 
    && land_id='$this->land_id'";

    $result = mysqli_query($this->connection, $query);
    $countfavland = mysqli_num_rows($result);

    if ($countfavland > 0) {
    $_SESSION['landalreadyaddedtofavourite'] = "land_already_added_to_favourite";
    header("location:../View/NormalUserPages/user_land_details.php");
    } else {
    $query2 = "insert into favourite_land (useremail, land_id)
    values('$this->useremail', '$this->land_id')";

    mysqli_query($this->connection, $query2);
    $_SESSION['landaddedtofavourite'] = "land_added_to_favourite";
    header("location:../View/NormalUserPages/user_land_details.php");
        }
    }
    public function SelectSpecificFavLand()
    {
        $query = "select fl.land_id, fl.useremail,
        l.land_location, l.land_price, l.land_description 
        from favourite_land fl left join land l
        on fl.land_id= l.land_id
        where fl.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveFavouriteland()
    {
        $query = "delete from favourite_land where 
        useremail='$this->useremail' && land_id='$this->land_id'";

        mysqli_query($this->connection, $query);

        $_SESSION['favlandremoved'] = "fav_land_removed";
        header("location:../View/NormalUserPages/user_favourite_property.php");
    }

}

    //ordered house details
    class OrderedHouse extends DatabaseConnection{
    private $house_id;
    private $order_status;
    private $useremail;

    public function SethouseId($house_id1)
    {
        $this->house_id = $house_id1;
    }

    public function SetOrdereStatus($order_status1)
    {
        $this->order_status = $order_status1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddToOrderedhouse(){
        $query = "select * from ordered_house
        where useremail='$this->useremail' 
        && house_id='$this->house_id'";

        $result = mysqli_query($this->connection, $query);
        $count_own_ordered_house = mysqli_num_rows($result);

        $query2 = "select * from ordered_house
         where house_id='$this->house_id'";

         $result2= mysqli_query($this->connection, $query2);
         $count_other_ordered_house=mysqli_num_rows($result2);

        if ($count_own_ordered_house > 0) {
            $_SESSION['housealreadyaddedtoordered'] = "house_already_added_to_ordered";
            header("location:../View/NormalUserPages/user_house_details.php");
        } 
        
        elseif ($count_other_ordered_house > 0) {
            $_SESSION['someonealreadyorderedhouse'] = "someone_already_ordered_house";
             header("location:../View/NormalUserPages/user_house_details.php");

        }
        else {
            $query3 = "insert into ordered_house (house_id, order_status, useremail)
            values('$this->house_id', '$this->order_status' , '$this->useremail')";

            echo $query3;
          mysqli_query($this->connection, $query3);
         $_SESSION['houseaddedtoordered'] = "house_added_to_ordered";
         header("location:../View/NormalUserPages/user_house_details.php");
        }
    }

    public function SelectSpecificOrderedHouse()
    {
        $query = "select oh.house_id, oh.useremail, oh.order_status,
        h.house_location, h.house_price, h.house_description 
        from ordered_house oh left join house h
        on oh.house_id= h.house_id
        where oh.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveOrderedHouse()
    {
        $query = "delete from ordered_house where 
        useremail='$this->useremail' 
        && house_id='$this->house_id'";

        mysqli_query($this->connection, $query);
        $_SESSION['orderedhouseremoved'] = "ordered_house_removed";
        header("location:../View/NormalUserPages/user_ordered_property.php");
    }

    public function SelectAllOrderedHouse()
    {
        $query = "select oh.house_id, oh.useremail, oh.order_status,
        h.house_location, h.house_price, h.house_description 
        from ordered_house oh left join house h
        on oh.house_id= h.house_id";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function UpdateHouseOrderStatus(){
        $query="update ordered_house set 
        order_status='$this->order_status'
        where house_id='$this->house_id'
        && useremail='$this->useremail'";

      mysqli_query($this->connection, $query);
      $_SESSION['houseorderconfirmed'] = "house_order_confirmed";
      header("location:../View/AdminPages/admin_ordered_property.php");

    }
}

//ordered flat details
class OrderedFlat extends DatabaseConnection
{
    private $flat_id;
    private $order_status;
    private $useremail;

    public function SetFlatId($flat_id1)
    {
        $this->flat_id = $flat_id1;
    }

    public function SetOrdereStatus($order_status1)
    {
        $this->order_status = $order_status1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddToOrderedFlat() {
        $query = "select * from ordered_flat
        where useremail='$this->useremail'
        && flat_id='$this->flat_id'";

        $result = mysqli_query($this->connection, $query);
        $count_own_ordered_flat = mysqli_num_rows($result);

        $query2 = "select * from ordered_flat
         where flat_id='$this->flat_id'";

        $result2 = mysqli_query($this->connection, $query2);
        $count_other_ordered_flat = mysqli_num_rows($result2);

        if ($count_own_ordered_flat > 0) {
            $_SESSION['flatalreadyaddedtoordered'] = "flat_already_added_to_ordered";
            header("location:../View/NormalUserPages/user_flat_details.php");
        } elseif ($count_other_ordered_flat > 0) {
            $_SESSION['someonealreadyorderedflat'] = "someone_already_ordered_flat";
            header("location:../View/NormalUserPages/user_flat_details.php");

        } else {
            $query3 = "insert into ordered_flat (flat_id, order_status, useremail)
            values('$this->flat_id', '$this->order_status' , '$this->useremail')";

            echo $query3;
            mysqli_query($this->connection, $query3);
            $_SESSION['flataddedtoordered'] = "flat_added_to_ordered";
            header("location:../View/NormalUserPages/user_flat_details.php");
        }

    }

    public function SelectSpecificOrderedFlat(){
        $query = "select of.flat_id, of.useremail, of.order_status,
        f.flat_location, f.flat_price, f.flat_description
        from ordered_flat of left join flat f
        on of.flat_id= f.flat_id
        where of.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function SelectAllOrderedFlat(){
        $query = "select of.flat_id, of.useremail, of.order_status,
        f.flat_location, f.flat_price, f.flat_description 
        from ordered_flat of left join flat f
        on of.flat_id= f.flat_id";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveOrderedFlat(){
        $query = "delete from ordered_flat where
        useremail='$this->useremail' && flat_id='$this->flat_id'";

        mysqli_query($this->connection, $query);
        $_SESSION['orderedflatremoved'] = "ordered_flat_removed";
        header("location:../View/NormalUserPages/user_ordered_property.php");
    }

    public function UpdateFlatOrderStatus()
    {
        $query = "update ordered_flat set
        order_status='$this->order_status'
        where flat_id='$this->flat_id' 
        && useremail='$this->useremail'";

        mysqli_query($this->connection, $query);
        $_SESSION['flatorderconfirmed'] = "flat_order_confirmed";
        header("location:../View/AdminPages/admin_ordered_property.php");
    }
}

//ordered room details
class OrderedRoom extends DatabaseConnection
{
    private $room_id;
    private $order_status;
    private $useremail;

    public function SetRoomId($room_id1)
    {
        $this->room_id = $room_id1;
    }

    public function SetOrdereStatus($order_status1)
    {
        $this->order_status = $order_status1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddToOrderedRoom(){
        $query = "select * from ordered_room
        where useremail='$this->useremail' 
        && room_id='$this->room_id'";

        $result = mysqli_query($this->connection, $query);
        $count_own_ordered_room = mysqli_num_rows($result);

        $query2 = "select * from ordered_room
         where room_id='$this->room_id'";

        $result2 = mysqli_query($this->connection, $query2);
        $count_other_ordered_room = mysqli_num_rows($result2);

        if ($count_own_ordered_room > 0) {
            $_SESSION['roomalreadyaddedtoordered'] = "room_already_added_to_ordered";
            header("location:../View/NormalUserPages/user_room_details.php");
        } elseif ($count_other_ordered_room > 0) {
            $_SESSION['someonealreadyorderedroom'] = "someone_already_ordered_room";
            header("location:../View/NormalUserPages/user_room_details.php");

        } else {
            $query3 = "insert into ordered_room (room_id, order_status, useremail)
            values('$this->room_id', '$this->order_status' , '$this->useremail')";

            echo $query3;
            mysqli_query($this->connection, $query3);
            $_SESSION['roomaddedtoordered'] = "room_added_to_ordered";
            header("location:../View/NormalUserPages/user_room_details.php");
        }

    }

    public function SelectSpecificOrderedRoom() {
        $query = "select oor.room_id, oor.useremail, oor.order_status,
        r.room_location, r.room_price, r.room_description
        from ordered_room oor left join room r
        on oor.room_id= r.room_id
        where oor.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function SelectAllOrderedRoom() {
        $query = "select oor.room_id, oor.useremail, oor.order_status,
        r.room_location, r.room_price, r.room_description 
        from ordered_room oor left join room r
        on oor.room_id= r.room_id";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveOreredRoom(){
        $query = "delete from ordered_room where
        useremail='$this->useremail' && room_id='$this->room_id'";

        mysqli_query($this->connection, $query);

        $_SESSION['orderedroomremoved'] = "ordered_room_removed";
        header("location:../View/NormalUserPages/user_ordered_property.php");
    }

    public function UpdateRoomOrderStatus()
    {
        $query = "update ordered_room set
        order_status='$this->order_status'
        where room_id='$this->room_id' 
        && useremail='$this->useremail'";

        mysqli_query($this->connection, $query);
        $_SESSION['roomorderconfirmed'] = "room_order_confirmed";
        header("location:../View/AdminPages/admin_ordered_property.php");

    }
}

//ordered land details
class OrderedLand extends DatabaseConnection
{
    private $land_id;
    private $order_status;
    private $useremail;

    public function SetLandId($land_id1)
    {
        $this->land_id = $land_id1;
    }

    public function SetOrdereStatus($order_status1)
    {
        $this->order_status = $order_status1;
    }

    public function SetUserEmail($user_email1)
    {
        $this->useremail = $user_email1;
    }

    public function AddToOrderedLand() {
        $query = "select * from ordered_land
         where useremail='$this->useremail'
         && land_id='$this->land_id'";

        $result = mysqli_query($this->connection, $query);
        $count_own_ordered_land = mysqli_num_rows($result);

        $query2 = "select * from ordered_land
         where land_id='$this->land_id'";

        $result2 = mysqli_query($this->connection, $query2);
        $count_other_ordered_land = mysqli_num_rows($result2);

        if ($count_own_ordered_land > 0) {
            $_SESSION['landalreadyaddedtoordered'] = "land_already_added_to_ordered";
            header("location:../View/NormalUserPages/user_land_details.php");
        } elseif ($count_other_ordered_land > 0) {
            $_SESSION['someonealreadyorderedland'] = "someone_already_ordered_land";
            header("location:../View/NormalUserPages/user_land_details.php");

        } else {
            $query3 = "insert into ordered_land (land_id, order_status, useremail)
            values('$this->land_id', '$this->order_status' , '$this->useremail')";

            echo $query3;
            mysqli_query($this->connection, $query3);
            $_SESSION['landaddedtoordered'] = "land_added_to_ordered";
            header("location:../View/NormalUserPages/user_land_details.php");
        }
    }

    public function SelectSpecificOrderedLand(){
        $query = "select ol.land_id, ol.useremail, ol.order_status,
        l.land_location, l.land_price, l.land_description
        from ordered_land ol left join land l
        on ol.land_id= l.land_id
        where ol.useremail='$this->useremail'";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function SelectAllOrderedland(){
        $query = "select ol.land_id, ol.useremail, ol.order_status,
        l.land_location, l.land_price, l.land_description 
        from ordered_land ol left join land l
        on ol.land_id= l.land_id";

        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    public function RemoveOreredLand()
    {
        $query = "delete from ordered_land where
        useremail='$this->useremail' && land_id='$this->land_id'";

        mysqli_query($this->connection, $query);
        $_SESSION['orderedlandremoved'] = "ordered_land_removed";
        header("location:../View/NormalUserPages/user_ordered_property.php");
    }
    
    public function UpdateLandOrderStatus(){
        $query = "update ordered_land set order_status='$this->order_status'
        where land_id='$this->land_id' && useremail='$this->useremail'";

        mysqli_query($this->connection, $query);
        $_SESSION['landorderconfirmed'] = "land_order_confirmed";
        header("location:../View/AdminPages/admin_ordered_property.php");
    }
}

    //comment details
    class Comment extends DatabaseConnection{

     private $comment_id;
     private $property_id;
     private $comment;
     private $comment_date;
     private $useremail;
     private $username; 

    public function SetCommentId($comment_id1){
        $this->comment_id=$comment_id1;
    }
    public function SetPropertyId($property_id1){
        $this->property_id = $property_id1;

    }
    public function SetSetUsername($username1)
    {
        $this->username = $username1;

    }

    public function SetComment($comment1){
       $this->comment = $comment1;
    }

    public function SetCommentDate($comment_date1){
        $this->comment_date = $comment_date1;
    }
    public function SetUserEmail($useremail1){
        $this->useremail = $useremail1;
    }


    //add comment in house
    public function PostHouseComment(){
        $query= "insert into comment 
        (comment_id, property_id, comment, 
        comment_date, username, useremail)
        values('NULL','$this->property_id',
        '$this->comment','$this->comment_date',
        '$this->username','$this->useremail')";

       mysqli_query($this->connection, $query);
       header("location:../View/NormalUserPages/user_house_details.php");
    }

  //add comment in flat
    public function PostFlatComment()
    {
        $query = "insert into comment 
        (comment_id, property_id, comment,
         comment_date, username, useremail)
        values('NULL','$this->property_id',
        '$this->comment','$this->comment_date',
        '$this->username','$this->useremail')";

        mysqli_query($this->connection, $query);
        header("location:../View/NormalUserPages/user_flat_details.php");
    }

      //add comment in room
    public function PostRoomComment()
    {
        $query = "insert into comment
        (comment_id, property_id, comment,
        comment_date, username, useremail)
        values('NULL','$this->property_id',
       '$this->comment','$this->comment_date',
       '$this->username','$this->useremail')";

        mysqli_query($this->connection, $query);
        header("location:../View/NormalUserPages/user_room_details.php");
    }

      //add comment in land
    public function PostLandComment()
    {
        $query = "insert into comment 
        (comment_id, property_id, comment,
         comment_date, username, useremail)
        values('NULL','$this->property_id',
        '$this->comment','$this->comment_date',
        '$this->username','$this->useremail')";

        mysqli_query($this->connection, $query);
        header("location:../View/NormalUserPages/user_land_details.php");

    }

    public function DisplayComment(){
        $query="select * from comment where 
        property_id='$this->property_id'";

        $result=mysqli_query($this->connection, $query);
        return $result;
    }

}

?>