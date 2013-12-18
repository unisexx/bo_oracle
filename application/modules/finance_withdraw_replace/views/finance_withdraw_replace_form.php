<script type="text/javascript">
$(document).ready(function(){
	
	var p_plantype,p_workgroupid,p_budgetplantype;
	$("input").setMask();
	p_plantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	p_workgroupid = <?php echo @$rs['workgroupid']<1 ? 0 : @$rs['workgroupid'];?>;
	p_budgetplantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	<? if(@$rs['id']<1){?>$("select:not(select[name=budgetmenu],select[name=budget_type],select[name=budgetyear],select[name=other_page],select[name=projectid],select[name=rdepartment_id])").attr("disabled","disabled");<? } ?>
	$('select[name=rdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvrdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvrdivision_id").html(data);
				$("#dvrdivision_id > #divisionid").attr("id","rdivision_id");
				$("#rdivision_id").attr('name', 'rdivision_id');										
			})
		}
		
	});
	$('select[name=rdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvrworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvrworkgroup_id").html(data);
				$("#dvrworkgroup_id > #workgroupid").attr("id","rworkgroup_id");				
				$("#rworkgroup_id").attr('name', 'rworkgroup_id');	
			})
		}
		
	});		
	$('select[name=budgetyear]').live('change',function(){
		var fnyear = ($(this).val());	
		
		if(fnyear != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgpt");
			$.post('finance_budget_related/select_fnyear_2_find_bgplantype',{
				'fnyear' : fnyear,
			},function(data){
				$("#bgpt").html(data);
			})
		}
	});
	
	$('select[name=budgetplantype]').live('change',function(){
		var plantype = ($(this).val());	
		p_plantype=plantype;

		if(plantype != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgyt");
			$.post('finance_budget_related/select_bgplantype_find_bgyeartype',{
				'budgetplantype' : plantype,
			},function(data){
				$("#bgyt").html(data);
			})
		}
	});
	
	$('select[name=budgetyeartype]').live('change',function(){
		var yeartype = ($(this).val());	
		
		if(yeartype != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dept_id");			
			$("select[name=departmentid]").removeAttr("disabled");
			$.post('finance_budget_related/select_department',{				
			},function(data){
				$("#dept_id").html(data);
			})
		}
		
	});
	$('select[name=departmentid]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#div_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#div_id").html(data);
			})
		}
		
	});
	$('select[name=divisionid]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#workgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#workgroup_id").html(data);
			})
		}
		
	});
	$('select[name=workgroupid]').live('change',function(){	
		var workgroupid=($(this).val());
		p_workgroupid=workgroupid;
		if(workgroupid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#plan_id");
			$.post('finance_budget_related/select_workgroup_find_plan',{
				'budgetplantype' : p_plantype,
				'workgroupid':p_workgroupid,
			},function(data){
				$("#plan_id").html(data);
			})
		}
		
	});
	$('select[name=planid]').live('change',function(){	
		var planid=($(this).val());
		if(planid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#productivity_id");
			$.post('finance_budget_related/select_plan_find_product',{
				'planid' : planid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
			},function(data){
				$("#productivity_id").html(data);
			})
		}		
	});
	$('select[name=productivityid]').live('change',function(){	
		var productivityid=($(this).val());
		if(productivityid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#mainact");
			$.post('finance_budget_related/select_product_find_mainact',{
				'productivityid' : productivityid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
				
			},function(data){
				$("#mainact").html(data);
			})
		}		
	});
	$('select[name=mainactid]').live('change',function(){	
		var mainactid=($(this).val());		
		if(mainactid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#subact");
			$.post('finance_budget_related/select_mainact_find_subact',{
				'mainactid' : mainactid,
				'workgroupid':p_workgroupid,
				'budgetplantype':p_plantype
			},function(data){
				$("#subact").html(data);
			})
		}		
	});	
	$('select[name=subactivityid]').live('change',function(){	
		var subactivityid=($(this).val());
		if(subactivityid != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#project_id");
			$.post('finance_budget_related/select_subact_find_project',{
				'subactivityid' : subactivityid,
				'workgroupid':p_workgroupid,
			
			},function(data){
				$("#project_id").html(data);
			})
		}		
	});
		$('select[name=projectid]').live('change',function(){			
		var projectid=($(this).val());		
		if(projectid > 0){				
			$("select[name=budget_type]").removeAttr("disabled");
		}					
	});
	
	$('select[name=budget_type]').live('change',function(){
		
		var budget_type=($(this).val());
		var projectid = $("select[name=projectid]").val();
		if(projectid != 0){	
			$("#dvExpenseType").prepend("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />");
			$.post('finance_withdraw_replace/show_expense_detail/'+budget_type+'/'+projectid,{
				'projectid' : projectid			
			},function(data){
				$("#dvExpenseType").html(data);
				$('input:text').setMask();
			})
		}										
	});
	/*
	$('select').live('change',function(){
			//var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			var nextselect = $(this).parents("tr").nextAll("tr").find('select:not(select[name=budgetyear] option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});
	*/
	
	$("form").validate({
		rules: {
			withdrawid:"required",
			transferid:"required",
			budgetyear:"required",
			budgetplantype:"required",
			budgetyeartype:"required",
			departmentid:"required",
			divisionid:"required",
			workgroupid:"required",
			planid:"required",
			productivityid:"required",
			mainactid:"required",
			subactivityid:"required",
			projectid:"required",
			budget_type:"required"
		},
		messages:{
			withdrawid:"กรุณาระบุข้อมูลด้วย",
			transferid:"กรุณาระบุข้อมูลด้วย",
			budgetyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantype:"กรุณาระบุข้อมูลด้วย",
			budgetyeartype:"กรุณาระบุข้อมูลด้วย",
			departmentid:"กรุณาระบุข้อมูลด้วย",
			divisionid:"กรุณาระบุข้อมูลด้วย",
			workgroupid:"กรุณาระบุข้อมูลด้วย",
			planid:"กรุณาระบุข้อมูลด้วย",
			productivityid:"กรุณาระบุข้อมูลด้วย",
			mainactid:"กรุณาระบุข้อมูลด้วย",
			subactivityid:"กรุณาระบุข้อมูลด้วย",
			projectid:"กรุณาระบุข้อมูลด้วย",
			budget_type:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});	

function fn_summary()
{
	summary = 0;
	$("input.odd").each(function(){
		summary += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
	})
	$(".totalbc").val(new NumberFormat(summary).toFormatted());
	$("#withdraw_replace_cost").val(new NumberFormat(summary).toFormatted());
	
}
function CalculateSummary(pBudgetID,pExpenseID)
{
	var chkpass = true;
	
	var curr_input = parseFloat(($(".cost_"+pBudgetID+"_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ยอดปัจจุบันที่กรอก
	var tmp_curr_input = parseFloat(($(".tmp_cost_"+pBudgetID+"_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ยอดปัจจุบันที่กรอก
	
	var budget_limit = parseFloat(($(".budget_type_limit_"+pBudgetID).val().replace(/[^0-9\.]+/g,"")));//ขีดจำกัดค่าของหมวดงบที่สามารถใช้ได้ (ค่าใช้ทั้งหมดในหมวดงบรวมกันต้องไม่เกินที่กำหนด)
	
	var expense_type_limit = parseFloat(($(".expense_type_limit_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ขีดจำกัดของหมวดค่าใช้จ่ายที่ทำการกรอก 
	
	var sum_expense =0;
	$(".budget_"+pBudgetID).each(function(){
		sum_expense += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
	})
	
	if(sum_expense > budget_limit)chkpass=false;
	
	//if(curr_input > expense_type_limit) chkpass = false;
	
	if(chkpass==true)
	{
		$(".tmp_cost_"+pBudgetID+"_"+pExpenseID).val(new NumberFormat(curr_input).toFormatted());				
	}
	else
	{
		$(".cost_"+pBudgetID+"_"+pExpenseID).val(new NumberFormat(tmp_curr_input).toFormatted());	
		sum_expense = 0;
		$(".budget_"+pBudgetID).each(function(){
		sum_expense += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
		})			
	}
	$(".sum_budget_"+pBudgetID).val(new NumberFormat(sum_expense).toFormatted());
	fn_summary();	
}
</script>

</script>
<h3>เงินเบิกแทนกัน (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(3);?>	
</div>

<form method="post" action="finance_withdraw_replace/save/<?php echo $rs['id'];?>">
<h5>ผู้เบิกแทน</h5>
<table id="tbdata" class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ  </th>
  <td>
    <input name="bookid" type="text" id="textfield3" size="40" value="<?php echo $rs['bookid'];?>" style="margin-right:20px;"/>
ลงวันที่ <input name="book_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['book_date']>0)?@stamp_to_th($rs['book_date']):""  ?>"/></td>
</tr>
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <td><input name="costid" type="text" id="textfield14" size="40" value="<?php echo $rs['costid'];?>" style="margin-right:20px;"/>
ลงวันที่
  <input name="cost_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['cost_date']>0)?@stamp_to_th($rs['cost_date']):""  ?>"/></td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="financeid" type="text" id="textfield4" size="40" value="<?php echo $rs['financeid'];?>" style="margin-right:20px;"/>
ลงวันที่ <input name="finance_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['finance_date']>0)?@stamp_to_th($rs['finance_date']):""  ?>"/>
</tr>
<tr>
  <th>เลขที่เอกสารการเบิกแทน <span class="Txt_red_12"> *</span></th>
  <td><input name="withdrawid" type="text" id="textfield18" value="<?php echo $rs['withdrawid'];?>" size="40"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือแจ้งโอน <span class="Txt_red_12"> *</span></th>
  <td><input name="transferid" type="text" id="textfield16" size="40" value="<?php echo $rs['transferid'];?>"/>
<span style="margin-left:20px; float: none; width:0px;">ลงวันที่
  <input name="transfer_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['transfer_date']>0)?@stamp_to_th($rs['transfer_date']):""  ?>"/></span></td>
</tr>
<tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="topic" cols="60" rows="4" id="textfield5"><?php echo $rs['topic'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>รายละเอียด</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="detail" cols="60" rows="4" id="textfield6"><?php echo $rs['detail'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><?php echo @form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$rs['budgetyear']),@$rs['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ <span class="Txt_red_12"> *</span></th>
  <td id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where pid=".@$rs['budgetplantype']),@$rs['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ<span class="Txt_red_12"> *</span></th>
  <td id="dept_id"><?php echo @form_dropdown('departmentid',get_option("id","title","cnf_department"," financeuse='on' "),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$rs['departmentid']),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
</tr>
<tr>
  <th>กลุ่มงาน<span class="Txt_red_12"> *</span></th>
  <td id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['divisionid']),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)<span class="Txt_red_12"> *</span></th>
  <td id="plan_id">
  	<?php
  	$option = " fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$rs['workgroupid'].")
					)and budgetplantype=".$rs['budgetplantype']." and pid=".$rs['budgetyeartype'];  
  	echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$rs['budgetyeartype']),$rs['planid'],'','-- เลือกแผนงาน --') 
  	?></td>
</tr>
<tr>
  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
  <td id="productivity_id">
  	<?php
  		$option = " fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$rs['workgroupid'].")
					)and budgetplantype=".$rs['budgetplantype']." and pid=".$rs['planid']; 
  	echo @form_dropdown('productivityid',get_option('id','title',$option),$rs['productivityid'],'','-- เลือกผลผลิต --')
  	?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก<span class="Txt_red_12"> *</span></th>
  <td id="mainact">				    
  <?php 
					$option = " fn_strategy where id in(select mainactid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$rs['workgroupid'].")
					)and budgetplantype=".@$rs['budgetplantype']." AND pid = " .@$rs['productivityid']."";
  echo @form_dropdown('mainactid',get_option('id','title',$option),@$rs['mainactid'],'','-- เลือกกิจกรรมหลัก --')?>	
  </td>
</tr>
<tr>
  <th>กิจกรรมย่อย<span class="Txt_red_12"> *</span></th>
  <td id="subact">
   <?php
   $option = "fn_strategy where id in(select id from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$rs["workgroupid"].")
					)and budgetplantype=".@$rs['budgetplantype']." and pid=".@$rs['mainactid']; 
   echo @form_dropdown('subactivityid',get_option('id','title',$option),$rs['subactivityid'],'','-- เลือกกิจกรรมย่อย --')?>		
 </td>
</tr>
<tr>
  <th>โครงการ<span class="Txt_red_12"> *</span></th>
  <td id="project_id">
  	<?php echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$rs['subactivityid']." AND WORKGROUP_ID=".@$rs['workgroupid']),$rs['projectid'],'','-- เลือกโครงการ --')?>		
  </td>
</tr>
<tr>
	  <th>ประเภทเงินงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td id="budget_type">
	  	<select name="budget_type" id="budget_type">
	  		<option value="">เลือกประเภทเงินงบประมาณ</option>
	  		<option value="1"  <? if($rs['budget_type']=='1')echo "selected";?>>งบจัดสรร</option>
	  		<option value="2"  <? if($rs['budget_type']=='2')echo "selected";?>>งบจัดสรรจากหน่วยงานอื่น</option>  		
	  		<option value="3"  <? if($rs['budget_type']=='3')echo "selected";?>>เงินกันเหลื่อมปี</option>  		
	  		<option value="4"  <? if($rs['budget_type']=='4')echo "selected";?>>งบประมาณระหว่างปี</option>
	  	</select>		
  </td>	
</tr>	
<tr>
  <th>ยอดผูกพันงบประมาณ</th>
  <td><input name="withdraw_replace_cost" type="text" disabled="disabled" id="withdraw_replace_cost" value="0.00" size="30" style="text-align:right"/>
    บาท (ยอดรวมของขอผูกพันงบประมาณจำนวน Auto)</td>
</tr>
<tr>
  <th>ลงวันที่ผูกพันงบประมาณ </th>
  <td><input name="relate_date" type="text"  size="10" class="datepicker" value="<?php echo ($rs['relate_date']>0)?@stamp_to_th($rs['relate_date']):""  ?>"/></td>
</tr>
</table>

<div style="padding:20px 0;"></div>
<div id="dvExpenseType">
	<?php if(@$rs['id']>0){echo $budgetdata;}?>	
</div>
<h5>หน่วยงานผู้เบิกเงิน (ภายนอกรับเงิน)</h5>
<table class="tbadd">
  <tr>
    <th>กรม</th>
    <td>
    <div id="dvrdepartment_id">
	<?php echo form_dropdown('rdepartment_id',get_option('id','title','cnf_department'),@$rs['rdepartment_id'],'','-- เลือกกรม --')?>
	</div>    
	</td>
  </tr>
  <tr>
    <th>หน่วยงานที่รับผิดชอบ</th>
    <td>
    <div id="dvrdivision_id">
	<?php echo form_dropdown('rdivision_id',get_option('id','title','cnf_division'),@$rs['rdivision_id'],'','-- เลือกหน่วยงาน --')?>
	</div>    
	</td>
  </tr>
  <tr>
    <th>กลุ่มงาน</th>
    <td>
    <div id="dvrworkgroup_id">
	<?php echo form_dropdown('rworkgroup_id',get_option('id','title','cnf_workgroup'),@$rs['rworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
	</div>    
    </td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>
<?php echo @$script;?>