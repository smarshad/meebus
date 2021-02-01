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
					<p class="size30">Careers</p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				<div class="hpadding50c">
					
<div class="career-content">
<div class="inner_text">Take a look at the many exciting job opportunities at meebus. At  meebus, we are committed to attracting and retaining the best  people in our field. We strive to create an excellent working  environment for our employees, just as we aspire to create a memorable  experience for our customers. Recognizing the importance of having a  healthy balance between work &amp; personal life, we offer exciting and  challenging career opportunities, and also give individuals the chance  to grow personally and explore life. <br><br></div>
<div class="inner_text">The meebus team is part of meebus Of India Pvt. Limited,  which has an impeccable reputation that is unrivaled throughout the  industry.  <br><br></div>
<div class="inner_text">If you thrive in the fast-paced and ever changing atmosphere of a people  to people industry, and have the talent, attitude and desire to work  for the best   then you have what it takes to be a member of the Meebus team.  <br><br></div>
<div class="inner_text">For a job opportunity at meebus, email us your resume to <a class="main" href="mailto:info@meebus.com">info@meebus.com</a>. Please include the job designation in the subject line of the email, and we will revert back to you about the same.</div>
</div>		
				</div>
			</div>		
</div>
<?php include_once("../includes/footer.php"); ?> 