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
<form enctype="multipart/form-data" method="post" action="finance_approve_withdraw_replace/save/<?=$pid;?>/<?=$id;?>">
<h3>อนุมัติเบิกเงินแทนกัน (เพิ่ม / แก้ไข) </h3>
<table class="tbadd">
  <tr>
  <th>เลขที่หนังสืออนุมัติหลักการ </th>
  <td><?=$parent['bookid'];?></td>
</tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
    <td><span><?=$parent['costid'];?></span><? if($parent['cost_date']>0)echo stamp_to_th_fulldate($parent['cost_date']);?></td>
  </tr>
  <tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td><span><?=$parent['financeid'];?></span><? if($parent['finance_date']>0)echo stamp_to_th_fulldate($parent['finance_date']);?></td>
</tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติเบิกแทน</th>
    <td><?=$parent['withdrawid'];?></td>
  </tr>
  <tr>
    <th>เลขที่หนังสือแจ้งโอน</th>
    <td><?=$parent['transferid'];?></td>
  </tr>
  <tr>
    <th>เลขที่หนังสืออนุมัติเบิกเงิน</th>
    <td><input type="text" name="approveid" id="approveid" value="<?=@$current['approveid'];?>"></td>
  </tr>
  <tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="subject" cols="60" rows="4" id="subject"><?=@$current['subject'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td>
  <span style="display:inline; float:left; padding-right:10px;">
  <textarea name="remark" cols="60" rows="4" id="remark"><?=@$current['remark'];?></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ</th>
  <td><?=$parent['budgetyear'];?></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><?=$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td><?=$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><?=$productivity['title'];?></td>
</tr>
<tr>
  <th>รหัสงบประมาณ </th>
  <td>
  	<?php echo @form_dropdown('budgetid',get_option('id','code',"fn_budget_code  where budgetyear=".$budgetyear." AND budgetplantype_id=".$budgetplantype['id']." AND plan_id=".$plan['id']." AND productivity_id=".$productivity['id']),@$current['budgetid'],'','-- เลือกรหัสงบประมาณ --');?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td><?=$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td><?=$subact['title'];?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td><?=$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td><?=$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><?=$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><?=$workgroup['title'];?></td>
</tr>
<tr>
  <th>ยอดเงินกันเบิกแทน</th>
  <td>
  	<input name="total_withdraw" type="text" disabled="disabled" id="total_withdraw" value="" size="30" />
    บาท</td>
</tr>
<tr>
  <th>ลงวันที่อนุมัติเบิกเงิน</th>
  <td>
  <input name="withdrawdate" type="text" id="withdrawdate" class="datepicker" size="10" value="<?=@$current['withdrawdate'];?>" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<table class="tblist2">
<tr>
  <th style="text-align:left">หมวดงบรายจ่าย</th>
  <th style="text-align:left">หมวดงบประมาณ</th>
  <th style="text-align:right">จำนวนเงินเบิกแทน</th>
  <th style="text-align:center">เบิกจ่ายจริง</th>
</tr>
<?=$budgetList;?>
</table>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="Window.location='finance_approve_withdraw_replace/index';" class="btn_back"/>
</div>
</form>