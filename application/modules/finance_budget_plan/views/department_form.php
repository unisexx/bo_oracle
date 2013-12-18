<script type="text/javascript">
$(document).ready(function(){
	//$('select:not(select[name=fnyear])').attr("disabled","disabled");
	$("input").setMask();
	summary();
	$('select[name=fnyear]').live('change',function(){
		var fnyear = ($(this).val());	
		
		if(fnyear != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgpt");
			$.post('finance_budget_related/select_fnyear_2_find_bgplantype',{
				'fnyear' : fnyear
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
				'budgetplantype' : plantype
			},function(data){
				$("#bgyt").html(data);
			})
		}
	});
	
	$('select[name=budgetyeartype]').live('change',function(){
		var yeartype = ($(this).val());	
		
		if(yeartype != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#plan_id");			
			$.post('finance_budget_plan/select_budgetyeartype_find_plan',{
				'budgetyeartype' : yeartype
			},function(data){
				$("#plan_id").html(data);
			})
		}
	});
	
	$('select[name=planid]').live('change',function(){
		var planid = ($(this).val());	
		
		if(planid != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#pdtvt");			
			$.post('finance_budget_plan/select_plan_find_product',{
				'planid' : planid
			},function(data){
				$("#pdtvt").html(data);
			})
		}
	});
	
	$('select[name=productivityid]').live('change',function(){	
		var productivityid=($(this).val());
		
		if(productivityid != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#mainact");
			$.post('finance_budget_plan/select_product_find_mainact',{
				'productivityid' : productivityid
			},function(data){
				$("#mainact").html(data);
			})
		}		
	});
	
	$('select[name=departmentid]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
				
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tddv");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$(".tddv").html(data);
			})
		}
		
	});
	
	$('select').live('change',function(){
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});
	
	$("form").validate({
		rules: {
			fnyear:"required",
			budgetplantype:"required",
			budgetyeartype:"required",
			planid:"required",
			productivityid:"required",
			mainactid:"required",
			subactivityid:"required",
			departmentid:"required",
			divisionid:"required",
			title:"required"
		},
		messages:{
			fnyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantype:"กรุณาระบุข้อมูลด้วย",
			budgetyeartype:"กรุณาระบุข้อมูลด้วย",
			planid:"กรุณาระบุข้อมูลด้วย",
			productivityid:"กรุณาระบุข้อมูลด้วย",
			mainactid:"กรุณาระบุข้อมูลด้วย",
			subactivityid:"กรุณาระบุข้อมูลด้วย",
			departmentid:"กรุณาระบุข้อมูลด้วย",
			divisionid:"กรุณาระบุข้อมูลด้วย",
			title:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});
function summary()
{
	var summary = 0;
		$(".eptotal").each(function() {
			summary += Number($(this).val().replace(/[^0-9\.]+/g,""));
		});
		$("#summary").html(new NumberFormat(summary).toFormatted());
}
function CalculateSummary(pBudgetTypeID){
	summary();
	var total=0;
	$(".eptotal"+pBudgetTypeID).each(function() {
			total += Number($(this).val().replace(/[^0-9\.]+/g,""));
		});
	$(".tdbgtotal"+pBudgetTypeID).html(new NumberFormat(total).toFormatted());
} 
</script>

<div class="paddT20"></div>
<h5>กรม</h5>

<form action="finance_budget_plan/save/<?=$formtype;?>" method="post">
<table class="tbadd">
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
	  	<?php echo form_dropdown('fnyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$parent['fnyear'],'','-- เลือกปีงบประมาณ --')?>
	  </td>
	</tr>
	<tr>
	 <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy where budgetplantype = 0 and fnyear = ".@$parent['fnyear']),@$parent['budgetplantype'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
	</tr>
	<tr>
	  <th>ประเภทงบประมาณ<span class="Txt_red_12"> *</span> </th>
	  <td id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option("id","title","fn_strategy where pid=".@$parent['budgetplantype']." and budgetyeartype = 0 and fnyear = ".@$parent['fnyear']),@$parent['budgetyeartype'],'','-- เลือกประเภทงบประมาณ --')  ?></td>
	</tr>
	<tr>
	  <th>แผนงาน<span class="Txt_red_12"> *</span></th>
	  <td id="plan_id"><?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$parent['budgetyeartype']." and budgetyeartype > 0 and planid = 0 and fnyear = ".@$parent['fnyear']),@$parent['planid'],'','-- เลือกแผนงาน --') ?></td>
	</tr>
	<tr>
	  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
	  <td id="pdtvt"><?php echo @form_dropdown('productivityid',get_option('id','title',"fn_strategy where pid = ".@$parent['planid']." AND productivityid=0 AND fnyear=".$parent['fnyear']),@$parent['productivityid'],'','-- เลือกผลผลิต --') ?></td>
	</tr>
	<tr>
	  <th>กิจกรรมหลัก<span class="Txt_red_12"> *</span></th>
	  <td><?php echo @form_dropdown('mainactid',get_option('id','title',"fn_strategy where pid = ".@$parent['productivityid']." and mainactid = 0 and fnyear = ".@$parent['fnyear']),@$parent['mainactid'],'','-- เลือกกิจกรรมหลัก --')?></td>
	</tr>
	<tr>
	  <th>กิจกรรมย่อย<span class="Txt_red_12"> *</span></th>
	  <td><?php echo @form_dropdown('subactivityid',get_option('id','title',"fn_strategy where pid = ".@$parent['mainactid']." and subactivityid = 0 and fnyear = ".@$parent['fnyear']),$parent['id'],'','-- เลือกกิจกรรมย่อย --')?></td>
	</tr>

<tr>
  <th>กรม<span class="Txt_red_12"> *</span></th>
  <td class="tddp"><?php echo @form_dropdown('departmentid',get_option('id','title',"cnf_department"," financeuse = 'on' "),$self['departmentid'],'','-- เลือกกรม --')?></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td class="tddv"><?php if($self['divisionid']>0) echo @form_dropdown('divisionid',get_option('id','title',"cnf_division "),$self['divisionid'],'','-- เลือกหน่วยงาน --')?></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<h3>เงินงบประมาณจัดสรรทั้งหมดของหน่วยงาย</h3>
<table class="tblist2">
<tr>  
  <th>หมวดประเภทงบ</th>
  <th>หมวดประเภทค่าใช้จ่าย</th>  
  <th>จำนวนเงิน</th>  
  </tr>

<tr class="odd">
<?
	echo $divisionBudgetDatalist;
?>	 
</table>
<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?php echo @$self['id']?>" />
  <input name="pid" type="hidden" value="<?php echo @$parent['id']?>" />
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>