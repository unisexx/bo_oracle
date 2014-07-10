<h3>บันทึก คณะกรรมการ</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="คำสั่ง/ รายชื่อคณะกรรมการ" style="width:300px;" />
  <select name="select">
    <option>-- คณะกรรมการ --</option>
    <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ</option>
    <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
    <option>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมกรุงเทพมหานคร</option>
    <option>คณะกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    <option>คณะกรรมการติดตามและประเมินผลการดำเนินงานของกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
  </select>
  <select name="select2">
    <option>-- จังหวัด --</option>
</select>
  <select name="select3">
    <option selected="selected">-- สถานะ --</option>
    <option>ยังเป็นคณะกรรมการอยู่</option>
    <option>ไม่ได้เป็นคณะกรรมการแล้ว</option>
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
  <th align="left">คณะกรรมการ</th>
  <th align="left">จังหวัด</th>
  <th align="left">คำสั่ง</th>
  <th align="left">ลงวันที่</th>
  <th align="left">รายชื่อคณะกรรมการ</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด</td>
  <td nowrap="nowrap">ปราจีนบุรี</td>
  <td nowrap="nowrap">500/2556</td>
  <td nowrap="nowrap">13 กุมภาพันธ์ 2556</td>
  <td><img src="images/commitee.png" width="24" height="24" class="vtip" title="นางสาวจิตรา พรหมชุติมา <br>นายอรุณ พุมเพรา<br>นางจิตรา ภุมมะกาญจนะ" /></td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
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