<h3>บันทึก แบบฟอร์มผลการปฏิบัติงานกองทุนส่งเสริม (แบบกสส.๐๓)</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="โครงการ" style="width:300px;" />
  <select name="select">
    <option>-- ปี --</option>
  </select>
  <select name="select3">
    <option>-- ประเภทหน่วยงาน --</option>
  </select>
  <select name="select2">
    <option>-- จังหวัด --</option>
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
  <th align="left">โครงการ</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">จังหวัด</th>
  <th align="left">รายงานผลครั้งที่</th>
  <th align="left">วันที่ตรวจเยี่ยมโครงการ</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td>คลายทุกข์ เพิ่มสุขให้ครอบครัว อย่างพอประมาณ มีเหตุผล มีภูมิคุ้มกันที่ดี </td>
  <td nowrap="nowrap">องค์การบริหารส่วนตำบลหนองกรด</td>
  <td nowrap="nowrap">นครสวรรค์</td>
  <td nowrap="nowrap">2</td>
  <td>24/07/2556</td>
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
  <td>&nbsp;</td>
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