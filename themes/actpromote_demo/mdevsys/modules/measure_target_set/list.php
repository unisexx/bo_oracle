<h3>บันทึก หน่วยวัดและเป้าหมาย</h3>
<div id="search">
<div id="searchBox">
  <select name="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2556</option>
    <option>2557</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<!--<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>-->

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
  <th align="left">มิติที่</th>
  <th align="left">ชื่อมิติ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td>2556</td>
  <td nowrap="nowrap">1</td>
  <td nowrap="nowrap">ด้านประสิทธิผลตามยุทธศาสตร์</td>
  </tr>
<tr>
  <td>2</td>
  <td>2556</td>
  <td>2</td>
  <td>ด้านคุณภาพการให้บริการ</td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>2556</td>
  <td>3</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>4</td>
  <td>2556</td>
  <td>4</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>5</td>
  <td>2555</td>
  <td nowrap="nowrap" class="odd cursor">1</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
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