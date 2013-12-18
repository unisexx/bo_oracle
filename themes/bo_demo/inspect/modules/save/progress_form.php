<h3>บันทึกความคืบหน้าการดำเนินงานโครงการ (บันทึกการดำเนินการ)</h3>
<h4 style="margin-top:20px;">เขตที่ 1 > นนทบุรี > 2554 > โครงการกองทุนส่งเสริมการจัดสวัสดิการสังคม (งบประมาณทั้งโครงการ xxx,xxx,xxx บาท / เบิกจ่าย xxx,xxx บาท / คิดเป็นร้อยละ xx)</h4>
<table class="tblist">
<tr>
  <th align="left" width="3%">ลำดับ</th>
  <th align="left" width="25%">รายงานกิจกรรมหลัก / กิจกรรมย่อย</th>
  <th align="left" width="10%">ดำเนินการแล้ว</th>
  <th align="left" width="30%">ปัญหาและอุปสรรค</th>
  <th align="left" width="30%">แนวทางการแก้ไข</th>
  </tr>
<tr class="odd">
  <td valign="top">1</td>
  <td valign="top">ส่งเสริมและสนับสนุนการจัดกิจกรรมของสภาเด็กและเยาวชนทุกระดับ<strong> (กิจกรรมหลัก)</td>
  <td valign="top"><input type="checkbox" name="checkbox" id="checkbox" /></td>
  <td><textarea name="textarea4" id="textarea4" rows="3" style="width:100%"></textarea></td>
  <td><textarea name="textarea" id="textarea" rows="3" style="width:100%"></textarea></td>
</tr>
</table>


<h3>กิจกรรมย่อย</h3>

<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist2">
<tr>
  <th>ลำดับที่</th>
  <th>ชื่อกิจกรรมย่อย</th>
  <th>ลบ</th>
  </tr>

<tr class="odd">
  <td>1</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        
        <h3>กิจกรรมย่อย (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
        	<tr><th>กิจกรรมหลัก</th><td>ส่งเสริมและสนับสนุนการจัดกิจกรรมของสภาเด็กและเยาวชนทุกระดับ</td></tr>
          <tr>
          <th>กิจกรรมย่อย</th>
          <td><textarea name="textarea3" id="textarea3" rows="5" style="width:100%"></textarea></td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
</div>

<h3>เอกสาร</h3>

<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<table class="tblist2">
        <tr>
          <th align="left">ลำดับ</th>
          <th align="left">หัวข้อรายละเอียดแบบติดตาม</th>
          <th align="left">รายละเอียด </th>
          <th align="left">ไฟล์เอกสารที่แนบ</th>
          <th align="left">ลบ</th>
          </tr>
        <tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
          <td>1</td>
          <td nowrap="nowrap">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
<div id='inline_example2' style='padding:10px; background:#fff;'>
<h3>เอกสารประกอบ การทำกิจกรรม/โครงการ(เพิ่ม / แก้ไข)</h3>
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
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
</div>

<div class="paddT20"></div>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?#tabs-2'" class="btn_back"/>
</div>

