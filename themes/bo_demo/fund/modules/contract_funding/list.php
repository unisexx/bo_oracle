<h3>สัญญารับเงินอุดหนุน</h3>
<div id="search">
<div id="searchBox">
  ชื่อโครงการ / จำนวนเงิน
    <input type="text" name="textfield3" id="textfield3"  style="width:250px;" />
  <select name="select" id="select" class="mustChoose">
    <option>-- ทุกหน่วยงาน --</option>
  </select>
  <select name="select2" id="select2" class="mustChoose">
    <option selected="selected">-- ทุกประเภทกองทุน --</option>
    <option>กองทุนคุ้มครองเด็ก</option>
    <option>กองทุนป้องกัน/ปราบปราม</option>
    <option>กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
  </select>
  เมื่อวันที่
  <input name="textfield" type="text" id="textfield" size="10" />
  <img src="../images/calendar.png" width="16" height="16" /> 
  ถึง 
  <input name="textfield2" type="text" id="textfield2" size="10" />
  <img src="../images/calendar.png" width="16" height="16" />
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
  <th align="left">สัญญาเลขที่</th>
  <th align="left">ทำขึ้น ณ</th>
  <th align="left">เมื่อวันที่</th>
  <th align="left">ชื่อโครงการ</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">ประเภท</th>
  <th align="left">ผูัรับมอบอำนาจ</th>
  <th align="left">สถานะ</th>
  <th align="left">พิมพ์</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">5/2553</td>
  <td>พมจ. เชียงราย</td>
  <td>11 พ.ค. 53</td>
  <td>โครงการรักไม่วุ่นของคนหนุ่มสาว</td>
  <td>980,000</td>
  <td><img src="images/ico_child.png" width="32" height="32" class="vtip" title="กองทุนเด็ก" /></td>
  <td><span class="vtip" title="พัฒนาสังคมและความมั่นคงของมนุษย์จังหวัดเชียงราย (๗๒๙/๒๕๔๙)">นายสมศักดิ์ พรสัจจะ</span></td>
  <td><img src="images/ico_new.png" width="32" height="32" title="สัญญาใหม่" class="vtip" /></td>
  <td><img src="images/ico_print.png" width="24" height="24" class="vtip" title="พิมพ์สัญญา" onclick="window.open('<? echo $_SERVER['PHP_SELF']?>?act=print')" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>5/2553</td>
  <td>พมจ. แพร่</td>
  <td>10 พ.ค. 53</td>
  <td>โครงการป้องกันและแก้ไขปัญหาความรุนแรง</td>
  <td>570,000</td>
  <td><img src="images/ico_prevent.png" width="32" height="32" class="vtip" title="กองทุนป้องกัน/ปราบปราม" /></td>
  <td>นายพรชัย สาระดี</td>
  <td><img src="images/ico_ok.png" width="24" height="24" title="ตรวจสอบถูกต้องแล้ว" class="vtip"/></td>
  <td><img src="images/ico_print.png" width="24" height="24" class="vtip" title="พิมพ์สัญญา" onclick="window.open('<? echo $_SERVER['PHP_SELF']?>?act=print')" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>5/2553</td>
  <td>พมจ. ชลบุรี</td>
  <td>10 พ.ค. 53</td>
  <td>โครงการส่งเสริมศีลธรรมแก่เยาวชน</td>
  <td>870,000</td>
  <td><img src="images/ico_star.png" width="32" height="32" class="vtip" title="กองทุนส่งเสริมการจัดสวัสดิการสังคม" /></td>
  <td>นายสาธิต ทดลองดู</td>
  <td><img src="images/ico_warning.png" width="24" height="24" title="กลับไปแก้ไขสัญญา" class="vtip"/></td>
  <td><img src="images/ico_print.png" width="24" height="24" class="vtip" title="พิมพ์สัญญา" onclick="window.open('<? echo $_SERVER['PHP_SELF']?>?act=print')" /></td>
  </tr>
<tr>
  <td>4</td>
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
  <td>5</td>
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