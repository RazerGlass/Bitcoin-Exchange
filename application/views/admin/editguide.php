	<script type="text/javascript">
    CKEDITOR.replace("ckeditor");
</script>	

    <div class="col-sm-9 col-xs-12">

		<form role="form" action="<?php echo ADMINURL; ?>/updateguide/" method="POST">
				
				<div class="form-group">
				<input type="hidden" name="gurl" value="<?php echo $url;?>">
					<textarea id="ckeditor" name="message" class="form-control ckeditor" rows="10">
					<?php echo $editguide->message;?>
					</textarea>
					
				</div>
				<button class="btn btn-blue btn-icon pull-right"><?php _ex("Update User Guide");?></button>
				</form>
				</div>
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
