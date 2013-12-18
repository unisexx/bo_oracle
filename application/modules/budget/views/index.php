<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<?php if(permission('budget_request', 'canview')): ?><div class="ico"><a href="budget_request"><img src="themes/finance/images/icon/save_budget_plan.png" width="48" height="48" /><h4>รายการคำของบประมาณ</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>

<!--
<?php if(permission('finance_report', 'canview')): ?>
<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_back_budget_withdraw.png" width="48" height="48" /><h4>คืนงบประมาณค้างเบิก</h4></a></div>
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_withdraw.png" width="48" height="48" /><h4>เบิกจ่าย</h4></a></div>
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_transfer.png" width="48" height="48" /><h4>การโอน</h4></a></div>
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_withdraw_replace.png" width="48" height="48" /><h4>เบิกแทน</h4></a></div>
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_wallet.png" width="48" height="48" /><h4>เงินกัน</h4></a></div>
<div class="ico"><a href="#"><img src="themes/finance/images/icon/report_status_budget.png" width="48" height="48" /><h4>สถานะงบประมาณ</h4></a></div>
<div class="clear"></div>
</div>
<?php endif;?>
-->
<? if(login_data('budgetadmin')=='on'): ?>
<h3 class="clear">ผู้ดูแลระบบ</h3>
<div class="lineico">
	<div class="ico"><a href="budget_request_commit"><h4>ตรวจสอบรายการคำขอ</h4></a></div>	
<div class="clear"></div>
</div>
<? endif;?>
<?php if(permission('report', 'canview')): ?>
<h3 class="clear">รายงาน</h3>
<div class="lineico">
	<div class="ico"><a href="budget_report_1"><h4>ตารางแสดง<br>ความเชื่อมโยง</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>สรุปงบประมาณ<br>รายจ่ายประจำปี <br>จำแนกตาม<br>ผลผลิตโครงการ</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>แผนงบประมาณ<br>รายจ่ายประจำ<br>ปีงบประมาณ</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>การประมาณการ<br>รายจ่ายล่วงหน้า<br>ระยะปานกลาง</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>ตารางแสดง<br>คำของบประมาณ<br>ระดับโครงการ/<br>งบรายจ่าย</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>แผนการจัดสรร<br>งบประมาณไปจังหวัด</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>แผนการใช้จ่าย<br>งบประมาณจำแน<br>ตามรายจ่ายประจำ<br>ปีงบประมาณ</h4></a></div>
	<div class="ico"><a href="budget_request_commit"><h4>แผนการปฏิบัติงาน<br>และแผนการใช้จ่าย<br>งบประมาณรายจ่าย<br>ประจำปีงบประมาณ</h4></a></div>
	<?php if(permission('logfile', 'canview')): ?>
	<div class="ico"><a href="budget_request_commit"><h4>Log File</h4></a></div>
	<?php endif;?>	
<div class="clear"></div>
</div>	        			 
<?php endif;?>
<? if(login_data('budgetadmin')=='on'): ?>
<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
	<div class="ico"><a href="budget_plan"><h4>แผนงบประมาณ</h4></a></div>
	<div class="ico"><a href="budget_type"><h4>หมวดงบประมาณ</h4></a></div>
	<div class="ico"><a href="budget_asset"><h4>ครุภัณฑ์</h4></a></div>
	<div class="ico"><a href="budget_time"><h4>ตั้งเวลา</h4></a></div>	
<div class="clear"></div>
</div>
<? endif;?>