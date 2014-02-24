<h3>บันทึก ผู้รับบริการสวัสดิการสังคม</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อผู้รับบริการสวัสดิการสังคม/ โทรศัพท์/ อีเมล์" style="width:300px;" />
  <select name="select2">
    <option>-- จังหวัด --</option>
</select>
  <select name="select">
    <option>-- ระดับการศึกษา --</option>
  </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/welfare_service/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อผู้รับบริการสวัสดิการสังคม</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกช์</th>
  <th align="left">อีเมล์</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($cmains as $row):?>
<tr class="cursor" onclick="window.location='act/welfare_service/form/<?php echo $row['id']?>'">
  <td><?php echo $i?></td>
  <td nowrap="nowrap"><?php echo act_get_title($row['title_id']).$row['fname'].' '.$row['lname']?></td>
  <td>
  	<?php echo ($row['home_no'])?$row['home_no']:"";?>
  	<?php echo ($row['moo'])?"&nbsp;หมู่ที่ ".$row['moo']:"";?>
  	<?php echo ($row['soi'])?"&nbsp;ซ. ".$row['soi']:"";?>
  	<?php echo ($row['road'])?"&nbsp;ถ. ".$row['road']:"";?>
  	<?php echo ($row['tumbon_code'])?" &nbsp;ต. ".act_get_tumbon($row['province_code'],$row['ampor_code'],$row['tumbon_code']):"";?>
  	<?php echo ($row['ampor_code'])?" &nbsp;อ. ".act_get_ampor($row['province_code'],$row['ampor_code']):"";?>
  	<?php echo ($row['province_code'])?" &nbsp;จ. ".act_get_province($row['province_code']):"";?>
  	<?php echo ($row['post_code'])?'&nbsp;'.$row['post_code']:"";?>
	</td>
  <td><?php echo $row['tel']?></td>
  <td><?php echo $row['fax']?></td>
  <td><?php echo $row['email']?></td>
  <td><a href="act/welfare_service/delete/<?php echo $row['id_card']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination?>