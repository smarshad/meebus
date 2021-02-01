<?php
if (!$qry1 = mysql_query('SELECT * FROM stations ORDER BY station_name'))
    exit(mysql_error());
while ($res1 = mysql_fetch_array($qry1))
{
    $c = $res1['station_id'];
    $station_name[$c] = $res1['station_name'];
    unset($c);
}
?>

<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $( "#dep" ).datepicker({
            showOn: "button",
            buttonImage: "datepicker/calendar.gif",
            buttonImageOnly: true,
            buttonText:'Departure'
        });
        $('#originid').change(function(){
            $v=$(this).val();
            $('#destinationid_bus').empty().html('<option value="">Loading...</option>');
            $('#dest_load').show();
            $('#dest_load').html('<input type="image" src="images/loader/preloader.gif">');
            $.post('bus-getstationlist.php?id='+$v, function(data) {
                $('#dest_load').hide();
                $('#destinationid_bus').html(data);
            });

        });
    });
</script>
<form method="post" class="toValidate" action="bus-load.php" >
    <table width="100%" border="0" align="left">
        <tr>
            <td>&nbsp;</td>
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">

                    <tr>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:14%; padding-left:20px;">&nbsp;</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:17%;">&nbsp;</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:13%;">&nbsp;</td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:31%;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="18%" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:14%; padding-left:20px;"><span class="departing">From</span></td>
                        <td width="82%" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:17%;"><span class="departing">To</span></td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:13%;"><span class="departing">Departing</span></td>
                        <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px; width:31%;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding-left:20px;">
                            <select  name="origin"  id="originid" class="required" style="width:170px; font-family:Verdana, Geneva, sans-serif; font-size:11px;">

                                <option value="" selected="selected">--Select Origin--</option>
                                <option value="1160">Ahmedabad</option>
                                <option value="3">Bangalore</option>
                                <option value="102">Chennai</option>
                                <option value="109">Coimbatore</option>
                                <option value="1492">Delhi</option>
                                <option value="615">Goa</option>
                                <option value="6">Hyderabad</option>
                                <option value="0" disabled="disabled">---------</option>
                                <?php
                                foreach ($station_name as $ky => $name)
                                    if ($ky != 1160 && $ky != 3 && $ky != 102 && $ky != 109 && $ky != 1492 && $ky != 615 && $ky != 6)
                                        echo '<option value="' . $ky . '">' . $name . '</option>';
                                ?>
                            </select></td>
                        <td>
                            <select class="w200" name="destination" id="destinationid_bus" class="input1" style="width:170px; font-family:Verdana, Geneva, sans-serif; font-size:11px;">
                                <option value="">--Select Destination--</option>
                            </select>
                        </td>
                        <td>
                            <input id="dep" type="text" name="depart_date" size="10" title="Select Date"  class="required" value="<?php echo $depart_date; ?>" style="width:100px; font-family:Verdana, Geneva, sans-serif; font-size:11px;"/>
                        </td>
                        <td rowspan="3" width="100" align="left" valign="top" style="padding-right:30px;"> <input type="submit" value="Search" class="btn_blue" alt="Search" style="padding:5px 10px; border-radius: 5px 5px 5px 5px" /></td>

                    </tr>
                </table>            </td>
        </tr>
    </table>

</form>
