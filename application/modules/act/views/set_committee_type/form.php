<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			sub_type_name:"required"
		},
		messages:{
			sub_type_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า ประเภทอนุกรรมการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_committee_type/save">
<table class="tbadd">
<tr>
  <th>ชื่อประเภทอนุกรรมการ<span class="Txt_red_12"> *</span></th>
  <td><input name="sub_type_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $committee_type['sub_type_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="created" value="<?php echo $committee_type['created']?>">
	<input type="hidden" name="id" value="<?php echo $committee_type['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>