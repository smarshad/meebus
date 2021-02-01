<?php 
include_once'../server/server.php';  
include_once 'includes/functions.php';
$_SESSION['common']['pagename'] = "user"; 
$obj=new admin_module($con);
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once 'includes/head.php';   ?>
</head>
<style>
.scrolling{
	overflow-y:scroll;
}
</style>
<body>
<?php  include_once 'includes/top_menu.php';   ?>
         <div class="row-fluid">
            <?php include_once 'includes/leftmenu.php'; ?>
                <div id="content" class="span9">
                    <div class="row-fluid">
                    <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Search</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form name="wallet" action="" method="get">
                                    <div class="span3">
                                            <div class="control-group">
                  <input type="text" class="input-large focused datepicker" id="from" name="from" placeholder="From Date">
                                           </div>
                                        </div>   
                                        <div class="span3">
                                            <div class="control-group">
                  <input type="text" class="input-large focused datepicker" id="to" name="to" placeholder="To date">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="control-group">
                  <input class="btn btn-large btn-primary" type="button" id="search" name="submit" value="submit">
                                            </div>
                                        </div>
                                    </form>
                               </div>                                
                            </div>
                        </div>
                        <br>
                        
                        <div class="block" id="report">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Deactive Users</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <table id="example2" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            	<th>S. No</th>
                                                  <th>First Name</th>
                                                  <th>Last Name</th>
                                                  <th>Mobile</th>
                                                  <th>Email Id</th>
                                                  <th>Account Balance</th>
                                                  <th>Deactivate</th>
          									</tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
											$i=1; 
											$data=array(0);
											$adminRes=$obj->getUsers($data);  
											//echo '<pre>'; print_r($adminRes); echo '</pre>';
											foreach($adminRes as $res)
											{	
											?>
											<tr>
											  <td><?php echo $i; ?></td>
											  <td><?php echo $res['first_name']; ?></td>
											  <td><?php echo $res['last_name']; ?> </td>
											  <td><?php echo $res['mobile_number']; ?></td>
											  <td><?php echo $res['email_id'];?></td>
											  <td><?php echo $res['balance']; ?></td>
                                              <td>
                                                 <div class="onoffswitch">
                                                   <input type="checkbox" name="crs_user" class="onoffswitch-checkbox" id="<?php echo $res['id']; ?>" <?php if($res['status']==1) echo 'checked'; ?> style="display:none;">
                                                    <label class="onoffswitch-label" for="<?php echo $res['id']; ?>">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                    </div>
                                            </td>
											<?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
            </div>					
		</div> 
        </div><!-- /container -->
       <?php include 'includes/footer.php' ?>
       <script>
	 $( "#search" ).click(function() {

	var from=$("#from").val();
	if(from=='')
	{
		alert("Please Enter From Date");
		return false;
	}
	var to=$("#to").val();
	if(to=='')
	{
		alert("Please Enter To Date");
		return false;
	}
	$.post( "getdeactivatedUser.php?from="+from+"&to="+to, function( data ) {
		$( "#report" ).html( data );
	});
});
$( ".onoffswitch-checkbox" ).click(function() {
var id=$(this).attr('id');
if (this.checked) {       
  $.post( "activateUser.php?id="+id, function( data ) {
	 alert(data);
  });

}
else
{
   $.post( "deactiveUser.php?id="+id, function( data ) {
	 alert(data);
  });
}
});
	   </script>
  </body>
</html>