<h3>บันทึก รายชื่อคณะอนุกรรมการ</h3>

<form method="get" action="act/committee">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" value="<?php echo @$_GET['search']?>" placeholder="ชื่อคณะอนุกรรมการ" style="width:300px;" />
  <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$_GET['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
  <select name="status">
    <option value="">-- สถานะ --</option>
    <option value="1" <?php echo (@$_GET['status'] == 1)?'selected=selected':'';?>>ยังเป็นคณะกรรมการอยู่</option>
    <option value="2" <?php echo (@$_GET['status'] == 2)?'selected=selected':'';?>>ไม่ได้เป็นคณะกรรมการแล้ว</option>
  </select>
<input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/committee/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">จังหวัด</th>
  <th align="left">คำสั่ง</th>
  <th align="left">ชื่อคณะอนุกรรมการ</th>
  <th align="left">ลงวันที่</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($subcommittee_mains as $row):?>
<tr class="cursor" onclick="window.location='act/committee/form/<?php echo $row['id']?>'">
  <td><?php echo $i?></td>
  <td nowrap="nowrap"><?php echo act_get_province($row['province_code'])?></td>
  <td nowrap="nowrap"><?php echo $row['order_no']?></td>
  <td><?php echo $row['headline']?></td>
  <td nowrap="nowrap"><?php echo $row['order_date']?></td>
  <td><a href="act/committee/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
  </tr>
<?$i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination?>