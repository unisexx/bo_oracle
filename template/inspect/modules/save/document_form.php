<h3>บันทึก เอกสารประกอบ การทำกิจกรรม/โครงการ (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
<h4 style="margin-top:20px;">เขตที่ 1 > นนทบุรี > 2554 > โครงการกองทุนส่งเสริมการจัดสวัสดิการสังคม</h4>
<table class="tbadd">
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
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?#tabs-3'" class="btn_back"/>
</div>