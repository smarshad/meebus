<?php
if(!isset($_SESSION['admin']['log']['id']) && $_SESSION['admin']['log']['id']=='')
{
	header('location:index.php');
	exit;
}
$admin_id=$_SESSION['admin']['log']['id'];

?>
<style>
span#cart-total {
    background: #f04848;
    border-radius: 20px;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    font-weight: bold;
    height: 20px;
    line-height: 18px;
    text-align: center;
    vertical-align: top;
    width: 20px;
}
.navbar .nav>li>a {
    float: none;
    padding: 15px 15px 15px;
    color: #000;
	padding-right:15px !important;
    text-decoration: none;

}

.navbar .nav>li>:hover {
  background:#E2273A !important;
  color:#FFF !important; 
}

.nav > li a:hover > i.cons, .nav > li a:hover > span {
    color: #FFF !important;
}

.dropdown-menu > li > a {
    clear: both;
    color: #fff !important;
    display: block;
    font-weight: normal;
    line-height: 20px;
    padding: 3px 20px;
    white-space: nowrap;
	background:#E2273A !important;
}

.dropdown-menu > li > a:hover {
    clear: both;
    color: #fff !important;
    display: block;
    font-weight: normal;
    line-height: 20px;
    padding: 3px 20px;
    white-space: nowrap;
	background:#c6c6c6 !important;
}
 
.navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle span .username {
    background-color: #c6c6c6 !important;
    color: #fff !important;
	white-space: nowrap !important;
} 
.dropdown.open .username {
    color: #fff;		
}
</style>

<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="javascript:void(0);" style="background:#e2273a;height: 38px;">Admin Panel</a>
                    
                    <?php if(isset($_SESSION['admin']['log']['id']) && $_SESSION['admin']['log']['id']!='') { ?>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                         
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"  style="padding: 0;"><span class="username"><?php echo$_SESSION['common']['admin']['login'];?></span> <img src="<?php echo $base_url; ?>images/profile.png" alt="" class="img-user"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <!--<li>
                                        <a tabindex="-1" href="<?php echo $base_url; ?>profile.php">Profile</a>
                                    </li>-->
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $base_url; ?>logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                    <?php } ?>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>