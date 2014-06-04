<h3>สัญญารับเงินอุดหนุน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ประเภท <span class="Txt_red_12">*</span></th>
  <td><span><input type="radio" name="radio" id="radio" value="radio" /> กองทุนคุ้มครองเด็ก</span>
  <span><input type="radio" name="radio" id="radio" value="radio" /> กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</span>
  <input type="radio" name="radio" id="radio" value="radio" /> 
  กองทุนส่งเสริมการจัดสวัสดิการสังคม
  </td>
</tr>
<tr>
  <th>สัญญาเลขที่<span class="Txt_red_12"> *</span></th>
  <td> 
<input name="date_1" type="text" disabled="disabled" id="date_1" style="width:50px;" value="5" maxlength="" />  
/      
<input name="date_2" type="text" disabled="disabled" id="date_2" style="width:50px;" value="2555" maxlength="4" />    
 </td>
</tr>
<tr>
  <th>สัญญาฉบับนี้ทำขึ้น ณ <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield2" id="textfield2" style="width:350px;" />
    <input type="submit" name="button" id="button" value="ค้นหา" /></td>
</tr>
<tr>
  <th>เมื่อวันที่  <span class="Txt_red_12">*</span></th>
  <td><input name="textfield11" type="text" id="textfield11" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>ผู้ให้เงินอุดหนุน <span class="Txt_red_12">*</span></th>
  <td><input type="radio" name="radio1" id="radio2" value="ปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์" onclick="document.getElementById('textposition').value=this.value;" />
    ปลัด พม.
    <input type="radio" name="radio1" id="radio3" value="ปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์" onclick="document.getElementById('textposition').value=this.value;"/>
    รองปลัด  พม.
    <input type="radio" name="radio1" id="radio4" value="" onclick="document.getElementById('textposition').value=this.value;" />
    มอบอำนาจ พมจ.   
    <input name="textfield3" type="text" id="textfield3" style="width:300px;" value="auto จากตั้งค่าผู้รับมอบอำนาจ หากไม่มีเพิ่มลงไป" /></td>
</tr>
<tr>
  <th>ตำแหน่ง</th>
  <td><input type="text" name="textfield" id="textposition" style="width:300px;" /></td>
</tr>
<tr>
  <th>ตามคำสั่งที่ <span class="Txt_red_12">*</span></th>
  <td><input name="textfield4" type="text" disabled="disabled" id="textfield4" style="width:100px;" value="729/2549" />
    ลงวันที่
    <input name="textfield5" type="text" id="textfield5" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>ผู้รับเงินอุดหนุน <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield7" id="textfield7" style="width:300px;" /></td>
</tr>
<tr>
  <th>โครงการ / กิจกรรม <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield9" id="textfield9" style="width:350px;" />
    <input type="submit" name="button3" id="button3" value="ค้นหา" /></td>
</tr>
<tr>
  <th>องค์กร/หน่วยงานที่รับเงินอุดหนุน</th>
  <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" style="width:400px;" value="โรงพยาบาลบางรัก " /></td>
</tr>
<tr>
  <th>จำนวนเงิน <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield8" id="textfield8" /> 
    บาท (จำนวนเงินกับในระบบ app4 ไม่ตรงกัน)</td>
</tr>
<tr>
  <th>ได้รับอนุมัติวันที่ <span class="Txt_red_12">*</span></th>
  <td><input name="textfield10" type="text" id="textfield10" size="10" />
    <img src="../images/calendar.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>ไฟล์เอกสารแนบ 
    <input type="submit" name="button2" id="button2" value="เพิ่ม" /></th>
  <td><input type="file" name="fileField" id="fileField" />
    <img src="images/question.png" width="16" height="16" style="margin-bottom:-4px; margin-left:10px;" class="vtip" title="1.nononononoon<br> 2. nononononono"/></td>
</tr>
<tr>
  <th>สถานะ</th>
  <td><select name="select" id="select">
    <option>สัญญาใหม่</option>
    <option>ตรวจสอบถูกต้องแล้ว</option>
    <option>กลับไปแก้ไขสัญญา</option>
  </select></td>
</tr>
<tr>
  <th>หมายเหตุกรณีส่งกลับไปแก้ไข</th>
  <td><textarea name="textarea" id="textarea" style="width:400px; height:80px;"></textarea></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>