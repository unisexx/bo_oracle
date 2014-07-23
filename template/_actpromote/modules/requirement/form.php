<h3>บันทึก ข้อกำหนด/ระเบียบ/ประกาศ (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ประเภทของกฎหมาย <span class="Txt_red_12"> *</span></th>
    <td><select name="select2">
      <option>-- เลือกประเภทของกฎหมาย --</option>
      <option>ข้อกำหนด</option>
      <option>ระเบียบ</option>
      <option>ประกาศ</option>
      <option>คำสั่ง</option>
      <option>หนังสือ</option>
      <option>แบบ</option>
    </select></td>
  </tr>
  <tr>
    <th>เรื่อง <span class="Txt_red_12">*</span></th>
    <td><input name="textfield4" type="text" id="textfield4" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>สรุปย่อ</th>
    <td><textarea name="textfield18" rows="3" id="textfield19" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 1</th>
    <td><input type="file" name="fileField2" id="fileField2" /></td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 2</th>
    <td><input type="file" name="fileField2" id="fileField3" /></td>
  </tr>
  <tr>
    <th>ไฟล์ที่ 3</th>
    <td><input type="file" name="fileField2" id="fileField4" /></td>
  </tr>
  <tr>
    <th>หมายเหตุ</th>
    <td><textarea name="textfield" rows="3" id="textfield" style="width:500px;"></textarea></td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

