<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "banner"; 
include_once '../includes/functions.php';
$obj=new admin_module($con);  

?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<!--<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script>
$(document).ready(function(){
    $('input.origin').typeahead({
        name : 'sear',
        remote: {
            url : 'connection.php?query=%QUERY'
        }
        
    });
});
</script>-->
</head>
<body>
<?php  include_once '../includes/top_menu.php';   ?>

            <div class="row-fluid">

           <?php include_once '../includes/leftmenu.php'; ?>               
           <div class="container-fluid">
            <div class="row-fluid">
               <?php include_once '../includes/leftmenu.php'; ?>
                <div id="content" class="span9">
                <!-----Table--------------->
      			<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">List Banner</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <!--<div class="btn-group">
                                         <a href="#"><button class="btn btn-success">Add New <i class="icon-plus icon-white"></i></button></a>
                                      </div>-->
                                      <!--<div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
                                            <li><a href="#">Print</a></li>
                                            <li><a href="#">Save as PDF</a></li>
                                            <li><a href="#">Export to Excel</a></li>
                                         </ul>
                                      </div>-->
                                   </div>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                            <th>S.no</th>
                                                <th>Banner name</th>
                                                <th>Image</th>
                                                <th>Decription</th>
                                                <th>status</th>
                                                
                                                
          									</tr>
                                        </thead>
                                        <tbody>
                                       		<?php 
													$res=$obj->getBanner();
													$i=1;
													foreach($res as $banner)
													{
											?>
                                            <tr class="odd gradeX">
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $banner['banner_name'];?></td>
                                                <td><?php echo $banner['banner_img'];?></td>
                                                <td><?php echo $banner['description'];?></td>
      											<td><?php echo $banner['status'];?></td>
                                                
                                              <?php $i++;
													}
											  ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                     <!-----Table--------------->
                     </div>
                     </div>
                     </div> 
      			<!-- /container -->

       <?php include '../includes/footer.php' ?>
       
	</body>
</html>