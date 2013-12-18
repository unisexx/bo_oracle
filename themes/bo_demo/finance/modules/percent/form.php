<h3>หักเงินตามนโยบายพิเศษ % (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><select name="select4" id="select4">
    <option>-- เลือกหน่วยงาน --</option>
  </select></td>
</tr>
<tr>
  <th>หมวดงบประมาณ</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกหมวดงบประมาณ --</option>
    <option>งบบุคลากร</option>
    <option>งบดำเนินงาน </option>
    <option>งบลงทุน</option>
  </select></td>
</tr>
<tr>
  <th>หมวดค่าใช้จ่าย</th>
  <td><select name="select3" id="select3">
    <option selected="selected">-- เลือกหมวดค่าใช้จ่าย --</option>
    <option>เงินเดือน</option>
    <option>ค่าจ้างประจำ </option>
    <option>ค่าตอบแทนพนักงานราชการ </option>
  </select></td>
</tr>
<tr>
  <th>จำนวน</th>
  <td><input name="textfield" type="text" id="textfield" size="10" />
    %</td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>