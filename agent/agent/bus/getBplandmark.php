<?php
include_once'../../server/server.php'; 
echo $bpidsid= '';
$bpidsid1='';
if(isset($_SESSION['agent']['log']['api_select']) && $_SESSION['agent']['log']['api_select']!='')
			{
				if($_SESSION['agent']['log']['api_select']=='redbus')
					{ 
						$bpidsid = $_GET['id'];
						echo $_SESSION['agent']['bus']['boarding'][$bpidsid]['landmark'].','.$_SESSION['agent']['bus']['boarding'][$bpidsid]['location'];

					}
				if($_SESSION['agent']['log']['api_select']=='ispace')
					{ 
						$bpidsid1 = explode('-',$_GET['id']);
						$bpidsid = $bpidsid1[2];
						echo $_SESSION['agent']['bus']['boarding'][$bpidsid]['landmark'].','.$_SESSION['agent']['bus']['boarding'][$bpidsid]['location'];

					}
			}
		

?>