<h3>คืนเงินงบประมาณ</h3>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติหลักการ
    <input type="text" name="textfield" id="textfield" />
เลขที่หนังสืออนุมัติค่าใช้จ่าย
<input type="text" name="textfield3" id="textfield4" />
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

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=list_return'" class="btn_add"/></div>

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
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th>วันที่ทำรายการ</th>
  <th>รายการ</th>
  <th style="text-align:right;">จำนวนเงิน</th>
  <th style="text-align:right;">คืนงบประมาณจำนวน</th>
  <th style="text-align:center;">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>พม 0206/0018</td>
  <td>19 ตุลาคม 2553</td>
  <td>&nbsp;</td>
  <td align="right">14,720.00</td>
  <td align="right">26,410.00</td>
  <td align="center"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>พม 0210/0350</td>
  <td>08 พฤศจิกายน 2553</td>
  <td>&nbsp;</td>
  <td align="right">13,920.00</td>
  <td align="right">13,920.00</td>
  <td align="center"><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>&nbsp;</td>
  <td>พม 0210/0351</td>
  <td>08 พฤศจิกายน 2553</td>
  <td>&nbsp;</td>
  <td align="right">6,768.00</td>
  <td align="right">6,768.00</td>
  <td align="center"><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>&nbsp;</td>
  <td>พม 0206/0013</td>
  <td>08 เมษายน 2554</td>
  <td>&nbsp;</td>
  <td align="right">3,220.00</td>
  <td align="right">120.00</td>
  <td align="center"><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>8</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>10</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="center"><input type="submit" name="button10" id="button10" value="x" class="btn_delete" /></td>
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