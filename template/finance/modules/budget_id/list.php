<h3>รหัสงบประมาณ</h3>
<div id="search">
  <div id="searchBox">
    <select name="select" id="select" class="mustChoose">
      <option>-- เลือกปีงบประมาณ --</option>
    </select>
    <select name="select2" id="select2">
      <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select>
  <select name="select3" id="select3">
    <option>-- เลือกทุกแผนงาน --</option>
  </select>
  <select name="select4" id="select4">
    <option>-- เลือกทุกผลผลิต --</option>
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
  <th align="left">ปีงบประมาณ</th>
  <th align="left">รหัสงบประมาณ</th>
  <th align="left">คำอธิบาย</th>
  <th align="left">ผลผลิต</th>
  <th align="left">แผนงาน</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">2555</td>
  <td>0600274001000000</td>
  <td>รายการงบประจำ</td>
  <td>การกำหนดนโยบาย มาตรการและแผนด้านการพัฒนาสังคมและความมั่นคงของมนุษย์</td>
  <td>สวัสดิการสังคมและความมั่นคงของมนุษย์</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>2555</td>
  <td>0600274001110000</td>
  <td>ครุภัณฑ์มูลค่าต่อหน่วยต่ำกว่าล้านบาท</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>2555</td>
  <td>0600274001110001</td>
  <td>เครื่องพิมพ์แบบเลเซอร์ ชนิดขาวดำ (20 หน้าต่อนาที)</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>2555</td>
  <td>0600274001110002</td>
  <td>เครื่องโทรสารแบบใช้กระดาษธรรมดา ส่งเอกสารได้ครั้งละ 30 แผ่น</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>8</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>10</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button10" id="button10" value="x" class="btn_delete" /></td>
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