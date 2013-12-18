<script type="text/javascript">
	$(document).ready(function(){
		$("form").validate({
			rules: {
				title:"required",
				department:"required",
				Division:"required",
				wprovinceid:"required"
			},
			messages:{
				title:"กรุณาระบุข้อมูลด้วย",
				department:"กรุณาระบุข้อมูลด้วย",
				Division:"กรุณาระบุข้อมูลด้วย",
				wprovinceid:"กรุณาระบุข้อมูลด้วย"
			}
		});
		
		$("select[name=department]").change(function(){
			pDepartmentID =$("select[name=department]").val();
			url = 'c_user/ajax_division_list/'+pDepartmentID;
			url = urlEncode(url,false);
			$("#division").attr('disabled','disabled'); 
			$("#dvDivision").append("<img src='images/loading.gif' align='absmiddle'>");
			$.get(url,function(data){			
				$("#dvDivision").html(data);
				$("select[name=division]").attr("id","divisionid");
				$("#divisionid").attr("name","divisionid");
			});	
		})
	});

</script>
<h3>ตั้งค่า กลุ่มงาน (กลุ่ม/ฝ่าย) (เพิ่ม / แก้ไข)</h3>
<form name="frmData" id="frmData" method="post" enctype="multipart/form-data" action="c_workgroup/save<?=$url_parameter;?>" target="">
<table class="tbadd">
<tr>
  <th>ชื่อกลุ่มงาน<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="title" type="text" id="title" value="<?=@$row['title'];?>" size="50" />
  	<input name="id" type="hidden" id="id" value="<?=@$row['id'];?>" size="50" />
  </td>
</tr>
<tr>
  <th>กรม<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="department" id="department" >
    <option value="">-- ระบุกรม --</option>
    <?    			
		foreach($department as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if(@$row['departmentid']==@$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
    </td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td>
  <div id="dvDivision">
  <select name="divisionid" id="divisionid">
    <option value="">-- ระบุหน่วยงาน --</option>
    <?		
		foreach($division as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if(@$row['divisionid']==@$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
  </div>
  </td>
</tr>
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="wprovinceid" id="wprovinceid">
    <option value="">-- ระบุจังหวัด --</option>
    <?	
	foreach($province as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if($row['wprovinceid']==@$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach ?>
  </select>
    </td>
</tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_workgroup', 'canedit')): ?><input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>