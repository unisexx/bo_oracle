<h3>โอนจัดสรรงบประมาณให้ พมจ. (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option selected="selected" value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<h5>ข้อมูลโอนจัดสรรงบประมาณ ให้ พมจ.</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสือขอโอนจัดสรร </th>
  <td><input name="textfield16" type="text" id="textfield16" size="40"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือ พม.</th>
  <td><input name="textfield15" type="text" id="textfield15" size="40"/></td>
</tr>
<tr>
  <th>เลขที่ส่งออก</th>
  <td><input name="textfield14" type="text" id="textfield14" size="40"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS GEN </th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40"/>
  ลงวันที่ <input name="textfield7" type="text" id="textfield7" size="10" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>เลขที่ GFMIS DGEN </th>
  <td>
    <input name="textfield4" type="text" id="textfield4" size="40"/>
    ลงวันที่ <input name="textfield8" type="text" id="textfield8" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>รายการ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="textfield5" cols="60" rows="4" id="textfield5"></textarea>
  </span></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="textfield6" cols="60" rows="4" id="textfield6"></textarea>
  </span></td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
</table>
<div class="paddT20"></div>
<h5>ผูกพัน/โอนจัดสรรงบประมาณจาก</h5>
<table class="tbadd">
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td><select name="select3" id="select3">
    <option>-- เลือกแผนงาน --</option>
  </select></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><select name="select4" id="select4">
    <option>-- เลือกผลผลิต --</option>
  </select></td>
</tr>
<tr>
  <th>รหัสงบประมาณ</th>
  <td><select name="select11" id="select10">
    <option>-- เลือกรหัสงบประมาณ --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td><select name="select8" id="select8">
    <option>-- เลือกกิจกรรมหลัก --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td><select name="select9" id="select9">
    <option>-- เลือกกิจกรรมย่อย --</option>
  </select></td>
</tr>
<tr>
  <th>รายการ</th>
  <td><select name="select12" id="select11">
    <option>-- เลือกรายการ --</option>
  </select></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td><select name="select7" id="select7">
    <option>-- เลือกกรมที่รับผิดชอบ --</option>
    <option>2555</option>
    <option>2554</option>
    </select></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><select name="select6" id="select6">
    <option>-- เลือกหน่วยงาน (กอง/สำนัก) --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><select name="select5" id="select5">
    <option>-- เลือกกลุ่มงาน (กลุ่ม/ฝ่าย) --</option>
  </select></td>
</tr>
<tr>
  <th>ลงวันที่</th>
  <td><input name="textfield" type="text" id="textfield" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>

<h3>โอนจัดสรรงบประมาณจาก</h3>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist2">
<tr>
  <th>ลำดับ</th>
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย</th>
  <th style="text-align:right">เงินงบประมาณ</th>
  <th style="text-align:center">ลบ</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td nowrap="nowrap">งบดำเนินงาน</td>
  <td>ค่าตอบแทน</td>
  <td align="right">10,000.00</td>
  <td align="center"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>งบดำเนินงาน</td>
  <td>ค่าใช้สอย</td>
  <td align="right">5,000.00</td>
  <td align="center"><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="total">
  <td colspan="3" align="right"><strong>รวมงบประมาณ</strong></td>
  <td align="right"><strong>15,000.00</strong></td>
  <td>&nbsp;</td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
	<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>โอนจัดสรรงบประมาณจาก (เพิ่ม / แก้ไข)</h3>
        <table class="tbadd">
        <tr>
          <th>ประเภทงบประมาณ </th>
          <td><select name="select13" id="select12">
            <option>-- เลือกประเภทงบประมาณ --</option>
            <option>งบประมาณต้นปี</option>
            </select></td>
        </tr>
        <tr>
          <th>หมวดงบประมาณ</th>
          <td><select name="select7" id="select7">
            <option>-- เลือกหมวดงบประมาณ --</option>
          </select></td>
        </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td><select name="select6" id="select6">
            <option>-- เลือกหมวดค่าใช้จ่าย --</option>
          </select></td>
        </tr>
        <tr>
          <th>จำนวนเงินที่มี</th>
          <td class="red B">1,500,000</td>
        </tr>
        <tr>
          <th>จำนวนเงินที่จัดสรร</th>
          <td><input name="textfield2" type="text" id="textfield2" size="30"/>
            บาท</td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
	</div>
    
<div id="transferExplain"><input type="button" title="แจกแจงยอดโอนจัดสรร" value=" " class="btn_explain" id="show"/></div>

<div id="boxProvince">
<div id="selectExplain"><span>ลักษณะการโอน</span> 
<input name="" type="radio" value="" /> เท่ากันทุกจังหวัด     
&nbsp;&nbsp;
<input name="" type="radio" value="" /> ระบุแยกจังหวัด   
</div> 

<div id="provinceExplain">
<table class="tbadd2">
<tr>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
<th>จังหวัด</th>
<th>จำนวนเงินที่ได้รับ</th>
</tr>
<tr>
<td>กระบี่</td>
<td><input name="textfield9" type="text" id="textfield9" value="0.00" class="taRight"/> 
  บาท</td>
<td>กาญจนบุรี</td>
<td><input name="textfield10" type="text" id="textfield10" value="0.00" class="taRight"/>
  บาท</td>
<td>กาฬสินธุ์</td>
<td><input name="textfield11" type="text" id="textfield11" value="0.00" class="taRight"/>
  บาท</td>
</tr>
<tr>
  <td>กำแพงเพชร</td>
  <td><input name="textfield12" type="text" id="textfield12" value="0.00" class="taRight"/>
    บาท</td>
  <td>ขอนแก่น</td>
  <td><input name="textfield13" type="text" id="textfield13" value="0.00" class="taRight"/>
    บาท</td>
  <td>จันทบุรี</td>
  <td><input name="textfield17" type="text" id="textfield17" value="0.00" class="taRight"/>
    บาท</td>
</tr>
<tr>
  <td>ฉะเชิงเทรา</td>
  <td><input name="textfield19" type="text" id="textfield21" value="0.00" class="taRight"/>
    บาท</td>
  <td>ชลบุรี</td>
  <td><input name="textfield21" type="text" id="textfield22" value="0.00" class="taRight"/>
    บาท</td>
  <td>ชัยนาท</td>
  <td><input name="textfield18" type="text" id="textfield23" value="0.00" class="taRight"/>
    บาท</td>
</tr>
<tr>
  <td>ชัยภูมิ</td>
  <td><input name="textfield20" type="text" id="textfield18" value="0.00" class="taRight"/>
    บาท</td>
  <td>ชุมพร</td>
  <td><input name="textfield22" type="text" id="textfield19" value="0.00" class="taRight"/>
    บาท</td>
  <td>ตรัง</td>
  <td><input name="textfield23" type="text" id="textfield20" value="0.00" class="taRight"/>
    บาท</td>
</tr>
</table>
</div> <!--provinceExplain-->
</div><!--Province-->

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>