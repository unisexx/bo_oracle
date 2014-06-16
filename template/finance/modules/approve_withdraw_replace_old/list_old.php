<h3>อนุมัติเบิกเงินแทนกัน</h3>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติเบิกเงิน
    <input type="text" name="textfield" id="textfield" />
    ช่วงเวลา
    <input name="textfield2" type="text" id="textfield2" size="10" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="textfield2" type="text" id="textfield3" size="10" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<select name="select" id="select" class="mustChoose">
      <option>-- เลือกปีงบประมาณ --</option>
      <option>2555</option>
      <option>2554</option>
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
  <th align="left">รายการ</th>
  <th align="left">เลขที่เบิกเงิน</th>
  <th align="left">วันที่ทำรายการ</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>-</td>
  <td>13 ตุลาคม 2553</td>
  <td>9,000.00</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>-</td>
  <td>14 ตุลาคม 2553</td>
  <td>9,700.00</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>&nbsp;</td>
  <td>-</td>
  <td>18 ตุลาคม 2553</td>
  <td>11,000.00</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
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