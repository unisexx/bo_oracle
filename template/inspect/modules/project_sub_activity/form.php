<h3>บันทึก โครงการกิจกรรมย่อย (เพิ่ม)</h3>
<table class="tbadd">
<tr>
  <th>เขตตรวจที่ <span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>จังหวัด <span class="Txt_red_12"> *</span></th>
  <td><select name="select4" id="select4" class="mustChoose">
    <option>-- เลือกจังหวัด --</option>
  </select></td>
</tr>
<tr>
  <th><label for="fid-7111_id">ปี <span class="Txt_red_12"> *</span></label></th>
  <td><select name="select2" id="select2" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>โครงการ  <span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกรายชื่อโครงการ --</option>
  </select></td>
</tr>
<tr>
  <th>รอบ <span class="Txt_red_12"> *</span></th>
  <td><select name="select6" id="select6" class="mustChoose">
    <option>-- เลือกรอบ --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมโครงการ<span class="Txt_red_12"> *</span></th>
  <td><select name="select5" id="select5">
    <option>-- เลือกกิจกรรมโครงการ --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมย่อย <span class="Txt_red_12">*</span><br />
    <br />
    <input type="button" title="เพิ่มรายการ" value=" " class="btn_addmore" /></th>
  <td>
  <div><textarea name="textfield2" cols="40" rows="4" id="textfield3"></textarea>
ผู้ดูแล <input name="textfield" type="text" id="textfield" size="20" />
งบประมาณ <input name="textfield3" type="text" id="textfield2" size="20" />
    บาท </div></td>
</tr>
</table>

<div class="paddT20"></div>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>