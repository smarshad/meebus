<?php
session_start();
error_reporting(1); 
include('server/server.php');
GLOBAL $conn;   

	$_SESSION['user']['common']['url']		=	'http://localhost/meebus/';
	$_SESSION['user']['common']['title']	=	'Meebus';



if(isset($_SESSION['user']['common']['url'])){
    
$base_url=$_SESSION['user']['common']['url'];

$myotpverifydata = $_POST['code1'];
$passmobidata = $_SESSION['passmobi'];
$otpmobidata = $_SESSION['otpmobi'];


if($_POST['code1'] == $_SESSION['otpmobi']){
    
   

    // my codes
    
    $stmt1 = "SELECT * FROM `user_login`";
    $query = $conn->query($stmt1);
    
    if($query == true){
          
        
        while($row = mysqli_fetch_assoc($query)){
        
       
        
    // print_r($_SESSION['user_email_address']);
    if($row['mobile_number'] == $_SESSION['passmobi']){
        

        
        $_SESSION['user']['log']['id'] = $row['id'];
        $_SESSION['user']['log']['firstName'] = $row['first_name'];
        $_SESSION['user']['log']['balance'] = $row['balance'];
        
        header('location: index.php');
        echo "Login Successful";
        break;
        
    }elseif($row['mobile_number'] != $_SESSION['passmobi'] && $_SESSION['passmobi'] != NULL){

        
        $pass1 = '123456';
        $first = 'New';
        $last = 'User';
        $date = date('Y-m-d h:i:s');
        
        $sql1 = "INSERT INTO `user_login`(`oauth_provider`, `oauth_uid`, `email_id`, `password`, `city`, `mobile_number`, `title`, `first_name`, `middle_name`, `last_name`, `country`, `state`, `address`, `pincode`, `alt_email_id`, `status`, `otp`, `email_otp`, `balance`, `bus_markup`, `bus_markup_mode`, `bus_user_comm`, `payment_gateway_charge`, `unique_id`, `facebookid`, `created_datetime`) 
                                    VALUES ('', '',  'NULL', '$pass1', '', '$passmobidata', '', '$first', '', '$last', 'India', '', '', '0', '', '1', '$otpmobidata', '$otpmobidata', '0', '0', '', '0', '0', '0', '0', '$date')";
        $qu = $conn->query($sql1);
       
       
        if ( $qu === TRUE) {
              // echo "New record created successfully";
            
            $row = mysqli_fetch_assoc($qu);
            
               $_SESSION['user']['log']['id'] = $row['id'];
                $_SESSION['user']['log']['firstName'] = $row['first_name'];
                $_SESSION['user']['log']['balance'] = $row['balance'];
                
              header('index.php');
        } 

            $conn->close();

        if($qu == true){
        
        $sql2 = "SELECT * FROM `user_login` ORDER BY `id` DESC";
        $query1 = mysqli_query($conn, $sql2);
        
        while($result1 = mysqli_fetch_assoc($query1)){
            
        $_SESSION['user']['log']['id'] = $result1['id'];
        $_SESSION['user']['log']['firstName'] = $result1['first_name'];
        $_SESSION['user']['log']['balance'] = $result1['balance'];
        
        header('location:index.php');
        // echo "Login Successful";
        break;
        } // while brace end here
        echo "<div class='alert alert-success'>Login successfully Done Your Default password is : 123456 change it from user menu for later ";
        header('location:index.php');
        
        } // query success brace end here
        
    }
        // else if brace end here
        
        
        
        
        }
    
    }else{
         echo "Failed to Login "; 
    }
    
    // my codes end here
    
    
    
// 	$txtmobile=$passmobidata;	
//     $data=array($txtmobile,1);	
//     $login=$obj->userMobileLogin($data);


//     if($login==0){	

//     $fname="User";
// 	$mobile=$txtmobile;	
// 	$unique=time().rand(10000,99999);	
// 	$data=array($fname,$mobile,$unique);
// 	$res=$obj->insregisterthroughmobile($data); 	

// 	$txtmobile=$passmobidata;	
//     $data2=array($txtmobile,1);	   

// 	$login1=$obj->userMobileLogin($data2);
// 	$login1=$login1[0];		
// 	$_SESSION['user']['log']['id']=$login1['id'];		
// 	$_SESSION['user']['log']['firstName']=$login1['first_name'];	
// 	$_SESSION['user']['log']['balance']=$login1['balance'];	
//     echo "SUCCESS";
//     header('location:index.php');
    
//     }else{

//     	$login=$login[0];		
//         $_SESSION['user']['log']['id']=$login['id'];		
//         $_SESSION['user']['log']['firstName']=$login['first_name'];	
//         $_SESSION['user']['log']['balance']=$login['balance'];		
// 	 	echo "SUCCESS";
// 	 	header('location:index.php');
// 	}
        }else{
            echo "<script>alert('Login Failed Try Again Later');</script>";
            header('location: index.php');
            
        }
}else{
    header('location: index.php');
}
?>
                