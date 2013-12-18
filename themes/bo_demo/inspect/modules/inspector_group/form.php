<h3>ตั้งค่า กลุ่มผู้ตรวจ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อ-สกุล ผู้ตรวจ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield" type="text" id="textfield" value="นางนนทินี เพ็ชญไพศิษฎ" size="50" /> <input type="checkbox" name="checkbox" id="checkbox" />
    เปลี่ยนทุกเขตจังหวัด</td>
</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>เขตจังหวัดที่รับผิดชอบ</h3>

<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist2">
<tr>
  <th>ลำดับที่</th>
  <th>เขตจังหวัด</th>
  <th>ชื่อ - สกุล ผู้ตรวจ</th>
  <th>ลบ</th>
  </tr>

<tr class="odd">
  <td>1</td>
  <td>เขตตรวจราชการส่วนกลาง</td>
  <td>นางนนทินี เพ็ชญไพศิษฎ</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>2</td>
  <td>เขตที่ 2</td>
  <td>นางนนทินี เพ็ชญไพศิษฎ</td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
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