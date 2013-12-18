<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_add_workgroup_province").click(function(){
			var division_id=$("#id").val();
			$.post('c_division/add_workgroup_province',{
					'division_id' : division_id					
			},function(data){			
				alert('complete');
			});			
		})
		$("form").validate({
			rules: {
				title:"required",
				departmentid:"required",
				provinceid:"required"
			},
			messages:{
				title:"กรุณาระบุข้อมูลด้วย",
				departmentid:"กรุณาระบุข้อมูลด้วย",
				provinceid:"กรุณาระบุข้อมูลด้วย"
			}
		});
	});
</script>
<form name="frmData" id="frmData" method="post" enctype="multipart/form-data" action="c_division/save<?=$url_parameter;?>">
<h3>หน่วยงาน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อหน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=$row['title'];?>" size="40" />
  	<input name="id" type="hidden" id="id" value="<?=@$row['id'];?>" size="40" />
  </td>
</tr>
<tr>
  <th>ชื่อกรม<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="departmentid" id="departmentid">
    <option value="">-- ระบุกรม --</option>
    <?
	$sresult = $this->department->get();
	foreach($sresult as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if($row['departmentid']==$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
    </td>
</tr>
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="provinceid" id="provinceid">
    <option value="">-- ระบุจังหวัด --</option>
    <?
	$sresult = $this->province->get();
	foreach($sresult as $srow ): 
	?>
    <option value="<?=$srow['id'];?>" <? if($row['provinceid']==$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach ?>
  </select>
  </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_division', 'canedit')): ?>
  		<input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <?php if(permission('c_workgroup','canedit')&&$row['id']>0){ ?>
  		<!--<input name="btn_add_workgroup_province" id="btn_add_workgroup_province" type="button" value="เพิ่มกลุ่มงานส่วนภูมิภาค">-->
  <?php }?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>