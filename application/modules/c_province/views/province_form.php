<script type="text/javascript">
	$(document).ready(function(){
		$("form").validate({
			rules: {
				title:"required",
				pgroup:"required",
				area:"required"
			},
			messages:{
				title:"กรุณาระบุข้อมูลด้วย",
				pgroup:"กรุณาระบุข้อมูลด้วย",
				area:"กรุณาระบุข้อมูลด้วย"
			}
		});
	});
</script>

<form name="fmProvinceArea" enctype="multipart/form-data"  method="post" action="c_province/save<?=$url_parameter;?>">
<h3>ตั้งค่า จังหวัด (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="40" />
  	<input name="id" type="hidden" id="id" value="<?=@$row['id'];?>" size="40" />
  </td>
</tr>
<tr>
	<td colspan="2">
		<table width="100%">
			<tr>
				<th align="left">ประเภทภาค</th>
				<th align="left">ภาค</th>
			</tr>
			<? 
			   foreach($zonetype as $item):
			?>
				<tr>
					<td align="left" style="width:100px;"><?=$item['title'];?></td>
					<td align="left">											
				  	<select name="zoneid[]" id="zoneid[]">
				    <option value="0" selected>กรุณาเลือกภาค</option>
				  	<?   					  	
				  	$sresult = $this->province_zone->where("zone_type_id=".$item['id'])->get(FALSE,TRUE);					
					foreach($sresult as $srow):		
						$zonerow = $this->province_detail_zone->where("zoneid=".$srow['id']." AND provinceid=".$row['id'])->get_row();
						$select = @$zonerow['id'] < 1 ? "" : "selected=selected"; 
					?>
				    <option value="<?=$srow['id'];?>" <?=$select;?> ><?=$srow['title'];?></option>
				    <? endforeach; ?>
					</select>																						
					</td>
				</tr>
			<?
			   endforeach;
			?>
		</table>
	</td>
</tr>
<tr>
  <th>เขตจังหวัด  <span class="Txt_red_12">*</span></th>
  <td>
	<select name="area" id="area">
    <option selected="selected" value="">กรุณาเลือกเขตจังหวัด</option>
    <? 
  	$sresult = $this->province_area->get();
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if(@$row['area']==$srow['id'])echo  "selected";?>><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_province', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>