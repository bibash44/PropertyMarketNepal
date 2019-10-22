<?php 

namespace App\Models;

class DatabaseConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $databasename = "property_market_nepal";
    protected $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->databasename);
    }

}


  class User extends DatabaseConnection{
  private $email;
  private $password;

  public function setEmail($email)
  {
    $this->email=$email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }
  
  //test case for login
  public function login()
  {
  $query = "select * from user where 
  email='$this->email' 
  && password='$this->password'";
  $result = mysqli_query($this->connection, $query);
  $count=  mysqli_num_rows($result);

  if($count>0){ 
   return true;  
  }
 }

 //test case for checking multiple user
 public function checkRegister()
  {
  $query = "select * from user where 
  email='$this->email'";
  $result = mysqli_query($this->connection, $query);
  $count=  mysqli_num_rows($result);
  $chkuser="";
  if($count>0){ 
    foreach ($result as $key) {
      $chkuser=$key['email'];
    }
    return $chkuser;
  }
}
}


  class House extends DatabaseConnection
  {
  private $houseid;

  public function setHouseId($houseid1){
    $this->houseid= $houseid1;
  } 


  //test case for checking house id
  public function selectHouse()
  {
      $query = "select * from house 
      where house_id='$this->houseid'";

      $result = mysqli_query($this->connection, $query);
      $chkhouse="";
      foreach ($result as $key) {
       $chkhouse= $key['house_id'];
      }
      return $chkhouse;
  }
}

//class for registered user message
class UserMessage extends DatabaseConnection
{
  private $useremail;


  public function setUserEmail($useremail1){
    $this->useremail=$useremail1;
  }

  //test case for user message
  public function checkMessage(){
    $query = "select * from user_message 
    where useremail='$this->useremail'";

    $result = mysqli_query($this->connection, $query);
    $chkmessage="";

    foreach ($result as $key) {
      $chkmessage=$key['message'];
    }
    return $chkmessage;
  }
}

class Flat extends DatabaseConnection
{
  private $search_flat_keyword;

  public function setSearchFlatKeyWord($search_flat_keyword1)
  {
    $this->search_flat_keyword = $search_flat_keyword1;
  }

  //test case for flat search
  public function searchFlat() {
    $query = "SELECT * FROM flat WHERE 
    CONCAT(flat_id, flat_price, flat_location) 
    LIKE  '%".$this->search_flat_keyword."%'";
    $result = mysqli_query($this->connection, $query);
    $count= mysqli_num_rows($result);
    return $count;
  }
}


 //favourite room details
class FavouriteRoom extends DatabaseConnection
{
  private $room_id;
  private $useremail;

  public function setRoomId($room_id1)
  {
    $this->room_id = $room_id1;
  }
  public function setUserEmail($user_email1)
  {
    $this->useremail = $user_email1;
  }

  //test case for favourite room
  public function selectFavouriteRoom()
  {
    $query = "select * from favourite_room
    where useremail='$this->useremail' 
    && room_id='$this->room_id'";

    $result = mysqli_query($this->connection, $query);
    $countfavroom = mysqli_num_rows($result);

    if ($countfavroom > 0) {
      return true;
    }
  }
 }


 //ordered land details
class OrderedLand extends DatabaseConnection
{
  private $land_id;
  private $useremail;


  public function setLandId($land_id1)
  {
    $this->land_id = $land_id1;
  }

  public function setUserEmail($user_email1)
  {
    $this->useremail = $user_email1;
  }

  //test case ordered land
  public function selectOrderedLand()
  {
    $query = "select * from ordered_land
    where useremail='$this->useremail'
    && land_id='$this->land_id'";
    $result = mysqli_query($this->connection, $query);
    $count_own_ordered_land = mysqli_num_rows($result);

    if($count_own_ordered_land> 0){
      return false;
    }
  }

}
?>
