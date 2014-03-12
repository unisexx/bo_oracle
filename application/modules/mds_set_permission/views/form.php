<script type="text/javascript">	
$(document).ready(function(){
			
		//=====Colorbox=====//
			var url = '<? echo $urlpage; ?>/cbox_users';
			
			$(".search_users").colorbox({inline:true, href:"#inline_content", width:"80%",height:"80%"});
			$('.search_users').click(function(){
				$("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>").appendTo("#result_users");
				$('[name=sch_txt]').val('');
				$.get(url, function(data){ $("#result_users").html(data); })
			});
			
			
			$("#btn_search_users").click(function(){
				sch_txt = $('[name=sch_txt]').val(); 	
				
				$("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>").appendTo("#result_users");
	
				$.get(url,{
					'sch_txt' : sch_txt, 'page':1 },
					function(data){ $("#result_users").html(data); });
			})
			
			$('.pagination a').live('click', function(){
					$("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>").appendTo("#result_users");
					p_url = $(this).attr('href');
					$.get(p_url,
						function(data){ $("#result_users").html(data); 
					});
					return false;
			});
				
			$('.btn_users_slc').live('click', function(){
				var users_id = $(this).attr('users_id');
				var name = $(this).attr('name');
				var usersname = $(this).attr('usersname');
				var users_tel = $(this).attr('users_tel');
				var users_email= $(this).attr('users_email');
				var firstname = $(this).attr('firstname');
				var lastname = $(this).attr('lastname');
				var departmentid= $(this).attr('departmentid');
				var divisionid= $(this).attr('divisionid');
				var division_name = $(this).attr('division_name');
				var department_name = $(this).attr('department_name');
				
				$('[name=users_id]').val(users_id);
				$('[name=name]').val(name);
				$('[name=username]').val(usersname);
				$('[name=tel]').val(users_tel);
				$('[name=email]').val(users_email);
				$('[name=firstname]').val(firstname);
				$('[name=lastname]').val(lastname);
				$('[name=departmentid]').val(departmentid);
				$('[name=divisionid]').val(divisionid);
				$('[name=division_name]').val(division_name);
				$('[name=department_name]').val(department_name);

	
				jQuery('#cboxClose').click();
				
			});
		
		//=====

		$("form").validate({
			rules: {
				mds_set_permit_type_id:{required:true},
				name:{ required:true,
					   remote:{
							 url:'<? echo $urlpage; ?>/check_users',
							 data: { users_id:function(){ return $('[name=users_id]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
						}
					},
				mds_set_position_id:{ required: function(element) {
	        						   		   return $(".permit_type:checked").val() == '2';}},
			},
			messages:{
				mds_set_permit_type_id:{required:"กรุณาระบุประเภทสิทธิ์"},
				name:{required:"กรุณาระบุชื่อผู้ใช้",remote:"มีผู้ใช้งานนนี้ในระบบแล้ว"},
				mds_set_position_id:{required:"กรุณาระบุ"}
			},
			errorPlacement: function(error, element) 
	   		{
				if (element.attr("name") == "mds_set_permit_type_id" )
					$('#error_permit').html(error);
				else if (element.attr("name") == "name" )
					$('#error_name').html(error);
				else
				   error.insertAfter(element);
			}
		});	
		
			function show_position(){
				var permit = $(".permit_type:checked").val();
				if(permit == 2){
					$('.tr_position').show()
				}else{
					$('.tr_position').hide()
				}
			}
			
			$('.permit_type').live('change',function(){
				if ($(this).is(':checked')){
					$(".permit_type").removeAttr('checked');
					$(this).attr('checked','checked');			
					show_position()
				}
			});
			show_position();

});
</script>
<h3>ตั้งค่า สิทธิ์การใช้ระบบ SAR CARD (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo @$rs['permission_id']?>" style="width:500px;" />
<table class="tbadd">
<tr>
  <th>ประเภทสิทธิ์ <span class="Txt_red_12">*</span></th>
  <td>
  	<?
  	 if(@$rs['permission_id'] != ''){
  		$sql_permission = "select mds_set_permission_type.*,mds_set_permit_type.permit_name from mds_set_permission_type 
							left join mds_set_permit_type on mds_set_permission_type.mds_set_permit_type_id = mds_set_permit_type.id
							where mds_set_permission_type.mds_set_permission_id = '".$rs['permission_id']."' ";
		$result_permission = $this->permission_type->get($sql_permission);
		foreach ($result_permission as $key => $permis) {
			if($permis['mds_set_permit_type_id'] == '1'){
				$permit_1 = 'checked="checked"';
			}else if($permis['mds_set_permit_type_id'] == '2'){
				$permit_2 = 'checked="checked"';
			}else if($permis['mds_set_permit_type_id'] == '3'){
				$permit_3 = 'checked="checked"';
			}	
  	 	}
	 }
	?>
	
  	<span style="width: 150px"><input type="radio" name="mds_set_permit_type_id" class="permit_type" value="1" <?=@$permit_1?> /> กพร.</span>
  	<span><input type="radio" name="mds_set_permit_type_id" class="permit_type" value="2" <?=@$permit_2?> /> ผู้กำกับดูแลตัวชี้วัด</span>
  	<span><input type="radio" name="mds_set_permit_type_id" class="permit_type" value="3" <?=@$permit_3?> /> ผู้จัดเก็บข้อมูล</span>
  	<div id="error_permit"></div>
  </td>
</tr>
<tr>
  <th>บุคลากร<span class="Txt_red_12"> *</span></th>
  <td> 	
  	<input name="name" type="text" id="name" class="form-control" readonly="readonly" style="width:400px;" value="<?=@$rs['name']?>" />
  	<? if(@$rs['permission_id'] == ''){ ?>
  	<a class="search_users" href="#" onclick="return false;"><img src="themes/mdevsys/images/search_user.png" width="32" height="32" /></a>
  	<? } ?>
  	<div id="error_name"></div>
  	<input type="hidden" name="dtl_id" id="dtl_id" value="<?=@$rs['id']?>" />
  	<input type="hidden" name="users_id" id="users_id" value="<?=@$rs['permission_users_id']?>" />
  	<input type="hidden" name="username" id="username" value="<?=@$rs['username']?>" />
  	<input type="hidden" name="firstname" id="firstname" value="<?=@$rs['firstname']?>" />
  	<input type="hidden" name="lastname" id="lastname" value="<?=@$rs['lastname']?>" />
  	<input type="hidden" name="departmentid" id="departmentid" value="<?=@$rs['departmentid']?>" />
  	<input type="hidden" name="divisionid" id="divisionid" value="<?=@$rs['divisionid']?>" />
  	<input type="hidden" name="division_name" id="division_name" value="<?=@$rs['division_name']?>" />
  	<input type="hidden" name="department_name" id="department_name" value="<?=@$rs['department_name']?>" />
  	
  	
  </td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="email" type="text" class="form-control" id="email" style="width:300px;" value="<?=@$rs['email']?>" /></td>
</tr>
<tr>
  <th>เบอร์โทร</th>
  <td><input name="tel" type="text" class="form-control" id="tel" style="width:200px;" value="<?=@$rs['tel']?>"  /></td>
</tr>
<tr class="tr_position">
  <th>ตำแหน่งสายบริหาร <span class="Txt_red_12"> *</span></th>
  <td><?php echo form_dropdown("mds_set_position_id",get_option("id","pos_name","mds_set_position where status_id = '1' or id = '".@$rs['mds_set_position_id']."' order by id asc"),@$rs['mds_set_position_id'],'','-- เลือกตำแหน่งสายบริหาร --') ?></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>


<div style="display:none">
	<div id="inline_content" style="padding:10px; background:#fff;">
		<h3>ค้นหา > ข้อมูลผู้ใช้งาน</h3>
		<div id="search_users" class="search">
			ชื่อ-สกุล / Username  : <input type="text" name="sch_txt" value=""> <input type="button" style="width: 100px" name="btn_search_users" id="btn_search_users" value="ค้นหา">
		</div>
		<div id="result_users"></div>
	</div>
</div>