<h3>รายงาน สถานะงบประมาณ</h3>
<div id="search">
<div id="searchBox">ช่วงวันที่
  <input name="textfield2" type="text" id="textfield2" size="10" />
  <img src="../images/calendar.png" width="16" height="16" /> ถึง
  <input name="textfield" type="text" id="textfield3" size="10" />
  <img src="../images/calendar.png" width="16" height="16" />
  <select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <select name="select2" id="select2" class="mustChoose">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select>
  <br />
  <select name="select7" id="select7" class="mustChoose">
    <option>-- เลือกประเภทงบประมาณ --</option>
    <option>งบประมาณต้นปี</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกแผนงบประมาณ --</option>
  </select>
  <select name="select8" id="select8" class="mustChoose">
    <option>-- เลือกผลผลิต --</option>
  </select>
  <br />
  <select name="select9" id="select9">
    <option>-- เลือกกิจกรรมหลัก --</option>
  </select>
  <select name="select10" id="select10">
    <option>-- เลือกกิจกรรมย่อย --</option>
  </select>
  <br />
  <select name="select4" id="select4" class="mustChoose">
    <option>-- เลือกกรมที่รับผิดชอบ --</option>
  </select>
  <select name="select5" id="select5">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <select name="select6" id="select6">
    <option>-- ทุกกลุ่มงาน --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
<div id="btnBox"><input type="button" title="พิมพ์ข้อมูล" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_printer" style="margin-right:10px;"/>
<input type="button" title="ส่งออกข้อมูล" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_excel"/></div>

<table class="tblist2">
<tr>
  <th align="left"><span style="text-align:left">หมวดงบประมาณ</span></th>
  <th align="left"><span style="text-align:left">หมวดค่าใช้จ่าย</span></th>
  <th align="left">งบจัดสรร</th>
  <th align="left">ผูกพัน</th>
  <th align="left">อนุมัติเบิก</th>
  <th align="left">โอนเปลี่ยนแปลง</th>
  <th align="left">โอนจัดสรร</th>
  <th align="left">โอนภายในสำนัก/กรม</th>
  <th align="left">กันเบิกแทน</th>
  <th align="left">คงเหลือ</th>
  </tr>
<tr class="odd">
  <td>งบบุคลากร</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">เงินเดือน</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าจ้างประจำ</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าจ้างชั่วคราว</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าจ้างลูกจ้างสัญญาจ้าง</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าตอบแทนพนักงานราชการ</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr class="odd" >
  <td>งบดำเนินงาน</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าตอบแทน</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าใช้สอย</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าวัสดุ</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">ค่าสาธารณูปโภค</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr class="odd" >
  <td>งบลงทุน</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">งบลงทุน ครุภัณฑ์</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td nowrap="nowrap">งบลงทุน ที่ดิน อาคาร/สิ่งก่อสร้าง</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr class="total">
  <td colspan="2"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
