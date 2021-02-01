<?php
include "includes/header.php";

if(isset($_REQUEST['submit']))
{

$busid=$_REQUEST['busid'];
$dateval=$_REQUEST['dateval'];

$qry=mysql_query("update businfo set disable_date='$dateval' where Bus_id='$busid'");

if($qry)
{

header("location:disabledate.php?busid=$busid&succ");

}


}

$sel_val=mysql_fetch_array(mysql_query("select * from businfo where Bus_id='$_REQUEST[busid]'"));

$seldat=explode(",",$sel_val['disable_date']);


?>

<script type="text/javascript" src="js/jquery-ui.multidatespicker.js"></script>
	
		<!-- loads some utilities (not needed for your developments) -->
		<link rel="stylesheet" type="text/css" href="css/mdp.css">
		<link rel="stylesheet" type="text/css" href="css/prettify.css">
		<script type="text/javascript" src="js/prettify.js"></script>
		<script type="text/javascript" src="js/lang-css.js"></script>
		<script type="text/javascript">
		$(function() {
			prettyPrint();
		});
		</script>
		<div><span><a href="busDetails.php?sp_id=<?php echo $_REQUEST['sp_id'] ?>"><?php echo $sel_val['Bus_name']; ?> >></a></span>
		<?php
		if(isset($_REQUEST['succ']))
		{?>
		
		<b style="color:#FF0000; padding-left:100px;">Date Added disabled list successfully !!! </b>
		
		<?php } ?>
		</div>
		 
<fieldset class="table-bor">
<legend><strong>Enable Disable Date</strong></legend>
<form action="" name="disdate" id="disdate" method="post"  enctype="multipart/form-data">
<li class="demo">
						<h3>Days Range Mode: </h3>
						<div class="box">
							<div id="with-altField"></div>
							<input type="hidden" id="altField" name="dateval"><br />
							
							<input type="submit" name="submit" value="Submit" />	
						</div>
						
						<?php 

if($sel_val['disable_date'] != "") {
$i=0;
$val="";
while($i < count($seldat))
{
$vvv= "'".$seldat[$i]."',";
//echo $vvv;
$val.=$vvv;
//echo $val;
$i++;
}

$aaa="addDates: [$val]";
}
else {
 $aaa="";

}
//echo $aaa;
?>
						<div class="code-box">
							
							<pre>
							<script>
var date = new Date();

$('#with-altField').multiDatesPicker({
	altField: '#altField',
	minDate: +0, 
	maxDate: '+2M +0D',
	<?php echo $aaa; ?>
	
	
});
</script>

</pre>
						</div>
					</li>
		<input type="hidden" name="busid" value="<?php echo $_REQUEST['busid'] ?>" />	
				
					
</form>
</fieldset>
<?php include "includes/footer.php";  ?>