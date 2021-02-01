<?php 
include '../server/server.php';
include '../includes/pdo_functions.php';
$obj=new user_module($con);
include_once("../header.php"); 

?>
<style>
.pagecontainer2 {
    background: #fff;
    border: 1px solid #cccccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.13);
    position: relative;
	margin: 25px 0;
}
.hpadding50c {
    padding: 20px 50px;
}
.line3 {
    background: #e8e8e8;
    height: 1px;
    margin: 0px 0 0px 0;
    padding: 0;
    display: block;
}
.size30 {
    font-size: 30px;
}
.aboutarrow {
    display: block;
    float: left;
    position: relative;
    left: 50%;
    bottom: -20px;
    width: 25px;
    height: 13px;
    background: url('../images/about-arrow.png') no-repeat;
}
</style>
<div class="logohead cf">
	<div class="pagecontainer2">
				<div class="hpadding50c">
					<p class="size30">Site Map</p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				
			</div>		
</div>
<?php include_once("../includes/footer.php"); ?> 