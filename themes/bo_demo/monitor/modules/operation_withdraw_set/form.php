<h3>ตั้งค่า กิจกรรมโครงการและงบประมาณ (ผลการดำเนินงานและเบิกจ่าย) (บันทึก / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ผลผลิต</th>
  <td><select name="select" id="select">
    <option>-- เลือกผลผลิต --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกกิจกรรมหลัก --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมย่อย </th>
  <td><select name="select3" id="select3">
    <option>-- เลือกกิจกรรมย่อย --</option>
  </select></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td><select name="select4" id="select4">
    <option>-- เลือกโครงการ --</option>
  </select>
    <input type="checkbox" name="checkbox" id="checkbox" />
    <input name="textfield2" type="text" id="textfield2" size="60" /></td>
</tr>
<tr>
  <th>โครงการย่อย</th>
  <td><input name="textfield" type="text" id="textfield" size="60" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>