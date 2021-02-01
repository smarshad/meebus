<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand cle" href="../index.php"><img src="<?php echo $base_url; ?>images/meebus.png" width="110px"></a>
                    <?php if(isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') { ?>
                    <?php /*?><div class="nav-collapse collapse" >
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo $_SESSION['agent']['log']['agency_name']; ?><i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
  
                                    <li><a tabindex="-1" href="javascript:void(0);">My Account No &nbsp; : <span>AGTVT <?php echo $_SESSION['agent']['log']['id']; ?></span></a> </li>
                                     <li class="divider"></li>
                                    <li><a tabindex="-1" href="javascript:void(0);">Current Balance : <span class="red">Rs. <?php $current_balance = $obj->getAgentBalance($_SESSION['agent']['log']['id']); echo $_SESSION['agent']['log']['account_balance'] = $current_balance; ?></span></a> </li>                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $base_url; ?>logout.php"><span>Logout</span></a>
                                    </li>
         
                                </ul>
                            </li>
                        </ul>
                        
                    </div><?php */?>
					<nav id="primary_nav_wrap">
<ul>
  <li><a href="javascript:void(0);"><i class="icon-user"></i><?php echo $_SESSION['agent']['log']['agency_name']; ?></a>
    <ul>
      <li class="dir"><a tabindex="-1" href="javascript:void(0);">My Account No &nbsp; : <span>AGTVT <?php echo $_SESSION['agent']['log']['id']; ?></span></a></li>
      <li class="dir"><a tabindex="-1" href="javascript:void(0);">Current Balance : <span class="red">Rs. <?php $current_balance = $obj->getAgentBalance($_SESSION['agent']['log']['id']); $_SESSION['agent']['log']['account_balance'] = $current_balance; echo round($_SESSION['agent']['log']['account_balance']); ?></span></a> </li>
      <li class="dir"><a tabindex="-1" href="<?php echo $base_url; ?>logout.php"><span>Logout</span></a></li>
    </ul>
  </li>
</ul>
</nav>
                    <?php } ?>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        
<style>
#primary_nav_wrap ul
{
	color: white;
    float: right;
    list-style: outside none none;
    margin: 0;
    top: 0;
}

#primary_nav_wrap ul a
{
display: block;
color: #000; 
text-decoration:none;
font-weight:700;
font-size: 15px;
padding: 15px 15px;
-webkit-transition: all 150ms linear;
-moz-transition: all 150ms linear;
-ms-transition: all 150ms linear;
-o-transition: all 150ms linear;
transition: all 150ms linear;
}

#primary_nav_wrap ul ul li a:hover
{
	color: #fff;
}
#primary_nav_wrap ul a:hover
{
color: #000;
/*text-shadow: 0 0 2px white;
-webkit-text-shadow: 0 0 2px white;
-moz-text-shadow: 0 0 2px white;
-o-text-shadow: 0 0 2px white;
-ms-text-shadow: 0 0 2px white;
-webkit-transition: all 150ms linear;
-moz-transition: all 150ms linear;
-ms-transition: all 150ms linear;
-o-transition: all 150ms linear;
transition: all 150ms linear;*/
}

#primary_nav_wrap ul a:active
{

	color: #8ABF29;
    -webkit-transition: all 50ms linear;
-moz-transition: all 50ms linear;
-ms-transition: all 50ms linear;
-o-transition: all 50ms linear;
transition: all 50ms linear;
}

#primary_nav_wrap ul li
{
	position:relative;
	float:left;
	margin:0;
	padding:0
}


#primary_nav_wrap ul ul
{
	display:none;
	position:absolute;
	top:100%;
	left:0;
	padding:0;
	margin-left:-120px;
}

#primary_nav_wrap ul ul li
{
	float:none;
	width:100%;
	background:#fff; 
	border-bottom: 1px solid #999;
}

#primary_nav_wrap ul ul a
{
	line-height:120%;
	padding:10px 15px;
}


#primary_nav_wrap ul ul ul
{
	top:0;
	left:100%

}

#primary_nav_wrap ul li:hover > ul
{
	display:block

}
</style>        