<?php  
include_once "../server/server.php";
include "../includes/pdo_functions.php";
$obj=new user_module($con);
include_once "../header.php";
?>
<style>
._3JslKL {
    border-top: 1px solid #eaeaea;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    line-height: 24px;
    font-size: 20px;
    color: #e31e25;
    box-shadow: 0px 2px 6px #222;
    background: #fff;
    margin: 15px auto;
    padding: 25px 15px;
    text-align: center;
}
._3JslKL p i {
	font-size: 50px;
}
</style>
<div  class="inner-content">
    <div class="_3JslKL">
    	<?php /*?><p><i class="fa fa-times-circle"></i></p><?php */?>
        <p>Payment Failed. Please Try Again</p>
    </div>
</div>

 