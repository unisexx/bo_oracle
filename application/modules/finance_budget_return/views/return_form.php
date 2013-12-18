<script type="text/javascript">
$(document).ready(function(){
	fn_summary();
})
function fn_summary()
{
	var summary = 0;
	$("input.odd").each(function(){
		summary += parseFloat($(this).val().replace(/[^0-9\.]+/g,""));
	})
	$("#sptotal").text(new NumberFormat(summary).toFormatted());	
}
</script>
<form  method="post" action="finance_budget_return/save">
<h3>คืนเงินงบประมาณ  </h3>
<table class="tbadd">
  <tr>
  <th>เลขที่หนังสืออนุมัติหลักการ </th>
  <td><?=@$budget_related['book_id'];?></td>
</tr>
  <tr>
    <th>เลขที่ส่วนการคลังรับ </th>
    <td><span><?=@$budget_related['finance_id'];?></span><? if(@$budget_related['finance_id']>0)echo stamp_to_th_fulldate(@$budget_related['related_date']);?></td>
</tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติเบิกเงิน</th>
    <td><span><?=@$approve_withdraw['withdrawid'];?></span><? if(@$approve_withdraw['withdrawdate']>0)echo stamp_to_th_fulldate(@$approve_withdraw['withdrawdate']);?></td>
  </tr>
  <tr>
  <th>เรื่อง</th>
  <td><input type="text" name="title" value="<?=@$budget_return['title'];?>" size="80"></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="remark" cols="60" rows="4" id="remark"><?=@$budget_return['remark'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ</th>
  <td><?=@($budget_related['budgetyear']+543);?></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><?=@$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td><?=@$plan['title'];?> </td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><?=@$productivity['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td><?=@$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td><?=@$subact['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td><?=@$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><?=@$division['title'];?> </td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>ประเภทเงินงบประมาณ</th>
  <td>
  	<? 
  		switch($budget_type):
			case 1:
				echo "งบจัดสรร";
				break;
			case 2:
				echo "งบจัดสรรจากหน่วยงานอื่น";
				break;
			case 3:
				echo "เงินกันเหลื่อมปี";
				break;
			case 4:
				echo "งบประมาณระหว่างปี";
				break;
			default:
				echo "";
				break; 
	    endswitch;
  	?>
  </td>
</tr>
<tr>
  <th>ลงวันที่คืนงบประมาณ </th>
  <td><input name="returndate" type="text" id="returndate" size="10" value="<?=@stamp_to_th($budget_return['returndate']);?>" class="datepicker" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<?=$dataList;?>
<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?=@$budget_return['id'];?>">
  <input type="hidden" name="budget_related_id" value="<?=@$budget_related['id'];?>">
  <input type="hidden" name="cost_related_id" value="<?=@$cost_related['id'];?>">
  <?php if(permission('finance_budget_return', 'canedit')):?>
  <input name="input" type="submit" title="บันทึกคืนเงินงบประมาณ" value=" " class="btn_save_return_budget"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>