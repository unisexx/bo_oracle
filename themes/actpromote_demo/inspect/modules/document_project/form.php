<h3>บันทึก เอกสารประกอบ การทำกิจกรรม/โครงการ (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
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
  <th>กิจกรรมโครงการ</th>
  <td><select name="select5" id="select5">
    <option>-- เลือกกิจกรรมโครงการ --</option>
    </select></td>
</tr>
<tr>
  <th>กิจกรรมโครงการย่อย</th>
  <td><select name="select6" id="select6">
    <option>-- เลือกกิจกรรมโครงการย่อย --</option>
  </select></td>
</tr>
<tr>
  <th>รายการย่อย<span class="Txt_red_12">  *<br />
    <br />
    <input type="button" title="เพิ่มรายการ" value=" " class="btn_addmore" />
    
  </span></th>
  <td>
  <table width="100%">
  <tr>
  <td style="width:33%">หัวข้อรายละเอียดแบบติดตาม<br />
    <textarea name="textarea" id="textarea" cols="35" rows="4"></textarea></td>
  <td style="width:33%"> รายละเอียด<br />
    <textarea name="textarea2" id="textarea2" cols="35" rows="4"></textarea></td>
  <td style="width:33%" valign="top">แนบไฟล์เอกสารอ้างอิง / หลักฐาน<br />
    <input name="fileField" type="file" id="fileField" size="30" /></td>
  </tr>
  </table>
  
   </td>
</tr>
</table>

<div class="paddT20"></div>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>