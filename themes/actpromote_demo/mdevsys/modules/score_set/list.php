<h3>ตั้งค่า คะแนนผลประเมิน</h3>
<!--<div id="search">
<div id="searchBox">ชื่อประเด็นการประเมินผล
  <input name="textfield" type="text" id="textfield" size="50" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>-->

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
  <th align="left">ปีงบประมาณ</th>
  <th align="left"><img src="images/circle_red.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="images/circle_pink.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="images/circle_yellow.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="images/circle_lgreen.png" alt="" width="16" height="16" /></th>
  <th align="left"><img src="images/circle_green.png" alt="" width="16" height="16" /></th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">2556</td>
  <td nowrap="nowrap">0.00 - 1.49</td>
  <td nowrap="nowrap">1.50 - 2.49</td>
  <td nowrap="nowrap">2.50 - 3.49</td>
  <td nowrap="nowrap">3.50 - 4.49</td>
  <td nowrap="nowrap">4.50 - 5.00</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>2555</td>
  <td>0.00 - 1.49</td>
  <td>1.50 - 2.49</td>
  <td>2.50 - 3.49</td>
  <td>3.50 - 4.49</td>
  <td>4.50 - 5.00</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>3</td>
  <td>2554</td>
  <td nowrap="nowrap" class="odd cursor">0.00 - 1.49</td>
  <td nowrap="nowrap" class="odd cursor">1.50 - 2.49</td>
  <td nowrap="nowrap" class="odd cursor">2.50 - 3.49</td>
  <td nowrap="nowrap" class="odd cursor">3.50 - 4.49</td>
  <td nowrap="nowrap" class="odd cursor">4.50 - 5.00</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>4</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
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