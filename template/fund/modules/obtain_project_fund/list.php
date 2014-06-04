<h3>การขอรับเงินสนับสนุนโครงการ</h3>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield3" id="textfield3"  style="width:350px;" placeholder="ชื่อโครงการ / จำนวนเงิน" />
    <select name="select">
        <option>-- เลือกประเภทกองทุน --</option>
        <option value="1">กองทุนคุ้มครองเด็ก</option>
        <option value="2">กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
        <option value="3">กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    </select>
    <select name="select" id="select">
      <option>-- ทุกรอบการพิจารณา --</option>
    </select>
    <select name="select3" id="select3">
      <option>-- ทุกระบบ --</option>
      <option>ปกติ</option>
      <option>กระจาย</option>
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
  <th>ลำดับ</th>
  <th style="width:35%">ชื่อโครงการ</th>
  <th>องค์กร</th>
  <th>ระบบ</th>
  <th>รอบการพิจารณา</th>
  <th>กลุ่มเป้าหมาย</th>
  <th>ค่าใช้จ่ายที่ขอรับการสนับสนุน</th>
  <th>ผลพิจารณา</th>
  <th>ค่าใช้จ่ายที่ได้รับ</th>
  <th>จัดการ</th>
  </tr>
<tr class="odd cursor">
  <td>1</td>
  <td nowrap="nowrap"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">โครงการ ให้ความช่วยเหลือแก่เด็กไร้สถานะทางกฎหมาย</td>
  <td><img src="images/building.png" width="32" height="32" title="สำนักงานเลขานุการคณะกรรมการคุ้มครองเด็กแห่งชาติ" class="vtip"/></td>
  <td>ปกติ</td>
  <td>7</td>
  <td>อื่นๆ</td>
  <td>2,662,300.00</td>
  <td>-</td>
  <td>-</td>
  <td><img src="images/status.png" width="32" height="32" title="พิจารณาขอรับเงินสนับสนุน" class="vtip example82" />    <input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>โครงการ ใสสะอาด พอเพียง เพื่อพ่อ สู่สถานศึกษาและชุมชน กิจกรรมเพื่อสร้างสรรค์เยาวชนเป็นพลเมืองเข้มแข็ง ใจอาสา ปีที่ 5</td>
  <td><img src="images/building.png" alt="" width="32" height="32" class="vtip" title="มูลนิธิประเทศไทยใสสะอาด"/></td>
  <td>ปกติ</td>
  <td>7</td>
  <td>เด็ก</td>
  <td>2,540,405.00</td>
  <td>อนุมัติ</td>
  <td>2,163,255.00</td>
  <td><img src="images/status.png" alt="" width="32" height="32" class="vtip example82" title="พิจารณาขอรับเงินสนับสนุน" />    <input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>ไม่อนุมัติ</td>
  <td>-</td>
  <td><img src="images/status.png" alt="" width="32" height="32" class="vtip example82" title="พิจารณาขอรับเงินสนับสนุน" />    <input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>ให้ปรับปรุง</td>
  <td>-</td>
  <td><img src="images/status.png" alt="" width="32" height="32" class="vtip example82" title="พิจารณาขอรับเงินสนับสนุน" />    <input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><img src="images/status.png" alt="" width="32" height="32" class="vtip example82" title="พิจารณาขอรับเงินสนับสนุน" />    <input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>6</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>7</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>8</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>9</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>10</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
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




<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3> ผลการพิจารณาขอรับเงินสนับสนุน (โครงการ ให้ความช่วยเหลือแก่เด็กไร้สถานะทางกฎหมาย)</h3>
<table class="tbadd">
<tr>
  <th>ผลพิจารณา<span class="Txt_red_12"> *</span> </th>
  <td><span><input type="radio" name="radio" id="radio3" value="radio" />
    ผ่าน</span>
    
    <span><input type="radio" name="radio" id="radio" value="radio" />
ไม่ผ่าน</span>
<span>
<input type="radio" name="radio" id="radio2" value="radio" /> 
ให้ปรับรายละเอียด</span>
</td>
</tr>
<tr>
  <th>การกระจาย</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกการกระจาย --</option>
    <option>ระบบปกติ</option>
    <option>ระบบกระจาย</option>
  </select></td>
</tr>
<tr>
  <th>วันที่อนุมัติโครงการ</th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>วันที่สัญญาครบถ้วน</th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>วันที่โอนเงิน</th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th colspan="2" class="topic">กรณีผ่านพิจารณา</th>
  </tr>
</table>

<table class="tblist">
  <tr>
  <th>ลำดับ</th>
  <th style="width:40%;">รายการค่าใช้จ่าย</th>
  <th>เสนอขอ</th>
  <th>ได้รับ</th>
  </tr>
  <tr>
  <td>1</td>
  <td>จัดสัมมนาเชิงปฏิบัติการเพื่อสร้างความรู้ความเข้าใจแก่เครือข่าย การทำงานด้านการช่วยเหลือเด็กไร้สถานะทางกฎหมายเขตกรุงเทพฯ</td>
  <td>955,000.00</td>
  <td><input name="" type="text" /></td>
  </tr>
  </table>

<table class="tbadd">
<tr>
  <th>กรณีไม่ผ่านพิจารณา</th>
  <td><textarea name="textfield" rows="3" id="textfield" style="width:500px;" placeholder="สาเหตุ"></textarea></td>
</tr>
<tr>
  <th>รายละเอียดการสนับสนุน</th>
  <td><textarea name="textfield8" rows="3" id="textfield8" style="width:500px;"></textarea></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>