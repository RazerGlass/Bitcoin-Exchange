  <div class="row">

    <div class="col-sm-3">

      <!-- User Info Sidebar -->
      <div class="user-info-sidebar">

        <a href="#" class="user-img">
<img src="<?php URL;?>img/avatar.png" alt="user-img" class="img-cirlce img-responsive img-thumbnail">
</a>

        <a href="#" class="user-name">
          <?php echo ucfirst(htmlentities($user->username)); ?>
          <span class="user-status is-online"></span>
        </a>
        <hr>

        <ul class="list-unstyled user-info-list">
          <li>
            <i class="<?php URL; ?>dashboard/deposit"></i>
            <a href="<?php URL; ?>dashboard/deposit">
              <?php _ex("Deposit"); ?>
            </a>
          </li>
          <li>
            <li>
              <i class="<?php URL; ?>user/edit"></i>
              <a href="<?php URL; ?>user/edit">
                <?php _ex("Edit Profile"); ?>
              </a>
            </li>
            <li>
              <i class="<?php URL; ?>user/security"></i>
              <a href="<?php URL; ?>user/security">
                <?php _ex("Account Security"); ?>
              </a>
            </li>
            <li>
              <i class="/information"></i>
              <a href="<?php URL; ?>user/information">
                <?php _ex("Profile Information"); ?>
              </a>
            </li>
        </ul>

      </div>
 </div>
 