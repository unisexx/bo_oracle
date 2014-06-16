<? include "../include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$fd_title;?></title>
<? include '_script.php'?>
</head>

<body>
<div id="page">
<div id="head"><? include '_header.php'?></div>


<div id="tabs" style="margin-top:10px;">
<ul>
      <li><a href="#tabs-1">งานหลักเกณฑ์และจัดสรรทุน</a></li>
      <li><a href="#tabs-2">งานประเมินผลกองทุน</a></li>
      <li><a href="#tabs-3">งานจัดการกองทุน</a></li>
      <li><a href="#tabs-4">ข้อมูลพื้นฐาน</a></li>
    </ul>
    
    <div id="tabs-1">
    	<h3>บันทึกข้อมูล</h3>
		<div id="BOico">
            <div class="lineico">
            <div class="ico"><a href="obtain_project_fund.php"><img src="images/icon/obtain_project_fund.png" width="48" height="48" /><h4>การขอรับเงิน สนับสนุนโครงการ</h4></a></div>
            <!--<div class="ico"><a href="obtain_result.php"><img src="images/icon/obtain_result.png" width="48" height="48" /><h4>ผลการพิจารณา ขอรับเงินสนับสนุน</h4></a></div>-->
            <div class="clear"></div>
            </div>
            <h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="images/icon/report1_1.png" width="48" height="48" /><h4>องค์การที่ ขอรับเงินสนับสนุน แยกตามกลุ่มเป้าหมาย</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_2.png" width="48" height="48" /><h4>สรุปองค์การที่ ได้รับเงินสนับสนุน ทั่วประเทศ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_3.png" width="48" height="48" /><h4>องค์การและโครงการ ที่ได้รับเงินสนับสนุน ตามภาค</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_4.png" width="48" height="48" /><h4>องค์การที่ได้รับ เงินสนับสนุนแยกตาม กลุ่มเป้าหมายตามภาค</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_5.png" width="48" height="48" /><h4>โครงการที่ขอ รับเงินสนับสนุน แต่ละองค์การ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_6.png" width="48" height="48" /><h4>องค์การที่ ไม่ได้รับการพิจารณา ให้เงินสนับสนุน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_7.png" width="48" height="48" /><h4>องค์การที่ ได้รับเงินสนับสนุน แยกตามจังหวัด</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_8.png" width="48" height="48" /><h4>รายละเอียด คำชี้แจงงบประมาณ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_9.png" width="48" height="48" /><h4>รายละเอียดคำชี้แจง งบประมาณ(แสดง โครงการ/กิจกรรมหลัก)</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_10.png" width="48" height="48" /><h4>รายงานเงินอุดหนุน องค์การสวัสดิการ สังคมภาคเอกชน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_11.png" width="48" height="48" /><h4>รายงานกองทุน ส่งเสริมการจัด สวัสดิการสังคม</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_12.png" width="48" height="48" /><h4>รายงานกองทุน คุ้มครองเด็ก</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_13.png" width="48" height="48" /><h4>รายงานสรุปแผน/ ผลการดำเนินงาน กองทุน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report1_14.png" width="48" height="48" /><h4>ข้อมูลโครงการ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/logfile.png" width="48" height="48" /><h4>Log File</h4></a></div>

<div class="clear"></div>
</div>

       
	</div><!--BOico-->
            
            
    </div><!--tabs-1-->
 
 
 	<div id="tabs-2">
    	<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<div class="ico"><a href="contract_funding.php"><img src="images/icon/contract_funding.png" width="48" height="48" /><h4>สํญญารับเงินอุดหนุน</h4></a></div>
<div class="ico"><a href="track_monitor.php"><img src="images/icon/track_monitor.png" width="48" height="48" /><h4>การติดตามและ ตรวจเยี่ยมโครงการ</h4></a></div>
<div class="ico"><a href="spending.php"><img src="images/icon/spending.png" width="48" height="48" /><h4>ผลการปฏิบัติงานและ การใช้จ่ายเงินสนับสนุน</h4></a></div>
<div class="ico"><a href="objective.php"><img src="images/icon/objective.png" width="48" height="48" /><h4>ผลการปฏิบัติงาน เปรียบเทียบกับ วัตถุประสงค์</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="images/icon/report2_1.png" width="48" height="48" /><h4>ผลการปฏิบัติงาน และการใช้จ่ายเงิน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report2_2.png" width="48" height="48" /><h4>เปรียบเทียบองค์การ ที่ได้รับเงินสนับสนุน แต่ละปี</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/report2_3.png" width="48" height="48" /><h4>ผลการปฏิบัติงาน ขององค์การ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/attorney.png" width="48" height="48" /><h4>การติดตามและ ตรวจเยี่ยมโครงการ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/organization.png" width="48" height="48" /><h4>ผลการปฏิบัติงานและ การใช้จ่ายเงินสนับสนุน</h4></a></div>

<div class="clear"></div>
</div>

        <div class="clear"></div>
    </div><!--BOico-->
    
    </div><!--tabs-2-->
    
    
    <div id="tabs-3">
    	<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<div class="ico"><a href="payment.php"><img src="images/icon/payment.png" width="48" height="48" /><h4>การชำระเงิน</h4></a></div>
<div class="ico"><a href="transfer_fund.php"><img src="images/icon/transfer_fund.png" width="48" height="48" /><h4>การโอนเงินกองทุน</h4></a></div>
<div class="ico"><a href="disbursement_plan.php"><img src="images/icon/disbursement_plan.png" width="48" height="48" /><h4>แผนการเบิกจ่าย เงินสนับสนุนโครงการ</h4></a></div>
<div class="ico"><a href="get_support_personal.php"><img src="images/icon/get_support_personal.png" width="48" height="48" /><h4>การขอรับเงิน สนับสนุนสำหรับบุคคล</h4></a></div>
<div class="ico"><a href="reg_debtor.php"><img src="images/icon/reg_debtor.png" width="48" height="48" /><h4>ทะเบียนลูกหนี้</h4></a></div>
<div class="ico"><a href="reg_get_fund.php"><img src="images/icon/get_fund.png" width="48" height="48" /><h4>ทะเบียนบุคคล ขอรับเงินกองทุน</h4></a></div>
<div class="ico"><a href="reg_child.php"><img src="images/icon/reg_child.png" width="48" height="48" /><h4>ทะเบียนข้อมูลเด็ก</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>การชำระเงินรายเดือน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>สรุปรายชื่อ ลูกหนี้คงค้าง</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ข้อมูลแผนการ เบิกจ่ายเงินงบประมาณ เงินสนับสนุน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ลูกหนี้ค้างชำระ</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ลูกหนี้ค้างชำระ (สำหรับพิมพ์ที่อยู่)</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>รายงานการ ขอรับเงินสนับสนุน สำหรับบุคคล</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ข้อมูลทะเบียนลูกหนี้</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ข้อมูลการชำระเงิน</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/.png" width="48" height="48" /><h4>ข้อมุลบุคคล ขอรับเงินกองทุน</h4></a></div>

<div class="clear"></div>
</div>

  </div><!--BOico-->
    </div><!--tabs-3-->
    
    
    <div id="tabs-4">
    	<h3 class="clear">ตั้งค่า</h3>
        <div id="BOico">
<div class="lineico">
<div class="ico"><a href="lender_type_set.php"><img src="images/icon/lender_type_set.png" width="48" height="48" /><h4>ประเภทเงินทุนให้กู้</h4></a></div>
<div class="ico"><a href="fund_set.php"><img src="images/icon/fund_set.png" width="48" height="48" /><h4>กองทุน</h4></a></div>
<div class="ico"><a href="each_budget_set.php"><img src="images/icon/each_budget_set.png" width="48" height="48" /><h4>งบประมาณ แต่ละจังหวัด</h4></a></div>
<div class="ico"><a href="project_type_set.php"><img src="images/icon/project_type_set.png" width="48" height="48" /><h4>ประเภทโครงการ</h4></a></div>
<div class="ico"><a href="project_subtype_set.php"><img src="images/icon/project_list_set.png" width="48" height="48" /><h4>ประเภทโครงการย่อย</h4></a></div>
<div class="ico"><a href="child_type_set.php"><img src="images/icon/child_type_set.png" width="48" height="48" /><h4>ประเกทเด็ก</h4></a></div>
<div class="ico"><a href="orphanage_type_set.php"><img src="images/icon/orphanage_type_set.png" width="48" height="48" /><h4>ประเภทสงเคราะห์เด็ก</h4></a></div>
<div class="ico"><a href="accordance_set.php"><img src="images/icon/accordance_set.png" width="48" height="48" /><h4>ความสอดคล้อง กับหลักเกณฑ์ตาม มาตรฐานต่างๆ</h4></a></div>
<div class="ico"><a href="project_set.php"><img src="images/icon/project_set.png" width="48" height="48" /><h4>ลักษณะโครงการ</h4></a></div>
<div class="ico"><a href="social_welfare_set.php"><img src="images/icon/social_welfare_set.png" width="48" height="48" /><h4>ส่วนงานสวัสดิการสังคม</h4></a></div>
<div class="ico"><a href="attorney_set.php"><img src="images/icon/attorney_set.png" width="48" height="48" /><h4>ผู้รับมอบอำนาจ</h4></a></div>
<div class="ico"><a href="organization_set.php"><img src="images/icon/organization_set.png" width="48" height="48" /><h4>องค์กร</h4></a></div>
<div class="clear"></div>
</div>
    </div><!--BOico-->
    </div><!--tabs-4-->


</div><!--tabs-->



</div><!--page-->
</body>
</html>