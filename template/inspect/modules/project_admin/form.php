<h3>ผู้ดูแล โครงการ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ <span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option selected="selected">2554</option>
  </select></td>
</tr>
<tr>
  <th>ชื่อโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield4" type="text" id="textfield4" value="โครงการเด็กและเยาวชนที่ได้รับการเสริมสร้างความรู้และสภาพแวดล้อมทางครอบครัวที่เหมาะสม (โครงการคาราวานเสริมสร้างเด็ก)" size="100" /></td>
</tr>
</table>

<h5 style="margin-top:10px;">รายชื่อโครงการย่อย (เพิ่ม / แก้ไข)</h5>

<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>

<table class="tblist">
<tr>
  <th style="width:25%">ไตรมาสที่ 1</th>
  <th style="width:25%">ไตรมาสที่ 2</th>
  <th style="width:25%">ไตรมาสที่ 3</th>
  <th style="width:25%">ไตรมาสที่ 4</th>
  </tr>
<tr class="odd">
  <td><textarea name="textfield" id="textfield" style="width:90%">ปรับปรุง/แต่งตั้งคณะกรรมการระดับจังหวัด</textarea>
    <input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield2" id="textfield2" style="width:90%">คัดเลือกทีมสหวิชาชีพ(ครู ก)</textarea>
    <input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield3" id="textfield3" style="width:90%">จัดกิจกรรมเสริมสร้างพัฒนาการเด็กในแหล่งเรียนรู้</textarea>
    <input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield5" id="textfield5" style="width:90%">จัดกิจกรรมเสริมสร้างพัฒนาการเด็กในแหล่งเรียนรู้ </textarea>
    <input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td><textarea name="textfield6" id="textfield6" style="width:90%">จัดประชุมคณะกรรมการระดับจังหวัด</textarea>
    <input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield8" id="textfield8" style="width:90%">อบรมเพิ่มทักษะ(ครู ก)</textarea>
    <input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield9" id="textfield9" style="width:90%">สนับสนุนให้เด็กในหมู่บ้านเข้าร่วมกิจกรรมในแหล่งเรียนรู้</textarea>
    <input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield13" id="textfield13" style="width:90%">สนับสนุนให้เด็กในหมู่บ้านเข้าร่วมกิจกรรมในแหล่งเรียนรู้</textarea>
    <input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td><textarea name="textfield7" id="textfield7" style="width:90%"></textarea>
    <input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield10" id="textfield10" style="width:90%">อบรมถ่ายทอดความรู้(ครู ข)</textarea>
    <input type="submit" name="button10" id="button10" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield11" id="textfield11" style="width:90%">ขยายผลกิจกรรมเสริมสร้างพัฒนาเด็กจากหมู่บ้านนำร่องไปยังหมู่บ้านอื่น ๆ</textarea>
    <input type="submit" name="button11" id="button11" value="x" class="btn_delete" /></td>
  <td><textarea name="textfield12" id="textfield12" style="width:90%">ขยายผลกิจกรรมเสริมสร้างพัฒนาเด็กจากหมู่บ้านนำร่องไปยังหมู่บ้านอื่น ๆ </textarea>
    <input type="submit" name="button12" id="button12" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>

<div class="paddT20"></div>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
