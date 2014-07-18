<h3>บันทึก อาสาสมัคร (บันทึก / แก้ไข) <a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form_en"><img src="images/eng_flag.png" width="32" height="32" /></a></h3>
<table class="tbadd">
  <tr>
    <th>เลขที่ Passport <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
ไม่มี </span> <span>
<input type="radio" name="radio" id="radio4" value="radio" />
มี </span>
<input name="textfield16" type="text" id="textfield16" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>เลขที่บัตรประชาชน <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td><select name="select" id="select">
      <option>-- คำนำหน้า --</option>
    </select>      
      <input name="textfield3" type="text" id="textfield3" style="width:150px;" placeholder="ชื่อ"/>
      <input name="textfield4" type="text" id="textfield4" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>รูปภาพ</th>
    <td><input type="file" name="fileField" id="fileField" /></td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" /> 
      ชาย
</span> <span>
<input type="radio" name="radio" id="radio2" value="radio" /> 
หญิง
</span></td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี เกิด <span class="Txt_red_12">*</span></th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>สัญชาติ  </th>
    <td><input name="textfield14" type="text" id="textfield14" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ศาสนา  </th>
    <td><select name="select7" id="select6">
      <option>-- เลือกศาสนา --</option>
    </select></td>
  </tr>
  <tr>
    <th>ประเทศ  </th>
    <td><select name="select8" id="select7">
      <option>-- เลือกประเทศ --</option>
    </select></td>
  </tr>
  <tr>
    <th>สถานที่ทำงาน/สถานที่ติดต่อ<span class="Txt_red_12"> *</span></th>
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
    <select name="select2" id="select">
    </select>
    อำเภอ
    <select name="select3" id="select2">
    </select>
    ตำบล
    <select name="select4" id="select3">
    </select> 
    รหัสไปรณีย์
    <input name="textfield12" type="text" id="textfield12" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="textfield5" type="text" id="textfield5" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ</th>
    <td><input name="textfield6" type="text" id="textfield6" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ระดับการศึกษา
     </th>
    <td><select name="select5" id="select4">
      <option>-- เลือกระดับการศึกษา --</option>
    </select></td>
  </tr>
  <tr>
    <th>อาชีพ</th>
    <td><select name="select9" id="select8">
      <option>-- เลือกอาชีพ --</option>
    </select></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงานที่ปฏิบัติ</th>
    <td><input name="textfield15" type="text" id="textfield15" style="width:350px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ประเภทอาสาสมัคร <span class="Txt_red_12">*</span></th>
    <td><select name="select6" id="select5">
      <option>-- เลือกประเภทอาสาสมัคร --</option>
    </select></td>
  </tr>
  <tr>
    <th>ระยะเวลาที่ปฏิบัติงาน</th>
    <td><input name="textfield21" type="text" id="textfield21" style="width:30px;"/>
ปี</td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน
     </th>
    <td><span>
      <input type="radio" name="radio" id="radio5" value="radio" />
      หมู่บ้าน</span> <span>
<input type="radio" name="radio" id="radio6" value="radio" />
ตำบล</span><span>
<input type="radio" name="radio" id="radio7" value="radio" />
อำเภอ</span> <span>
<input type="radio" name="radio" id="radio8" value="radio" />
จังหวัด</span><br />
จังหวัด
      <select name="select10" id="select9">
      </select>
อำเภอ
<select name="select10" id="select10">
</select>
ตำบล
<select name="select10" id="select11">
</select>
หมู่บ้าน/ชุมชน    
<input name="textfield30" type="text" id="textfield36" style="width:150px;"/></td>
  </tr>
  <tr>
    <th>ประสบการณ์/ความสามารถพิเศษ</th>
    <td><textarea name="textfield24" rows="3" id="textfield24" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>ประกาศเกียรติคุณที่ได้รับ </th>
    <td><textarea name="textfield25" rows="3" id="textfield25" style="width:500px;"></textarea></td>
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