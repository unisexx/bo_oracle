<h3>สอนถาม ประวัติการแก้ไขข้อมูลของจังหวัด (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
<table class="tbadd">
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
  <td>แผนงบประมาณระหว่างปี</td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลแผนงาน (แผนงบประมาณ)</h5>
<table class="tbadd">
<tr>
  <th>แผนงานที่<span class="Txt_red_12"></span></th>
  <td><input name="textfield5" type="text" id="textfield5" size="5" /></td>
</tr>
<tr>
  <th>รหัสแผนงาน</th>
  <td><input type="text" name="textfield6" id="textfield6" /></td>
</tr>
<tr>
  <th>ชื่อแผนงาน</th>
  <td><input name="textfield7" type="text" id="textfield7" size="60" /></td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลผลผลิต/โครงการ</h5>
<table class="tbadd">
<tr>
  <th>ผลผลิตที่</th>
  <td><input name="textfield8" type="text" id="textfield8" size="5" /></td>
</tr>
<tr>
  <th>ประเภทข้อมูลผลผลิต</th>
  <td><select name="select3" id="select3">
    <option>-- เลือกประเภทข้อมูลผลผลิต --</option>
    <option>โครงการ</option>
    <option>ผลผลิต</option>
  </select></td>
</tr>
<tr>
  <th>รหัสผลผลิต</th>
  <td><input type="text" name="textfield9" id="textfield9" /></td>
</tr>
<tr>
  <th>ชื่อผลผลิต    </th>
  <td><input name="textfield11" type="text" id="textfield11" size="60" /></td>
</tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลกิจกรรมหลัก</h5>
<table class="tbadd">
<tr>
  <th>กิจกรรมหลักที่</th>
  <td><input name="textfield8" type="text" id="textfield8" size="5" /></td>
  </tr>
<tr>
  <th>รหัสกิจกรรมหลัก</th>
  <td><input type="text" name="textfield9" id="textfield9" /></td>
  </tr>
<tr>
  <th>ชื่อกิจกรรมหลัก</th>
  <td><input name="textfield3" type="text" id="textfield12" size="60" /></td>
  </tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลกิจกรรมย่อย</h5>
<table class="tbadd">
<tr>
  <th>กิจกรรมย่อยที่</th>
  <td><input name="textfield8" type="text" id="textfield8" size="5" /></td>
  </tr>
<tr>
  <th>รหัสกิจกรรมย่อย</th>
  <td><input type="text" name="textfield9" id="textfield9" /></td>
  </tr>
<tr>
  <th>ชื่อกิจกรรมย่อย</th>
  <td><input name="textfield10" type="text" id="textfield10" size="60" /></td>
  </tr>
</table>

<div class="paddT20"></div>
<h5>ข้อมูลรายการ</h5>
<table class="tbadd">
<tr>
  <th>รายการที่<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" size="5" /></td>
</tr>
<tr>
  <th>รายการ<span class="Txt_red_12"> *</span></th>
  <td><span style="display:inline; float:left; padding-right:10px;">
    <textarea name="textfield14" cols="60" rows="4" id="textfield3"></textarea>
  </span></td>
</tr>
<tr>
  <th>ลงวันที่<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield4" type="text" id="textfield4" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
</table>

<div class="paddT20"></div>
<h5>รายละเอียดหน่วยงานที่รับผิดชอบ</h5>
<table class="tbadd">
<tr>
  <th>กรมที่รับผิดชอบ<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>หน่วยงานที่รับผิดชอบ<span class="Txt_red_12"> *</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงเวลาจัดทำแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>กลุ่มงาน<span class="Txt_red_12"> *</span></th>
  <td>&nbsp;</td>
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

<tr>
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
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
	</div>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>