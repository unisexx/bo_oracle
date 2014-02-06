<style>
	.btn_add_indicator {
						width: 162px;
						height: 28px;
						border: none;
						background: transparent url(images/btn_add_indicator.gif) no-repeat center;
						overflow: hidden;
						line-height: 0px;
						display: inline;
						color: #a63606;
						cursor: pointer;
						cursor: hand;
						margin-top: 5px;
						}
</style>
<h3>บันทึก ตัวชี้วัด (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$rs_indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>หน่วยงานรับผิดชอบ</th>
    <td><input name="textfield" type="text" id="textfield" style="width:500px;" value="สำนักงานปลัดกระทรวง (สป.) - สำนักบริหารงานกลาง (หาจากไหน)" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:500px;" value="มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด</th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:600px;" value="<?=@$parent_on?> : <?=@$rs_metrics['metrics_name']?>" readonly="readonly"/></td>
  </tr>
</table>
<?
		$premit = is_permit(login_data('id',3));
		if($premit != "")
		{
			$chk_keyer_indicator = chk_keyer_indicator(@$rs_indicator['id'],$rs_metrics['id']);	
			if($chk_keyer_indicator == 'Y'){
					
?>
<div id="btnBox"><input type="button" title="เพิ่มผลปฎิบัติราชการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form2'" class="btn_add_indicator vtip"/></div>
<? } }?>
<table class="tblist2">
<tr>
  	<th>แบบฟอร์มรายงานผล</th>
	<th>ผู้กำกับดูแล</th>
	<th>ผู้จัดเก็บข้อมูล</th>
	<th>วันที่</th>
	<th>ขั้นตอน</th>
	<th>สถานะ</th>
	<th>ลบ </th>
</tr>
<? foreach ($rs as $key => $value) { ?>
<tr>
  <td>6 เดือน <img src="images/see.png" alt="" width="24" height="24" /></td>
  <td>นายวัชรินทร์ เจริญเผ่า <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : 023068736&lt;br&gt; อีเมล์ :" /></td>
  <td>นางวันดี กำหนดศรี <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : 023068736&lt;br&gt; อีเมล์ :" /></td>
  <td><img src="images/date.png" alt="" width="24" height="24" class="vtip" title="บันทึก : 10/12/56 &lt;br&gt; ขออนุมัติส่ง : 10/12/56 &lt;br&gt; พิจารณาส่ง : 12/12/56 &lt;br&gt; กพร.พิจารณาอนุมัติ : 15/12/56 " /></td>
  <td>บันทึก, ขออนุมัติส่ง, พิจารณาส่ง, กพร.พิจารณาอนุมัติ</td>
  <td>อนุมัติ,ไม่อนุมัติ, ผ่าน, ไม่ผ่าน</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<? } ?>


</table>
