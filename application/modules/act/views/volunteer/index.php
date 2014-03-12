<h3>บันทึก อาสาสมัคร</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่ออาสาสมัคร/ โทรศัพท์" style="width:300px;" />
  <select name="select2">
    <option>-- จังหวัด --</option>
</select>
  <input type="checkbox" name="checkbox" id="checkbox" />
  อาสาต่างชาติ
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/volunteer/form'" class="btn_add"/></div>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่ออาสาสมัคร</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกช์</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?foreach($volunteers as $row):?>
<tr class="cursor" onclick="window.location='act/volunteer/form/<?=$row['id']?>'">
  <td><?=$i?></td>
  <td><?=$row['fname'].' '.$row['lname']?></td>
  <td nowrap="nowrap">
  	<?=($row['home_no'])?$row['home_no']:"";?>
  	<?=($row['moo'])?"&nbsp;หมู่ที่ ".$row['moo']:"";?>
  	<?=($row['soi'])?"&nbsp;ซ. ".$row['soi']:"";?>
  	<?=($row['road'])?"&nbsp;ถ. ".$row['road']:"";?>
  	<?=($row['tumbon_code'])?" &nbsp;ต. ".act_get_tumbon($row['province_code'],$row['ampor_code'],$row['tumbon_code']):"";?>
  	<?=($row['ampor_code'])?" &nbsp;อ. ".act_get_ampor($row['province_code'],$row['ampor_code']):"";?>
  	<?=($row['province_code'])?" &nbsp;จ. ".act_get_province($row['province_code']):"";?>
  	<?=($row['post_code'])?'&nbsp;'.$row['post_code']:"";?>
  </td>
  <td nowrap="nowrap"><?=$row['tel']?></td>
  <td nowrap="nowrap"><?=$row['fax']?></td>
  <td><a href="act/volunteer/delete/<?=$row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++?>
<?endforeach;?>
</table>

<?=$pagination?>