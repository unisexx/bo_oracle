<h3>การโอนเงินกองทุน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
    <td><select name="select3" id="select3">
      <option>-- เลือกปีงบประมาณ --</option>
    </select></td>
  </tr>
  <tr>
    <th>จังหวัด
     <span class="Txt_red_12">*</span></th>
    <td><select name="select" id="select">
      <option>-- เลือกจังหวัด --</option>
    </select></td>
  </tr>
  <tr>
    <th>กองทุนให้กู้ยืม <span class="Txt_red_12">*</span>  </th>
    <td><select name="select2" id="select2">
      <option>-- เลือกกองทุน --</option>
    </select></td>
  </tr>
  <tr>
    <th>เดือน <span class="Txt_red_12">*</span></th>
    <td><select name="select4" id="select4">
      <option>-- เลือกเดือน --</option>
    </select></td>
  </tr>
  <tr>
    <th>วันที่โอน <span class="Txt_red_12">*</span></th>
    <td><input name="textfield12" type="text" id="textfield12" style="width:70px;"/>
    <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>จำนวนเงิน <span class="Txt_red_12">*</span></th>
    <td><input type="text" name="textfield17" id="textfield26" /> 
      บาท</td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>