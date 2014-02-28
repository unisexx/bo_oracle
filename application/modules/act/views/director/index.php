<?php 
$CommitteeType_arr = array(
	'1'=>'คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ',
	'2'=>'คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด',
	'3'=>'คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมกรุงเทพมหานคร',
	'4'=>'คณะกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคม',
	'5'=>'คณะกรรมการติดตามและประเมินผลการดำเนินงานของกองทุนส่งเสริมการจัดสวัสดิการสังคม'
);
?>

<h3>บันทึก คณะกรรมการ</h3>
<form method="get" action="act/director">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" value="<?php echo @$_GET['search']?>" placeholder="คำสั่ง/ รายชื่อคณะกรรมการ" style="width:300px;" />
  <select name="committee_type">
    <option value="">-- คณะกรรมการ --</option>
    <option value="1" <?php echo (@$_GET['committee_type'] == 1)?'selected=selected':'';?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ</option>
    <option value="2" <?php echo (@$_GET['committee_type'] == 2)?'selected=selected':'';?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
    <option value="3" <?php echo (@$_GET['committee_type'] == 3)?'selected=selected':'';?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมกรุงเทพมหานคร</option>
    <option value="4" <?php echo (@$_GET['committee_type'] == 4)?'selected=selected':'';?>>คณะกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    <option value="5" <?php echo (@$_GET['committee_type'] == 5)?'selected=selected':'';?>>คณะกรรมการติดตามและประเมินผลการดำเนินงานของกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
  </select>
  <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$_GET['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
  <select name="status">
    <option value="">-- สถานะ --</option>
    <option value="1" <?php echo (@$_GET['status'] == 1)?'selected=selected':'';?>>ยังเป็นคณะกรรมการอยู่</option>
    <option value="2" <?php echo (@$_GET['status'] == 2)?'selected=selected':'';?>>ไม่ได้เป็นคณะกรรมการแล้ว</option>
  </select>
<input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/director/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">คณะกรรมการ</th>
  <th align="left">จังหวัด</th>
  <th align="left">คำสั่ง</th>
  <th align="left">ลงวันที่</th>
  <th align="left">รายชื่อคณะกรรมการ</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($committee_mains as $row):?>
<tr class="cursor" onclick="window.location='act/director/form/<?php echo $row['id']?>'">
  <td><?php echo $i?></td>
  <td nowrap="nowrap"><?php echo $CommitteeType_arr[$row['committee_type']]?></td>
  <td nowrap="nowrap"><?php echo act_get_province($row['province_code'])?></td>
  <td nowrap="nowrap"><?php echo $row['order_no']?></td>
  <td nowrap="nowrap"><?php echo $row['order_date']?></td>
  <td><img src="themes/act/images/commitee.png" width="24" height="24" class="vtip" title="นางสาวจิตรา พรหมชุติมา <br>นายอรุณ พุมเพรา<br>นางจิตรา ภุมมะกาญจนะ" /></td>
  <td><a href="act/director/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination?>