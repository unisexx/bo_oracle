<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/tinymce.js"></script>
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
   width: 150px;  
   height: 200px;  
  }  
  body .tbadd td span {float:none; width:200px;}
  body .tbadd th{width: 195px;}
</style> 
<script type="text/javascript">
$(document).ready(function(){	
	<? if(@$id <1){?>
	$("select:not(select[name=budgetyear],#select1,#select2,#select1_div,#select2_div)").attr("disabled","disabled");
	$("#objective,#projectname").attr("disabled","disabled");
	<? } ?>	
	
	$('select[name=budgetyear]').live('change',function(){
		var fnyear = ($(this).val());
		
		if(fnyear != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#ddpm");
			$.post('ajax/load_department_list',{
						'controlname':'departmentid',
						'condition' : "inspectuse = 'on' ",
						'canaccessall' : '<?php echo login_data('insp_access_all')?>'
					},function(data){
						$("#ddpm").html(data);
			})
		}
	});
	
	$('select[name=departmentid]').live('change',function(){
			$('#xxx').remove();
			var departmentid = ($(this).val());
			
			if(departmentid != 0){
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tddv");
				
				$.post('ajax/load_division_list',{
					'departmentid' : departmentid,
					'controlname':'divisionid',						
					'canaccessall' : '<?php echo login_data('INSP_ACCESS_ALL')?>'
				},function(data){
					$("#tddv").html(data);
				})
				
				$.post('inspect_project_management/ajax_find_project_from_departmentid',{
					'departmentid' : departmentid
				},function(data){
					$("#tdprj").html(data);
				});
				
				var form_id = <?php echo $id?>;
				if(form_id != 0){
					$.post('inspect_project_management/refresh_central_division_form',{
						'departmentid' : departmentid
					},function(data){
						$("#xxx").html(data);
					});
				}
				
				if(departmentid > 0 ){
					$("#objective,#projectname").removeAttr("disabled","disabled");
				}else{
					$("#objective,#projectname").attr("disabled","disabled");
				}
			}
		});
		
		$('select[name=divisionid]').live('change',function(){
			var curr_project = "<?php echo @$detail['mtprojectid']?>";
			var divisionid = ($(this).val());	
			var budgetyear = $("select[name=budgetyear]").val();
			if(divisionid != 0){
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#tdprj");
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#workgrouplist");
				
				$.post('ajax/load_workgroup_list',{
					'divisionid' : divisionid,
					'controlname':'workgroupid',						
					'canaccessall' : '<?php echo login_data('INSP_ACCESS_ALL')?>'
				},function(data){
					$("#workgrouplist").html(data);
				});
				
				$.post('inspect_project_management/select_project_from_division',{
					'budgetyear':budgetyear,
					'divisionid' : divisionid,
					'curr_project': curr_project
				},function(data){
					$("#tdprj").html(data);
					$("select[name=workgroupid]").removeAttr("disabled","disabled");
				});
				
			}

				if(divisionid > 0 ){
					$("#objective,#projectname").removeAttr("disabled","disabled");
				}else{
					$("#objective,#projectname").attr("disabled","disabled");
				}
		});
		$('select[name=provinceid]').live('change',function(){
			$('select[name=projectid]').removeAttr("disabled","disabled");
		})
		$('select[name=projectid]').live('change',function(){
			var projectid = ($(this).val());
		});
		
		$(".btn_addmore").click(function(){
			$(this).closest("tr").find("td").append("<input type='text' name='actitle[]' size='50' style='margin-bottom:5px;'> <input class='del' type='button' value=' x '><br>");
		});
		
		$('select:not([name=workgroupid])').live('change',function(){
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
		});
		
		$("form").validate({
			rules: {
				budgetyear:"required",
				departmentid:"required",
				// divisionid:"required",
				objective:"required"
			},
			messages:{
				budgetyear:"กรุณาระบุข้อมูลด้วย",
				departmentid:"กรุณาระบุข้อมูลด้วย",
				// divisionid:"กรุณาระบุข้อมูลด้วย",
				objective:"กรุณาระบุข้อมูลด้วย"
			}
		});
		
		$(".del").live("click",function(){
			if($(this).prev("input[type=text]").val() == ""){
				$(this).prev("input[type=text]").remove();
				$(this).next("br").remove();
				$(this).remove();
			}else{
				var answer = confirm("ยืนยันการลบข้อมูลนี้");
				if(answer){
					$(this).prev("input[type=text]").remove();
					$(this).next("br").remove();
					$(this).remove();
				}
			}
		});
		
		$('#add').click(function() {  
			var id = <?php echo $id?>;
			var provinceid = "";
			var i =0;
			$('#select1 option:selected').remove().appendTo('#select2').removeAttr("selected");
			$("#select2 > option").each(function(index) {
				i++;				
				if(provinceid != "")
					provinceid +=   "|" + $(this).val();
				else
					provinceid += $(this).val();
			});
			
			if(provinceid != ""){
				$.post('inspect_project_management/save_subdetail',{
						'insp_project_id' : id,
						'provinceid' : provinceid	
						},function(data){
				});
			}
			
			return false;
		});
		
		$('#remove').click(function() {
			var answer = confirm("ยืนยันการลบข้อมูล");
			if(answer){
				$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit; margin:30px -15px;'>").appendTo(".loadingicon");
				
				var id = <?php echo $id?>;
				var provinceid = "";
				$("#select2 option:selected").each(function(index){
					if(provinceid != "")
						provinceid +=   "|" + $(this).val();
					else
						provinceid += $(this).val();
				})
				
				$.post('inspect_project_management/delSbudget_fromProvince',{
					'insp_project_id' : id,
					'provinceid' : provinceid
				},function(data){
						$('.loading').remove();
						$('#select2 option:selected').remove().appendTo('#select1').removeAttr("selected");
				});
			}
			return false;
		});
		
		$('#add_div').livequery('click',function(){
			var id = <?php echo $id?>;
			var provinceid = "";
			var divisionid = "";
			var i =0;
			$('#select1_div option:selected').remove().appendTo('#select2_div').removeAttr("selected");
			$("#select2_div > option").each(function(index) {
				i++;				
				if(divisionid != "")
					divisionid +=   "|" + $(this).val();
				else
					divisionid += $(this).val();
			});
			
			if(divisionid != ""){
				$.post('inspect_project_management/save_subdetail',{
						'insp_project_id' : id,
						'provinceid' : provinceid,
						'divisionid' : divisionid
						},function(data){
							
				});
			}		
			return false;
		});
		
		$('#remove_div').click(function() {
			var answer = confirm("ยืนยันการลบข้อมูล");
			if(answer){
				$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit; margin:30px -15px;'>").appendTo(".loadingicon2");
				
				var id = <?php echo $id?>;
				var divisionid = "";
				$("#select2_div option:selected").each(function(index){
					if(divisionid != "")
						divisionid +=   "|" + $(this).val();
					else
						divisionid += $(this).val();
				})
				$.post('inspect_project_management/delSbudget_fromDivision',{
					'insp_project_id' : id,
					'divisionid' : divisionid
				},function(data){
					$('.loading').remove();
					$('#select2_div option:selected').remove().appendTo('#select1_div').removeAttr("selected");
				});
			}
			return false;
		});
		
		$('#add_home').click(function() {  
			var id = <?php echo $id?>;
			var provinceid = "";
			var i =0;
			$('#select1_home option:selected').remove().appendTo('#select2_home').removeAttr("selected");
			$("#select2_home > option").each(function(index) {
				i++;				
				if(provinceid != "")
					provinceid +=   "|" + $(this).val();
				else
					provinceid += $(this).val();
			});
			
			if(provinceid != ""){
				$.post('inspect_project_management/save_subdetail',{
						'insp_project_id' : id,
						'home_provinceid' : provinceid	
						},function(data){
				});
			}
			
			return false;
		});
		
		$('#remove_home').click(function() {
			var answer = confirm("ยืนยันการลบข้อมูล");
			if(answer){
				$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit; margin:30px -15px;'>").appendTo(".loadingicon");
				
				var id = <?php echo $id?>;
				var provinceid = "";
				$("#select2_home option:selected").each(function(index){
					if(provinceid != "")
						provinceid +=   "|" + $(this).val();
					else
						provinceid += $(this).val();
				})
				
				$.post('inspect_project_management/delSbudget_fromProvinceHome',{
					'insp_project_id' : id,
					'home_provinceid' : provinceid
				},function(data){
						$('.loading').remove();
						$('#select2_home option:selected').remove().appendTo('#select1_home').removeAttr("selected");
				});
			}
			return false;
		});
		
		$('#add_social').click(function() {  
			var id = <?php echo $id?>;
			var provinceid = "";
			var i =0;
			$('#select1_social option:selected').remove().appendTo('#select2_social').removeAttr("selected");
			$("#select2_social > option").each(function(index) {
				i++;				
				if(provinceid != "")
					provinceid +=   "|" + $(this).val();
				else
					provinceid += $(this).val();
			});
			
			if(provinceid != ""){
				$.post('inspect_project_management/save_subdetail',{
						'insp_project_id' : id,
						'social_provinceid' : provinceid	
						},function(data){
				});
			}
			
			return false;
		});
		
		$('#remove_social').click(function() {
			var answer = confirm("ยืนยันการลบข้อมูล");
			if(answer){
				$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit; margin:30px -15px;'>").appendTo(".loadingicon");
				
				var id = <?php echo $id?>;
				var provinceid = "";
				$("#select2_social option:selected").each(function(index){
					if(provinceid != "")
						provinceid +=   "|" + $(this).val();
					else
						provinceid += $(this).val();
				})
				
				$.post('inspect_project_management/delSbudget_fromProvinceSocial',{
					'insp_project_id' : id,
					'social_provinceid' : provinceid
				},function(data){
						$('.loading').remove();
						$('#select2_social option:selected').remove().appendTo('#select1_social').removeAttr("selected");
				});
			}
			return false;
		});
})
</script>
<form action="inspect_project_management/save/<?=@$id;?><?=$url_parameter;?>" method="post" >
<h3>ตั้งค่า จัดการโครงการและวัตถุประสงค์ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
          <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
          <td>
          <select name="budgetyear" id="budgetyear">
            <option value="">-- เลือกปีงบประมาณ --</option>
            <?php foreach($byear as $item){
		    	$selected = @$detail['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
		    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
		    }
		    ?>
          </select>
          </td>
        </tr>
          <tr>
            <th>กรม<span class="Txt_red_12"> *</span></th>
            <td id="ddpm">
           	<?php echo @form_dropdown('departmentid',get_option("id","title","cnf_department"," inspectuse = 'on' "),@$detail['departmentid'],'','-- เลือกกรม --','0')  ?>            
            </td>
          </tr>
          <tr>
            <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
            <td id="tddv">
            <?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$detail['departmentid']),@$detail['divisionid'],'','-- เลือกหน่วยงาน --','0')  ?>            
            </td>
          </tr>
          <tr>
            <th>กลุ่มงาน</th>
            <td id="workgrouplist">
            <?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid = ".@$detail['divisionid']),@$detail['workgroupid'],'','-- เลือกกลุ่มงาน --','0'); ?>            
            </td>
          </tr>
          <tr>
            <th>โครงการ<span class="Txt_red_12"> *</span></th>
            <td>
            <span id="tdprj">
           	<?php
           	if(@$detail['divisionid'] == 0){
           		echo @form_dropdown('projectid',get_option('id','title','mt_project where departmentid = '.@$detail['departmentid']),@$detail['mtprojectid'],'','-- เลือกโครงการ --','0');
           	}else{
           		$option = @$detail['mtprojectid'] > 0 ? " OR ID=".@$detail['mtprojectid'] : ""; 
           	echo @form_dropdown('projectid',get_option("id","title","mt_project where pid=0 AND PYEAR=".@$detail['projectyear']." AND DIVISIONID=".@$detail['divisionid']." AND (ID NOT IN(SELECT MTPROJECTID FROM INSP_PROJECT) ".$option.") ORDER BY ID "),@$detail['mtprojectid'],'','-- เลือกโครงการ --','0');
           	}
            ?>
           	</span>
           	<br><br>ชื่อโครงการ : <input id="projectname" type="text" name="title" size="54" value="<?php echo @$detail['title']?>">
           	</td>
          </tr>
<tr>
  <th>วัตถุประสงค์<span class="Txt_red_12"> *</span> </th>
  <td><textarea name="objective" class="editor"><?=@$detail['objective'];?></textarea></td>
</tr>
	<tr>
	  <th>กิจกรรมหลัก <input type="button" title="เพิ่มรายการ" value=" " class="btn_addmore"></th>
	  <td>
	  	<?php if(@$detail['id']):?>
	  	<?php foreach($mainactivity as $mainac):?>
	  		<input type='text' name='actitle[]' value="<?php echo $mainac['actitle']?>" size='50' style='margin-bottom:5px;'> <input class='del' type='button' value=' x '><br>
	  	<?php endforeach;?>
	  	<?php endif;?>
	  </td>
	</tr>
</table>
<div id="xxx">
<?php if(@$id > 0 && @$detail['departmentid'] == "4"):?>
	<table class="tbadd">			
		<tr>
			<th>ส่วนกลาง</th>
			<td id="multiselect">
				<div>
					<div><u>หน่วยงานส่วนกลางทั้งหมด</u></div>
					<br clear="all">
					<select multiple id="select1_div" style="width:350px;">
					<?php foreach($central_division as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
					<?php endforeach;?>
					</select>
					<a href="#" id="add_div">เพิ่ม &gt;&gt;</a>
				 </div>
				 <div>
					<div><u>หน่วยงานส่วนกลางที่เลือก</u></div>
					<br clear="all">
					<select multiple id="select2_div" style="width:350px;">
						<?php foreach($division_selected as $division): ?>
							<option value="<?php echo $division['id']?>"><?php echo $division['title']?></option>
						<?php endforeach;?>
					</select>
					<a href="#" id="remove_div">&lt;&lt; ลบ</a>
				 </div>
				 <div class='loadingicon2'></div>
				 <br clear="all">
			</td>
		</tr>
	</table>
	<table class="tbadd">			
		<tr>
			<th>บ้านพักเด็กและครอบครัว</th>
			<td id="multiselect">
				<div>
					<div><u>จังหวัดทั้งหมด</u></div>
					<br clear="all">
					<select multiple id="select1_home">
					<?php foreach($home_province as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
					<?php endforeach;?>
					</select>
					<a href="#" id="add_home">เพิ่ม &gt;&gt;</a>
				 </div>
				 <div>
					<div><u>จังหวัดที่เลือก</u></div>
					<br clear="all">
					<select multiple id="select2_home">
						<?php foreach($home_province_selected as $province): ?>
							<option value="<?php echo $province['id']?>"><?php echo $province['title']?></option>
						<?php endforeach;?>
					</select>
					<a href="#" id="remove_home">&lt;&lt; ลบ</a>
				 </div>
				 <div class='loadingicon'></div>
				 <br clear="all">
			</td>
		</tr>
	</table>
	<table class="tbadd">			
		<tr>
			<th>ศูนย์พัฒนาสังคม</th>
			<td id="multiselect">
				<div>
					<div><u>จังหวัดทั้งหมด</u></div>
					<br clear="all">
					<select multiple id="select1_social">
					<?php foreach($social_province as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
					<?php endforeach;?>
					</select>
					<a href="#" id="add_social">เพิ่ม &gt;&gt;</a>
				 </div>
				 <div>
					<div><u>จังหวัดที่เลือก</u></div>
					<br clear="all">
					<select multiple id="select2_social">
						<?php foreach($social_province_selected as $province): ?>
							<option value="<?php echo $province['id']?>"><?php echo $province['title']?></option>
						<?php endforeach;?>
					</select>
					<a href="#" id="remove_social">&lt;&lt; ลบ</a>
				 </div>
				 <div class='loadingicon'></div>
				 <br clear="all">
			</td>
		</tr>
	</table>
<?php else:?>
<table class="tbadd">			
				<tr>
					<th>ส่วนกลาง</th>
					<td id="multiselect">
						<div>
							<div><u>หน่วยงานส่วนกลางทั้งหมด</u></div>
							<br clear="all">
							<select multiple id="select1_div" style="width:350px;">
							<?php foreach($central_division as $item):?>
							<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
							<?php endforeach;?>
							</select>
							<a href="#" id="add_div">เพิ่ม &gt;&gt;</a>
						 </div>
						 <div>
							<div><u>หน่วยงานส่วนกลางที่เลือก</u></div>
							<br clear="all">
							<select multiple id="select2_div" style="width:350px;">
								<?php foreach($division_selected as $division): ?>
									<option value="<?php echo $division['id']?>"><?php echo $division['title']?></option>
								<?php endforeach;?>
							</select>
							<a href="#" id="remove_div">&lt;&lt; ลบ</a>
						 </div>
						 <div class='loadingicon2'></div>
						 <br clear="all">
					</td>
				</tr>
</table>
<table class="tbadd">			
				<tr>
					<th>ส่วนภูมิภาค</th>
					<td id="multiselect">
						<div>
							<div><u>จังหวัดทั้งหมด</u></div>
							<br clear="all">
							<select multiple id="select1">
							<?php foreach($province as $item):?>
							<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
							<?php endforeach;?>
							</select>
							<a href="#" id="add">เพิ่ม &gt;&gt;</a>
						 </div>
						 <div>
							<div><u>จังหวัดที่เลือก</u></div>
							<br clear="all">
							<select multiple id="select2">
								<?php foreach($province_selected as $province): ?>
									<option value="<?php echo $province['id']?>"><?php echo $province['title']?></option>
								<?php endforeach;?>
							</select>
							<a href="#" id="remove">&lt;&lt; ลบ</a>
						 </div>
						 <div class='loadingicon'></div>
						 <br clear="all">
					</td>
				</tr>
</table>
<?php endif;?>
</div>
<div id="btnBoxAdd">
  <?php if(permission('inspect_project_management', 'canedit')):?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>