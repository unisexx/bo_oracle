<h3>ตั้งค่า สิทธิการใช้งาน</h3>

<div id="btnBox" style="text-align:right;float:right;">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='user/permission/form'" class="btn_add"/>
</div>

<table class="tblist">
	<tr>
		<th>กลุ่ม</th>
		<th></th>
	</tr>
	<?php foreach($result as $item): ?>
	<tr>
		<td><?php echo $item['group_name']; ?></td>
		<td><?php echo anchor('user/permission/form/'.$item['id'], 'แก้ไข'); ?></td>
	</tr>
	<?php endforeach; ?>
</table>