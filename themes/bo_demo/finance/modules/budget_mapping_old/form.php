<h3>Mapping เงินงบประมาณ (เพิ่ม / แก้ไข)</h3>
<h5>เงื่อนไขการค้นหาข้อมูล (ข้อมูลจากเงินพลาง)</h5>
<div id="search">
<div id="searchBox">
  เลขที่หนังสืออนุมัติเบิกเงิน 
    <input name="input3" type="text" />
<select name="select6" id="select9" class="mustChoose">
    <option>-- เลือกประเภท Mapping --</option>
    <option>Mapping ยอดคงเหลือ</option>
    <option>Mapping รายการอนุมัติเบิก</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <br />
  <select name="select4" id="select4" class="mustChoose">
    <option selected="selected">-- เลือกกรมที่รับผิดชอบ --</option>
    <option>กรมพัฒนาสังคมและสวัสดิการ</option>
    <option>สำนักงานรัฐมนตรี</option>
    <option>สำนักงานปลัดกระทรวง</option>
  </select>
  <select name="select7" id="select10">
    <option selected="selected">-- ทุกหน่วยงาน (กอง/สำนัก) --</option>
    <option>ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</option>
    <option>สำนักมาตรฐานการพัฒนาสังคมและความมั่นคงของมนุษย์</option>
  </select>
  <select name="select2" id="select2">
    <option selected="selected">-- ทุกกลุ่มงาน (กลุ่ม/ฝ่าย) --</option>
    <option>ฝ่ายบริหารทั่วไป</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">แผนงาน</th>
  <th align="left">ผลผลิต</th>
  <th align="left">กิจกรรมหลัก</th>
  <th align="left">กิจกรรมย่อย</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">สถานะ</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td nowrap="nowrap">2555</td>
  <td>สวัสดิการสังคมและความมั่นคงของมนุษย์</td>
  <td>A</td>
  <td>B</td>
  <td>C</td>
  <td>10,000</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button4" id="button4" title="mapping" value=" " class="btn_mapping" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form_mapping'" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button" id="button" title="mapping" value=" " class="btn_mapping" /></td>
  </tr>
<tr class="odd">
  <td height="26">3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button2" id="button2" title="mapping" value=" " class="btn_mapping" /></td>
  </tr>
</table>