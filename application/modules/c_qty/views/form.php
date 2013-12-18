<script type="text/javascript">
	$(document).ready(function(){
		$("form").validate({
			rules: {
				title:"required"
			},
			messages:{
				title:"กรุณาระบุข้อมูลด้วย"
			}
		});
	});
</script>
<h3>หน่วยนับ (เพิ่ม / แก้ไข)</h3>
<form name="frmData" id="frmData" method="post" enctype="multipart/form-data" action="c_qty/save<?=$url_parameter;?>" target="">
<table class="tbadd">
<tr>
  <th>ชื่อรายการ<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="40" />
  	<input type="hidden" name="id" value="<?=@$row['id'];?>">
  </td>
</tr>
<tr>
  <th></th>
  <td>
  	 <input name="iskeyunit" type="checkbox" value="1" <? if(@$row['iskeyunit']!='')echo 'checked="checked"';?>> เป็นหน่วยนับตัวชี้วัด
  	 <input name="isassetunit" type="checkbox" value="1"  <? if(@$row['isassetunit']!='')echo 'checked="checked"';?>> เป็นหน่วยนับสินทรัพย์  	
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_document', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>