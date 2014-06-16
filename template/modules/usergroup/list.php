<h3>ตั้งค่า สิทธิ์การใช้งาน</h3>
<div id="search">
<div id="searchBox">ชื่อสิทธิ์การใช้งาน 
  <input name="input" type="text" size="30" />
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
  <th align="left">ชื่อสิทธิ์การใช้งาน</th>
  <th align="left">การใช้ระบบงาน</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td>Super Admin (ศทส.) </td>
  <td>ระบบคำของบประมาณ, ระบบงานการคลัง, ระบบงานติดตามและประเมินผล, ระบบงานตรวจสอบราชการ</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>Admin (ศทส.)</td>
  <td>ระบบคำของบประมาณ, ระบบงานการคลัง, ระบบงานติดตามและประเมินผล, ระบบงานตรวจสอบราชการ</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>Admin (คำของบประมาณ)</td>
  <td>ระบบคำของบประมาณ</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>Admin (งานการคลัง)</td>
  <td>ระบบงานการคลัง</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>Admin (ติดตามและประเมินผล)</td>
  <td>ระบบงานติดตามและประเมินผล</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td>Admin (ตรวจสอบราชการ)</td>
  <td>ระบบงานตรวจสอบราชการ</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td><span id="result_box" lang="en" xml:lang="en"><span title="คลิกเพื่อดูคำแปลอื่น"><span id="result_box2" lang="en" xml:lang="en"><span title="คลิกเพื่อดูคำแปลอื่น">Director</span></span> (คำของบประมาณ)</span></span></td>
  <td>ระบบคำของบประมาณ</td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>8</td>
  <td>User (คำของบประมาณ)</td>
  <td>ระบบคำของบประมาณ</td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
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