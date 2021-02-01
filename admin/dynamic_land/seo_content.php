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
                                <div class="muted pull-left">list SEO Contents</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12 result">                                   
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                            <th>S.no</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>status</th>
                                                
                                                
          									</tr>
                                        </thead>
                                        <tbody>
                                       
                                            <tr class="odd gradeX">
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
		</div> 
        </div><!-- /container -->
       <?php include '../includes/footer.php' ?>
   
  </body>
</html>