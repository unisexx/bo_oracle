<script type="text/javascript">
$(document).ready(function(){
	//$('select:not(select[name=fnyear])').attr("disabled","disabled");
	
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
			title:"required"
		},
		messages:{
			fnyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantype:"กรุณาระบุข้อมูลด้วย",
			budgetyeartype:"กรุณาระบุข้อมูลด้วย",
			title:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});
</script>

<div class="paddT20"></div>
<h5>แผนงาน</h5>

<form action="finance_budget_plan/save" method="post">
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
	 <th>ประเภทงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td id="bgyt"><?php echo @form_dropdown('budgetyeartype',get_option('id','title',"fn_strategy  where pid = ".@$parent['pid']." and budgetyeartype = 0 and fnyear = ".$parent['fnyear']),@$parent['id'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
	</tr>
<tr>
  <th>ชื่อแผนงาน <span class="Txt_red_12"> *</span></th>
  <td><input name="title" type="text" value="<?php echo $self['title']?>" size="40" /></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?php echo $self['id']?>" />
  <input name="pid" type="hidden" value="<?php echo $parent['id']?>" />
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>