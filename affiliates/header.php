<link href="../css/purebus.css" rel="stylesheet" type="text/css">
<!--<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="js/bootstrap.min.js"></script>-->
<link href="../fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/style_new.css" rel="stylesheet" type="text/css">

<link href="../css/beetle_combind_css.min.css" rel="stylesheet" />

<link href="../css_fly/icon.css" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" href="css/bootstrap.min_1.css">
  <link href="css/main.css" rel="stylesheet">
    <link href="css/style_1.css" rel="stylesheet"> --> 

<header id="header" class="cf" style="border-bottom: 1px solid #ccc;">

    	

<div class="yatra-header" id="frescoHeader">

   <div class="desktop-only clearfix">

      <div class="main-nav">

         <div class="header-container">

<a href="homepage.php" class="menuBtn" id="menuBtn"><i class="i32 menu">&nbsp;</i></a>
<a href="homepage.php"><img src="../images/redbus_logo1.png" alt="logo" class="log1" /></a>


<div class="menu">

<div class="contact_box">
<div class="left_menu_bg"></div>
<div class="contact_box_inner">
<p>
<img src="../images/icons/print.png"><a href="../print.php">Print</a>
<img src="../images/icons/cancel.png"><a href="../cancel.php">Cancel</a>
<?php if(!isset($_SESSION['first_name']) && $_SESSION['first_name']!=' ' && $_SESSION['user']['first_name']=='') { ?>
<?php } if($_SESSION['user']['user_id']==''){  ?>
<img src="../images/icons/login.png"><a href="../sign_in.php">Login</a>
<img src="../images/icons/register.png"><a href="../register.php">Register</a></span></li>
<img src="../images/wallet.png"><a href="../wallet_new.php">Create Wallet</a>
<?php } else { ?>
<img src="../images/farechart.png"><a href="user_dashboard.php">My Account</a>
<img src="../images/logout.png"><a href="logout.php">Logout</a>
<?php } ?>
</p>
</div>
<div class="right_menu_bg"></div>
</div>
<div class="clear"></div>
<div class="slogan">
<p><img src="../images/call-icon.png"><a href="#">+91-95666&nbsp;23477</a></p>
</div>



               </div>

            </div>

         </div>

      </div>

   </div>

   <script>

      var queryBuilderFresco = {

      	cache:{},

      	get: function(ji, custom) {

      		if(this.cache[ji]) {

      			return this.cache[ji];

      		};

      		var query = (typeof(custom)=="undefined") ? window.location.search.substring(1) : custom;

      		var hu = query;

      		var gy = hu.split("&");

      		for (i=0;i<gy.length;i++) {

      			var ft = gy[i].split("=");

      			if (ft[0] == ji) {

      				var val = decodeURIComponent(ft[1].toString());

      				this.cache[ji] = val;

      				return val;

      			}

      		}

      		return "";

      	}

      };

      var menuId = menuId;

      var activeKey_ = queryBuilderFresco.get("active");

      var menuOriginal = "";

      try {

      if(activeKey_!="") {

      	menuId = activeKey_.toLowerCase();

      }

      if(window["optimizely_new_homepage"]==1) {

      	menuOriginal = menuId.replace("-beetle","");

      } else {

      	menuOriginal = menuId;

      };

      if(menuOriginal && document.getElementById("menu_"+menuOriginal)!=undefined) {

      	$("#menu_"+menuOriginal).addClass('active');

      }

      }

      catch(e){}

      

   </script> <script type="text/javascript">

      if(jQuery!==undefined) {

      	$('.moreNav .moreDdnToggle').hover(function(){

      		$(this).addClass("showChilds");

      

      	}, function() {

      		$(this).removeClass("showChilds");

      

      	});

      }

   </script> 

   <script>

      $(document).ready(function() {

      $("#res_mobile_offers").prop("href",$("#menu_offers").find("a:first").prop("href"));

      })

   </script>

   <script type="text/javascript">

    var HeaderMenu = {

        init: function () {

            this.topMenu(0);

            /* removed - because now css hover is working 

             this.initAppToolTip();    */

        },

        menuOpen: false,

        topMenu: function () {

            var $this = this;

            $('.toggle-me').on('touchstart click', function (e) {

                e.preventDefault();

                e.stopPropagation();

                $this.tooggle();

                if (!$('body').hasClass('opened')) {

                    $('body').addClass('opened');

                    $('body').delegate('*', 'touchstart click', initHamburgerMenuEvnt);

                } else {

                    $('body').removeClass('opened');

                    $('body').undelegate("*", 'touchstart click', initHamburgerMenuEvnt);

                }

                ;

            });

            function initHamburgerMenuEvnt(e) {

                e.preventDefault();

                e.stopPropagation();

                if ($('body').hasClass('opened')) {

                    $this.tooggle();

                    $('body').undelegate("*", 'touchstart click', initHamburgerMenuEvnt);

                    $('body').removeClass('opened');

                }

                ;

            }

            ;



            /*$('.mobile-navs').on('touchmove touchstart mousedown', '.scroll', function(e) {*/

            $('.mobile-navs').delegate('.scroll', 'touchmove touchstart click', function (e) {

                e.stopPropagation();

                if (!$(e.target).hasClass('hbLinks'))

                {

                    e.preventDefault();

                }

                ;

            });

			

			/*nav categories height/vertical scroll set*/

			$('.mobile-navs').css({'height': (($(window).height()))+'px'});

			$(window).on("resize",function(){

				$('.mobile-navs').css({'height': (($(window).height()))+'px'});

			});

			

        },

        /*app download hover box handel*/



        tooggle: function () {

            $('.mobile-navs').toggleClass('nav-open');

            $('.slide').toggleClass('slide-open');

            this.menuOpen = $('.mobile-navs').hasClass('nav-open');

        }

    };

    $(document).ready(function () {

        HeaderMenu.init();



    });





</script> 

</div>

    </header>
    

<?php /* <div class="clearfix"></div>

    <div id="menu-nav" class="cf">



    	<div class="bCrumbs">

                   <a id="bus" <?php if($pageName=='Bus') { ?> class="active" <?php } ?>href="homepage.php">BUSES</a>

                   <a id="hotel" <?php if($pageName=='Hotels') { ?> class="active" <?php } ?> href="homepagehotel.php">HOTELS</a>

                   <a id="offer" <?php if($pageName=='Offerhotels') { ?> class="active" <?php } ?> href="hoteloffer.php">OFFER HOTELS</a>

                   <a id="flight" <?php if($pageName=='Flights') { ?> class="active" <?php } ?> href="homepageflight.php">FLIGHTS</a>

                   <a id="tour" <?php if($pageName=='Holidays') { ?> class="active" <?php } ?> href="homepageholiday.php">HOLIDAYS TOUR</a>

                   <a id="temple" <?php if($pageName=='Temple') { ?> class="active" <?php } ?> href="homepagetemple.php">TEMPLE PACKAGE</a>

                

                 <div class="account_info">

                 	<div class="account_box">

                        <i class="ico_person"></i>

						<p style="float:left">

                        <?php if(isset($_SESSION['user']['first_name']) && $_SESSION['user']['first_name']!='') { ?>

<a href="profile.php">

Myaccouct</a>

</p>|

<a href="logout.php" class="log1">

<div id="Layer26">

<p class="menu" style="margin-top:-8px;" align="center">Logout</p></div>

</a>

<?php } else { ?>

<a href="sign_in.php">Sign In</a> <span style="float: left; margin-top: 6px;">|</span> 

                        <a href="register.php">Register</a>

<?php }

 ?>

                        

                    	

                       

                         

                        

                         

                    </div>

                 </div>

                 </div>

</div>    */     ?>  