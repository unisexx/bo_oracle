<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			plan_name:"required"
		},
		messages:{
			plan_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า แผน (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_plan/save">
<table class="tbadd">
<tr>
  <th>ชื่อแผน<span class="Txt_red_12"> *</span></th>
  <td><input name="plan_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $plan['plan_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="created" value="<?php echo $plan['created']?>">
	<input type="hidden" name="id" value="<?php echo $plan['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>