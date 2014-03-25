<h3>ตั้งค่า ส่วนงานสวัสดิการสังคม</h3>
<div id="search">
	<form method="get" action="fund/setting/fund_project_structuresub">	
	<div id="searchBox">ชื่อส่วนงานสวัสดิการสังคม  <input name="keyword" type="text" size="30" value="<?php echo @$_GET['keyword']; ?>" /><input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/setting/fund_project_structuresub/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">ชื่อส่วนงานสวัสดิการสังคม</th>
  		<th align="left">ลักษณะโครงการ</th>
  		<th align="left" width="80">ลบ</th>
  	</tr>
	<?php foreach($items as $key => $item): ?>
	<tr class="odd cursor">
  		<td onclick="window.location='fund/setting/fund_project_structuresub/form/<?php echo $item['id']; ?>'"><?php echo ($key+1)+(($_GET['page']-1)*20); ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_project_structuresub/form/<?php echo $item['id']; ?>'"><?php echo $item['pssub_name'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_project_structuresub/form/<?php echo $item['id']; ?>'"><?php echo $item['ps_name'] ?></td>
  		<td><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/setting/fund_project_structuresub/delete/'.$item['id']); ?>')" /></td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
