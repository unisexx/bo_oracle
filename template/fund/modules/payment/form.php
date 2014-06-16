<h3>การชำระเงิน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>จังหวัด
     </th>
    <td><select name="select" id="select">
      <option>-- เลือกจังหวัด --</option>
    </select></td>
  </tr>
  <tr>
    <th>กองทุนให้กู้ยืม
     </th>
    <td><select name="select2" id="select2">
      <option>-- เลือกกองทุน --</option>
    </select></td>
  </tr>
  <tr>
    <th>ชื่อ - นามสกุล</th>
    <td><input name="textfield" type="text" id="textfield" style="width:350px;"/>
    <img src="images/see.png" width="24" height="24" /> <span class="note">ดึงมาจากตารางทะเบียนลูกหนี้</span></td>
  </tr>
  <tr>
    <th>วันที่ชำระ</th>
    <td><input name="textfield12" type="text" id="textfield12" style="width:70px;"/>
    <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>ใบเสร็จรับเงิน (เล่มที่/เลขที่)</th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:30px;"/> 
      / 
      <input name="textfield3" type="text" id="textfield3" style="width:30px;"/></td>
  </tr>
  <tr>
    <th>จำนวนเงิน</th>
    <td><input type="text" name="textfield17" id="textfield26" /> 
      บาท</td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>