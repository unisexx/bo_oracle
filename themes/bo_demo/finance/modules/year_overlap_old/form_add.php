<h3>เงินกันเหลื่อมปี  (เพิ่ม / แก้ไข)</h3>
<div class="link_budget_related">ไปยัง 
<select name="select10" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option value="budget_related.php?act=form">ผูกพันงบประมาณ</option>
  <option value="cost_related.php?act=form">ผูกผันค่าใช้จ่าย</option>
  <option value="withdraw_replace.php?act=form">เงินเบิกแทนกัน</option>
  <option value="receive_for_withdraw_replace.php?act=form">รับเงินหน่วยงานอื่นเพื่อเบิกแทน</option>
  <option selected="selected" value="year_overlap.php?act=form">เงินกันเหลื่อมปี</option>
  <option value="receive_year_overlap.php?act=form">รับเงินกันเหลือมปี</option>
  <option value="transfer_budget_change.php?act=form">โอนเปลี่ยนแปลงงบประมาณ</option>
  <option value="transfer_budget.php?act=form">โอนจัดสรรงบประมาณให้ พมจ</option>
  <option value="transfer_within.php?act=form">โอนภายในสำนัก</option>
</select>
</div>
<h5>ข้อมูลเงินกันเหลื่อมปี</h5>
<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <td><span>หลักการเบิกแทน 001/53</span> 22 ก.ย. 2010</td>
</tr>
<tr>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <td><span>ค่าใช้จ่ายเบิกแทน 001/53</span> 22 ก.ย. 2010</td>
</tr>
<tr>
  <th>เลขที่ส่วนการคลังรับ</th>
  <td>-</td>
</tr>
<tr>
  <th>เลขที่สำรองเงินกัน<span class="Txt_red_12"> *</span></th>
  <td>
    <input name="textfield3" type="text" id="textfield3" size="40"/>
  ลงวันที่ <input name="textfield7" type="text" id="textfield7" size="10" />
  <img src="../images/calendar.png" width="16" height="16"  style="padding-right:20px;"/></td>
</tr>
<tr>
  <th>ประเภทเงินกัน<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกประเภทเงินกัน --</option>
  </select></td>
</tr>
<tr>
  <th>ปีงบประมาณ</th>
  <td>2553</td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td>สวัสดิการสังคมและความมั่นคงของมนุษย์</td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td>ประชากรเป้าหมายที่ได้รับบริการสวัสดิการสังคม</td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>รายการ</th>
  <td>&nbsp;</td>
</tr>
</table>
<div class="paddT20"></div>
<h5>หน่วยงานที่รับผิดชอบ</h5>
<table class="tbadd">
  <tr>
    <th>กรมที่รับผิดชอบ</th>
    <td>สำนักงานปลัดกระทรวง (สป.)</td>
  </tr>
  <tr>
    <th>หน่วยงาน</th>
    <td><select name="select14" id="select21">
      <option>-- เลือกหน่วยงาน (กอง/สำนัก) --</option>
      <option>แผนงบประมาณต้นปี</option>
      <option>แผนงบประมาณระหว่างปี</option>
    </select></td>
  </tr>
  <tr>
    <th>กลุ่มงาน</th>
    <td><select name="select14" id="select20">
      <option>-- เลือกกลุ่มงาน (กลุ่ม/ฝ่าย) --</option>
    </select></td>
  </tr>
  <tr>
    <th>ยอดผูกพันงบประมาณ</th>
    <td>4,000      บาท</td>
  </tr>
  <tr>
    <th>ลงวันที่ผูกพันงบประมาณ </th>
    <td><input name="textfield4" type="text" id="textfield4" size="10" />
      <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
</table>

<div class="paddT20"></div>
<h5>รายละเอียดเงินงบประมาณ</h5>
<table class="tblist">
  <tr>
  <th>ลำดับ</th>
  <th>หมวดงบประมาณ</th>
  <th>จำนวน</th>
  </tr>
<tr class="odd">
  <td>1</td>
  <td nowrap="nowrap">งบบุคลากร</td>
  <td>4,000.00</td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>