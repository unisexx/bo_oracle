<style type="text/css">
.a_report_link{
	margin-left: 20px;
}
</style>
<div id="headerBudget">
<div id="home"><a href="budget"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานจัดทำคำของบประมาณ"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:200px;">
            <?php if(permission('budget_request', 'canview')): ?><li><a href="budget_request">รายการคำของบประมาณ</a></li><?php endif;?>            
          </ul>
        </li>
        <? if(login_data('budgetadmin')=='on'): ?>
        <li><a href="#">ผู้ดูแลระบบ +</a>
          <ul style="width:200px;">
            <li><a href="budget_request_commit">ตรวจสอบรายการคำขอ</a>            
          </ul>
        </li>  
        <? endif;?>      
        <?php if(permission('report', 'canview')): ?>
        <li><a href="#">รายงาน +</a>
            <ul style="width:250px;">      			
        			 <li style="width:450px;"><a href="#" style="color:#000;">&gt; ชุดตารางแสดงภาพรวมงบประมาณ</a></li>
                     <li style="width:450px;"><a href="budget_report_1" class="a_report_link">ตารางแสดงความเชื่อมโยง</a></li>
                     <li style="width:450px;"><a href="report_2.php" class="a_report_link">สรุปงบประมาณรายจ่ายประจำปี จำแนกตามผลผลิตโครงการ</a></li>              
                     <li style="width:450px;"><a href="report_9.php" class="a_report_link">แผนงบประมาณรายจ่ายประจำปีงบประมาณ</a></li>
                     <li style="width:450px;"><a href="report_10.php" class="a_report_link">การประมาณการรายจ่ายล่วงหน้าระยะปานกลาง</a></li>
        			 <li style="width:450px;"><a href="#" style="color:#000;">&gt; ชุดแสดงรายละเอียดจำแนกประเภทรายการ</a></li>                     
                     <li style="width:450px;"><a href="report_6.php" class="a_report_link">ตารางแสดงคำของบประมาณระดับโครงการ/งบรายจ่าย</a></li>
        			 <li style="width:450px;"><a href="#" style="color:#000;">&gt; ชุดตารางแสดงรายละเอียดจำแนกตามจังหวัด</a></li>                
                     <li style="width:450px;"><a href="report_5.php" class="a_report_link">แผนการจัดสรรงบประมาณไปจังหวัด</a></li>
					 <li style="width:450px;"><a href="#" style="color:#000;">&gt; ชุดตารางแสดงรายละเอียดจำแนกรายไตรมาส</a></li>                
					 <li style="width:450px;"><a href="report_3.php" class="a_report_link">แผนการใช้จ่ายงบประมาณจำแนกตามรายจ่ายประจำปีงบประมาณ</a></li>
                     <li style="width:450px;"><a href="report_8.php" class="a_report_link">แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณรายจ่ายประจำปีงบประมาณ</a></li>                     
                	 <?php if(permission('logfile', 'canview')): ?><li style="width:450px;"><a href="budget_log" target="_blank">Log File</a></li><?php endif;?>
            </ul>
        </li>
        <?php endif;?>
		
		<?
		if(
		permission('streategy','canview') ||
		permission('budgettype','canview') ||
		permission('asset','canview') ||
		permission('time','canview') 
		)
		{ 
		?>
        <li><a href="#">ตั้งค่า +</a>
            <ul style="width:180px;">                
                		<?php if(permission('streategy','canview')):?><li><a href="budget_plan">แผนงบประมาณ</a></li><? endif;?>
						<?php if(permission('budgettype','canview')):?><li><a href="budget_type">หมวดงบประมาณ</a></li><? endif;?>
						<?php if(permission('asset','canview')):?><li><a href="budget_asset">ครุภัณฑ์</a></li><? endif;?>
						<?php if(permission('time','canview')):?><li><a href="budget_time">ตั้งเวลา</a></li><? endif;?>
            </ul>
        </li>
        <? } ?>
</ul>
</div>
<div id="login">
<? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span>เข้าสู่ระบบโดย <a href="profile" class="link_login"><?php echo login_data('name'); ?></a> (<?php echo login_data('usertype_title'); ?>)</span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>