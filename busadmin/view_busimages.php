<?php
include "includes/header.php";

if(!isset($_REQUEST['sp_id'])){
  //header("location: busDetails.php");
  }
else {  
$sp_id=$_SESSION['SP_id'];
$busid=$_REQUEST['busid'];
?>
<a href="busDetails.php?sp_id=<?php echo $sp_id; ?>"><?php echo get_SP_name($sp_id); ?></a>&nbsp; >> &nbsp;<strong>View Bus Images</strong>

<?php 
if($_REQUEST['inacc_id'])
{
$inacc_id=$_REQUEST['inacc_id'];
$sp_id=$_REQUEST['sp_id'];
$busid=$_REQUEST['busid'];
mysql_query("update bus_images set img_status='1' where img_id ='$inacc_id'");
header("location:view_busimages.php?sp_id=$sp_id&busid=$busid&deact");
}
if($_REQUEST['acc_id'])
{
$sp_id=$_REQUEST['sp_id'];
$busid=$_REQUEST['busid'];
$acc_id=$_REQUEST['acc_id'];
mysql_query("update bus_images set img_status='0' where img_id ='$acc_id'");
header("location:view_busimages.php?sp_id=$sp_id&busid=$busid&act");
}
if($_REQUEST['del_id'])
{
$sp_id=$_REQUEST['sp_id'];
$busid=$_REQUEST['busid'];
$del_id=$_REQUEST['del_id'];
mysql_query("delete from bus_images where img_id ='$del_id'");
header("location:view_busimages.php?sp_id=$sp_id&busid=$busid&del");
}
?>
<?php
if(isset($_REQUEST['addbus'])){
include("../includes/resize-class.php");
$SP_id=$_SESSION['SP_id'];
$busname=mysql_real_escape_string($_REQUEST['bname']);
$busType=$_REQUEST['busType'];
$source=$_REQUEST['fromCity'];
$destination=$_REQUEST['toCity'];
$fare=$_REQUEST['fare'];
$tax=$_REQUEST['tax'];
$total=$_REQUEST['tfare'];
$seats=$_REQUEST['seats'];
$date=date("Y-m-d");
$image=$_FILES['bus_image']['name'];

$video=$_FILES['video']['name'];

$split = explode(".",$video);
//echo $split_name[1]; exit;
if(($split[1] == 'mp4') || ($split[1] == 'flv') || ($split[1] == '3gp') || ($split[1] == 'MP4') || ($split[1] == 'FLV') || ($split[1] == '3GP'))
{

$vimg = "vid".date("dmY")."-".rand("100","999").".".$split[1];
move_uploaded_file($_FILES['video']['tmp_name'],"../uploads/video/".$vimg);

}

$item=$_REQUEST['lux_item'];
	
	
$img_size = filesize($_FILES['bus_image']['tmp_name']);
//echo $img_size;exit;
if($img_size > 1048576) //1048576 = 1MB
{
header("Location:addNewBus.php?largeimage");
exit;
}
else
{

$split_name = explode(".",$image);
//echo $split_name[1]; exit;
if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
{
//echo "image ok "; exit;
//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
$bus_img_small = "bus".date("dmY")."-".rand("100","999").".".$split_name[1];
$image_path = "../uploads/bus_image/";
$image_path_thumb = "../uploads/bus_image/thumb/";
$image_path_mid = "../uploads/bus_image/thumb/mid/";
 move_uploaded_file($_FILES['bus_image']['tmp_name'],"../uploads/bus_image/".$bus_img_small);
//echo "<br>uploads/".$bus_img_small; exit;
//small image
$resizeObj = new resize("../uploads/bus_image/".$bus_img_small);
// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
//$resizeObj -> resizeImage(150, 150, 'exact');

//$resizeObj -> saveImage($image_path.$bus_img_small, 100);

//very small image
//$resizeObj = new resize($_FILES['cate_image']['tmp_name']);

// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
$resizeObj -> resizeImage(150, 150, 'exact');

$resizeObj -> saveImage($image_path_thumb.$bus_img_small, 100);

$resizeObj -> resizeImage(60, 60, 'exact');

$resizeObj -> saveImage($image_path_mid.$bus_img_small, 100);

//unlink("uploads/".$bus_img_small);


//echo $bus_img_small.", ".$cate_img_small; exit;
}
else
{
header("Location:addNewBus.php?not-a-image");
exit;
}
}




$boarding_time='';

$boardlist=explode(",",$_REQUEST['boardlist']);
for($u=0;$u<count($boardlist);$u++){
$a=''; $b='';
    $q=explode("-",$boardlist[$u]);

	$a=$q[0];
	$b=$q[1];
	
		if(isset($_REQUEST[$a]) && isset($_REQUEST[$b])){
		   $boarding_time.=mysql_real_escape_string($_REQUEST[$a])."-".mysql_real_escape_string($_REQUEST[$b]).",";
		}
    }
	
	 $boarding_time=substr($boarding_time,0,-1); 
	 $drop_time=$_REQUEST['dropping1']."-".$_REQUEST['to_time1'];;
	 $SR_id=getRouteID($source,$destination);
	
	//echo "INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `Bus_boarding_time` , `Bus_departure_time`,  `Bus_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`bus_image` ) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$drop_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$bus_img_small')"; exit;
	
	$sql_businfo="INSERT INTO `businfo` ( `Bus_id` ,`SP_id` ,`SR_id` ,`Bus_fromcity` ,  `Bus_tocity` ,  `Bus_type` ,  `Bus_structure` ,  `Bus_name` , `Bus_boarding_time` , `Bus_departure_time`,  `Bus_fare` ,  `Bus_adddate` ,  `Bus_seats4SP` ,  `Bus_seats4SA` ,  `Bus_totalseats` ,  `Bus_status`,`luxury_item`,`bus_video`,`bus_image` ) VALUES (NULL ,  '$SP_id',  '$SR_id',  '$source',  '$destination',  '$busType',  '$seats',  '$busname',  '$boarding_time', '$drop_time',  '$total',  '$date',  '0',  '0',  '40',  '1','$item','$vimg','$bus_img_small')";
	
mysql_query($sql_businfo);
$bus_id=mysql_insert_id();
?><body onLoad="showBusStructure('<?php echo $seats; ?>','<?php echo $bus_id; ?>')">
<div id="seat_arrange">
<img src="../images/ajax-loader.gif">
</div>
</body>
<?php
//echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=busDetails.php'><span class='suc_msg'><center><br/><br/>New Bus Added Suucessfully. This page will redirect in 3 minutes.<br/><br/></center></span>";

//header("location: editBus.php?busid=$bus_id");
exit;	
}

?>
<script type="text/javascript">

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }

function get_fare(){
       var v1=document.getElementById('fare').value;
	   var v2=document.getElementById('tax').value;
	   if(v1 != '' && v2 !=''){
	      document.getElementById('tfare').value=parseInt(v1)+parseInt(v2);
	     }
      }


 function getObject(obj)
  {
	  var theObj;
	  if (document.all) {
		  if (typeof obj=='string') {
			  return document.all(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  if (document.getElementById) {
		  if (typeof obj=='string') {
			  return document.getElementById(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  return null;
  }



 function chkkeycode(evt,txt)
 {
	var textBox = getObject(txt);
	var charCode = (evt.which) ? evt.which : event.keyCode;

	 if (charCode == 189){ 
	      return false;
		 }
		 else{
		  return true;
		 }
	 
	 /*if (charCode == 8) textBox.value = "backspace"; //  backspace
	 if (charCode == 9) textBox.value = "tab"; //  tab
	 if (charCode == 13) textBox.value = "enter"; //  enter
	 if (charCode == 16) textBox.value = "shift"; //  shift
	 if (charCode == 17) textBox.value = "ctrl"; //  ctrl
	 if (charCode == 18) textBox.value = "alt"; //  alt
	 if (charCode == 19) textBox.value = "pause/break"; //  pause/break
	 if (charCode == 20) textBox.value = "caps lock"; //  caps lock
	 if (charCode == 27) textBox.value = "escape"; //  escape
	 if (charCode == 33) textBox.value = "page up"; // page up, to avoid displaying alternate character and confusing people	         
	 if (charCode == 34) textBox.value = "page down"; // page down
	 if (charCode == 35) textBox.value = "end"; // end
	 if (charCode == 36) textBox.value = "home"; // home
	 if (charCode == 37) textBox.value = "left arrow"; // left arrow
	 if (charCode == 38) textBox.value = "up arrow"; // up arrow
	 if (charCode == 39) textBox.value = "right arrow"; // right arrow
	 if (charCode == 40) textBox.value = "down arrow"; // down arrow
	 if (charCode == 45) textBox.value = "insert"; // insert
	 if (charCode == 46) textBox.value = "delete"; // delete
	 if (charCode == 91) textBox.value = "left window"; // left window
	 if (charCode == 92) textBox.value = "right window"; // right window
	 if (charCode == 93) textBox.value = "select key"; // select key
	 if (charCode == 96) textBox.value = "numpad 0"; // numpad 0
	 if (charCode == 97) textBox.value = "numpad 1"; // numpad 1
	 if (charCode == 98) textBox.value = "numpad 2"; // numpad 2
	 if (charCode == 99) textBox.value = "numpad 3"; // numpad 3
	 if (charCode == 100) textBox.value = "numpad 4"; // numpad 4
	 if (charCode == 101) textBox.value = "numpad 5"; // numpad 5
	 if (charCode == 102) textBox.value = "numpad 6"; // numpad 6
	 if (charCode == 103) textBox.value = "numpad 7"; // numpad 7
	 if (charCode == 104) textBox.value = "numpad 8"; // numpad 8
	 if (charCode == 105) textBox.value = "numpad 9"; // numpad 9
	 if (charCode == 106) textBox.value = "multiply"; // multiply
	 if (charCode == 107) textBox.value = "add"; // add
	 if (charCode == 109) textBox.value = "subtract"; // subtract
	 if (charCode == 110) textBox.value = "decimal point"; // decimal point
	 if (charCode == 111) textBox.value = "divide"; // divide
	 if (charCode == 112) textBox.value = "F1"; // F1
	 if (charCode == 113) textBox.value = "F2"; // F2
	 if (charCode == 114) textBox.value = "F3"; // F3
	 if (charCode == 115) textBox.value = "F4"; // F4
	 if (charCode == 116) textBox.value = "F5"; // F5
	 if (charCode == 117) textBox.value = "F6"; // F6
	 if (charCode == 118) textBox.value = "F7"; // F7
	 if (charCode == 119) textBox.value = "F8"; // F8
	 if (charCode == 120) textBox.value = "F9"; // F9
	 if (charCode == 121) textBox.value = "F10"; // F10
	 if (charCode == 122) textBox.value = "F11"; // F11
	 if (charCode == 123) textBox.value = "F12"; // F12
	 if (charCode == 144) textBox.value = "num lock"; // num lock
	 if (charCode == 145) textBox.value = "scroll lock"; // scroll lock
	 if (charCode == 186) textBox.value = ";"; // semi-colon
	 if (charCode == 187) textBox.value = "="; // equal-sign
	 if (charCode == 188) textBox.value = ","; // comma
	 if (charCode == 189) textBox.value = "-"; // dash
	 if (charCode == 190) textBox.value = "."; // period
	 if (charCode == 191) textBox.value = "/"; // forward slash
	 if (charCode == 192) textBox.value = "`"; // grave accent
	 if (charCode == 219) textBox.value = "["; // open bracket
	 if (charCode == 220) textBox.value = "\\"; // back slash
	 if (charCode == 221) textBox.value = "]"; // close bracket
	 if (charCode == 222) textBox.value = "'"; // single quote*/

	/* var lblCharCode = getObject('spnCode');
	lblCharCode.innerHTML = 'KeyCode:  ' + charCode;

	return false;*/


 }



function validate_busform()
{
   
	var form = document.busform;
	
	if(form.bname.value == ""){
	alert("Please Enter Bus Name");
	form.bname.focus();
	return false;
	}
	
	if(form.busType.value == ""){
	alert("Please Choose Bus Type");
	form.busType.focus();
	return false;
	}
	
	if(form.fromCity.value == ""){
	alert("Please Choose From City");
	form.fromCity.focus();
	return false;
	}
	
	if(form.toCity.value == ""){
	alert("Please Choose To City");
	form.toCity.focus();
	return false;
	}
	
/*	if(form.fare.value == ""){
	alert("Please Enter Bus Fare");
	form.fare.focus();
	return false;
	}
	
	if(form.tax.value == ""){
	alert("Please Enter Tax Amount");
	form.tax.focus();
	return false;
	}*/
	
	var str=document.getElementById('boardlist').value;
	var bpoints=str.split(",");

	for(var i=0;i<document.getElementById('boardcount').value;i++){
	    var bbt=bpoints[i].split("-");
		if(document.getElementById(bbt[0]).value == '')
		  {
		   alert('Please Enter Boarding Point');
		   document.getElementById(bbt[0]).focus();
		   return false;
		  }
		  if(document.getElementById(bbt[1]).value == 'Choose Time' || document.getElementById(bbt[1]).value == '')
		  {
		   alert('Please Choose Boarding Time');
		   document.getElementById(bbt[1]).focus();
		   return false;
		  }
	}
	
	
	if(form.tfare.value == ""){
	alert("Please Enter Total Fare");
	form.tfare.focus();
	return false;
	}
	
	if(form.seats.value == ""){
	alert("Please Select seat structure");
	form.seats.focus();
	return false;
	}
	
	if(document.getElementById('lux_item').value=="")
	{
	alert("Enter the luxury item");
	document.getElementById('lux_item').focus();
	return false;
	}
	
		if(document.getElementById('video').value=="")
	{
	alert("Enter the video url");
	document.getElementById('video').focus();
	return false;
	}
	
		if(document.getElementById('bus_image').value=="")
	{
	alert("Choose the bus image");
	document.getElementById('bus_image').focus();
	return false;
	}
	
	if(document.getElementById('bus_image').value != "")
	{
		var ss=document.getElementById('bus_image').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF")
		{
			  alert("Upload jpg,png,jpeg,gif images only...");
			  document.getElementById('bus_image').value="";
			  document.getElementById('bus_image').focus();
			  return false;
		 }
	}
	
	if(document.getElementById('video').value != "")
	{
		var ss=document.getElementById('video').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "mp4" && ssivanew != "flv" && ssivanew != "3gp" && ssivanew != "MP4" && ssivanew != "FLV" && ssivanew != "3GP")
		{
			  alert("Upload mp4,flv,3gp images only...");
			  document.getElementById('video').value="";
			  document.getElementById('video').focus();
			  return false;
		 }
	}
	
	
	
	
	return true;
}


/*function validate_busform(){
var form=document.busform;

for(i=0; i<form.elements.length; i++)
{
 if(form.elements[i].value==''){
    document.getElementById(form.elements[i].name+'_err').style.display='block';
	document.getElementById(form.elements[i].name).focus();
	return false;
   }
  else{
  document.getElementById(form.elements[i].name+'_err').style.display='none';
  } 
 
}
   return true;  
   }*/
   
function LTrim(str){
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if(whitespace.indexOf(s.charAt(0)) != -1){
	// We have a string with leading blank(s)...
		var j=0, i = s.length;
	// Iterate from the far left of string until we
	// don't have any more whitespace...
	while(j < i && whitespace.indexOf(s.charAt(j)) != -1)
		j++;
	// Get the substring from the first non-whitespace
	// character to the end of the string...
		s = s.substring(j, i);
	}
	return s;
}
	
function RTrim(str){
	// We don't want to trip JUST spaces, but also tabs,
	// line feeds, etc.  Add anything else you want to
	// "trim" here in Whitespace
	var whitespace = new String(" \t\n\r");	
	var s = new String(str);	
	if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
	// We have a string with trailing blank(s)...	
	var i = s.length - 1;       // Get length of string	
	// Iterate from the far right of string until we
	// don't have any more whitespace...
	while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
		i--;	
	// Get the substring from the front of the string to
	// where the last non-whitespace character is...
		s = s.substring(0, i+1);
	}
	return s;
}
	
function Trim(id){
    var str=document.getElementById(id).value;
	document.getElementById(id).value=RTrim(LTrim(str));
}     
</script>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	

<script type="text/javascript">
function time_show(idval)
{
	var var_id = '#'+idval ; 						
	$(var_id).timepicker({ampm: true, hourMin: 0, hourMax: 24 });
}
       function validimage(fval)
      {
          var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
		
		  var len=document.getElementById("tblAdd");
          var len1=len.rows.length;
          var img=document.getElementById("image"+len1).value;
		  
				if(fval=="")
				{
					//alert("upload image");
					showDIV2('product_image_err','Browse and Upload Image',1,'product_image');
					return false; 
				
				}
				else if(fval.search(re_text) == -1)
				{
					//alert("Image does not have Image(jpg, gif, png) extension"); 
					showDIV2('product_image_err','Image does not have (jpg, gif, png) extension',1,'product_image');
					document.getElementById("image"+len1).value='';
					document.getElementById("image"+len1).focus();
					return false;
				}
				else
				{
					hideDIV('product_image_err',1);
				
				}
				

       }
function fncheck(val)
  {
        var len=document.getElementById("tblAdd");
        var len1=len.rows.length;
        var img=document.getElementById("image"+len1).value;
		
		var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
		
		
        for(var i=1;i<len1;i++)
             {
		         if(document.getElementById('image'+i).value==val)
                  {
                           //alert("already image has been selected");
						   showDIV2('product_image_err','Already Image has been selected',1,'product_image');
                           document.getElementById("image"+i).focus();
                           break;
                  
					}
			}
			
		validimage(val);		 

    }
function AddDetails()
      {	  
	
          var tableAdd = document.getElementById("tblAdd");
          var lastRow = tableAdd.rows.length;
		  	
       	  var checkUrl = document.getElementById("image"+lastRow).value;
          var re_text = /\.jpg|\.png|\.gif|\.jpeg/i;
		  var fval=document.getElementById("image"+lastRow).value;
		  
          if( document.getElementById("image"+lastRow).value == "" )
            {
             //alert("browse and upload image");
			 showDIV2('product_image_err','Browse and Upload Image',1,'product_image');
             document.getElementById("image"+lastRow).focus();
             return false;
            }
			
		if(fval.search(re_text) == -1)
		   {
				//alert("Image does not have Image(jpg, gif, png) extension"); 
				showDIV2('product_image_err','Image does not have (jpg, gif, png) extension',1,'product_image');
				document.getElementById("image"+lastRow).value='';
				document.getElementById("image"+lastRow).focus();
                return false;
            
		   }



      // if there's no header row in the table, then iteration = lastRow + 1
        var iteration = lastRow+1;
        var row = tableAdd.insertRow(lastRow);
        var cellRight = row.insertCell(0);
              <!--  cellRight.innerHTML="Image"+iteration+"<input type='file'  name='image[]'    id='image"+iteration+"' size='30' value='' onchange=\"return fncheck(this.value)\" />";-->
				cellRight.innerHTML="<input type='file'  name='image[]'    id='image"+iteration+"' size='25' value='' onchange=\"return fncheck(this.value)\" />";
            // alert(cellRight.innerHTML);
        cellRight.style.textAlign = "Center";
        tableAdd.style.display = "Block";
		hideDIV('product_image_err',1);

    }
    function DeleteDetails()
    {
        var tbl = document.getElementById('tblAdd');
        var lastRow = tbl.rows.length;
        if (lastRow > 1) tbl.deleteRow(lastRow - 1);
    }
		
</script>
<fieldset class="table-bor">
<legend><strong>View Bus Images</strong></legend>
<form action="" name="busform" id="busform" method="post" onSubmit="return validate_busform()" enctype="multipart/form-data">
<table>
	<tr>	
		<td></td>
		
		<td></td>
		
		<td></td>
		
         
		<td></td>	
	</tr>
    <tr><td><a href="add_busimages.php?sp_id=<?php echo $sp_id;?>&busid=<?php echo $busid;?>" class="ovalbutton"><span><strong>Add Bus Image</strong></span></a></td></tr>
    <tr><td>&nbsp;</td></tr>
    <?php if(isset($_REQUEST['Succ'])) {?>
    <tr><td style="color:#00CC00"; align="center">Successfully Added</td></tr>
    <?php } ?>
    <?php if(isset($_REQUEST['deact'])) {?>
    <tr><td style="color:#00CC00"; align="center">Successfully Deactivated</td></tr>
    <?php } ?>
    <?php if(isset($_REQUEST['act'])) {?>
    <tr><td style="color:#00CC00"; align="center">Successfully activated</td></tr>
    <?php } ?>
    <?php if(isset($_REQUEST['del'])) {?>
    <tr><td style="color:#FF0000"; align="center">Successfully Deleted</td></tr>
    <?php } ?>
     <tr><td>&nbsp;</td></tr>
    <tr></tr>
    <tr><td>&nbsp;</td></tr>
    <?php $sql1=mysql_query("select * from bus_images where bus_id='$busid' and sp_id='$sp_id' and img_status !='2'");
	 ?>
	<tr> <?php while($row=mysql_fetch_array($sql1))
	{ $i++;?><td style="padding-left:100px;"><img src="../uploads/bus_image/<?php echo $row['img_name']; ?>" height="150" width="150">&nbsp;<br/><span style="vertical-align:top;">Action&nbsp;:</span>
    
   
   <?php  if($row['img_status']==0) {?>
        <a href="view_busimages.php?inacc_id=<?php echo $row['img_id']; ?>&sp_id=<?php echo $sp_id; ?>&busid=<?php echo $busid;?>" title="Edit" onClick="return confirm('You want to Deactivate?')"><img src="../images/Active.png" border="0" /></a>
        <?php } ?>
        <?php  if($row['img_status']==1) {?>
        <a href="view_busimages.php?acc_id=<?php echo $row['img_id']; ?>&sp_id=<?php echo $sp_id; ?>&busid=<?php echo $busid;?>" title="Edit" onClick="return confirm('You want to activate?')"><img src="../images/inactive.png" border="0" /></a>
        <?php } ?>
   <!--<a href="comm_mgmt_edit.php?edit_id=<?php echo $res['ticket_id']; ?>" title="Edit">
		<img src="../images/edit.png" border="0" /></a>-->
        <a href="view_busimages.php?del_id=<?php echo $row['img_id']; ?>&sp_id=<?php echo $sp_id; ?>&busid=<?php echo $busid;?>" title="Delete" onClick="return confirm('Are you sure! you want to delete?')">
        <img src="../images/delete.png" border="0" /></a></td>
		
		<?php if($i==3)
	{
		$i=0;
		echo "</td><tr>";
	}
	else
	{
		echo "</td>";
	}
	} ?>
    </tr>
    <?php if(mysql_num_rows($sql1)==0){?>
	<tr><td style="color:#FF0000"; align="center">No Record Found..</td></tr>
    <?php } ?>
</table>
</form>
</fieldset>
<?php include "includes/footer.php"; } ?>