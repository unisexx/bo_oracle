<h3>ตั้งค่า ตำแหน่งในคณะกรรมการ </h3>

<form method="get" action="act/set_position_director">
<div id="search">
<div id="searchBox">ชื่อตำแหน่งในคณะกรรมการ
  <input name="search" type="text" id="textfield" style="width:300px;" value="<?php echo @$_GET['search']?>"/>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='act/set_position_director/form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อตำแหน่งในคณะกรรมการ</th>
  <th align="left">ลบ</th>
  </tr>
  <?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
  <?php foreach($pds as $row):?>
  	<tr class="cursor" onclick="window.location='act/set_position_director/form/<?php echo $row['id']?>'">
	  <td><?php echo $i?></td>
	  <td nowrap="nowrap"><?php echo $row['position_director_name']?></td>
	  <td><a href="act/set_position_director/delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" name="button" id="button" value="x" class="btn_delete" /></td></a>
  </tr>
  <?$i++;?> 
  <?php endforeach;?>
</table>

<?php echo $pagination;?>