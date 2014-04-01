<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			plansub_name:"required"
		},
		messages:{
			plansub_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า แผนย่อย (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_subplan/save">
<table class="tbadd">
<tr>
  <th>แผน</th>
  <td>
  	<?php echo form_dropdown('plan_id',get_option('id', 'plan_name', 'act_plan'),$subplan['plan_id'])?>
  </td>
</tr>
<tr>
  <th>ชื่อแผนย่อย<span class="Txt_red_12"> *</span></th>
  <td><input name="plansub_name" type="text" class="form-control" style="width:500px;"   value="<?php echo $subplan['plansub_name']?>"/></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="created" value="<?php echo $subplan['created']?>">
  <input type="hidden" name="id" value="<?php echo $subplan['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>