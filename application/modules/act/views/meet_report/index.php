<h3>บันทึก รายงานการประชุม</h3>

<form method="get" action="act/meet_report">
<div id="search">
<div id="searchBox">
  <input type="text" name="search" placeholder="ชื่อเรื่องการประชุม" value="<?php echo @$_GET['search']?>" style="width:300px;" />
  <input type="submit"  title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/meet_report/form'" class="btn_add"/></div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อเรื่องการประชุม</th>
  <th align="left">สถานที่</th>
  <th align="left">วันที่ประชุม</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($meetings as $row):?>
<tr class="cursor" onclick="window.location='act/meet_report/form/<?php echo $row['id']?>'">
  <td><?php echo $i?></td>
  <td><?php echo $row['headline']?></td>
  <td><?php echo $row['place']?></td>
  <td><?php echo str_replace('-', '/',$row['meeting_date']);?></td>
  <td><a href="act/meet_report/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination?>