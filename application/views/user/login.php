<script>
jQuery(document).ready(function($)
{
$('#pass').keypress(function(e) { 
    var s = String.fromCharCode( e.which );
    if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
	    document.getElementById('capslock').style.visibility = 'visible';
    }else{
        document.getElementById('capslock').style.visibility = 'hidden';
    }
})});
</script>
<div class="col-sm-6 col-sm-offset-3 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Login form"); ?></h3>
      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">–</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">×</a>
      </div>
    </div>
    <div class="panel-body">
      <form method="POST" action="<?php echo URL; ?>user/login" role="form">
        <input value="1" name="check_submit" type="hidden" />
        <div class="form-group">
          <input type="text" name="mail" value="<?php echo htmlspecialchars($this->model->decrypt($email),ENT_QUOTES); ?>" class="form-control" size="25" placeholder="<?php _ex(" Email "); ?>">
        </div>
        <div class="form-group">
          <input type="password" id="pass" AUTOCOMPLETE="off" name="pass" class="form-control" size="25" placeholder="<?php _ex(" Password "); ?>">
        <div id="capslock" style="visibility:hidden"><font color="red"><br><?php _ex("Your caps lock is enabled. Our passwords are case-sensitive."); ?></font></div>
		</div>
        <div class="form-group">
          <button class="btn btn-secondary btn-single">
            <?php _ex( "Sign in"); ?>
          </button>
        </div>
        <div class="form-group">
          <label class="cbr-inline">
            <div class="checkbox">
              <label>
                <input name="rememberme" type="checkbox">
                <?php _ex( "Remember Me"); ?>
              </label>
            </div>
          </label>
        </div>
      </form>
      <div class="form-group pull-right">
        <a href="<?php echo URL; ?>user/register" class="btn btn-white btn-single">
          <?php _ex( "Create New Account"); ?>
        </a>
      </div>
      <div class="form-group pull-right">
        <a href="<?php echo URL; ?>user/passreset" class="btn btn-white btn-single">
          <?php _ex( "Forgot Password"); ?>
        </a>
      </div>
    </div>
  </div>
</div>
