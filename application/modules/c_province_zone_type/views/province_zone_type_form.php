<script type="text/javascript">
  		$("#fmProvinceArea").bind("keypress", function(e) {
		  if (e.keyCode == 34) return false;
		});
</script>
<form name="fmProvinceArea" id="fmProvinceArea" enctype="multipart/form-data"  method="post" action="c_province_zone_type/save<?=$url_parameter;?>">
<h3>ตั้งค่า ประเภทกลุ่มภาค จังหวัด (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ประเภทกลุ่มภาค<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="40" class="required">
  	<input type="hidden" name="id" value="<?=@$row['id'];?>">
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <? if(@$row['id']!=''){ ?>
  	<? if(permission('c_province_zone_type','canedit')):?>
  	<input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  	<? endif;?>
  <? }else{ ?>  
  	<? if(permission('c_province_zone_type','canadd')):?>
  	<input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  	<? endif;?>
  <? } ?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>