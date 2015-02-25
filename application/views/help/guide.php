<script>
$(document).ready(function() {
$("a.guideurl").click(function(){
    $.ajax({
        type: 'GET',
        url: '<?php echo URL;?>help/viewguides/',
        data: 'guideurl=' + $(this).attr("value"),
        success: function(msg) {
            $('#panel-body').html(msg);
        }
      });
});
});
</script>

<div class="col-sm-9"> 
<div class="panel panel-default">
<div class="panel-heading"> <h3 class="panel-title"> User Guides </h3>
<div class="panel-options"> <a href="#" data-toggle="panel">
<span class="collapse-icon">-</span> <span class="expand-icon">+</span></a> 
<a href="#" data-toggle="remove">x</a> </div></div><div id="panel-body" class="panel-body"> 
</div></div> </div>
<div class="col-sm-3">
				
			<ul class="list-group list-group-minimal">
			<?php foreach ($guides as $guide) { ?>							
			<li class="list-group-item">
			<span class="badge badge-roundless badge-primary"></span>
			<a href="javascript:void(0)" value="<?php echo $guide->url; ?>" class="guideurl"><?php echo $guide->title; ?>
					</li>
						<?php } ?>
			</ul>
</div></div>