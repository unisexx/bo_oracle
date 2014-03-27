<h3>รายงานอาสาสมัคร</h3>
<form method="GET">
	<div id="search">
		<div id="searchBox">ปีงบประมาณ <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province')); ?>  
			<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
		</div>
	</div>
</form> 

<table class="tblist">
	<tr>
		<th>ชื่ออาสาสมัคร</th>
		<th>ที่อยู่</th>
		<th>โทรศัพท์</th>
		<th>FAX</th>
		<th>Email</th>
	</tr>
	<?php foreach($result as $item): ?>
	<tr class="cursor" onclick="window.location='act/report/volunteer/view/<?php echo $item['v_id']; ?>'">
		<td><?php echo $item['fullname'] ?></td>
		<td><?php echo $item['address'] ?></td>
		<td><?php echo $item['tel'] ?></td>
		<td><?php echo $item['fax'] ?></td>
		<td><?php echo $item['email'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php echo $pagination;?>