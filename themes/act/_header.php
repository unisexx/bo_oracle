<div id="headerActpromote">
<div id="home"><a href="act/index"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานบริหารกองทุน"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:300px;">
            <li><a href="welfare.php">องค์การสวัสดิการสังคม</a></li>
            <li><a href="social_worker.php">นักสังคมสงเคราะห์</a></li>
            <li><a href="volunteer.php">อาสาสมัคร</a></li>
            <li><a href="welfare_service.php">ผู้รับบริการสวัสดิการสังคม</a></li>
            <li><a href="director.php">คณะกรรมการ</a></li>
            <li><a href="committee.php">คณะอนุกรรมการ</a></li>
            <li><a href="competent.php">รายชื่อพนักงานเจ้าหน้าที่</a></li>
            <li><a href="workinggroup.php">รายชื่อคณะทำงาน</a></li>
            <li><a href="meet_report.php">รายงานการประชุม</a></li>
            <li><a href="requirement.php">ข้อกำหนด/ระเบียบ/ประกาศ</a></li>
            <li><a href="fund_welfare.php">กองทุนส่งเสริมการจัดสวัสดิการสังคม</a></li>
            <li><a href="fund_form03.php">แบบฟอร์มผลการปฏิบัติงานกองทุนส่งเสริม (แบบกสส.๐๓)</a></li>
          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:260px;">
            <li><a href="affiliate_set.php">หน่วยงานที่สังกัด (รายชื่อพนักงาน)</a></li>
            <li><a href="position_committee_set.php">ตำแหน่งในคณะอนุกรรมการ</a></li>
            <li><a href="position_director_set.php">ตำแหน่งในคณะกรรมการ</a></li>
            <li><a href="committee_expert_set.php">กรรมการผู้ทรงคุณวุฒิด้าน</a></li>
            <li><a href="practice_type_set.php">ลักษณะงานที่ปฏิบัติ (นักสังคมสงเคราะห์)</a></li>
            <li><a href="committee_type_set.php">ประเภทอนุกรรมการ</a></li>
            <li><a href="volunteer_type_set.php">ประเภทอาสาสมัคร</a></li>
            <li><a href="strategic_set.php">ยุทธศาสตร์</a></li>
            <li><a href="consistent_plan_set.php">ความสอดคล้องกับนโยบายแผน</a></li>
            <li><a href="plan_set.php">แผน</a></li>
            <li><a href="subplan_set.php">แผนย่อย</a></li>
            <li><a href="operation_type_set.php">ลักษณะการดำเนินงาน (องค์กรสวัสดิการชุมชน)</a></li>
            <li><a href="branch_service_set.php">สาขาการให้บริการ (องค์กรสวัสดิการชุมชน)</a></li>
			<li><a href="project_set.php">ลักษณะโครงการ</a></li>
            <li><a href="social_welfare_set.php">ส่วนงานสวัสดิการสังคม</a></li>
          </ul>
        </li>
        <li><a href="#">รายงาน +</a>
            <ul style="width:310px;">
            	<li><a href="#">รายงานองค์การสวัสดิการสังคม</a></li>
                <li><a href="#">รายงานนักสังคมสงเคราะห์</a></li>
                <li><a href="#">รายงานอาสาสมัคร</a></li>
                <li><a href="#">รายงานผู้รับบริการการสวัสดิการสังคม</a></li>
                <li><a href="#">รายงานคณะกรรมการ</a></li>
                <li><a href="#">รายงานคณะอนุกรรมการ</a></li>
                <li><a href="#">รายงานรายชื่อพนักงานเจ้าหน้าที่</a></li>
                <li><a href="#">รายงานรายชื่อคณะทำงาน</a></li>
                <li><a href="#">รายงานการประชุม</a></li>
                <li><a href="#">รายงานข้อกำหนด/ ระเบียบ/ประกาศ</a></li>
                <li><a href="#">รายงานกองทุนส่งเสริมการจัดสวัสดิการสังคม</a></li>
                <li><a href="logfile.php">Log File</a></li>
            </ul>
        </li>
		
</ul>
</div>
<div id="login">
วันที่ <? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?><br />
<span>เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>