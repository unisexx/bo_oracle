<h3>ทะเบียนบุคคลขอรับเงินกองทุน</h3>

<div id="search">
	<div id="searchBox">
		<form>
		<input type="text" name="textfield3" id="textfield3"  style="width:250px;" placeholder="ชื่อเด็ก" />
		
		<select name="select" id="select">
			<option>กองทุน ทปศ. 3</option>
			<option>กองทุนคุ้มครองเด็ก</option>
			<option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
			<option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
			<option>กองทุนเลิกจ้างว่างงาน  400 ล้าน</option>
			<option>กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
			<option>เงินอุดหนุนองค์การสวัสดิการสังคมภาคเอกชน</option>
		</select>
		
		<button type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" ></button>
		</form>
	</div>
</div>

<div id="btnBox" ><a href="fund/personal/reg_fund/form" ><button class="btn_add" ></button></a></div>

<?php echo @$pagination?>

<table class="tblist" >
	<tr>
		<th style="text-align: left;" >ลำดับ</th>
		<th style="text-align: left;" >ชื่อ - สกุล</th>
		<th style="text-align: left;" >ที่อยู่</th>
		<th>ลบ</th>
	</tr>
	
	<tr class="odd" >
		<td>1</td>
		<td>นางสาวอำพร อินทร์ศรี</td>
		<td>226/6 หมู่ 2 ต.เนินพระ อ.เมืองระยอง จ.ระยอง</td>
		<td><a href="#" onclick="return confirm('<?php echo 1?>')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<tr>
		<td>2</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="odd" >
		<td>3</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>4</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="odd" >
		<td>5</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>6</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="odd" >
		<td>7</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>8</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="odd" >
		<td>9</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>10</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>

<?php echo @$pagination?>