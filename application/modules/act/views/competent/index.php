<h3>บันทึก รายชื่อพนักงานเจ้าหน้าที่</h3>

<form method="get" action="act/competent">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" value="<?php echo @$_GET['search']?>" placeholder="ชื่อพนักงานเจ้าหน้าที่/ โทรศัพท์/ อีเมล์" style="width:300px;" />
  <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$_GET['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/competent/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อ - สกุล</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกซ์</th>
  <th align="left">อีเมล์</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($officers as $row):?>
<tr class="cursor" onclick="window.location='act/competent/form/<?php echo $row['id']?>'">
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
  <td><a href="act/competent/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination?>