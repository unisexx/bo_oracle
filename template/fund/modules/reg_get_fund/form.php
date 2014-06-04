<h3>ทะเบียนบุคคลขอรับเงินกองทุน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>กองทุน <span class="Txt_red_12">*</span></th>
    <td><select name="select4" id="select">
      <option selected="selected">-- เลือกกองทุน --</option>
      <option>กองทุนคุ้มครองเด็ก</option>
      <option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
      <option>กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
</select></td>
  </tr>
  <tr>
    <th>เลขบัตรประชาชน</th>
    <td><input name="textfield5" type="text" id="textfield5" style="width:150px;" maxlength="13"/></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
    <td><select name="select3" id="select3">
      <option>-- คำนำหน้า --</option>
    </select>
    <input type="text" name="textfield" id="textfield" placeholder="ชื่อ" />
    <input type="text" name="textfield2" id="textfield2" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12">*</span></th>
    <td><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
      ชาย </span> <span>
        <input type="radio" name="radio" id="radio4" value="radio" />
        หญิง </span></td>
  </tr>
  <tr>
    <th>วันเกิด <span class="Txt_red_12">*</span></th>
    <td><input name="textfield12" type="text" id="textfield12" style="width:70px;"/>
    <img src="../images/calendar.png" alt="" width="16" height="16" /> อายุ
    <input name="textfield23" type="text" id="textfield32" style="width:50px;" readonly="readonly"/> 
    ปี</td>
  </tr>
  <tr>
    <th>ที่อยู่ <span class="Txt_red_12">*</span></th>
    <td>เลขที่
      <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
      หมู่ที่
      <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
      ตรอก
      <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
      <br />
      ซอย
      <input name="textfield3" type="text" id="textfield3" style="width:200px;"/>
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
      </select></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12">*</span></th>
    <td><input name="textfield4" type="text" id="textfield4" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อที่ทำงาน</th>
    <td><input name="textfield14" type="text" id="textfield23" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ที่อยู่ที่ทำงาน</th>
    <td>เลขที่
      <input name="textfield7" type="text" id="textfield17" style="width:50px;"/>
      หมู่ที่
      <input name="textfield7" type="text" id="textfield18" style="width:30px;"/>
      ตรอก
      <input name="textfield7" type="text" id="textfield19" style="width:200px;"/>
      <br />
      ซอย
      <input name="textfield7" type="text" id="textfield20" style="width:200px;"/>
      ถนน
      <input name="textfield7" type="text" id="textfield21" style="width:200px;"/>
      <br />
      จังหวัด
      <select name="select6" id="select10">
      </select>
      อำเภอ
      <select name="select6" id="select11">
      </select>
      ตำบล
      <select name="select6" id="select12">
      </select></td>
  </tr>
  <tr>
    <th>โทรศัพท์ที่ทำงาน</th>
    <td><input name="textfield15" type="text" id="textfield24" style="width:200px;"/></td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>