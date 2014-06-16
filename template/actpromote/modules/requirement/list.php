<h3>บันทึก ข้อกำหนด/ระเบียบ/ประกาศ</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อพนักงานเจ้าหน้าที่/ โทรศัพท์/ อีเมล์" style="width:300px;" />
  <select name="select2">
    <option>-- ประเภทของกฎหมาย --</option>
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
  <th align="left">ชื่อเรื่อง</th>
  <th align="left">ไฟล์ที่ 1 </th>
  <th align="left">ไฟล์ที่ 2</th>
  <th align="left">ไฟล์ที่ 3</th>
  <th align="left">วันที่อัพเดต</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">นางลัดดาวัลย์ ไชยสงค์</td>
  <td nowrap="nowrap"><img src="images/downloadfile.png" width="22" height="22" /></td>
  <td nowrap="nowrap"><img src="images/downloadfile.png" alt="" width="22" height="22" /></td>
  <td nowrap="nowrap"><img src="images/downloadfile.png" alt="" width="22" height="22" /></td>
  <td nowrap="nowrap">19 ส.ค. 2010</td>
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