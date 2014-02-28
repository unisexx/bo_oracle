<h3>บันทึกการใช้งาน</h3>
<div id="search">
<div id="searchBox">
<form method="get" action="log/index">
    	การกระทำ :
    	<select name="actiontype" id="actiontype">
        	<option value="">ทั้งหมด</option>
            <option value="ADD">เพิ่ม</option>
            <option value="EDIT">แก้ไข</option>
            <option value="DELETE">ลบ</option>
        </select>

    	รายการ
        <select name="datatype" id="datatype">
        	<option value="" >ทั้งหมด</option>
        	<option value="โครงการ">โครงการ</option>
        	<option value="ข้อความแจ้งการแก้ไขโครงการ">ข้อความแจ้งการแก้ไขโครงการ</option>
        	<option value="ปรับงบประมาณ">ปรับงบประมาณ</option>
        	<option value="ข้อความแจ้งการแก้ไขโครงการ">ข้อความแจ้งการแก้ไขโครงการ</option>
        	<option value="ความเชื่อมโยงแผนงบประมาณ">ความเชื่อมโยงแผนงบประมาณ</option>
        	<option value="UserType">ประเภทผู้ใช้</option>
        	<option value="UserAccount">ผู้ใช้งาน</option>
        	<option value="ประเภทงบประมาณ">ตั้งค่า : ประเภทงบประมาณ</option>
        	<option value="ครุภัณฑ์ ">ตั้งค่า : ครุภัณฑ์ </option>
        	<option value="หน่วยงาน">ตั้งค่า : หน่วยงาน</option>
        	<option value="กลุ่มงาน">ตั้งค่า : กลุ่มงาน</option>
        	<option value="หน่วยนับ">ตั้งค่า : หน่วยนับ</option>
        	<option value="ตั้งเวลา">ตั้งค่า : ตั้งเวลา</option>
        	<option value="จังหวัด">ตั้งค่า : จังหวัด</option>
        </select>

    	วันที่ :
        <input type="text" class="datepicker" name="start_date" id="start_date" value="<?php echo @$_GET['start_date'];?>" />
        -
        <input type="text" class="datepicker" name="end_date" id="end_date" value="<?php echo @$_GET['end_date'];?>" />
		<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>
</div>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
<th width="10%"  align="left" >ลำดับ</th>
<th width="50%"  align="left" >รายละเอียด</th>
<th align="center">ชื่อผู้ใช้</th>
<th width="14%" align="left" >วันที่&nbsp;</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php foreach($result as $row){ ?>
<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $row['action'];?></td>
  <td><?php echo $row['name'];?></td>
  <td><?php echo stamp_to_th($row['process_date'],true);?></td>
  </tr>
  <? $i++;} ?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
