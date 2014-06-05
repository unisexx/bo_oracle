<h3>ทะเบียนข้อมูลเด็ก</h3>

<div id="search">
	<div id="searchBox">
  		<input type="text" name="textfield3" id="textfield3"  style="width:250px;" placeholder="ชื่อเด็ก" />
  		<select name="select" id="select">
    		<option>-- ทุกจังหวัด --</option>
  		</select>
  		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  	</div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/personal/reg_child/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">ชื่อเด็ก</th>
  		<th align="left">ที่อยู่</th>
  		<th>ลบ</th>
  	</tr>
  	<?php if (empty($items)): ?>
	<tr>
		<td colspan="4" class="text-center">- ไม่มีข้อมูล -</td>
	</tr>
	<?php else: ?>	  
  	<?php foreach ($items as $key => $item): ?>
	<tr>
		<td onclick="window.location='fund/personal/reg_child/form/<?php echo $item['id']; ?>'"><?php echo ($key+1)+(($_GET['page']-1)*20); ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/personal/reg_child/form/<?php echo $item['id']; ?>'"><?php echo $item['firstname'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/personal/reg_child/form/<?php echo $item['id']; ?>'"><?php echo $item['addr_number'] ?></td>
  		<td><input type="button" value="x" class="btn_delete" onclick="del('<?php echo site_url('fund/personal/reg_child/delete/'.$item['id']); ?>')" /></td>
	</tr>
	<?php endforeach ?>
	<?php endif ?>
</table>

<?php echo $pagination; ?>