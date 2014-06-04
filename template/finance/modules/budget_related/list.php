<h3>ผูกพันงบประมาณ </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
  <select name="select7" onchange="window.location.href=this.options[this.selectedIndex].value">
    <option selected="selected" value="budget_related.php">ผูกพันงบประมาณ</option>
    <option value="cost_related.php">ผูกผันค่าใช้จ่าย</option>
    <option value="withdraw_replace.php">เงินเบิกแทนกัน</option>
    <option value="receive_for_withdraw_replace.php">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
    <option value="year_overlap.php">เงินกันเหลื่อมปี</option>
    <option value="receive_year_overlap.php">รับเงินกันเหลือมปี</option>
    <option value="transfer_budget_change.php">โอนเปลี่ยนแปลงงบประมาณ</option>
    <option value="transfer_budget.php">โอนจัดสรรงบประมาณให้ พมจ</option>
    <option value="transfer_within.php">โอนภายในสำนัก</option>
  </select>
</div>
<div id="search">
  <div id="searchBox">
    เลขที่หนังสืออนุมัติหลักการ
      <input type="text" name="textfield" id="textfield" />
ช่วงที่ผูกพันงบประมาณ
<input name="textfield2" type="text" id="textfield2" size="10" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="textfield2" type="text" id="textfield3" size="10" />
<img src="../images/calendar.png" width="16" height="16" /><br />
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
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกประเภทงบประมาณ --</option>
  </select>
  <br />
  <select name="select4" id="select4" class="mustChoose">
    <option>-- เลือกกรม --</option>
  </select>
  <select name="select5" id="select5">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <select name="select6" id="select6">
    <option>-- ทุกกลุ่มงาน --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>

<div id="paging" class="paginationEMP">
<span class="nextprev">&laquo;previous</span>
<span class="current">1</span>
<span><a href="javascript:;">2</a></span>
<span><a href="javascript:;">3</a></span>
<span><a href="javascript:;">4</a></span>
<span><a href="javascript:;">next&raquo;</a></span>        
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">กรม</th>
  <th align="left">ผูกพันจำนวน</th>
  <th align="left">สถานะ</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">0213/1293ลว 30</td>
  <td>&nbsp;</td>
  <td>11 มีนาคม 2554</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>100,000.00</td>
  <td>ยืนยันแล้ว</td>
  <td>
    <input type="submit" name="button2" id="button2" title="คืนงบประมาณ" value=" " class="btn_return_budget vtip" />
    <input type="submit" name="button3" id="button3" title="ผูกพันหลักค่าใช้จ่าย" value=" " class="btn_costRelate vtip" />
    <input type="submit" name="button3" id="button3" title="ผูกพันหลักการอ้างอิงเลขเดิม" value=" " class="btn_bind vtip" />
    <input type="submit" name="button" id="button" title="ยกเลิกหลักการ" value=" " class="btn_delete vtip" />
    </td>
  </tr>
<tr>
  <td>2</td>
  <td nowrap="nowrap">014-1288 2554</td>
  <td>&nbsp;</td>
  <td>05 มีนาคม 2554</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>12,000.00</td>
  <td>ยังไม่ได้ยืนยัน</td>
  <td><input type="submit" name="button2" id="button2" title="คืนงบประมาณ" value=" " class="btn_return_budget vtip" />
  <input type="submit" name="button3" id="button3" title="ผูกพันหลักค่าใช้จ่าย" value=" " class="btn_costRelate vtip" />
    <input type="submit" name="button3" id="button3" title="แก้ไข (ยอดผูกผัน)" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ยกเลิกหลักการ" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td nowrap="nowrap">01-8856</td>
  <td>8789</td>
  <td>27 กุมภาพันธ์ 2554</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>35,000.00</td>
  <td>ยังไม่ได้ยืนยัน</td>
  <td><input type="submit" name="button2" id="button2" title="คืนงบประมาณ" value=" " class="btn_return_budget vtip" />
    <input type="submit" name="button3" id="button3" title="ผูกพันหลักค่าใช้จ่าย" value=" " class="btn_costRelate vtip" />
    <input type="submit" name="button3" id="button3" title="แก้ไข (ยอดผูกผัน)" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ยกเลิกหลักการ" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>

<div id="paging" class="paginationEMP">
<span class="nextprev">&laquo;previous</span>
<span class="current">1</span>
<span><a href="javascript:;">2</a></span>
<span><a href="javascript:;">3</a></span>
<span><a href="javascript:;">4</a></span>
<span><a href="javascript:;">next&raquo;</a></span>        
</div>