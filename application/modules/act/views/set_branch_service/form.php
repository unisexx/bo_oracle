<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			scommunity_name:"required"
		},
		messages:{
			scommunity_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า สาขาการให้บริการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_branch_service/save">
<table class="tbadd">
<tr>
  <th>ชื่อสาขาการให้บริการ<span class="Txt_red_12"> *</span></th>
  <td><input name="scommunity_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $branch_service['scommunity_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?php echo $branch_service['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>