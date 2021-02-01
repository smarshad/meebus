<?php 
include '../server/server.php';
include '../includes/pdo_functions.php';
$obj=new user_module($con);
include_once("../header.php"); 

?>
<style>
.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.row2 {
		display: block;
		float: none;
		padding: 30px 0;
}

.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.h4, h4 {
    font-size: 1.5rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;
    color: inherit;
	
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
        border-top-color: currentcolor;
        border-top-style: none;
        border-top-width: 0px;
    border-top: 1px solid rgba(0,0,0,.1);
}
hr {
    box-sizing: content-box;
    height: 0;
    overflow: visible;
}
.col-md-6 {
	width: 50%;
	float: left;
}
.h5, h5 {
    font-size: 1.25rem;
}
h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: .5rem;
}
.list-unstyled {
    padding-left: 0;
    list-style: none;
}
dl, ol, ul {
    margin-top: 0;
    margin-bottom: 1rem;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.form-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
.form-row > .col, .form-row > [class*="col-"] {
    padding-right: 5px;
    padding-left: 5px;
}
.form-group {
    margin-bottom: 1rem;
}
.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
button, input {
    overflow: visible;
}
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
textarea {
    overflow: auto;
    resize: vertical;
}
.form-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
button, select {
    text-transform: none;
}
</style>
<div class="logohead cf">
	<div class="container">
	<div class="row2 cf">
	    <div class="col-md-12">
	        <h4>Contact Us</h4>
		    <hr>
	    </div>
		<div class="col-md-6">
		    <div class="address">
		        
		    <h5>Address:</h5>
            <h4>Head Office:</h4>
		    <ul class="list-unstyled">
		        <li>Meebus.com</li>
		        <li></li>
		        <li></li>
               <li> </li>
		    </ul>
		    </div>
		    <div class="email">
		    <h5>Email:</h5>
		    <ul class="list-unstyled">
		        <li> info@meebus.com</li>
		        
		    </ul>
		    </div>
		    <div class="phonee">
		        <h5>Phone:</h5>
		        <ul class="list-unstyled">
		        <li> 0121-403243</li>
		        <!--<li> +91- 8800XXXXXX34</li>-->
		    </ul>
		    </div>
		
		    
		</div>
		<div class="col-md-6">
		    <div class="card">
		        <div class="card-body">
		             <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <input id="Full Name" name="Full Name" placeholder="Full Name" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-6">
                              <input class="form-control" id="inputEmail4" placeholder="Email" type="email">
                            </div>
                          </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="Mobile No." name="Mobile No." placeholder="Mobile No." class="form-control" required type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <input id="Address" name="Address" placeholder="Address" class="form-control" required type="text">
                            </div>
                            <div class="form-group col-md-12">
                                      <textarea id="comment" name="comment" cols="40" rows="5" placeholder="Your Message" class="form-control"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <button type="button" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
		        </div>
		    </div>
		</div>
	</div>
	
	
</div>		
</div>
<?php include_once("../includes/footer.php"); ?> 