<h3>ทะเบียนบุคคลขอรับเงินกองทุน</h3>

<div id="search">
	<div id="searchBox">
		<form method="get" >
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
	
	<tbody>
	<?php if(empty($variable)):?>
	<tr>
		<td colspan="4" class="text-center" >- ไม่มีข้อมูล -</td>
	</tr>
	<?php else:?>
	<?php foreach ($variable as $key => $value):?>
	<tr>
		<td><?php echo ($key+1)+(($_GET["page"]-1)*20)?></td>
		<td><a href="fund/personal/reg_fund/form/<?php echo $value["id"]?>" title="<?php echo $value["FIRSTNAME"]." ".$value["LASTNAME"]?>" ><?php echo $value["FIRSTNAME"]." ".$value["LASTNAME"]?></a></td>
		<td><?php echo $value["ADDR_NUMBER"]." ".$value["ADDR_MOO"]." ".$value["DISTRICT_ID"]." ".$value["AMPHUR_ID"]." ".$value["PROVINCE_ID"]?></td>
		<td><a href="#" onclick="return confirm('<?php echo $value->title?>?>')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php endforeach?>
	<?php endif?>
	</tbody>
	
</table>

<?php echo @$pagination?>