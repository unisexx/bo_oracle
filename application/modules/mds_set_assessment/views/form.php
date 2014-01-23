<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				ass_name:"required"
			},
			messages:{
				ass_name:"กรุณาระบุชื่อหน่วยวัด"
			}
		});
});
</script>
<h3>ตั้งค่า ประเด็นการประเมินผล (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo @$rs['id']?>" style="width:500px;" />
<table class="tbadd">
<tr>
  <th>ชื่อประเด็นการประเมินผล<span class="Txt_red_12"> *</span></th>
  <td><input type="text" name="ass_name" id="ass_name" value="<?php echo @$rs['ass_name']?>" class="form-control" style="width:500px;" /></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>