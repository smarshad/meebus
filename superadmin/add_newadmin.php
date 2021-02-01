<?php include_once("includes/header.php");
   include_once("../database/connect.php"); 
   if(isset($_POST['Submit']) && $_POST['Submit']=='Submit')
   {
   	//echo "bghjbvjvb ";
   	$name=$_POST['adminname'];
   	$username=$_POST['username'];
   	$password=md5($_POST['password']);
   	$sql="INSERT INTO adminlogin SET name='$name',admin_username='$username',admin_password='$password'";
   	$add=mysql_query($sql);
   	if($add)
   	{
   		header('location:admin_mage.php');	
   	}
   }
   ?>
<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="search_Usr();">
   <form action="" method="post" name="add">
      <fieldset class="table-bor">
         <legend><strong>Add New Admin</strong></legend>
         <table cellspacing="2" cellpadding="10">
            <tr>
               <td height="36" align="left">Admin Name</td>
               <td align="left"><input name="adminname" type="text" class="textbox" value=""></td>
            </tr>
            <tr>
               <td height="36" align="left">Usename</td>
               <td align="left"><input name="username" type="text" class="textbox" value=""></td>
            </tr>
            <tr>
               <td height="36" align="left">Password</td>
               <td align="left"><input name="password" type="text" class="textbox" value=""></td>
            </tr>
            <tr>
               <td height="36" colspan="2" align="center"><input name="Submit" type="submit" value="Submit"></td>
            </tr>
         </table>
      </fieldset>
   </form>
</body>
<?php include "includes/footer.php"; ?>
