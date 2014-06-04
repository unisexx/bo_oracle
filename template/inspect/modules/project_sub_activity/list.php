<h3>บันทึก โครงการกิจกรรมย่อย</h3>
<div id="search">
<div id="searchBox">
  <select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกรายชื่อโครงการ --</option>
  </select>
  <br />
  <select name="select2" id="select2" class="mustChoose">
    <option>-- เลือกเขต --</option>
  </select>
  <select name="select5" id="select5">
    <option>-- เลือกจังหวัดทั้งหมด --</option>
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
  <th align="left">&nbsp;</th>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อโครงการ</th>
  <th align="left">หัวข้อ</th>
  <th align="left">รอบที่</th>
  <th align="left">ปี พ.ศ.</th>
  </tr>
<tr class="odd">
  <td><a href="#" class="showSub"><img src="../images/tree/add.jpg" width="16" height="15" /></a></td>
  <td>1</td>
  <td nowrap="nowrap">โครงการส่งเสริมและพัฒนาศักยภาพของครอบครัว (ศูนย์พัฒนาครอบครัวในชุมชน)</td>
  <td>Project Review</td>
  <td>1</td>
  <td>2554</td>
  </tr>
<tr class="boxSub">
  <td colspan="6">
  <table class="tblistSub">
<tr>
  <th width="60%">กิจกรรมย่อยใน กิจกรรมหลักของโครงการ</th>
  <th>ผู้ดูแล</th>
  <th>งบประมาณ</th>
  <th>ลบ</th>
  </tr>
<tr class="odd cursor example8">
  <td>1.  จัดประชุมซักซ้อมการจัดตั้งศูนย์พัฒนาครอบครัวในชุมชน  (ศูนย์ใหม่)    เมื่อวันที่  27  ธันวาคม  2553  ณ  ห้องประชุมชั้น  5    ศาลากลางจังหวัดนนทบุรี  <br />
    2.    จัดทำเวทีประชาคมเพื่อคัดเลือกคณะทำงานศูนย์พัฒนาครอบครัวในชุมชน    (ศูนย์ใหม่)  จำนวน  2  ศูนย์  ได้แก่  วันที่  19  มีนาคม  2554    ทำเวทีประชาคมเพื่อคัดเลือกคณะทำงานฯ  ตำบลบางตลาด  อำเภอปากเกร็ด  ,วันที่    26  มีนาคม  2554  จัดทำเวทีประชาคมคัดเลือกคณะทำงานฯ  ตำบลท่าทราย</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
</table>
  </td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>2</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr class="odd">
  <td>&nbsp;</td>
  <td>3</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>4</td>
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
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>บันทึก โครงการกิจกรรมย่อย (แก้ไขกิจกรรมย่อย)</h3>
        <table class="tbadd">
        <tr>
          <th><strong> กิจกรรมย่อย</strong> <span class="Txt_red_12"> *</span></th>
          <td><textarea name="textarea" id="textarea" cols="55" rows="3"></textarea></td>
        </tr>
        <tr>
          <th>ผู้ดูแล</th>
          <td><input name="textfield" type="text" id="textfield" size="45" /></td>
        </tr>
        <tr>
          <th>งบประมาณ</th>
          <td><input type="text" name="textfield2" id="textfield2" />
            บาท</td>
        </tr>
        </table>

        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save" style="display:block;"/></div>
  </div>
</div>