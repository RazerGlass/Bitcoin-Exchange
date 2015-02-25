<script>
$(document).ready(function()
{
  $('#submit').click(function()
  {
    if ($('#terms').is(':checked'))
    {
      var checkboxterms = 'yes';
    }
    else
    {
      var checkboxterms = 'no';
    }
    $.ajax(
    {
      type: 'POST',
      url: '<?php echo URL;?>user/registerusers/',
      data: 'username=' + $('#username').val() + '&password=' + $('#password').val() + '&passwordrepeat=' + $('#password2').val() + '&email=' + $('#email').val() + '&firstname=' + $('#firstname').val() + '&lastname=' + $('#lastname').val() + '&securityq1=' + $('#securityq1').val() + '&securitya1=' + $('#securitya1').val() + '&securityq2=' + $('#securityq2').val() + '&securitya2=' + $('#securitya2').val() + '&terms=' + checkboxterms + '&submit=true' + '&referer=<?php echo $referer; ?>',
      success: function(msg)
      {
        $('#registermessage').html(msg);
      }
    });
  });
});
</script>
<div class="col-md-3"></div>
<div id="registermessage"></div>
<div class="row">
  <div class="col-md-10 col-md-offset-1">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php _ex("Register Form"); ?></h3>
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
        <div class="row col-margin">
          <div class="col-xs-12 col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa-user"></i>
              </div>
              <input type="text" class="form-control" id="username" name="username" data-validate="required" placeholder="<?php _ex(" Username "); ?>" data-message-required="<?php _ex(" Please enter your username "); ?>"/>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="linecons-mail"></i>
              </div>
              <input type="text" class="form-control" id="email" name="email" data-validate="required" placeholder="<?php _ex(" Enter email address "); ?>" data-message-required="<?php _ex(" Please enter an email address "); ?>"/>
            </div>
          </div>
          <div class="form-group-separator">
          </div>
          <div class="col-md-6">
            <div class="form-group">

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="linecons-lock"></i>
                </div>

                <input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="<?php _ex(" Enter strong password "); ?>" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="linecons-lock"></i>
                </div>

                <input type="password" class="form-control" name="password2" id="password2" data-validate="required,equalTo[#password]" data-message-equal-to="<?php _ex(" Password don 't match"); ?>" placeholder="<?php _ex("Confirm Password"); ?>" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <p class="text-center">
                        <b><?php _ex("Password Requirements"); ?></b>
                    </p>
                    <br />
                    <div class="row small-row">
                        <div class="col-sm-3 col-sm-offset-3 col-xs-12">
                            <ul>
                                <li><?php _ex("8 characters minimum"); ?></li>
                                <li><?php _ex("1 or more upper-case letters"); ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <ul>
                                <li><?php _ex("1 or more lower-case letters"); ?></li>
                                <li><?php _ex("1 or more digits or special characters"); ?></li>
                            </ul>
                        </div>
                        </div>
                        <p class="text-center"><?php _ex("These security questions will not be changeable or visible after registration. <br/>
If you lose access to your email/account, we will use these questions as part of the process to grant access to your account."); ?>.</p><br />
                         
                         <div class="col-sm-6 col-xs-12">
						 
                                        <select name="securityq1" id="securityq1" class="form-control">
                                            <option value="<?php _ex("Favourite Sports Team"); ?>"><?php _ex("Favorite Sports Team"); ?></option>
                                            <option value="<?php _ex("Favourite Food"); ?>"><?php _ex("Favorite Food"); ?></option>
                                            <option value="<?php _ex("Mother's Maiden Name"); ?>"><?php _ex("Mother's Maiden Name"); ?></option>
                                            <option value="<?php _ex("Grandmother's BirthPlace"); ?>"><?php _ex("Grandmothers BirthPlace"); ?></option>
                                            <option value="<?php _ex("Father's Name"); ?>"><?php _ex("Father's Name"); ?></option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="linecons-lock"></i>
                  </div>
                  <input type="text" class="form-control" data-validate="required" id="securitya1" name="securitya1" placeholder="<?php _ex(" Security Question Answer "); ?>"/>
                  <br/>
                </div>
              </div>

              <div class="col-sm-6 col-xs-12">
                <select name="securityq2" id="securityq2" class="form-control">
                  <option value="<?php _ex("What was the name of your Elementary School"); ?>"><?php _ex("What was the name of your Elementary School"); ?></option>
                  <option value="<?php _ex("Favorite Movie"); ?>"><?php _ex("Favourite Movie"); ?></option>
                  <option value="<?php _ex("Mother's Maiden Name");?>"><?php _ex("Mother's Maiden Name");?></option>
                  <option value="<?php _ex("Grandmother's BirthPlace"); ?>"><?php _ex("Grandmother's BirthPlace"); ?></option>
                  <option value="<?php _ex("Father's Name"); ?>"><?php _ex("Father's Name"); ?></option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon"> 
                    <i class="linecons-lock"></i>
                  </div>
                  <input type="text" name="securitya2" id="securitya2" data-validate="required" class="form-control" placeholder="<?php _ex(" Security Question Answer "); ?>"/>
                </div>
              </div>
              <br />
              <p class="text-center">
                <input type="checkbox" name="terms" value="" id="terms" data-validate="required" />
                <?php _ex( "I agree to the"); ?>
                <a href="<?php echo URL;?>pages/?id=tos">
                  <?php _ex( "Terms and Conditions"); ?>
                </a>
                <label>
                  <button type="submit" id="submit" name="submit" class="btn btn-danger">
                    <?php _ex( "Register"); ?>
                  </button>
              </p>

            </div>
          </div>
        </div>
      </div>
    
