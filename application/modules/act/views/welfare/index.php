<?php 
	$under_type_sub_arr = array('1'=>'ส่วนราชการ','2'=>'องค์กรปกครองส่วนท้องถิ่น','3'=>'มูลนิธิ','4'=>'สมาคม','5'=>'องค์กรภาคเอกชน','6'=>'(ถ้ามี)','7'=>'กลุ่มออมทรัพย์','8'=>'สหกรณ์','9'=>'ศูนย์พัฒนาครอบครัว','10'=>'องค์กรสวัสดิการชุมชน','11'=>'เครือข่ายองค์กรสวัสดิการชุมชน');
?>

<h3>บันทึก องค์การสวัสดิการสังคม</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อหน่วยงาน/ โทรศัพท์" style="width:300px;" />
  <select name="select">
    <option>-- ประเภทหน่วยงาน --</option>
    <option selected="selected">หน่วยงานของรัฐ</option>
    <option>องค์กรสาธารณประโยชน์</option>
    <option>องค์กรสวัสดิการชุมชน</option>
  </select>
  <select name="select2">
    <option>-- จังหวัด --</option>
  </select>
  <select name="select3">
    <option>-- สถานะ --</option>
    <option>ยังไม่ได้ลงทะเบียน</option>
    <option>รออนุมัติ</option>
    <option>อนุมัติ</option>
    <option>ไม่อนุมัติ</option>
  </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/welfare/form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ประเภท</th>
  <th align="left">รหัส</th>
  <th align="left">ชื่อหน่วยงาน</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกช์</th>
  <th align="left">สถานะขั้นตอน</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($orgmains as $row):?>
<tr class="cursor" onclick="window.location='act/welfare/form/<?php echo $row['organ_id']?>'">
  <td><?php echo $i?></td>
  <td nowrap="nowrap"><?php echo $under_type_sub_arr[$row['under_type_sub']]?></td>
  <td nowrap="nowrap"><?php echo $row['organ_id']?></td>
  <td><?php echo $row['organ_name']?></td>
  <td>
  	<?php echo ($row['o_name'])?$row['o_name']:"";?>
  	<?php echo ($row['home_no'])?" เลขที่ ".$row['home_no']:"";?>
  	<?php echo ($row['moo'])?" หมู่ที่ ".$row['moo']:"";?>
  	<?php echo ($row['soi'])?" ซ. ".$row['soi']:"";?>
  	<?php echo ($row['road'])?" ถ. ".$row['road']:"";?>
  	<?php echo ($row['tumbon_name'])?" ต. ".$row['tumbon_name']:"";?>
  	<?php echo ($row['ampor_name'])?" อ. ".$row['ampor_name']:"";?>
  	<?php echo ($row['province_name'])?" จ. ".$row['province_name']:"";?>
  </td>
  <td nowrap="nowrap"><?php echo $row['tel']?></td>
  <td nowrap="nowrap"><?php echo $row['fax']?></td>
  <td>รับเรื่อง</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<?$i++;?> 
<?php endforeach;?>
</table>

<?php echo $pagination;?>