<?php include_once("header.php");
unset($_SESSION['book_var']);
unset($_SESSION['action']);
unset($_SESSION['ticket_id']);
unset($_SESSION['back']);
 ?>
  	<table width="100%" align="center" cellpadding="0px" cellspacing="0px" style="border:1px solid #A5DCFF ; font-size:12px;">			
	<tr>			  
	<td valign="top" width="28" align="center">
		<img src="./images/box_left_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" />	</td>
	
	<td valign="middle" height="41" style="background:url(./images/box_top_bg.jpg) repeat-x #FFFFFF;" align="left" class="box_head_blue" colspan="3"><strong>Transaction Error</strong></td>
	
	<td valign="top" width="28" align="center">
		<img src="./images/box_right_top.jpg" alt="Busbooking Box" title="Busbooking Box" border="0" width="28" height="41" />	</td>
</tr>
<tr><td valign="top" width="28" style="background:url(./images/box_left_bg.jpg) repeat-y #FFFFFF;"></td><td valign="top">
			  </tr>			  
			   <tr><td colspan="5">&nbsp;</td></tr>			  
              <tr>			  
			    <td>&nbsp;</td>				
				<td colspan="3" align="center" style="color:#006633;">
					
				</td>		
			   <td>&nbsp;</td>			   
              </tr>
			  
			  <tr><td colspan="5">&nbsp;</td></tr>			  
			  <tr>			  
			    <td>&nbsp;</td>				
				<td colspan="3" align="center">
					<b><font color="#FF0000">Your Transaction Failed. Try Again !!!</font></b>
				</td>		
			   <td>&nbsp;</td>			   
              </tr>   
          
			 <tr><td colspan="5">&nbsp;</td></tr>		 
               
			   <tr>
			  
			    <td>&nbsp;</td>
				
				<td colspan="3" align="center">
					<input type="button" value="Go Home" onClick="window.location.href='index.php'" />
				</td>
		
			   <td>&nbsp;</td>
			   
              </tr> 

            </table>
			
			<br />
			
<?php include_once("includes/footer.php"); ?>