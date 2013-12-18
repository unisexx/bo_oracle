<script type="text/javascript">
	$('input:text').setMask();
	/*
	$(".budgetinput").each(function(){
		var budget = $(this).val();
		var budgetType_id = $(this).prev("input[name=budgettypeid[]]").val();
		var budgetSummary = 0;
		
		$("input.budget_type_"+budgetType_id).each(function(){
			budgetSummary += parseFloat($(this).val().replace(/[^0-9\.]+/g,""));
		});
		
		$(this).val(new NumberFormat(budgetSummary).toFormatted());
	});*/
</script>

<table class="tblist2" id="countTb">
<tr>
<th>หมวดงบประมาณ</th>
<th>หมวดประเภทค่าใช้จ่าย</th>
<th>จำนวนเงิน (บาท)</th>
</tr>
<?
$budget_type_result = $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);
foreach($budget_type_result as $budget_type):
	$sql = "SELECT SUM(sbudget) sbudget from mt_project_subdetail
where sbudgettypeid = ".$budget_type['id']." and masterid=".$id; 
		$sbudget = $this->db->getone($sql);
?>
<tr >
<td class="odd"><?=$budget_type['title'];?></td>
<td>&nbsp;</td>
<td>
	<input name="budgettypeid[]" type="hidden" value="<?=@$budget_type['id'];?>">
	<input name="budget[]" type="text"  id="budget" class="budgetinput" value="<?=@number_format($sbudget,2);?>" alt="decimal" style="text-align:right;border:0px;background:#FFF;"/>	
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