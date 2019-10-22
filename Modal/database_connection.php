<?php 

    class DatabaseConnection{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database_name = "property_market_nepal";
    protected $connection;

    public function __construct(){
    $this->connection= mysqli_connect($this->host, $this->username, $this->password, $this->database_name);
    }
}
    
?>