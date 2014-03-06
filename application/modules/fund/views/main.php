<?php if(login_data('fn_access_all') == 'on'):?>
<h3>บันทึกข้อมูล</h3>
<div id="BOico">
	<div class="lineico">
		<?php if(permission('fund_contract', 'canview')):?>
		<div class="ico"><a href="fund_contract"><img src="images/icon/r.png" width="48" height="48" /><h4>สํญญารับเงินอุดหนุน</h4></a></div>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	
	<h3 class="clear">รายงาน</h3>
	<div class="lineico">
		<?php if(permission('fund_log', 'canview')):?>
		<div class="ico"><a href="fund_log"><img src="images/icon/logfile.png" width="48" height="48" /><h4>Log File</h4></a></div>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	
	<h3 class="clear">ตั้งค่า</h3>
	<div class="lineico">
		<?php if(permission('fund_attorney', 'canview')):?>
		<div class="ico"><a href="fund_attorney"><img src="images/icon/attorney.png" width="48" height="48" /><h4>ผู้รับมอบอำนาจ</h4></a></div>
		<?php endif;?>
		<?php if(permission('fund_organize', 'canview')):?>
		<div class="ico"><a href="fund_organize"><img src="images/icon/organization.png" width="48" height="48" /><h4>องค์กร</h4></a></div>
		<?php endif;?>
		<div class="clear"></div>
	</div>
</div><!--BOico-->
<?php endif;?>