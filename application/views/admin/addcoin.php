<div class="panel col-sm-9 col-xs-12">
  <div class="panel-heading">
    <h3 class="panel-title"><?php _ex("Update Coin"); ?></h3>
    <div class="panel-options">
      <a href="#" data-toggle="panel">
        <span class="collapse-icon">-</span>
        <span class="expand-icon">+</span>
      </a>
      <a href="#" data-toggle="remove">
x </a>
    </div>
  </div>
  <div class="panel-body">
    <form role="form" action="<?php echo ADMINURL; ?>/addcoin/" method="POST" class="validate" novalidate="novalidate">
	<input type="hidden" name="add_coin" value="1">
      <div class="row col-margin">
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="coinname" placeholder="Coin collum Name" class="form-control" data-validate="required" data-message-required="coin Name">
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="cointitle" class="form-control" data-validate="required"  placeholder="Coin title" data-message-required="<?php _ex(" Coin Title "); ?>">
          </div>
        </div>
		
		        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <textarea class="col-xs-12" rows="5" name="coindescription"></textarea>
			</div>
        </div>
		
		<div class="col-xs-12 col-sm-6">
		 <label class="col-sm-6 control-label">Coin Enabled </label>

          <div class="col-sm-6">
            <div class="form-block">
              <input type="checkbox" name="coinenabled" class="iswitch iswitch-secondary">
            </div>
          </div>
		</div>
      </div>
      <button type="submit" name="submit" class="btn btn-danger ">
        <?php _ex( "Add coin"); ?>
      </button>
      </label>
      </p>
    </form>
  </div>
</div>