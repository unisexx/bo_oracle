<script type="text/javascript">
$(document).ready(function(){
	$("form").validate({
		rules: {
			strategic_name:"required"
		},
		messages:{
			strategic_name:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>ตั้งค่า กรรมการผู้ทรงคุณวุฒิด้าน (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_strategic/save">
<table class="tbadd">
<tr>
  <th>ชื่อกรรมการผู้ทรงคุณวุฒิด้าน<span class="Txt_red_12"> *</span></th>
  <td><input name="strategic_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $strategic['strategic_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?php echo $strategic['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>