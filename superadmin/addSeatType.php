<?php
include "includes/header.php";


$seatype=$_POST['seat_type'];
if(isset($_POST['upper']) && $_POST['upper']==1)
{
	$upper_seat=$_POST['upper'];
	$upper_left_col=$_POST['upper_left_col'];
	$upper_left_row=$_POST['upper_left_row'];
	$upper_right_col=$_POST['upper_right_col'];
	$upper_right_row=$_POST['upper_right_row'];
	$upperLeftSeat=$_POST['upperleftseat'];
	$upperRightSeat=$_POST['upperrightseat'];
}
else
{
 	$upper_seat=0;
	$upper_left_col=0;
	$upper_left_row=0;
	$upper_right_col=0;
	$upper_right_row=0;
	$upperLeftSeat=0;
	$upperRightSeat=0;	
}
$lower_left_col=$_POST['lower_left_col'];
$lower_left_row=$_POST['lower_left_row'];
$lower_right_col=$_POST['lower_right_col'];
$lower_right_row=$_POST['lower_right_row'];
$lowerLeftSeat=$_POST['lowerleftseat'];
$lowerRightSeat=$_POST['lowerrightseat'];
if(!isset($_POST['id']))
{
	$q=$db->query("SELECT structureID FROM busstructuretypes WHERE structureType='$seatype' AND upper_seat='$upper_seat' AND upper_left_col='$upper_left_col' AND upper_left_row='$upper_left_row' AND upper_left_type='$upperLeftSeat' AND upper_right_col='$upper_right_col' AND upper_right_row='$upper_right_row' AND upper_right_type='$upperRightSeat' AND lower_left_col='$lower_left_col' AND lower_left_row='$lower_left_row' AND lower_left_type='$lowerLeftSeat' AND lower_right_col='$lower_right_col' AND lower_right_row='$lower_right_row' AND lower_right_type='$lowerRightSeat'");

	$num_rows = mysql_num_rows($q);
	
	if($num_rows==1)
	{
		$db->query("INSERT INTO busstructuretypes SET structureType='$seatype',upper_seat='$upper_seat',upper_left_col='$upper_left_col',upper_left_row='$upper_left_row',upper_left_type='$upperLeftSeat',upper_right_col='$upper_right_col',upper_right_row='$upper_right_row',upper_right_type='$upperRightSeat',lower_left_col='$lower_left_col',lower_left_row='$lower_left_row',lower_left_type='$lowerLeftSeat',lower_right_col='$lower_right_col',lower_right_row='$lower_right_row',lower_right_type='$lowerRightSeat'");
		header("location:seatLayoutmgmt.php?msg='succuessfully Added'");
	}
	else
	{
		header("location:seatLayoutmgmt.php?msg='This Seat Layout Type Already Exit Duplicate Not Allowed'");	
	}
}
else
{
$id=$_POST['id'];
	$db->query("UPDATE busstructuretypes SET structureType='$seatype',upper_seat='$upper_seat',upper_left_col='$upper_left_col',upper_left_row='$upper_left_row',upper_left_type='$upperLeftSeat',upper_right_col='$upper_right_col',upper_right_row='$upper_right_row',upper_right_type='$upperRightSeat',lower_left_col='$lower_left_col',lower_left_row='$lower_left_row',lower_left_type='$lowerLeftSeat',lower_right_col='$lower_right_col',lower_right_row='$lower_right_row',lower_right_type='$lowerRightSeat' WHERE structureID='$id'");
	
	header("location:seatLayoutmgmt.php?msg='Updated Successflly'");
}
?>