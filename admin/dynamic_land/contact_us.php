<?php 
include_once'../../server/server.php';  
include_once '../includes/functions.php';
$obj=new admin_module($con); 

?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>

<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script type="text/javascript" src="../includes/javascriptFunctions.js"  ></script>
</head>
<body>
<?php  include_once '../includes/top_menu.php';   ?>
         <div class="row-fluid">
            <?php include_once '../includes/leftmenu.php'; ?>
                <div id="content" class="span9">
            
               
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">New Agent Registration</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table table-hover">
						              <thead>
						                <tr>
						                  <th>S. No</th>
						                  <th>Hotel Name</th>
						                  <th>Hotel Type</th>
                                          <th>Star Rating</th>
                                          <th>Hotel Style</th>
                                          <th>No Of Rooms</th>
                                          <th>Hotel Address</th>
                                          <th>Country</th>
						                  <th>Status</th>
						                </tr>
						              </thead>
						              <tbody>
                                      <?php $i=1; $adminRes=$obj->getCRSHotelList();
									  foreach($adminRes as $res)
									  {
									  ?>
						                <tr>
						                  <td><?php echo $i; ?></td>
						             <td><a href="edit_admin.php?id=<?php echo $res['id']; ?>"><?php echo $res['name']; ?></a></td>
						                  <td><?php echo $res['hotel_name']; ?></td>
						                  <td><?php echo $res['hotel_type']; ?></td>
                                          <td><?php echo $res['starRating']; ?></td>
                                          <td><?php echo $res['hotel_style']; ?></td>
                                          <td><?php echo $res['noofrooms']; ?></td>
                                          <td><?php echo $res['hotel_address']; ?></td>
                                          <td><?php echo $res['country']; ?></td>
                                           <td>
										   <div class="onoffswitch">
                                                            <input type="checkbox" name="crs_user" class="onoffswitch-checkbox" id="<?php echo $res['id']; ?>" <?php if($res['status']==1) echo 'checked'; ?>>
                                                            <label class="onoffswitch-label" for="<?php echo $res['id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
						                </tr>
                                        <?php $i++; } ?>
                                        
						             
						              </tbody>
						            </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /block -->
            </div>					
		</div> 
        </div><!-- /container -->
       <?php include '../includes/footer.php' ?>
   
  </body>
</html>