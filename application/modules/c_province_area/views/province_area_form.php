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

<form name="fmProvinceArea" enctype="multipart/form-data"  method="post" action="c_province_area/save<?=$url_parameter;?>">
<h3>ตั้งค่า เขตจังหวัด (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อเขตจังหวัด<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=$row['title'];?>" size="40" />
  	<input type="hidden" name="id" id="id" value="<?=$row['id'];?>">
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_province_area', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>