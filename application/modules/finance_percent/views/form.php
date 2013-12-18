<script type="text/javascript">
	$(document).ready(function(){
		$("input").setMask();
		$('select[name=budget_type_id]').live('change',function(){
			var budget_type_id = ($(this).val());			
			if(budget_type_id != 0){
				
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#td_expense");
				$.post('ajax/load_expense_type',{
					'budget_type_id' : budget_type_id,
					'control_name' : 'expense_type_id'
				},function(data){
					$("#td_expense").html(data);												
				})
			}
			else
			{
				$('select[name=expense_type_id]').attr("disabled","disabled");
			}
		
		});	
	})
</script>
<form method="post" action="finance_percent/save<?=$url_parameter;?>">
<h3>หักเงินตามนโยบายพิเศษ % (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td>
  <select name="budget_year" id="budget_year">
    <option>-- เลือกปีงบประมาณ --</option>
    <? echo $option;?>
  </select>
  <input type="hidden" name="id" value="<?=@$rs['id'];?>">
  </td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td>
  	<? echo form_dropdown("division_id",get_option("id","title","cnf_division","departmentid in (SELECT ID FROM CNF_DEPARTMENT WHERE FINANCEUSE='on') ORDER BY title,departmentid"),@$rs['division_id'],"","-- เลือกหน่วยงาน --","");?>
  </td>
</tr>
<tr>
  <th>หมวดงบประมาณ</th>
  <td>
  	<? echo form_dropdown("budget_type_id",get_option("id","title","fn_budget_type","pid < 1 "),@$rs['budget_type_id'],"","-- เลือกหมวดงบประมาณ --","");?>	
  </td>
</tr>
<tr>
  <th>หมวดค่าใช้จ่าย</th>
  <td id="td_expense">
  	<?
  		$disabled = @$rs['expense_type_id'] > 0 ? "" : "disabled";
		$condition = @$rs['budget_type_id'] > 0 ? " and pid=".$rs['budget_type_id'] : "";
  	?>
  	<? echo form_dropdown("expense_type_id",get_option("id","title","fn_budget_type","pid > 0 and expensetypeid < 1 ".$condition),@$rs['expense_type_id'],$disabled,"-- เลือกหมวดค่าใช้จ่าย --","");?>
  </td>
</tr>
<tr>
  <th>จำนวน</th>
  <td><input name="percent_value" type="text" id="percent_value" size="10" class="number" value="<?=@$rs['percent_value'];?>" alt="decimal" />%</td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>