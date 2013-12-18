<script type="text/javascript">
$(document).ready(function(){
	var id ='<?php echo @$budget_code['id']; ?>';
	if(id == ""){
		$("select[name=budgetplantypeid],select[name=planid],select[name=productivityid]").attr("disabled","disabled");
	}else{
		$("input.btn_addmore").hide();
	}
 
	$('select[name=budgetyear]').live('change',function(){
		var fnyear = ($(this).val());
		
		if(fnyear == 0){
			$("select[name=budgetplantypeid],select[name=planid],select[name=productivityid]").val($("option:first").val())
			$("select[name=budgetplantypeid],select[name=planid],select[name=productivityid]").attr("disabled","disabled");
		}else{
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgpt");
			$.post('finance_budget_id/select_fnyear_2_find_bgplantype',{
				'fnyear' : fnyear,
			},function(data){
				$("#bgpt").html(data);
			})
		}
	});
	
	$('select[name=budgetplantypeid]').live('change',function(){
		var budgetplantype = ($(this).val());
		
		if(budgetplantype == 0){
			$("select[name=planid],select[name=productivityid]").val($("option:first").val())
			$("select[name=planid],select[name=productivityid]").attr("disabled","disabled");
		}else{
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#p");
			$.post('finance_budget_id/select_budgetplantype_2_find_plan',{
				'budgetplantypeid' : budgetplantype,
			},function(data){
				$("#p").html(data);
			})
		}
	});
	
	$('select[name=planid]').live('change',function(){
		var plan = ($(this).val());
		
		if(plan == 0){
			$("select[name=productivityid]").val($("option:first").val())
			$("select[name=productivityid]").attr("disabled","disabled");
		}else{
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#pdtvt");
			$.post('finance_budget_id/select_plan_2_find_product',{
				'planid' : plan,
			},function(data){
				$("#pdtvt").html(data);
			})
		}
	});
	
	$(".btn_addmore").click(function(){
		var space = $(this).parent().parent().parent();
		var clone = $(this).closest('tr').clone().appendTo(space).hide().fadeIn();
			clone.find('input.btn_addmore').hide();
			clone.find('input,textarea').val("");
	})
	
	$("select[name=budgetyear]:option").each(function(){
		$(this).text('aaa');
	})
	
	$("form").validate({
		rules: {
			budgetyear:"required",
			budgetplantypeid:"required",
			planid:"required",
			productivityid:"required"
		},
		messages:{
			budgetyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantypeid:"กรุณาระบุข้อมูลด้วย",
			planid:"กรุณาระบุข้อมูลด้วย",
			productivityid:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
});
</script>

<h3>รหัสงบประมาณ (เพิ่ม / แก้ไข)</h3>

<form action="finance_budget_id/save<?=$url_parameter;?>" method="post">
	<table class="tbadd">
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
		<?php echo form_dropdown('budgetyear',get_option('fnyear','(fnyear+543) as fn','fn_strategy'),@$budget_code['budgetyear'],'','-- เลือกปีงบประมาณ --')?>
	  </td>
	</tr>
	<tr>
	  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td id="bgpt">
		<?php echo @form_dropdown('budgetplantypeid',get_option('id','title',"fn_strategy  where fnyear = ".$budget_code['budgetyear']." and budgetplantype = 0"),$budget_code['budgetplantype_id'],'','-- เลือกช่วงแผนงบประมาณ --');?>
	  </td>
	</tr>
	<tr>
	  <th>แผนงาน (แผนงบประมาณ)<span class="Txt_red_12"> *</span></th>
	  <td id="p">
	  	<?php echo @form_dropdown('planid',get_option('id','title',"fn_strategy where planid < 1 and budgetplantype = ".$budget_code['budgetplantype_id']),$budget_code['plan_id'],'','-- เลือกแผนงาน --') ?>
	  </td>
	</tr>
	<tr>
	  <th>ผลผลิต<span class="Txt_red_12"> *</span></th>
	  <td id="pdtvt">
		<?php echo @form_dropdown('productivityid',get_option('id','title',"fn_strategy where productivityid < 1 and planid = " .$budget_code['plan_id'].""),$budget_code['productivity_id'],'','-- เลือกผลผลิต --')?>
	  </td>
	</tr>
	<tr class="clonethis">
	  <th>รหัสงบประมาณ / คำอธิบาย <br />
	    <br /><input type="button" title="เพิ่มรายการ" value=" " class="btn_addmore" /></th>
	  <td>
	<div>
	<div style="display:inline; float:left; padding-right:10px;"><input name="code[]" type="text" id="textfield" value="<?php echo @$budget_code['code']?>"  maxlength="16" style="width:150px;" /></div>
	<div style="display:inline; float:left; padding-right:5px;">คำอธิบาย</div>
	<div style="display:inline;"><textarea name="description[]" cols="60" rows="3" id="textfield2" style="width:400px;" ><?php echo @$budget_code['description']?></textarea></div>
	</div>
	    </td>
	</tr>
	</table>
	<div id="btnBoxAdd">
	  <input type="hidden" name="id" value="<?php echo @$budget_code['id']?>" />
	  <?php if(permission('finance_budget_id', 'canedit')):?>
	  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
	  <?php endif;?>
	  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
	</div>
</form>