<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo base_url(); ?>" />
		<title><?php echo $template['title']; ?></title>
		<?php require_once('themes/mdevsys/_script.php')?>
		<?php echo $template['metadata']; ?>
		<style>
			.error { color: red; }
		</style>
	</head>
	<body>
		<div id="head"><?php require_once('_header.php')?></div>
		<div id="page"><?php echo $template['body']; ?></div> 
		<div id="footer">&nbsp;</div> 
	</body>
</html>