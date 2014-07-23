<h3>ตั้งค่า สิทธิ์การใช้ระบบ SAR CARD</h3>
<div id="search">
<div id="searchBox">ชื่อ-สกุล / Username
  <input name="textfield" type="text" id="textfield" size="50" />
  <select name="select">
    <option>-- ทุกประเภทสิทธิ์การใช้งาน --</option>
    <option>กพร.</option>
    <option>ผู้กำกับดูแลตัวชี้วัด</option>
    <option>ผู้จัดเก็บข้อมูล</option>
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
  <th align="left">Username</th>
  <th align="left">ชื่อ-สกุล</th>
  <th align="left">ตำแหน่ง</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">ประเภทสิทธิ์</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td>bsdhss</td>
  <td nowrap="nowrap">bsdhss bsdhss</td>
  <td>-</td>
  <td>สำนักงานปลัดกระทรวง (สป.) - กลุ่มพัฒนาระบบบริหาร</td>
  <td>กพร.</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>jarucha.l</td>
  <td>จารุชา ลิ้มแหลมทอง</td>
  <td>ผู้อำนวยการศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td>สำนักงานปลัดกระทรวง (สป.) - ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>
  <td>ผู้กำกับดูแลตัวชี้วัด</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>3</td>
  <td>thanaporn.p</td>
  <td>นางธนาภรณ์ พรมสุวรรณ</td>
  <td>ผู้อำนวยการสำนักนโยบายและยุทธศาสตร์ </td>
  <td>สำนักงานปลัดกระทรวง (สป.) - สำนักนโยบายและยุทธศาสตร์</td>
  <td>ผู้กำกับดูแลตัวชี้วัด</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>4</td>
  <td>kanchana.c</td>
  <td>กาญจนา ชื่นทองอร่าม</td>
  <td>-</td>
  <td>สำนักงานปลัดกระทรวง (สป.) - สำนักงานคณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ</td>
  <td>ผู้จัดเก็บข้อมูล</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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