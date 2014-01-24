<h3>โอนเปลี่ยนแปลงงบประมาณ (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option selected="selected" value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<h5>ข้อมูลโอนเปลี่ยนแปลงงบประมาณ</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสือ พม. <span class="Txt_red_12">*</span></th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40"/></td>
</tr>
<tr>
  <th>เลขที่หนังสือโอนเปลี่ยนแปลง<span class="Txt_red_12"> *</span>  </th>
  <td>
    <input name="textfield4" type="text" id="textfield4" size="40"/></td>
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
<h5>ผูกพัน/โอนเปลี่ยนแปลงจาก</h5>
<table class="tbadd">
<tr>
  <th>ช่วงแผนงบประมาณ <span class="Txt_red_12">*</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ) <span class="Txt_red_12">*</span></th>
  <td><select name="select3" id="select3">
    <option>-- เลือกแผนงาน --</option>
  </select></td>
</tr>
<tr>
  <th>ผลผลิต <span class="Txt_red_12">*</span></th>
  <td><select name="select4" id="select4">
    <option>-- เลือกผลผลิต --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมหลัก <span class="Txt_red_12">*</span></th>
  <td><select name="select8" id="select8">
    <option>-- เลือกกิจกรรมหลัก --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมย่อย <span class="Txt_red_12">*</span></th>
  <td><select name="select9" id="select9">
    <option>-- เลือกกิจกรรมย่อย --</option>
  </select></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ <span class="Txt_red_12">*</span></th>
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
</table>

<div class="paddT20"></div>
<h5>โอนเปลี่ยนแปลงเป็น</h5>
<table class="tbadd">
<tr>
  <th>ช่วงแผนงบประมาณ <span class="Txt_red_12">*</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ) <span class="Txt_red_12">*</span></th>
  <td><select name="select3" id="select3">
    <option>-- เลือกแผนงาน --</option>
  </select></td>
</tr>
<tr>
  <th>ผลผลิต <span class="Txt_red_12">*</span></th>
  <td><select name="select4" id="select4">
    <option>-- เลือกผลผลิต --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมหลัก <span class="Txt_red_12">*</span></th>
  <td><select name="select8" id="select8">
    <option>-- เลือกกิจกรรมหลัก --</option>
  </select></td>
</tr>
<tr>
  <th>กิจกรรมย่อย <span class="Txt_red_12">*</span></th>
  <td><select name="select9" id="select9">
    <option>-- เลือกกิจกรรมย่อย --</option>
  </select></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ <span class="Txt_red_12">*</span></th>
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
  <th>รายการ</th>
  <td><textarea name="textfield5" cols="60" rows="4" id="textfield5"></textarea></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><textarea name="textfield2" cols="60" rows="4" id="textfield2"></textarea></td>
</tr>
<tr>
  <th>ลงวันที่ </th>
  <td><input name="textfield" type="text" id="textfield" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>

<div style="padding:20px 0;"></div>

<h3>รายการโอนเปลี่ยนแปลง</h3>
<div id="btnBox"><input type="submit" title="เพิ่มรายการโอนเปลี่ยนแปลง" value=" " class="btn_add example8"/></div>
<table class="tblist2" style="margin-top:10px;">
<tr>
  <th rowspan="2" style="border:1px solid #ccc;">ลำดับ</th>
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนจาก</th>
  <th colspan="2" style="border:1px solid #ccc; text-align:center;">โอนเป็น</th>
  <th rowspan="2" style="border:1px solid #ccc; text-align:right">เงินงบประมาณ</th>
  <th rowspan="2" style="border:1px solid #ccc; text-align:center">ลบ</th>
  </tr>
<tr>
  <th style="border:1px solid #ccc;">หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
  <th style="border:1px solid #ccc;" >หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc;">หมวดค่าใช้จ่าย</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td nowrap="nowrap">งบดำเนินงาน</td>
  <td>ค่าใช้สอย</td>
  <td>งบบุคลากร</td>
  <td>ค่าจ้างประจำ</td>
  <td align="right">10,000.00</td>
  <td align="center"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>งบดำเนินงาน</td>
  <td>ค่าใช้สอย</td>
  <td>งบดำเนินงาน</td>
  <td>ค่าวัสดุ</td>
  <td align="right">5,000.00</td>
  <td align="center"><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="total">
  <td colspan="5" align="right"><strong>รวมงบประมาณ</strong></td>
  <td align="right"><strong>15,000.00</strong></td>
  <td>&nbsp;</td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>โอนภายในสำนัก / กรม (เพิ่ม / แก้ไข)</h3>
        <div class="paddT20"></div>
        <h5>โอนจาก</h5>
        <table class="tbadd">
        <tr>
          <th style="width:30%">ประเภทงบประมาณ </th>
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
          <th>จำนวนเงิน</th>
          <td class="red B">1,970,000</td>
        </tr>
        </table>
        
         <div class="paddT20"></div>
         <h5>โอนเป็น</h5>
        <table class="tbadd">
        <tr>
          <th style="width:30%">ประเภทงบประมาณ </th>
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
          <th>จำนวนเงินโอน</th>
          <td><input name="textfield2" type="text" id="textfield2" size="30"/>
            บาท</td>
        </tr>
        </table>
        <div id="btnBoxAdd" style="padding-left:30%;"><input name="input" type="button" title="บันทึก" value=" " class="btn_save" style="display:block;"/></div>
		</div>
</div>
    
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>