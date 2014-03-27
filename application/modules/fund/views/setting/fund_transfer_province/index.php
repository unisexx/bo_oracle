<h3>ตั้งค่า งบประมาณแต่ละจังหวัด</h3>
<div id="search">
	<form method="get" action="fund/setting/fund_transfer_province">	
	<div id="searchBox">
			จังหวัด <?php echo form_dropdown('sch_province_id', get_option('id', 'title', 'cnf_province'), @$_GET['sch_province_id'], null, '-- เลือกจังหวัด --'); ?>
			กองทุน <?php echo form_dropdown('sch_fund_id', get_option('id', 'fund_name', 'fund_mst_fund_name'), @$_GET['sch_fund_id'], null, '-- เลือกกองทุน --'); ?>
		  <input type="submit" title="ค้นหา" value=" " class="btn_search" />
	</div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/setting/fund_transfer_province/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">จังหวัด</th>
  		<th align="left">กองทุน </th>
  		<th align="right" width="80">งบประมาณ</th>
  		<th align="right" width="50">ลบ</th>
  	</tr>
	<?php foreach($items as $key => $item): ?>
	<tr class="odd cursor">
  		<td onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo ($key+1)+(($_GET['page']-1)*20); ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo $item['title'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo $item['fund_name'] ?></td>
  		<td nowrap="nowrap" align="right" onclick="window.location='fund/setting/fund_transfer_province/form/<?php echo $item['id']; ?>'"><?php echo number_format($item['transfer_amount']); ?></td>
  		<td align="right"><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/setting/fund_transfer_province/delete/'.$item['id']); ?>')" /></td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
