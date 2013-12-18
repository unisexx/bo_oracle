<h3>รายงาน คืนงบประมาณค้างเบิก</h3>
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
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
<div id="btnBox"><input type="button" title="พิมพ์ข้อมูล" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_printer" style="margin-right:10px;"/>
<input type="button" title="ส่งออกข้อมูล" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_excel"/></div>

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
  <th align="left">วันที่คืนงบประมาณ</th>
  <th align="left">รายการ</th>
  <th align="left">จำนวนเงิน (บาท)</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
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