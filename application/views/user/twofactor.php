<div class="col-xs-12 col-sm-8 col-sm-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php _ex("Two Factor Authentication"); ?></h3>
      <div class="panel-options">
        <a href="#" data-toggle="panel">
          <span class="collapse-icon">–</span>
          <span class="expand-icon">+</span>
        </a>
        <a href="#" data-toggle="remove">×</a>
      </div>
    </div>
    <div class="panel-body">
	<div class="col-sm-4">
    <?php
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username."@".$site->sitename, $secret);
        echo "<img src='".$qrCodeUrl."' class='col-xs-12'>";
		echo '</div><div class="col-sm-8">';
		echo "<form action='".URL."user/twofactor' method='POST'>";
        echo  _ex("Authentication Key");		 
	    echo "<input name='2key' type='text' class='form-control' 
			 id='field-1'value='".$secret."'>
			 </div><div class='col-sm-8'>";
		echo '<div class="form-group">';
	    echo _ex("Authentication Code"); ?>
		<input name="2code" type="text" class="form-control" id="field-1" placeholder="<?php _ex("Enter Code"); ?>">
			  <br><h5><?php _ex("Download Google authenticator and scan the barcode. Once scanned
			  a number should appear in the authenticator app. Fill out our
			  input with that code and click submit authentication on this site."); ?></h5>
			  <p><button type="submit" id="submit" name="submit" class="btn btn-success pull-right">
			  <?php _ex("Submit authentication"); ?>
			  </button></p>
			  </div>

			  </div>  
</div></div></div>