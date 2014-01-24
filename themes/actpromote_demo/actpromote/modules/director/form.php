<h3>บันทึก คณะกรรมการ (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>คณะกรรมการ<span class="Txt_red_12"> *</span></th>
    <td><select name="select">
      <option selected="selected">-- เลือกประเภทคณะกรรมการ --</option>
      <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ</option>
      <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
      <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมกรุงเทพมหานคร</option>
      <option>คณะกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
      <option>คณะกรรมการติดตามและประเมินผลการดำเนินงานของกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    </select></td>
  </tr>
  <tr>
    <th>จังหวัด<span class="Txt_red_12"> *</span></th>
    <td><select name="select7">
      <option>-- เลือกจังหวัด --</option>
    </select></td>
  </tr>
  <tr>
    <th>แต่งตั้งตามคำสั่งที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ลงวันที่<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>สถานะ<span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" /> 
      ยังเป็นคณะกรรมการอยู่
</span> <span>
<input type="radio" name="radio" id="radio2" value="radio" /> 
ไม่ได้เป็นคณะกรรมการแล้ว
</span></td>
  </tr>
</table>

<h3>รายชื่อคณะกรรมการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ชื่อคณะกรรมการ</th>
<th>ที่อยู่</th>
<th>โทรศัพท์</th>
<th>แฟกซ์</th>
<th>อีเมล์</th>
<th>ประเภทกรรมการ</th>
<th>ตำแหน่งในคณะกรรมการ</th>
<th>ตำแหน่งหน้าที่การงาน</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>นายมงคล ตีระวรานันท์ </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>ผู้แทนองค์กรสวัสดิการชุมชน</td>
<td>รองประธานกรรมการ</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>



<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<h3>รายชื่อคณะกรรมการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
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
  <th>ตำแหน่งในคณะกรรมการ</th>
  <td><select name="select3" id="select2">
    <option>-- ตำแหน่งในคณะกรรมการ --</option>
  </select></td>
</tr>
<tr>
  <th><label for="fid-full_name3">ประเภทกรรมการ</label>
     </th>
  <td><select name="select4" id="select3">
    <option>-- ประเภทกรรมการ --</option>
  </select></td>
</tr>
<tr>
  <th><label for="fid-full_name4">ชื่อหน่วยงานที่สังกัด</label>
     </th>
  <td><input name="textfield6" type="text" id="textfield6" style="width:250px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
</tr>
<tr>
  <th>ตำแหน่งหน้าที่การงาน</th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:250px;"/></td>
</tr>
<tr>
  <th>สถานที่ทำงาน/สถานที่ติดต่อ</th>
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
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>