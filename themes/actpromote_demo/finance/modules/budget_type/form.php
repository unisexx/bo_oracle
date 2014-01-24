<h3>ประเภทงบประมาณ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th><label for="fid-full_name">ปีงบประมาณ</label><span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th><label for="fid-full_name2">ช่วงแผนงบประมาณ</label></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th><label for="fid-full_name3">ชื่อประเภทงบประมาณ</label></th>
  <td><input name="textfield3" type="text" id="textfield3" size="40"/></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>