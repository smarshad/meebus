<?php  
include_once "header.php"; 
?>
<style>
.button
{
	width:auto;
	float:left;
	margin-left:100px;
}
.left-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/a.jpg) no-repeat;
}
.mid-btn 
{
	width:auto;
	height:28px;
	float:left;
	background:#d84f57;
	font-size:12px;
	color:#FFFFFF;	
	font-weight:bold;
}
.mid-btn a
{
	font-size:12px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
	display:block;
}
.right-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/c.jpg) no-repeat;
}
.inner-content input[type="text"] {
    width: 300px;
}
</style>
<div  class="ticketform">
<div class="headerwidget">
        <div>
            <div class="headers">SMS AND EMAIL TICKET</div>
            <div class="headerTitle">
                 <div class="headerTitle1">
                    Verify your details, and
                    <span style="color: #da4d52;">EMAIL / SMS</span>
                    your tickets
                </div>
                </div>
        </div>
        </div>
<form action="sendemail.php" id="searchForm" method="post">       
 <div id="ticketInput">
            <div class="tinInput">
                <div class="tinheader">TICKET NUMBER</div>
            <div class="fl search-box">
                <span class="boxImage">
                     <img src="images/tickets.png">
                </span>

                <div>
                   <input class="db" id="txttick" name="ticketnum" placeholder="Enter your ticket number" value="" type="text">
                   <span class="err_msg" id="err" style="font-size:13px; font-weight:bold;"></span>
                </div>
            </div>
            </div>
            <div class="emailInput">
                <div class="emailheader">E-MAIL</div>
            <div class="fl search-box">
                <span class="boxImage">
                    <img src="images/e-mail.png">
                </span>
                <div>
                   <input  class="db" id="txtemail" name="email" placeholder="Enter e-mail used for booking" value="" type="text">
               <span class="err_msg" id="err1" style="font-size:13px; font-weight:bold;"></span>
                </div>
            </div>
            </div>
            <div class="ticketSubmit">
            <input value="Submit" name="submit" class="search_btn" id="submit" type="submit">
            </div>
            
        </div>
</form>

		  
</div>

<?php  include_once "includes/footer.php"; ?>
<script language="javascript">

$("#submit").click( function ()
{
	$("#err").html("");
	$("#err1").html("");
	var ticket=$("#txttick").val();
	var email=$("#txtemail").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(ticket=='')
	{
		$("#err").html("Please enter a valid ticket number!");
		return false;
	}
	else if(email=='')
	{
		$("#err1").html("Please enter email address!");
		return false;
	}
	else if(!emailReg.test(email)) 
	{
		$("#err1").html("Please enter a valid email address!");
		return false;
	}
	else
	{
		$("#ticket").submit();
		return true;
	}
});

</script>