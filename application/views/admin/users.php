<div class="col-xs-12 col-sm-9">
  <ul class="nav nav-tabs">
    <li class="active"> <a href="#all" data-toggle="tab">All Members</a> </li>
    <li> <a href="#administrators" data-toggle="tab">Administrators</a> </li>
    <li> <a href="#staff" data-toggle="tab">Staff</a> </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="all">
      <table class="table table-hover members-table middle-align">
        <thead>
          <tr>
            <th class="hidden-xs hidden-sm"></th>
            <th>Name and Role</th>
            <th class="hidden-xs hidden-sm">E-Mail</th>
            <th>ID</th>
            <th>Settings</th>
          </tr>
        </thead>
        <tbody>
		<?php foreach ($users as $user){ ?>
          <tr>
            <td class="user-cb">
              <div class="cbr-replaced cbr-checked">
                <div class="cbr-input">
                  <input type="checkbox" class="cbr cbr-done" name="members-list[]" value="<?php if($user->admin == 1): echo '2'; elseif($user->staff == 1): echo '3'; else: echo '1'; endif; ?>" checked="">
                </div>
                <div class="cbr-state"><span></span>
                </div>
              </div>
            </td>
            <td class="user-name"> <a href="<?php echo ADMINURL.'/edituser/?id='. $user->username; ?>" class="name"><?php echo $this->model->decrypt($user->firstname); ?> <?php echo $this->model->decrypt($user->lastname); ?></a> 
			<span><?php if($user->admin == 1): echo 'Administrator'; elseif($user->staff == 1): echo 'Staff'; else: echo 'Member'; endif; ?></span> </td>
            <td class="hidden-xs hidden-sm"> <span class="email"><?php echo $this->model->decrypt($user->email); ?></span> </td>
            <td class="user-id">
              <?php echo $user->username; ?>
            </td>
            <td class="action-links"> 
			<?php if ($this->model->isadmin() == true): ?>
              <a href="<?php echo ADMINURL.'/edituser/?id='. $user->username; ?>" class="edit"> <i class="linecons-pencil"></i> Edit Profile
              </a>
              <a href="<?php echo ADMINURL.'/deleteuser/?id='. $user->username; ?>" class="delete"> <i class="linecons-trash"></i> Delete
              </a>
		    <?php elseif($this->model->isstaff() == true): ?>
              <a href="<?php echo ADMINURL.'/edituser/?id='. $user->username; ?>" class="delete"> <i class="linecons-pencil"></i> View user
              </a>
					 <?php endif; ?>


            </td>
          </tr>
		  <?php } ?>
		</table>
    </div>
  </div>
</div>