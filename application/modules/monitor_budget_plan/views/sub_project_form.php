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
</style>  
<script type="text/javascript">
$(document).ready(function(){
	$('#title').attr("style","width:550px;");
	$('input:text').setMask();
	$("select:not(select[name=KeyType],select[name=KeyUnitType],select[name=divisionid])").live('change',function(){
			//var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');			
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
			
			if($(this).val() != "")
			{
			nextselect = $(this).parents("tr").next("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().removeAttr("disabled");
			}
	});
		$("input").setMask();
		//$('.tblist2').rowCount();
		$('.tblist2 .rowNumber:last').text("");
		$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		
		$('.save_key').click(function(){
			var keyTypeText = $("select[name=KeyType]").find(':selected').text();
			var keyTypeId = $("select[name=KeyType]").val();			
			var keyUnitTypeText = $("select[name=KeyUnitType]").find(':selected').text();
			var keyUnitTypeId = $("select[name=KeyUnitType]").val();			
			var keyName = $("#KeyName").val();
			var keyNo = $("#KeyNo").val();
			
			var amount = new NumberFormat(keyNo).toFormatted();									
			var newrow = '<tr><td></td><td class="pKeyName">'+keyName+'<input type=hidden name="pKeyName[]" id="pKeyName" value='+keyName+'></td>';
			newrow += '<td class="pKeyType">'+keyTypeText+'<input type=hidden name="pKeyType[]" id="pKeyType" value='+keyTypeId+'></td>';
			newrow += '<td class="pKeyNo">'+keyNo+'<input type=hidden name="pKeyNo[]" id="pKeyNo" value='+keyNo+'></td>';
			newrow += '<td class="pKeyUnitType">'+keyUnitTypeText+'<input type=hidden name="pKeyUnitType[]" id="pKeyUnitType" value='+keyUnitTypeId+'></td>';			
			newrow += '<td><input type="button" class="btn_delete" /></td></tr>';
				
			var controlFlag = false;
			/*
			$('.tblist2 tr').each(function() {
			    var tbudgettype = $(this).find("#pbudgettypeid").val();
			    var texpenseid = $(this).find("#pexpenseid").val();    
			    var tbudgettype = $(this).find("#pbudgettypeid").val();
			    var texpenseid = $(this).find("#pexpenseid").val();    
			    if(tbudgettype== budgettypeid && texpenseid== expenseid)
			    {
			    	controlFlag = true;
			    	$(this).find(".amt").html(amount+'<input type=hidden name="charge[]" id="charge" value='+amount+'>');
			    }
			});*/

			if(controlFlag==false)
			{					
			$('.total').before(newrow);
			$('.tblist2').rowCount();
			$('.tblist2 .rowNumber:last').text("");
			}			
			$().colorbox.close();
			
		});	
		
		$('.btn_delete').live('click',function(){
			var answer = confirm("ยินยันการลบข้อมูล")
		    if(answer){
		       $(this).closest('tr').remove();
		       $('.tblist2').rowCount();
		       $('.tblist2 .rowNumber:last').text("");
		    }
		});
		
$('#add_div').click(function() {  
			var masterid = <?php echo $id?>;
			var mainprojectid = <?php echo $pid?>;
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
				$.post('monitor_budget_plan/save_subdetail',{
						'masterid' : masterid,
						'mainprojectid' : mainprojectid,
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
				$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit; margin:30px -15px;'>").appendTo(".loadingicon");
				
				var masterid = <?php echo $id?>;
				var mainprojectid = <?php echo $pid?>;
				var divisionid = "";$//("#select2 option:selected").val();
				$("#select2_div option:selected").each(function(index){
					if(divisionid != "")
						divisionid +=   "|" + $(this).val();
					else
						divisionid += $(this).val();
				})
				$.post('monitor_budget_plan/delSbudget_fromDivision',{
					'masterid' : masterid,
					'mainprojectid' : mainprojectid,
					'divisionid' : divisionid
				},function(data){
					$('#td_targettype').load('monitor_budget_plan/refresh_target/<?php echo $id?>',function(){						
					});
					
					$('#newTB').load('monitor_budget_plan/refresh_target/<?php echo $id?>',function(){
						$('#select2_div option:selected').remove().appendTo('#select1_div').removeAttr("selected");
						$('.loading').remove();
					});
				});
			}
			return false;
		});
		
		$('#add').click(function() {  
			
			var masterid = <?php echo $id?>;
			var mainprojectid = <?php echo $pid?>;
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
				$.post('monitor_budget_plan/save_subdetail',{
						'masterid' : masterid,
						'mainprojectid' : mainprojectid,
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
				
				var masterid = <?php echo $id?>;
				var mainprojectid = <?php echo $pid?>;
				var provinceid = "";$//("#select2 option:selected").val();
				$("#select2 option:selected").each(function(index){
					if(provinceid != "")
						provinceid +=   "|" + $(this).val();
					else
						provinceid += $(this).val();
				})
				$.post('monitor_budget_plan/delSbudget_fromProvince',{
					'masterid' : masterid,
					'mainprojectid' : mainprojectid,
					'provinceid' : provinceid
				},function(data){
					$('#td_targettype').load('monitor_budget_plan/refresh_target/<?php echo $id?>',function(){						
					});
					
					$('#newTB').load('monitor_budget_plan/refresh_table/<?php echo $id?>',function(){
						$('#select2 option:selected').remove().appendTo('#select1').removeAttr("selected");
						$('.loading').remove();
					});
				});
			}
			return false;
		});
		/*
		$(".budgetinput").each(function(){
			var budget = $(this).val();
			var budgetType_id = $(this).prev("input[name=budgettypeid[]]").val();
			var budgetSummary = 0;
			
			$("input.budget_type_"+budgetType_id).each(function(){
				budgetSummary += parseFloat($(this).val().replace(/[^0-9\.]+/g,""));
			});
			
			$(this).val(new NumberFormat(budgetSummary).toFormatted());
		});
	*/
});	
</script>	
<h3>แผนงบประมาณ กิจกรรมโครงการ และงบประมาณ (เพิ่ม / แก้ไข)</h3>
<form method="post" enctype="multipart/form-data" action="monitor_budget_plan/save/<?php echo $lv;?>/<?php echo $pid;?>/<?php echo $id;?>">
<div class="paddT20"></div>
<h5>โครงการ</h5>
<table class="tbadd">
				<tr>
				  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
				  <td>
				  	  <select name="mtyear" id="mtyear">
					    <option value="">-- เลือกปีงบประมาณ --</option>
					    <?php foreach($year_opt as $item){
					    	$selected = $pid >0 && @$parent['mtyear']==$item['fnyear'] ? " selected=selected" :  $id != '' && @$current['mtyear']==$item['fnyear'] ? " selected=selected" : "";
					    	echo "<option value=\"".$item['fnyear']."\" $selected >".($item['fnyear']+543)."</option>";
					    };?>
					  </select>
				  </td>
				</tr>
				<tr>
				  <th>กรม<span class="Txt_red_12"> *</span></th>
				  <td>
				  	  <? echo form_dropdown("departmentid",get_option("id","title","cnf_department"),@$parent['departmentid'],"","-- เลืกอกรม --","0"); ?>
				  </td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการกระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetid" id="ministrytargetid">
				    <option  value="0">-- เลือกเป้าหมายการให้บริการกระทรวง --</option>
				    <?php
				    $target = $this->mt_strategy->where("pid=0 and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($target as $item){
				    $selected = $pid >0 && @$parent['ministrytargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrytargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>ยุทธศาสตร์กระทรวง <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrystrategyid" id="ministrystrategyid">
				    <option  value="0">-- เลือกยุทธศาสตร์กระทรวง --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrystrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['ministrystrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าประสงค์ 4 ปี <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="ministrytargetyear" id="ministrytargetyear">
				    <option  value="0">-- เป้าประสงค์ 4 ปี  --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrystrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['ministrytargetyear']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>เป้าหมายการให้บริการหน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectiontargetid" id="sectiontargetid">
				    <option  value="0">-- เลือกเป้าหมายการให้บริการหน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['ministrytargetyear']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectiontargetid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectiontargetid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กลยุทธ์หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="sectionstrategyid" id="sectionstrategyid">
				    <option  value="0">-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectiontargetid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['sectionstrategyid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['sectionstrategyid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>ผลผลิต <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="productivityid" id="productivityid">
				    <option  value="0">-- เลือกกลยุทธ์หน่วยงาน --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['sectionstrategyid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['productivityid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['productivityid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainactid" id="mainactid">
				    <option  value="0">-- เลือกกิจกรรมหลัก --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['productivityid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['mainactid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['mainactid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>กิจกรรมย่อย <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="subactid" id="subactid">
				    <option  value="0">-- เลือกกิจกรรมย่อย --</option>
				    <?php
				    $strategy = $this->mt_strategy->where("pid=".$parent['pid']." and departmentid=".$parent['departmentid'])->get(FALSE,TRUE);
					foreach($strategy as $item){
				    $selected = $pid >0 && @$parent['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>
				<tr>
				  <th>หน่วยงาน <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="divisionid" id="divisionid">
				    <option  value="0">-- เลือกหน่วยงาน --</option>
				    <?php				    
					foreach($division as $item){
				    $selected = @$project['divisionid']==$item['id'] ? " selected=selected" :  $id != '' && @$current['divisionid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>	
				<tr>
				  <th>โครงการหลัก <span class="Txt_red_12"> *</span></th>
				  <td>
				  	<select name="mainprojectid" id="mainprojectid">
				    <option  value="0">-- เลือกโครงการหลัก --</option>
				    <?php			
				    $project_result = $this->mt_project->where("divisionid=".$project['divisionid']." AND PID=0")->get(FALSE,TRUE);	    
					foreach($project_result as $item){
				    $selected = @$project['id']==$item['id'] ? " selected=selected" :  $id != '' && @$current['pid']==$item['id'] ? " selected=selected" : "";				    					
					echo "<option value=\"".$item['id']."\" $selected >".$item['title']."</option>"; 
					 } ?>
				  </select></td>
				</tr>				
				<tr>
				  <th>โครงการย่อย  <span class="Txt_red_12"> *</span></th>
				  <td>				  	
				  	<input type="text" id="title" name="title" value="<?=@$current['title'];?>" size="80">
				  </td>
				</tr>
				<tr>
					<th>
					    เป้าหมาย
					</th>
					<td>
						<div id="td_targettype" style="display:inline"><input type="text" id="target" name="target" value="<?=@$current['target'];?>"></div>
						<?php echo form_dropdown('targettype',get_option('id','title','cnf_count_unit order by title '),@$current['targettype'],'','-- เลือกหน่วยนับ --')?>
					</td>
				</tr>
			</table>
			
<? if($id > 0 ){ ?>	
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
						 <div class='loadingicon'></div>
						 <br clear="all">
						 <div>
						 	<input id="colorbox_subdetail_div" type="button" value="บันทึกแผนงบประมาณส่วนกลาง"/>
						 </div>
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
								<?php foreach($province_selected as $province):?>
									<option value="<?php echo $province['id']?>"><?php echo $province['title']?></option>
								<?php endforeach;?>
							</select>
							<a href="#" id="remove">&lt;&lt; ลบ</a>
						 </div>
						 <div class='loadingicon'></div>
						 <br clear="all">
						 <div>
						 	<input id="colorbox_subdetail" type="button" value="บันทึกแผนงบประมาณส่วนภูมิภาค"/>
						 </div>
					</td>
				</tr>
</table>

<div class="paddT20"></div>
<div id="newTB">
<table class="tblist2" id="countTb">
<tr>
<th>หมวดงบประมาณ</th>
<th>จำนวนเงิน (บาท)</th>
</tr>
<?
$budget_type_result = $id > 0 ? $this->fn_budget_type->get("SELECT mtd.id,mtd.title,fbt.budget FROM mt_project_detail fbt LEFT JOIN fn_budget_type mtd on fbt.budgettypeid = mtd.id WHERE masterid=".$id." and pid=0",TRUE): $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);
$budget_type_result = $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);
foreach($budget_type_result as $budget_type):
	$sql = "SELECT SUM(sbudget) from mt_project_subdetail where sbudgettypeid = ".$budget_type['id']." and masterid=".$id; 
		$sbudget = $this->db->getone($sql);
?>
<tr >
<td class="odd"><?=$budget_type['title'];?></td>
<td>
	<input name="budgettypeid[]" type="hidden" value="<?=@$budget_type['id'];?>">
	<input name="budget[]" type="text"  id="budget" class="budgetinput" value="<?=@$sbudget;?>" alt="decimal" style="text-align:right;border:0px;background:#FFF;"/>	
</td>
</tr>
<?php endforeach;?>
</table>
<table class="tbadd">
	<tr>
		<th>เงินนอกงบประมาณ</th>
		<td>
			<? 
					$sql = " SELECT SUM(OFF_BUDGET) FROM MT_BUDGET_RECORD WHERE MASTERID=".$id;
					$off_bg = $this->db->getone($sql);					
			?>
			<? echo number_format($off_bg,2);?>
		</td>
	</tr>
</table>
</div>
<? } ?>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="window.location='monitor_budget_plan/index?mtyear=<?=$parent['mtyear'];?>&mtdepartment=<?=$parent['departmentid'];?>';" class="btn_back"/>
</div>
</form>


<!-- This contains the hidden content for inline calls -->
<style type="text/css">
	#subdetail table{
		width: 100%;
	}
	#subdetail table td{
		padding:5px;
	}
	.subdetail-title{
		width: 180px; 
		float: left;
	}
	.subdetail-list{
		padding: 5px 5px 5px 15px;
	}
	.detail-title{
		font-weight: bold;
		text-decoration: underline;
		padding: 10px 0;
	}
	.rate-style{
		margin: 0 0 0 30px;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#colorbox_subdetail").colorbox({width:"85%",height:"95%", inline:true, href:"#subdetail",title: function(){
		$('.xxx').html('');
		clear_form_elements("#subdetail-form");
		$("#select3").find("option:not(:first)").remove();
		$("#select2").children().clone().appendTo('#select3');
		$("#tb_sub_division").hide();
		$("#tb_sub_province").show();
	}});
	
	$("#colorbox_subdetail_div").colorbox({width:"85%",height:"95%", inline:true, href:"#subdetail",title: function(){
		$('.xxx').html('');
		clear_form_elements("#subdetail-form");
		$("#select4").find("option:not(:first)").remove();
		$("#select2_div").children().clone().appendTo('#select4');
		$("#tb_sub_division").show();
		$("#tb_sub_province").hide();
	}});
	
	/*
	$(".rate-style").each(function(){
		var title = $(this).closest(".subdetail-ul").prev(".detail-title").text();
		if(title != "งบบุคลากร"){
			$(this).hide();
		}
	});*/
	
	//--- ฟังก์ชัน serializePost ทำหน้าที่เหมือน serialize แต่แปลงค่าเป็น array ให้เลย 
	(function($) {  
	    $.fn.serializePost = function() {  
	        var data = {};  
	        var formData = this.serializeArray();  
	        for(var i=0; i<formData.length; i++){
	            var name = formData[i].name;  
	            var value = formData[i].value;  
	            var index = name.indexOf('[]');  
	            if (index > -1) {  
	                name = name.substring(0, index);  
	                if (!(name in data)) {  
	                    data[name] = [];  
	                }  
	                data[name].push(value);  
	            }  
	            else  
	                data[name] = value;  
	        }  
	        return data;  
	    };  
	})(jQuery);
	//----- end function -----
	
	//--- ฟังก็ชัน Clear Form Element
	function clear_form_elements(ele) {
	    $(ele).find(':input').each(function() {
	        switch(this.type) {
	            case 'password':
	            case 'select-multiple':
	            case 'select-one':
	            case 'text':
	            case 'textarea':
	                $(this).val('');
	                break;
	            case 'checkbox':
	            case 'radio':
	                this.checked = false;
	        }
	    });
	}
	//----- end function -----


	$("#submit-btn").live("click",function(){
		var value = $("#subdetail-form").serializePost();
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit'>").appendTo(".btn_zone");
		$.post('monitor_budget_plan/subdetail_ajax',{
			'value' : value,
		},function(data){
			$('#td_targettype').load('monitor_budget_plan/refresh_target/<?php echo $id?>',function(){						
					});
			
			$('#newTB').load('monitor_budget_plan/refresh_table/<?php echo $id?>',function(){
				
				$(".loading,#subdetail-tb").remove();
				$.colorbox.close();
			});
		});
	});
	
	$("select[name='provinceid']").live('change',function(){
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit'>").appendTo(".pv_zone");
		
		var provinceid = ($(this).val());
		var masterid = <?php echo $id?>;
		var mainprojectid = <?php echo $this->uri->segment(4)?>;
		var targettype = $("select[name=targettype]").val();
		
		if(provinceid > 0)  $("#cb_allprovince").removeAttr("checked");
		
		$.post('monitor_budget_plan/subdetail_form_ajax',{
			'targettype' :targettype,
			'provinceid' : provinceid,
			'masterid' : masterid,
			'mainprojectid' : mainprojectid
		},function(data){
			$('.loading').remove();
			$('.xxx').html(data);
		});
	});
	
	$("select[name='sub_divisionid']").live('change',function(){
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:inherit'>").appendTo(".pv_zone");
		
		var provinceid = 2;
		var divisionid = ($(this).val());
		var masterid = <?php echo $id?>;
		var mainprojectid = <?php echo $this->uri->segment(4)?>;
		var targettype = $("select[name=targettype]").val();
		
		if(divisionid > 0)  $("#cb_alldivision").removeAttr("checked");
		
		$.post('monitor_budget_plan/subdetail_form_ajax',{
			'targettype' :targettype,
			'provinceid' : provinceid,
			'divisionid' : divisionid,
			'masterid' : masterid,
			'mainprojectid' : mainprojectid
		},function(data){
			$('.loading').remove();
			$('.xxx').html(data);
		});
	});
	
	$("#cb_alldivision").live("click",function(){
		if(($("#cb_alldivision:checked").length)==1){
		var provinceid = 'all';
		var divisionid = 'all';
		var alldivisionid = "";	
		var allprovinceid = "";			
		var masterid = <?php echo $id?>;
		var mainprojectid = <?php echo $this->uri->segment(4)?>;
		var targettype = $("select[name=targettype]").val();
		
		
		$("#select2_div option").each(function(index){
			if(alldivisionid != "")
				alldivisionid +=   "|" + $(this).val();
			else
				alldivisionid += $(this).val();
		})
		
		$("select[name=sub_divisionid] option:selected").removeAttr("selected");
		$.post('monitor_budget_plan/subdetail_form_ajax',{			
			'targettype' :targettype,
			'provinceid' : provinceid,
			'divisionid' : divisionid,
			'masterid' : masterid,
			'mainprojectid' : mainprojectid,
			'alldivisionid' : alldivisionid,
			'allprovinceid' : allprovinceid
		},function(data){
			$('.loading').remove();
			$('.xxx').html(data);
		});}else{$('.xxx').html('')};
	})
	
	$("#cb_allprovince").live("click",function(){
		if(($("#cb_allprovince:checked").length)==1){
		var provinceid = 'all';
		var divisionid = 'all';
		var alldivisionid = "";
		var allprovinceid = "";		
		var masterid = <?php echo $id?>;
		var mainprojectid = <?php echo $this->uri->segment(4)?>;
		var targettype = $("select[name=targettype]").val();
		
		$("select[name=provinceid] option:selected").removeAttr("selected");
		$("#select2 option").each(function(index){
			if(allprovinceid != "")
				allprovinceid +=   "|" + $(this).val();
			else
				allprovinceid += $(this).val();
		})
		
		$.post('monitor_budget_plan/subdetail_form_ajax',{			
			'targettype' :targettype,
			'provinceid' : provinceid,
			'divisionid' : divisionid,
			'masterid' : masterid,
			'mainprojectid' : mainprojectid,
			'alldivisionid' : alldivisionid,
			'allprovinceid' : allprovinceid
		},function(data){
			$('.loading').remove();
			$('.xxx').html(data);
		});}else{$('.xxx').html('')};
	})	
	
});
</script>

<div style="display:none;">
<div id='subdetail'>
<form id="subdetail-form">
	<fieldset>
		<legend>บันทึกข้อมูลงบประมาณ</legend>
    	<table id="tb_sub_province">
    		<tr>
    			<td width="138">จังหวัด <span class="Txt_red_12">*</span></td>
    			<td class='pv_zone'>
    				<select name="provinceid" id="select3">
    					<option value="0">--- เลือกจังหวัด ---</option>
    				</select>
    				<input type="checkbox" name="cb_allprovince" id="cb_allprovince"> ยอดเท่ากันทุกจังหวัด (เลือกหากต้องการปรับยอดเท่ากันทุกจังหวัด)
    			</td>
    		</tr>
    	</table>
    	<table id="tb_sub_division">
    		<tr>
    			<td width="138">หน่วยงานส่วนกลาง <span class="Txt_red_12">*</span></td>
    			<td class='dv_zone'>
    				<select name="sub_divisionid" id="select4">
    					<option value="0">--- เลือกหน่วยงาน ---</option>
    				</select>
    				<input type="checkbox" name="cb_alldivision" id="cb_alldivision"> ยอดเท่ากันทุกหน่วยงาน (เลือกหากต้องการปรับยอดเท่ากันทุกหน่วยงาน)
    			</td>
    		</tr>
    	</table>
    	<div class="xxx">
    	<!-- <table>
    		<tr>
    			<td>เป้าหมาย</td>
    			<td>
    				<input type="text" name="target_value" value="0" size="15" maxlength="32">
	                <?php echo form_dropdown('targettype_id',get_option('id','title','cnf_count_unit'),@$current['targettype_id'],'','-- เลือกหน่วยนับ --')?>
            	</td>
    		</tr>
    		<tr>
    			<td style="vertical-align: top;">แผนงบประมาณ</td>
    			<td>
    				<ul>
    				<?php foreach($budget_type_result as $budget_type): ?>
						<li>
							<div class="detail-title"><?=$budget_type['title'];?></div>
							<ul class="subdetail-ul">
								<?php $sub_type = $this->fn_budget_type->where("pid = ".$budget_type['id'])->get();?>
								<?php foreach($sub_type as $item):?>
									<li class="subdetail-list">
										<div class="subdetail-title"><?php echo $item['title']?></div>
										<input type="hidden" name="mt_project_detail_id[]" value="<?php echo $budget_type['id']?>">
										<input type="hidden" name="subdetail_id[]" value="">
										<input type="hidden" name="sbudgettypeid[]" value="<?php echo $item['id']?>">
										<input type="text" name='sbudget[]' value="" alt="decimal"> บาท
										<span class="rate-style"><input type="text" name="rate[]" size="2"> อัตรา</span>
									</li>
								<?php endforeach;?>
							</ul>
						</li>
		    		<?php endforeach;?>
		    		</ul>
    			</td>
    		</tr>
    		<tr>
    			<td>เงินนอกงบประมาณ</td>
    			<td><input type="text" name="off_budget" alt="decimal" value=""> บาท</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td>
    				<input type="hidden" name="mainprojectid" value="<?php echo $this->uri->segment(4)?>">
    				<input type="hidden" name="masterid" value="<?php echo $id?>">
    				<input id="submit-btn" type="button" value="บันทึก">
    				<input type="button" value="ยกเลิก">
    			</td>
    		</tr>
    	</table> -->
    	</div>
	</fieldset>
</form>
</div>
</div>