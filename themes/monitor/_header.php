<div id="headerMonitor">
<div id="home"><a href="monitor"><img src="images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานติดตามและประเมินผล"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:280px;">
            <?php if(permission('monitor_operation_withdraw', 'canview')): ?><li><a href="monitor_operation_withdraw">ผลการดำเนินงานและเบิกจ่าย</a></li><?php endif;?>
            <?php if(permission('monitor_questionair', 'canview')): ?><li><a href="monitor_questionair">แบบสำรวจความพึงพอใจของผู้รับบริการ</a></li><?php endif;?>
          </ul>
        </li>
		<li><a href="#">สอบถาม +</a>
          <ul style="width:280px;">
            <li><a href="monitor_input">การกรอกข้อมูลของหน่วยงาน และ จังหวัด </a></li>            
          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:240px;">
            <?php if(permission('monitor_budget_plan', 'canview')): ?><li><a href="monitor_budget_plan">แผนงบประมาณ กิจกรรมโครงการ และงบประมาณ</a></li><?php endif;?>            
          </ul>
        </li>
        <li><a href="#">รายงาน +</a>
            <ul style="width:350px;">
            	<?php if(permission('monitor_input_report', 'canview')): ?>	
				<li><a href="monitor_operation_input_report">รายงานการบันทึกผลการดำเนินงานและการเบิกจ่าย</a></li>
				<li><a href="monitor_operation_withdraw_act_report">รายงานผลการปฎิบัตงาน และเบิกจ่าย (ภาพรวม)</a></li>
				<li><a href="monitor_operation_withdraw_report">รายงานผลการปฎิบัตงาน และเบิกจ่าย (รายกิจกรรม)</a></li>
				<li><a href="monitor_suggestion_report">สรุปรายงานสรุปผลการดำเนินงานปัญหาอุปสรรคและข้อเสนอแนะ</a></li>					
				<?php endif;?>
				<?php if(permission('monitor_questionair_report', 'canview')): ?>
				<li><a href="monitor_questionair_report">รายงาน แบบสำรวจความพึงพอใจของผู้รับบริการ</a></li>
				<li><a href="monitor_questionair_total_report">รายงาน แบบสำรวจความพึงพอใจของผู้รับบริการ [รายจังหวัด]</a></li>
				<?php endif;?>
				<?php if(permission('monitor_log', 'canview')): ?>
				<li><a href="monitor_log">ประวัติการใช้งาน</a></li>
				<?php endif;?>
            </ul>
        </li>
		
</ul>
</div>
<div id="login">
วันที่ <? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span>เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></a></span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>