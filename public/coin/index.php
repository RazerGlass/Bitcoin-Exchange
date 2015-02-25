
<!DOCTYPE HTML>
<html>
	<head>
		<title>CryptxCoin - Homepage</title>
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<meta name="description" content="CryptxCoin is a cryptocurrency with Sha-256 Protection.">
        <meta name="keywords" content="cryptxcoin,crytpocurrency, cxc, coins, money, sha256">
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
								<li><a href="#about" class="scroll">About</a></li>
								<li><a href="#wedo" class="scroll">wedo</a></li>
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
					<a class="big-btn" href="download">Download</a>
					<a class="down-arrow down-arrow-to scroll" href="#about"><span> </span></a>
					<label class="mouse-divice"> </label>
				</div>
			</div>
			</div>
			<div class="clearfix"> </div>
			<!---- header-info ---->
			<!--- about-us ---->
			<div id="about" class="about">
				<div class="container">
					<div class="about-head text-center">
						<h3>What is a <span>Cryptocurrency?</span></h3>
						<p>A cryptocurrency (or crypto currency) is a medium of exchange using cryptography to secure the transactions and to control the creation of new units (coins)</p>
					</div>
					<!--- about-grids ---->
					<div class="about-grids">
						<div class="col-md-3">
							<div class="about-grid text-center">
								<span class="about-icon1"> </span>
								<h3>Sha256 Security<br /><label> </label></h3>
								<p>SHA-2 is a set of cryptographic hash functions designed by the NSA (U.S. National Security Agency). SHA stands for Secure Hash Algorithm.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="about-grid text-center">
								<span class="about-icon2"> </span>
								<h3>21 Million Coins<br /><label> </label></h3>
								<p>There will be 21,000,000 coins in total . There can never be more than that limit.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="about-grid text-center">
								<span class="about-icon3"> </span>
								<h3>Instant transactions<br /><label> </label></h3>
								<p>CryptxCoin transactions are sent from and to electronic CryptxCoin wallets, and are digitally signed for security. </p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="about-grid text-center">
								<span class="about-icon4"> </span>
								<h3>Low-Fee Transactions<br /><label> </label></h3>
								<p>CryptxCoin Supports zero to low-fee transactions. Don't be overcharged for moving money; use CryptxCoin</p>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<!--- about-grids ---->
				</div>
				<a class="about-down-icon down-arrow-to scroll" href="#expand"><span> </span></a>
			</div>
			<!--- about-us ---->
			<div id="process" class="process">
				<div class="container">
					<div class="about-head text-center">
						<h3>our <span>process</span></h3>
						<p>Easily follow the proccess of how CryptxCoins work.</p>
					</div>
					<div class="process-grid text-center">
						<img src="images/process.png" title="process" />
						<a class="p-down-arrow down-arrow-to scroll" href="#wedo"><span> </span></a>
					</div>
				</div>
			</div>
			<!--- we do ---->
			<?php /*
			<div id="wedo" class="wedo">
				<div class="container">
					<div class="wedo-head text-center">
						<h3>what do <span>we do?</span></h3>
					</div>
					<!--- wedo-grids ---->
					<div class="wedo-grids">
						<div class="col-md-6 wedo-left">
							<h4><label> </label>Landing Pages</h4>
							<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra,</p>
							<a class="wedobtn" href="#">More details</a>
						</div>
						<div class="col-md-6 wedo-right">
							<img src="images/divices.png" title="demo" />
						</div>
						<div class="clearfix"> </div>
					</div>
					<!--- wedo-grids ---->
					<a class="w-down-arrow down-arrow-to scroll" href="#advertising"><span> </span></a>
				</div>
			</div>
			*/?>
			<!---- footer ---->
	</body>
</html>

