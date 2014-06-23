<script type="text/javascript">
	$(document).ready(function(){
			$("form").validate({
				rules: {
					title:{required:true}
				},
				messages:{
					title:{required:"กรุณาระบุชื่อกรอบทิศทางในการจัดสรรเงิน"}
				}
			});
	});
</script>

<style>
	label.error { color: red; }
</style>

<h3>ตั้งค่า ประเภทเด็ก (บันทึก / แก้ไข)</h3>

<?php echo form_open('fund/project/direction_set/save'); ?>

<table class="tbadd">
	<tr>
		<th>ชื่อกรอบทิศทางในการจัดสรรเงิน<span class="Txt_red_12"> *</span></th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	<tr>
		<th>เปิด / ปิดการใช้งาน</th>
		<td> <? echo form_checkbox('status', '1', @$rs['status']); ?> </td>
	</tr>
</table>


<div id="btnBoxAdd">
	<input type="submit" value="" class="btn_save"/>
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>

<?php echo form_hidden('id', @$rs['id']); ?>
<?php echo form_close(); ?>