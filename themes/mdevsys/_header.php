<div id="headerMdevsys">
<div id="home"><a href="mds"><img src="themes/mdevsys/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักงานพัฒนาระบบบริหาร"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#" onclick="return false;">บันทึก +</a>
          <ul style="width:220px;">
          	<?php if(is_permit(login_data('id'),'1') != '' || is_permit(login_data('id'),'3') != ''){ ?>
            <li><a href="mds_indicator">ตัวชี้วัด</a></li>
            <?php } ?>
            <?php if(is_permit(login_data('id'),'1') != '' || is_permit(login_data('id'),'2') != ''){ ?>
            <li><a href="mds_indicator_certify">ตรวจรับรองผลการทำตัวชี้วัด</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php if(is_permit(login_data('id'),'1') != ''){ ?>
        <li><a href="#" onclick="return false;">ตั้งค่า +</a>
          <ul style="width:260px;">
            <li><a href="mds_set_indicator">มิติและตัวชี้วัด</a></li>
            <li><a href="mds_set_measure_target">หน่วยวัดและเป้าหมาย</a></li>
            <li><a href="mds_set_assessment">หัวข้อประเด็นการประเมินผล</a></li>
            <li><a href="mds_set_score">คะแนนผลประเมิน</a></li>
            <li><a href="mds_set_position">ตำแหน่งสายบริหาร</a></li>
            <li><a href="mds_set_measure">หน่วยวัด</a></li>          
            <li><a href="mds_set_permission">สิทธิ์การใช้ระบบ SAR CARD</a></li> 
          </ul>
        </li>
        <?php } ?>
        <li><a href="#" onclick="return false;">รายงาน +</a>
            <ul style="width:310px;">
            	<li><a href="mds_sar_card">Sar Card หน่วยงาน</a></li>
                <li><a href="mds_report_sum_metrics">สรุปรายละเอียดตัวชี้วัด</a></li>
                <li><a href="mds_report_sum_perform">ตารางสรุปผลการปฏิบัติราชการ</a></li>
                <li><a href="mds_report_compare">การเปรียบเทียบปีการประเมินผลจากตัวชี้วัด</a></li>
                <?php if(is_permit(login_data('id'),'1') != ''){ ?>
                <li><a href="mds_log">Log File</a></li>
                <?php } ?>
            </ul>
        </li>
</ul>
</div>
<div id="login">
วันที่ <?php echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span style="background:#FFF;">เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></a>
</span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>