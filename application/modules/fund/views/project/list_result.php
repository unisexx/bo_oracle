<h3>ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายโครงการ</h3>

<div id="search">
	<div id="searchBox">
		<input type="text" name="textfield3" id="textfield3"  style="width:250px;" placeholder="ชื่อผู้ขอ/ ชื่อเด็ก" />
		<select name="select" id="select">
			<option>รหัสโครงการ</option>
			<option>ชื่อโครงการ</option>
			<option>ชื่อองค์กร</option>
		</select>
		
		<select name="select1" id="select2">
			<option>-- ทุกปีงบประมาณ --</option>
		</select>
		
		<select name="select2" id="select2">
			<option>-- ทุกจังหวัด --</option>
		</select>
		
		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	</div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มแบบฟอร์มขอรับสนับสนุนโครงการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add vtip"/></div>

<?php echo $pagination?>

<table class="tblist">
	<tr>
		<th>ลำดับ</th>
		<th>รหัสโครงการ</th>
		<th>ชื่อโครงการ</th>
		<th>ชื่อองค์กรที่เสนอขอรับ</th>
		<th>บันทึกผลการพิจารณา</th>
	</tr>
	<tr class="odd">
	  	<td>1</td>
	  	<td>คคด/2557/นนทบุรี/0001</td>
	  	<td>โครงการ ABC</td>
	  	<td>องค์กร a</td>
	  	<td><a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form2"><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a></td>
	</tr>
	<tr>
	  	<td>2</td>
	  	<td>คคด/2557/นนทบุรี/0002</td>
	  	<td>โครงการ XYZ</td>
	  	<td>องค์กร b</td>
	  	<td><a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form2"><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a></td>
	</tr>
	<tr class="odd">
	  	<td>3</td>
	  	<td>คคด/2557/กรุงเทพ/0001</td>
	  	<td>โครงการ กขค1</td>
	  	<td>องค์กร c</td>
	  	<td><a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form2"><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a></td>
	</tr>
	<tr>
	  	<td>4</td>
	  	<td>คคด/2557/ตาก/0001</td>
	  	<td>โครงการ กขค2</td>
	  	<td>องค์กร c</td>
	  	<td><a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form2"><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a></td>
	</tr>
	<tr class="odd">
	  	<td>5</td>
	  	<td>คคด/2557/ตาก/0002</td>
	  	<td>โครงการ กขค3</td>
	  	<td>องค์กร c</td>
	  	<td><a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form2"><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a></td>
	</tr>
	<tr>
	  	<td>6</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	</tr>
	<tr class="odd">
	  	<td>7</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	</tr>
	<tr>
	  	<td>8</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	 	<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="odd">
		<td>9</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>10</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<?php echo $pagination?>