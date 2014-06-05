<h3>ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล</h3>

<div id="search">
	<div id="searchBox">
		<form>
			
		<input type="text" name="keyword" style="width:250px;" placeholder="ชื่อผู้ขอ/ ชื่อเด็ก" />
		
		<select name="select" id="select">
			<option>2557</option>
			<option>2556</option>
		</select>
		
		<select name="select2" id="select2">
			<option>-- ทุกจังหวัด --</option>
		</select>
		
		<select name="select3" id="select3">
		    <option>-- ทุกผลการพิจารณา --</option>
		    <option>รอดำเนินการ</option>
		    <option>อนุมัติ</option>
		    <option>ไม่อนุมัติ</option>
		</select>
		
		<button type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" ></button>
		</form>
	</div>
</div>

<!-- <div id="btnBox" ><a href="#" ><button class="btn_add" ></button></a></div> -->

<?php echo @$pagination?>

<table class="tblist">
	<tr>
		<th>ลำดับ</th>
		<th>จังหวัด</th>
		<th>ชื่อผู้รับ (เด็ก)</th>
		<th>ชื่อผู้ขอ</th>
		<th>ผลการพิจารณา</th>
		<th>จัดการ</th>
	</tr>
	<tr class="odd">
		<td>1</td>
		<td>สมุทรปราการ</td>
		<td>ด.ช.วันชัย ดวงดี</td>
		<td>นางกนกพร คงเฉลิม</td>
		<td>รอดำเนินการ</td>
		<td>
			<a href="#" ><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a>
			<a href="#" onclick="return confirm('<?php echo 1?>')" ><button type="button" class="btn_delete" ></button></a>
		</td>
	</tr>
	<tr>
		<td>2</td>
		<td>นนทบุรี</td>
		<td>ด.ช.ชูศักดิ์  เกียรติเฉลิมคุณ</td>
		<td>นายสมหวัง  จตุรงค์ล้ำเลิศ</td>
		<td>อนุมัติ</td>
		<td>
			<a href="#" ><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a>
			<a href="#" onclick="return confirm('<?php echo 1?>')" ><button type="button" class="btn_delete" ></button></a>
		</td>
	</tr>
	<tr class="odd">
		<td>3</td>
		<td>นครปฐม</td>
		<td>ด.ช.ทรงพล  อาริยวัฒน์</td>
		<td>นางสาวประภาศรี  ทองกิ่งแก้ว</td>
		<td>ไม่อนุมัติ</td>
		<td>
			<a href="#" ><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a>
			<a href="#" onclick="return confirm('<?php echo 1?>')" ><button type="button" class="btn_delete" ></button></a>
		</td>
	</tr>
	<tr>
		<td>4</td>
		<td>เพชรบุรี</td>
		<td>ด.ญ.สุดารัตน์  เกื้อทวีกุล</td>
		<td>นางวารุณี  ลภิธนานุวัฒน์</td>
		<td>อนุมัติ</td>
		<td>
			<a href="#" ><img src="images/fund/btn_approve.png" width="32" height="32" class="vtip" title="ผลการพิจารณา" /></a>
			<a href="#" onclick="return confirm('<?php echo 1?>')" ><button type="button" class="btn_delete" ></button></a>
		</td>
	</tr>
	<tr class="odd">
		<td>5</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>6</td>
		<td>&nbsp;</td>
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
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>8</td>
		<td>&nbsp;</td>
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
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>10</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<?php echo @$pagination?>