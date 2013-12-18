<h3>อนุมัติเบิกเงิน</h3>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติเบิกเงิน
    <input type="text" name="textfield" id="textfield" />
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
    <select name="select2" id="select2" class="mustChoose">
      <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกประเภทงบประมาณ --</option>
  </select>
  <br />
  <select name="select4" id="select4" class="mustChoose">
    <option>-- เลือกกรม --</option>
  </select>
  <select name="select5" id="select5">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <select name="select6" id="select6">
    <option>-- ทุกกลุ่มงาน --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search vtip" /></div>
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
  <th>&nbsp;</th>
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th>วันที่ผูกพัน</th>
  <th>หน่วยงาน / กลุ่มงาน</th>
  <th>จำนวนเงิน</th>
  <th>สถานะ</th>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>1</td>
  <td nowrap="nowrap">111</td>
  <td>พม 0210/0351</td>
  <td>05 ตุลาคม 2553</td>
  <td><span class="vtip" title="-">ศูนย์เทคโน</span></td>
  <td>6,768.00</td>
  <td>ยังไม่เรียบร้อย</td>
  </tr>
  
<tr class="boxSub">
  <td colspan="10">
  <div id="search">
  <div id="searchBox">
 <table  style="margin-left:5%;" width="95%">
 <tr>
 	<th>จำนวนเงินทั้งหมด : </th>
    <th>จำนวนเงินที่เบิกไปแล้ว : </th>
    <th>คงเหลือ : </th>
    <th>&nbsp;</th>
 </tr>
 </table>
<table class="tblistSub">
<tr>
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติเบิกเงิน</th>
  <th>วันที่เบิกเงิน</th>
  <th>หน่วยงาน / กลุ่มงาน</th>
  <th>จำนวนเงิน</th>
  <th>สถานะการเบิกเงิน</th>
  <th>จัดการ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td>1.1</td>
  <td>8888888</td>
  <td>23 พฤษภาคม 2554</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>4,768.00 </td>
  <td><span style="text-align:center;">ได้</span></td>
  <td><input type="submit" name="button2" id="button2" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button3" id="button3" value="-" title="ยกเลิกรายการ" class="btn_cancel vtip" /></td>
</tr>
<tr>
  <td>1.2</td>
  <td>พม 0206/5465 ลว. 13 /10/53</td>
  <td>13 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>2,000.00</td>
  <td>เรียบร้อย</td>
  <td><input type="submit" name="button" id="button" value="-" title="ยกเลิกรายการ" class="btn_cancel vtip" /></td>
</tr>
</table>
  </div>
  </div>
  </td>
  </tr>
  
<tr>
  <td>&nbsp;</td>
  <td>2</td>
  <td>&nbsp;</td>
  <td>พม 0206/0013</td>
  <td>14 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>9,700.00</td>
  <td>เบิกงบประมาณเรียบร้อย</td>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>3</td>
  <td>&nbsp;</td>
  <td>พม 0206/0018</td>
  <td>18 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>11,690.00</td>
  <td><input type="submit" name="button4" id="button4" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" /></td>
  </tr>
<tr class="odd boxSub">
  <td colspan="8">
  <table class="tblistSub">
<tr>
  <th>ลำดับ</th>
  <th>วันที่เบิกเงิน</th>
  <th>จำนวนเงิน</th>
  <th>ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=view'">
  <td>3.1</td>
  <td>23 พฤษภาคม 2554</td>
  <td>1,690.00</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>3.2</td>
  <td>13 ตุลาคม 2553</td>
  <td>10,000.00</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
</table>
  </td>
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