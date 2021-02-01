<?php

include "connection.php";
GLOBAL $pdo;
class Db {
    /* Properties */
    private $conn;

    /* Get database access */
    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    /* Login a user */
    public function getCity($data='') {
      // echo $data;
        $stations = array();
        $stmt = $this->conn->prepare("SELECT station_name, station_id FROM stations WHERE station_name LIKE ?");
        $stmt->execute($data);
        foreach ($stmt->fetchAll() as $row) {
          $stations[] = $row['station_name'];
          $id[]       = $row['station_id'];
        }
        $json=json_encode($stations, true);
        return $json;
        
    }
}
$user = new Db($pdo);

$query = $_GET['query'].'%';
$data=array($query);
$station = $user->getCity($data);

echo $station;

?>