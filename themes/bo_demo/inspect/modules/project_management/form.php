<h3>ตั้งค่า จัดการโครงการและวัตถุประสงค์ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>เลือกโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input type="submit" title="ค้นหา" value=" " class="btn_search example8"/></td>
</tr>
<tr>
  <th>วัตถุประสงค์<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textarea" id="textarea" cols="80" rows="5">ดึงช่องวัตถุประสงค์มาใส่เลย (กรณีที่มี) สามารถแก้ไขได้</textarea></td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>เขตจังหวัด (เพิ่ม / แก้ไข)</h3>
        <table class="tbadd">
          <tr>
          <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
          <td><select name="select" id="select">
            <option>-- เลือกปีงบประมาณ --</option>
          </select></td>
        </tr>
          <tr>
            <th>กรม<span class="Txt_red_12"> *</span></th>
            <td><select name="select2" id="select2">
              <option>-- เลือกกรม --</option>
            </select></td>
          </tr>
          <tr>
            <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
            <td><select name="select4" id="select4">
              <option>-- เลือกหน่วยงาน --</option>
            </select></td>
          </tr>
          <tr>
            <th>โครงการ<span class="Txt_red_12"> *</span></th>
            <td><select name="select7" id="select7">
              <option>-- เลือกโครงการ --</option>
            </select></td>
          </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="เพิ่มรายการ" value=" " class="btn_add"/></div>
		</div>
	</div>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>