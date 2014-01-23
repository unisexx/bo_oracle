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
				var users_name = $(this).attr('users_name');
				var users_tel = $(this).attr('users_tel');
				var users_email= $(this).attr('users_email');
				
				$('[name=users_id]').val(users_id);
				$('[name=users_name]').val(users_name);
				$('[name=tel]').val(users_tel);
				$('[name=email]').val(users_email);

	
				jQuery('#cboxClose').click();
				
			});
		
		//=====

		$("form").validate({
			rules: {
				mds_set_permit_type_id:{required:true, 
							    		remote:{
							    			url:'<? echo $urlpage; ?>/check_users',
							    			data: { permit_id:function(){ return $('[name=mds_set_permit_type_id]').val(); }, 
							    					users_id:function(){ return $('[name=users_id]').val(); } ,
							    					id:function(){ return $('[name=id]').val(); }
							    				  }
							    			}
				    				  },
				users_name:"required"
			},
			messages:{
				mds_set_permit_type_id:{required:"กรุณาระบุประเภทสิทธิ์", remote:"ผู้ใช้นี้มีสิทธิ์นี้อยู่ในระบบแล้ว"},
				users_name:"กรุณาตรวจสอบชื่อผู้ใช้"
			}
		});
});
</script>
<h3>ตั้งค่า ตำแหน่งสายบริหาร (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo @$rs['id']?>" style="width:500px;" />
<table class="tbadd">
<tr>
  <th>ประเภทสิทธิ์ <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown("mds_set_permit_type_id",get_option("id","permit_name","mds_set_permit_type order by id"),@$rs['mds_set_permit_type_id'],'','-- ทุกประเภทสิทธิ์การใช้งาน --') ?></td>
</tr>
<tr>
  <th>บุคลากร<span class="Txt_red_12"> *</span></th>
  <td> 	
  	<input name="users_name" type="text" id="users_name" class="form-control" readonly="readonly" style="width:400px;" value="<?=@$rs['name']?>" />
  	<a class="search_users" href="#" onclick="return false;"><img src="themes/mdevsys/images/search_user.png" width="32" height="32" /></a>
  	<input type="hidden" name="users_id" id="users_id" value="<?=@$rs['users_id']?>" />
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
<tr>
  <th>ตำแหน่งสายบริหาร</th>
  <td><?php echo form_dropdown("mds_set_position_id",get_option("id","pos_name","mds_set_position order by id asc"),@$rs['mds_set_position_id'],'','-- เลือกตำแหน่งสายบริหาร --') ?></td>
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
		<div id="result_users">xxxx</div>
	</div>
</div>