<h3>ผูกพันค่าใช้จ่าย (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option selected="selected" value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย  </th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40" style="margin-right:20px;"/>
  ลงวันที่ <input name="textfield7" type="text" id="textfield7" size="10" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="textfield4" type="text" id="textfield4" size="40" style="margin-right:20px;"/>
    ลงวันที่ <input name="textfield8" type="text" id="textfield8" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เรื่อง</th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="textfield5" cols="60" rows="4" id="textfield5"></textarea>
  </span></td>
</tr>
<tr>
  <th>รายละเอียด</th>
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
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
    </select></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td><select name="select11" id="select11">
    <option>-- เลือกประเภทงบประมาณ --</option>
    <option>งบประมาณต้นปี</option>
    </select></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td><select name="select11" id="select12">
    <option>-- เลือกกรมที่รับผิดชอบ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><select name="select11" id="select11">
    <option>-- เลือกหน่วยงาน (กอง/สำนัก) --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><select name="select11" id="select10">
    <option>-- เลือกกลุ่มงาน (กลุ่ม/ฝ่าย) --</option>
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
  <th>โครงการ</th>
  <td><select name="select5" id="select5">
    <option>-- เลือกโครงการ --</option>
  </select></td>
</tr>
<tr>
  <th>ยอดผูกพันงบประมาณ</th>
  <td><input name="textfield2" type="text" id="textfield2" size="40"/>
    บาท</td>
</tr>
<tr>
  <th>ลงวันที่ผูกพันงบประมาณ </th>
  <td><input name="textfield" type="text" id="textfield" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<table class="tblist2">
<tr>
  <th style="text-align:center">เลือก</th>
  <th style="text-align:left">หมวดงบประมาณ</th>
  <th style="text-align:right">งบจัดสรร</th>
  <th style="text-align:right">จำนวนเงินผูกพันทั้งหมด</th>
  <th style="text-align:right">คงเหลือ</th>
  <th style="text-align:right">ผูกพันหลักการ</th>
  <th style="text-align:right">ยอดเงินผูกพันค่าใช้จ่าย</th>
  <th style="text-align:right">ยอดผูกพันหลักการคงเหลือ</th>
  <th style="text-align:right">ขอผูกพันงบประมาณจำนวน</th>
  </tr>
<tr>
  <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
  <td>งบดำเนินงาน</td>
  <td align="right">10,951,700.00</td>
  <td align="right">264,872.00</td>
  <td align="right">10,686,828.00</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="center"><input name="textfield10" type="text" disabled="disabled" id="textfield10" value="0.00" class="taRight"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>