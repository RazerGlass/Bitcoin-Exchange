	<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	
    <div class="col-md-4 col-md-offset-3">
	<form role="form" method="post" action="<?php echo ADMINURL; ?>/insertnews">
	<div class="form-group">
		<div class="col-sm-10">
		<input name="title" type="text" class="form-control" id="field-1" placeholder="<?php _ex("Enter a Page Title"); ?>">
	</div>
					</div>
					</div>
	<div class="form-group">
              <div class="col-md-4 col-md-offset-3 col-xs-12">
                <select name="page" id="page" class="form-control">
				  <option>Select a Page</option>
				  <option value="">All Pages</option>
                  <option value="dashboard/">Dashboard</option>
                  <option value="dashboard/orders/">Dashboard Orders</option>
                  <option value="dashboard/trades/">Dashboard Trades</option>
                  <option value="dashboard/deposit/">Dashboard Deposit</option>
                  <option value="user/edit/">User Edit Profile</option>
                  <option value="user/security">User Security page</option>
                  <option value="user/api">User API</option>	
                  <option value="user/messages/">Inox Messages</option>
                  <option value="user/message/">Inbox Message</option>
                  <option value="user/information/">User Timeline</option>
                  <option value="help/faq">Faq Page</option>	
                  <option value="user/pricing">Pricing Page</option>				  
                </select>
					</div>
					</div>
	
				<div class="col-md-9 col-xs-12">
				<div class="form-group">
				
					<textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10">
					</textarea>
				<button class="btn btn-blue btn-icon pull-right"><?php _ex("Add News"); ?></button>
				</div></div>
	<link rel="stylesheet" href="<?php echo URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.css">
	<link rel="stylesheet" href="<?php echo URL; ?>js/uikit/vendor/codemirror/codemirror.css">
	<link rel="stylesheet" href="<?php echo URL; ?>js/uikit/uikit.css">
	<link rel="stylesheet" href="<?php echo URL; ?>js/uikit/css/addons/uikit.almost-flat.addons.min.css">
	<script src="<?php echo URL; ?>js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="<?php echo URL; ?>js/uikit/vendor/codemirror/codemirror.js"></script>
	<script src="<?php echo URL; ?>js/uikit/vendor/marked.js"></script>
	<script src="<?php echo URL; ?>js/uikit/js/uikit.min.js"></script>
	<script src="<?php echo URL; ?>js/uikit/js/addons/htmleditor.min.js"></script>
	<script src="<?php echo URL; ?>js/ckeditor/ckeditor.js"></script>
	<script src="<?php echo URL; ?>js/ckeditor/adapters/jquery.js"></script>
