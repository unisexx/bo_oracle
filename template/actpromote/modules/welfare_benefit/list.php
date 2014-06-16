<h3>บันทึก องค์กรสาธาณประโยชน์</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" id="textfield" placeholder="ชื่อหน่วยงาน/ โทรศัพท์" style="width:300px;" />
  <select name="select2">
    <option>-- จังหวัด --</option>
  </select>
  <select name="select3">
    <option selected="selected">-- สถานะ --</option>
    <option>รับเรื่อง</option>
    <option>อนุรับรอง</option>
    <option>ส่งใบสำคัญ</option>
    <option>ประกาศกิจจานุเบกษา</option>
    <option>ไม่รับรอง</option>
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
  <th align="left">ประเภท</th>
  <th align="left">รหัส</th>
  <th align="left">ชื่อหน่วยงาน</th>
  <th align="left">ที่อยู่</th>
  <th align="left">โทรศัพท์</th>
  <th align="left">แฟกช์</th>
  <th align="left">สถานะขั้นตอน</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">มูลนิธิ</td>
  <td nowrap="nowrap">101101192</td>
  <td>สำนักมาตรฐานการพัฒนาสังคมและความมั่นคงของมนุษย์ สำนักปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์</td>
  <td>เลขที่255      ถ.ราชเทวี  จ.กรุงเทพมหานคร</td>
  <td nowrap="nowrap">0-2306-8733</td>
  <td nowrap="nowrap">0-2306-8863</td>
  <td>รับเรื่อง</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>สมาคม</td>
  <td>101101194</td>
  <td>สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน</td>
  <td>ถ.ราชดำเนินนอก  อ.เขตดุสิต จ.กรุงเทพมหานคร</td>
  <td>0-2628-5165</td>
  <td>&nbsp;</td>
  <td>อนุรับรอง</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>องค์กรภาคเอกชน</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>ประกาศกิจจานุเบกษา </td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>อนุรับรอง</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td nowrap="nowrap" class="odd cursor">&nbsp;</td>
  <td>ส่งใบสำคัญ</td>
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