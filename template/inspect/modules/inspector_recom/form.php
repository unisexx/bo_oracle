<h3>บันทึก ข้อเสนอแนะผู้ตรวจ (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
<table class="tbadd">
<tr>
  <th><label for="fid-7111_id">ปี <span class="Txt_red_12"> *</span></label></th>
  <td><select name="select2" id="select2" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>เขตตรวจที่ </th>
  <td><select name="select" id="select">
    <option>-- ทุกเขตตรวจ --</option>
    </select></td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td><select name="select4" id="select4">
    <option>-- ทุกจังหวัด --</option>
  </select></td>
</tr>
</table>

<div class="paddT20"></div>
<table class="tblist4">
<tr class="topic">
  <th colspan="3">เขตที่ 1</th>
  </tr>
<tr>
  <th>จังหวัด</th>
  <th>ข้อเสนอแนะ (ผู้ตรวจราชการ)</th>
  <th>ผลการดำเนินงาน (พมจ.)</th>
</tr>
<tr>
  <td>นนทบุรี</td>
  <td><textarea name="textarea2" rows="5" id="textarea2" style="width:100%;"></textarea></td>
  <td>
    <textarea name="textarea" rows="5" id="textarea" style="width:100%;"></textarea>
    <br /><br />
    <input type="file" name="fileField" id="fileField" /></td>
</tr>
<tr>
  <td>สมุทรปราการ</td>
  <td><textarea name="textarea2" rows="5" id="textarea2" style="width:100%;"></textarea></td>
  <td><textarea name="textarea" rows="5" id="textarea" style="width:100%;"></textarea>
    <br />
    <br />
    <input type="file" name="fileField" id="fileField" /></td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>