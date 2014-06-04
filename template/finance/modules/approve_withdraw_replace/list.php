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
  <th>&nbsp;</th>
  <th>ลำดับ</th>
  <th>รายการ</th>
  <th>เลขที่เอกสารการเบิกแทน</th>
  <th>วันที่ทำรายการ</th>
  <th>จำนวนเงิน</th>
  <th>จัดการ</th>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>1</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>18 ตุลาคม 2553</td>
  <td>9,000.00</td>
  <td>เรียบร้อย</td>
  </tr>
<tr class="boxSub">
<td colspan="7">
<table class="tblistSub">
<tr>
  <th>ลำดับ</th>
  <th>รายการ</th>
  <th>เลขที่เบิกเงิน</th>
  <th>วันที่ทำรายการ</th>
  <th>จำนวนเงิน</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td>1.1</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>18 ตุลาคม 2553</td>
  <td>5,000.00</td>
  </tr>
<tr>
  <td>1.2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>18 ตุลาคม 2553</td>
  <td>4,000.00</td>
  </tr>
</table>
</td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>14 ตุลาคม 2553</td>
  <td>9,700.00</td>
  <td><input type="submit" name="button2" id="button2" title="อนุุมัติเบิกเงิน" value=" " class="btn_approve cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" /></td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td>3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>13 ตุลาคม 2553</td>
  <td>11,000.00</td>
  <td><input type="submit" name="button" id="button" title="อนุุมัติเบิกเงิน" value=" " class="btn_approve cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" /></td>
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