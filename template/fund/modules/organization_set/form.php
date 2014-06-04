<h3>ตั้งค่า องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน   (บันทึก / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อองค์กร/หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield" type="text" id="textfield" style="width:500px;" /></td>
</tr>
<tr>
  <th>อยู่เลขที่ <span class="Txt_red_12">*</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:500px;"/></td>
</tr>
<tr>
  <th>หมู่ที่<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield3" type="text" id="textfield3"style="width:50px;" /></td>
</tr>
<tr>
  <th>ถนน <span class="Txt_red_12">*</span></th>
  <td><input name="textfield4" type="text" id="textfield4"style="width:250px;" /></td>
</tr>
<tr>
  <th>จังหวัด <span class="Txt_red_12">*</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกจังหวัด --</option>
  </select></td>
</tr>
<tr>
  <th>อำเภอ/เขต <span class="Txt_red_12">*</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกอำเภท/เขต --</option>
  </select></td>
</tr>
<tr>
  <th>ตำบล/แขวง <span class="Txt_red_12">*</span></th>
  <td><select name="select3" id="select3">
    <option>-- เลือกตำบล/แขวง --</option>
  </select></td>
</tr>
<tr>
  <th>รหัสไปรษณีย์</th>
  <td><input name="textfield5" type="text" id="textfield5"style="width:100px;" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>