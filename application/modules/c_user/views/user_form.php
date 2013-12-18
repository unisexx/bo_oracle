<script type="text/javascript">
$(document).ready(function(){
	$("input[name=firstname],[name=lastname]").keyup(function(){
		var firstname = $("input[name=firstname]").val();
		var lastname = $("input[name=lastname]").val();
		
		$.post('ajax/check_username',{
			'firstname':firstname,
			'lastname':lastname
		},function(data){			
			$('input[name=username]').val(data);																					
		})
		
	});
	$(".btn_save").click(function(){
		var userid = $("input[name=id]").val();
		var fullname = $("input[name=name]").val();
		var firstname = $("input[name=firstname]").val();
		var lastname = $("input[name=lastname]").val();		
		$.post('ajax/check_exist_user',{
			'id':userid,
			'fullname':fullname,
			'firstname':firstname,
			'lastname':lastname
		},function(data){			
			if(data=='exist')
			{						
				alert("มี ชื่อ - นามสกุล อยู่ในระบบแล้ว");						
			}else{
				$("form").submit();
			}																
		})		
	})
	$("form").validate({
		rules: {
			
			name:"required",
			firstname:"required",
			lastname:"required",
			departmentid:"required",
			divisionid:"required",		
			typehuman:"required"
		},
		messages:{
			
			name:"กรุณาระบุข้อมูลด้วย",
			firstname:"กรุณาระบุข้อมูลด้วย",
			lastname:"กรุณาระบุข้อมูลด้วย",
			departmentid:"กรุณาระบุข้อมูลด้วย",
			divisionid:"กรุณาระบุข้อมูลด้วย",			
			typehuman:"กรุณาระบุข้อมูลด้วย"
		}
	});
	

				
			$("select[name=departmentid]").live("change",function(){
				pDepartmentID = $("select[name=departmentid]").val();								
				$("#dvDivision").append("<img src='images/loading.gif' align='absmiddle'>");				
				$.post('ajax/load_division_list',{
				'controlname' : 'divisionid',
				'departmentid' : pDepartmentID,
				'canaccessall' : 'on'
				},function(data){
					$("#dvDivision").html(data);																				
				})																			
			})

			$("select[name=divisionid]").live("change",function(){
				pDivisionID = $("select[name=divisionid]").val();
				$("#dvWorkgroup").append("<img src='images/loading.gif' align='absmiddle'>");				
				$.post('ajax/load_workgroup_list',{
				'controlname' : 'workgroupid',
				'divisionid' : pDivisionID,
				'canaccessall' : 'on'
				},function(data){
					$("#dvWorkgroup").html(data);																				
				})
			})
})
</script>
<form name="fmUser" enctype="multipart/form-data"  method="post" action="c_user/save<?=$url_parameter;?>">
<h3>ข้อมูลผู้ใช้งาน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
  <th>ชื่อ - นามสกุล<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="name" type="text" id="name" value="<?=@$result['name'];?>" size="40" />
  	<input name="id" type="hidden" id="id" value="<?=@$result['id'];?>">
  </td>
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
  <select name="departmentid" id="departmentid" >
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
  <td id="dvDivision">
  <?
  $condition = @$result['departmentid']>0 ? " departmentid=".$result['departmentid'] : "";
  $disable = @$result['departmentid']>0? "":" disabled" ;
  echo form_dropdown("divisionid",get_option("id","title","cnf_division",$condition),@$result['divisionid'],$disable,"-- เลือกกอง/สำนัก --","");
  ?>
  
  </td>
</tr>
<tr>
  <th>กลุ่ม / ฝ่าย   <span class="Txt_red_12">*</span></th>
  <td id="dvWorkgroup">
   <?
   $condition = @$result['divisionid']>0 ? " divisionid=".$result['divisionid'] : "";
   $disable = @$result['divisionid']>0 ? "": " disabled"; 
   echo form_dropdown("workgroupid",get_option("id","title","cnf_workgroup",$condition),@$result['workgroupid'],$disable,"-- เลือกกลุ่ม/ฝ่าย --","0");
   ?>
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
	<td id="td_username">
		<input type="text" name="username" value="<?=@$result['username'];?>">
	</td>
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
  <?php if(permission('c_user', 'canedit')): ?><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/><?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>