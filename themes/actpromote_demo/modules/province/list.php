<h3>ตั้งค่า จังหวัด</h3>
<div id="search">
<div id="searchBox">
ชื่อจังหวัด
  <input name="input" type="text" size="30" />
  <select name="select" id="select">
    <option>กรุณาเลือกภาค</option>
  </select>
  <select name="select2" id="select2">
    <option>กรุณาเลือกกลุ่มภาค</option>
  </select>
  <select name="select3" id="select3">
    <option>กรุณาเลือกเขตจังหวัด</option>
  </select>
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
  <th align="left">ชื่อจังหวัด</th>
  <th align="left">เขตจังหวัด</th>
  <th align="left">กลุ่มภาค</th>
  <th align="left">ภาค</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">กระบี่</td>
  <td>เขตที่ 5</td>
  <td>กลุ่มภาคใต้ </td>
  <td nowrap="nowrap">ภาคใต้ </td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>กรุงเทพมหานคร</td>
  <td>เขตตรวจราชการส่วนกลาง</td>
  <td>&nbsp;</td>
  <td>กรุงเทพปริมณฑล</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>กาญจนบุรี</td>
  <td>เขตที่ 10</td>
  <td>กลุ่มภาคกลางตอนล่าง </td>
  <td nowrap="nowrap"> ภาคตะวันตก </td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>กาฬสินธุ์</td>
  <td>เขตที่ 12</td>
  <td>กลุ่มภาคตะวันออกเฉียงเหนือตอนบน </td>
  <td nowrap="nowrap"> ภาคตะวันออกเฉียงเหนือ </td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>กำแพงเพชร</td>
  <td>เขตที่ 11</td>
  <td>กลุ่มภาคเหนือตอนล่าง </td>
  <td nowrap="nowrap"> ภาคเหนือ </td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td>ขอนแก่น</td>
  <td class="odd">เขตที่ 12</td>
  <td>กลุ่มภาคตะวันออกเฉียงเหนือตอนบน </td>
  <td nowrap="nowrap"> ภาคตะวันออกเฉียงเหนือ </td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td>จันทบุรี</td>
  <td>เขตที่ 7</td>
  <td>กลุ่มภาคตะวันออก </td>
  <td nowrap="nowrap"> ภาคตะวันออก </td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>8</td>
  <td>ฉะเชิงเทรา</td>
  <td>เขตที่ 8</td>
  <td>กลุ่มภาคกลางตอนล่าง </td>
  <td nowrap="nowrap"> ภาคตะวันออก </td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td>ชลบุรี</td>
  <td>เขตที่ 5</td>
  <td>กลุ่มภาคตะวันออก</td>
  <td nowrap="nowrap"> ภาคตะวันออก </td>
  <td><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>10</td>
  <td>ชัยนาท</td>
  <td>เขตที่ 15</td>
  <td>กลุ่มภาคกลางตอนบน </td>
  <td nowrap="nowrap"> ภาคกลาง </td>
  <td><input type="submit" name="button9" id="button10" value="x" class="btn_delete" /></td>
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