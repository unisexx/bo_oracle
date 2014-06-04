<h3>ผูกพันงบประมาณ (เพิ่ม / แก้ไข) </h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option selected="selected" value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
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
  <th>เลขที่หนังสืออนุมัติหลักการ<span class="Txt_red_12"> *</span> </th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="10"/>
    /
    <input name="textfield14" type="text" id="textfield14" size="10"/>
  ลงวันที่ <input name="textfield7" type="text" id="textfield7" size="10" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/>
  <input type="checkbox" name="checkbox" id="checkbox"/>
  หลักการพร้อมค่าใช้จ่าย ( ถ้าเลือก จะต้องไปทำผูกพันค่าใช้จ่ายต่อ Redirect auto )</td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ </th>
  <td>
    <input name="textfield4" type="text" id="textfield4" size="40"/>
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
  <th>กรมที่รับผิดชอบ<span class="Txt_red_12"> *</span></th>
  <td><select name="select12" id="select13">
    <option>-- เลือกกรมที่รับผิดชอบ --</option>
  </select></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td><select name="select12" id="select12">
    <option>-- เลือกหน่วยงาน (กอง/สำนัก) --</option>
  </select>    
     (กรองแผนงาน ตามหน่วยงาน หรือ กลุ่มงานที่เลือก)</td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><select name="select12" id="select10">
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
  <td><input name="textfield2" type="text" disabled="disabled" id="textfield2" value="50,000" size="30" style="text-align:right"/>
    บาท (ยอดรวมของขอผูกพันงบประมาณจำนวน Auto)</td>
</tr>
<tr>
  <th>ลงวันที่ผูกพันงบประมาณ </th>
  <td><input name="textfield" type="text" id="textfield" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>
<div style="padding:20px 0;"></div>
<h3>รายการยอดผูกพันงบประมาณ </h3>
<table class="tblist2">
<tr>
  <th style="text-align:left">หมวดงบประมาณ</th>
  <th style="text-align:right">งบจัดสรร</th>
  <th style="text-align:right">จำนวนเงินผูกพันทั้งหมด</th>
  <th style="text-align:right">คงเหลือ</th>
  <th style="text-align:right">ขอผูกพันงบประมาณจำนวน</th>
  <th style="text-align:center">&nbsp;</th>
  </tr>
<tr class="odd">
  <td nowrap="nowrap">งบบุคลากร</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right"><input name="textfield9" type="text" disabled="disabled" id="textfield9" value="0.00" style="text-align:right"/></td>
  <td align="center">ถ้ายอดงบจัดสรรมากกว่า 0 จะสามารถกรอกยอดขอผูกพันงบประมาณได้ <br />
    ถ้าหมวดงบไหนมียอดน้อยกว่าที่ขอผูกผันงบ ให้แจ้งเตือนก่อนบันทึก Y/N</td>
  </tr>
<tr>
  <td>งบดำเนินงาน</td>
  <td align="right">100,000.00</td>
  <td align="right">0.00</td>
  <td align="right">100,000.00</td>
  <td align="right"><input name="textfield10" type="text" id="textfield10" value="50,000" style="text-align:right"/></td>
  <td align="center">&nbsp;</td>
  </tr>
<tr class="odd">
  <td>งบลงทุน</td>
  <td align="right">0.00</td>
  <td align="right">7,000.00</td>
  <td align="right">-7,000.00</td>
  <td align="right"><input name="textfield11" type="text" id="textfield11" value="7,000.00" style="text-align:right"/></td>
  <td align="center">&nbsp;</td>
  </tr>
<tr>
  <td>งบอุดหนุน</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right"><input name="textfield12" type="text" disabled="disabled" id="textfield12" value="0.00" style="text-align:right"/></td>
  <td align="center">&nbsp;</td>
  </tr>
<tr class="odd">
  <td>งบรายจ่ายอื่น</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right">0.00</td>
  <td align="right"><input name="textfield13" type="text" disabled="disabled" id="textfield13" value="0.00" style="text-align:right"/></td>
  <td align="center">&nbsp;</td>
</tr>
</table>

<div id="btnBoxAdd"> 
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>