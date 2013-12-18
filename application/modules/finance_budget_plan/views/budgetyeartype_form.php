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
	
	
	$('select').live('change',function(){
			var nextselect = $(this).parents("tr").nextAll("tr").find('select option:first');
			nextselect.attr('selected','selected');
			nextselect.parent().attr("disabled","disabled");
	});
	
	$("form").validate({
		rules: {
			fnyear:"required",
			budgetplantype:"required",
			title:"required"
		},
		messages:{
			fnyear:"กรุณาระบุข้อมูลด้วย",
			budgetplantype:"กรุณาระบุข้อมูลด้วย",
			title:"กรุณาระบุข้อมูลด้วย"
		}
	});
});
</script>

<h3>แผนงบประมาณ (เพิ่ม / แก้ไข)</h3>
<h5>ประเภทงบประมาณ</h5>

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
	  <td id="bgpt"><?php echo @form_dropdown('budgetplantype',get_option('id','title',"fn_strategy where budgetplantype = 0 and fnyear = ".@$parent['fnyear']),@$parent['id'],'','-- เลือกช่วงแผนงบประมาณ --');?></td>
	</tr>
	<tr>
	  <th><label for="fid-full_name3">ชื่อประเภทงบประมาณ <span class="Txt_red_12"> *</span></label></th>
	  <td>
	  	<input name="title" type="text" id="Title" size="40" value="<?php echo $self['title']?>"/>
	  </td>
	</tr>
</table>
<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?php echo $self['id']?>" />
  <input name="pid" type="hidden" value="<?php echo $parent['id']?>" />
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>