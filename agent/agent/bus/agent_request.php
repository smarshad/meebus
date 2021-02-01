<?php 
   include_once'../../server/server.php';  
   //echo $_SESSION['agent']['log']['api_select'];
   // echo "<pre>"; print_r($_SESSION); echo "<pre/>"; exit;
   if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
   $_SESSION['common']['pagename'] = "Agent Request"; 
   if(isset($_SESSION['agent']['bus']['origin']))
   {
   unset($_SESSION['agent']['bus']['origin']);
   unset($_SESSION['agent']['bus']['destination']);
   }
   include_once '../includes/functions.php';
   $obj=new agent_module($con);  
   $commonUpdates = $obj->commonUpdates();
   
   if(isset($_POST['send']))
   {
   $bus_id=$_POST['bid'];	$ag_id=$_POST['agid'];
   $s_id=$_POST['sid'];	$f_id=$_POST['fromid'];
   $t_id=$_POST['toid'];
   $datum=array($s_id,$ag_id,$bus_id,$f_id,$t_id,'1');
   $req=$obj->insertRequest($datum); 
   header('location:agent_request.php');
   }
   
   if(isset($_POST['remove']))
   {
   $bus_id1=$_POST['bid'];
   $ag_id1=$_POST['agid'];
   $datum1=array($ag_id1,$bus_id1);
   $req1=$obj->removeRequest($datum1); 
   header('location:agent_request.php');
   }
   
   $other_data = '';
   $system_data=''; $system_data=array('Agent',$_SESSION['agent']['log']['id'],'Bus Search','Page Enter',$other_data);
   $system_log = $obj->systemlogs($system_data);  $system_data='';
   
   if(isset($_POST['search'])) 
   {
   	unset($_SESSION['agent']['bus']['origin']);
   	unset($_SESSION['agent']['bus']['destination']);
   }
   	
   if(isset($_POST['search']) && !isset($_SESSION['agent']['bus']['origin']) && !isset($_SESSION['agent']['bus']['destination'])) 
   {
   	$_SESSION['agent']['bus']['origin']=$_POST['origin'];
   	$_SESSION['agent']['bus']['destination']=$_POST['destination'];
   }
   	
   $origin =$_SESSION['agent']['bus']['origin'];
   $destination =$_SESSION['agent']['bus']['destination'];
   $agentid=$_SESSION['agent']['log']['id'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <?php  include_once '../includes/head1.php';   ?>
      <style type="text/css">
         .black_overlay{
         display: none;
         position: fixed;
         top: 0%;
         left: 0%;
         width: 100%;
         height: 100%;
         background-color: black;
         z-index:1001;
         -moz-opacity: 0.6;
         opacity:.80;
         filter: alpha(opacity=80);
         }
         .white_content {
         display: none;
         position: fixed;
         top: 12%;
         left: 10%;
         width: 80%;
         height: ;
         padding: 16px;
         border-radius:5px;
         background-color: white;
         z-index:1010;
         overflow: auto;
         }
         .pad-top{	
         padding-top:0px !important;
         }		
         .sname
         {
         width:160px;
         } 
         .left
         {
         width: 42px !important;
         } 	
      </style>
      <script type="text/javascript">
         //document.onkeydown = function (e) {  }
      </script>
   </head>
   <body>
      <?php include_once '../includes/top_menu.php'; ?>
      <div class="container-fluid">
         <div class="row-fluid">
            <?php include '../includes/leftmenu.php'; ?>
            <div class="span9" style="margin-left:0">
               <div class="span12" id="content" >
                  <div class="row-fluid">
                     <div class="block">
                        <div class="navbar navbar-inner block-header">
                           <div class="muted">List of Buses in this Route</div>
                           <!--<div class="muted srvdec"><?php echo ucfirst($_SESSION['agent']['bus']['origin'])." -> ".ucfirst($_SESSION['agent']['bus']['destination']); ?></div>-->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="span12" id="content" style="margin-top:-2px">
                  <div class="row-fluid">
                     <div class="block">
                        <div class="block-content collapse in busser">
                           <div class="span12">
                              <div id="page-wrap">
                                 <div id="users">
                                    <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example2">
                                       <thead>
                                          <tr>
                                             <th>S No</th>
                                             <th>Bus Name</th>
                                             <th>Operator Name</th>
                                             <th>Route</th>
                                             <th>Action</th>
                                             <th>Status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                             $sno = 1; 
                                             $report	=	$obj->getbusList(0); 
                                             foreach($report as $agent_report)
                                             { ?>
                                          <tr class="odd gradeX">
                                             <td><?php echo $sno; ?>
                                             <td class="center"><?php echo $agent_report['Bus_name']; ?></td>
                                             <td class="center"><?php 
                                                $spinfo=$agent_report['SP_id'];
                                                $SPId=$obj->getOperatorName($spinfo); 
                                                foreach($SPId as $agent_report1)
                                                {
                                                echo $agent_report1['SP_name']; 
                                                }?></td>
                                             <?php
                                                $fromcity=$agent_report['Bus_fromcity'];
                                                $tocity=$agent_report['Bus_tocity'];
                                                $sname=$obj->getStationList($fromcity); 
                                                foreach($sname as $sid)
                                                { 
                                                $originid=$sid['station_name'];
                                                }
                                                $sname1=$obj->getStationList($tocity); 
                                                foreach($sname1 as $sid1)
                                                { 
                                                $desid=$sid1['station_name'];
                                                
												}
                                                ?>
                                             <td class="center"><?php echo $originid.'-'.$desid; ?></td>
                                             <?php
                                                $bus_id=$agent_report['Bus_id'];
                                                $aa=array($agentid,$bus_id);
                                                    $dat=$obj->getRequestStatus($aa); 
                                                    
                                                if($dat!=0)
                                                {							 
                                                foreach($dat as $agent_report2) 
                                                {
                                                $status= $agent_report2['status'];
                                                if($status == '0')
                                                {
                                                ?>
                                             <td class="center">Request Sent</td>
                                             <td class="center">DECLINED</td>
                                             <?php
                                                }if ($status == '1') { ?>
                                             <td class="center">Request Sent</td>
                                             <td class="center">Awaiting for Reply</td>
                                             <?php                                                     
                                                }
                                                if ($status=='2') {
                                                   ?>
                                             <td class="center">
                                                <form method="post" action="">
                                                   <?php 
                                                      $b_id=$agent_report['Bus_id'];
                                                              ?>
                                                   <input type="hidden" name="agid" id="agid" value="<?php echo $agentid;?>" >
                                                   <input type="hidden" name="bid" id="bid" value="<?php echo $b_id;?>" >
                                                   <input type="submit" value="Click Here to Remove" class="btn btn-danger" name="remove" id="remove">
                                                </form>
                                             </td>
                                             <td class="center">Already added to your Platform</td>
                                             <?php
                                                }
                                                
                                                //me
                                                
                                                
                                                } 
                                                } 
                                                else {
                                                 ?>
                                             <td class="center">
                                                <form method="post" action="">
                                                   <?php 
                                                      $b_id=$agent_report['Bus_id'];
                                                      $report=$obj->getbusList1($b_id); 
                                                      foreach($report as $agent_report)
                                                      {
                                                        $sp_id=$agent_report['SP_id'];
                                                        $from_id=$agent_report['Bus_fromcity'];
                                                        $to_id=$agent_report['Bus_tocity'];
                                                      } 
                                                      ?>
                                                   <input type="hidden" name="agid" id="agid" value="<?php echo $agentid;?>" >
                                                   <input type="hidden" name="bid" id="bid" value="<?php echo $b_id;?>" >
                                                   <input type="hidden" name="sid" id="sid" value="<?php echo $sp_id;?>" >
                                                   <input type="hidden" name="fromid" id="fromid" value="<?php echo $from_id;?>" >
                                                   <input type="hidden" name="toid" id="toid" value="<?php echo $to_id;?>" >
                          <input type="submit" value="Click Here to Send Request"  class="btn btn-success rqst"  name="send" id="send">
                                                </form>
                                             </td>
                                             <td class="center">N/A</td>
                                             <?php } ?>                                               
                                          </tr>
                                          <?php $sno++; } ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /block -->
                  </div>
               </div>
               <?php 
                  // Array Filtter Part
                  if(isset($results['availableTrips'][0]) && $results['availableTrips'][0]!='')
                  {
                  $tmp_travels = array_unique($tmp_travels,SORT_REGULAR);
                  //echo "<pre>"; print_r($tmp_travels); echo "</pre>";
                  
                  $tmp_busType = array_unique($tmp_busType,SORT_REGULAR);
                  
                  $tmp_bording_bpName = array_unique($tmp_bording_bpName,SORT_REGULAR);
                  
                  $tmp_dropping_bpName = array_unique($tmp_dropping_bpName,SORT_REGULAR);
                   //exit;
                  ?>
               <div class="span12" id="content">
                  <div class="row-fluid">
                     <div class="block">
                        <ul class="navSection_tabs">
                           <li class="navSection_Hdr hidden-sm hidden-xs">
                              <span>Filter:</span>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-bus1 ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Bus Travels</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3"  style="font-size:12px !important;">
                                 <?php for($trC=0; $trC<count($_SESSION['fl_travels']); $trC++) { if(isset($_SESSION['fl_travels1'][$trC]) && $_SESSION['fl_travels1'][$trC]!='') { ?>
                                 <li><input id="Travels_filtter_<?php echo $trC; ?>" name="Travels_filtter[]" onClick="return filtterFunction();" class="Travels_filtter" value="<?php echo str_replace(')','',str_replace('(','',str_replace('.','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$_SESSION['fl_travels1'][$trC])))))); ?>" type="checkbox"><span><?php echo $_SESSION['fl_travels1'][$trC]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-bus-seat ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Bus Type</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC1=0; $trC1<count($_SESSION['fl_bustype']); $trC1++) { if(isset($_SESSION['fl_bustype1'][$trC1]) && $_SESSION['fl_bustype1'][$trC1]!='') { ?>
                                 <li><input id="Travels_Type_filtter_<?php echo $trC1; ?>" name="Travels_Type_filtter[]" onClick="return filtterFunction();" class="Travels_Type_filtter" value="<?php echo str_replace('.','_',str_replace('+','_',str_replace(')','_',str_replace('(','_',str_replace('&','_',str_replace('/','_',str_replace(' ','_',$_SESSION['fl_bustype1'][$trC1]))))))); ?>" type="checkbox"><span><?php echo $_SESSION['fl_bustype1'][$trC1]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-boarding ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Boarding Point</span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC2=0; $trC2<count($tmp_bording_bpName); $trC2++) { if(isset($tmp_bording_bpName[$trC2]) && $tmp_bording_bpName[$trC2]!='') { ?>
                                 <li><input id="Travels_Boarding_filtter_<?php echo $trC2; ?>" name="Travels_Boarding_filtter[]" onClick="return filtterFunction();" class="Travels_Boarding_filtter" value="<?php echo str_replace('&','_',str_replace('/','_',str_replace(' ','_',$tmp_bording_bpName[$trC2]))); ?>" type="checkbox"><span><?php echo $tmp_bording_bpName[$trC2]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0);" class="navSection_link">
                              <span class="dib">
                              <i class="fl icon-dropping ico22 lh1-2 greyDr"></i>
                              <span class="fl pad5 hidden-xs">Dropping Point </span>
                              <i class="icon0-arrow-down0 ico10 lh1-2 fl downArrFilter hidden-sm hidden-xs"></i>
                              </span>
                              </a>
                              <ul class="navSection_secondary col-md-3 col-sm-3" style="font-size:12px !important;">
                                 <?php for($trC3=0; $trC3<count($tmp_dropping_bpName); $trC3++) { if(isset($tmp_dropping_bpName[$trC3]) && $tmp_dropping_bpName[$trC3]!='') { ?>
                                 <li><input id="Travels_Droping_filtter_<?php echo $trC3; ?>" name="Travels_Droping_filtter[]"  onClick="return filtterFunction();" class="Travels_Droping_filtter" value="<?php echo str_replace('&','_',str_replace('/','_',str_replace(' ','_',$tmp_dropping_bpName[$trC3]))); ?>" type="checkbox"><span><?php echo $tmp_dropping_bpName[$trC3]; ?></span></li>
                                 <?php } } ?>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <?php } ?>
            </div>
         </div>
         <?php 
            $error_logs.= "Page : Searchresult.php ,<br/>POST Value :".implode('^',$_POST)."<br/>Session Value : Common URL : ".$_SESSION['common']['url']."<br/> Page Name : ".$_SESSION['common']['pagename']."<br/> Agent ID : ".$_SESSION['agent']['log']['id'];
            include '../includes/footer.php' ?>		
      </div>
      <!-- /container -->
      <div id="seat" class="white_content"  style="min-height:50%; height:auto;">
      </div>
      <div id="seat_block" class="black_overlay"></div>
      </div>
      <script type="text/javascript">
         function showagentfun(val)
         {
           if(val==1)
           {
               $('#showagentck').hide();
               $('#showagentck1').show();
               $('.showagent').show();	
           }	
           else
           {
               $('#showagentck1').hide();
               $('#showagentck').show();
               $('.showagent').hide();	
           }
           return true;
         }
         
      </script>
      <script>
         $(document).ready(function(){                             
         // modify search block start        
         $(".modifytxt").click(function() {
              $( "#modifysearch" ).toggle( "slow", function() {
              });
         });
         });
      </script>
      <script type="text/javascript">
         function travelsdd() { $('#Ttravels_filtter').show(200); return true; }
         function bustypedd() { $('#bustype_filtter').show(200); return true; }
         function departdd() {  $('#depart_filtter').show(200);  return true; }
         function arrivaldd() {  $('#arrival_filtter').show(200);  return true; }
         
         
         function filtter1(val)
           { 
           alert(val);
               var checkedString = $("input[name='arrival_ck[]']:checked").map(function() { return this.value; }).get().join();
               checkedString1  = checkedString.split(',');
               $('.fitter').hide(); 
                   if(checkedString1!='') 
                       { 
                           for(i=0; i<checkedString1.length; i++)
                               {
                                   $('.'+checkedString1[i]).show();  	
                               }
                               $('#arrival_filtter').hide(200); 
                       }
                   else 
                       {
                           $('.fitter').show(); 	
                           $('#arrivalt_filtter').hide(200); 
                       }	
         return true;
         }
         function filtter2(val)
           { 
           alert(val);
               var checkedString = $("input[name='depart_ck[]']:checked").map(function() { return this.value; }).get().join();
               checkedString1  = checkedString.split(',');
               $('.fitter').hide(); 
                   if(checkedString1!='') 
                       { 
                           for(i=0; i<checkedString1.length; i++)
                               {
                                   $('.'+checkedString1[i]).show();  	
                               }
                               $('#depart_filtter').hide(200); 
                       }
                   else 
                       {
                           $('.fitter').show(); 	
                           $('#depart_filtter').hide(200); 
                       }	
         return true;
         }
         function filtter3(val)
           { 
           alert(val);
               var checkedString = $("input[name='bustype_ck[]']:checked").map(function() { return this.value; }).get().join();
               checkedString1  = checkedString.split(',');
               $('.fitter').hide(); 
                   if(checkedString1!='') 
                       { 
                           for(i=0; i<checkedString1.length; i++)
                               {
                                   $('.'+checkedString1[i]).show();  	
                               }
                               $('#bustype_filtter').hide(200); 
                       }
                   else 
                       {
                           $('.fitter').show(); 	
                           $('#bustype_filtter').hide(200); 
                       }	
         return true;
         }
         
         function filtter(val) 
           { 
               var checkedString = $("input[name='travels_ck[]']:checked").map(function() { return this.value; }).get().join();
               checkedString1  = checkedString.split(',');
               $('.fitter').hide(); 
                   if(checkedString1!='') 
                       { 
                           for(i=0; i<checkedString1.length; i++)
                               {
                                   //alert(checkedString1[i]); 
                                   $('.'+checkedString1[i]).show();  	
                               }
                               $('#Ttravels_filtter').hide(200); 
                       }
                   else 
                       {
                           $('.fitter').show(); 	
                           $('#Ttravels_filtter').hide(200); 
                       }	
         return true;
         }
         
         function hideDiv(e) {
           if (!$(e.target).is('#f1') && !$(e.target).parents().is('#f1')) {
               $('#Ttravels_filtter').hide();
               
           }
           
           if (!$(e.target).is('#f2') && !$(e.target).parents().is('#f1')) {
               $('#bustype_filtter').hide();
               
           }
           
         }
         $(document).on('click', function(e) {
           hideDiv(e);
         });
         
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
              $(".book").click(function(){
                  var otherdata = $(this).prop("title");	
                  $('#seat').show();
         $('#seat').html('<div class="cssload-preloader"><div class="cssload-preloader-box"><div>S</div><div>E</div><div>A</div><div>R</div><div>C</div><div>H</div><div>I</div><div>N</div><div>G</div><div>&nbsp;</div><div>B</div><div>U</div><div>S</div></div></div>');
                  $('#seat_block').show();
                    var id=$(this).attr('id');
                    var check=id.split('_');
                    if(check[1]=='ownbus')
                    {
                         $.ajax({
                            type:"post",
                            url:"../../bus/ownbus_lib/seat-availability.php",
                            data:"id="+check[0]+"&otherdata="+otherdata,
                            success:function(data){
                               $("#seat").html(data);
                            }
                        });
                    }
                    else
                    {
                        $.ajax({
                            type:"post",
                            url:"../../bus/bus-library/seat-availability.php",
                            data:"id="+id+"&otherdata="+otherdata,
                            success:function(data){
                               $("#seat").html(data);
                            }
                        });
                    }
         
              });
         });
      </script>
      <script>
         function seat_check(val,val1,val2)
         {
         var jdate=val2;
         var xmlhttp;
         if (window.XMLHttpRequest)
         {
         xmlhttp=new XMLHttpRequest();
         }
         else
         {
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
         xmlhttp.onreadystatechange=function()
         {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
           var arr=xmlhttp.responseText;
           var det=arr.split("^");
           //var seat=det[1].split("|");//alert(seat[0]);
           document.getElementById("pass_detail").innerHTML=det[2];
           document.getElementById("err_seat").innerHTML=data[0];
           document.getElementById("err_seat1").innerHTML=data[1];
         }
         }
         xmlhttp.open("GET","../../bus/ownbus_lib/seat-fare.php?seat="+val+"&id="+val1+"&dat="+jdate,true);
         xmlhttp.send();
         }
         
         function seat_display(val,vipval)
         {   
         
         seat_no = "seat_"+val;
         
         if($('#seat_'+val).is(':checked'))
         {
           $('#seat_'+val).attr("checked", false);
           
           var array = $('#total_seats').val().split(",");
               i1 = 0;
               var a='';
               for(var i= array.length - 2; i >=0; i--) 
               {
                   if(array[i]==val) 
           {
                       if(vipval==1) {
                           alert("This is VIP seat");
                           var vip_fare = parseInt(document.getElementById('vip_fare').value);
                           var fare = vip_fare;
                           
                           
                       } else {
                           var bus_fare = parseInt(document.getElementById('bus_fare').value);
                           var fare = bus_fare;
                       }
                       
                       tot='';
                       tot = $('#total_amt').val();
                       tot=tot-fare;
                       $('#total_amt').val(tot);
                                  
                   }
                   else 
                   {
                       if(array[i]!='' &&array[i]!='undefined')
                       {
                           a=a+''+array[i].trim()+',';	
                           
                       }
                   }
                   
               }
               $('#total_seats').val(a.trim());
         
                   if(tot < 0){
                    tot=0; }	
         }
         else 
         {
               $('input[type="checkbox"][name="'+seat_no+'"]').attr('checked', 'checked');
               var s_no = document.getElementById(seat_no).value; 
           
               if(vipval==1) {
                   alert("This is VIP seat");
                   var vip_fare = parseInt(document.getElementById('vip_fare').value);
                   var fare = vip_fare;
                   
                   
               } else {
                   var bus_fare = parseInt(document.getElementById('bus_fare').value);
                   var fare = bus_fare;
         
               }
               
               if(document.getElementById(seat_no).checked) {
               
               var array = $('#total_seats').val().split(",");
               
               document.getElementById('total_seats').value += s_no+",";
               tot=tot+fare; 	
               
               }
               else
               {
                   tot=tot-fare;
                   var arr = document.getElementById('total_seats').value;
                   
                   var seatno = arr.split(",");
                   
                   for( var i=0; i<seatno.length; i++ )
                   {
                       if(seatno[i] == s_no )			
                           seatno.splice(i,1);		
                   }		
                   document.getElementById('total_seats').value = seatno;		
                   if(tot < 0){
                    tot=0; }		 
               }			
               document.getElementById('total_amt').value = tot;	
         }
         
         }
      </script>
      <script type="text/javascript">	
         function filtterFunction()
         {
             $('.bus_filt').hide();
             var checked = [];
             var datas = [];
             $("input[name='Travels_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Type_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Boarding_filtter[]']:checked").each(function () { checked.push($(this).val()); });
             $("input[name='Travels_Droping_filtter[]']:checked").each(function () { checked.push($(this).val()); });			
             if(checked.length>0)
             {
                 for(i=0; i<checked.length; i++)
                 {
                     $('.'+checked[i]).show();	
                 }
             }
             else 
             {
                 $('.bus_filt').show();
         
             }	
             return true;
         }
         
      </script>
   </body>
</html>
