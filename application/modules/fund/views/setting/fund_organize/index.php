<h3>ตั้งค่า องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน</h3>
<div id="search">
	<form method="get" action="fund/setting/fund_organize">	
	<div id="searchBox">ชื่อ องค์กร/หน่วยงาน  <input name="keyword" type="text" size="30" value="<?php echo @$_GET['keyword'] ?>" /> <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/setting/fund_organize/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left" style='width:80px;'>ลำดับ</th>
  		<th align="left">ชื่อ องค์กร/หน่วยงาน</th>
  		<th align="left" width="80">ลบ</th>
  	</tr>
	<?php 
		if(count($items) == 0) {
			echo '<tr><td colspan="3" style="color:#AAA;" class="text-center">ไม่พบข้อมูล</td></tr>'; 
		}
	
		$i = 0;
		foreach($items as $key => $item): ?>
			<tr class="<?=($i==0)?'odd':'';?> cursor">
		  		<td onclick="window.location='fund/setting/fund_organize/form/<?php echo $item['id']; ?>'"><?php echo ($no+$key); ?></td>
		  		<td nowrap="nowrap" onclick="window.location='fund/setting/fund_organize/form/<?php echo $item['id']; ?>'"><?php echo $item['title'] ?></td>
		  		<td><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/setting/fund_organize/delete/'.$item['id']); ?>')" /></td>
		  	</tr>
  		
	  		<?php 
	  		$i = ($i == 1)?0:1;
  		endforeach; 
  	?>
</table>

<?php echo $pagination; ?>
