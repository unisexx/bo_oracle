<style type="text/css" media="screen">
	.amt,#summary{text-align:right;}
	#summary{font-weight:bold;}
</style>
<script type="text/javascript" src="themes/bo/js/jquery.rowcount-1.0.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$("input").setMask();	
		$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvpdivision_id").html(data);
				$("#divisionid").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');										
			})
		}		
	});
	$('select[name=pdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			$("select[name=pworkgroup_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvpworkgroup_id").html(data);
				$("#workgroupid").attr("id","pworkgroup_id");				
				$("#pworkgroup_id").attr('name', 'pworkgroup_id');	
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
	
	$("form").validate({
		rules: {
			book_no:"required",
			cost_no:"required",
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
			projectid:"required"
		},
		messages:{
			book_no:"กรุณาระบุข้อมูลด้วย",
			cost_no:"กรุณาระบุข้อมูลด้วย",
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
			projectid:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});

	function CaluculateBudgetTypeSummary(pBudgetTypeID){
		var bsummary = 0;
		$(".budgettype_"+pBudgetTypeID).each(function(){
				bsummary += parseFloat($(this).val().replace(/[^0-9\.]+/g,""));		
		})	
		$("input[name=budget_type_commit_"+pBudgetTypeID+"]").val(new NumberFormat(bsummary).toFormatted());
	}
	function summary(){
		var summary = 0;
		$(".amt").each(function() {
			summary += Number($(this).text().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
	}	

</script>
<form name="fmData" id="fmData" method="post" enctype="multipart/form-data" action="finance_receive_year_overlap/save/<?=@$id;?>">
<h3>รับเงินกันเหลือมปี (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<?php finance_budget_menu(6);?>	
</div>
<h5>ข้อมูลรับเงินกันเหลื่อมปี</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ <span class="Txt_red_12"> *</span></th>
  <td>
    <input name="book_no" type="text" id="book_no" size="40" value="<?=@$result['book_no'];?>"/>
  ลงวันที่ <input name="book_date" type="text" id="book_date" size="10" class="datepicker"  value="<?=stamp_to_th(@$result['book_date']);?>" />
  </td>
</tr>
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="cost_no" type="text" id="cost_no" size="40" value="<?=@$result['cost_no'];?>"/>
ลงวันที่
  <input name="cost_date" type="text" id="cost_date" size="10" class="datepicker" value="<?=stamp_to_th(@$result['cost_date']);?>" />
  </td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="finance_no" type="text" id="finance_no" size="40" value="<?=@$result['finance_no'];?>"/>
    ลงวันที่ <input name="finance_date" type="text" id="finance_date" size="10" class="datepicker" value="<?=stamp_to_th(@$result['finance_date']);?>" />
    </td>
</tr>
<tr>
  <th>เลขที่สำรองเงินกัน</th>
  <td><input name="reserve_no" type="text" id="reserve_no" size="40" value="<?=@$result['reserve_no'];?>"/>
ลงวันที่
  <input name="reserve_date" type="text" id="reserve_date" size="10" class="datepicker" value="<?=stamp_to_th(@$result['reserve_date']);?>" />
  </td>
</tr>
<tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="subject" cols="60" rows="4" id="subject"><?php echo @$result['subject'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>รายละเอียด</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="detail" cols="60" rows="4" id="detail"><?php echo @$result['detail'];?></textarea>
  </span></td>
</tr>
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
	  	<?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$result['budgetyear'],'','-- เลือกปีงบประมาณ --')?>
	  </td>
	</tr>
	<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy  where budgetplantype < 1 and fnyear = ".@$result['budgetyear']),@$result['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
	</tr>
	<tr>
	  <th>ประเภทงบประมาณ <span class="Txt_red_12"> *</span></th>
	  <td id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where pid=".@$result['budgetplantype']),@$result['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
	</tr>
	<tr>
	  <th>กรมที่รับผิดชอบเบิกเงินแทน<span class="Txt_red_12"> *</span></th>
	  <td id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$result['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></td>
	</tr>
	<tr>
	  <th>หน่วยงานเบิกเงินแทน<span class="Txt_red_12"> *</span></th>
	  <td id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$result['departmentid']),@$result['divisionid'],'','-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย) --')  ?>  (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
	</tr>
	<tr>
	  <th>กลุ่มงานเบิกเงินแทน<span class="Txt_red_12"> *</span></th>
	  <td id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$result['divisionid']),@$result['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?> </td>
	</tr>
	<tr>
	  <th>แผนงาน (แผนงบประมาณ)<span class="Txt_red_12"> *</span></th>
	  <td id="plan_id"><?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$result['budgetyeartype']),$result['planid'],'','-- เลือกแผนงาน --') ?></td>
	</tr>
	<tr>
	  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
	  <td id="productivity_id">
	  	<?php $option = " fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$result['workgroupid'].")
					)and budgetplantype=".@$result['budgetplantype']." and pid=".@$result['planid']; 
  	echo @form_dropdown('productivityid',get_option('id','title',$option),@$result['productivityid'],'','-- เลือกผลผลิต --')?>
	  </td>
	</tr>
	<tr>
	  <th>กิจกรรมหลัก<span class="Txt_red_12"> *</span></th>
	  <td id="mainact">
	   <?php 
					$option = " fn_strategy where id in(select mainactid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$result['workgroupid'].")
					)and budgetplantype=".@$result['budgetplantype']." AND pid = " .@$result['productivityid']."";
  echo @form_dropdown('mainactid',get_option('id','title',$option),@$result['mainactid'],'','-- เลือกกิจกรรมหลัก --')?>	
	  </td>
	</tr>
	<tr>
	  <th>กิจกรรมย่อย<span class="Txt_red_12"> *</span></th>
	  <td id="subact">
	  <?php
   $option = "fn_strategy where id in(select id from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".@$result["workgroupid"].")
					)and budgetplantype=".@$result['budgetplantype']." and pid=".@$result['mainactid']; 
   echo @form_dropdown('subactivityid',get_option('id','title',$option),$result['subactivityid'],'','-- เลือกกิจกรรมย่อย --')?>
	 </td>
	</tr>
	<tr>
	  <th>โครงการ<span class="Txt_red_12"> *</span></th>
	  <td id="project_id">
	  	<?php 
	  	//echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_budget_master.id=52"),@$result['projectid'],'','-- เลือกโครงการ --')
		echo @form_dropdown('projectid',get_option('fn_budget_master.id as id','projecttitle',"fn_strategy inner join fn_budget_master on fn_strategy.id=fn_budget_master.subactivityid where fn_strategy.id = " .@$result['subactivityid']." AND WORKGROUP_ID=".@$result['workgroupid']),$result['projectid'],'','-- เลือกโครงการ --')
	  	?>		
	  </td>
	</tr>
	<tr>
		<th>ลงวันที่รับเงิน</th>
		<td><input type="text" name="receive_date" class="datepicker" value="<?=@stamp_to_th($result['receive_date']);?>"></td>
	</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>แหล่งงบประมาณ</h3>
<table class="tblist2">
<tr class="trhead">   
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย </th>
  <th>จำนวนเงิน</th>
  </tr>
	<?=$data_list;?>  
</table>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>