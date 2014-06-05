<h3>แบบฟอร์มขอรับเงินสนับสนุน รายบุคคล (เพิ่ม / แก้ไข)</h3>
<form action="#" method="post" >
<table class="tbadd">
	<tr>
		<th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
		<td>กองทุนคุ้มครองเด็ก
		    <select name="select" id="select">
				<option>2557</option>
				<option>2556</option>
		    </select>
	    </td>
	</tr>
	<tr>
		<th>จังหวัด <span class="Txt_red_12">*</span></th>
		<td>
			<?php echo form_dropdown("PROVINCE_ID",get_option("ID","TITLE","CNF_PROVINCE",NULL,"TITLE"))?>
		</td>
	</tr>
	<tr>
		<th>วันเดือนปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
		<td>
			<input type="text" class="datepicker" name="textfield13" style="width:80px;" />
		</td>
	</tr>
	<tr>
		<th>ข้อมูลเด็ก <span class="Txt_red_12">*</span></th>
		<td>
			<input type="text" name="textfield13" id="textfield14" style="width:350px;" />
			<img src="images/see.png" width="24" height="24" />
		</td>
	</tr>
	<tr>
		<th>ประเภทขอรับการช่วยเหลือ</th>
		<td>
			<span><label><input type="radio" name="radio" id="radio" value="radio" />เด็กและครอบครัว</label></span>
			<span><label><input type="radio" name="radio" id="radio2" value="radio" /> ครอบครัวอุปถัมภ์</label></span>
		</td>
	</tr>
	<tr>
		<th>สภาพปัญหาความเดือดร้อนโดยสรุป</th>
		<td><textarea name="textarea3" id="textarea3" style="width:500px; height:80px;"></textarea></td>
	</tr>
	<tr>
		<th>ข้อมูลผู้ขอ <span class="Txt_red_12">*</span></th>
		<td>
			<input type="text" name="textfield2" id="textfield25" style="width:350px;" />
			<img src="images/see.png" width="24" height="24" />
		</td>
	</tr>
	<tr>
		<th>ความเกี่ยวข้องกับเด็ก</th>
		<td>
			<span><label><input type="radio" name="radio" id="radio3" value="radio" /> บิดา/มารดา</label></span>
	    	<span><label><input type="radio" name="radio" id="radio4" value="radio" />ญาติ</label></span>
			<span><label><input type="radio" name="radio" id="radio4" value="radio" />ผู้ดูแล/ผู้อุปถัมภ์</label></span>
			<span><label><input type="radio" name="radio" id="radio4" value="radio" />คนรู้จัก</label></span>
		</td>
	</tr>
</table>

<div id="btnBoxAdd">
	<button type="submit" class="btn_save" title="บันทึก" ></button>
</div>

</form>