<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title>
		<?php require_once('themes/bo/_meta.php')?>
	</head>
	<body>
		
		<img src="images/ajax-loader.gif" />
		
		<script type="text/javascript" >
			$(document).ready(function(){
				
				var value = "<?php echo $value['firstname']." ".$value["lastname"]?>";
				var id = <?php echo $value["id"]?>;
				$("#personal_name", window.parent.document).val("");
				$("#personal_name", window.parent.document).val(value);
				
				$("#personal_id", window.parent.document).val("");
				$("#personal_id", window.parent.document).val(id);
				parent.$.colorbox.close();
				
			});
		</script>
			
		</div> 
		<div id="footer">&nbsp;</div> 
	</body>
</html>
				
