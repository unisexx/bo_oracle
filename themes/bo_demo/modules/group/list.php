<h3>ตั้งค่า กลุ่มงาน (กลุ่ม/ฝ่าย)</h3>
<div id="search">
<div id="searchBox">
ชื่อกลุ่มงาน
  <input name="input" type="text" size="40" />

  <select name="select2" id="select2">
    <option>-- ทุกกรม --</option>
  </select>
  <select name="select" id="select">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>

<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/>
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
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อกลุ่มงาน</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">กรม</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">ฝ่ายบริหารทั่วไป</td>
  <td nowrap="nowrap">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td nowrap="nowrap">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td align="left" width="395">กลุ่มการพัฒนาระบบเทคโนโลยี</td>
  <td align="left" width="395">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td>สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td align="left">กลุ่มการพัฒนาระบบสารสนเทศและการสื่อสาร</td>
  <td nowrap="nowrap" class="odd cursor">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td>สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td align="left">กลุ่มการวิเคราะห์ข้อมูล</td>
  <td width="395" align="left">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td>สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td align="left">ฝ่ายบริหารทั่วไป</td>
  <td align="left">สำนักนโยบายและยุทธศาสตร์</td>
  <td>สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td align="left">กลุ่มนโยบายและแผน</td>
  <td align="left">สำนักนโยบายและยุทธศาสตร์</td>
  <td align="left" width="503">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td align="left">กลุ่มยุทธศาสตร์</td>
  <td align="left">สำนักนโยบายและยุทธศาสตร์</td>
  <td align="left">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>8</td>
  <td align="left">กลุ่มงบประมาณ</td>
  <td align="left">สำนักนโยบายและยุทธศาสตร์</td>
  <td align="left">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td align="left">กลุ่มวิเทศสัมพันธ์</td>
  <td align="left">สำนักนโยบายและยุทธศาสตร์</td>
  <td align="left">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>10</td>
  <td align="left">ฝ่ายบริหารทั่วไป</td>
  <td align="left">กองเผยแพร่และประชาสัมพันธ์</td>
  <td align="left">สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button10" id="button10" value="x" class="btn_delete" /></td>
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