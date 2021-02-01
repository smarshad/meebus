<?php
include_once '../server/server.php';
include_once 'pdo_functions.php';
$obj=new user_module($con);  
$query = $_GET['query'].'%';
$data=array($query);
$zid = $_GET['zid'];
$getstationById = $obj->getstationsById($zid); 
?>

 <select name="b_0" id="b_0">
	 <option value="">Boarding Point</option>
	<?php foreach ($getstationById as $idstation) {
	?>
    <option value="<?php echo $idstation['board_city'];?>"><?php echo $idstation['board_name'];?></option>
    <?php } ?>
    
	</select>

