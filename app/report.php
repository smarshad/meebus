<?php
session_cache_limiter("private, must-revalidate");
session_start();
ob_start();
ini_set('max_execution_time', 3000);
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors',0);

session_cache_expire(15);
$cache_expire = session_cache_expire();
require_once("../config/config.php");
include_once("..includes/functions.php");

$id= $_REQUEST['aid'];

$funstiontype = 'bus';

$bookingtype	= '';	
$status			= '';
$tId			= '';
$userEmail		= '';
$domSor			= '';
$domDes			= '';
$intSor			= '';
$intDes			= '';
$busSor			= '';
$busDes			= '';
$from		 	= '';	
$to				= '';


$query = "select * from  booker_details WHERE user_id='$id' &&  delete_status = '1' ORDER BY booker_id DESC";

$data = mysql_fetch_array(mysql_query($query));
echo json_encode($data,1);
	

//**************************************************************************************
// -------------------- This function will return bus station name---------------------//
//**************************************************************************************
function showBusCityName($id)
{
    $from = mysql_query("select * from stations where station_id ='$id'");
    $row = mysql_fetch_array($from);
    return $row['station_name'];
}

//**************************************************************************************
// -------------------- This function will change date formate -----------------------//
//**************************************************************************************
function datecon($var)
{
    list($d, $m, $y) = explode('/', $var);
    $var = $y . '-' . $m . '-' . $d;
    return $var;
}

//**************************************************************************************
// --------------------- This function will display data tabel ------------------------//
//**************************************************************************************
function dataTableFunction()
{
    ?>
    <script>
        function getBusTicket(object)
        {
            var newwindow;
            $type = $(object).attr('alt');
            $type_temp = $type.split("|A|");
            $userType = $type_temp[0];
            $ticketType = $type_temp[1];
            $ticketId = $type_temp[2];
            var title = "View Ticket";
            var w = 1000;
            var h = 750;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            newwindow=window.open("agent_bus_ticket.php?id="+$ticketId+"&userType="+$userType+"&ticketType="+$ticketType ,title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
            if (window.focus)
            {newwindow.focus()}            
        }
        $(document).ready(function(){                                        
            var oTable=$('#myReports').dataTable( {
                "oLanguage": 
                    {
                    "sSearch": "Search all columns:",
                    "sLengthMenu": "Display <select><option value='10'>10</option><option value='30'>30</option><option value='50'>50</option><option value='100'>100</option></select> records per page",
                    "sZeroRecords": "Nothing found - sorry",
                    "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    "sInfoFiltered": "(filtered from _MAX_ total records)"
                },      
                "bLengthChange":true,
                "iDisplayLength": 30,
                "bJQueryUI": true,
                "bScrollCollapse": true,
                "sDom": 'T<"clear">lfrtip<"clear spacer">T',
                "oTableTools": {
                    "sSwfPath": "js/TableTools/media/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        "copy",       
                        {
                            "sExtends": "pdf",
                            "sPdfOrientation": "landscape",
                            "sPdfMessage": "Payment Gateway Report."
                        },
                        {
                            "sExtends": "xls",
                            "sxlsOrientation": "landscape",
                            "sXlsMessage": "Payment Gateway Report."
                        },
                        {
                            "sExtends": "csv",
                            "scsvOrientation": "landscape",
                            "sCsvMessage": "Payment Gateway Report."
                        },                      
                        "print",
                        "pdf"
                    ]
                }
            });
            oTable.fnSort( [ [0,'desc'] ] );
        });
    </script>
    <?php

}

//**************************************************************************************
?>