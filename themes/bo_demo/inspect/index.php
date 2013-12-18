<? include "../include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$is_title;?></title>
<? include '_script.php'?>
</head>

<body>
<div id="head"><? include '_header.php'?></div>

<div id="page">
<h3>บันทึกข้อมูล</h3>
<div id="BOico">
<div class="lineico">
<div class="ico"><a href="save.php"><img src="images/icon/document_project.png" width="48" height="48" /><h4>ผลการดำเนินงาน</h4></a></div>
<div class="ico"><a href="inspector_recom.php"><img src="images/icon/inspector_project.png" width="48" height="48" /><h4>ข้อเสนอแนะผู้ตรวจ</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">ผูู้ดูแล</h3>
<div class="lineico">
<div class="ico"><a href="#"><img src="images/icon/save_project_admin_kpn.png" width="48" height="48" /><h4>บันทึกโครงการ (KPN)</h4></a></div>
<div class="ico"><a href="#"><img src="images/icon/inspector_member.png" width="48" height="48" /><h4>ผู้ตรวจราชการ และสมาชิก</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">ตั้งค่า</h3>
<div class="lineico">
<div class="ico"><a href="#"><h4>กลุ่มผู้ตรวจ</h4></a></div>
<div class="ico"><a href="#"><h4>หัวข้อความเสี่ยง</h4></a></div>
<div class="ico"><a href="#"><h4>จัดการโครงการ และวัตถุประสงค์</h4></a></div>
<div class="ico"><a href="#"><h4>กำหนดรอบ</h4></a></div>
<div class="clear"></div>
</div>

<h3 class="clear">รายงาน</h3>
<div class="lineico">
<div class="ico"><a href="#"><h4></h4></a></div>
<div class="clear"></div>
</div>

</div><!--BOico-->
</div><!--page-->
</body>
</html>