<h3>ตั้งค่า กรม</h3>
<div id="search">
<div id="searchBox">ชื่อกรม
  <input name="input" type="text" size="40" />
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
  <th align="left">ชื่อกรม</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">สำนักงานรัฐมนตรี</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>สำนักงานปลัดกระทรวง</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>สำนักงานกิจการสตรีและสถานบันครอบครัว</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>กรมพัฒนาสังคมและสวัสดิการ</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td align="left">สำนักงานส่งเสริมสวัสดิภาพและพิทักษ์เด็ก    เยาวชน ผู้ด้อยโอกาส และผู้สูงอายุ</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td align="left" class="odd">สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td align="left">องค์การมหาชน</td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>8</td>
  <td align="left">รัฐวิสาหกิจ</td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td align="left">ราชการบริหารส่วนภูมิภาค</td>
  <td><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
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