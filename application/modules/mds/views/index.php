

<body>

<div id="page">



<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<div class="ico"><a href="mds_indicator"><img src="themes/mdevsys/images/icon/indicator.png" width="48" height="48" /><h4>ตัวชี้วัด</h4></a></div>
<? if(is_permit(login_data('id'),'1') != '' || is_permit(login_data('id'),'2') != ''){ ?>
<div class="ico"><a href="mds_indicator_certify"><img src="themes/mdevsys/images/icon/indicator_certify.png" width="48" height="48" /><h4>ตรวจรับรองผล การทำตัวชี้วัด</h4></a></div>
<? } ?>
<div class="clear"></div>
</div>

<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="themes/mdevsys/images/icon/report_esar.png" width="48" height="48" /><h4>Sar Card หน่วยงาน</h4></a></div>
<div class="ico"><a href="#"><img src="themes/mdevsys/images/icon/report_sum_indicator.png" width="48" height="48" /><h4>สรุปรายละเอียด ตัวชี้วัด</h4></a></div>
<div class="ico"><a href="#"><img src="themes/mdevsys/images/icon/report_sum_perform.png" width="48" height="48" /><h4>ตารางสรุปผล การปฏิบัติราชการ</h4></a></div>
<div class="ico"><a href="#"><img src="themes/mdevsys/images/icon/report_compare.png" width="48" height="48" /><h4>การเปรียบเทียบปี การประเมินผล จากตัวชี้วัด</h4></a></div>
<div class="ico"><a href="#"><img src="themes/mdevsys/images/icon/logfile.png" width="48" height="48" /><h4>Log File</h4></a></div>

<div class="clear"></div>
</div>
<? if(is_permit(login_data('id'),'1') != ''){ ?>
<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<div class="ico"><a href="mds_set_indicator"><img src="themes/mdevsys/images/icon/indicator_set.png" width="48" height="48" /><h4>มิติและตัวชี้วัด</h4></a></div>
<div class="ico"><a href="mds_set_measure_target"><img src="themes/mdevsys/images/icon/assessment_target.png" width="48" height="48" /><h4>หน่วยวัดและเป้าหมาย</h4></a></div>
<div class="ico"><a href="mds_set_assessment"><img src="themes/mdevsys/images/icon/assessment.png" width="48" height="48" /><h4>หัวข้อประเด็น การประเมินผล</h4></a></div>
<div class="ico"><a href="mds_set_score"><img src="themes/mdevsys/images/icon/score.png" width="48" height="48" /><h4>คะแนนผลประเมิน</h4></a></div>
<div class="ico"><a href="mds_set_position"><img src="themes/mdevsys/images/icon/position.png" width="48" height="48" /><h4>ตำแหน่งสายบริหาร</h4></a></div>
<div class="ico"><a href="mds_set_measure"><img src="themes/mdevsys/images/icon/measure.png" width="48" height="48" /><h4>หน่วยวัด</h4></a></div>
<div class="ico"><a href="mds_set_permission"><img src="themes/mdevsys/images/icon/permission.png" width="48" height="48" /><h4>สิทธิการใช้ระบบ SAR CARD</h4></a></div>
<div class="clear"></div>
</div>
<? } ?>
</div><!--BOico-->
</div><!--page-->
</body>
</html>