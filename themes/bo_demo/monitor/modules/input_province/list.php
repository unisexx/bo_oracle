<h3>สอบถาม การกรอกข้อมูลแต่ละจังหวัด</h3>
<div id="search">
<div id="searchBox">
  <select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกเดือน --</option>
  </select>
  <select name="select2" id="select2" class="mustChoose">
    <option selected="selected">-- ทุกสถานะ --</option>
    <option>กรอกข้อมูลแล้ว</option>
    <option>ยังไม่ได้กรอกข้อมูล</option>
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
  <th align="left">จังหวัด</th>
  <th align="left">สถานะ</th>
  <th align="left">เมื่อวันที่</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td nowrap="nowrap">กรุงเทพมหานคร</td>
  <td><img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" /></td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>2</td>
  <td>สมุทรปราการ</td>
  <td><img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" /></td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td>3</td>
  <td>นนทบุรี</td>
  <td><img src="images/ico_input_ok.png" width="24" height="24" title="กรอกข้อมูลแล้ว" class="vtip" /></td>
  <td>24 มิถุนายน 2554</td>
  </tr>
<tr>
  <td>4</td>
  <td>ปทุมธานี</td>
  <td><img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" /></td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>6</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>7</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>8</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>9</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>10</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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