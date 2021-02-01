<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['cid']))
{
	
	$cid=$_REQUEST['cid'];
		
	 $mqry="SELECT a.*,b.tolocint as tolocint,b.status as stt FROM tbl_courier as a,tbl_courier_track as b WHERE b.cid=a.cid and a.cid=".$cid;
	//echo $company_qry ; exit ;
	
	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	
//	print_r($data) ; // exit ;
}
if(isset($_REQUEST['cid']))
{
	
	$cid=$_REQUEST['cid'];
		
	$mqry="SELECT * FROM tbl_offices";
	
	
	$mem_rs=mysql_query($mqry);
	
	$data1=mysql_fetch_array($mem_rs);
}


	if(isset($_REQUEST['submit']))
	{
		$off=$_SESSION['office'];
	
		trim(extract($_POST)) ;
		if(($data['toloc']==$frmlocint)&&($status=='Completed')){
			$sqls="insert into tbl_courier_track (cons_no,cid,frmlocint,tolocint,status,comments,stat,driver,vname,vno,umode,addby) values
		('$cons_no','$cid','$frmlocint','$tolocint','$status','$comments','1','$drivers','$vname','$vno','$umode','$off')";
		$sq=mysql_query("update tbl_courier set status='Completed' where cid='$cid'");
		 
			
		}else{
		$sqls="insert into tbl_courier_track (cons_no,cid,frmlocint,tolocint,status,comments,stat,driver,vname,vno,umode,addby) values
		('$cons_no','$cid','$frmlocint','$tolocint','$status','$comments','0','$drivers','$vname','$vno','$umode','$off')";
		}
		//$sql="insert into tbl_courier_track (cid, cons_no, current_city, status, comments)                        values('$cid','$cons_no','$OfficeName','$status','$comments')";

		
	$upd = mysql_query($sqls) ;
	
	if($upd)
	{
		header("location:courier-list.php?us") ;
	}
	else if($upd)
	{
		header("location:courier-list.php?ue") ;
	}
	
	}


?>
<?php
//$loc="'".$data['frmloc']."',";
$loc="";
 $mqrys="SELECT * FROM tbl_courier_track where cid=".$cid;
	
	
	$mem_r1=mysql_query($mqrys);
	
	while($datass=mysql_fetch_array($mem_r1)){
		
		$loc.="'".$datass['frmlocint']."',";
		$fin1=$datass['frmlocint'];
		$fin=$datass['tolocint'];
		$driv=$datass['driver'];
		$stat=$datass['status'];$comm=$datass['comments'];$umode=$datass['umode'];$vname=$datass['vname'];$vno=$datass['vno'];
	}
	 $loc=$loc."'".$fin."',";
	 $lc=trim($loc,',');
	 if($fin==''){$fin=$fin1;}
?>
<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>Edit Shipment </strong></legend> 
		
<table class="ds_box" id="ds_conclass" style="display: none;" cellpadding="0" cellspacing="0"> 

  <tbody><tr> 

    <td id="ds_calclass"> </td> 

  </tr> 

</tbody></table> 

  <br>

  <table border="0" align="center" width="98%">

    <tbody><tr>

      <td class="Partext1" bgcolor="F9F5F5" align="center"><strong>Edit Shipment </strong></td>

    </tr>

  </tbody></table>

  <br>

  <table bgcolor="#EEEEEE" cellpadding="2" cellspacing="2" align="center" width="75%"> 

    

    <tbody><tr>

      <td class="Partext1" bgcolor="#FFFFFF" align="right"><div align="center">

        <table border="0" cellpadding="1" cellspacing="1" width="80%">

          <tbody><tr>

            <td width="55%"><div align="left" class="style3">Shipper Name : </div></td>

            <td width="45%"><div align="left" class="style3">

           <?php echo $data['ship_name'] ; ?>
            </div></td>

          </tr>

          <tr>

            <td><div align="left" class="style3">Shipper Phone : </div></td>

            <td><div align="left" class="style3"><?php echo $data['phone'] ; ?></div></td>
          </tr>

          <tr>

            <td><div align="left" class="style3">Shipper Address : </div></td>

            <td><div align="left" class="style3"><?php echo $data['s_add'] ; ?></div></td>
          </tr>
		   <tr>

            <td><div align="left" class="style3">From Location : </div></td>

            <td><div align="left" class="style3"><?php echo $data['frmloc'] ; ?></div></td>
          </tr>
        </tbody></table>

      </div></td>

      <td class="Partext1" bgcolor="#FFFFFF">
	  <div align="center">

        <table border="0" cellpadding="1" cellspacing="1" width="80%">

          <tbody><tr>

            <td width="55%" class="style3"><div align="left">Receiver Name : </div></td>

            <td width="45%" class="style3"><div align="left"><?php echo $data['rev_name'] ; ?></div></td>

          </tr>

          <tr>

            <td class="style3"><div align="left">Receiver Phone : </div></td>

            <td class="style3"><div align="left"><?php echo $data['r_phone'] ; ?></div></td>
          </tr>

          <tr>

            <td class="style3"><div align="left">Receiver Address : </div></td>

            <td class="style3"><div align="left"><?php echo $data['r_add'] ; ?></div></td>
          </tr>
		  <tr>

            <td><div align="left" class="style3">To Location : </div></td>

            <td><div align="left" class="style3"><?php echo $data['toloc'] ; ?></div></td>
          </tr>
        </tbody></table>
      </div></td>

    </tr>

    <tr>

      <td class="Partext1" bgcolor="#FFFFFF" align="right">&nbsp;</td>

      <td class="Partext1" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>

    <tr> 

      <td class="style3" bgcolor="#FFFFFF" align="right" width="336">Consignment / Invoice No  : </td> 

      <td class="style3" bgcolor="#FFFFFF" width="394"><font color="#FF0000"><?php echo $data['cons_no'] ; ?></font>&nbsp;</td> 
    </tr> 

    <tr>

      <td class="style3" bgcolor="#FFFFFF" align="right">Ship Type  :</td>

      <td class="style3" bgcolor="#FFFFFF"><?php echo $data['type'] ; ?> &nbsp;</td>
    </tr>

    <tr>

      <td class="style3" bgcolor="#FFFFFF" align="right">Weight :</td>

      <td class="style3" bgcolor="#FFFFFF"> <?php echo $data['weight'] ; ?> &nbsp;kg</td>
    </tr>

    

    <tr>

      <td class="style3" bgcolor="#F3F3F3" align="right">Booking Mode :</td>

      <td class="style3" bgcolor="#FFFFFF"> <?php echo $data['book_mode'] ; ?> &nbsp;</td>
    </tr>

    <tr>

      <td class="style3" bgcolor="#F3F3F3" align="right">Total freight : </td>

      <td class="style3" bgcolor="#FFFFFF"><?php echo $data['freight'] ; ?> &nbsp;Rs.</td>
    </tr>

    <tr>

      <td class="style3" bgcolor="#F3F3F3" align="right">Mode : </td>

      <td class="style3" bgcolor="#FFFFFF"> <?php echo $umode ; ?> </td>
    </tr> 
    <tr>
            <td class="TrackMediumBlue" align="right">Vehicle Name : </td>
            
            <td><?php echo $vname; ?></td>
          </tr>
		  <tr>
            <td class="TrackMediumBlue" align="right">Vehicle Number : </td>
            
            <td><?php echo $vno ; ?></td>
          </tr>
    <tr> 

      <td class="style3" bgcolor="#FFFFFF" align="right">Pickup Date/Time  :</td> 

      <td class="style3" bgcolor="#FFFFFF"><?php echo $data['pick_date'] ; ?> -<span class="gentxt"><?php echo $data['pick_time'] ; ?> 

        </span> </td> 
    </tr> 
    <tr> 

      <td class="style3" bgcolor="#FFFFFF" align="right">Current Location  :</td> 

      <td class="style3" bgcolor="#FFFFFF"><?php echo $fin ; ?>   </td> 
    </tr> 
	<tr> 

      <td class="style3" bgcolor="#FFFFFF" align="right">Vehicle Driver Details  :</td> 

      <td class="style3" bgcolor="#FFFFFF"><?php echo $driv ; ?>   </td> 
    </tr> 
    <tr> 
      <td class="style3" bgcolor="#FFFFFF" align="right">Status :</td> 

      <td class="style3" bgcolor="#FFFFFF">&nbsp; <?php echo $stat ; ?> </td> 
    </tr> 

     

    <tr> 

      <td class="style3" bgcolor="#FFFFFF" align="right" valign="top">Comments :</td> 

      <td class="style3" bgcolor="#FFFFFF">&nbsp; <?php echo $comm ; ?> </td> 
    </tr> 
  </tbody></table> 

  <span class="Partext1"><br>
   </span><span class="Partext1"><br>

  <br>  

  </span>
<?php
if($data['status']!='Completed'){ ?>
  <form action="" method="post" name="frmShipment" id="frmShipment"> 

  <table bgcolor="#EEEEEE" cellpadding="2" cellspacing="2" align="center" width="75%">

    <tbody><tr>

      <td colspan="3" bgcolor="#FFFFFF" align="right"><div class="Partext1" align="center"><strong>UPDATE STATUS </strong>

</div></td>

    </tr>

    <tr>
      
      <td colspan="3" bgcolor="#FFFFFF" align="right"></td>
    </tr>
	

<tr>

      <td class="Partext1" bgcolor="#FFFFFF" align="right" width="25%">Current Vehicle Location:</td>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF">
<input type="text" name="frmlocint" value="<?php echo $fin; ?>" readonly>
             </td>
    </tr>

    <tr>

      <td class="Partext1" bgcolor="#FFFFFF" align="right" width="25%">To New Vehicle Location:</td>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF">

        <select name="tolocint">
		<option value="">---</option>
			<?php
			 $mqrys1="SELECT * FROM tbl_offices where off_name NOT IN(".$lc.")";
	
	
	$mem_r11=mysql_query($mqrys1);
	
	while($datass1=mysql_fetch_array($mem_r11)){
		?>
			<option value="<?php echo $datass1['off_name']; ?>" <?php if($datass1['off_name']==$fin){?> selected=selected<?php } ?>><?php echo $datass1['off_name']; ?></option>
	<?php } ?>
	</select>      </td>
    </tr>
	<tr>
            <td class="Partext1" bgcolor="#FFFFFF" align="right" width="25%">Mode : </td>
            
            <td><select name="umode" id="umode">
                <option selected="selected" value="Bus">Bus</option>
                <option value="van">Van</option>
            </select></td>
          </tr>
<tr>
            <td  class="Partext1" bgcolor="#FFFFFF" align="right" width="25%">Vehicle Name : </td>
            
            <td colspan="2"><input type="text" name="vname"></td>
          </tr>
		  <tr>
            <td  class="Partext1" bgcolor="#FFFFFF" align="right" width="25%">Vehicle Number : </td>
            
            <td colspan="2"><input type="text" name="vno"></td>
          </tr>
    <tr>

      <td class="Partext1" bgcolor="#FFFFFF" align="right">Status: </td>

      <td class="Partext1" bgcolor="#FFFFFF" width="26%">


<select name="status">

<option value="In Transit">In Transit</option>

<option value="Landed">Landed</option>

<option value="Delayed">Delayed</option>

<option value="Completed">Completed</option>
<option value="Onhold">Onhold</option>
</select>

<br></td>
      
    </tr>
	<tr>
            <td bgcolor="#FFFFFF" align="right"><span class="Partext1">Vehicle Driver Details  :</span></td>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF"><input name="drivers" id="drivers" type="TEXT" placeholder="Driver Name & Mobile"></td>
          </tr>
    <tr>
      <td bgcolor="#FFFFFF" align="right"><span class="Partext1">Comments:</span></td>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF">
	  <textarea name="comments" cols="40" rows="3" id="comments"></textarea></td>
    </tr>

    <tr>

      <td bgcolor="#FFFFFF" align="right">&nbsp;</td>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF">

       

          <input name="cid" id="cid" value="<?php echo $cid; ?>" type="hidden">

          <input name="cons_no" id="cons_no" value="<?php echo $data['cons_no']; ?>" type="hidden">  
          
          <input name="submit" value="Submit" type="submit">    </td>
    </tr>

    <tr>

      <td colspan="3" bgcolor="#FFFFFF" align="right"><div align="center">


      </div></td>
      </tr>
  </tbody></table>

  <br>

</form>   <?php } ?> </td>

  </tr>

  <tr>

    <td><table border="0" cellpadding="0" cellspacing="0" align="center" width="900">
  <tbody><tr>
    <td bgcolor="#2284d5" height="40" width="476">&nbsp;</td>
    <td bgcolor="#2284d5" width="304"><div align="right"></div></td>
  </tr>
</tbody></table>
</td>

  </tr>

</tbody></table>
		
		
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>