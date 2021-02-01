<?php 
include_once'../../server/server.php';  
$_SESSION['common']['pagename'] = "banner"; 
include_once '../includes/functions.php';
$obj=new admin_module($con); 

if(isset($_POST['submit']) && $_POST['submit']=='Submit') 
{
	$title=$_POST['title'];
	//$image=$_POST['image'];
	$des=$_POST['description'];
	if(($_FILES['image']['type']=='image/png') || ($_FILES['image']['type']=='image/jpg') ||($_FILES['image']['type']=='image/jpeg'))
	{
		$type=explode('/',$_FILES['image']['type']);
		$image='banner_' .time().'.'.$type[1];
		if($_FILES['image']['error'] > 0)
		{
			echo "return code";
		}
		else if (move_uploaded_file($_FILES['image']['tmp_name'],'../../images/slider/'.$image))
		{
			$data=array($title,$image,$des,1);
			$res=$obj->addBanner($data);
			if($res==1)
			{		
				$_SESSION['superadmin']['reg_masg']="Banner Added Successfully";
			}
			else
			{
				$_SESSION['superadmin']['reg_masg']="Please Check Your Details";
			}
	    }     
	}
	else
	{
		$_SESSION['superadmin']['reg_masg']='please upload image for logo';
	}
	$msg=$_SESSION['superadmin']['reg_masg'];
	
}
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php';   ?>
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
                                <div class="muted pull-left">Home Page Banner Management</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span3"></div>
                                <div class="span6">
                                     <form action="" method="post" enctype="multipart/form-data">
                                     <?php if(isset($msg))
										echo "<p style='font-weight:bold;'>".$msg."</p>"; 
										unset($msg); 
									 ?>
                                       <div class="control-group">
                                     <input type="text" name="title" placeholder="Banner Title" />
                                     </div>
                                    
                                       <div class="control-group">
                                     <input type="file"  name="image" required/>
                                     </div>
                                     
                                     <div class="control-group">
                                     <label>Description</label>
                                     <textarea name="description" required></textarea>
                                     </div>
                                     
                                       <div class="control-group">
                                     <input type="submit"   class="btn btn-primary" name="submit" value="Submit" />
                                     </div>

                                     
                                     </form>

                                </div>
                                <div class="span3"></div>
                            </div>
                        </div>
                        <!-- /block -->
                  
               
            </div>					
		</div> <!-- /container -->
        </div>
       <?php include '../includes/footer.php' ?>

	</body>
</html>