<?php
   include "includes/header.php";
   if(isset($_REQUEST['sp_id'])){
   $sp_id=$_SESSION['SP_id'];
   //$sql="SELECT * FROM serviceprovider_info ORDER BY SP_id";
   
   //Checking For seat availability
    $ress=mysql_query("select * from bookinginfo where pay_status=3");
    while($del=mysql_fetch_array($ress))
    {
   $value = strtotime($del['book_time'])."<br>";
    $cur_time=time()."<br>"; 
   $time_diff=($cur_time-$value)."<br>"; 
   $minutes = floor($time_diff % 3600 / 60);
   if($minutes>25)
   {
   mysql_query("delete from bookinginfo where auto_id='$del[auto_id]'");
   }
    }
   ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="searchBus();">
   <fieldset class="table-bor">
      <legend><strong>Bus Management</strong></legend>
      <table width="100%">
         <tr>
            <td>			
               <input type="hidden" id="search_str" name="search_str" value="<?php echo $_SESSION['SP_id']; ?>" onKeyUp="searchBus();" />		
            </td>
            <td>
               Bus Type: 
               <select name="bus_type" id="bus_type" onChange="searchBus();">
                  <option value="-1">All</option>
                  <?php 
                     $type_qry=mysql_query("SELECT * FROM bustypes ORDER BY typeName") ; 
                     while($row=mysql_fetch_array($type_qry)){
                     ?>
                  <option value="<?php echo $row['typeID'] ?>"><?php echo $row['typeName']; ?></option>
                  <?php } ?>
               </select>
            </td>
            <td>
               From: 
               <select name="from_bus" id="from_bus" onChange="searchBus();">
                  <option value="-1">None</option>
                  <?php
                     $from_qry=mysql_query("SELECT SR_source FROM service_routes GROUP BY SR_source ORDER BY SR_source");
                     while($from=mysql_fetch_array($from_qry)){
                     ?>
                  <option value="<?php echo $from['SR_source']; ?>"><?php echo get_city_name($from['SR_source']); ?></option>
                  <?php } ?>
               </select>
            </td>
            <td>
               To: 
               <select name="to_bus" id="to_bus" onChange="searchBus();">
                  <option value="-1">None</option>
                  <?php
                     $from_qry=mysql_query("SELECT SR_destination FROM service_routes GROUP BY SR_destination ORDER BY SR_destination");
                     while($from=mysql_fetch_array($from_qry)){
                     ?>
                  <option value="<?php echo $from['SR_destination']; ?>"><?php echo get_city_name($from['SR_destination']); ?></option>
                  <?php } ?>
               </select>
            </td>
            <td>
               Status: 
               <select name="bus_status" id="bus_status" onChange="searchBus();">
                  <option value="-1">None</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
               </select>
            </td>
         </tr>
         <tr>
            <td><input type="hidden" name="sp_id" id="sp_id" value="<?php echo $_SESSION['SP_id']; ?>" /></td>
         </tr>
      </table>
      <hr />
      <div id="loading"></div>
      <div id="container">
         <div class="data" id="gan"></div>
      </div>
      <script type="text/javascript">
         function submit_hidform(busid){
         document.block2form.bus_id.value=busid;
         document.block2form.submit();
         }
      </script>	 
      <form name="block2form" id="block2form" action="block_seats.php" method="post">
         <input type="hidden" id="sp_id" name="sp_id" value="<?php echo $_SESSION['SP_id']; ?>">
         <input type="hidden" id="bus_id" name="bus_id" value="">
         <input type="hidden" id="dat" name="dat" value="<?php echo date("d-m-Y"); ?>">
      </form>
   </fieldset>
   <?php
      include "includes/footer.php";
      }
      else {
       header("location:home.php");
      }
      ?>
</body>
