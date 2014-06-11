<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title>
		<?php require_once('themes/bo/_meta.php')?>
	</head>
	<body>
		<div id="page">
			
			<table class="tblist" >
				
				<tr>
					<th>ชื่อ</th>
					<th>ที่อยู่</th>
					<th></th>
				</tr>
				
				<?php if(empty($variable)):?>
				<tr>
					<td colspan="4" class="text-center" >- ไม่มีข้อมูล -</td>
				</tr>
				<?php
					else:
						foreach ($variable as $key => $value):
							$district = $this->district->get_row($value["district_id"]);
							$amphur = $this->amphur->get_row($value["amphur_id"]);
							$province = $this->province->get_row($value["province_id"]);
				
							$name = $value["title"].$value["firstname"]." ".$value["lastname"];
							
							$address = $value["addr_number"];
							$address .= ($value["addr_moo"]) ? " หมู่ ".$value["addr_moo"] : null;
							$address .= ($value["district_id"]) ? " ตำบล".$district["title"] : null;
							$address .= ($value["amphur_id"]) ? " อำเภอ".$amphur["title"] : null;
							$address .= ($value["province_id"]) ? " จังหวัด".$province["title"] : null;
							
							if($key%2==0) {
								$odd = " odd";
							} else {
								$odd = null;
							}
				?>
				<tr class="cursor<?php echo $odd?>" >
					<td><?php echo $name?></td>
					<td><?php echo $address?></td>
					<td><a href="#" class="request-list" data-name="<?php echo $name?>" data-id="<?php echo $value["id"]?>" ><button type="button" >เพิ่ม</button></a></td>
				</tr>
			<?php
					endforeach;
				endif;
			?>
				
			</table>
			
			<?php echo @$pagination?>

<script type="text/javascript">
	$(document).ready(function(){
		
		$("a.request-list").click(function(){
			var value = $(this).attr("data-name");
			var id = $(this).attr("data-id");
			$("#personal_name", window.parent.document).val("");
			$("#personal_name", window.parent.document).val(value);
			
			$("#personal_id", window.parent.document).val("");
			$("#personal_id", window.parent.document).val(id);
	 	});
		
	});
</script>
			
		</div> 
		<div id="footer">&nbsp;</div> 
	</body>
</html>
				
