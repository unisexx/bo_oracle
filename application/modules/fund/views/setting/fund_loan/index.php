<h3>ตั้งค่า ประเภทเงินทุนให้กู้</h3>
<div id="search">
<div id="searchBox">
  ชื่อเงินกู้ยืม  
    <input name="textfield" type="text" id="textfield" size="30" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/setting/fund_loan/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">ชื่อประเภทเงินทุนให้กู้</th>
  		<th align="left">ลบ</th>
  	</tr>
	<?php foreach($items as $item): ?>
	<tr class="odd cursor" onclick="window.location='fund/setting/fund_loan/form/<?php echo $item['id']; ?>'">
  		<td><?php echo $item['id'] ?></td>
  		<td nowrap="nowrap"><?php echo $item['fund_name'] ?></td>
  		<td><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/setting/fund_loan/'.$item['id']); ?>')" /></td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
