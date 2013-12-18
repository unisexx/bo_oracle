<form name="fmProvinceArea" enctype="multipart/form-data"  method="post" action="c_province/save/<?=$row['id'];?>">
<h3>ตั้งค่า จังหวัด (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td><input name="title" type="title" id="Title" value="<?=$row['title'];?>" size="40" /></td>
</tr>
<tr>
  <th>ภาค<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="zone" id="zone">
    <option value="">กรุณาเลือกภาค</option>  
    <?    
    $sresult = $this->province_zone->get();
	foreach($sresult as $srow):
	?>
      <option value="<?=$srow['code'];?>" <? if($row['zone']==$srow['code'])echo "selected";?>><?=$srow['title'];?></option>
   <? endforeach; ?>
    </select>
  </td>
</tr>
<tr>
  <th>กลุ่มภาค <span class="Txt_red_12">*</span></th>
  <td>
  	<select name="pgroup" id="pgroup">
    <option value="0">กรุณาเลือกกลุ่มภาค</option>
  	<?   	
  	$sresult = $this->province_group->get();
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($row['pgroup']==$srow['id'])echo "selected";?>><?=$srow['description'];?></option>
    <? endforeach; ?>
	</select>
  </td>
</tr>
<tr>
  <th>เขตจังหวัด  <span class="Txt_red_12">*</span></th>
  <td>
	<select name="area" id="area">
    <option selected="selected" value="0">กรุณาเลือกเขตจังหวัด</option>
    <? 
  	$sresult = $this->province_area->get();
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($row['area']==$srow['id'])echo  "selected";?>><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>