<?php
class DB
{
    private $hostname;
    private $user;
    private $password;
	
	public function __construct()
		{
			$this->hostname = DB_HOSTNAME;
			$this->user = DB_USERNAME;
			$this->password= DB_PASSWORD;
		}
    
    public function connect()
        {
			$conn = mysqli_connect($this->hostname, $this->user, $this->password, $this->user);
			if($conn === false){
			echo "Нет соединения";
			die("ERROR: Could not connect. " . mysqli_connect_error());
			}
		    mysqli_set_charset($conn , 'utf8' );
			return $conn; 
		}
}	
