<link rel="stylesheet" href="<?php echo URL; ?>css/custom.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
 <script>
 $(document).ready(function() {
 	 $("#liveorders").load("<?php echo URL; ?>/home/liveorders");
   var refreshId = setInterval(function() {
      $("#liveorders").load('<?php echo URL; ?>/home/liveorders?randval='+ Math.random());
   }, 9000);
   $.ajaxSetup({ cache: false });

	});
	

$(document).ready(function(){
    $.getJSON('https://cryptxe.co/home/datacharts', function (data) {


        var ohlc = [],
            volume = [],
            dataLength = data.length,

            groupingUnits = [[
                'week',                         
                [1]                             
            ], [
                'month',
                [1, 2, 3, 4, 6]
            ]],

            i = 0;

        for (i; i < dataLength; i += 1) {
            ohlc.push([
                data[i][0], 
                data[i][2], 
                data[i][2],
                data[i][2], 
                data[i][2] 
            ]);

            volume.push([
                data[i][0], 
                data[i][1] 
            ]);
        }

        $('#container').highcharts('StockChart', {

            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'Trade Historical'
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Price'
                },
                height: '60%',
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],

            series: [{
                type: 'candlestick',
                name: 'BTC',
                data: ohlc,
                dataGrouping: {
                    units: groupingUnits
                }
            }, {
                type: 'column',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }]
        });
    });
	});

</script>
<div class="main-content">
<div class="carousel slide " id="myCarousel">
<!-- Indicators -->
<div class="carousel-inner">
   <div class="item active">
      <img alt="First slide" src="img/slide/slide_3.png" />
      <div class="container">
         <div class="carousel-caption">
            <div class="md-intro" style="margin-top: 80.94px;">
               <h1>
               <?php _ex("Welcome to Cryptxe"); ?>
			   </h1>
               <p class="md-description">
               <h2><?php _ex("Start trading Cryptocurrencies today"); ?></h2>
               </p>
               <div class="md-btn-group"><a href="<?php echo URL; ?>user/register" class="btn btn-large btn-success"><?php _ex("Start trading"); ?></a>
                  <a href="<?php echo URL; ?>user/login" class="btn btn-border btn-blue"><?php _ex("Login"); ?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<div class="col-sm-2 col-sm-offset-8">
<select class="form-control" name="chartmarket" onchange="location = this.options[this.selectedIndex].value;">
<option>Select Market</option>
<?php 
		$coinmarket= $this->model->site();
	    $coinmarket = explode(",", $coinmarket->coins);
	    foreach($coinmarket as $coinlinks){ 
 ?>
	<option value="<?php echo URL.'/home?market='.$coinlinks; ?>"><?php echo str_replace('_', '/', $coinlinks); ?></option>
	<?php } ?>
	</select>
</div>
<div class="col-sm-10 col-sm-offset-1">
<div id="container" style="height: 400px; min-width: 310px"></div>
<div class="row">
<div id="liveorders" style="padding-top:55px;"></div>
</div>
 
   <!--close .wrapper--> 
</div>



<section id="top" class="contain clearfix">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="heading centered"><span class="left"></span><span><?php _ex("How it works"); ?></span><span class="right"></span></h3>
      </div>
      <div class="col-lg-3 aligncenter">
        <img src="img/featured-1.png" class="aligncenter" alt="">
        <h5><?php _ex("Account management"); ?></h5>
        <p>
          <?php _ex("Easily maintain your account. View orders, trades, transactions, whitelist IP's and much more"); ?>
        </p>
      </div>
      <div class="col-lg-3 aligncenter">
        <img src="img/featured-2.png" class="aligncenter" alt="">
        <h5><?php _ex("Multiple Markets"); ?></h5>
        <p>
        <?php _ex(" We have multiple Cryptocurrency markets for our users to trade against."); ?>
        </p>
      </div>
      <div class="col-lg-3 aligncenter">
        <img src="img/featured-3.png" class="aligncenter" alt="">
        <h5><?php _ex("API"); ?></h5>
        <p>
         <?php _ex("Easily build 3rd party applications with our public and/or private API -- fully documented, easy to use."); ?>
        </p>
      </div>
      <div class="col-lg-3 aligncenter">
        <img src="img/featured-4.png" class="aligncenter" alt="">
        <h5><?php _ex("2Factor Authentication"); ?></h5>
        <p>
         <?php _ex(" To protect our users and their accounts we have implemented 2factor authentication."); ?>
        </p>
      </div>
    </div>
  </div>
</section>
<section class="gray-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 aligncenter">
        <h4><?php _ex("We are responsive"); ?></h4>
        <p>
         <?php _ex(" Trade on: Desktop, Tablet or Mobile"); ?>
        </p>
        <img src="img/responsive.png" class="max-object margintop20" alt="">
      </div>
      <div class="col-lg-6">
        <h4 class="heading"><span><?php _ex("Why Choose Cryptxe?"); ?></span><span class="left"></span></h4>
        <div class="accordion clearfix" id="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				<?php _ex("Security is our number one objective."); ?>
			</a>
            </div>
            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
              <span></span>
              <div class="accordion-inner">
                <p>
                 <?php _ex("Here at Cryptxe we pride ourself on our security. We are handling people's money, so we need to have a secure system"); ?>
                </p>
              </div>
            </div>
          </div><?php /*
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix">
				<?php _ex("500 Free CryptxCoins Welcome Bonus."); ?>
			</a>
            </div>
            <div id="collapsesix" class="accordion-body collapse" style="height: 0px;">
              <span></span>
              <div class="accordion-inner">
                <p>
                 <?php _ex("New users on Cryptxe are given 500 free Cryptx Coins. These can be used to trade against other markets"); ?>
                </p>
              </div>
            </div>
          </div> */ ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				<?php _ex("Built in Messaging system");?>
								</a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
              <span></span>
              <div class="accordion-inner">
                <p>
            <?php _ex("Depending on your account activity, depends on what messages you will receive. This is a great way to keep an eye on your account."); ?> 
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
					<?php _ex("Whitelist IP's"); ?>
								</a>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
              <span></span>
              <div class="accordion-inner">
                <p>
			<?php _ex("We offer you the chance to whitelist IP's to your account. You will only be able to login to your account with a whitelisted IP if you use this feature."); ?>
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
				<?php _ex("Easy to understand Market Charts");?>
								</a>
            </div>
            <div id="collapseFour" class="accordion-body collapse">
              <span></span>
              <div class="accordion-inner">
                <p>
                 <?php _ex("View the markets information on our charts. See what prices are trending, view volume and much more."); ?>
                </p>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <span></span>
              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
			<?php _ex("API"); ?>				
			</a>
            </div>
            <div id="collapseFive" class="accordion-body collapse">
              <span></span>
              <div class="accordion-inner">
                <p>
                 <?php _ex("Cryptxe has both a public and private API. Making custom applications a breeze."); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>






<script type="text/javascript">// <![CDATA[
   var $ = jQuery.noConflict(); $(document).ready(function() { $('#myCarousel').carousel({ interval: 3000, cycle: true }); });
   // ]]>
</script>