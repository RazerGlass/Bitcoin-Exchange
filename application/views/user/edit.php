<script>
$(document).ready(function()
{
  $('#submit').click(function()
  {
    if ($('#expandedsidebar').is(':checked'))
    {
      var checkboxsidebar = '1';
    }
    else
    {
      var checkboxsidebar = '';
    }
    if ($('#expandedchat').is(':checked'))
    {
      var checkboxexpandedchat = '1';
    }
    else
    {
      var checkboxexpandedchat = '0';
    }
    $.ajax(
    {
      type: 'POST',
      url: '<?php echo URL;?>user/editinformation/',
      data: 'email=' + $('#email').val() + '&password=' + $('#password').val() + '&expandedsidebar=' + checkboxsidebar + '&expandedchat=' + checkboxexpandedchat + '&token=<?php echo $_SESSION['token'];?>',
      success: function(msg)
      {
        $('#updateinformation').html(msg);
      }
    });
  });
});
</script>
<section class="profile-env">

  <?php //require APP . 'views/_templates/usersidebar.php'; ?>

  <div id="updateinformation"></div>
  <div class="col-md-12 ">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php _ex("Edit Information"); ?></h3>
        <div class="panel-options">
          <a href="#" data-toggle="panel">
            <span class="collapse-icon">-</span>
            <span class="expand-icon">+</span>
          </a>
          <a href="#" data-toggle="remove">x</a>
        </div>
      </div>
      <div class="panel-body">

        <div class="row col-margin">
          <div class="col-xs-12 col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="linecons-mail"></i>
              </div>
              <input type="text" class="form-control" name="email" id="email" data-validate="required" placeholder="<?php echo htmlspecialchars($this->model->decrypt($user->email),ENT_QUOTES); ?>" value="<?php echo htmlspecialchars($this->model->decrypt($user->email),ENT_QUOTES); ?>" data-message-required="<?php _ex(" Please enter an email address "); ?>">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="linecons-lock"></i>
                </div>

                <input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="<?php _ex(" Enter strong password "); ?>">
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="linecons-lock"></i>
                </div>

                <input type="password" class="form-control" name="passwordconf" id="passwordconf" data-validate="required,equalTo[#password]" data-message-equal-to="<?php _ex(" Passwords don 't match"); ?>" placeholder="<?php _ex("Confirm password"); ?>">
</div>
</div>
</div>

</div>
<p class="text-center">
  <b><?php _ex("Password Requirements"); ?></b>
</p>
<br>
<div class="row small-row">
  <div class="col-xs-12 col-sm-3">
  </div>
  <div class="col-xs-12 col-sm-3">
    <ul>
      <li>
        <?php _ex("8 characters minimum"); ?>
      </li>
      <li>
        <?php _ex("1 or more upper-case letters"); ?>
      </li>
    </ul>
  </div>
  <div class="col-xs-12 col-sm-3">
    <ul>
      <li>
        <?php _ex("1 or more lower-case letters"); ?>
      </li>
      <li>
        <?php _ex("1 or more digits or special characters"); ?>
      </li>
    </ul>
  </div>
  <div class="col-xs-3"></div>
</div>
<div class="member-form-inputs">
    <div class="row">
<div class="col-xs-6">
  <label class="col-sm-6 control-label"><?php _ex("Don't show sidebar "); ?></label>
  <div class="col-sm-6">
    <div class="form-block">
      <input id="expandedsidebar" value="" name="expandedsidebar" <?php if($user->sidebaropen == 1){ echo 'checked '; } ?> type="checkbox" class="iswitch iswitch-secondary ">
    </div>
  </div>
</div>
<div class="col-xs-6">
  <label class="col-sm-6 control-label"><?php _ex("Chat Constantly Open "); ?></label>
  <div class="col-sm-6">
    <div class="form-block">
      <input id="expandedchat" value="" name="expandedchat" <?php if($user->chatbaropen == 1){ echo 'checked '; } ?> type="checkbox" class="iswitch iswitch-secondary">
    </div>
  </div>
</div>
<div class="col-xs-6">
  <label class="col-sm-6 control-label "><?php _ex("Email on login "); ?></label>
  <div class="col-sm-6 ">
    <div class="form-block">
      <input id="loginnotify" value="" name="loginnotify" <?php if($user->loginnotify == 1){ echo 'checked '; } ?> type="checkbox" class="iswitch iswitch-secondary">
    </div>
  </div>
</div>
<div class="col-xs-6">
  <label class="col-sm-6 control-label"><?php _ex("Email on withdraw "); ?></label>
  <div class="col-sm-6">
    <div class="form-block">
      <input id="notifywithdraw" value="" name="notifywithdraw" <?php if($user->withdrawnotify == 1){ echo 'checked '; } ?> type="checkbox" class="iswitch iswitch-secondary">
    </div>
  </div>
</div>
</div></div>
<div class="member-form-inputs ">
    <div class="row ">
	<div class="col-sm-3 ">
        <label class="control-label " for="username "><?php _ex("Account security "); ?></label>
    </div>
<tr>
    <td width="15% ">
		<a href="<?php echo URL; ?>user/twofactor" class="btn btn-success">
		<?php _ex("Enable 2factor"); ?>
		</a>
	</td>
</tr>
</div>
</div>
 
<button type="submit" id="submit" name="submit" class="btn btn-danger pull-right">
    <?php _ex("Update"); ?>
</button>
</label>
</p>
</form>
</div>
</div>
</div>