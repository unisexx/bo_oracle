<h3>อนุมัติเบิกเงิน (เบิกเงิน)</h3>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติหลักการ
    <input name="textfield" type="text" id="textfield" size="15" />
    เลขที่หนังสืออนุมัติค่าใช้จ่าย
    <input name="textfield3" type="text" id="textfield4" size="15" />
ช่วงที่อนุมัติเบิกเงิน
<input name="textfield2" type="text" id="textfield2" size="10" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="textfield2" type="text" id="textfield3" size="10" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<select name="select" id="select" class="mustChoose">
      <option>-- เลือกปีงบประมาณ --</option>
      <option>2555</option>
      <option>2554</option>
    </select>
    <select name="select2" id="select2">
      <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select>
  <select name="select3" id="select3">
    <option>-- เลือกประเภทงบประมาณ --</option>
  </select>
  <br />
  <select name="select4" id="select4">
    <option>-- เลือกกรม --</option>
  </select>
  <select name="select5" id="select5">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <select name="select6" id="select6">
    <option>-- ทุกกลุ่มงาน --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
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
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกผัน</th>
  <th align="left">กรม</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">จัดการ</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td>-</td>
  <td>พม 0206/0018</td>
  <td>13 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>11,690.00</td>
  <td><input type="submit" name="button5" id="button5" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form_add'" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>-</td>
  <td>พม 0206/5377</td>
  <td>14 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>9,700.00</td>
  <td>เบิกงบประมาณเรียบร้อย</td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>-</td>
  <td>พม 0206/0018</td>
  <td>18 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>11,690.00</td>
  <td>เบิกงบประมาณเรียบร้อย</td>
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