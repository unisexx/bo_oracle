<h3>รับเงินกันเหลือมปี (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option selected="selected" value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<h5>ข้อมูลรับเงินกันเหลื่อมปี</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ <span class="Txt_red_12"> *</span></th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40"/>
  ลงวันที่ <input name="textfield7" type="text" id="textfield7" size="10" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield14" type="text" id="textfield14" size="40"/>
ลงวันที่
  <input name="textfield14" type="text" id="textfield15" size="10" />
  <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="textfield4" type="text" id="textfield4" size="40"/>
    ลงวันที่ <input name="textfield8" type="text" id="textfield8" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เลขที่สำรองเงินกัน</th>
  <td><input name="textfield15" type="text" id="textfield16" size="40"/>
ลงวันที่
  <input name="textfield15" type="text" id="textfield17" size="10" />
  <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>ประเภทเงินกัน</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select10" id="select10">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
    </select></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><select name="select10" id="select11">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
</table>
<div style="padding:10px 0;"></div>
<h5>ข้อมูลรายการ</h5>
<table class="tbadd">
<tr>
  <th>รายการที่</th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40"/></td>
</tr>
<tr>
  <th>รายการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield14" cols="60" rows="4" id="textfield14"></textarea></td>
</tr>
<tr>
  <th>กรมที่กันเงิน </th>
  <td><select name="select" id="select">
    <option>-- เลือกกรมที่กันเงิน --</option>
  </select></td>
</tr>
<tr>
  <th>กรมเจ้าของ</th>
  <td><select name="select7" id="select7">
    <option>-- เลือกกรมเจ้าของ --</option>
  </select></td>
</tr>
<tr>
  <th>กรมที่รับเงินกันเหลื่อมปี  <span class="Txt_red_12"> *</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกกรมที่รับเงินกันเหลื่อมปี --</option>
  </select></td>
</tr>
<tr>
  <th>ลงวันที่รับเงินกันเหลื่อมปี <span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>หมายเหตุ</th>
  <td><textarea name="textfield" cols="60" rows="4" id="textfield"></textarea></td>
</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>แหล่งงบประมาณ</h3>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist2">
<tr>
  <th>ลำดับที่</th>
  <th>ประเภทงบ</th>
  <th>หมวดงบประมาณ</th>
  <th>หมวดค่าใช้จ่าย </th>
  <th>จำนวนเงิน</th>
  <th>ลบ</th>
  </tr>

<tr class="odd">
  <td>1</td>
  <td>งบประมาณต้นปี</td>
  <td>งบบุคลากร</td>
  <td>เงินเดือน</td>
  <td>10,000.00</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr class="total">
  <td colspan="4" align="right"><strong>รวมงบประมาณ</strong></td>
  <td><strong>10,000.00</strong></td>
  <td>&nbsp;</td>
  </tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>แหล่งงบประมาณ (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
          <tr>
          <th>ประเภทงบ<span class="Txt_red_12"> *</span></th>
          <td><select name="select" id="select">
            <option>-- เลือกประเภทงบ --</option>
            <option>งบประมาณต้นปี</option>
          </select></td>
        </tr>
        <tr>
          <th>หมวดงบประมาณ</th>
          <td><select name="select" id="select">
            <option>-- เลือกหมวดงบประมาณ --</option>
            <option>งบบุคลากร</option>
            <option>งบดำเนินงาน</option>
          </select></td>
          </tr>
        <tr>
          <th>หมวดค่าใช้จ่าย</th>
          <td><select name="select2" id="select2">
            <option>-- เลือกหมวดค่าใช้จ่าย --</option>
            <option>เงินเดือน </option>
            <option>ค่าจ้างประจำ </option>
          </select></td>
          </tr>
        <tr>
          <th><span style="text-align:right">จำนวนเงิน</span></th>
          <td><input type="text" name="textfield9" id="textfield9" /> 
            บาท    </td>
        </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" value="บันทึก" class="btn_save"/></div>
		</div>
	</div>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>