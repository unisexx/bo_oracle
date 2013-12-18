<style type="text/css">  
  #multiselect a {  
   display: block;  
   border: 1px solid #aaa;  
   text-decoration: none;  
   background-color: #fafafa;  
   color: #123456;  
   margin: 2px;  
   clear:both;  
  }  
  #multiselect div {  
   float:left;  
   text-align: center;  
   margin: 10px;  
  }  
  #multiselect select {  
   width: 161px;  
   height: 200px;  
  }  
  body .tbadd td span {float:none; width:200px;}
  body .tbadd th{width: 195px;}
</style> 
<script type="text/javascript">
$(document).ready(function(){
	$("#btn_search").colorbox({width:"80%", inline:true, href:"#bg_source_form"});
	$("#show_result").click(function(){
		var txt_search = $("#tb_search").val();
		$("<img class='loading' src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rbgpt");
		$.post('c_user/search_users',{
			'txt_search' : txt_search
		},function(data){
			$("#dv_result").html(data);
			$(".loading").remove();
		});
	});
	$(".tb_user_list td").live('click',function(){
		var user_id = $(this).closest("tr").find("#hd_user_id").val();
		var user_name = $(this).closest("tr").find("#hd_user_name").val();
		$("#user_id").val(user_id);
		$("#title").val(user_name);
		$().colorbox.close();
	});
	
	$('#add').click(function() {  
		$('#select1 option:selected').remove().appendTo('#select2').removeAttr("selected");
		return false;
	});
	
	$('#remove').click(function() {
		$('#select2 option:selected').remove().appendTo('#select1').removeAttr("selected");
		return false;
	});
			
	$('.btn_save').click(function() {
		var usersId = $("#user_id").val();
		var year = $('select[name=year]').val();
		var provinceAreaId = "";
		var i =0;
		
		if(!usersId){
			alert("กรุณาเลือกผู้ตรวจ");
			return false;
		}
		
		if(year == 0){
			alert("กรุณาเลือกปี");
			return false;
		}
		
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom;' />").appendTo(".loading-icon");
		
		$("#select2 > option").each(function(index) {
			i++;				
			if(provinceAreaId != ""){
				provinceAreaId +=   "|" + $(this).val();
			}else{
				provinceAreaId += $(this).val();
			}
		});
		
		$.post('inspector_group/save_provincearea',{
				'users_id' : usersId,
				'province_area' : provinceAreaId,
				'year' : year
				},function(data){
					$("#form").submit();
		});
	});
});
</script>
<h3>ตั้งค่า กลุ่มผู้ตรวจ (เพิ่ม / แก้ไข)</h3>

<form id="form" action="inspector_group/save<?=$url_parameter;?>" method="post">
<table class="tbadd">
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
		<?php echo form_dropdown('year',get_option('distinct(mtyear)','mtyear+543','mt_strategy'),@$year,'','-- เลือกปีงบประมาณ --','0'); ?>
	  </td>
	</tr>
	<tr>
		<th>ชื่อ-สกุล ผู้ตรวจ</th>
		<td>  	  	
		  	<input name="title" type="text" id="title" value="<?=@$user_name?>" size="60" disabled /><input type="button" name="btn_search" id="btn_search" value=" เลือกผู้ตรวจ ">
		</td>
	</tr>
	<tr>
	<th>เขตจังหวัด<span class="Txt_red_12"> *</span></th>
  	<td id="multiselect">
  		<div>
  			<div><u>เขตจังหวัดทั้งหมด</u></div>
  			<br class="all">
  			<?php if(@$users_id > 0): ?>
  			<?php echo form_dropdown('province_area',get_option('id','title','cnf_province_area where id not in(select province_area from insp_group where users_id = '.@$users_id.' and year = '.@$year.')'),'','multiple id=select1','','0')?>
  			<?php else:?>
  				<?php echo form_dropdown('province_area',get_option('id','title','cnf_province_area'),'','multiple id=select1','','0')?>
  			<?php endif;?>
  		<a href="#" id="add">เพิ่ม &gt;&gt;</a>
  		</div>
  		<div>
			<div><u>เขตจังหวัดที่เลือก</u></div>
			<br clear="all">
			<?php if(@$users_id > 0): ?>
			<?php echo form_dropdown('province_area_select',get_option('cnf_province_area.id','cnf_province_area.title','insp_group left join cnf_province_area on insp_group.province_area = cnf_province_area.id where insp_group.users_id = '.@$users_id .' and insp_group.year = '.@$year.' order by cnf_province_area.id asc'),'','multiple id=select2','','0')?>
			<?php else:?>
  				<select id="select2" multiple="" name="province_area_select"></select>
  			<?php endif;?>
			
			<a href="#" id="remove">&lt;&lt; ลบ</a>
		 </div>
		 <div class='loadingicon'></div>
		 <br clear="all">
  	</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input id="user_id" name="users_id" type="hidden" value="<?php echo @$users_id;?>" class="users_id">
  <?php if(permission('inspector_group', 'canedit')):?>
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/> <span class="loading-icon"></span>
</div>
</form>

<!-- -------- colorbox -------- -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>เลือกผู้ใช้</h3>
        <div class="paddT20"></div>        
                      กรอกชื่อ - นามสกุล / อีเมล์ ผู้ใช้ <input type="text" id="tb_search" style="width:300px;">
        <input type="button" name="show_result" id="show_result" value=" ค้นหา "> <span id="rbgpt"></span>
        <div id="dv_result" style="height: 550px;">
        	
        </div>
		</div>
</div>