<h3>Mapping เงินงบประมาณ</h3>
<div id="search">
<div id="searchBox">
  <select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- ทุกกรม --</option>
  </select>
  <select name="select4" id="select4">
    <option>-- ทุกหน่วยงาน (กอง/สำนัก) --</option>
  </select>
  <select name="select2" id="select2">
    <option>-- ทุกกลุ่มงาน (กลุ่ม/ฝ่าย) --</option>
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
  <th>&nbsp;</th>
  <th>ลำดับ</th>
  <th>ปีงบประมาณ</th>
  <th>แผนงาน</th>
  <th>ผลผลิต</th>
  <th>กิจกรรมหลัก</th>
  <th>กิจกรรมย่อย</th>
  <th>จำนวนเงิน</th>
  <th>จัดการ</th>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>1</td>
  <td nowrap="nowrap" class="odd">2555</td>
  <td class="odd">สวัสดิการสังคมและความมั่นคงของมนุษย์</td>
  <td class="odd">A</td>
  <td class="odd">B</td>
  <td class="odd">C</td>
  <td>100,000</td>
  <td><input type="submit" name="button2" id="button2" title="mapping" value=" " class="btn_mapping" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" /></td>
  </tr>
<tr class="boxSub">
<td colspan="9">
<table class="tblistSub">
<tr>
  <th>ลำดับ</th>
  <th>ประเภท Mapping / รายการ</th>
  <th>จำนวนเงิน</th>
  <th>สถานะ</th>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td><strong>ยอดคงเหลือ</strong></td>
  <td><strong>80,000</strong></td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>1.1</td>
  <td>ผูกผันแล้ว</td>
  <td>20,000</td>
  <td>รอ</td>
  </tr>

<tr>
  <td>1.2</td>
  <td>ผูกผันแล้ว</td>
  <td>10,000</td>
  <td>รอ</td>
  </tr>
<tr>
  <td>1.3</td>
  <td>ผูกผันแล้ว</td>
  <td>20,000</td>
  <td>รอ</td>
  </tr>
<tr>
  <td>1.4</td>
  <td>ยังไม่ผูกผัน</td>
  <td>30,000</td>
  <td>เรียบร้อย</td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td><strong>รายการอนุมัติเบิก</strong></td>
  <td><strong>20,000</strong></td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>2.1</td>
  <td>&nbsp;</td>
  <td>5,000</td>
  <td>รอ</td>
  </tr>
<tr>
  <td>2.2</td>
  <td>&nbsp;</td>
  <td>5,000</td>
  <td>รอ</td>
  </tr>
<tr>
  <td>2.3</td>
  <td>&nbsp;</td>
  <td>1,000</td>
  <td>เรียบร้อย</td>
  </tr>
</table>
  </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>2</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td>3</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>4</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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