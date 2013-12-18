<script type="text/javascript">
$(document).ready(function(){
	var p_plantype,p_workgroupid,p_budgetplantype;
	p_plantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	p_workgroupid = <?php echo @$rs['workgroupid']<1 ? 0 : @$rs['workgroupid'];?>;
	p_budgetplantype = <?php echo @$rs['budgetplantype']<1 ? 0 : @$rs['budgetplantype'];?>;
	
	var budget_related_id = '<?php echo @$fn_budget_related_id; ?>';
	var book_id ='<?php echo @$rs['book_id']; ?>';
	(budget_related_id != 0)? $('input[name=id]').val("") : "" ;
	if(budget_related_id != 0 || book_id != 0){
		$("select:not(select[name=budgetmenu])").attr("disabled","disabled");
	}
	
	var cost_related_id ='<?php echo @$rs['id']; ?>';
	if(cost_related_id == ""){
		$("select:not(select[name=budgetyear],select[name=budgetmenu])").attr("disabled","disabled");
	}
	
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
			alert(projectid);
			$("select[name=budget_type]").removeAttr("disabled");
		}					
	});
	
	$('select[name=budget_type]').live('change',function(){
		
		var budget_type=($(this).val());
		var projectid = $("select[name=projectid]").val();
		if(projectid != 0){	
			$("#dvExpenseType").prepend("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />");
			$.post('finance_cost_related/show_expense_detail_headonly_ajax/'+budget_type+'/'+projectid,{
				'projectid' : projectid			
			},function(data){
				$("#dvExpenseType").html(data);
				$('input:text').setMask();
			})
		}										
	});
		
	$("form").validate({
		rules: {
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
	
	
	/*$('select:not(select[name=projectid])').live('change',function(){
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});
	
	
	/********************* คำนวนตาราง  *********************/
	
	// ------- ไม่มี book_id -------
	
	$('input:text').setMask();
	$("form").submit(function(){
		if(budget_related_id != 0){
			$("select").removeAttr("disabled","disabled");
		}
		
		$('.tmp').each(function(){
			$(this).val($(this).prev().val().replace(/,/g,""));
		});
		var stript = $('input[name=related_cost]').val().replace(/,/g,"");
		$('input[name=related_cost]').val(stript);
	});
	fn_summary();
});
function fn_summary()
{
	summary = 0;
	$("input.odd").each(function(){
		summary += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
	})
	$(".totalbc").val(new NumberFormat(summary).toFormatted());
	$("#related_cost").val(summary);
	
}
function CalculateSummary(pBudgetID,pExpenseID)
{
	var chkpass = true;
	
	var curr_input = parseFloat(($(".cost_"+pBudgetID+"_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ยอดปัจจุบันที่กรอก
	var tmp_curr_input = parseFloat(($(".tmp_cost_"+pBudgetID+"_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ยอดปัจจุบันที่กรอก
	
	var budget_limit = parseFloat(($(".budget_type_limit_"+pBudgetID).val().replace(/[^0-9\.]+/g,"")));//ขีดจำกัดค่าของหมวดงบที่สามารถใช้ได้ (ค่าใช้ทั้งหมดในหมวดงบรวมกันต้องไม่เกินที่กำหนด)		
	
	//var expense_type_limit = parseFloat(($(".expense_type_limit_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));//ขีดจำกัดของหมวดค่าใช้จ่ายที่ทำการกรอก 
	
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

<h3>ผูกพันค่าใช้จ่าย (เพิ่ม / แก้ไข)</h3>

<div class="link_budget_related">ไปยัง 
<?php echo finance_budget_menu(2)?>
</div>

<form action="finance_cost_related/save" method="post">
<table class="tbadd">
	<?php if(@$rs['book_id']>0):?>
	<tr>
		<th>เลขที่หนังสืออนุมัติหลักการ</th>
		<td><?php echo get_budget_book_id($rs['book_id']);?><input type="hidden" value="<?php echo @$rs['book_id']?>" name="book_id"></td>
	</tr>
	<?php endif;?>
	<tr>
		<th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
		<td>	
			<input name="book_cost_id" type="text" size="40" value="<?php echo @$rs['book_cost_id']?>" style="margin-right:20px;"/>
			  ลงวันที่ <input class="datepicker" name="book_cost_date" type="text" size="10" value="<?php echo (@$rs['book_cost_date']!=0)?@stamp_to_th(@$rs['book_cost_date']):""; ?>"/>
		</td>
	</tr>
	<tr>
		<th>เลขที่ส่วนการคลังรับ </th>
		<td>
		<input name="finance_cost_id" type="text" size="40" style="margin-right:20px;" value="<?php echo @$rs['finance_cost_id']?>"/>
		ลงวันที่ <input class="datepicker" name="finance_cost_date" type="text" size="10" value="<?php echo (@$rs['finance_cost_date']!=0)?@stamp_to_th(@$rs['finance_cost_date']):""; ?>" />
	</td>
	</tr>
	<tr>
		<th>เรื่อง</th>
		<td>
			<span style="display:inline; float:left; padding-right:10px;">
			<textarea name="title_cost" cols="60" rows="4"><?php echo @$rs['title_cost']?></textarea>
			</span>
		</td>
	</tr>
	<tr>
	  <th>รายละเอียด</th>
	  <td>
	  	<span style="display:inline; float:left; padding-right:10px;">
		<textarea name="detail_cost" cols="60" rows="4"><?php echo @$rs['detail_cost']?></textarea>
	  	</span>
	  </td>
	</tr>
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
	  	<?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')?>
	  </td>
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
	  <td id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
	</tr>
	<tr>
	  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
	  <td id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$rs['departmentid']),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
	</tr>
	<tr>
	  <th>กลุ่มงาน<span class="Txt_red_12"> *</span></th>
	  <td id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['divisionid']),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
	</tr>
	<tr>
	  <th>แผนงาน (แผนงบประมาณ)<span class="Txt_red_12"> *</span></th>
	  <td id="plan_id"><?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$rs['budgetyeartype']),$rs['planid'],'','-- เลือกแผนงาน --') ?></td>
	</tr>
	<tr>
	  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
	  <td id="productivity_id">
	  	<?php $option = " fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$rs['workgroupid'].")
					)and budgetplantype=".$rs['budgetplantype']." and pid=".$rs['planid']; 
  	echo @form_dropdown('productivityid',get_option('id','title',$option),$rs['productivityid'],'','-- เลือกผลผลิต --')?>
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
	  	<?php 
	  	//echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_budget_master.id=52"),@$rs['projectid'],'','-- เลือกโครงการ --')
		echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$rs['subactivityid']." AND WORKGROUP_ID=".@$rs['workgroupid']),$rs['projectid'],'','-- เลือกโครงการ --')
	  	?>		
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
	  <td>
	  	<input class="totalbc" type="text" value="<?php echo @$rs['related_cost']?>" size="40" alt="decimal" disabled/>
	  	<input class="totalbc" type="hidden" name="related_cost" value="<?php echo @$rs['related_cost']?>">
	บาท</td>
	</tr>
	<tr>
	  <th>ลงวันที่ผูกพันงบประมาณ </th>
	  <td>
	  	<input class="datepicker" name="related_cost_date" type="text" value="<?php echo (@$rs['related_cost_date']!=0)?@stamp_to_th($rs['related_cost_date']):"";?>" size="10" />
	  </td>
	</tr>
	</table>
	<div style="padding:20px 0;"></div>
	
	<div id="dvExpenseType">
		<?php if(@$rs['id']>0){echo @$budgetdata;}?>	
	</div>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo @$rs['id']?>"/>
  <input type="hidden" name="fn_budget_related_id" value="<?php echo @$rs['fn_budget_related_id']?><?php echo @$fn_budget_related_id?>"/>
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>