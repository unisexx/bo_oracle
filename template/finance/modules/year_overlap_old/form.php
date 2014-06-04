<h3>เงินกันเหลื่อมปี (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option selected="selected" value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<h5>เงื่อนไขการค้นหาข้อมูล</h5>
<div id="search">
<div id="searchBox">จำนวนเงินที่ขอกันเหลื่อมปี
  <input name="input3" type="text" />
  ถึง
  <input name="input4" type="text" /> 
  บาท
  <br />
  <select name="select10" id="select11">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <select name="select11" id="select12">
    <option>-- เลือกกรมที่รับผิดชอบ --</option>
    <option>2555</option>
    <option>2554</option>
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
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">กรม</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">กลุ่มงานผูกพันงบประมาณ</th>
  <th align="left">จำนวนผูกพัน</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form_add'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button4" id="button4" title="กันเหลื่อมปี" value=" " class="btn_overlap" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=formadd'" />    <input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button5" id="button5" title="กันเหลื่อมปี" value=" " class="btn_overlap" />    <input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td height="26">3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button6" id="button6" title="กันเหลื่อมปี" value=" " class="btn_overlap" />    <input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
</table>