<div class="panel col-sm-9 col-xs-12">
  <div class="panel-heading">
    <h3 class="panel-title"><?php _ex("Edit Information"); ?></h3>
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
    <form role="form" action="<?php echo ADMINURL; ?>/updatesettings/" method="POST" class="validate" novalidate="novalidate">

      <div class="row col-margin">
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="sitename" class="form-control" data-validate="required" value="<?php echo $setting->sitename; ?>" data-message-required="<?php _ex(" Please enter your Website Name "); ?>">
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="slogan" class="form-control" data-validate="required" value="<?php echo $setting->slogan; ?>" data-message-required="<?php _ex(" Please enter your Website slogan "); ?>">
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="siteurl" class="form-control" data-validate="required" value="<?php echo $setting->siteurl; ?>" data-message-required="<?php _ex(" Please enter your Website URL "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="keywords" class="form-control" data-validate="required" value="<?php echo $setting->keywords; ?>" data-message-required="<?php _ex(" Please enter your SEO Keywords "); ?>">
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="description" class="form-control" data-validate="required" value="<?php echo $setting->description; ?>" data-message-required="<?php _ex(" Please enter your SEO Description "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
           <textarea name="coins">
<?php echo $setting->coins; ?>		   
		   </textarea></div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="fees" class="form-control" data-validate="required" value="<?php echo $setting->fees; ?>" data-message-required="<?php _ex(" Please enter your Market Fees "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="vat" class="form-control" data-validate="required" value="<?php echo $setting->vat; ?>" data-message-required="<?php _ex(" Please enter your Company Number "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="address" class="form-control" data-validate="required" value="<?php echo $setting->address; ?>" data-message-required="<?php _ex(" Please enter your Address "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="phonenumber" class="form-control" data-validate="required" value="<?php echo $setting->phonenumber; ?>" data-message-required="<?php _ex(" Please enter your Company Phone Number "); ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="linecons-user"></i>
            </div>
            <input type="text" name="email" class="form-control" data-validate="required" value="<?php echo $setting->email; ?>" data-message-required="<?php _ex(" Please enter your Company Email "); ?>">
          </div>
        </div>

        <div class="col-xs-12 col-sm-6">
          <label class="col-sm-6 control-label">Require Email Verification</label>

          <div class="col-sm-6">
            <div class="form-block">
              <input name="emailverify" type="checkbox" <?php if($setting->emailverify == 1){ echo 'checked="checked"'; } ?>" class="iswitch iswitch-secondary">
            </div>
          </div>
		  </div>
		  <div class="col-xs-12 col-sm-6">
          <label class="col-sm-6 control-label">Require Identification verification </label>

          <div class="col-sm-6">
            <div class="form-block">
              <input type="checkbox" name="idverify" <?php if($setting->userverify == 1){ echo 'checked="checked"'; } ?>" class="iswitch iswitch-secondary">
            </div>
          </div>
        </div>
		<div class="col-xs-12 col-sm-6">
		 <label class="col-sm-6 control-label">Maintenance mode </label>

          <div class="col-sm-6">
            <div class="form-block">
              <input type="checkbox" name="maintenance" <?php if($setting->maintenance == 1){ echo 'checked="checked"'; } ?>" class="iswitch iswitch-secondary">
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