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
    <form role="form" action="<?php echo ADMINURL; ?>/updatecoin/" method="POST" class="validate" novalidate="novalidate">

      <div class="row col-margin">
        <div class="col-xs-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="coinname" class="form-control" data-validate="required" value="<?php echo $coin->coin; ?>" data-message-required="<?php _ex(" Coin name "); ?>">
          </div>
        </div>

        <div class="col-xs-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="slogan" class="form-control" data-validate="required" value="<?php echo $coin->description; ?>" data-message-required="<?php _ex(" Coin Description "); ?>">
          </div>
        </div>

        <div class="col-xs-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="cointitle" class="form-control" data-validate="required" value="<?php echo $coin->title; ?>" data-message-required="<?php _ex(" Coin Title "); ?>">
          </div>
        </div>
		<div class="col-xs-6">
		 <label class="col-sm-6 control-label">Coin Enabled </label>

          <div class="col-sm-6">
            <div class="form-block">
              <input type="checkbox" name="maintenance" <?php if($coin->enabled == 1){ echo 'checked="checked"'; } ?>" class="iswitch iswitch-secondary">
            </div>
          </div>
		</div>
      </div>
      <button type="submit" name="submit" class="btn btn-danger ">
        <?php _ex( "Update"); ?>
      </button>
      </label>
      </p>
    </form>
  </div>
</div>