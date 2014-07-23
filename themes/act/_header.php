<div id="headerActpromote">
<div id="home"><a href="act/index"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานบริหารกองทุน"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        
        <li><a href="#">บันทึก +</a>
          <ul style="width:220px;">
            <li><a href="act/welfare_benefit">องค์กรสาธาณประโยชน์</a></li>
            <li><a href="act/welfare_community">องค์กรสวัสดิการชุมชน</a></li>
            <li><a href="act/social_worker">นักสังคมสงเคราะห์</a></li>
            <li><a href="act/welfare_state">หน่วยงานของรัฐ</a></li>
            <li><a href="act/volunteer">อาสาสมัคร</a></li>
            <li><a href="act/director">คณะกรรมการ</a></li>
            <li><a href="act/committee">คณะอนุกรรมการ</a></li>
            <li><a href="act/workinggroup">คณะทำงาน</a></li>
            <li><a href="act/competent">พนักงานเจ้าหน้าที่</a></li>
          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:380px;">
          	<li><a href="act/set_operation_type">ลักษณะการดำเนินงาน (องค์กรสวัสดิการชุมชน)</a></li>
            <li><a href="act/set_branch_service">สาขาการให้บริการ (องค์กรสวัสดิการชุมชน)</a></li>
            <li><a href="act/set_practice_type">ลักษณะงานที่ปฏิบัติ (นักสังคมสงเคราะห์)</a></li>
            <li><a href="act/set_volunteer_type">ประเภทอาสาสมัคร</a></li>
            <li><a href="act/set_affiliate">หน่วยงานที่สังกัด (รายชื่อพนักงาน, พนักงานเจ้าหน้าที่)</a></li>
            <li><a href="act/set_position_director">ตำแหน่งในคณะกรรมการ</a></li>
            <li><a href="act/set_committee_type">ประเภทคณะกรรมการ</a></li>
            <li><a href="act/set_position_committee">ตำแหน่งในคณะอนุกรรมการ</a></li>
            <li><a href="act/set_subcommittee_type">ประเภทอนุกรรมการ</a></li>
            <li><a href="act/set_committee_expert">กรรมการผู้ทรงคุณวุฒิด้าน</a></li>
            <li><a href="act/set_social_welfare">ส่วนงานสวัสดิการสังคม</a></li>
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