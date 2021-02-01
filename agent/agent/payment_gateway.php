<?php
//print_r($_REQUEST);exit;



session_start();
unset($_SESSION['source']);
unset($_SESSION['book_num']);
unset($_SESSION['book_num1']);
unset($_SESSION['afname']);
unset($_SESSION['alname']);
unset($_SESSION['atitle']);
unset($_SESSION['ifname']);
unset($_SESSION['ilname']);
unset($_SESSION['ititle']);
unset($_SESSION['idob']);
unset($_SESSION['cfname']);
unset($_SESSION['clname']);
unset($_SESSION['ctitle']);
unset($_SESSION['cdob']);

if ($_POST['source'] != 'Bus_Ticket') {
    unset($_SESSION['mobile']);
    unset($_SESSION['email']);
}
$_SESSION['firstname'];
$_SESSION['city'];
$_SESSION['state'];
$_SESSION['country'];
$_SESSION['address'];
$_SESSION['pincode'];
$_SESSION['avail'];
$_SESSION['roomtype'];
$_SESSION['ratebasis'];
$_SESSION['hotelid'];
$_SESSION['cost_pernight'];
$_SESSION['sglrt'];
$_SESSION['dblrt'];
$_SESSION['cxbrt'];
$_SESSION['name_title'];
$_SESSION['pax_first_name'];
$_SESSION['pax_last_name'];
$_SESSION['pax_addr_1'];
$_SESSION['pax_addr_2'];
$_SESSION['pax_city'];
$_SESSION['pax_state'];
$_SESSION['pax_pincode'];

require_once("database/connect.php");
if (!$res = mysql_fetch_array(mysql_query("SELECT MAX(id) AS maxno FROM payment_gateway")))
    die(mysql_error());
$maxno = $res['maxno'];
$maxno++;
echo "<span style='color:#fff; font-size:3px;'>PaymenGatewaypage</span>";

$payment_type = $_POST['paymenttype'];
$_SESSION['payment_type'] = $payment_type;
$pgwcharge = $_POST['pgwcharge'];

if ($payment_type == 'ev') {
    $AMT = $_POST['pricee'];
} else {
    if ($_POST['source'] == 'Bus_Ticket') {
        $AMT = $_POST['pricee'];
        $_SESSION[pgTotalFair] = $AMT;
    } else {
        $AMT = $_POST['pricee'] - $pgwcharge;
    }
}

if ($_POST['source'] == 'Bus_Ticket') {
    if (!mysql_query("INSERT INTO `payment_gateway` (`id`, `source`, `amount`, `entered_date`, `email_id`, `session_email`) VALUES ('$maxno', '$_POST[source]', '$AMT', NOW(), '$_SESSION[email]', '$_SESSION[user_id]')"))
        die(mysql_error());
}
else {
    $TransferType = $_POST['group1'];
    if (!mysql_query("INSERT INTO `payment_gateway` (`id`, `source`, `amount`, `entered_date`, `email_id`, `session_email`) VALUES ('$maxno', '$_POST[source]', '$AMT', NOW(), '$_POST[email]', '$_SESSION[user_id]')"))
        die(mysql_error());
}

if ($_POST['source'] == 'Hotel_Ticket') {
    //echo $_POST['pax_email'];

    $_SESSION['source'] = $_POST['source'];
    $_SESSION['avail'] = $_POST['avail'];
    $_SESSION['roomtype'] = $_POST['roomtype'];
    $_SESSION['ratebasis'] = $_POST['ratebasis'];
    $_SESSION['hotelid'] = $_POST['hotelid'];
    $_SESSION['cost_pernight'] = $_POST['cost_pernight'];
    $_SESSION['sglrt'] = $_POST['sglrt'];
    $_SESSION['dblrt'] = $_POST['dblrt'];
    $_SESSION['cxbrt'] = $_POST['cxbrt'];
    $_SESSION['name_title'] = $_POST['name_title'];
    $afname = $_SESSION['pax_first_name'] = $_POST['pax_first_name'];
    $_SESSION['pax_last_name'] = $_POST['pax_last_name'];
    $_SESSION['address'] = $_POST['pax_addr_1'];
    $_SESSION['pax_addr_2'] = $_POST['pax_addr_2'];
    $_SESSION['pax_city'] = $_POST['pax_city'];
    $_SESSION['mobile'] = $_POST['pax_phoneno'];
    $_SESSION['pax_state'] = $_POST['pax_state'];
    $_SESSION['pincode'] = $_POST['pax_pincode'];
    $_SESSION['TotalRoomTariff'] = $_POST['TotalRoomTariff'];
    $AMT = str_replace(",", "", $_SESSION['TotalRoomTariff']);
    $_SESSION['email'] = $_POST['pax_email'];
    $_SESSION['Webservice'] = $_POST['Webservice'];
    $_SESSION['fromdate'] = $_POST['fromdate'];
    $_SESSION['todate'] = $_POST['todate'];
    $_SESSION['prowskey'] = $_POST['prowskey'];
    $_SESSION['roomtypeode'] = $_POST['roomtypeode'];
    $_SESSION['roomplancode'] = $_POST['roomplancode'];
    $_SESSION['fromallocation'] = $_POST['fromallocation'];
    $_SESSION['allocid'] = $_POST['allocid'];
    $_SESSION['hotelnName'] = $_POST['hotelnName'];
    
} else if ($_POST['source'] == 'Bus_Ticket') {
    $_SESSION['source'] = $_POST['source'];
    $_SESSION['TentativeBookingReferenceNo '] = $_POST['TentativeBookingReferenceNo'];
} 

else if ($_REQUEST['type'] == 'E-Transfer') {
  echo  $_SESSION['type'] = $_REQUEST['type'];
  echo  $_SESSION['remarks'] = $_REQUEST['remarks'];
  echo $AMT = $_SESSION['ammount'] = $_REQUEST['ammount'];
  echo  $_SESSION['agent_id'] = $_REQUEST['id'];
echo  $_SESSION['agent_name'] = $_REQUEST['agent_name'];
echo  $_SESSION['address'] = $_REQUEST['address'];
echo  $_SESSION['state'] = $_REQUEST['state'];
echo  $_SESSION['mobile'] = $_REQUEST['mobile_phone'];
echo  $_SESSION['city'] = $_REQUEST['city'];
echo  $_SESSION['pincode'] = $_REQUEST['pincode'];
echo  $_SESSION['email'] = $_REQUEST['email'];
    exit;
} 

else if ($_POST['source'] == 'Flight_Ticket') {
    $_SESSION['source'] = 'Flight_Ticket';
    $_SESSION['book_num'] = $_POST['bookno'];
    $_SESSION['book_num1'] = $_POST['bookno1'];
    $afname = $_POST['afname'];
    $alname = $_POST['alname'];
    $atitle = $_POST['atitle'];
    $ctitle = $_POST['ctitle'];
    $cfname = $_POST['cfname'];
    $clname = $_POST['clname'];
    $ititle = $_POST['ititle'];
    $ilname = $_POST['ilname'];
    $ifname = $_POST['ifname'];
    $iage = $_POST['iage'];
    $idob = $_POST['idob'];
    $cage = $_POST['cage'];
    $cdob = $_POST['cdob'];
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['pincode'] = $_POST['pincode'];
    $adults = $_SESSION['adults'];
    $childs = $_SESSION['childs'];
    $infants = $_SESSION['infants'];
    $i = 0;

    while ($i < $adults) {
        $_SESSION['afname'][$i] = $afname[$i];
        $_SESSION['alname'][$i] = $alname[$i];
        $_SESSION['atitle'][$i] = $atitle[$i];
        $i++;
    }
    $i = 0;
    while ($i < $infants) {
        $_SESSION['ifname'][$i] = $ifname[$i];
        $_SESSION['ilname'][$i] = $ilname[$i];
        $_SESSION['ititle'][$i] = $ititle[$i];
        $_SESSION['idob'][$i] = $idob[$i];
        $_SESSION['iage'][$i] = $iage[$i];
        $i++;
    }
    $i = 0;
    while ($i < $childs) {
        $_SESSION['cfname'][$i] = $cfname[$i];
        $_SESSION['clname'][$i] = $clname[$i];
        $_SESSION['ctitle'][$i] = $ctitle[$i];
        $_SESSION['cdob'][$i] = $cdob[$i];
        $_SESSION['cage'][$i] = $cage[$i];
        $i++;
    }
} else if ($_POST['source'] == 'Int_Flight_Ticket') {
    $_SESSION['source'] = 'Int_Flight_Ticket';
    $_SESSION['book_num'] = $_POST['bookno'];
    $afname = $_POST['afname'];
    $alname = $_POST['alname'];
    $atitle = $_POST['atitle'];
    $ctitle = $_POST['ctitle'];
    $cfname = $_POST['cfname'];
    $clname = $_POST['clname'];
    $ititle = $_POST['ititle'];
    $ilname = $_POST['ilname'];
    $ifname = $_POST['ifname'];
    $iage = $_POST['iage'];
    $idob = $_POST['idob'];
    $cage = $_POST['cage'];
    $cdob = $_POST['cdob'];
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['address'] = $_POST['pax_addr_1'];
    $_SESSION['pincode'] = $_POST['pincode'];
    $adults = $_SESSION['adults'];
    $childs = $_SESSION['childs'];
    $infants = $_SESSION['infants'];
    $i = 0;

    while ($i < $adults) {
        $_SESSION['afname'][$i] = $afname[$i];
        $_SESSION['alname'][$i] = $alname[$i];
        $_SESSION['atitle'][$i] = $atitle[$i];
        $i++;
    }
    $i = 0;
    while ($i < $infants) {
        $_SESSION['ifname'][$i] = $ifname[$i];
        $_SESSION['ilname'][$i] = $ilname[$i];
        $_SESSION['ititle'][$i] = $ititle[$i];
        $_SESSION['idob'][$i] = $idob[$i];
        $_SESSION['iage'][$i] = $iage[$i];
        $i++;
    }
    $i = 0;
    while ($i < $childs) {
        $_SESSION['cfname'][$i] = $cfname[$i];
        $_SESSION['clname'][$i] = $clname[$i];
        $_SESSION['ctitle'][$i] = $ctitle[$i];
        $_SESSION['cdob'][$i] = $cdob[$i];
        $_SESSION['cage'][$i] = $cage[$i];
        $i++;
    }
}
?>
<html>
    <head>
        <title>Holidaysquare - Payment Page</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
        <style>
            .tableborder{
                border:#333333 solid 1px;
                margin-top:150px;
            }
            .text{
                font-family:Arial, Helvetica, sans-serif;
                font-size:13px;
                color:#0066CC;
            }
        </style>
        <script language="JavaScript">
            function validate(){

                var frm = document.frmTransaction;
                var aName = Array();
                aName['account_id'] = 'Account ID';
                aName['reference_no'] = 'Reference No';
                aName['amount'] = 'Amount';
                aName['description'] = 'Description';
                aName['name'] = 'Billing Name';
                aName['address'] = 'Billing Address';
                aName['city'] = 'Billing City';
                aName['state'] = 'Billing State';
                aName['postal_code'] = 'Billing Postal Code';
                aName['country'] = 'Billing Country';
                aName['email'] = 'Billing Email';
                aName['phone'] = 'Billing Phone Number';
                aName['ship_name']='Shipping Name';
                aName['ship_address']='Shipping Address';
                aName['ship_city']='Shipping City';
                aName['ship_state']='Shipping State';
                aName['ship_postal_code']='Shipping Postal code';
                aName['ship_country']='Shipping Country';
                aName['ship_phone']='Shipping Phone';
                aName['return_url']='Return URL';


                for(var i = 0; i < frm.elements.length ; i++){
                    if((frm.elements[i].value.length == 0)||(frm.elements[i].value=="Select Country")){
                        if((frm.elements[i].name=='country')||(frm.elements[i].name=="ship_country"))
                            alert("Select the " + aName[frm.elements[i].name]);
                        else
                            alert("Enter the " + aName[frm.elements[i].name]);
                        frm.elements[i].focus();
                        return false;
                    }
                    if(frm.elements[i].name=='account_id'){

                        if(!validateNumeric(frm.elements[i].value)){
                            alert("Account Id must be NUMERIC");
                            frm.elements[i].focus();
                            return false;
                        }
                    }

                    if(frm.elements[i].name=='amount'){
                        if(!validateNumeric(frm.elements[i].value)){
                            alert("Amount should be NUMERIC");
                            frm.elements[i].focus();
                            return false;
                        }
                    }
                    if((frm.elements[i].name=='postal_code')||(frm.elements[i].name == 'ship_postal_code'))
                    {
                        if(!validateNumeric(frm.elements[i].value)){
                            alert("Postal code should be NUMERIC");
                            frm.elements[i].focus();
                            return false;
                        }
                    }

                    if((frm.elements[i].name=='phone')||(frm.elements[i].name =='ship_phone')){
                        if(!validateNumeric(frm.elements[i].value)){
                            alert("Enter a Valid CONTACT NUMBER");
                            frm.elements[i].focus();
                            return false;
                        }
                    }



                    if((frm.elements[i].name == 'name')||(frm.elements[i].name == 'ship_name'))
                    {

                        if(validateNumeric(frm.elements[i].value)){
                            alert("Enter your Name");
                            frm.elements[i].focus();
                            return false;
                        }
                    }


                    if(frm.elements[i].name=='ship_postal_code'){
                        if(!validateNumeric(frm.elements[i].value)){
                            alert("Postal code should be NUMERIC");
                            frm.elements[i].focus();
                            return false;
                        }
                    }



                    if(frm.elements[i].name == 'email'){
                        if(!validateEmail(frm.elements[i].value)){
                            alert("Invalid input for " + aName[frm.elements[i].name]);
                            frm.elements[i].focus();
                            return false;
                        }
                    }

                }
                return true;
            }

            function validateNumeric(numValue){
                if (!numValue.toString().match(/^[-]?\d*\.?\d*$/))
                    return false;
                return true;
            }

            function validateEmail(email) {
                //Validating the email field
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                //"
                if (! email.match(re)) {
                    return (false);
                }
                return(true);
            }


            Array.prototype.inArray = function (value)
            // Returns true if the passed value is found in the
            // array.  Returns false if it is not.
            {
                var i;
                for (i=0; i < this.length; i++) {
                    // Matches identical (===), not just similar (==).
                    if (this[i] === value) {
                        return true;
                    }
                }
                return false;
            };

        </script>
        <script src="load/AC_RunActiveContent.js" type="text/javascript"></script>
        <script type="text/javascript">
            function submitform()
            {
                document.frmTransaction.submit();
            }
        </script>
    </HEAD>
    <body onLoad="submitform()" >

        <form  method="post" action="secure.php" name="frmTransaction" id="frmTransaction" onSubmit="return validate()">
            <table width="600" cellpadding="2" cellspacing="2" border="0" style="display: none;">
                <tr>
                    <td class="fieldName" width="100%"><span class="error">*</span>Account Id</td>
                    <td  align="left" width="100%"><input type="hidden" name="account_id" value="5880">
                        <a href="https://support.ebs.in/index.php?_m=knowledgebase&_a=viewarticle&kbarticleid=15&nav=0,5,2" target="_blank "></a></td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Return Url</td>
                    <td align="left"><input type="hidden" name="return_url" size="60" value="http://holidaysquare.in/response.php?DR={DR}" /></td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Mode</td>
                    <td align="left"><select  name="mode" >
                            <option value="TEST">TEST</option>
                            <!-- <option value="LIVE">LIVE</option> -->
                        </select></td>
                </tr>

                <tr>
                    <td class="fieldName" width="100%"><span class="error">*</span>Reference No</td>
                    <td  align="left" width="100%"><input type="hidden" name="reference_no" value="<?php echo 'HOLIDAY' . $maxno ?>"/></td>
                </tr>
                <tr title="Enter the Price of the product that is offered for sale">
                    <td class="fieldName" width="100%"><span class="error">*</span>Sale Amount</td>
                    <td  align="left" width="100%">
                        <input type="hidden" name="amount" value="<?php echo $AMT; ?>" />
                          <!-- <input type="hidden" name="amount" value="10" />-->
                        <strong>INR</strong></td>
                </tr>
                <tr  title="Displays the description of the selected / ordered product.">
                    <td class="fieldName" width="100%"><span class="error">*</span>Description</td>
                    <td  align="left" width="100%"><input type="hidden" name="description" value="payment" /> </td>
                </tr>
                <tr>
                    <th colspan="2"><span class="style2">Billing Address</span></th>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Name</td>
                    <td align="left">
                        <input name="name" type="hidden" value="<?php
if ($_POST['source'] == 'Hotel_Ticket') {
    echo $afname;
} else if ($_POST['source'] == 'Bus_Ticket') {
    echo $_SESSION['firstname'];
}
else if ($_REQUEST['type'] == 'E-Transfer') {
    echo $_SESSION['agent_name'];
}
 else {
    echo $afname[0];
}
?>" maxlength="255" /> </td>

                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Address</td>
                    <td align="left"><input type="hidden" name="address" value="<?php echo $_SESSION['address']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>City</td>
                    <td align="left"><input type="hidden" name="city" value="<?php echo $_SESSION['city']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>State/Province</td>
                    <td align="left"><input type="hidden" name="state" value="<?php echo $_SESSION['state']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>ZIP/Postal Code</td>
                    <td align="left"><input type="hidden" name="postal_code" value="<?php echo $_SESSION['pincode']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Country</td>
                    <td align="left"><select name="country">
                            <option value="IND">India</option>

                        </select>    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Email</td>
                    <td align="left"><input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Telephone</td>
                    <td align="left"><input type="hidden" name="phone" value="<?php echo $_SESSION['mobile']; ?>" maxlength="20"/></td>
                </tr>
                <tr>
                    <th colspan="2"><span class="style2">Shipping Address </span></th>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span> Name</td>
                    <td align="left"><input type="hidden" name="ship_name" value="<?php
                        if ($_POST['source'] == 'Hotel_Ticket') {
                            echo $afname;
                        } else if ($_POST['source'] == 'Bus_Ticket') {
                            echo $_SESSION['agent_name'];
                        } 
                           else if ($_REQUEST['type'] == 'E-Transfer') {
                          echo $_SESSION['agent_name'];
                              }
                           else {
                            echo $afname[0];
                        }
?>" /></td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Address</td>
                    <td align="left"><input type="hidden" name="ship_address" value="<?php echo $_SESSION['address']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>City</td>
                    <td align="left"><input type="hidden" name="ship_city" value="<?php echo $_SESSION['city']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>State/Province</td>
                    <td align="left"><input type="hidden" name="ship_state" value="<?php echo $_SESSION['state']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>ZIP/Postal Code</td>
                    <td align="left"><input type="hidden" name="ship_postal_code" value="<?php echo $_SESSION['pincode']; ?>" />    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Country</td>
                    <td align="left"><select name="ship_country">
                            <option value="India" selected=""> India </option>
                        </select>    </td>
                </tr>
                <tr>
                    <td class="fieldName"><span class="error">*</span>Telephone</td>
                    <td align="left"><input type="hidden" name="ship_phone" value="<?php echo $_SESSION['mobile']; ?>" /></td>
                </tr>



                <tr>
                    <td valign="top" align="center" colspan="2"><input type="hidden" name="submitted" value="Submit" type="submit" />
                        &nbsp;
                        <input type="hidden" name="reset" type="reset" value="Reset" />    </td>
                </tr>

            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" valign="middle"><table width="689" border="0" cellpadding="0" cellspacing="0" class="tableborder">
                            <tr>
                                <td height="84" align="center" valign="middle"><img src="images/container/header/logo.jpg"/></td>
                            </tr>
                            <tr>
                                <td height="30" align="center" valign="baseline" class="underline">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="30" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#666; line-height:18px;">You are currently redirecting to the payment gateway page.</td>
                            </tr>
                            <tr>
                                <td height="100" align="center" valign="middle"><img align="center" src="images/progress_bar.gif" /></td>
                            </tr>
                            <tr>
                                <td height="30" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#666; line-height:18px;">Please do not refresh the screen or press backspace key.</td>
                            </tr>
                            <tr>
                                <td height="30" align="center" valign="baseline">&nbsp;</td>
                            </tr>
                        </table>
                        </form>



                        </body>
                        </html>
