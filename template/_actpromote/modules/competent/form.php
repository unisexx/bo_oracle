<h3>บันทึก รายชื่อพนักงานเจ้าหน้าที่ (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>จังหวัด </th>
    <td><select name="select">
      <option>-- จังหวัด --</option>
    </select></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td><select name="select2" id="select">
      <option>-- คำนำหน้า --</option>
    </select>
      <input name="textfield2" type="text" id="textfield2" style="width:150px;" placeholder="ชื่อ"/>
      <input name="textfield4" type="text" id="textfield4" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
      ชาย </span> <span>
        <input type="radio" name="radio" id="radio4" value="radio" />
        หญิง </span></td>
  </tr>
  <tr>
    <th>วันที่ได้รับการแต่งตั้งให้เป็นพนักงานเจ้าหน้าที่</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:80px;"/>
      <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>ประเภทสังกัด</th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" />
      ราชการ </span> <span>
        <input type="radio" name="radio" id="radio2" value="radio" />
        เอกชน </span></td>
  </tr>
<tr>
  <th><label for="fid-full_name4">ชื่อหน่วยงานที่สังกัด</label>    </th>
  <td><select name="select6" id="select7">
    <option>-- หน่วยงานที่สังกัด --</option>
    </select>
    <input name="textfield" type="text" id="textfield" style="width:300px;" placeholder="ยศ/ตำแหน่ง"/></td>
</tr>
<tr>
  <th>ตำแหน่งหน้าที่การงาน</th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:250px;"/></td>
</tr>
<tr>
  <th>สถานที่ทำงาน/ติดต่อ <span class="Txt_red_12"> *</span></th>
  <td>เลขที่
    <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="textfield11" type="text" id="textfield11" style="width:200px;"/>
    <br />
    จังหวัด
    <select name="select5" id="select4">
      </select>
    อำเภอ
    <select name="select5" id="select5">
      </select>
    ตำบล
    <select name="select5" id="select6">
      </select>
    รหัสไปรณีย์
    <input name="textfield12" type="text" id="textfield12" style="width:70px;"/></td>
</tr>
<tr>
  <th>โทรศัพท์</th>
  <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/></td>
</tr>
<tr>
  <th>แฟกช์</th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:200px;"/></td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="textfield14" type="text" id="textfield14" style="width:250px;"/></td>
</tr>
<tr>
  <th>หมายเหตุ
  </th>
  <td><textarea name="textfield27" rows="3" id="textfield33" style="width:500px;"></textarea></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

