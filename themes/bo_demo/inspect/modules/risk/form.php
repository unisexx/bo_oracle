<h3>ตั้งค่า หัวข้อความเสี่ยง (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
    <input type="checkbox" name="checkbox" id="checkbox" /> คัดลอกข้อมูลหัวข้อความเสี่ยงของปีงบประมาณนี้</td>
</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>รายการหัวข้อความเสี่ยง</h3>

<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist2">
<tr>
  <th>ลำดับที่</th>
  <th>ชื่อหัวข้อความเสี่ยง</th>
  <th>ประเภท</th>
  <th>ลบ</th>
  </tr>

<tr class="odd">
  <td>1</td>
  <td>ทรัพยากรในการสนับสนุนการดำเนินกิจกรรม / แผนงาน / โครงการมีทรัพยากร (ทุกด้าน) สนับสนุนไม่เพียงพอ</td>
  <td>Key Risk area</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>2</td>
  <td>การประสานการดำเนินงานระหว่างภาคีเครือข่ายที่เกี่ยวข้องไม่ส่งผลสำเร็จอย่างยั่งยืนของแผนงาน / โครงการ</td>
  <td>Political Risk</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>3</td>
  <td>การใช้จ่ายงบประมาณมีโอกาสไม่ตรงตามความต้องการของกลุ่มเป้าหมาย </td>
  <td>Negotiation Risk</td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>4</td>
  <td>การใช้งบประมาณไม่มีการตรวจสอบความโปร่งใสเพียงพอ</td>
  <td>Ohter (อื่นๆ)</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>เขตจังหวัด (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
          <tr>
          <th>เขตจังหวัด<span class="Txt_red_12"> *</span></th>
          <td><select name="select" id="select">
            <option>-- เลือกเขตจังหวัด --</option>
          </select> แสดงเฉพาะจังหวัดที่ว่าง</td>
        </tr>
          <tr>
            <th>ผู้ตรวจ</th>
            <td><select name="select2" id="select2">
              <option>-- เลือกผู้ตรวจ --</option>
            </select></td>
          </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save"/></div>
		</div>
	</div>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>