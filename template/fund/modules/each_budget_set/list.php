<h3>ตั้งค่า งบประมาณแต่ละจังหวัด</h3>
<div id="search">
<div id="searchBox">
  <select name="select3" id="select3" class="mustChoose">
      <option>-- ทุกปีงบประมาณ --</option>
    </select>
    <select name="select" id="select" class="mustChoose">
      <option>-- ทุกจังหวัด --</option>
    </select>
    <select name="select2" id="select2">
      <option>-- ทุกกองทุน --</option>
      <option>กองทุน ทปศ. 3</option>
      <option>กองทุนคุ้มครองเด็ก</option>
      <option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
      <option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
      <option>กองทุนเลิกจ้างว่างงาน 400 ล้าน</option>
      <option>กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
      <option>เงินอุดหนุนองค์การสวัสดิการสังคมภาคเอกชน</option>
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
  <th align="left">กองทุน</th>
  <th align="left">งบประมาณ</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
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
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>4</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
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