<h3 style="margin-bottom:10px;">Mapping เงินงบประมาณ (Mapping)</h3>
<select name="" onchange="window.location.href=this.options[this.selectedIndex].value">
  <option selected="selected" value="budget_mapping.php?act=form">Mapping ยอดคงเหลือ</option>
  <option value="budget_mapping.php?act=form2">Mapping รายการอนุมัติเบิก</option>
</select>
<h5>หน่วยงาน/สำนักที่ Mapping เงินงบประมาณ กรณีที่ Mapping ยอดคงเหลือ</h5>
<table class="tbadd">
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
  <th>รหัสงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
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
</table>

<div class="paddT20"></div>
<h5>หน่วยงานที่รับผิดชอบ</h5>
<table class="tbadd">
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
</table>

<div class="paddT20"></div>
<div id="tabs">
<ul>
      <li><a href="#tabs-1">ผูกผันแล้ว</a></li>
      <li><a href="#tabs-2">ยังไม่ผูกผัน</a></li>
</ul>
<div id="tabs-1">
<h5>รายการที่ต้องการ Mapping ที่ผูกผันแล้ว (ดึงข้อมูลมาจากผูกผันงบประมาณ ตามกิจกรรม + หน่วยงาน)</h5>      
<table class="tblist">
<tr>
  <th align="left">เลือก</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">กรม</th>
  <th align="left">ผูกพันจำนวน</th>
  </tr>
<tr>
  <td nowrap="nowrap"><input type="checkbox" name="checkbox" id="checkbox" /></td>
  <td nowrap="nowrap">0213/1293ลว 30ก.ย.53</td>
  <td>&nbsp;</td>
  <td>11 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>20,000.00</td>
  </tr>
<tr class="odd">
  <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
  <td nowrap="nowrap">0213/1293ลว 30ก.ย.53</td>
  <td>&nbsp;</td>
  <td>11 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>30,000.00</td>
  </tr>
<tr>
  <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
  <td nowrap="nowrap" class="odd cursor">0213/1293ลว 30ก.ย.53</td>
  <td>&nbsp;</td>
  <td>11 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>10,000.00</td>
  </tr>
</table>
</div>
<div id="tabs-2">
<h5>รายการที่ต้องการ Mapping ที่ยังไม่ผูกผัน (ดึงข้อมูลมาจากผูกผันงบประมาณ ตามกิจกรรม + หน่วยงาน)</h5>      
<table class="tblist">
<tr>
  <th align="left">เลือก</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">กรม</th>
  <th align="left">ผูกพันจำนวน</th>
  </tr>
<tr>
  <td nowrap="nowrap"><input type="checkbox" name="checkbox" id="checkbox" /></td>
  <td nowrap="nowrap">02129303</td>
  <td>&nbsp;</td>
  <td>15 ตุลาคม 2553</td>
  <td>สำนักงานปลัดกระทรวง (สป.)</td>
  <td>40,000.00</td>
  </tr>
</table>
</div>
</div>

<div class="paddT20"></div>
<h5>หน่วยงาน/สำนักที่รับ Mapping เงินงบประมาณ</h5>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select11" id="select11">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
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
</table>

<div class="paddT20"></div>
<h5>หน่วยงานที่รับผิดชอบ</h5>
<table class="tbadd">
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
</table>
    
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>