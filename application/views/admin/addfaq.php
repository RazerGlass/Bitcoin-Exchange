	<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	
    <div class="col-md-7 col-md-offset-3">
	<form role="form" method="post" action="<?php echo ADMINURL; ?>/insertfaq">
	<div class="form-group">
		<div class="col-sm-10">
		<input name="title" type="text" class="form-control" id="field-1" placeholder="<?php _ex("Enter a Question Title"); ?>">
					</div>
					</div>
					</div>
	
				<div class="col-md-9">
				<div class="form-group">
				
					<textarea id="ckeditor" name="faq" class="form-control ckeditor" rows="10">
					</textarea>
				<button class="btn btn-blue btn-icon pull-right"><?php _ex("Add FAQ"); ?></button>
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
