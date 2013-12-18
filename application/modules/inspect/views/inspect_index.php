<div id="page">
<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<?php if(permission('inspect_save', 'canview')): ?><div class="ico"><a href="inspect_save"><img src="themes/inspect/images/icon/document_project.png" width="48" height="48" /><h4>ผลการดำเนินงาน</h4></a></div><?php endif?>
<?php if(permission('inspect_inspector_recomm', 'canview')): ?><div class="ico"><a href="inspect_inspector_recomm"><img src="themes/inspect/images/icon/inspector_project.png" width="48" height="48" /><h4>ข้อเสนอแนะผู้ตรวจ</h4></a></div><?php endif?>
<?php if(permission('inspect_budget', 'canview')): ?><div class="ico"><a href="inspect_disbursement"><img src="themes/inspect/images/icon/inspect_disbursement.png" width="48" height="48" /><h4>ผลการเบิกจ่ายงบประมาณ</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
<?
if( 
(permission('inspect_project_admin', 'canview')) 
|| (permission('inspect_member', 'canview'))
){
?>
<h3 class="clear">ผูู้ดูแล</h3>
<div class="lineico">
<?php if(permission('inspect_project_admin', 'canview')): ?><div class="ico"><a href="inspect_project_admin"><img src="themes/inspect/images/icon/save_project_admin_kpn.png" width="48" height="48" /><h4>บันทึกโครงการ (KPN)</h4></a></div><?php endif?>
<?php if(permission('inspect_member', 'canview')): ?><div class="ico"><a href="inspect_member"><img src="themes/inspect/images/icon/inspector_member.png" width="48" height="48" /><h4>ผู้ตรวจราชการ และสมาชิก</h4></a></div><?php endif?>
<?php if(permission('inspect_alert', 'canview')): ?><div class="ico"><a href="inspect_notification"><img src="themes/inspect/images/icon/inspector_tracking.png" width="48" height="48" /><h4>แจ้งเตือนผลการดำเนินงาน</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
<? } ?>
<?
if( 
(permission('inspector_group', 'canview')) 
|| (permission('inspect_risk_subject', 'canview'))
|| (permission('inspect_project_management', 'canview'))
|| (permission('inspect_round', 'canview'))
|| (permission('inspect_level', 'canview'))
){
?>
<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<?php if(permission('inspector_group', 'canview')): ?><div class="ico"><a href="inspector_group"><img src="themes/inspect/images/icon/inspector_group2.png" width="48" height="48" /><h4>กลุ่มผู้ตรวจ</h4></a></div><?php endif;?>
<?php if(permission('inspect_risk_subject', 'canview')): ?><div class="ico"><a href="inspect_risk_subject"><img src="themes/inspect/images/icon/inspect_risk_subject.png" width="48" height="48" /><h4>หัวข้อความเสี่ยง</h4></a></div><?php endif;?>
<?php if(permission('inspect_project_management', 'canview')): ?><div class="ico"><a href="inspect_project_management"><img src="themes/inspect/images/icon/inspect_project_management.png" width="48" height="48" /><h4>จัดการโครงการ และวัตถุประสงค์</h4></a></div><?php endif?>
<?php if(permission('inspect_round', 'canview')): ?><div class="ico"><a href="inspect_round"><img src="themes/inspect/images/icon/inspect_round.png" width="48" height="48" /><h4>กำหนดรอบ</h4></a></div><?php endif;?>
<?php if(permission('inspect_level', 'canview')): ?><div class="ico"><a href="inspect_level"><img src="themes/inspect/images/icon/inspect_level.png" width="48" height="48" /><h4>ระดับความเสี่ยง</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
<? } ?>
<?
if( 
(permission('inspect_report_risk', 'canview'))
|| (permission('inspect_report_recomm', 'canview')) 
){
?>
<h3 class="clear">รายงาน</h3>
<div class="lineico">
<?php if(permission('inspect_report_risk', 'canview')): ?><div class="ico"><a href="inspect_report_all"><img src="themes/inspect/images/icon/inspect_report_all_index.png" width="48" height="48" /><h4>รายงานความเสี่ยง</h4></a></div><?php endif;?>
<?php if(permission('inspect_report_recomm', 'canview')): ?><div class="ico"><a href="inspect_report_all/recomm"><img src="themes/inspect/images/icon/inspect_report_all_recomm.png" width="48" height="48" /><h4>รายงานข้อเสนอแนะ<br>ผู้ตรวจ</h4></a></div><?php endif;?>
	<?php if(permission('inspect_log', 'canview')): ?><div class="ico"><a href="inspect_log"><img src="themes/inspect/images/icon/subactivity_project.png" width="48" height="48" /><h4>ประวัติการใช้งาน</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
<? } ?>