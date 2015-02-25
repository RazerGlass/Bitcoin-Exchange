<div class="col-sm-6 col-sm-offset-3 ">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("2 Factor Authentication"); ?></h3>
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
        <input value="<?php echo htmlspecialchars($this->model->decrypt($email),ENT_QUOTES); ?>" name="mail" type="hidden" />
        <input value="<?php echo htmlentities($password,ENT_QUOTES); ?>" name="pass" type="hidden" />
        <input value="<?php echo htmlspecialchars($cookie,ENT_QUOTES); ?>" name="remember" type="hidden" />
        <div class="form-group">
          <input type="text" name="twocode" class="form-control" size="25" placeholder="<?php _ex(" Authentication code "); ?>">
          <?php _ex( "This is the code supplied on your mobile phone. Open Google Authenticator
                      and insert the code above and press 'login'"); ?>
        </div>
        <div class="form-group">
          <button class="btn btn-secondary btn-single">
            <?php _ex( "Sign in"); ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>