<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename='สิทธิ์การใช้งาน.xls'");
?>

<table class="tblist">
	<tr>
	  <th align="left">ลำดับ</th>
	  <th align="left">ชื่อผู้ใช้</th>
	  <th align="left">การใช้ระบบงาน</th>
	</tr>
	  <?php foreach($result as $key=>$item): ?>
		<tr>
		  <td><?php echo $key+1;?></td>
		  <td><?php echo $item['title'];?></td>
		  <td><?php echo ShowUserTypeSystem($item['id']);?></td>
		</tr>
	  <?php endforeach;?>
</table>