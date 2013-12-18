<? include "../include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$fn_title;?></title>
<? include '_script.php'?>
</head>

<body>
<div id="head"><? include '_header.php'?></div>

<div id="page">
<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<div class="ico"><a href="budget_plan.php"><img src="images/icon/save_budget_plan.png" width="48" height="48" /><h4>แผนงบประมาณ</h4></a></div>
<div class="ico"><a href="budget_id.php"><h4>รหัสงบประมาณ</h4></a></div>
<div class="ico"><a href="money_while.php">
<h4>เงินพลางงบประมาณ</h4></a></div>
<div class="ico"><a href="budget_mapping.php"><h4>Mapping เงินงบประมาณ</h4></a></div>
<div class="ico"><a href="money_during_year.php">
<h4>เงินงบประมาณ ระหว่างปี</h4></a></div>
<div class="ico"><a href="budget_related.php"><img src="images/icon/save_budget_commit.png" width="48" height="48" /><h4>ผูกพันงบประมาณ</h4></a></div>
<div class="ico"><a href="approve_withdraw.php"><img src="images/icon/save_cash_approve.png" width="48" height="48" /><h4>อนุมัติเบิกเงิน</h4></a></div>
<div class="ico"><a href="budget_return.php"><img src="images/icon/save_budget_refund.png" width="48" height="48" /><h4>คืนเงินงบประมาณ</h4></a></div>
<div class="ico"><a href="approve_withdraw_replace.php"><img src="images/icon/save_withdraw approve replace.png" width="48" height="48" /><h4>อนุมัติเบิกเงินเบิกแทน</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="images/icon/report_back_budget_withdraw.png" width="48" height="48" /><h4>คืนงบประมาณค้างเบิก</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report_withdraw.png" width="48" height="48" /><h4>เบิกจ่าย</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report_transfer.png" width="48" height="48" /><h4>การโอน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report_withdraw_replace.png" width="48" height="48" /><h4>เบิกแทน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report_wallet.png" width="48" height="48" /><h4>เงินกัน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report_status_budget.png" width="48" height="48" /><h4>สถานะงบประมาณ</h4></a></div>
<div class="clear"></div>
</div>


<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<div class="ico"><a href="budget_type.php"><h4>ประเภทงบประมาณ</h4></a></div>
<div class="clear"></div>

</div><!--BOico-->
</div><!--page-->
</body>
</html>