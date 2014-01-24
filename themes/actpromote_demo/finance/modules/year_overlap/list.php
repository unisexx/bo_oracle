<h3>เงินกันเหลื่อมปี </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
  <select name="select7" onchange="window.location.href=this.options[this.selectedIndex].value">
    <option value="budget_related.php">ผูกพันงบประมาณ</option>
    <option value="cost_related.php">ผูกผันค่าใช้จ่าย</option>
    <option value="withdraw_replace.php">เงินเบิกแทนกัน</option>
    <option value="receive_for_withdraw_replace.php">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
    <option selected="selected" value="year_overlap.php">เงินกันเหลื่อมปี</option>
    <option value="receive_year_overlap.php">รับเงินกันเหลือมปี</option>
    <option value="transfer_budget_change.php">โอนเปลี่ยนแปลงงบประมาณ</option>
    <option value="transfer_budget.php">โอนจัดสรรงบประมาณให้ พมจ</option>
    <option value="transfer_within.php">โอนภายในสำนัก</option>
  </select>
</div>
<div id="search">
  <div id="searchBox">เลขที่สำรองเงินกัน
    <input type="text" name="textfield" id="textfield" />
    ช่วงวันที่กันเงินเหลื่อมปี
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
  <th align="left">&nbsp;</th>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">กรม / หน่วยงาน / กลุ่มงาน</th>
  <th align="left">จำนวนผูกพัน</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>1</td>
  <td nowrap="nowrap">-</td>
  <td>พม 0206/5521</td>
  <td>30 กันยายน 2553</td>
  <td><span title="สำนักงานเลขานุการคณะกรรมการคุ้มครองเด็กแห่งชาติ / -" class="vtip">สำนักงานปลัดกระทรวง (สป.)</span></td>
  <td>9,240.00</td>
  <td><input type="submit" name="button4" id="button4" title="กันเหลื่อมปี" value=" " class="btn_overlap" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" /></td>
  </tr>
<tr class="boxSub">
  <td colspan="10">
  <table class="tblistSub">
<tr>
  <th align="left">เลขที่สำรองเงินกัน</th>
  <th align="left">วันที่กันเหลื่อมปี</th>
  <th align="left">เงินกันเหลื่อมปี</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td nowrap="nowrap">55555</td>
  <td>23 พฤษภาคม 2554</td>
  <td>9,240.00</td>
  <td><input type="submit" name="button" id="button" value="-" title="ยกเลิกรายการ" class="btn_cancel vtip" />
    <input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
</table>
  
  </td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button5" id="button5" title="กันเหลื่อมปี" value=" " class="btn_overlap" /></td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td height="26">3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button6" id="button6" title="กันเหลื่อมปี" value=" " class="btn_overlap" /></td>
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