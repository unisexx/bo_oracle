<h3>ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายโครงการ</h3>
<div id="search">
	<form method="get" action="fund/project/project_support_result">	
		<div id="searchBox">
			ชื่อกลุ่มเป้าหมายของโครงการ   <input name="keyword" type="text" value="<?php echo @$_GET['keyword']; ?>" placeholder = "รหัสโครงการ/ชื่อโครงการ/ชื่อองค์กร" style='width:200px;'/>
			<input type="submit" title="ค้นหา" value=" " class="btn_search" />
		</div>
	</form>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='fund/project/project_support_result/form'" class="btn_add"/></div>

<?php echo $pagination; ?>

<table class="tblist">
	<tr>
  		<th align="left">ลำดับ</th>
  		<th align="left">รหัสโครงการ</th>
  		<th align="left">ชื่อโครงการ</th>
  		<th align="left">ชื่อองค์กรที่เสนอขอรับ</th>
  		<th align="left" width="150">บันทึกผลการพิจารณา</th>
  	</tr>
	<?php $i=0; foreach($items as $key => $item): $no++; $i++; if($i==2) $i = 0; ?>
	<tr class="<? echo ($i==1)?'odd':''; ?> cursor">
  		<td onclick="window.location='fund/project/project_support_result/form/<?php echo $item['id']; ?>'"><?php echo $no; ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/project/project_support_result/form/<?php echo $item['id']; ?>'"><?php echo $item['project_code'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/project/project_support_result/form/<?php echo $item['id']; ?>'"><?php echo $item['project_name'] ?></td>
  		<td nowrap="nowrap" onclick="window.location='fund/project/project_support_result/form/<?php echo $item['id']; ?>'"><?php echo $item['organization'] ?></td>
  		<td>
  			<? echo anchor('fund/project/project_support_result/form/'.$item['id'], '<img src="images/fund/btn_approve.png">'); ?>
  		</td>
  	</tr>
  	<?php endforeach; ?>
</table>

<?php echo $pagination; ?>
