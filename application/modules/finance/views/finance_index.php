<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<?php if(permission('finance_budget_plan', 'canview')): ?><div class="ico"><a href="finance_budget_plan"><img src="themes/finance/images/icon/save_budget_plan.png" width="48" height="48" /><h4>แผนงบประมาณ</h4></a></div><?php endif;?>
<?php if(permission('finance_budget_id', 'canview')): ?><div class="ico"><a href="finance_budget_id"><img src="themes/finance/images/icon/budget_id.png" width="48" height="48" /><h4>รหัสงบประมาณ</h4></a></div><?php endif;?>

<?php if(permission('finance_money_during_year', 'canview')): ?><div class="ico"><a href="finance_money_during_year"><h4><img src="themes/finance/images/icon/money_during_year.png">เงินงบประมาณ ระหว่างปี</h4></a></div><?php endif;?>
<?php if(permission('finance_budget_related', 'canview')): ?><div class="ico"><a href="finance_budget_related"><img src="themes/finance/images/icon/save_budget_commit.png" width="48" height="48" /><h4>ผูกพันงบประมาณ</h4></a></div><?php endif;?>
<?php if(permission('finance_approve_withdraw', 'canview')): ?><div class="ico"><a href="finance_approve_withdraw"><img src="themes/finance/images/icon/save_cash_approve.png" width="48" height="48" /><h4>อนุมัติเบิกเงิน</h4></a></div><?php endif;?>
<?php if(permission('finance_budget_return', 'canview')): ?><div class="ico"><a href="finance_budget_return"><img src="themes/finance/images/icon/save_budget_refund.png" width="48" height="48" /><h4>คืนเงินงบประมาณ</h4></a></div><?php endif;?>
<?php if(permission('finance_approve_withdraw_replace', 'canview')): ?><div class="ico"><a href="finance_approve_withdraw_replace"><img src="themes/finance/images/icon/save_withdraw approve replace.png" width="48" height="48" /><h4>อนุมัติเบิกเงินเบิกแทน</h4></a></div><?php endif;?>

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

<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<?php if(permission('finance_budget_percent', 'canview')): ?><div class="ico"><a href="finance_percent"><h4>หักเงินตามนโยบาย % </h4></a></div><? endif;?>
<div class="clear"></div>
</div>
