function createObject()
{
    var request_type;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer")
    {
        request_type = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else
    {
        request_type = new XMLHttpRequest();
    }
    return request_type;
}

var http = createObject();


var nocache = 0;

//Delete User
function deluser(uid)
{
	var answer = confirm("Are you sure to delete an User?");

	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'deluser.php?uid='+uid+'&nocache='+nocache);
		http.onreadystatechange = deluserReply;
		http.send(null);
	}
}

function deluserReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not delete an User...';
            document.getElementById('response').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'User deleted successfully!';
			window.location.reload();
        }
    }
}

//Delete Agent
function delagent(aid)
{
	var answer = confirm("Are you sure to delete an Agent and other related information?");

	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'delagent.php?aid='+aid+'&nocache='+nocache);
		http.onreadystatechange = delagentReply;
		http.send(null);
	}
}

function delagentReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not delete an Agent...';
            document.getElementById('response').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'Agent and other related information deleted successfully!';
			window.location.reload();
        }
    }
}

//Delete City
function delcity1(cid)
{
	var answer = confirm("Are you sure to delete City?");

	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'delcity.php?cid='+cid+'&nocache='+nocache);
		http.onreadystatechange = delcityReply;
		http.send(null);
	}
}

function delcityReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not delete City...';
            document.getElementById('response').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'City and its boarding & dropping points are deleted successfully!';
			window.location.reload();
        }
    }
}

//Make an Agent Status Inactive
function aginactive(agid)
{
	var answer = confirm("Inactive an Agent?");

	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'aginactive.php?agid='+agid+'&nocache='+nocache);
		http.onreadystatechange = aginactiveReply;
		http.send(null);
	}
}

function aginactiveReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not update the status...';
            document.getElementById('response').innerHTML = "";
        }
        else if(response == 1)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'Status updated successfully!';
			window.location.reload();
        }
    }
}

//Make an Agent Status Active
function agactive(agid)
{
		nocache = Math.random();
		http.open('get', 'agactive.php?agid='+agid+'&nocache='+nocache);
		http.onreadystatechange = agactiveReply;
		http.send(null);
}

function agactiveReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not update the status...';
            document.getElementById('response').innerHTML = "";
        }
        else if(response == 1)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'Status updated successfully!';
			window.location.reload();
        }
    }
}


//Check Bus type field
function chkaddbus()
{
	var tbus = document.getElementById("txtbus").value;

	if (tbus == "" || tbus == null)
	{
		document.getElementById("errmsg").innerHTML = "Please enter the valid Bus Type";	
		return false;
	}
	else
	{
		document.getElementById("errmsg").innerHTML = "";	
		return true;
	}

}

//Delete City
function delbustype(bid)
{
	var answer = confirm("Are you sure to delete Bus Type?");
	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'delbustype.php?bid='+bid+'&nocache='+nocache);
		http.onreadystatechange = delbustypeReply;
		http.send(null);
	}
}

function delbustypeReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not delete Bus Type...';
        }
        else
        {    
            document.getElementById('errmsg').innerHTML = '';
			document.getElementById('dbustype').innerHTML = response;
        }
    }
}


//Agent Select City
function agselcity(agid)
{
	if (agid != 0)
	{
		nocache = Math.random();
		http.open('get', 'agselcity.php?agid='+agid+'&nocache='+nocache);
		http.onreadystatechange = agselcityReply;
		http.send(null);
	}
	else
	{
		document.getElementById('dselcity').innerHTML = "<select id='selcity'><option value='0'>-- Select the City--</option></select>"
	}
}

function agselcityReply()
{
	if(http.readyState == 4)
    {
	    var response = http.responseText;
		document.getElementById('dselcity').innerHTML = response;
    }
}

//Display Boarding points
function agdispboardpts(agid)
{
	if (agid != 0)
	{
		nocache = Math.random();
		http.open('get', 'agdispboardpts.php?agid='+agid+'&nocache='+nocache);
		http.onreadystatechange = agdispboardptsReply;
		http.send(null);
	}
	else
	{
		document.getElementById('dispboardingpts').innerHTML = ""
	}
}

function agdispboardptsReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		document.getElementById('dispboardingpts').innerHTML = response;
    }
}

/////////////////////////////////////////////////

function compinactive(compid)
{
	
	var answer = confirm("Inactive an Company?");


	if (answer)
	{
		nocache = Math.random();
		http.open('get', 'company_inactive.php?compid='+compid+'&nocache='+nocache);
		http.onreadystatechange = compinactiveReply;
		http.send(null);
	}
}

function compinactiveReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not update the status...';
            document.getElementById('response').innerHTML = "";
        }
        else if(response == 1)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = '';
			window.location.reload();
        }
    }
}

//Make an Company Status Active

function compactive(compid)
{


		nocache = Math.random();
		http.open('get', 'company_active.php?compid='+compid+'&nocache='+nocache);	
		http.onreadystatechange = compactiveReply;
		http.send(null);
		
}

function compactiveReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Could not update the status...';
            document.getElementById('response').innerHTML = "";
        }
        else if(response == 1)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = '';
			window.location.reload();
        }
    }
}


function checkname(compname){
	    if(compname!=''){
		nocache = Math.random();
		http.open('get', 'check_company.php?compname='+compname+'&nocache='+nocache);	
		http.onreadystatechange = checknameReply;
		http.send(null);
		}
}
function checknameReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);
        if(response == 1)
        {
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('checkid').innerHTML = '<span class="err_msg">This Name Already Exist. Please Try Another Name!!! </span>';
			document.getElementById('txtcompname_2').focus();			

        }
        else if(response == 0)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('checkid').innerHTML = "<span class='suc_msg'>This Name Availabel!!! </span>";
			//document.getElementById('checkid').innerHTML = '';
			//window.location.reload();
        }
    }
}

function searchcompany(){
	var compname=document.getElementById('searchcompany_txt').value;
	var compcity=document.getElementById('searchcompany_city').value;
	var status=document.getElementById('searchcompany_status').value;
	
	if(compname == 'Enter Travel Agency Name...' || compname=='')
	   compname='none';	   
		nocache = Math.random();
		http.open('get', 'search_company.php?compname='+compname+'&compcity='+compcity+'&status='+status+'&nocache='+nocache);	
		http.onreadystatechange = searchcompanyReply;
		http.send(null);	
}

function searchcompanyReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);

     //  document.getElementById('errmsg').innerHTML = '';
        document.getElementById('searchcompany_result').innerHTML = response;
		
        /*if(response == 1)
        {
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('checkid').innerHTML = '<span class="err_msg">This Name Already Exist. Please Try Another Name!!! </span>';
			document.getElementById('txtcompname_2').focus();			

        }
        else if(response == 0)
        {   
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('checkid').innerHTML = "<span class='suc_msg'>This Name Availabel!!! </span>";
			//document.getElementById('checkid').innerHTML = '';
			//window.location.reload();
        }*/
    }	
}

function editcompany(v){
		nocache = Math.random();
		http.open('get', 'edit_company.php?id='+v+'&nocache='+nocache);	
		http.onreadystatechange = editcompanyReply;
		http.send(null);	
}
function editcompanyReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);
      //  document.getElementById('errmsg').innerHTML = '';
        document.getElementById('addcompany').innerHTML = response;
	}
}

/////////////////////////// Bus Management ////////////////////////////////////////

function viewbuslist(v){
	//alert(v);
		nocache = Math.random();
		http.open('get', 'travels_bus.php?id='+v+'&nocache='+nocache);	
		http.onreadystatechange = viewbuslistReply;
		http.send(null);	
}
function viewbuslistReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert (response);
        document.getElementById('errmsg').innerHTML = '';
        document.getElementById('buslists').innerHTML = response;
	}
}


function gettocity1(v){
		nocache = Math.random();
		//alert(v);
		http.open('get', 'gettocity.php?fromid='+v+'&nocache='+nocache);	
		http.onreadystatechange = gettocityReply;
		http.send(null);	
}
function gettocityReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert(response);
       // document.getElementById('errmsg').innerHTML = '';
        document.getElementById('tocity').innerHTML = response;
	}
}

function getboardings(){
	var from=document.getElementById('fromCity').value;
	var to=document.getElementById('toCity').value;
	if(from==''){
		alert("Choose From City Point");
		document.getElementById('fromCity').focus();
	}
	else if(to==''){
		alert("Choose To City Point");
		document.getElementById('toCity').focus();
	}	
	else{
		nocache = Math.random();
		http.open('get', 'getboardings.php?fromid='+from+'&toid='+to+'&nocache='+nocache);	
		http.onreadystatechange = getboardingsReply;
		http.send(null);		
	}	
}
var res_array=new Array();
function getboardingsReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		//alert(response);
		
		res_array=response.split("||");
		//alert(res_array);
		var boarding=res_array[0];
		var dropping=res_array[1];		
        document.getElementById('errmsg').innerHTML = '';
        document.getElementById('boardinglist').innerHTML = boarding;
		document.getElementById('droppinglist').innerHTML = dropping;
	}
}


///////////////////////////////////////////////////////////////// Route Management  //////////////////////////////////////////////

function get_TO_city_list(v){
	
 	if(v==''){
		alert("This is not a Valid Choice");
	}
	else{
		document.getElementById('tolist').innerHTML = '<img src="../images/ajax-loader.gif">';		
		nocache = Math.random();
		http.open('get', 'sub/getroutes.php?fromid='+v+'&nocache='+nocache);	
		http.onreadystatechange = get_TO_city_listReply;
		http.send(null);		
	}     
}

function get_TO_city_listReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		document.getElementById('tolist').innerHTML = response;
		/*res_array=response.split("||");

		var tolist=res_array[0];
		var av_list=res_array[1];		
        document.getElementById('tolist').innerHTML =tolist;
		document.getElementById('list_dest').innerHTML = av_list;*/
	}	
}

function add_destination(){
	var from= document.getElementById('fromid').value;
	var to = document.getElementById('to_list');	
	var dest='';
		for(i = 0;i < to.length;i++)
		{
			if(to[i].selected)
			  {
				dest+=to.options[i].value+',';
			  }  
		}
	dest = dest.slice(0,-1);
	document.getElementById('list_dest').innerHTML = '<img src="../images/ajax-loader.gif">';
		nocache = Math.random();
		http.open('get', 'sub/add_routes.php?fromid='+from+'&toid='+dest+'&nocache='+nocache);	
		http.onreadystatechange = add_destinationReply;
		http.send(null);	
}

function add_destinationReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;	        
		document.getElementById('list_dest').innerHTML = response;
		get_TO_city_list(document.getElementById('fromid').value);
	}	
}


function del_destinationSingle(from,to){
		if(window.confirm('Would you like to Delete This?')){
		document.getElementById('tolist').innerHTML = '<img src="../images/ajax-loader.gif">';
		nocache = Math.random();
		http.open('get', 'sub/del_routes.php?fromid='+from+'&toid='+to+'&nocache='+nocache);	
		http.onreadystatechange = del_destinationSingleReply;
		http.send(null);		
		}
}

function del_destinationSingleReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;	        
		//document.getElementById('list_dest').innerHTML = response;
		get_TO_city_list(document.getElementById('fromid').value);
	}	
}

function del_destinationsMore(from){
	var de='';
	for(var i=0; i < document.getElementsByName('chk').length; i++){
		if(document.getElementsByName('chk')[i].checked){
			de +=document.getElementsByName('chk')[i].value + ",";
		}
	}
    de = de.slice(0,-1);
		nocache = Math.random();
		http.open('get', 'sub/del_routes.php?fromid='+from+'&toid='+de+'&nocache='+nocache);	
		http.onreadystatechange = del_destinationsMoreReply;
		http.send(null);
}

function del_destinationsMoreReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;	        
		document.getElementById('list_dest').innerHTML = response;
		get_TO_city_list(document.getElementById('fromid').value);
	}	
}

///////////////////////////////////////////////////  Service Provider Management  ////////////////////////////////////////////////

function chkSPemail_Dup(v,f){
	if(v!=''){
		if(chkemail_EXP(v)){
		nocache = Math.random();
		if(f!=0)
		http.open('get', 'sub/chkSPemail_Dup.php?email='+v+'&id='+f+'&nocache='+nocache);
		else
		http.open('get', 'sub/chkSPemail_Dup.php?email='+v+'&nocache='+nocache);
		http.onreadystatechange = chkSPemail_DupReply;
		http.send(null);		   	
		}
	}
}

function chkSPemail_DupReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;
		res_array=response.split("||");
		var content=res_array[0];
		var flag=res_array[1];
		document.getElementById('email_res').innerHTML = content;		
		document.getElementById('flag').value=flag;
	}	
}

function change_SP_status(sp_id,status){
	    var msg='';
		if(status==1)
		   msg="Are You Sure to Unblock This Service Provider?";
		else
		   msg="Are You Sure to Block This Service Provider?";
		   
	    var r=confirm(msg);
		if(r){
	    nocache = Math.random();
		document.getElementById('chg_'+sp_id).innerHTML = '<img src="../images/ajax-loader.gif">';
		http.open('get', 'sub/change_SP_status.php?sp_id='+sp_id+'&status='+status+'&nocache='+nocache);
		http.onreadystatechange = change_SP_statusReply;
		http.send(null);	
		}
}
function change_SP_statusReply(){
	if(http.readyState == 4)
    {
        var response = http.responseText;		
		res_array=response.split("||");
		var content=res_array[0];
		var spid=res_array[1];
		document.getElementById('chg_'+spid).innerHTML = content;		
	}
}


function del_SP(sp_id){
	    var r=confirm('Are you sure to Delete This Service Provider?');
		if(r){
			 //alert('Need for Some confirmations');
		nocache = Math.random();
		http.open('get', 'sub/commgnt.php?sp_id='+sp_id+'&opt=del&nocache='+nocache);
		http.onreadystatechange = ProvideReply;
		http.send(null);	
		}
}
function ProvideReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
        alert('Done');
		search_SP();
	  }		
}
function search_SP(){
	var search_str=document.getElementById('sp_search').value;
	var sp_status=document.getElementById('sp_status').value;
	pagination('sub/companymgnt.php',search_str,sp_status);
}

function search_SP_name(){ 
	var search_name=document.getElementById('sp_search').value;
	pagination('sub/service_provider.php',search_name,'');
}

function search_Usr()
{
	var search_str=document.getElementById('usr_search').value;
	
	var gen=document.getElementById('usr_gen').value;
	
	var utype=document.getElementById('usr_type').value;
	
	var status=document.getElementById('usr_status').value;
	
	var nums = gen+'^^'+utype+'^^'+status ;
		
	pagination('sub/usrmgnt.php',search_str,nums);
}

function search_Loc()
{
		pagination('sub/add_location.php');
		
}
function search_location()
{
	pagination('sub/location.php');
}
function search_Login()
{
	
		
	pagination('sub/add-off-login.php');
}
function edit_courier()
{
	
		
	pagination('sub/courier-list.php');
}
function view_courier()
{
	
		
	pagination('sub/view_courier.php');
}
function search_bulk()
{
	
	document.getElementById('hide').style.display="none";
	
	var search_str=document.getElementById('usr_search').value;
	//alert(search_str);
	var gen=document.getElementById('usr_gen').value;
	
	var utype=document.getElementById('usr_type').value;
	
	var status=document.getElementById('usr_status').value;
	
	var nums = gen+'^^'+utype+'^^'+status ;
		
	pagination('sub/bulksms.php',search_str,nums);
}


function sms_log()
{
	var search_str=document.getElementById('filter').value;
	
	var buss=document.getElementById('bus').value;
	//alert(buss);
	pagination('sub/sms.php',search_str,buss);
}

function email_log()
{
	var search_strr=document.getElementById('filter').value;
	
	var busss=document.getElementById('bus').value;
	//alert(buss);
	pagination('sub/email.php',search_strr,busss);
}

  
function search_Psr()
{
	var search_str=document.getElementById('usr_search').value;
	
	var ticket=document.getElementById('ticket').value;
	
	var date=document.getElementById('datepicker').value;
	
	var utype=document.getElementById('usr_type').value;
	
	var fcity=document.getElementById('frmcity').value;
	
	var tcity=document.getElementById('tocity').value;	
	
	var nums = ticket+'^^'+date+'^^'+utype+'^^'+fcity+'^^'+tcity;
	
	pagination('sub/psrmgnt.php',search_str,nums);
}


function search_bkr()
{
	var search_str=document.getElementById('usr_search').value;
	
	var ticket=document.getElementById('ticket').value;
	
	var date=document.getElementById('datepicker').value;
	
	var utype=document.getElementById('usr_type').value;
	
	var fcity=document.getElementById('frmcity').value;
	
	var tcity=document.getElementById('tocity').value;	
	
	var nums = ticket+'^^'+date+'^^'+utype+'^^'+fcity+'^^'+tcity;
	
	pagination('sub/book_details.php',search_str,nums);
}



///////////////////////////////////////////////////  Bus Management  /////////////////////////////////////////////////////////////
function getDestination(v){
	if(v!=''){
	    nocache = Math.random();
		document.getElementById('loading').innerHTML = '<img src="../images/ajax-loader.gif">';
		http.open('get', 'sub/get_Destinations.php?source='+v+'&nocache='+nocache);
		http.onreadystatechange = getDestinationReply;
		http.send(null);		
	}
	else{
		alert('This is not valid selection');
	}
}

function getDestinationReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('tocity').innerHTML = response;		
		document.getElementById('loading').innerHTML = '';
	  }
}

function showBusStructure(str_id,busid){
	if(str_id!=''){
		
	    nocache = Math.random();		
		document.getElementById('seat_arrange').innerHTML = '<img src="../images/ajax-loader.gif">';
		http.open('get', 'sub/seat_layout.php?str_id='+str_id+'&busid='+busid+'&nocache='+nocache);
		http.onreadystatechange = showBusStructureReply;
		http.send(null);       		
	}
	else{
		alert('This is not a Valid Selection.');
	}
}

function showBusStructureReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('seat_arrange').innerHTML = response;		
	  }	
}


function searchBus(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var bustype=document.getElementById('bus_type').value;	
	var busfrom=document.getElementById('from_bus').value;
	var busto=document.getElementById('to_bus').value;
	var status=document.getElementById('bus_status').value;
	var sp_id=document.getElementById('sp_id').value;
	var arg1=str;
	var arg2=bustype+"||"+busfrom+"||"+busto+"||"+status+"||"+sp_id;
	
	pagination('sub/busDetails.php',arg1,arg2);
}

function searchcoupon(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var bustype=document.getElementById('bus_type').value;	
	var busfrom=document.getElementById('from_bus').value;
	var busto=document.getElementById('to_bus').value;
	var status=document.getElementById('bus_status').value;
	var sp_id=document.getElementById('sp_id').value;
	var arg1=str;
	var arg2=bustype+"||"+busfrom+"||"+busto+"||"+status+"||"+sp_id;
	
	pagination('sub/busCoupon.php',arg1,arg2);
}

function searchcoup(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var bustype=document.getElementById('bus_type').value;	
	var busfrom=document.getElementById('from_bus').value;
	var busto=document.getElementById('to_bus').value;
	var status=document.getElementById('bus_status').value;
	//var sp_id=document.getElementById('sp_id').value;
	var arg1=str;
	var arg2=bustype+"||"+busfrom+"||"+busto+"||"+status;
	
	pagination('sub/busCoupon.php',arg1,arg2);
}

function viewcoupon(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var coupon=document.getElementById('coupon').value;	
	var status=document.getElementById('bus_status').value;
	var sp_id=document.getElementById('sp_id').value;
	var bus_id=document.getElementById('bus_id').value;
	var arg1=str;
	var arg2=coupon+"||"+status+"||"+sp_id+"||"+bus_id;
	
	pagination('sub/viewcoupon.php',arg1,arg2);
}

function searchpromo(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var coupon=document.getElementById('coupon').value;	
	var status=document.getElementById('bus_status').value;
    var arg1=str;
	var arg2=coupon+"||"+status;
	
	pagination('sub/buspromo.php',arg1,arg2);
}

function viewpromo(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var coupon=document.getElementById('coupon').value;	
	var status=document.getElementById('bus_status').value;
	var sp_id=document.getElementById('sp_id').value;
	var bus_id=document.getElementById('bus_id').value;
	var arg1=str;
	var arg2=coupon+"||"+status+"||"+sp_id+"||"+bus_id;
	
	pagination('sub/viewcoupon.php',arg1,arg2);
}


function changeBusstatus(busid,status){
	    var msg='';
		if(status==1){
		   msg="Are You sure to Unblock This Bus?";
		}
		else{
		msg="Are You sure to Block This Bus?";
		}
	    var r = confirm("Are you sure to Change Status?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/busmgnt.php?busid='+busid+'&sts='+status+'&opt=chg&nocache='+nocache);
		http.onreadystatechange = BusReply;
		http.send(null);	
		}	
}

function delBus(busid){
	    var r = confirm("Are you sure to Delete This Bus?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/busmgnt.php?busid='+busid+'&opt=del&nocache='+nocache);
		http.onreadystatechange = BusReply;
		http.send(null);	
		}	
}

function BusReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
        alert('Done');
		searchBus();
	  }		
}

function changecoupstatus(coupid,status){
	    var msg='';
		if(status==1){
		   msg="Are You sure to Unblock This Coupon?";
		}
		else{
		msg="Are You sure to Block This Coupon?";
		}
	    var r = confirm("Are you sure to Change Status?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/coupmgnt.php?coupid='+coupid+'&sts='+status+'&opt=chg&nocache='+nocache);
		http.onreadystatechange = coupReply;
		http.send(null);	
		}	
}

function delcoup(coupid){
	//alert(coupid);
	    var r = confirm("Are you sure to Delete This Coupon?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/coupmgnt.php?coupid='+coupid+'&opt=del&nocache='+nocache);
		http.onreadystatechange = coupReply;
		http.send(null);	
		}	
}

function coupReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
        alert('Done');
		viewcoupon();
	  }		
}


function changepromostatus(coupid,status){
	alert(coupid);
	    var msg='';
		if(status==1){
		   msg="Are You sure to Unblock This Code?";
		}
		else{
		msg="Are You sure to Block This Code?";
		}
	    var r = confirm("Are you sure to Change Status?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/promodel.php?coupid='+coupid+'&sts='+status+'&opt=chg&nocache='+nocache);
		http.onreadystatechange = promoReply;
		http.send(null);	
		}	
}

function delcoup(coupid){
	alert(coupid);
	    var r = confirm("Are you sure to Delete This Promotional Code?");
		if(r){
	    nocache = Math.random();
		http.open('get', 'sub/promodel.php?coupid='+coupid+'&opt=del&nocache='+nocache);
		http.onreadystatechange = promoReply;
		http.send(null);	
		}	
}

function promoReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
        alert('Done');
		searchpromo();
	  }		
}
///////////////////////////////////////////////////  Bus Type Management  ///////////////////////////////////////////////////////
function addtype(){
	var val=get_val(document.getElementById('txtbus').value);
	document.getElementById('txtbus').value=val;
	if(document.getElementById('txtbus').value!=''){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/typemgnt.php?val='+val+'&opt=add&nocache='+nocache);
		http.onreadystatechange = addtypeReply;
		http.send(null);	   
	}
	else{
		alert('Enter Type');
		document.getElementById('txtbus').focus();
	}
}

function addtypeReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		$ar_split=response.split("||");		
		if($ar_split[0] != 0){
		alert('Done');	
		document.getElementById('restype').innerHTML = $ar_split[1];	
		document.getElementById('txtbus').value='';
		}
		else if($ar_split[0] == 0){
			alert('Sorry This is Duplicate entry.');
			document.getElementById('restype').innerHTML = $ar_split[1];
		}		
	  }	
}

function deltype(v){
	    var r = confirm("Are you sure to delete this Bus type?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/typemgnt.php?val='+v+'&opt=del&nocache='+nocache);
		http.onreadystatechange = deltypeReply;
		http.send(null);	
		}
}

function deltypeReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;
	  }
}


function edittype(){
	var val=get_val(document.getElementById('txtbustype').value);
	document.getElementById('txtbustype').value=val;
	var id=get_val(document.getElementById('txtbusid').value);
	document.getElementById('txtbusid').value=id;
	if(document.getElementById('txtbustype').value!='' ){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/typemgnt.php?val='+val+'&id='+id+'&opt=edit&nocache='+nocache);
		http.onreadystatechange = addtypeReply;
		http.send(null);	   
	}
	else{
		alert('Enter Type');
		document.getElementById('txtbus').focus();
	}
}

function edittypeReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		if($ar_split[0] != 0){
		alert('Done');	
		document.getElementById('restype').innerHTML = $ar_split[1];	
		document.getElementById('txtbustype').value='';
		}
		else if($ar_split[0] == 0){
			alert('Sorry This is Duplicate entry.');
			document.getElementById('restype').innerHTML = $ar_split[1];
		}
	  }	
}


function inactivetype(v){
	    var r = confirm("Are you sure to Unblock This Bus Type?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/typemgnt.php?val='+v+'&opt=unblock&nocache='+nocache);
		http.onreadystatechange = inactivetypeReply;
		http.send(null);	
		}
}

function inactivetypeReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;		
	  }
}


function activetype(v){
	    var r = confirm("Are you sure to Block This Bus Type?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/typemgnt.php?val='+v+'&opt=block&nocache='+nocache);
		http.onreadystatechange = activetypeReply;
		http.send(null);	
		}
}

function activetypeReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;		
	  }
}



///////////////////////////////////////////////////  City Management ///////////////////////////////////////////////////////////
function search_city(){
	var search_str=document.getElementById('search_city').value;
	var status='';
	pagination('sub/citymgnt.php',search_str,status);
}

function addCity(){
		var val=get_val(document.getElementById('txtcity').value);
    	document.getElementById('txtcity').value=val;
	if(document.getElementById('txtcity').value!=''){
	    nocache = Math.random();					
		var cityid=document.getElementById('txtcity').value;
		document.getElementById('search_city').value=cityid;
		http.open('get', 'sub/add_delCity.php?cityid='+cityid+'&opt=add&nocache='+nocache);
		http.onreadystatechange = CityReply;
		http.send(null);	
		document.getElementById('txtcity').value='';
		document.getElementById('txtcity').focus();
	}
	else{
		alert('Enter City Name');
		document.getElementById('txtcity').focus();
	}		
}

function delCity(cityid){
	    var r = confirm("Are you sure to delete This Citys?");
		if(r){
	    nocache = Math.random();			
		var url='sub/add_delCity.php?cityid='+cityid+'&opt=del&nocache='+nocache;		
		http.open('get', 'sub/add_delCity.php?cityid='+cityid+'&opt=del&nocache='+nocache);		
		http.onreadystatechange = CityReply;
		http.send(null);	
		}	
}


function changeCity(cityID,status){
	    var msg='';
		if(status==1){
			msg="Are You Sure to Unblock this City?";
		}
		else{
			msg="";
		}
	    var r = confirm("Are You Sure to Block this City?");
		if(r){
	    nocache = Math.random();			
		var url='sub/ChangeCity.php?cityid='+cityID+'&status='+status+'&nocache='+nocache;		
		http.open('get', url);		
		http.onreadystatechange = CityReply;
		http.send(null);	
		}	
}





function editcityfun(cityID){	
	document.getElementById('txtcity').value=document.getElementById(cityID).value;	
	document.getElementById('txtcity').focus();
	document.getElementById('addopt').style.display="none";
	document.getElementById('editopt').style.display="block";
	document.getElementById('cid').value=cityID;
}

function editCity(){	
var cityID=document.getElementById('cid').value;
		var val=get_val(document.getElementById('txtcity').value);
    	document.getElementById('txtcity').value=val;
	if(document.getElementById('txtcity').value!=''){
	    nocache = Math.random();					
		var cityid=document.getElementById('txtcity').value;
		document.getElementById('search_city').value=cityid;
		http.open('get', 'sub/add_delCity.php?cityid='+cityid+'&editcity='+cityID+'&opt=edit&nocache='+nocache);
		http.onreadystatechange = CityReply;
		http.send(null);	
		document.getElementById('txtcity').value='';
		document.getElementById('txtcity').focus();
	}
	else{
		alert('Enter City Name');
		document.getElementById('txtcity').focus();
	}	
}


function search_point(){
	var search_str=document.getElementById('search_point').value;
	var status=document.getElementById('status').value;
	pagination('sub/stop_point.php',search_str,status);
}

function addpoint(){
	
	
	
		var val=get_val(document.getElementById('txtpoint').value);
    	document.getElementById('txtpoint').value=val;
	if(document.getElementById('txtpoint').value!=''){
	    nocache = Math.random();
		var cityid=document.getElementById('status').value;
		
		var point=document.getElementById('txtpoint').value;
		
        //alert(point);
		document.getElementById('search_city').value=cityid;
		http.open('get', 'sub/add_point.php?cityid='+cityid+'&point='+point+'&opt=add&nocache='+nocache);
		http.onreadystatechange = CityReply;
		http.send(null);	
		document.getElementById('txtpoint').value='';
		document.getElementById('txtpoint').focus();
	}
	else{
		alert('Enter the stopping point');
		document.getElementById('txtpoint').focus();
	}		
}

function delpoint(cityid){
	    var r = confirm("Are you sure to delete This City?");
		if(r){
	    nocache = Math.random();			
		var url='sub/add_delCity.php?cityid='+cityid+'&opt=del&nocache='+nocache;		
		http.open('get', 'sub/add_delCity.php?cityid='+cityid+'&opt=del&nocache='+nocache);		
		http.onreadystatechange = CityReply;
		http.send(null);	
		}	
}

function editpoint(){	
var cityID=document.getElementById('cid').value;
		var val=get_val(document.getElementById('txtcity').value);
    	document.getElementById('txtcity').value=val;
	if(document.getElementById('txtcity').value!=''){
	    nocache = Math.random();					
		var cityid=document.getElementById('txtcity').value;
		document.getElementById('search_city').value=cityid;
		http.open('get', 'sub/add_delCity.php?cityid='+cityid+'&editcity='+cityID+'&opt=edit&nocache='+nocache);
		http.onreadystatechange = CityReply;
		http.send(null);	
		document.getElementById('txtcity').value='';
		document.getElementById('txtcity').focus();
	}
	else{
		alert('Enter City Name');
		document.getElementById('txtcity').focus();
	}	
}

function changeCity(cityID,status){
	    var msg='';
		if(status==1){
			msg="Are You Sure to Unblock this City?";
		}
		else{
			msg="";
		}
	    var r = confirm("Are You Sure to Block this City?");
		if(r){
	    nocache = Math.random();			
		var url='sub/ChangeCity.php?cityid='+cityID+'&status='+status+'&nocache='+nocache;		
		http.open('get', url);		
		http.onreadystatechange = CityReply;
		http.send(null);	
		}	
}


function CityReply(){
	if(http.readyState == 4)
      {
		var ar_res=http.responseText.split("-");
		//alert(http.responseText);
		if(ar_res[0]!='0' || ar_res[0]==''){
		}
		else{
		   alert("Sorry Duplicate Entry. Please Check it.");
		   document.getElementById('search_city').value=ar_res[1];
		}
		search_city();
	  }	
}
///////////////////////////////////////////////////  Luxury Item ///////////////////////////////////////////////////////////
function search_lux(){
	var search_str=document.getElementById('search_lux').value;
	var status='';
	pagination('sub/luxmgnt.php',search_str,status);
}

function addlux()
{
	//alert("hello");
		var val=get_val(document.getElementById('luxitem').value);
		//alert(val);
    	document.getElementById('luxitem').value=val;
	if(document.getElementById('luxitem').value!=''){
	    nocache = Math.random();					
		var luxid=document.getElementById('luxitem').value;
		document.getElementById('search_lux').value=luxid;
		http.open('get', 'sub/add_luxitem.php?luxid='+luxid+'&opt=add&nocache='+nocache);
		http.onreadystatechange = luxReply;
		http.send(null);	
		document.getElementById('luxitem').value='';
		document.getElementById('luxitem').focus();
	}
	else{
		alert('Enter Luxury Item');
		document.getElementById('luxitem').focus();
	}		
}

function dellux(luxid){
	    var r = confirm("Are you sure to delete This Luxury Item?");
		if(r){
	    nocache = Math.random();			
		var url='sub/add_luxitem.php?luxid='+luxid+'&opt=del&nocache='+nocache;		
		http.open('get', 'sub/add_luxitem.php?luxid='+luxid+'&opt=del&nocache='+nocache);		
		http.onreadystatechange = luxReply;
		http.send(null);	
		}	
}


function changelux(luxID,status){
	    var msg='';
		if(status==1){
			msg="Are You Sure to Unblock this Luxury Item?";
		}
		else{
			msg="";
		}
	    var r = confirm("Are You Sure to Block this Luxury Item?");
		if(r){
	    nocache = Math.random();			
		var url='sub/Changelux.php?luxid='+luxID+'&status='+status+'&nocache='+nocache;		
		http.open('get', url);		
		http.onreadystatechange = luxReply;
		http.send(null);	
		}	
}

function editluxfun(luxID){	
//alert(luxID);
	document.getElementById('luxitem').value=document.getElementById(luxID).value;	
	document.getElementById('luxitem').focus();
	document.getElementById('addopt').style.display="none";
	document.getElementById('editopt').style.display="block";
	document.getElementById('cid').value=luxID;
}

function editlux()
{	
//alert("hello");
var luxID=document.getElementById('cid').value;
//alert(luxID);
		var val=get_val(document.getElementById('luxitem').value);
    	document.getElementById('luxitem').value=val;
	if(document.getElementById('luxitem').value!=''){
	    nocache = Math.random();					
		var luxid=document.getElementById('luxitem').value;
		document.getElementById('search_lux').value=luxid;
		http.open('get', 'sub/add_luxitem.php?luxid='+luxid+'&editlux='+luxID+'&opt=edit&nocache='+nocache);
		alert("hello");
		http.onreadystatechange = luxReply;
		http.send(null);	
		document.getElementById('luxitem').value='';
		document.getElementById('luxitem').focus();
	}
	else{
		alert('Enter Luxury Item');
		document.getElementById('luxitem').focus();
	}	
}

function luxReply(){
	if(http.readyState == 4)
      {
		var ar_res=http.responseText.split("-");
		//alert(http.responseText);
		if(ar_res[0]!='0' || ar_res[0]==''){
		}
		else{
		   alert("Sorry Duplicate Entry. Please Check it.");
		   document.getElementById('search_lux').value=ar_res[1];
		}
		search_lux();
	  }	
}

///////////////////////////////////////////////////  Block-Unblock Seats Management //////////////////////////////////////////
function getbuslist_fromProviser(sp_id){
	    document.getElementById('bus_show').innerHTML = '<img src="../images/ajax-loader.gif">';	
	    nocache = Math.random();
		http.open('get', 'sub/getbuslist_fromProviser.php?sp_id='+sp_id+'&nocache='+nocache);
		http.onreadystatechange = getbuslist_fromProviserReply;
		http.send(null);	
		
}
function getbuslist_fromProviserReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('bus_show').innerHTML = response;	
		searchBlockseats();
	  }	
}


function searchBlockseats(){
	var arg1=document.getElementById('sp_list').value;
	var arg2=document.getElementById('bus_list').value;
	var dat=document.getElementById('date').value;
	if(dat.match('Select Date'))
	   dat='00-00-0000';
	var arg2=arg2+"||"+dat;	
	
	pagination('sub/blockSeats.php?alpha='+alpha,'','');
		
	return false;
}

function searchBlockseats_new(val1)
{	
  var dat=document.getElementById('date1').value;
	pagination('sub/blockSeats.php',val1,dat);
	return false;
}



function blockThisseat(val,status){
	nocache = Math.random();
	var bus_id=document.getElementById('bus_id').value;
	var dat=document.getElementById('dat').value;
    var to_dat=document.getElementById('dat1').value;
    var sp_id=document.getElementById('sp_id').value;
	var url="sub/blockThisseat.php?bus_id="+bus_id+"&dat="+dat+"&to_dat="+to_dat+"&sp_id="+sp_id+"&seat_no="+val+"&status="+status+'&nocache='+nocache;
		http.open('get', url);
		http.onreadystatechange = blockThisseatReply;
		http.send(null);
}

function blockThisseatReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		alert(response);
		/*if(response==1){
			 alert('This Seat is Blocked on your selected Date');
		}
		else if(response == 0){
			alert('This Seat is Unblocked on your selected Date');
		}
		else if(response == "||"){
			alert('Operation failed.Please Check your Choosen two dates. From date should be > To date.');
		}*/
	  }	
}
///////////////////////////////////////////////////  Booking Management //////////////////////////////////////////

function get_destination_points(t_id)
{ 
	    document.getElementById('loading').innerHTML = '<img src="../images/ajax-loader.gif">';	
	    nocache = Math.random();
		http.open('get', 'sub/getbuslist_destination.php?to_id='+t_id+'&nocache='+nocache);
		http.onreadystatechange = getbuslist_detination;
		http.send(null);
}


function getbuslist_detination(){
	if(http.readyState == 4)
      { 
		var response = http.responseText;
		document.getElementById('get_destination').innerHTML = response;
		 document.getElementById('loading').innerHTML ='';
	  }	
}


function available_buses(){ 
	var arg1=document.getElementById('ter_from').value;
	var arg2=document.getElementById('ter_to').value;
	var dat=document.getElementById('date').value;	
	var service=document.getElementById('servicee').value;
	var triptypee=document.getElementById('triptype').value;
	/*alert(arg1);
	alert(arg2);
	alert(dat);
	alert(service);
	alert(triptypee);*/
	if(arg1!='none' && arg2!='none' && dat!='Select Date' && service!='' && triptypee!=''){	
	   pagination4('sub/bookavailable_bus.php',arg1,arg2,dat,service,triptypee);
	}
	else if(arg1=="none")
		 {
			alert("Select From City");
			document.getElementById('ter_from').focus();
			return false;
		 }
	else if(arg2=="none")
		 {
			alert("Select To City");
			document.getElementById('ter_to').focus();
			return false;
		 }
	else if(dat=="Select Date")
		 {
			alert("Choose the Date");
			document.getElementById('date').focus();
			return false;
		 }
	
}

function available_round(){ 
	var arg1=document.getElementById('ter_from').value;
	var arg2=document.getElementById('ter_to').value;
	var dat=document.getElementById('date').value;
	var dat1=document.getElementById('date1').value;
	var service=document.getElementById('servicee').value;
	var triptypee=document.getElementById('triptype').value;
	/*alert(arg1);
	alert(arg2);
	alert(dat);
	alert(dat1);
	alert(service);
	alert(triptypee);*/
	if(arg1!='none' && arg2!='none' && dat!='Select Date' && dat1!='Select Date' && service!='' && triptypee!=''){	
	   pagination6('sub/bookround_bus.php',arg1,arg2,dat,dat1,service,triptypee);
	}
	else if(arg1=="none")
		 {
			alert("Select From City");
			document.getElementById('ter_from').focus();
			return false;
		 }
	else if(arg2=="none")
		 {
			alert("Select To City");
			document.getElementById('ter_to').focus();
			return false;
		 }
	else if(dat=="Select Date")
		 {
			alert("Choose the Date");
			document.getElementById('date').focus();
			return false;
		 }
	
}




function available_bus(){ 
	var arg1=document.getElementById('ter_from').value;
	var arg2=document.getElementById('ter_to').value;
	var dat=document.getElementById('date').value;	
	var triptypee=document.getElementById('triptype').value;
	//alert(service);
	if(arg1!='none' && arg2!='none' && dat!='Select Date' && triptypee!=''){	
	   pagination1('sub/bookavailable_bus.php',arg1,arg2,dat,triptypee);
	}
	else if(arg1=="none")
		 {
			alert("Select From City");
			document.getElementById('ter_from').focus();
			return false;
		 }
	else if(arg2=="none")
		 {
			alert("Select To City");
			document.getElementById('ter_to').focus();
			return false;
		 }
	else if(dat=="Select Date")
		 {
			alert("Choose the Date");
			document.getElementById('date').focus();
			return false;
		 }
	
}

///////////////////////////////////////////////////  JS to VB conversion ///////////////////////////////////////////////////////
/*function window.confirm(str) {
        execScript('n = msgbox("' + str + '","4132")', "vbscript");
        return (n == 6);
        }*/
///////////////////////////////////////////////////  Cancellation Policy Management //////////////////////////////////////////////
function addpolicy(){ 

	var SP_id=get_val(document.getElementById('service_provider').value);  
	var duration=get_val(document.getElementById('duration').value); //alert('tttt'); return;
	var time=get_val(document.getElementById('time').value); 
	var refund=get_val(document.getElementById('refund').value); 
	 
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/cancelpolicymgnt.php?val='+SP_id+'&duration='+duration+'&time='+time+'&refund='+refund+'&opt=add&nocache='+nocache);
		http.onreadystatechange = addpolicyReply;
		http.send(null);	   
		
}

function addpolicyReply(){
	if(http.readyState == 4)
      { 
		var response = http.responseText; 	
		alert(response);
		document.getElementById('restype').innerHTML = response;
		return;
		//search_SP_name();
	  }	
}

function delpolicy(v){
	    var r = confirm("Are you sure to Delete This cancellation charge policy?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/cancelpolicymgnt.php?val='+v+'&opt=del&nocache='+nocache);
		http.onreadystatechange = delpolicyReply;
		http.send(null);	
		}
}

function delpolicyReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;		
		search_SP_name();
	  }
}


function editpolicy(){
	
	var c_id=get_val(document.getElementById('c_id').value); 
	var SP_id=get_val(document.getElementById('service_provider').value);
	var duration=get_val(document.getElementById('duration').value);
	var time=get_val(document.getElementById('time').value);
	var refund=get_val(document.getElementById('refund').value);
	

	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/cancelpolicymgnt.php?c_id='+c_id+'&val='+SP_id+'&duration='+duration+'&time='+time+'&refund='+refund+'&opt=edit&nocache='+nocache);
		http.onreadystatechange = editpolicyReply;
		http.send(null);	   
}

function editpolicyReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText; 
		document.getElementById('restype').innerHTML = response;
		search_SP_name();
	  }	
}


function inactivepolicy(v){
	    var r = confirm("Are you sure to Block this Cancellation Charge policy?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/cancelpolicymgnt.php?val='+v+'&opt=unblock&nocache='+nocache);
		http.onreadystatechange = inactivepolicyReply;
		http.send(null);	
		}
}

function inactivepolicyReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;
		search_SP_name();
	  }
}


function activepolicy(v){
	    var r = confirm("Are you sure to Unblock this Cancellation Charge policy?");
		if(r){
	    nocache = Math.random();		
		document.getElementById('restype').innerHTML = '<img src="../images/ajax-loader.gif">';		
		http.open('get', 'sub/cancelpolicymgnt.php?val='+v+'&opt=block&nocache='+nocache);
		http.onreadystatechange = activepolicyReply;
		http.send(null);	
		}
}

function activepolicyReply(){
	if(http.readyState == 4)
      {
		var response = http.responseText;
		document.getElementById('restype').innerHTML = response;
		search_SP_name();
	  }
}

////////////////////////////////////////////////// Cancelled Tickets Management //////////////////////////////////////////////////
function search_cancelTickets(){
	var search_str=document.getElementById('provider_search').value;
	
	var ticket=document.getElementById('ticket').value;
	
	var cancel_date=document.getElementById('datepicker1').value;
	
	var travel_date=document.getElementById('datepicker2').value;
		
	var nums = ticket+'^^'+cancel_date+'^^'+travel_date;
	
	pagination('sub/cancelTickets.php',search_str,nums);	
}


/////////////////////////////////////////////////// Bank Details /////////////////////////////////////////////////////////////////
function search_bank(){
	var bankname=document.getElementById('banksearch_txt').value;
	var status=document.getElementById('bank_status').value;	
	pagination('sub/MyBankDetails.php',bankname,status);	
}

/////////////////////////////////////////////////// All Tickets Management ///////////////////////////////////////////////////////
function alltickets()
{
	    var search_str=document.getElementById('spnam').value;
		var ticket=document.getElementById('ticket').value;
		var datepicker=document.getElementById('datepicker').value;
		var frmcity=document.getElementById('frmcity').value;
		var tocity=document.getElementById('tocity').value;
		var nums=ticket+"|"+datepicker+"|"+frmcity+"|"+tocity;
		
		pagination('sub/alltickets.php',search_str,nums);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function delpass(tid,opt)
{
	if(opt == "c")
	var answer = confirm("Are you sure to Cancel this Ticket?");
	if(opt == "d")
	var answer = confirm("Are you sure to Delete this Ticket?");
	if(answer)
	{
		nocache = Math.random();
		http.open('get', 'delpass.php?tid='+tid+'&opt='+opt+'&nocache='+nocache);
		http.onreadystatechange = delpassReply;
		http.send(null);
	}
}

function delpassReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		alert(response);
		search_Psr();
        /*if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Sorry! Could not delete Passanger Details!';
            document.getElementById('response').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'Passanger Details are deleted successfully!';
			
		}*/
    }
}



function check_SPname(sp_name)
{ 		
		var sname = document.getElementById('spname').value;
		
		nocache = Math.random();
		http.open('get', 'sp_name.php?sp_name='+sp_name+'&nocache='+nocache);
		http.onreadystatechange = check_SPnameReply;
		http.send(null);
}

function check_SPnameReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText; 
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = '<font color="green">Service Provider Name is Available</font>';
            //document.getElementById('spname').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '<font color="red">Service Provider Name already exists</font>';
			document.getElementById('spname').focus();
			document.getElementById('spname').value = '';
        }
    }
}


function delusr(uid)
{
	var answer = confirm("Are you sure to Delete this User?");

	if(answer)
	{
		nocache = Math.random();
		http.open('get', 'delete_member.php?memid='+uid);
		http.onreadystatechange = delusrReply;
		http.send(null);
	}
}

function delusrReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText;
		
	//alert(response) ;

		if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = 'Sorry! Could not delete Passanger Details!';
            document.getElementById('response').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('errmsg').innerHTML = '';
            document.getElementById('response').innerHTML = 'Passanger Details are deleted successfully!';
			search_Psr();
		}
    }
}



function searchcollection(){
	var str='';
/*	if(document.getElementById('search_str').value==''){
       str=document.getElementById('sp_id').value;
	}
	else{*/
      
	//}
 	str=document.getElementById('search_str').value;
	//var fromdate=document.getElementById('date').value;
	var arg1=str;
	
	//var arg2=fromdate;
	
	pagination2('sub/paymentmgnt.php',arg1);
}

function searchcollection1(){
	var str='';
/*	if(document.getElementById('search_str').value==''){
       str=document.getElementById('sp_id').value;
	}
	else{*/
      
	//}
 	str=document.getElementById('search_str').value;
	var fromdate=document.getElementById('date').value;
	var arg1=str;
	var bus_id=document.getElementById('b_id').value;
	var arg2=fromdate+"||"+bus_id;
	//alert(bus_id);
	pagination('sub/payment_tran.php',arg1,arg2);
}
function searchcollection2(){
	var str='';
/*	if(document.getElementById('search_str').value==''){
       str=document.getElementById('sp_id').value;
	}
	else{*/
      
	//}
	
 	str=document.getElementById('search_str').value;
	var fromdate=document.getElementById('date').value;
	var arg1=str;
	
	var arg2=fromdate;
	
	pagination('sub/pay_ticketinfo.php',arg1,arg2);
}

function collectionperSP(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var date=document.getElementById('date').value;	
	var busfrom=document.getElementById('from_bus').value;
	var busto=document.getElementById('to_bus').value;	
	var sp_id=document.getElementById('sp_id').value;
	
	var arg1=str;
	var arg2=date+"||"+busfrom+"||"+busto+"||"+status+"||"+sp_id;
	
	pagination('sub/paymentperSP.php',arg1,arg2);	      
}

function collectionperSP1(){
	var str='';
 	str=document.getElementById('sp_id').value;	
	var search_str=str;
	
	
	pagination2('sub/paymentperSP.php',search_str);	      
}


function collectionpertrans(){
	var str='';
 	str=document.getElementById('search_str').value;	
	var date=document.getElementById('date').value;	
	//var busfrom=document.getElementById('from_bus').value;
	//var busto=document.getElementById('to_bus').value;	
	var sp_id=document.getElementById('sp_id').value;
	var b_id=document.getElementById('b_id').value;
	var arg1=str;
	var arg2=date+"||"+b_id+"||"+status+"||"+sp_id;
	
	pagination('sub/paymentpertrans.php',arg1,arg2);	      
}

