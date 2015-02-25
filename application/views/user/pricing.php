<style>

.cursor{
    cursor: pointer;
}

.tableblock ul{
    margin: 0;
    padding: 0;
}

.tableblock{
    width: 25%;
    float: left;
    border: 1px solid;
    padding-bottom: 20px;
    font-family: 'Open Sans', sans-serif;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    box-shadow: 0px 0px 48px rgba(0, 0, 0, 0.13);
}

.tableblock h4{
    padding: 40px 0 0;
    margin: 0;
    text-align: center;
    font-size: 32px;
    line-height: 34px;
    text-transform: uppercase;
    font-weight: 300;
}

.tableblock p {
    text-align: center;
    margin: 0 0 16px;
}

.tableblock .price {
    font-size: 42px;
    text-align: center;
    display: inherit;
    font-weight: 600;
}

.tableblock .section-top{
    padding-bottom: 27px;
}

.tableblock .section-info li{
    list-style: none;
    border-top: 1px solid;
    font-size: 12px;
    line-height: 40px;
    padding-left: 5%;
}

.tableblock .section-info li .good{
    margin-right: 7px;
}

.tableblock .section-info li .bad{
    margin-right: 9px;
}

.tableblock .section-info {
    border-bottom: 1px solid;
}

.section-footer a{
    display: block;
    margin: 20px auto 0;
    width: 70%;
    height: 32px;
    line-height: 32px;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.float{
    display: inline-block;
    -webkit-transition-duration: 0.8s;
    transition-duration: 0.8s;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
}

/* ----- Blue style -------*/

.blue-style{
    background: #fff;
    border-color:  #CFE7F9;
    border-top-color: #0E6CB4;
}

.blue-style .section-info{
    border-color: #CFE7F9;
}

.blue-style .section-info li{
    border-color: #CFE7F9;
}

.blue-style .section-info li .good{
    color: #32AB26;
}

.blue-style .section-info li .bad{
    color: #E23D16;
}

.blue-style .section-top.favorite{
    background-color: #0E6CB4;
    background-image: -webkit-gradient(
            linear,
            left top,
            left bottom,
            color-stop(0, #0E6CB4),
            color-stop(1, #00A3E2)
    );
    background-image: -o-linear-gradient(bottom, #0E6CB4 0%, #00A3E2 100%);
    background-image: -moz-linear-gradient(bottom, #0E6CB4 0%, #00A3E2 100%);
    background-image: -webkit-linear-gradient(bottom, #0E6CB4 0%, #00A3E2 100%);
    background-image: -ms-linear-gradient(bottom, #0E6CB4 0%, #00A3E2 100%);
    background-image: linear-gradient(to bottom, #0E6CB4 0%, #00A3E2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#0E6CB4', endColorstr='#00A3E2');
    color: #ffffff;
    text-shadow: 1px 0px 0px rgba(0, 0, 0, 0.46);
}

.blue-style .section-top.favorite .price{
    color: #ffffff;
}

.blue-style .price{
    color: #2986CD;
}

.blue-style .section-footer a{
    background-color: #2986CD;
    color: #ffffff;
}
.blue-style .section-footer a:hover{
    background-color: #0099d5;
}
.blue-style .section-info li:nth-child(2n){
    background-color: #F1F6FE;
}



</style>
 
<div class="col-sm-12">
<!-- Blue Style -->
    <!-- Table 2 -->
    <section class="tableblock border2 float cursor blue-style">
        <!-- Section top -->
        <div class="section-top">
            <h4><?php _ex("Starter"); ?></h4>
            <span class="price">$2,500</span>
            <p><?php _ex("Yearly"); ?></p>
        </div>
        <!-- /Section top -->
        <!-- Section info -->
        <div class="section-info">
            <ul>
                <li><i class="fa fa-check good"></i><?php _ex("Trade up to $500,000 monthly"); ?></li>
                <li><i class="fa fa-check good"></i><?php _ex("No Fees on trades in any market"); ?></li>
            </ul>
        </div>
        <!-- /Section info -->
        <!-- Section footer -->
        <div class="section-footer">
            <a href="#" class="cursor buzz-out"><?php _ex("Add to Cart"); ?></a>
        </div>
        <!-- /Section footer -->
    </section>
    <!-- /Table 2 -->

    <!-- Table 3 -->
    <section class="tableblock border4 float cursor blue-style">
        <!-- Section top -->
        <div class="section-top favorite">
            <h4><?php _ex("Enterprise"); ?></h4>
            <span class="price">$7,500</span>
            <p><?php _ex("Yearly"); ?></p>
        </div>
        <!-- /Section top -->
        <!-- Section info -->
        <div class="section-info">
            <ul>
                <li><i class="fa fa-check good"></i><?php _ex("No limit on trades"); ?></li>
                <li><i class="fa fa-check good"></i><?php _ex("No Fees on trades in any market"); ?></li>
            </ul>
        </div>
        <!-- /Section info -->
        <!-- Section footer -->
		<br/>
        <div class="section-footer">
	   <form  method="post" action="https://www.okpay.com/process.html" target="_blank">
	   <input type="hidden" name="ok_receiver" value="OK896242887"/>
	   <input type="hidden" name="ok_item_1_name" value="Cryptxe member"/>
	   <input type="hidden" name="ok_item_1_type" value="donation">
	   <input type="hidden" name="ok_item_1_price" value="7500">
	   <input type="hidden" name="ok_currency" value="USD"/>
	   <input type="hidden" name="ok_fees" value="1"/>
	   <!-- Do not edit this unless you want someone else to get your payment!-->
	   <input type="hidden" name="ok_item_1_custom_1_value" value=" <?php echo $user->username; ?>"/>
	   <input type="hidden" name="invoice" value="<?php echo uniqid(); ?>"/>
	   <button type="image" name="submit" class="cursor buzz-out"/>Add to cart</button>
        <!-- /Section footer -->

    </section>
    <!-- /Table 3 -->
        <!-- /Section footer -->
    </section>
    <!-- /Table 4 -->
<!-- /Blue Style -->
</section>
	  <p><center>	<i></i></center></p>