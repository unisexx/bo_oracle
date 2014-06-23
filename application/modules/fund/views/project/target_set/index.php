<h3>ตั้งค่า กลุ่มเป้าหมายของโครงการ</h3>
<div id="search">
	<form method="get" action="fund/project/target_set">	
	<div id="searchBox">ชื่อกลุ่มเป้าหมายของโครงการ   <input name="keyword" type="text" size="30" value="<?php echo @$_GET['keyword']; ?>" /><input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/project/target_set/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">ชื่อกลุ่มเป้าหมายของโครงการ	</th>
  		<th align="left">สถานะ</th>
  		<th align="left" width="80">ลบ</th>
  	</tr>
	<?php $i=0; foreach($items as $key => $item): $no++; $i++; if($i==2) $i = 0; ?>
	<tr class="<? echo ($i==1)?'odd':''; ?> cursor">
  		<td onclick="window.location='fund/project/target_set/form/<?php echo $item['id']; ?>'"><?php echo $no; ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/project/target_set/form/<?php echo $item['id']; ?>'"><?php echo $item['title'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/project/target_set/form/<?php echo $item['id']; ?>'"><?php echo ($item['status'] == 1)?'เปิดใช้งาน':'ปิดใช้งาน'; ?></td>
  		<td><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/project/target_set/delete/'.$item['id']); ?>')" /></td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
