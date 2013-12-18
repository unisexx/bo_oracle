<script type="text/javascript">
  		$("#fmProvinceArea").bind("keypress", function(e) {
		  if (e.keyCode == 34) return false;
		});
</script>
<form name="fmProvinceArea" enctype="multipart/form-data"  method="post" action="c_province_zone/save<?=$url_parameter;?>">
<h3>ตั้งค่าภาค จังหวัด (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ประเภทภาค<span class="Txt_red_12"> *</span></th>
  <td>
  	<select name="zone_type_id" id="zone_type_id">
  		<option value="0">เลือกประเภทกลุ่มภาค</option>
  		<? foreach($zone_type as $item):
			$select = $item['id']==@$row['zone_type_id'] ? "selected=selected" : "";
			echo "<option value=\"".$item['id']."\" ".$select.">".$item['title']."</option>";
			endforeach;
		?>
  	</select>
  </td>
</tr>
<tr>
  <th>ภาค<span class="Txt_red_12"> *</span></th>
  <td>
  		<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="40" />
  		<input name="id" type="hidden" id="id" value="<?=@$row['id'];?>" size="40" />
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