<h3>ตั้งค่า งบประมาณแต่ละจังหวัด</h3>
<div id="search">
	<form method="get" action="fund/setting/fund_name">	
	<div id="searchBox">ชื่อเงินกู้ยืม  <input name="keyword" type="text" size="30" /><input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/setting/fund_loan/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">จังหวัด</th>
  		<th align="left">กองทุน </th>
  		<th align="right" width="80">งบประมาณ</th>
  		<th align="right" width="50">ลบ</th>
  	</tr>
	<?php foreach($items as $item): ?>
	<tr class="odd cursor">
  		<td onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo $item['id'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo $item['title'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo $item['fund_name'] ?></td>
  		<td nowrap="nowrap" align="right" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo number_format($item['transfer_amount']); ?></td>
  		<td align="right"><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/setting/fund_transfer_province/delete/'.$item['id']); ?>')" /></td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
