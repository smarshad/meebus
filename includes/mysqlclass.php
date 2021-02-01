<?php
error_reporting(0);
class database {
    var $conn;
    var $dbc;
	var $db_loca;
	var $hostname;
	var $db_username;
	var $password ;
	var $database ;	
	
    function __construct() {
        $this->connect();
    
    }
    
    function connect() {
	
		//$this->db_loca = 'local' ;
	$this->db_loca = 'remote' ;

if($_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') { 
$this->hostname = "localhost";
$this->db_username = "root";
$this->password = "";
//$this->database = "scriptst_ownbus"; 
$this->database = "meebus"; 
}

else { 
$this->hostname = "localhost";
$this->db_username = "meebus_meebus";
$this->password = "LsywUWo5";
$this->database = "meebus_meebus";
}
	
	
		$this->conn = mysql_connect($this->hostname,$this->db_username,$this->password) or die(mysql_error());
        $this->dbc = mysql_select_db($this->database, $this->conn) or die(mysql_error());
    }
    
    function close_conn() {
            if (isset($this->conn)) {
                mysql_close($this->conn);
                unset($this->conn);
            }
    }    
    
    function query($sql) {
            $res = mysql_query($sql);
			
		//	echo $sql ; exit ;
			
            $this->conf_query($res);
			
			//echo $res ; exit ;
			
            return $res;
    }
    
    function conf_query($res) 
	{			
		if (!$res) 
		{
			die(mysql_error());
		}
    }
    
    function fetch_array($res) {
            return mysql_fetch_array($res);            
    }
    
    function numrows($res) {
            return mysql_num_rows($res);
    }
}

$db = new database();


?>