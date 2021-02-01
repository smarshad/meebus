<?php  
include_once'../server/server.php';  
include_once 'includes/functions.php';
$obj=new admin_module($con);  
$from_date1=explode('/',$_GET['from']);
$from_date = $from_date1[2].'-'.$from_date1[1].'-'.$from_date1[0];
$from=$from_date.' 00:00:00';
$to_date1=explode('/',$_GET['to']);
$to_date = $to_date1[2].'-'.$to_date1[1].'-'.$to_date1[0];
$to=$to_date.' 23:59:59';
$data=array(0,$from,$to);
$result=$obj->getUserByDate($data);
?>
<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Deactive Users</div>
                                <?php /*?><a href="javascript:void(0);" onclick="return createXlsReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/excel.png" /></a> 
                                <a href="javascript:void(0);" onclick="return createPDFReport('<?php echo $from;?>','<?php echo $to; ?>','<?php echo $area_id; ?>','<?php echo $channel_id; ?>','<?php echo $distributor_id; ?>');"><img style="border:0px; float:right; margin-right:10px;margin-top:10px;" border=0 src="images/pdf.png" width="40px" /></a><?php */?>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                      <?php
											if($result!='') {
												?>
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
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
											//echo '<pre>'; print_r($adminRes); echo '</pre>';
											foreach($result as $res)
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
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
<script>
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