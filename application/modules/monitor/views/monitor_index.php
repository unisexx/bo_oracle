<div id="page">
<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<?php if(permission('monitor_operation_withdraw', 'canview')): ?><div class="ico"><a href="monitor_operation_withdraw"><img src="themes/monitor/images/icon/result_operation_withdraw.png" width="48" height="48" /><h4>ผลการดำเนินงาน และเบิกจ่าย</h4></a></div><?php endif;?>
<?php if(permission('monitor_questionair', 'canview')): ?><div class="ico"><a href="monitor_questionair"><img src="themes/monitor/images/icon/survey.png" width="48" height="48" /><h4>แบบสำรวจ<br>ความพึงพอใจ<br>ของผู้รับบริการ</h4></a></div><?php endif;?>	
<div class="clear"></div>
</div>


<h3 class="clear">สอบถาม</h3>
<div class="lineico">
<div class="ico"><a href="monitor_input"><img src="themes/monitor/images/icon/history_edit_province.png" width="48" height="48" /><h4>การกรอก ข้อมูลของหน่วยงาน และ จังหวัด</h4></a></div>
<div class="clear"></div>
</div>


<?php 
if((permission('monitor_input_report', 'canview')) 
&& (permission('monitor_questionair_report', 'canview'))){
?>	
<h3 class="clear">รายงาน</h3>
<div class="lineico">
<?php if(permission('monitor_input_report', 'canview')): ?>	
	<div class="ico"><a href="monitor_operation_input_report"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>รายงานการบันทึก<br>ผลการดำเนินงานและ<br>การเบิกจ่าย</h4></a></div>
	<div class="ico"><a href="monitor_operation_withdraw_act_report"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>รายงานผล<br>การปฎิบัตงาน และเบิกจ่าย (ภาพรวม)</h4></a></div>
	<div class="ico"><a href="monitor_operation_withdraw_report"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>รายงานผล<br>การปฎิบัตงาน และเบิกจ่าย (รายกิจกรรม)</h4></a></div>	
<?php endif;?>
<?php if(permission('monitor_questionair_report', 'canview')): ?><div class="ico"><a href="monitor_questionair_report"><img src="themes/monitor/images/icon/survey.png" width="48" height="48" /><h4>รายงาน แบบสำรวจ<br>ความพึงพอใจ<br>ของผู้รับบริการ</h4></a></div><?php endif;?>
	<?php if(permission('monitor_questionair_report', 'canview')): ?><div class="ico"><a href="monitor_questionair_total_report"><img src="themes/monitor/images/icon/survey.png" width="48" height="48" /><h4>รายงาน แบบสำรวจ<br>ความพึงพอใจ<br>ของผู้รับบริการ <br>[รายจังหวัด]</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
<? } ?>
<?php if(permission('monitor_budget_plan', 'canview')){ ?>
<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<div class="ico"><a href="monitor_budget_plan"><img src="themes/monitor/images/icon/mt_strategy.gif" width="48" height="48" /><h4>ความเชื่อมโยงแผนงบประมาณ</h4></a></div>
<div class="clear"></div>
</div>
<?php } ?>

<h3 class="clear">สตป.06</h3>
<div class="lineico">
	<?php if(login_data('mt_access_all') == 'on'):?>
	<div class="ico"><a href="monitor_stp06"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>สร้างแบบฟอร์ม<br>(ส่วนกลาง)</h4></a></div>
	<div class="ico"><a href="monitor_stp06/result_index"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>ข้อมูลของหน่วยงาน<br>ที่ตอบแบบสอบถามแล้ว<br>(ส่วนกลาง)</h4></a></div>
	<?php else:?>
	<div class="ico"><a href="monitor_stp06/user_index"><img src="themes/monitor/images/icon/input_data_province.png" width="48" height="48" /><h4>กรอกข้อมูล<Br>(พมจ.)</h4></a></div>
<div class="clear"></div>
	<?php endif;?>
</div>