<h3>ทะเบียนข้อมูลเด็ก (เพิ่ม / แก้ไข)</h3>

<?php echo form_open('fund/personal/reg_child/save'); ?>
<table class="tbadd">
  	<tr>
    	<th>เลขบัตรประชาชน</th>
    	<td>
    		<input type="radio" name="is_idcard" value="1" /> มี      <input name="idcard" type="text" style="width:150px;" maxlength="13"/>
      		<span style="margin-left:30px;"><input type="radio" name="is_idcard" value="0" /> ไม่มี
		<input name="textfield4" type="text" id="textfield4" style="width:250px;"/></span></td>
  	</tr>
  	<tr>
    	<th>ชื่อเด็ก</th>
    	<td><select name="select3" id="select3">
      		<option>-- เพศ --</option>
      		<option>ชาย</option>
      		<option>หญิง</option>
      		<option>อื่นๆ</option>
   			</select>
    	<input type="text" name="textfield" id="textfield" placeholder="ชื่อ" />
    <input type="text" name="textfield2" id="textfield2" placeholder="นามสกุล"/></td>
  	</tr>
  	<tr>
    	<th>วันเกิด</th>
    	<td><input name="textfield12" type="text" id="textfield12" style="width:70px;"/>
    	<img src="../images/calendar.png" alt="" width="16" height="16" /> อายุ
    	<input name="textfield23" type="text" id="textfield32" style="width:50px;" readonly="readonly"/> 
    ปี</td>
  	</tr>
  	<tr>
    	<th>ที่อยู่</th>
    	<td>
    		เลขที่ <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
      		หมู่ที่ <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
      		ตรอก <input name="textfield10" type="text" id="textfield10" style="width:200px;"/><br />
      		ซอย <input name="textfield3" type="text" id="textfield3" style="width:200px;"/>
      		ถนน <input name="textfield11" type="text" id="textfield11" style="width:200px;"/><br />
      		จังหวัด <select name="select5" id="select4"></select>
      		อำเภอ <select name="select5" id="select5"></select>
      		ตำบล <select name="select5" id="select6"></select>
      	</td>
  	</tr>
</table>

<div id="btnBoxAdd">
	<input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  	<input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_close(); ?>