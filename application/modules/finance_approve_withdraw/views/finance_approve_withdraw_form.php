<script type="text/javascript">
$(document).ready(function(){
	$("input").setMask();	
	cal_summary();
})
function check_summary(pExpenseID,pBudgetTypeID){
	var input_value = parseFloat(($("#withdraw_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));
	var tmp_value = parseFloat(($("#tmp_withdraw_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));
	var input_limit = parseFloat(($("#expense_withdraw_limit_"+pExpenseID).val().replace(/[^0-9\.]+/g,"")));	
	
	if(input_value <= input_limit){
		$("#tmp_withdraw_"+pExpenseID).val(new NumberFormat(input_value).toFormatted());
	}
	else
	{
		$("#withdraw_"+pExpenseID).val(new NumberFormat(tmp_value).toFormatted());
	}
	cal_summary();
	cal_budgettype(pBudgetTypeID);
}
function cal_summary(){
	summary = 0;
	$("input.cost").each(function(){
		summary += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
	})
	$(".amt").html(new NumberFormat(summary).toFormatted());
	
}
function cal_budgettype(pBudgetTypeID){
	summary = 0;
	$("input.budget_type_"+pBudgetTypeID).each(function(){
		summary += parseFloat(($(this).val().replace(/[^0-9\.]+/g,"")));
	})
	$("#withdraw_"+pBudgetTypeID).val(new NumberFormat(summary).toFormatted());
	
}
</script>
<form method="post" enctype="multipart/form-data" action="finance_approve_withdraw/save/<?=$pid;?>/<?=$id;?>">
<h3>อนุมัติเบิกเงิน (เพิ่ม / แก้ไข) </h3>
<table class="tbadd">
  <tr>
  <th>เลขที่หนังสืออนุมัติหลักการ </th>
  <td>
    <?=$parent['book_id'];?>  </td>
</tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติหลักการอ้างอิงหลักการ</th>
    <td>-</td>
  </tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
    <td><span><?=$parent['book_cost_id'];?></span><?php echo stamp_to_th_fulldate($parent['related_cost_date'])?></td>
  </tr>
  <tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td><span><?=$parent['finance_cost_id'];?></span><?php echo stamp_to_th_fulldate($parent['finance_cost_date'])?></td>
</tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติเบิกเงิน<span class="Txt_red_12"> *</span></th>
    <td><input name="withdrawid" type="text" id="withdrawid" size="40" value="<?=@$current['withdrawid'];?>"/></td>
  </tr>
  <tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="subject" cols="60" rows="4" id="subject"><?=@$current['subject'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="remark" cols="60" rows="4" id="remark"><?=@$current['remark'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ</th>
  <td><? echo $budgetyear = @$parent['budgetyear'] > 0 ? @$parent['budgetyear']+543 : "";?></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><?=@$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td><?=@$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><?=@$productivity['title'];?> </td>
</tr>
<tr>
  <th>รหัสงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="tdbudgetcode">
  	<?php echo @form_dropdown('budgetid',get_option('id','code',"fn_budget_code  where budgetyear=".$parent['budgetyear']." AND productivity_id=".$productivity['id']),@$current['budgetid'],'','-- เลือกรหัสงบประมาณ --');?>
  </td>
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
  <th>รายการ</th>
  <td>-</td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td><?=@$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td><?=@$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><?=@$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>ลงวันที่เบิกเงิน<span class="Txt_red_12"> *</span> </th>
  <td><input name="withdrawdate" type="text" id="withdrawdate" value="<? if(@$current['withdrawdate']>0)echo stamp_to_th(@$current['withdrawdate']);?>" size="10" class="datepicker" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<table class="tblist2">
<tr>
  <th style="text-align:left">หมวดงบรายจ่าย</th>  
  <th style="text-align:left">หมวดงบประมาณ</th>
  <th style="text-align:right">ผูกพันค่าใช้จ่าย</th>
  <th style="text-align:center">เบิกจ่าย</th>
  </tr>
<?=$budgetList;?>
<tr class="total">
	<td align="right" colspan="3">รวม</td>
	<td align="right" class="amt"></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="window.location='finance_approve_withdraw/index';" class="btn_back"/>
</div>
</form>