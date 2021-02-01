/*			function addRow()
			{
				//add a row to the rows collection and get a reference to the newly added row
				var newRow = document.all("tblGrid").insertRow(-1);
				
				//add 3 cells (<td>) to the new row and set the innerHTML to contain text boxes
				
				var oCell = newRow.insertCell(-1);
				oCell.innerHTML = "<input type='text' name='t1' >";
				
				oCell = newRow.insertCell(-1);
				oCell.innerHTML = "<input type='text' name='t2'>";
				
				oCell = newRow.insertCell(-1);
				oCell.innerHTML = "<input type='text' name='t3'> &nbsp;&nbsp;<input type='button' value='Delete' onclick='removeRow(this);'/>";			
			}*/
			
			//deletes the specified row from the table
			function removeRow(src)
			{
				/* src refers to the input button that was clicked.	
				   to get a reference to the containing <tr> element,
				   get the parent of the parent (in this case case <tr>)
				*/		
				//alert(src.id);
				
				var chkval=src.id.split("_");
					var val="b_"+chkval[1]+"-bt_"+chkval[1];
					
					var x1="b_"+chkval[1]; var x2="bt_"+chkval[1];
					var z1=document.getElementById("b_"+chkval[1]).value;
					var z2=document.getElementById("bt_"+chkval[1]).value;
				var arr=document.getElementById('boardlist').value.split(",");

					for(var j=0; j<arr.length;j++ )
					 { 
						if(arr[j]==val)
							arr.splice(j,1);
					  }
					  document.getElementById('boardlist').value=arr; 
					  document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)-1;
				
				
				
				var oRow = src.parentNode.parentNode ;		
				
				//once the row reference is obtained, delete it passing in its rowIndex			
				document.getElementById("dataTable").deleteRow(oRow.rowIndex);	
				
			/*var table = document.getElementById("dataTable");
			var rowCount = table.rows.length;
            var oRow = src.parentNode.parentNode;
			
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				//var chkbox = row.cells[0].childNodes[0];
				var c="chk_"+i;
				var chkbox = document.getElementById(c);
				alert(chkbox);
				if(null != chkbox && true == chkbox.checked) {
					
					
					var chkval=chkbox.id.split("_");
					var val="b_"+chkval[1]+"-bt_"+chkval[1];
					
					var x1="b_"+chkval[1]; var x2="bt_"+chkval[1];
					var z1=document.getElementById("b_"+chkval[1]).value;
					var z2=document.getElementById("bt_"+chkval[1]).value;
					
					//table.deleteRow(i);
					document.getElementById("dataTable").deleteRow(oRow.rowIndex);
					rowCount--;
					i--;
					
					var arr=document.getElementById('boardlist').value.split(",");

					for(var j=0; j<arr.length;j++ )
					 { 
						if(arr[j]==val)
							arr.splice(j,1);
					  }
					  document.getElementById('boardlist').value=arr; 
					  document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)-1;
				}
				
			}*/
			}
		
		function addRowAdmin(tableID,codeid) {
			
			var table = document.getElementById(tableID);
			
			var rowCount = table.rows.length;			
			var row = table.insertRow(rowCount);
			
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chk_"+rowCount;
			//element1.onclick=function(){removeRow(this);}
			cell1.appendChild(element1);
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;
			
			var cell3 = row.insertCell(2);
			var element2 = document.createElement("div");
			var codeval=document.getElementById(codeid).innerHTML;
			var newcode = codeval.replace("b_0","b_"+rowCount);
			while(newcode.indexOf("b_0")>=0) {
				newcode = newcode.replace("b_0","b_"+rowCount);
			}
			
			element2.innerHTML = newcode; /*document.createElement("input");
			element2.type = "text";
			element2.id ="b_"+rowCount;
			element2.setAttribute('name',element2.id);
			element2.setAttribute('className','textbox');
			element2.setAttribute('class','textbox');
			element2.setAttribute('onkeydown',"return chkkeycode(event,this.id)");
			element2.onblur=function(){Trim(this.id);}*/
			
			var oP1=document.createElement("div");
			oP1.style.color = "#FF3300";			
			oP1.style.display = "none";
			oP1.id = element2.id+"_err";
			oP1.appendChild( document.createTextNode("Please Enter Boarding Point") );				
			cell3.appendChild(element2);
			cell3.appendChild(oP1);
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.id="bt_"+rowCount;					
			element3.setAttribute('className','textbox');
			element3.setAttribute('class','textbox');
			element3.setAttribute("name",element3.id);
			element3.setAttribute("id",element3.id);			
			element3.onfocus=function(){time_show(this.id);}
			element3.setAttribute("value","Choose Time");
			element3.setAttribute("readonly","readonly");
			element3.setAttribute('style',"cursor:pointer");
			
			cell4.appendChild(element3);
			
			var oP2=document.createElement("div");
			oP2.style.color = "#FF3300";			
			oP2.style.display = "none";
			oP2.id = element3.id+"_err";
			oP2.appendChild( document.createTextNode("Please Choose Boarding Time") );
			
			cell4.appendChild(oP2);	
			
			document.getElementById('boardlist').value+=","+"b_"+rowCount+"-"+element3.id;
			document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)+1;
			document.getElementById(element3.id).focus();
			/*op2.innerHTML="Please Choose Boarding Time<script>time_show('"+element3.id+"');</script>";*/
		}
		
		function addRow(tableID) {
			
			var table = document.getElementById(tableID);
			
			var rowCount = table.rows.length;			
			var row = table.insertRow(rowCount);
			
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chk_"+rowCount;
			//element1.onclick=function(){removeRow(this);}
			cell1.appendChild(element1);
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;
			
			var cell3 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.id ="b_"+rowCount;
			element2.setAttribute('name',element2.id);
			element2.setAttribute('className','textbox');
			element2.setAttribute('class','textbox');
			element2.setAttribute('onkeydown',"return chkkeycode(event,this.id)");
			element2.onblur=function(){Trim(this.id);}
			
			var oP1=document.createElement("div");
			oP1.style.color = "#FF3300";			
			oP1.style.display = "none";
			oP1.id = element2.id+"_err";
			oP1.appendChild( document.createTextNode("Please Enter Boarding Point") );				
			cell3.appendChild(element2);
			cell3.appendChild(oP1);
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.id="bt_"+rowCount;					
			element3.setAttribute('className','textbox');
			element3.setAttribute('class','textbox');
			element3.setAttribute("name",element3.id);
			element3.setAttribute("id",element3.id);			
			element3.onfocus=function(){time_show(this.id);}
			element3.setAttribute("value","Choose Time");
			element3.setAttribute("readonly","readonly");
			element3.setAttribute('style',"cursor:pointer");
			
			cell4.appendChild(element3);
			
			var oP2=document.createElement("div");
			oP2.style.color = "#FF3300";			
			oP2.style.display = "none";
			oP2.id = element3.id+"_err";
			oP2.appendChild( document.createTextNode("Please Choose Boarding Time") );
			
			cell4.appendChild(oP2);	
			
			document.getElementById('boardlist').value+=","+element2.id+"-"+element3.id;
			document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)+1;
		}
		
		function addRow1(tableID,codeid) {
			
			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;			
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chk1_"+rowCount;
			//element1.onclick=function(){removeRow(this);}
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;

			var cell3 = row.insertCell(2);
			var element2 = document.createElement("div");
			
			var codeval=document.getElementById(codeid).innerHTML;
			var newcode = codeval.replace("d_0","d_"+rowCount);
			while(newcode.indexOf("d_0")>=0) {
				newcode = newcode.replace("d_0","d_"+rowCount);
			}
			
			element2.innerHTML = newcode; /*document.createElement("input");
			element2.type = "text";
			element2.id ="d_"+rowCount;
			element2.setAttribute('name',element2.id);
			element2.setAttribute('className','textbox');
			element2.setAttribute('class','textbox');
			element2.setAttribute('onkeydown',"return chkkeycode(event,this.id)");
			element2.onblur=function(){Trim(this.id);}*/
			
			
			var oP1=document.createElement("div");
			oP1.style.color = "#FF3300";			
			oP1.style.display = "none";
			oP1.id = element2.id+"_err";
			oP1.appendChild( document.createTextNode("Please Enter Droping Point") );				
			cell3.appendChild(element2);
			cell3.appendChild(oP1);
			
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.id="dp_"+rowCount;					
			element3.setAttribute('className','textbox');
			element3.setAttribute('class','textbox');
			element3.setAttribute("name",element3.id);
			element3.setAttribute("id",element3.id);			
			element3.onfocus=function(){time_show(this.id);}
			element3.setAttribute("value","Choose Time");
			element3.setAttribute("readonly","readonly");
			element3.setAttribute('style',"cursor:pointer");
			
			cell4.appendChild(element3);
			
			var oP2=document.createElement("div");
			oP2.style.color = "#FF3300";			
			oP2.style.display = "none";
			oP2.id = element3.id+"_err";
			oP2.appendChild( document.createTextNode("Please Choose Dropping Time") );
			
			
			cell4.appendChild(oP2);	
			
			document.getElementById('droplist').value+=","+"d_"+rowCount+"-"+element3.id;
			document.getElementById('dropcount').value=parseInt(document.getElementById('dropcount').value)+1;
			document.getElementById(element3.id).focus();
		}
		
		function deleteRow(tableID) {
			try { 
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			
			for(var i=0; i<rowCount; i++) {
				//alert(i);
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				var chkbox1 = row.cells[0].childNodes[1];
				//alert(chkbox.innerHTML);
				if((null != chkbox && true == chkbox.checked) || (null != chkbox1 && true == chkbox1.checked)) {			
					if(null != chkbox1) {
						chkbox=chkbox1;
					}			
					//alert(chkbox);
					var chkval=chkbox.id.split("_");
					var val="b_"+chkval[1]+"-bt_"+chkval[1];
					
					var x1="b_"+chkval[1]; 
					var x2="bt_"+chkval[1];
					//var z1=document.getElementById("b_"+chkval[1]).value;
					//var z2=document.getElementById("bt_"+chkval[1]).value;
					//alert(z1+z2);
					table.deleteRow(i);
					rowCount--;
					i--;
					
					var tmnpval=document.getElementById('boardlist').value
					if(tmnpval!='') {
						var arr=tmnpval.split(",");
						
						for(var j=0; j<arr.length;j++ )
						 { 
							if(arr[j]==val)
								arr.splice(j,1);
						  }
						  document.getElementById('boardlist').value=arr; 
						  document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)-1;
					}
				}
			}
			}catch(e) {
				alert(e);
			}
		}
		
		function deleteRow1(tableID) {
			//try { 
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				var chkbox1 = row.cells[0].childNodes[1];
				//alert(chkbox.innerHTML);
				if((null != chkbox && true == chkbox.checked) || (null != chkbox1 && true == chkbox1.checked)) {			
					if(null != chkbox1) {
						chkbox=chkbox1;
					}
					//alert(chkbox);
					var chkval=chkbox.id.split("_");
					var val="d_"+chkval[1]+"-dp_"+chkval[1];
					
					var x1="d_"+chkval[1]; 
					var x2="dp_"+chkval[1];
					var z1=document.getElementById("d_"+chkval[1]).value;
					var z2=document.getElementById("dp_"+chkval[1]).value;
					
					table.deleteRow(i);
					rowCount--;
					i--;
					
					var tmnpval=document.getElementById('droplist').value
					if(tmnpval!='') {
						var arr=tmnpval.split(",");
						
						for(var j=0; j<arr.length;j++ )
						 { 
							if(arr[j]==val)
								arr.splice(j,1);
						  }
						  document.getElementById('droplist').value=arr; 
						  document.getElementById('dropcount').value=parseInt(document.getElementById('dropcount').value)-1;
					}
				}
			}
			/*}catch(e) {
				alert(e);
			}*/
		}
		
		function deleteRowdata(tableID){
			try { 
				var table = document.getElementById(tableID);				
				var rowCount = table.rows.length; 
	
				for(var i=0; i<rowCount; i++) {
					var row = table.rows[i]; 
					var chkbox = row.cells[0].childNodes[0]; 
					var c="chk_"+i;
					//alert(document.getElementById(c).getAttribute("type"));
					if(document.getElementById(c) != null){
					   alert(c);
					if((null != chkbox && true == chkbox.checked) || document.getElementById(c).checked == true) {
						var r=confirm('Are you sure to Delete Borading Point(s)?');
						if(r){							
							var chkval=c.split("_");
							var val="b_"+chkval[1]+"-bt_"+chkval[1];
							
							var x1="b_"+chkval[1]; var x2="bt_"+chkval[1];
							var z1=document.getElementById("b_"+chkval[1]).value;
							var z2=document.getElementById("bt_"+chkval[1]).value;											
							
							if(z1!='' && z2!=''){
							   //alert(z1+"-"+z2);	
							}
							
							table.deleteRow(i);
							rowCount--;
							i--;
		                     var arr=document.getElementById('boardlist').value.split(",");
							for(var j=0; j<arr.length;j++ )
							 { 
								if(arr[j]==val)
									arr.splice(j,1);
							  }
							document.getElementById('boardlist').value=arr; 						  
						   }
						}
						
			   	      } //xtra check
				}
			}
			catch(e) {
				alert(e);
			}
		}
		

		function addRow_new(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;			
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chk_"+rowCount;
			element1.setAttribute('className', 'dis');
			element1.setAttribute('style', 'display:none;');
			
			var img = document.createElement("img");
			img.src="../images/minus_icon.png";
			img.id="img_"+rowCount;
			img.alt="Delete This Point.";
			img.onclick=function(){removeRow(this);}			
			cell1.appendChild(element1);
            cell1.appendChild(img);
			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;

			var cell3 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.id ="b_"+rowCount;
			element2.setAttribute('name',element2.id);
			element2.setAttribute('className','textbox');
			element2.setAttribute('class','textbox');
			element2.setAttribute('onkeydown',"return chkkeycode(event,this.id)");
			element2.onblur=function(){Trim(this.id);}
			
			
			var oP1=document.createElement("div");
			oP1.style.color = "#FF3300";			
			oP1.style.display = "none";
			oP1.id = element2.id+"_err";
			oP1.appendChild( document.createTextNode("Please Enter Boarding Point") );				
			cell3.appendChild(element2);
			cell3.appendChild(oP1);
			
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.id="bt_"+rowCount;					
			element3.setAttribute('className','textbox');
			element3.setAttribute('class','textbox');
			element3.setAttribute("name",element3.id);
			element3.setAttribute("id",element3.id);			
			element3.onfocus=function(){time_show(this.id);}
			element3.setAttribute("value","Choose Time");
			element3.setAttribute("readonly","readonly");
			element3.setAttribute('style',"cursor:pointer");
			
			cell4.appendChild(element3);
			
			var oP2=document.createElement("div");
			oP2.style.color = "#FF3300";			
			oP2.style.display = "none";
			oP2.id = element3.id+"_err";
			oP2.appendChild( document.createTextNode("Please Choose Boarding Time") );
			
			
			cell4.appendChild(oP2);	
			
			document.getElementById('boardlist').value+=","+element2.id+"-"+element3.id;
			document.getElementById('boardcount').value=parseInt(document.getElementById('boardcount').value)+1;
		}

function addRow_new1(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;			
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.id="chk1_"+rowCount;
			element1.setAttribute('className', 'dis');
			element1.setAttribute('style', 'display:none;');
			
			var img = document.createElement("img");
			img.src="../images/minus_icon.png";
			img.id="img_"+rowCount;
			img.alt="Delete This Point.";
			img.onclick=function(){removeRow1(this);}			
			cell1.appendChild(element1);
            cell1.appendChild(img);
			var cell2 = row.insertCell(1);
			cell2.innerHTML = rowCount + 1;

			var cell3 = row.insertCell(2);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.id ="d_"+rowCount;
			element2.setAttribute('name',element2.id);
			element2.setAttribute('className','textbox');
			element2.setAttribute('class','textbox');
			element2.setAttribute('onkeydown',"return chkkeycode(event,this.id)");
			element2.onblur=function(){Trim(this.id);}
			
			
			var oP1=document.createElement("div");
			oP1.style.color = "#FF3300";			
			oP1.style.display = "none";
			oP1.id = element2.id+"_err";
			oP1.appendChild( document.createTextNode("Please Enter Dropping Point") );				
			cell3.appendChild(element2);
			cell3.appendChild(oP1);
			
			
			var cell4 = row.insertCell(3);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.id="dp_"+rowCount;					
			element3.setAttribute('className','textbox');
			element3.setAttribute('class','textbox');
			element3.setAttribute("name",element3.id);
			element3.setAttribute("id",element3.id);			
			element3.onfocus=function(){time_show(this.id);}
			element3.setAttribute("value","Choose Time");
			element3.setAttribute("readonly","readonly");
			element3.setAttribute('style',"cursor:pointer");
			
			cell4.appendChild(element3);
			
			var oP2=document.createElement("div");
			oP2.style.color = "#FF3300";			
			oP2.style.display = "none";
			oP2.id = element3.id+"_err";
			oP2.appendChild( document.createTextNode("Please Choose Dropping Time") );
			
			
			cell4.appendChild(oP2);	
			
			document.getElementById('droplist').value+=","+element2.id+"-"+element3.id;
			document.getElementById('dropcount').value=parseInt(document.getElementById('dropcount').value)+1;
		}
		
		function removeRow1(src)
			{
			
				var chkval=src.id.split("_");
					var val="d_"+chkval[1]+"-dp_"+chkval[1];
					
					var x1="d_"+chkval[1]; var x2="dp_"+chkval[1];
					var z1=document.getElementById("d_"+chkval[1]).value;
					var z2=document.getElementById("dp_"+chkval[1]).value;
				var arr=document.getElementById('droplist').value.split(",");

					for(var j=0; j<arr.length;j++ )
					 { 
						if(arr[j]==val)
							arr.splice(j,1);
					  }
					  document.getElementById('droplist').value=arr; 
					  document.getElementById('dropcount').value=parseInt(document.getElementById('dropcount').value)-1;
				
				
				
				var oRow = src.parentNode.parentNode ;		
				
				document.getElementById("dropping_tbl").deleteRow(oRow.rowIndex);	
			
			}
			
function deltable(tableID) {
	try { 
		var table = document.getElementById(tableID);				
		var rowCount = table.rows.length;
		for(var i=1; i<=rowCount; i++) {
			table.deleteRow(i);
			rowCount--;
			i--;
		}
		
	} catch(e) {
		//alert(e);
	}
}