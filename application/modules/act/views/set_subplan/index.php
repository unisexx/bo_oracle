<h3>ตั้งค่า แผนย่อย</h3>

<form method="get" action="act/set_subplan">
<div id="search">
<div id="searchBox">ชื่อแผนย่อย
  <input name="search" type="text" style="width:300px;" value="<?php echo @$_GET['search']?>"/>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/set_subplan/form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อแผนย่อย</th>
  <th align="left">แผน</th>
  <th align="left">ลบ</th>
  </tr>
  <?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
  <?php foreach($subplans as $row):?>
  <tr class="cursor" onclick="window.location='act/set_subplan/form/<?php echo $row['id']?>'">
	  <td><?php echo $i?></td>
	  <td nowrap="nowrap"><?php echo $row['plan_name']?></td>
	  <td nowrap="nowrap"><?php echo $row['subplan_name']?></td>
	  <td><a href="act/set_subplan/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td></a>
  </tr>
  <?$i++;?> 
  <?php endforeach;?>
</table>

<?php echo $pagination;?>