<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			position_name:"required"
		},
		messages:{
			position_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า ตำแหน่งในคณะกรรมการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_position_director/save">
<table class="tbadd">
<tr>
  <th>ชื่อตำแหน่งในคณะกรรมการ<span class="Txt_red_12"> *</span></th>
  <td><input name="position_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $pd['position_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="created" value="<?php echo $pd['created']?>">
  <input type="hidden" name="id" value="<?php echo $pd['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>