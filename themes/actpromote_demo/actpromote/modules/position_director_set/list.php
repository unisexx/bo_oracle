<h3>ตั้งค่า ตำแหน่งในคณะกรรมการ </h3>
<div id="search">
<div id="searchBox">ชื่อตำแหน่งในคณะกรรมการ
  <input name="textfield" type="text" id="textfield" style="width:300px;" />
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
  <th align="left">ชื่อตำแหน่งในคณะกรรมการ</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">ประธาน</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>รองประธาน</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>3</td>
  <td>กรรมการ</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>4</td>
  <td>กรรมการและเลขานุการ</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td nowrap="nowrap" class="odd cursor">ผู้ช่วยเลขานุการ</td>
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