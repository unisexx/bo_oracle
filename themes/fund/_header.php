<div id="headerFund">
<div id="home"><a href="fund/index"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานบริหารกองทุน"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:220px;">
            <?php /*if(permission('fund_contract', 'canview')): ?><li><a href="fund_contract">สํญญารับเงินอุดหนุน</a></li><?php endif; */ ?>
            <li><a href="#">การขอรับเงินสนับสนุนโครงการ</a></li>
            <li><a href="#">สัญญารับเงินอุดหนุน</a></li>
            <li><a href="#">การติดตามและตรวจเยี่ยมโครงการ</a></li>
            <li><a href="#">ผลการปฏิบัติงานและการใช้จ่ายเงินสนับสนุน</a></li>
            <li><a href="#">ผลการปฏิบัติงานเปรียบเทียบกับวัตถุประสงค์</a></li>
            <li><a href="#">การโอนเงินกองทุน</a></li>
            <li><a href="#">แผนการเบิกจ่ายเงินสนับสนุนโครงการ</a></li>
            <li><a href="#">ข้อมูลบุคคลขอรับเงินกองทุน</a></li>
            <li><a href="#">การขอรับเงินสนับสนุนสำหรับบุคคล</a></li>

          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:260px;">
           	<li><a href="fund/setting/fund_loan">ประเภทเงินทุนให้กู้</a></li>
            <li><a href="fund/setting/fund_name">กองทุน</a></li>
            <li><a href="fund/setting/fund_transfer_province">งบประมาณแต่ละจังหวัด</a></li>
            <li><a href="fund/setting/fund_project_typep_main">ประเภทโครงการ</a></li>
            <li><a href="fund/setting/fund_project_typep_sub">ประเภทโครงการย่อย</a></li>
            <li><a href="fund/setting/fund_project_typechild">ประเภทเด็ก</a></li>
            <li><a href="fund/setting/fund_project_child_support">ประเภทสงเคราะห์เด็ก</a></li>
            <li><a href="fund/setting/fund_project_consistency">ความสอดคล้องกับหลักเกณฑ์ตามมาตรฐานต่างๆ</a></li>
            <li><a href="fund/setting/fund_project_structure">ลักษณะโครงการ</a></li>
            <li><a href="fund/setting/fund_project_structuresub">ส่วนงานสวัสดิการสังคม</a></li>
            <li><a href="#">ผู้รับมอบอำนาจ</a></li>
            <li><a href="#">องค์กร</a></li>
            <li><a href="#">ทะเบียนบุคคลขอรับเงินกองทุน</a></li>
            <li><a href="#">ทะเบียนข้อมูลเด็ก</a></li>
          </ul>
        </li>
        <li><a href="#">รายงาน +</a>
            <ul style="width:110px;">
            	<?php if(permission('fund_log', 'canview')): ?><li><a href="fund_log" target="_blank">Log File</a></li><?php endif;?>
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