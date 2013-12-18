<?
if(
permission('c_usergroup', 'canview') ||
permission('c_user', 'canview') ||
permission('c_document', 'canview') ||
permission('c_department', 'canview') ||
permission('c_division', 'canview') ||
permission('c_workgroup', 'canview') ||
permission('c_qty', 'canview') ||
permission('c_province_zone_type', 'canview')||
permission('c_province_zone', 'canview')|| 
permission('c_province_area', 'canview')|| 
permission('c_province', 'canview')   
)
{
?>
<h3>ตั้งค่า</h3>
<div id="BOico">
<div class="lineico">
<?php if(permission('c_usergroup', 'canview')): ?><div class="ico"><a href="c_usergroup"><img src="themes/bo/images/icon/usergroup.png" width="48" height="48" /><h4>สิทธิ์การใช้งาน</h4></a></div><?php endif;?>
<?php if(permission('c_user', 'canview')): ?><div class="ico"><a href="c_user"><img src="themes/bo/images/icon/user.png" width="48" height="48" /><h4>ผู้ใช้งาน</h4></a></div><?php endif;?>
<?php if(permission('c_document', 'canview')): ?><div class="ico"><a href="c_document"><img src="themes/bo/images/icon/document.png" width="48" height="48" /><h4>อัพโหลดเอกสาร</h4></a></div><?php endif;?>
<?php if(permission('c_department', 'canview')): ?><div class="ico"><a href="c_department"><img src="themes/bo/images/icon/department.png" width="48" height="48" /><h4>กรม</h4></a></div><?php endif;?>
<?php if(permission('c_division', 'canview')): ?><div class="ico"><a href="c_division"><img src="themes/bo/images/icon/division.png" width="48" height="48" /><h4>หน่วยงาน(กอง/สำนัก)</h4></a></div><?php endif;?>
<?php if(permission('c_workgroup', 'canview')): ?><div class="ico"><a href="c_workgroup"><img src="themes/bo/images/icon/group.png" width="48" height="48" /><h4>กลุ่มงาน(กลุ่ม/ฝ่าย)</h4></a></div><?php endif;?>
<?php if(permission('c_qty', 'canview')): ?><div class="ico"><a href="c_qty"><img src="themes/bo/images/icon/count.png" width="48" height="48" /><h4>หน่วยนับ</h4></a></div><?php endif;?>
<?php if(permission('c_province_zone_type', 'canview')): ?><div class="ico"><a href="c_province_zone_type"><img src="themes/bo/images/icon/provincezonetype.png" width="48" height="48" /><h4>ประเภทภาค</h4></a></div><?php endif;?>
<?php if(permission('c_province_zone', 'canview')): ?><div class="ico"><a href="c_province_zone"><img src="themes/bo/images/icon/provincezone.png" width="48" height="48" /><h4>ภาค</h4></a></div><?php endif;?>	
<?php if(permission('c_province_area', 'canview')): ?><div class="ico"><a href="c_province_area"><img src="themes/bo/images/icon/provincegroup.png" width="48" height="48" /><h4>เขตจังหวัด</h4></a></div><?php endif;?>
<?php if(permission('c_province', 'canview')): ?><div class="ico"><a href="c_province"><img src="themes/bo/images/icon/province.png" width="48" height="48" /><h4>จังหวัด</h4></a></div>
<div class="clear"></div><?php endif;?>
</div>
</div><!--BOico-->
<? } ?>

<? 
if(
permission('budget', 'canview') ||
permission('finance', 'canview') ||
permission('monitor', 'canview') ||
permission('inspect', 'canview') ||
permission('fund_contract', 'canview')
){
?>
<div id="BOico">
<h3 class="clear">ระบบงาน</h3>
<div class="lineico">
<?php if(permission('budget', 'canview')): ?><div class="ico"><a href="http://budget.m-society.go.th" target="_blank"><img src="themes/bo/images/icon/budget.png" width="48" height="48" /><h4>จัดทำคำของบประมาณ</h4></a></div><?php endif;?>
<?php if(permission('finance', 'canview')): ?><div class="ico"><a href="finance" target="_blank"><img src="themes/bo/images/icon/finance.png" width="48" height="48" /><h4>งานการคลัง</h4></a></div><?php endif;?>
<?php if(permission('monitor', 'canview')): ?><div class="ico"><a href="monitor" target="_blank"><img src="themes/bo/images/icon/monitor.png" width="48" height="48" /><h4>ติดตามและประเมินผล</h4></a></div><?php endif;?>
<?php if(permission('inspect', 'canview')): ?><div class="ico"><a href="inspect" target="_blank"><img src="themes/bo/images/icon/inspect.png" width="48" height="48" /><h4>ตรวจราชการ</h4></a></div><?php endif;?>
<?php if(permission('fund_contract', 'canview')): ?><div class="ico"><a href="fund" target="_blank"><img src="themes/bo/images/icon/group.png" width="48" height="48" /><h4>บริหารกองทุน</h4></a></div><?php endif;?>
<div class="clear"></div>
</div>
</div><!--BOico-->
<? } ?>