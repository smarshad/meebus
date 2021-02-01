<?php  
include_once "header.php"; 
include('server/server.php');

$user_id=$_SESSION['user']['log']['id'];

$u_id=$_SESSION['user']['log']['id'];
$first_name= $_SESSION['user']['log']['first_name'];
$last_name = $_SESSION['user']['log']['last_name'];
$email_id = $_SESSION['user']['log']['email_id'];
$mobile_number = $_SESSION['user']['log']['mobile_number'];
$addres= $_SESSION['user']['log']['address'];
$pincode= $_SESSION['user']['log']['pincode'];

$id=$_GET['id'];

if(isset($_POST['update']) && $_POST['update'] =='SAVE' && $_SESSION['user']['log']['id'] == true)
{
	
	
	if($_POST['fname'] != NULL){
	    
	    $fname=$_POST['fname'];
	    
	    $data="UPDATE user_login SET first_name = '$fname' WHERE id='$id'";
    	$update=$conn->query($data);
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['first_name'] = $fname;
    		$conn->close();
    		header("location:profile.php");
    		exit;
    	}

	    
	    
	}
	
	
	if($_POST['lname'] != NULL){
	    
	    $lname=$_POST['lname'];
	    
	    $data="UPDATE user_login SET last_name = '$lname' WHERE id='$id'";
    	$update=$conn->query($data);
    	
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['last_name'] = $lname;
    		    		$conn->close();
    		header("location:profile.php");
    		exit;
    	}


	    
	}
	
	if($_POST['address'] != NULL){
	    
	    $address=$_POST['address'];
	    
	    $data="UPDATE user_login SET address = '$address' WHERE id='$id'";
    	$update=$conn->query($data);
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['address'] = $address;
    		    		$conn->close();
    		header("location:profile.php");
    		exit;
    	}


	    
	}
	
	
	if($_POST['mobile'] != NULL){
	    
	    $mobile=$_POST['mobile'];
	
	    $pin=$_POST['pin'];
	
	    
	    $data="UPDATE user_login SET mobile_number = '$mobile' WHERE id='$id'";
    	$update=$conn->query($data);
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['mobile_number'] = $mobile;
    		  $conn->close();
    		    		
    		header("location:profile.php");
    		exit;
    	}

	   
	    
	}
	
	
	if($_POST['pin'] != NULL){
	    
	  
	
	    $pin=$_POST['pin'];
	
	    
	    $data="UPDATE user_login SET pincode = '$pin' WHERE id='$id'";
    	$update=$conn->query($data);
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['pincode'] = $pin;
    		$conn->close();
    		header("location:profile.php");
    		exit;
    	}

	   
	    
	}
	
	if($_POST['email'] != NULL){
	    
	  
	
	    $email=$_POST['email'];
	
	    
	    $data="UPDATE user_login SET email_id = '$email' WHERE id='$id'";
    	$update=$conn->query($data);
    	if($update=1){
    		
    		$_SESSION['user']['profile']="Updated Profile Successfully";
    		$_SESSION['user']['log']['email'] = $email;
    		$conn->close();
    		header("location:profile.php");
    		exit;
    	}

	   
	    
	}
	
	

}

?>


<div class="cf inner-body" >
<div id="profile_details">
<div class="profile-details"><div class="right-panel">
  <span class="greyText">My Profile ( Update ) </span>
  <form action="" method="post">
  <div class="upcoming" id="profiledetails">
   
	<div class="edittxt">
         <a href="profile.php"><input id="Cancelbtn" value="CANCEL" type="button"></a>
        <input id="Savebtn" value="SAVE" name="update" type="submit">

      </div>
    

   <div class="userdetails">

      <div class="userdet1">
        <div class="userdetleft">
          <div class="usertext" id="nametxt">FIRST NAME</div>

          <input id="fname" name="fname" placeholder=' Input New First Name' type="text">
          
          <span class="err_msg" id="err" style="font-size:13px; font-weight:bold;"></span>

        </div>

        <div class="userdetright">
          <div class="usertext" id="agetxt">LAST NAME</div>
          <input id="lname" name="lname"  type="text" placeholder=' Input New Last Name'>
          
          <span class="err_msg" id="err1" style="font-size:13px; font-weight:bold;"></span>
          
        </div>
      </div>
      <div class="userdet1">
        <div class="userdetleft">
          <div class="usertext" id="nametxt">ADDRESS</div>

          <input id="address" name="address" placeholder=' Input New Address' type="text">
          
          <span class="err_msg" id="err2" style="font-size:13px; font-weight:bold;"></span>

        </div>

        <div class="userdetright">
          <div class="usertext" id="agetxt">PINCODE</div>
          <input id="pin" placeholder=' Input New 6 digit pin' name="pin" type="text" maxlength="6">
         
           <span class="err_msg" id="err3" style="font-size:13px; font-weight:bold;"></span>
          
        </div>
      </div>
       <fieldset>
        <legend align="center">CONTACT DETAILS</legend>
      </fieldset>
    <div class="userdetails" style="min-height: 6.5em;">
      <div class="userdet1">
        <div class="userdetleft mar0">
          <div class="usertext" id="conemailtxt">EMAIL ID</div>
          
             
              <input id="email" placeholder=' Input New email' name="email" type="email">
         
           <span class="err_msg" id="err3" style="font-size:13px; font-weight:bold;"></span></div>
          
       
        <div class="userdetright">
          <div class="mobiledetail">
            <div class="usertext" id="mobtxt">MOBILE NUMBER</div>
            <input id="mobile" name="mobile" placeholder=' Input New contact'style="width: 100%;" type="text" maxlength="10">
          
          <span class="err_msg" id="err4" style="font-size:13px; font-weight:bold;"></span>
          </div>
 
        </div>

        
      </div>
    </div>

  </div>
</div>
</form>
</div>
</div>
</div>


</div>
		

<?php  include_once("includes/footer.php"); ?>
<script language="javascript">
$("#mobile").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   $("#pin").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
// $("#Savebtn").click( function ()
// {
// 	$("#err").html("");
// 	$("#err1").html("");
// 	$("#err2").html("");
// 	$("#err3").html("");
// 	$("#err4").html("");
// 	var fname=$("#fname").val();
// 	var lname=$("#lname").val();
// 	var address=$("#address").val();
// 	var pin=$("#pin").val();
// 	var mobile=$("#mobile").val();
	
// 	if(fname=='')
// 	{
// 		$("#err").html("Please Enter First Name");
// 		return false;
// 	}
// 	else if(lname=='')
// 	{
// 		$("#err1").html("Please Enter Last Name");
// 		return false;
// 	}
// 	else if(address=='')
// 	{
// 		$("#err2").html("Please Enter Address");
// 		return false;
// 	}
// 	else if(pin=='')
// 	{
// 		$("#err3").html("Please Enter Pincode");
// 		return false;
// 	}
// 	else if(mobile=='')
// 	{
// 		$("#err4").html("Please Enter Mobile Number");
// 		return false;
// 	}
	
// 	else
// 	{
// 		$("#ticket").submit();
// 		return true;
// 	}
// }
);

</script>