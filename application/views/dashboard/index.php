<style>
#example-2_wrapper {
  max-height: 300px;
  overflow: scroll;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
$("#sellamount").keypress(function (e) {
if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        $("#sellamount").val(0);
               return false;
    }
   }); 


$("#sellprice").keypress(function (e) {
if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        $("#sellprice").val(0);
               return false;
    }
   }); 
  $("#buyprice").keypress(function (e) {
if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        $("#buyprice").val(0);
               return false;
    }
   });

$("#buyamount").keypress(function (e) {
if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        $("#buyamount").val(0);
               return false;
    }
   });    

});


$(document).ready(function()
{ 
done();
openorders();
sellupdate();
buyupdate();

  $("#buycalctotal").click(function(e)
  {
    e.preventDefault();
    var owned = Number($('#buycalctotal').attr('href'));
    var price = Number(document.getElementById('buyprice').value);
    var total = owned / price;
	document.getElementById('buyamount').value = total.toFixed(4);
	return false;
});
  $("#buyorderamount").click(function(e)
  {
    e.preventDefault();
    $('#sellamount').val($('#buyorderamount').attr('href'));
    return false;
  });
 });
 function deleteorder(a,b){
 
     var opts = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
	
      $.ajax(
        {
		  type: 'GET',
		  url: '<?php echo URL;?>/dashboard/deleteorders/',
		  data: 'id=' + a + '&order=' + b,
		  success: function()
          {
          toastr.info("Order has been cancelled", "Order information", opts);
          }
        });
     };
function done(){
setTimeout(function(){ openorders(); sellupdate(); buyupdate(); done(); },5000);
}
function set_price(a,b,c){
buy_price=$("#sellprice");
buy_amount=$("#sellamount");
sell_price=$("#buyprice");
sell_amount=$("#buyamount");
buy_price.val(b);
sell_price.val(b);
1==a && sell_amount.val(c);
2==a && buy_amount.val(c);
}
function openorders()
{
$.getJSON("<?php echo URL;?>/dashboard/myorders?market=<?php echo $coin;?>&type=sell", function(data){
    $("#openorders").find('tbody').empty();
	$.each(data.result, function(){                                                                                
	$("#openorders").find('tbody').append("<tr><td>"+this['amount']+"</td><td>"+this['cost']+"</td><td>"+this['price']+"</td><td>"+this['time']+"</td><td>"+this['buysell']+"</td><td style=\"cursor: pointer;\"  onclick=\"deleteorder("+this['id']+",'"+this['buysell']+"')\"> Cancel</td></tr>");
    })
});
}
function sellupdate()
{
$.getJSON("<?php echo URL;?>/dashboard/openorders?market=<?php echo $coin;?>&type=sell", function(data){
    $("#sellingorders").find('tbody').empty();
	$.each(data.result, function(){
	$("#sellingorders").find('tbody').append("<tr style=\"cursor: pointer;\" onclick=\"set_price(1,"+this['price']+","+this['amount']+")\"><td>"+this['price']+"</td><td>"+this['amount']+"</td><td>"+this['cost']+"</td></tr>");
    })
});
}
function buyupdate()
{
$.getJSON("<?php echo URL;?>/dashboard/openorders?market=<?php echo $coin;?>&type=buy", function(data){
    $("#buyingorders").find('tbody').empty();
	$.each(data.result, function(){
	$("#buyingorders").find('tbody').append("<tr onclick=\"set_price(2,"+this['price']+","+this['amount']+")\"><td>"+this['price']+"</td><td>"+this['amount']+"</td><td>"+this['cost']+"</td></tr>");
    })
});
}
$(document).ready(function()
{
  pagetitle = document.title;
  $.get('<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=buy',
    updatetitle);

  function updatetitle(data)
  {
    document.title = "(" + data + ") " + pagetitle;
  }
  $('#currentbuyprice').load("<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=buy");
  $('#currentsellprice').load("<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=sell");
  setInterval(function()
  {
    function updatetitle(data)
    {
      document.title = "(" + data + ") " + pagetitle;
    }
    $.get('<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=buy', updatetitle);
  }, 3000);
  setInterval(function()
  {
    $('#currentbuyprice').load("<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=buy");
    $('#currentsellprice').load("<?php echo URL;?>/dashboard/dashboardprice?market=<?php echo $coin;?>&type=sell");
  }, 35000)
});

AmCharts.loadJSON = function(url)
{
  if (window.XMLHttpRequest)
  {
    var request = new XMLHttpRequest();
  }
  else
  {
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }
  request.open('GET', url, false);
  request.send();
  return eval(request.responseText);
};
AmCharts.ready(function()
{
  createStockChart();
});
var chartData = AmCharts.loadJSON('<?php echo URL; ?>dashboard/chartdata/?market=<?php echo strtolower($coin); ?>');
var chart;

function createStockChart()
{
  chart = new AmCharts.AmStockChart();
  chart.pathToImages = "<?php echo URL;?>/images/";
  var categoryAxesSettings = new AmCharts.CategoryAxesSettings();
  categoryAxesSettings.minPeriod = "mm";
  chart.categoryAxesSettings = categoryAxesSettings;
  var dataSet = new AmCharts.DataSet();
  dataSet.color = "#b0de09";
  dataSet.fieldMappings = [
  {
    fromField: "value1",
    toField: "value1"
  },
  {
    fromField: "value2",
    toField: "value2"
  }];
  dataSet.dataProvider = chartData;
  dataSet.categoryField = "date";
  chart.dataSets = [dataSet];
  var stockPanel1 = new AmCharts.StockPanel();
  stockPanel1.showCategoryAxis = false;
  stockPanel1.title = "Value";
  stockPanel1.percentHeight = 70;
  var graph1 = new AmCharts.StockGraph();
  graph1.valueField = "value1";
  graph1.type = "smoothedLine";
  graph1.lineThickness = 2;
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderAlpha = 1;
  graph1.bulletBorderThickness = 3;
  stockPanel1.addStockGraph(graph1);
  var stockLegend1 = new AmCharts.StockLegend();
  stockLegend1.valueTextRegular = " ";
  stockLegend1.markerType = "none";
  stockPanel1.stockLegend = stockLegend1;
  var stockPanel2 = new AmCharts.StockPanel();
  stockPanel2.title = "Volume";
  stockPanel2.percentHeight = 30;
  var graph2 = new AmCharts.StockGraph();
  graph2.valueField = "value2";
  graph2.type = "column";
  graph2.cornerRadiusTop = 2;
  graph2.fillAlphas = 1;
  stockPanel2.addStockGraph(graph2);
  var stockLegend2 = new AmCharts.StockLegend();
  stockLegend2.valueTextRegular = " ";
  stockLegend2.markerType = "none";
  stockPanel2.stockLegend = stockLegend2;
  chart.panels = [stockPanel1, stockPanel2];
  var scrollbarSettings = new AmCharts.ChartScrollbarSettings();
  scrollbarSettings.graph = graph1;
  scrollbarSettings.updateOnReleaseOnly = true;
  scrollbarSettings.usePeriod = "10mm";
  scrollbarSettings.position = "top";
  chart.chartScrollbarSettings = scrollbarSettings;
  var cursorSettings = new AmCharts.ChartCursorSettings();
  cursorSettings.valueBalloonsEnabled = true;
  chart.chartCursorSettings = cursorSettings;
  var periodSelector = new AmCharts.PeriodSelector();
  periodSelector.position = "top";
  periodSelector.dateFormat = "YYYY-MM-DD JJ:NN";
  periodSelector.inputFieldWidth = 150;
  periodSelector.periods = [
  {
    period: "hh",
    count: 1,
    label: "1 hour"
  },
  {
    period: "hh",
    count: 2,
    label: "2 hours"
  },
  {
    period: "hh",
    count: 5,
    label: "5 hour"
  },
  {
    period: "hh",
    count: 12,
    label: "12 hours"
  },
  {
    period: "MAX",
    label: "MAX"
  }];
  chart.periodSelector = periodSelector;
  var panelsSettings = new AmCharts.PanelsSettings();
  panelsSettings.mouseWheelZoomEnabled = true;
  panelsSettings.usePrefixes = true;
  chart.panelsSettings = panelsSettings;
  chart.write('chartdiv');
}
$(document).ready(function()
{

});
jQuery(document).ready(function($)
{
  $("#success_msg_1").click(function(ev)
  {
    ev.preventDefault();
    var opts = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
    $.ajax(
    {
      type: 'POST',
      url: '<?php echo URL; ?>dashboard/buycoin/',
      data: 'amount=' + $('#buyamount').val() + '&coin=<?php echo strtolower($coin); ?>' + '&buysell=buy' + '&price=' + $('#buyprice').val(),
      success: function(msg)
      {
        toastr.info(msg, "Coin Purchase information", opts);
      }
    });
  });
});
jQuery(document).ready(function($)
{
  $("#success_msg_2").click(function(ev)
  {
    ev.preventDefault();
    var opts = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };
    $.ajax(
    {
      type: 'POST',
      url: '<?php echo URL; ?>dashboard/buycoin/',
      data: 'amount=' + $('#sellamount').val() + '&coin=<?php echo strtolower($coin); ?>' + '&buysell=sell' + '&price=' + $('#sellprice').val(),
      success: function(msg)
      {
        toastr.info(msg, "Sell Order Information", opts);
      }
    });
  }); 
});
</script>
<div class="modal fade custom-width" id="modal-2">
  <div class="modal-dialog" style="width: 25%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> <?php _ex("Total Price of"); ?> <?php echo
 strtoupper(str_replace("_", "/", $coin)); ?> <?php _ex("to"); ?> <?php _ex("Buy"); ?></h4>
      </div>

      <div class="modal-body">
        <pre id="totalprice"> </pre>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">
          <?php _ex( "Close"); ?>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="col-xs-12 hidden-xs">
  <!-- Basic Setup -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Trading Chart"); ?></h3>

      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">&ndash;</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">&times;</a>
      </div>
    </div>
    <div class="panel-body">
      <div id="chartdiv" style="width:100%; height:500px;"></div>
    </div>
  </div>
</div>

<div class="col-sm-6 ">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"> <?php _ex("Buy"); ?> <?php //echo
//str_replace("_", "/", $coin); ?></h3>
      <div class="panel-options">
        <div class="pull-right"><b><div id="currentbuyprice"></div> <a href="<?php echo $user->{strtolower($coin2[1])}; ?>" id="buycalctotal"><?php echo $user->{strtolower($coin2[1])} . ' ' . $coin2[1]; ?></b>
          </a>
        </div>
      </div>
    </div>
    <div class="panel-body">

      <form role="form">

        <div class="form-group">
          <label class="control-label">
            <?php _ex( "Amount of"); ?>
            <?php echo $coin2[0]; ?>
          </label>

          <div class="row">
            <!-- Input spinner, just add class "spinner" to input-group and it will be activated -->
            <div class="input-group input-group-lg spinner col-sm-12" min="0" data-step="1">
              <span class="input-group-btn">
				 <button class="btn btn-info btn-single" data-type="decrement">-</button>
				 </span>
              <input type="text" class="form-control text-center no-left-border" min="0" maxlength="10" id="buyamount" value="0">
              <span class="input-group-btn">
 <button class="btn btn-info btn-single" data-type="increment">+</button>
 </span>
            </div>
            <br />
            <label class="control-label">
              <?php _ex( "Value of"); ?>
              <?php echo $coin2[0]; ?>
            </label>
            <br />
            <div class="input-group">
              <span class="input-group-addon"><i class="fa-<?php echo strtolower($coin2[1]); ?>"></i></span>
              <input type="text" name="price" value="<?php echo number_format($coinTicker->price($coin2[1] , 'buy'),2); ?>" class="form-control" id="buyprice">
            </div>
          </div>
          <br />
          <?php /* <button data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Calculate how much you will receive after fees have been deducted" data-original-title="Calculate Fees" type="button" onclick="jQuery('#modal-2').modal('show');" id="calculate" name="calculate" class="btn btn-purple btn-icon">
          <span> <?php _ex("Calculate Total"); ?></span>
          <i class="fa-<?php echo strtolower($coin2[0]); ?>"></i>
          </button> */?>
          <button data-toggle="popover" data-trigger="hover" data-placement="left" data-content="<?php _ex("Choose an amount to buy. Use periods for lesser amounts for example: 0.1 or 0.02. Our lowest possible order is 0.0001"); ?>" data-original-title="Buy Information" id="success_msg_1" class="btn btn-blue btn-icon pull-right">
            <span> <?php _ex("Buy"); ?> <?php echo $coin2[0]; ?></span>
            <i class="fa-<?php echo strtolower($coin2[0]); ?>"></i>
          </button>

      </form>

      </div>
    </div>

  </div>
</div>

<!--------------------------------- End of Buy Coin Collumn !------------------------------->
<!--------------------------------- End of Buy Coin Collumn !------------------------------->
<!--------------------------------- End of Buy Coin Collumn !------------------------------->
<!--------------------------------- End of Buy Coin Collumn !------------------------------->
<!--------------------------------- Start of Sell Coin Collumn !------------------------------->
<!--------------------------------- Start of Sell Coin Collumn !------------------------------->
<!--------------------------------- Start of Sell Coin Collumn !------------------------------->
<!--------------------------------- Start of Sell Coin Collumn !------------------------------->

<div class="col-sm-6 col-xs-12 ">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"> <?php _ex("Sell"); ?> <?php //echo
 // str_replace("_", "/", $coin); ?></h3>

      <div class="panel-options">
        <div class="pull-right"><b><div id="currentsellprice"></div> <a href="<?php echo number_format($user->{strtolower($coin2[0])},4); ?>" id="buyorderamount"><?php echo number_format($user->{strtolower($coin2[0])},4) . ' ' . $coin2[0]; ?></a></b>
        </div>
      </div>
    </div>

    <div class="panel-body">
      <form role="form">
        <div class="form-group">
          <label class="control-label">
            <?php _ex( "Amount of"); ?>
            <?php echo $coin2[0]; ?>
          </label>

          <div class="row">
            <!-- Input spinner, just add class "spinner" to input-group and it will be activated -->

            <div class="input-group input-group-lg spinner col-sm-12" data-step="1">
              <span class="input-group-btn">
 <button class="btn btn-info btn-single" data-type="decrement">-</button>
 </span>
              <input type="text" class="form-control text-center no-left-border" maxlength="10" id="sellamount" name="sellamount" value="0" />
              <span class="input-group-btn">
 <button class="btn btn-info btn-single" data-type="increment" >+</button>
 </span>
            </div>
            <br />
            <label class="control-label">
              <?php _ex( "Value of"); ?>
              <?php echo $coin2[0]; ?>
            </label>
            <br />

            <div class="input-group">
              <span class="input-group-addon"><i class="fa-<?php echo strtolower($coin2[1]); ?>"></i></span>
              <input type="text" class="form-control" id="sellprice" name="sellprice" value="<?php echo number_format($coinTicker->price($coin2[1] , 'sell'),2); ?>" />
            </div>
          </div>
          <br />
          <?php /* <button data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Calculate how much you will receive after fees have been deducted" data-original-title="Calculate Fees" type="button" name="calculate" class="btn btn-purple btn-icon"><span> <?php _ex("Calculate Total"); ?></span>
          <i class="fa-<?php echo strtolower($coin2[0]); ?>"></i>
          </button> */?>
          <button data-toggle="popover" data-trigger="hover" data-placement="left" data-content="<?php _ex("Choose an amount to sell. Use periods for lesser amounts for example: 0.1 or 0.02. Our lowest order possible is 0.0001"); ?>" data-original-title="Sell Information" id="success_msg_2" class="btn btn-blue btn-icon pull-right"><span> <?php _ex("Sell"); ?>
            <?php echo $coin2[0]; ?></span>
            <i class="fa-<?php echo strtolower($coin2[0]); ?>"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--------------------------------- End of Sell Coin Collumn !------------------------------->
<!--------------------------------- End of Sell Coin Collumn !------------------------------->
<!--------------------------------- End of Sell Coin Collumn !------------------------------->
<!--------------------------------- End of Sell Coin Collumn !------------------------------->
<!--------------------------------- Start Selling orders table !------------------------------->
<!--------------------------------- Start Selling orders table !------------------------------->
<!--------------------------------- Start Selling orders table !------------------------------->
<!--------------------------------- Start Selling orders table !------------------------------->
<div class="col-xs-12 col-sm-6">
  <!-- Basic Setup -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"> <?php _ex("Selling Orders"); ?></h3>
    </div>
    <div class="panel-body">

      <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
        <table id="sellingorders" class="table table-bordered table-striped dataTable no-footer " role="grid" aria-describedby="example-2_info">
          <thead>
            <tr>
              <th>
                <?php _ex( "Price"); ?>
              </th>
              <th>
                <?php _ex( "Amount"); ?>
              </th>
              <th>
                <?php _ex( "Cost"); ?>
              </th>
            </tr>
          </thead>
			<tbody>
			
			</tbody>
          <tfoot>
            <tr>
              <th>
                <?php _ex( "Price"); ?>
              </th>
              <th>
                <?php _ex( "Amount"); ?>
              </th>
              <th>
                <?php _ex( "Cost"); ?>
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->

<div class="col-sm-6 col-xs-12">
  <!-- Basic Setup -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"> <?php _ex("Buying Orders"); ?></h3>
    </div>
    <div class="panel-body">
      <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
        <table class="table table-bordered table-striped dataTable no-footer " id="buyingorders" role="grid" aria-describedby="example-2_info">
          <thead>
            <tr>
              <th>
                <?php _ex( "Price"); ?>
              </th>
              <th>
                <?php _ex( "Amount"); ?>
              </th>
              <th>
                <?php _ex( "Cost"); ?>
              </th>
            </tr>
          </thead>

          <tfoot>
            <tr>
              <tr>
                <th>
                  <?php _ex( "Price"); ?>
                </th>
                <th>
                  <?php _ex( "Amount"); ?>
                </th>
                <th>
                  <?php _ex( "Cost"); ?>
                </th>
              </tr>
          </tfoot>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- End Sell orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->
<!--------------------------------- Start Open orders table !------------------------------->

<div class="col-sm-12 col-xs-12">
  <!-- Basic Setup -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("My Orders"); ?></h3>
    </div>
    <div class="panel-body">
      <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
        <table class="table table-bordered table-striped dataTable no-footer " id="openorders" role="grid" aria-describedby="example-2_info">
          <thead>
            <tr>		
              <th>
                <?php _ex("Amount"); ?>
              </th>
              <th>
                <?php _ex("Cost"); ?>
              </th>
              <th>
                <?php _ex( "Price"); ?>
              </th>		  
              <th>
                <?php _ex( "Time"); ?>
              </th>
              <th>
                <?php _ex("Buy/Sell"); ?>
              </th>
              <th>
                <?php _ex("Actions"); ?>
              </th>
            </tr>
          </thead>
			<tbody>
			</tbody>

          <tfoot>
            <tr>
                           <th>
                <?php _ex("Amount"); ?>
              </th>
              <th>
                <?php _ex("Cost"); ?>
              </th>
              <th>
                <?php _ex( "Price"); ?>
              </th>		  
              <th>
                <?php _ex( "Time"); ?>
              </th>
              <th>
                <?php _ex("Buy/Sell"); ?>
              </th>
              <th>
                <?php _ex("Actions"); ?>
              </th>
            </tr>
          </tfoot>

        </table>
      </div>
    </div>
</div>
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- End Buying orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->
<!--------------------------------- Start Trade orders table !------------------------------->

<div class="col-sm-12 col-xs-12">
  <!-- Basic Setup -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Trade History"); ?></h3>

      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">&ndash;</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">&times;</a>
      </div>
    </div>
    <div class="panel-body">
      <div id="example-2_wrapper" class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">
        <table class="table table-bordered table-striped dataTable no-footer " id="tradetable" role="grid" aria-describedby="example-2_info">
          <thead>
            <tr>
              <th>
                <?php _ex( "Amount"); ?>
              </th>
              <th>
                <?php _ex( "Coin"); ?>
              </th>
              <th>
                <?php _ex( "Cost"); ?>
              </th>
              <th>
                <?php _ex( "Time"); ?>
              </th>
              <th>
                <?php _ex( "Date"); ?>
              </th>
              <th>
                <?php _ex( "Buy/Sell"); ?>
              </th>
            </tr>
          </thead>

          <?php foreach ($trade as $trades){?>
          <tr>
            <td>
              <?php echo $trades->amount; ?></td>
            <td>
              <?php echo $trades->market; ?></td>
            <td>
              <?php echo $trades->cost; ?></td>
            <td>
              <?php echo $trades->time; ?></td>
            <td>
              <?php echo $trades->date; ?></td>
            <td>
              <?php echo $trades->buysell; ?></td>
          </tr>
          <?php } ?>
          <tfoot>
            <tr>
              <th>
                <?php _ex( "Amount"); ?>
              </th>
              <th>
                <?php _ex( "Coin"); ?>
              </th>
              <th>
                <?php _ex( "Cost"); ?>
              </th>
              <th>
                <?php _ex( "Time"); ?>
              </th>
              <th>
                <?php _ex( "User"); ?>
              </th>
              <th>
                <?php _ex( "Buy/Sell"); ?>
              </th>
            </tr>
          </tfoot>

        </table>
      </div>
    </div>