<div class="col-sm-9 col-xs-12">
<div class="panel">
  <div class="panel-body">
    <div class="member-form-add-header">
      <div class="row">
        <div class="col-md-2 col-sm-4 pull-right-sm">
          <div class="action-buttons">
            <button type="submit" class="btn btn-block btn-secondary">Save Changes</button>
            <button type="reset" class="btn btn-block btn-gray">Reset to Default</button>
          </div>
        </div>
        <div class="col-md-10 col-sm-8">
          <div class="user-name"> <a href="#"><?php echo htmlentities($edituser->username,ENT_QUOTES); ?></a> </div>
        </div>
      </div>
    </div>
    <div class="member-form-inputs">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label" for="username">Screen Name</label>
        </div>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlentities($edituser->username,ENT_QUOTES); ?>" disabled=""> </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label" for="name">Full Name</label>
        </div>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="name" disabled id="name" value="<?php echo $this->model->decrypt($edituser->firstname); ?> <?php echo $this->model->decrypt($edituser->lastname); ?>"> </div>
      </div>	  
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label" for="birthdate">Birthdate</label>
        </div>
        <div class="col-sm-9">
          <div class="input-group">
            <input type="text" disabled class="form-control datepicker" name="birthdate" data-format="dd-mm-yyyy" value="<?php echo $this->model->decrypt($edituser->dob); ?>">
            <div class="input-group-addon"> <a href="#"><i class="linecons-calendar"></i></a> </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label" for="birthdate">Address</label>
        </div>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $this->model->decrypt($edituser->address1); ?>" disabled>
			<br/>
		    <input type="text" class="form-control" value="<?php echo $this->model->decrypt($edituser->address2); ?>" disabled>
			<br/>
			<input type="text" class="form-control" value="<?php echo $this->model->decrypt($edituser->zip); ?>" disabled>
            <br/>
            <input type="text" class="form-control" value="<?php echo $this->model->decrypt($edituser->state); ?>" disabled>
			<br/>
			<input type="text" class="form-control" value="<?php echo $this->model->decrypt($edituser->country); ?>" disabled>
        </div>
      </div>	

      <div class="row">
        <div class="col-sm-3">
          <label class="control-label" for="birthdate">Other Information</label>
        </div>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php if($edituser->emailverified == 1): echo 'Email is verified'; else: echo 'Email is not verified'; endif; ?>" disabled>
			<br />
            <input type="text" class="form-control" value="<?php if($edituser->detailssubmitted == 1): echo 'Details have been submitted'; else: echo 'Details have not been submitted'; endif; ?>" disabled>
			<br />
            <input type="text" class="form-control" value="<?php if($edituser->twofactor == 1): echo 'Twofactor is enabled'; else: echo 'Twofactor is not enabled'; endif; ?>" disabled>
			<br />
            <input type="text" class="form-control" value="<?php if($edituser->banned == 1): echo 'User is banned'; else: echo 'User is not banned'; endif; ?>" disabled>
			<br />		    
            <input type="text" class="form-control" value="<?php if(!empty($edituser->ipwhitelist)): echo 'User has a IP whitelist set'; else: echo 'User does not have an IP whitelist set'; endif; ?>" disabled>
			<br />	
        </div>
      </div>
	  
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Security Questions</label>
        </div>
        <div class="col-sm-9">
        <input type="text" class="form-control" disabled value="<?php echo $this->model->decrypt($edituser->security_question1); ?>">
		<br/>
		<input type="text" class="form-control" disabled value="<?php echo $this->model->decrypt($edituser->security_answer1); ?>">
		<br/>
		<input type="text" class="form-control" disabled value="<?php echo $this->model->decrypt($edituser->security_question2); ?>">
		<br/>
		<input type="text" class="form-control" disabled value="<?php echo $this->model->decrypt($edituser->security_answer2); ?>">   
        </div>
            
        </div>
	<?php if ($this->model->isadmin() == true): ?>
        <div class="row">
        <div class="col-sm-3">
           <label class="control-label">Verification Images</label>
        </div>
        <div class="col-sm-9">
    <?php 
			 $idimages = 0;
			 $imghref = explode(",",$edituser->verifyimg);
			 foreach ($imghref as $img => $key){
			 $imghref > 0;
			 echo'<img class="col-xs-12 col-sm-6" src="'.ADMINURL."/getuserimg?img=".$key.'&user='.$edituser->username.'">&nbsp;';
			 } if($edituser->detailverified == 0 && $edituser->invalidid == 0){?>
			<br/><br/>
             <a href="<?php echo ADMINURL.'/invalidid/?user='. $edituser->username; ?>" class="btn btn-danger btn-sm btn-icon icon-left">
             Invalid ID
             </a>
			<a href="<?php echo ADMINURL.'/validid/?user='. $edituser->username; ?>" class="btn btn-success btn-sm btn-icon icon-left">
            Valid ID
            </a>
			</div>
            </div>
			<?php } endif;
			?>
    </div>
  </div>
</div></div>