
<!DOCTYPE HTML>
<html>
	<head>
		<title>CryptxCoin - Download</title>
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
   		 <!-- Custom Theme files -->
   		  <!---- start-smoth-scrolling---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1500);
				});
			});
		</script>
		 <!---- start-smoth-scrolling---->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----start-top-nav-script---->
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>
		<!----//End-top-nav-script---->

	</head>
	<body>
		<div id="top" class="bg">
		<!----- start-header---->
			<div id="home" class="header">
					<div class="top-header">
						<div class="container">
						<div class="logo">
							<a href="#"><img src="images/logo.png" title="Dasiy" /></a>
						</div>
						<!----start-top-nav---->
						 <nav class="top-nav">
							<ul class="top-nav">
								<li><a href="/public/coin">Home</a></li>
								<li><a href="#wedo" class="scroll">Download</a></li>
							</ul>
							<a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
						</nav>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!----- //End-header---->
						<!---- header-info ---->
			<div class="header-info text-center">
				<div class="container">
					<h1><span> </span><label>Cryptx</label> Cryptocurrency<span> </span></h1>
					<p>Pay people online with the click of a button</p>
					<a class="big-btn down-arrow-to scroll" href="download">Download</a>
					<a class="down-arrow down-arrow-to scroll" href="#wedo"><span> </span></a>
					<label class="mouse-divice"> </label>
				</div>
			</div>
			</div>
			<div class="clearfix"> </div>
			<!---- header-info ---->
			<!--- we do ---->
			<div id="wedo" class="wedo">
				<div class="container">
					<div class="wedo-head text-center">
						<h3>How to<span> Guide</span></h3>
					</div>
					<!--- wedo-grids ---->
					<div class="wedo-grids">
						<div class="col-md-7 col-md-offset-3 wedo-left">
						
						</div>

						<div class="clearfix"> </div>
					</div>
					<!--- wedo-grids ---->
				</div>
			</div>
			<!---- footer ---->
	</body>
</html>

