<script type="text/javascript">
$(document).ready(function(){
	
	$("input[name=firstname],[name=lastname]").keyup(function(){
		var firstname = $("input[name=firstname]").val();
		var lastname = $("input[name=lastname]").val();
		var username = firstname+'.'+lastname.substring(0,2);
		$('input[name=username]').val(username);
	});
	
	$("form").validate({
		rules: {
			
			name:"required",
			firstname:"required",
			lastname:"required",
			department:"required",
			division:"required",
			workgroupid:"required",
			typehuman:"required"
		},
		messages:{
			
			name:"กรุณาระบุข้อมูลด้วย",
			firstname:"กรุณาระบุข้อมูลด้วย",
			lastname:"กรุณาระบุข้อมูลด้วย",
			department:"กรุณาระบุข้อมูลด้วย",
			division:"กรุณาระบุข้อมูลด้วย",
			workgroupid:"กรุณาระบุข้อมูลด้วย",
			typehuman:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});
function ReloadDivision(pDepartmentID)
{
				url = 'c_user/ajax_division_list/'+pDepartmentID;
				url = urlEncode(url,false);
				$("#division").attr('disabled','disabled'); 
				$("#dvDivision").append("<img src='images/loading.gif' align='absmiddle'>");
				$.get(url,function(data){			
				$("#dvDivision").html(data);
				});		
				
				url = 'c_user/ajax_workgroup_list/'+pDepartmentID;
				url = urlEncode(url,false);
				$("#workgroup").attr('disabled','disabled'); 
				$("#dvWorkgroup").append("<img src='images/loading.gif' align='absmiddle'>");
				$.get(url,function(data){			
				$("#dvWorkgroup").html(data);
				});
										
}
function ReloadWorkgroup(pDivisionID)
{
				url = 'c_user/ajax_workgroup_list/0/'+pDivisionID;				
				url = urlEncode(url,false);
				$("#workgroup").attr('disabled','disabled'); 
				$("#dvWorkgroup").append("<img src='images/loading.gif' align='absmiddle'>");
				$.get(url,function(data){			
				$("#dvWorkgroup").html(data);
				});		
}
</script>
<form name="fmUser" enctype="multipart/form-data"  method="post" action="c_user/save_profile<?=$url_parameter;?>">
<h3>ข้อมูลผู้ใช้งาน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อ - นามสกุล<span class="Txt_red_12"> *</span></th>
  <td><input type="hidden" name="id" value="<?php echo @$result['id'];?>">
  	<input name="name" type="text" id="name" value="<?=@$result['name'];?>" size="40" /></td>
</tr>
<tr>
  <th>Name <span class="Txt_red_12"> *</span></th>
  <td><input name="firstname" type="text" id="firstname" value="<?=@$result['firstname'];?>" size="40" /></td>
</tr>
<tr>
  <th>Surname <span class="Txt_red_12">*</span></th>
  <td><input name="lastname" type="text" id="lastname" value="<?=@$result['lastname'];?>" size="40" /></td>
</tr>
<tr>
  <th>กรม  <span class="Txt_red_12">*</span></th>
  <td>
  <select name="department" id="department" disabled="disabled">
    <option selected="selected" value="">เลือกกรม</option>
    <?php         
	foreach($department as $srow ):
	?>
    <option value="<?=$srow['id'];?>" <? if($srow['id']==@$result['departmentid'])echo "selected";?>><?=$srow['title'];?></option>
	<?php endforeach;?>
    </select>
</td>
</tr>
<tr>
  <th>กอง / สำนักงาน  <span class="Txt_red_12">*</span></th>
  <td>
  <div id="dvDivision">
  <select name="division" id="division" disabled="disabled">
    <option value="">เลือกกอง/สำนักงาน</option>
    <?php     
	foreach($division as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($srow['id']==@$result['divisionid'])echo "selected";?>><?=$srow['title'];?></option>
	<?php endforeach;?>
  </select>
  </div>
  </td>
</tr>
<tr>
  <th>กลุ่ม / ฝ่าย   <span class="Txt_red_12">*</span></th>
  <td>
  <div id="dvWorkgroup">
  <select name="workgroupid" id="workgroupid" disabled="disabled">
    <option value="">เลือกกลุ่ม/ฝ่าย</option>
    <?php    
    foreach($workgroup as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($srow['id']==@$result['workgroupid'])echo "selected";?>><?=$srow['title'];?></option>
	<?php endforeach; ?>
  </select>  
  </div>
  </td>
</tr>
<tr>
  <th>ประเภทบุคลากร  <span class="Txt_red_12">*</span></th>
  <td>
	<select name="typehuman" id="typehuman">
    <option value="">เลือกประเภทบุคลากร</option>
   <?php    
	foreach($type_human as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($srow['id']==@$result['typehuman'])echo "selected";?>><?=$srow['type_human'];?></option>
	<?php endforeach;?>
    </select>
    </td>
</tr>
<tr>
  <th>บัตรประชาชน</th>
  <td><input name="idcard" type="text" id="idcard" maxlength="13" value="<?=@$result['idcard'];?>" /></td>
</tr>
<tr>
  <th>เบอร์ติดต่อ</th>
  <td><input name="tel" type="text" id="tel" value="<?=@$result['tel'];?>" /></td>
</tr>
<tr>
  <th>อีเมล์  <span class="Txt_red_12">*</span></th>
  <td><input name="email" type="text" id="email" value="<?=@$result['email'];?>" size="30" /></td>
</tr>
<tr>
	<th>Username (สำหรับ เข้าใช้งานระบบ)</th>
	<td><input type="text" name="username" value="<?=@$result['username'];?>"></td>
</tr>
<? if(@$result['id']!=''){?>
<tr>
  <th >รหัสผ่านเดิม</th>
  <td ><?=@$result['password'];?></td>
</tr>

<? } ?>
<tr>
  <th >Password</th>
  <td ><input name="password" type="text" id="password" size="30" />     (เว้นไว้หากต้องการให้ระบบสร้างให้)</td>
</tr>
<tr>
  <th >Confirm Password</th>
  <td ><input name="cpassword" type="text" id="cpassword" size="30" /></td>
</tr>
<tr>	
	<th>วันที่ลงทะเบียน</th>
	<td><? if(@$result['registerdate']>0) echo stamp_to_th_abbrfulldate(@$result['registerdate']);?></td>
</tr>
<tr>	
	<th>วันที่แก้ไข</th>
	<td><? if(@$result['updatedate']>0) echo stamp_to_th_abbrfulldate(@$result['updatedate']);?></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input type="hidden" name="status" id="status" value="1">
  <input type="hidden" name="registerdate" value="<?=@$result["registerdate"];?>">
  <input type="hidden" name="hdpassword" value="<?=@$result['password'];?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>