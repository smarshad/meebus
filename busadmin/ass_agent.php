<?php
include "includes/header.php";
$bus_id=mysql_real_escape_string($_REQUEST['busid']);
$fromcity=mysql_real_escape_string($_REQUEST['from']);
$tocity=mysql_real_escape_string($_REQUEST['to']);
$sp_id=$_SESSION['SP_id'];
if(isset($_POST['agent']))
{
$aid = mysql_real_escape_string($_POST['agent_id']);
$status=1;

$insert = mysql_query("INSERT INTO `agent_reqbusowner`(`sp_id`, `agent_id`, `bus_id`, `from_city`, `to_city`, `status`) "
        . "VALUES ('$sp_id','$aid','$bus_id','$fromcity','$tocity','$status')");

}
if(isset($_POST['unassign']))
{
$un= mysql_real_escape_string($_POST['aa']);

$delete = mysql_query("DELETE FROM `agent_reqbusowner` WHERE `id`='$un'");

}
?>
<body>
<fieldset class="table-bor">
<legend><strong>Assign Agent</strong></legend>

<table width="100%">
	<tr>
	<td align="left"><strong>Agent Name</strong></td>	
	<td align="left"><strong>Phone Number</strong></td>	
	<td align="left"><strong>Email ID</strong></td>
	<td align="left"><strong>City</strong></td>
       	<td align="left"><strong>Actions</strong></td>
</tr>
<tr>
<?php 
$query=mysql_query("SELECT * FROM `agents`");
while($row=mysql_fetch_array($query))
{
    $agentname=$row['agent_name'];
    $agentmob=$row['mobile_phone'];
    $agentemail=$row['email'];
    $agentcity=$row['city'];
    $aid=$row['agent_id'];

?>
      <?php 
                    $query1=mysql_query("SELECT * FROM `agent_reqbusowner` WHERE `sp_id`='$sp_id' AND `bus_id`='$bus_id' AND `agent_id`='$aid'");
while($row1=mysql_fetch_array($query1))
{
    $a1=$row1['status'];
    $a2=$row1['id'];
   
}        
                    ?>
<tr>
    <td align="left"><?php echo $agentname;?></td>	
	<td align="left"><?php echo $agentmob;?></td>	
	<td align="left"><?php echo $agentemail;?></td>
	<td align="left"><?php echo $agentcity;?></td>
                <td align="left">
                  
                  <?php if($a1 == 0)
                  {
                 ?>
                       <form method="post" action="">
                     <input type="hidden" id="agent_id" name="agent_id" value="<?php echo $aid; ?>">
                <input type="submit" name="agent" id="agent" value="Choose"> </form>
                     <?php
                  }
 else {?>
                    <label>Already Assigned</label>
     <form method="post" action="">
                     <input type="hidden" id="aa" name="aa" value="<?php echo $a2; ?>">
                <input type="submit" name="unassign" id="unassign" value="Unassign"> </form>               
 <?php
     
 }
?>  
                 </td>
</tr>

                               
    
    <?php 
    }
?>
</table>
<a href="busDetails.php?sp_id=<?php echo $sp_id;?>" class="btn btn-primary">Back</a>
           
<hr />

</fieldset>
<?php
include "includes/footer.php";

?>
</body>
