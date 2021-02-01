<!DOCTYPE html>
<html>
  <head>
<?php include_once "header.php"; ?>
<style>
img.fail {
	width: 170px;
	margin: 15px auto;
	display: block;
}

.container {
    max-width: 1200px;
}
.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;

}

.mt25 {
    position: relative;
    margin-top: 25px;
    margin-bottom: 25px;
}
.pagecontainer2 {
    background: #fff;
    border: 1px solid #cccccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.13);
    position: relative;
}
.offset-0 {
    padding-left: 0px;
    padding-right: 0px !important;
}
.hpadding50c {
    padding: 20px 10px;
}
.red {
    color: #E21D24;
}
.size30 {
    font-size: 30px;
}
.lato {
    font-family: "Lato";
}
.slim {
    font-weight: 300;
}
.text-center {
    text-align: center;
}
.aboutarrow {
    display: block;
    float: left;
    position: relative;
    left: 50%;
    bottom: -20px;
    width: 25px;
    height: 13px;
    
}
.line3 {
    background: #e8e8e8;
    height: 1px;
    margin: 0px 0 0px 0;
    padding: 0;
    display: block;
}
</style>
  </head>
  <body id="top" class="thebg" >
	
	<div class="container breadcrub">
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	
	<!-- CONTENT -->
    <div class="container">
		<div class="container mt25 offset-0">
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				<div class="hpadding50c">
					<p class="lato size30 slim text-center red">Email ID AND Ticket Number Is Invalid</p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				<div class="hpadding50c">
                	<img src="images/failed.png" alt="failure" class="fail">
				</div>
			<div class="clearfix"></div>
			</div>
			<!-- END CONTENT -->			
		</div>
	</div>
	
  </body>
</html>
<?php include 'includes/footer.php'; ?>