<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "Add_banner"; 
include_once '../includes/functions.php';
$obj=new admin_module($con);  

?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
<script type="text/javascript" src="<?php echo $base_url; ?>js/typeahead.min.js"></script>
<script>
$(document).ready(function(){
    $('input.origin').typeahead({
        name : 'sear',
        remote: {
            url : 'connection.php?query=%QUERY'
        }
        
    });
});
</script>
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
                                <div class="muted pull-left">SEO Management</div>
                            </div>
                            <div class="block-content collapse in">
                               
                                <div class="span6">
                                  <form class="form-horizontal">
                                      <fieldset>
                                       
                                        <div class="control-group">
                                          <label for="focusedInput" class="control-label">Enter Title</label>
                                          <div class="controls">
                                            <input type="text" value="Enter title" id="" class="input-xlarge focused">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Enter Description</label>
                                          <div class="controls">
                                           <input type="text" value="Enter Description" id="" class="input-xlarge focused">
                                          </div>
                                        </div>
                                      
                                        <div class="form-actions">
                                          <button class="btn btn-primary" type="submit">Save changes</button>
                                          <button class="btn" type="reset">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        <!-- /block -->
                         <!-----Table--------------->  
      			<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">list bannes</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12 result">                                   
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                            <th>S.no</th>
                                                <th>Bnner name</th>
                                                <th>Image</th>
                                                <th>Decription</th>
                                                <th>status</th>
                                                
                                                
          									</tr>
                                        </thead>
                                        <tbody>
                                       
                                            <tr class="odd gradeX">
                                            <td></td>
                                            <td></td>
                                                <td></td>
                                                <td></td>
      											<td></td>
                                                <td></td>
                                              
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
		</div> <!-- /container -->
        </div>
       <?php include '../includes/footer.php' ?>
       <script>
	   $( "#search_bus" ).click(function(){
		   var origin=$("#origin").val();
		   var destination=$("#destination").val();
		   
		   if(origin=='')
		{
			alert("Please enter Origin");
			return false;
		}
		else if(destination=='')
		{
			alert("Please enter Destination");
			return false;
		}
		     else
		{
			$( "#target" ).submit();
		} 
  			 
	   });
	   </script>
	</body>
</html>