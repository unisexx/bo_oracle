<h3>โอนเปลี่ยนแปลงงบประมาณ</h3>
<div class="link_budget_related">ค้นหาข้อมูล 
  <select name="select7" onchange="window.location.href=this.options[this.selectedIndex].value">
    <option value="budget_related.php">ผูกพันงบประมาณ</option>
    <option value="cost_related.php">ผูกผันค่าใช้จ่าย</option>
    <option value="withdraw_replace.php">เงินเบิกแทนกัน</option>
    <option value="receive_for_withdraw_replace.php">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
    <option value="year_overlap.php">เงินกันเหลื่อมปี</option>
    <option value="receive_year_overlap.php">รับเงินกันเหลือมปี</option>
    <option selected="selected" value="transfer_budget_change.php">โอนเปลี่ยนแปลงงบประมาณ</option>
    <option value="transfer_budget.php">โอนจัดสรรงบประมาณให้ พมจ</option>
    <option value="transfer_within.php">โอนภายในสำนัก</option>
  </select>
</div>
<div id="search">
  <div id="searchBox">เลขที่หนังสือ พม.
    <input type="text" name="textfield" id="textfield" />
    ช่วงวันที่
    <input name="textfield2" type="text" id="textfield2" size="10" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="textfield2" type="text" id="textfield3" size="10" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<select name="select" id="select">
      <option>-- เลือกปีงบประมาณ --</option>
    </select>
<select name="select4" id="select4">
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
  <th align="left">เลขที่หนังสือ พม.</th>
  <th align="left">รายการ</th>
  <th align="left">วันที่โอนเปลี่ยนแปลง</th>
  <th align="left">จำนวนเงินโอน</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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