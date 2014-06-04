<h3>บันทึก การขอรับเงินสนับสนุนโครงการ (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ประเภทกองทุน <span class="Txt_red_12"> *</span></th>
    <td>
      <select name="select" style="margin-right:15px;">
        <option>-- เลือกประเภทกองทุน --</option>
        <option value="1">กองทุนคุ้มครองเด็ก</option>
        <option value="2">กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
        <option value="3">กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    </select>
</td>
  </tr>
</table>


<div id="tabs1" class="type1" style="display:none;">
  <ul>
    <li><a href="#tabs-type1-1">ข้อมูลทั่วไป กองทุนคุ้มครองเด็ก</a></li>

    <li><a href="#tabs-type1-4">กิจกรรมและค่าใช้จ่าย</a></li>
  </ul>
  
<div id="tabs-type1-1" >
<table class="tbadd">
  <tr>
    <th>องค์การ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield36" type="text" id="textfield42" style="width:350px;" />      <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ปีงบประมาณ <span class="Txt_red_12"> *</span></th>
    <td><select name="select10" id="select11">
    </select></td>
  </tr>
  <tr>
    <th>โครงการ <span class="Txt_red_12"> *</span></th>
    <td><p><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
โครงการใหม่</span> <span>
<input name="textfield2" type="text" id="textfield2" style="width:350px;" />
    <select name="select11" id="select12">
      <option>-- เลือกการกระจาย --</option>
      <option>แบบปกติ</option>
      <option>แบบกระจาย</option>
    </select>
    </p>
<p>
<input type="radio" name="radio" id="radio4" value="radio" /> 
โครงการต่อเนื่อง
      <input name="textfield4" type="text" id="textfield4" style="width:350px;" />
      <img src="images/see.png" width="24" height="24" /></p></td>
  </tr>
  <tr>
    <th>วันที่รับโครงการ</th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>รหัสทะเบียนโครงการ   <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield6" type="text" id="textfield6" style="width:100px;"/></td>
  </tr>
  <tr>
    <th>รอบการพิจารณาที่   <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield37" type="text" id="textfield43" style="width:40px;"/></td>
  </tr>
  <tr>
    <th>ไตรมาสที่ <span class="Txt_red_12">*</span></th>
    <td><select name="select2" id="select">
      <option>-- เลือกไตรมาส --</option>
      <option>ไตรมาสที่ 1</option>
      <option>ไตรมาสที่ 2</option>
      <option>ไตรมาสที่ 3</option>
      <option>ไตรมาสที่ 4</option>
    </select></td>
  </tr>
  <tr>
    <th>ประเภทโครงการ</th>
    <td><select name="select3" id="select2">
      <option>-- เลือกประเภทโครงการ --</option>
    </select></td>
  </tr>
  <tr>
    <th>รายการโครงการ</th>
    <td><select name="select4" id="select3">
      <option>-- เลือกรายโครงการ --</option>
    </select></td>
  </tr>
  <tr>
    <th>ประเภทเด็ก</th>
    <td><select name="select5" id="select4">
      <option>-- เลือกประเภทเด็ก --</option>
    </select></td>
  </tr>
  <tr>
  	<th>แนบไฟล์ <img src="../images/question.png" width="24" height="24" class="vtip" title="หลักการและเหตุผล, 
วัตถุประสงค์ของโครงการ, 
วิธีดำเนินงานตามโครงการ, 
สถานที่ตั้งโครงการ, 
ระยะเวลาดำเนินงาน, 
ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์, 
อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ, 
การประเมินผล, 
ผลที่คาดว่าจะได้รับ" /></th>
    <td><input name="" type="file" /></td>
  </tr>
</table>
</div><!--tabs-type1-1-->



<!--<div id="tabs-type1-2">
<table class="tbadd">
 <tr>
   <th>หลักการและเหตุผล</th>
   <td><textarea name="textfield43" rows="3" id="textfield49" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วัตถุประสงค์ของโครงการ</th>
   <td><textarea name="textfield46" rows="3" id="textfield52" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วิธีดำเนินงานตามโครงการ</th>
   <td><textarea name="textfield47" rows="3" id="textfield53" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>สถานที่ตั้งโครงการ</th>
   <td><textarea name="textfield48" rows="3" id="textfield54" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ระยะเวลาดำเนินงาน</th>
   <td><textarea name="textfield49" rows="3" id="textfield55" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์</th>
   <td><textarea name="textfield50" rows="3" id="textfield56" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ</th>
   <td><textarea name="textfield51" rows="3" id="textfield57" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>การประเมินผล</th>
   <td><textarea name="textfield52" rows="3" id="textfield58" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผลที่คาดว่าจะได้รับ</th>
   <td><textarea name="textfield53" rows="3" id="textfield59" style="width:500px;"></textarea></td>
 </tr>
</table>
</div>--> <!--tabs-type1-2-->




<div id="tabs-type1-4">
<table class="tbadd">
 <tr>
   <th>ค่าใช้จ่ายทั้งโครงการ</th>
   <td><input name="textfield42" type="text" id="textfield48" style="width:150px;" readonly="readonly"/> 
     บาท</td>
 </tr>
 <tr>
   <th>ค่าใช้จ่ายที่ขอรับสนับสนุน</th>
   <td><input name="textfield44" type="text" id="textfield50" style="width:150px;" readonly="readonly"/>
บาท</td>
 </tr>
 <tr>
   <th>ค่าใช้จ่ายที่ได้รับ</th>
   <td><input name="textfield45" type="text" id="textfield51" style="width:150px;" readonly="readonly"/>
บาท</td>
 </tr>
 </table>
<h3>กิจกรรมและค่าใช้จ่าย ของโครงการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ชื่อกิจกรรม</th>
<th>ระยะเวลา</th>
<th>คชจ.ทั้งกิจกรรม (บาท)</th>
<th>คชจ.ที่เสนอขอ (บาท)</th>
<th>คชจ.สมทบ (บาท)</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>1.1 จัดสัมมนาเชิงปฏิบัติการเพื่อสร้างความรู้ความเข้าใจแก่เครือข่าย การทำงานด้านการช่วยเหลือเด็กไร้สถานะทางกฎหมายเขตกรุงเทพฯ</td>
<td>1 ปี</td>
<td>955,000.00</td>
<td>955,000.00</td>
<td>-</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none;">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>กิจกรรมและค่าใช้จ่าย ของโครงการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อกิจกรรม<span class="Txt_red_12"> *</span>
     </th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:350px;"/></td>
</tr>
<tr>
  <th>ระยะเวลา</th>
  <td><input name="textfield17" type="text" id="textfield18" style="width:200px;"/></td>
</tr>
<tr>
  <th>รายละเอียด คชจ. ของทั้งกิจกรรม<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield17" rows="5" id="textfield19" style="width:500px;"></textarea></td>
</tr>
<tr>
  <th>คชจ.ทั้งกิจกรรม<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/>
    บาท</td>
</tr>
<tr>
  <th>คชจ.ที่เสนอขอ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield3" type="text" id="textfield3" style="width:100px;"/>
    บาท</td>
</tr>
<tr>
  <th>คชจ.สมทบ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield17" type="text" id="textfield20" style="width:100px;"/>
    บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>
</div> <!--tabs-type1-4-->

</div><!--tabs--><!-- กองทุนคุ้มครองเด็ก -->









<div id="tabs2" class="type2" style="display:none;">
  <ul>
    <li><a href="#tabs-type2-1">ข้อมูลทั่วไป กองทุนเพื่อการป้องกันและปราบปรามฯ</a></li>
    <!--<li><a href="#tabs-type2-2">หลักการวัตถุประสงค์และอื่นๆ</a></li>-->
    <li><a href="#tabs-type2-3">กิจกรรม</a></li>
    <li><a href="#tabs-type2-4">ค่าใช้จ่าย</a></li>
  </ul>
  
<div id="tabs-type2-1" >
<table class="tbadd">
  <tr>
    <th>องค์การ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield36" type="text" id="textfield42" style="width:350px;" />      <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ปีงบประมาณ <span class="Txt_red_12"> *</span></th>
    <td><select name="select10" id="select11">
    </select></td>
  </tr>
  <tr>
    <th>โครงการ <span class="Txt_red_12"> *</span></th>
    <td><p><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
โครงการใหม่</span> <span>
<input name="textfield2" type="text" id="textfield2" style="width:350px;" />
    <select name="select11" id="select12">
      <option>-- เลือกการกระจาย --</option>
      <option selected="selected">แบบปกติ</option>
      <option>แบบกระจาย</option>
    </select>
    </p>
<p>
<input type="radio" name="radio" id="radio4" value="radio" /> 
โครงการต่อเนื่อง
      <input name="textfield4" type="text" id="textfield4" style="width:350px;" />
      <img src="images/see.png" width="24" height="24" /></p></td>
  </tr>
  <tr>
    <th>รหัสทะเบียนโครงการ</th>
    <td><input name="textfield6" type="text" id="textfield6" style="width:100px;"/></td>
  </tr>
  <tr>
    <th>รอบการพิจารณาที่   <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield37" type="text" id="textfield43" style="width:40px;"/></td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></th>
    <td><select name="select6" id="select5">
      <option>-- เลือกกลุ่มเ้ป้าหมาย --</option>
    </select>
      <input name="textfield12" type="text" id="textfield12" style="width:100px;" placeholder="จำนวน"/>
      <br />
      <textarea name="textfield11" rows="3" id="textfield11" style="width:500px;" placeholder="รายละเอียด"></textarea></td>
  </tr>
  <tr>
    <th>จำนวนคน<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield9" type="text" id="textfield9" style="width:100px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>พื้นที่ให้บริการจังหวัด<span class="Txt_red_12"> *</span></th>
    <td><select name="select7" id="select6">
      <option>-- เลือกจังหวัด --</option>
    </select>
      <br />
      <textarea name="textfield10" rows="3" id="textfield10" style="width:500px;" placeholder="พื้นที่"></textarea></td>
  </tr>
  <tr>
  	<th>แนบไฟล์ <img src="../images/question.png" width="24" height="24" class="vtip" title="หลักการและเหตุผล, 
วัตถุประสงค์ของโครงการ, 
วิธีดำเนินงานตามโครงการ, 
สถานที่ตั้งโครงการ, 
ระยะเวลาดำเนินงาน, 
ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์, 
อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ, 
การประเมินผล, 
ผลที่คาดว่าจะได้รับ" /></th>
    <td><input name="" type="file" /></td>
  </tr>
</table>
</div><!--tabs-type2-1-->



<!--<div id="tabs-type2-2">
<table class="tbadd">
 <tr>
   <th>หลักการและเหตุผล</th>
   <td><textarea name="textfield43" rows="3" id="textfield49" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วัตถุประสงค์ของโครงการ</th>
   <td><textarea name="textfield46" rows="3" id="textfield52" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วิธีดำเนินงานตามโครงการ</th>
   <td><textarea name="textfield47" rows="3" id="textfield53" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>สถานที่ตั้งโครงการ</th>
   <td><textarea name="textfield48" rows="3" id="textfield54" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ระยะเวลาดำเนินงาน</th>
   <td><textarea name="textfield49" rows="3" id="textfield55" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์</th>
   <td><textarea name="textfield50" rows="3" id="textfield56" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ</th>
   <td><textarea name="textfield51" rows="3" id="textfield57" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>การประเมินผล</th>
   <td><textarea name="textfield52" rows="3" id="textfield58" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผลที่คาดว่าจะได้รับ</th>
   <td><textarea name="textfield53" rows="3" id="textfield59" style="width:500px;"></textarea></td>
 </tr>
</table>
</div>--> <!--tabs-type2-2-->


<div id="tabs-type2-3">
<h3>กิจกรรม ของโครงการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กิจกรรม</th>
<th>ระยะเวลา</th>
<th>ค่าใช้จ่าย</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<h3>กิจกรรม ของโครงการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th><label for="fid-news_id">กิจกรรม<span class="Txt_red_12"> *</span></label>
     </th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:250px;"/></td>
</tr>
<tr>
  <th>ระยะเวลา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield14" type="text" id="textfield14" style="width:250px;"/></td>
</tr>
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield" type="text" id="textfield" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>

</div> <!--tabs-type2-3-->




<div id="tabs-type2-4">
<table class="tbadd">
 <tr>
   <th>ค่าใช้จ่ายทั้งโครงการ<span class="Txt_red_12"> *</span></th>
   <td><input name="textfield42" type="text" id="textfield48" style="width:100px;" readonly="readonly"/> 
     บาท</td>
 </tr>
 <tr>
   <th>ค่าใช้จ่ายที่ขอรับสนับสนุน<span class="Txt_red_12"> *</span></th>
   <td><input name="textfield44" type="text" id="textfield50" style="width:100px;" readonly="readonly"/>
บาท</td>
 </tr>
 <tr>
   <th>ค่าใช้จ่ายที่ได้รับ<span class="Txt_red_12"> *</span></th>
   <td><input name="textfield45" type="text" id="textfield51" style="width:100px;" readonly="readonly"/>
บาท</td>
 </tr>
 </table>
<h3>ค่าใช้จ่าย ของโครงการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ค่าใช้จ่าย</th>
<th>คชจ.ทั้งโครงการ (บาท)</th>
<th>คชจ.ที่เสนอขอ (บาท)</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>1.1 จัดสัมมนาเชิงปฏิบัติการเพื่อสร้างความรู้ความเข้าใจแก่เครือข่าย การทำงานด้านการช่วยเหลือเด็กไร้สถานะทางกฎหมายเขตกรุงเทพฯ</td>
<td>955,000.00</td>
<td>955,000.00</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>ค่าใช้จ่าย ของโครงการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span>
     </th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:350px;"/></td>
</tr>
<tr>
  <th>คชจ.ทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/>
บาท</td>
</tr>
<tr>
  <th>คชจ. ย่อยของทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield8" rows="5" id="textfield8" style="width:500px;"></textarea></td>
</tr>
<tr>
  <th>คชจ.ที่เสนอขอ</th>
  <td><input name="textfield3" type="text" id="textfield3" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>
</div> <!--tabs-type2-4-->

</div><!--tabs--><!-- กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์ -->





<div id="tabs3" class="type3" style="display:none;">
  <ul>
    <li><a href="#tabs-type3-1">ข้อมูลทั่วไป กองทุนส่งเสริมฯ</a></li>
    <!--<li><a href="#tabs-type3-2">หลักการวัตถุประสงค์และอื่นๆ</a></li>-->
    <li><a href="#tabs-type3-3">กิจกรรม</a></li>
    <li><a href="#tabs-type3-4">ค่าใช้จ่าย</a></li>
    <li><a href="#tabs-type3-5">กลุ่มเป้าหมาย</a></li>
    <li><a href="#tabs-type3-6">พื้นที่ดำเนินงาน</a></li>
  </ul>
  
<div id="tabs-type3-1" >
<table class="tbadd">
  <tr>
    <th>จังหวัด<span class="Txt_red_12"> *</span></th>
    <td><select name="select8" id="select7">
      <option>-- เลือกจังหวัด --</option>
    </select></td>
  </tr>
  <tr>
    <th>องค์การ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield36" type="text" id="textfield42" style="width:350px;" />      <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ปีงบประมาณ <span class="Txt_red_12"> *</span></th>
    <td><select name="select10" id="select11">
    </select></td>
  </tr>
  <tr>
    <th>โครงการ <span class="Txt_red_12"> *</span></th>
    <td><p><span>
      <input type="radio" name="radio" id="radio3" value="radio" />
โครงการใหม่</span>
<input name="textfield2" type="text" id="textfield2" style="width:350px;" />
    <select name="select11" id="select12">
      <option selected="selected">-- เลือกการกระจาย --</option>
      <option>แบบปกติ</option>
      <option>แบบกระจาย</option>
    </select>
    </p>
<p>
<input type="radio" name="radio" id="radio4" value="radio" /> 
โครงการต่อเนื่อง
      <input name="textfield4" type="text" id="textfield4" style="width:350px;" />
      <img src="images/see.png" width="24" height="24" /></p></td>
  </tr>
  <tr>
    <th>ลักษณะโครงการ</th>
    <td><select name="select9" id="select8">
      <option>-- เลือกลักษณะโครงการ --</option>
    </select>
      <select name="select14" id="select9">
        <option>-- เลือกสาขา --</option>
      </select>
      <br />
      <input name="textfield13" type="text" id="textfield13" style="width:350px;" placeholder="นโยบาย" />
      <br />
      <select name="select15" id="select10">
        <option>-- เลือกความสอดคล้องกับยุทธศาสตร์และแผน --</option>
      </select>
      <input name="textfield15" type="text" id="textfield15" style="width:250px;" /></td>
  </tr>
  <tr>
    <th>ความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆ</th>
    <td><select name="select16" id="select15">
      <option>-- เลือกความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆ --</option>
      </select></td>
  </tr>
  <tr>
    <th>ไตรมาสที่ <span class="Txt_red_12">*</span></th>
    <td><select name="select17" id="select16">
      <option>-- เลือกไตรมาส --</option>
      <option>ไตรมาสที่ 1</option>
      <option>ไตรมาสที่ 2</option>
      <option>ไตรมาสที่ 3</option>
      <option>ไตรมาสที่ 4</option>
      </select></td>
  </tr>
  <tr>
    <th>รหัสทะเบียนโครงการ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield16" type="text" id="textfield16" style="width:100px;"/></td>
  </tr>
  <tr>
    <th>รอบการพิจารณาที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield16" type="text" id="textfield17" style="width:40px;"/></td>
  </tr>
  <tr>
    <th>แผน <span class="Txt_red_12"> *</span></th>
    <td><select name="select18" id="select17">
      <option>-- เลือกแผน --</option>
    </select>
      <select name="select19" id="select18">
        <option>-- เลือกแผนย่อย --</option>
      </select></td>
  </tr>
  <tr>
    <th>ขนาดของโครงการ <span class="Txt_red_12">*</span></th>
    <td><select name="select20" id="select19">
      <option>-- เลือกขนาดของโครงการ --</option>
      <option> ต่ำกว่า 50,000 บาท</option>
      <option> 50,000 - 300,000 บาท</option>
      <option> 300,000 - 3,000,000 บาท</option>
      <option> มากกว่า 3,000,000 บาท ขึ้นไป</option>
    </select></td>
  </tr>
  <tr>
  	<th>แนบไฟล์ <img src="../images/question.png" width="24" height="24" class="vtip" title="หลักการและเหตุผล, 
วัตถุประสงค์ของโครงการ, 
วิธีดำเนินงานตามโครงการ, 
สถานที่ตั้งโครงการ, 
ระยะเวลาดำเนินงาน, 
ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์, 
อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ, 
การประเมินผล, 
ผลที่คาดว่าจะได้รับ, ผลผลิต/ผลลัพธ์, 
ภาคีการมีส่วนร่วมตามโครงการ" /></th>
    <td><input name="" type="file" /></td>
  </tr>
</table>
</div><!--tabs-type3-1-->



<!--<div id="tabs-type3-2">
<table class="tbadd">
 <tr>
   <th>หลักการและเหตุผล</th>
   <td><textarea name="textfield43" rows="3" id="textfield49" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วัตถุประสงค์ของโครงการ</th>
   <td><textarea name="textfield46" rows="3" id="textfield52" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>วิธีดำเนินงานตามโครงการ</th>
   <td><textarea name="textfield47" rows="3" id="textfield53" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>สถานที่ตั้งโครงการ</th>
   <td><textarea name="textfield48" rows="3" id="textfield54" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ระยะเวลาดำเนินงาน</th>
   <td><textarea name="textfield49" rows="3" id="textfield55" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผู้รับผิดชอบโครงการ/เบอร์โทรศัพท์</th>
   <td><textarea name="textfield50" rows="3" id="textfield56" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>อัตรากำลังเจ้าหน้าที่ที่ใช้ปฏิบัติงานตามโครงการ</th>
   <td><textarea name="textfield51" rows="3" id="textfield57" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>การประเมินผล</th>
   <td><textarea name="textfield52" rows="3" id="textfield58" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผลที่คาดว่าจะได้รับ</th>
   <td><textarea name="textfield53" rows="3" id="textfield59" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>ผลผลิต/ผลลัพธ์</th>
   <td><textarea name="textfield19" rows="3" id="textfield20" style="width:300px;" placeholder="ผลผลิต"></textarea>
     <textarea name="textfield20" rows="3" id="textfield21" style="width:300px;" placeholder="ตัวชี้วัด"></textarea>
     <br />
     <textarea name="textfield21" rows="3" id="textfield22" style="width:300px;" placeholder="ผลผลิต"></textarea>
     <textarea name="textfield21" rows="3" id="textfield23" style="width:300px;" placeholder="ตัวชี้วัด"></textarea>
     <br />
     <textarea name="textfield22" rows="3" id="textfield24" style="width:300px;" placeholder="ผลผลิต"></textarea>
     <textarea name="textfield22" rows="3" id="textfield25" style="width:300px;" placeholder="ตัวชี้วัด"></textarea></td>
 </tr>
 <tr>
   <th>ภาคีการมีส่วนร่วมตามโครงการ</th>
   <td><textarea name="textfield17" rows="3" id="textfield18" style="width:500px;"></textarea></td>
 </tr>
 <tr>
   <th>หมายเหตุ</th>
   <td><textarea name="textfield18" rows="3" id="textfield19" style="width:500px;"></textarea></td>
 </tr>
</table>
</div>--> <!--tabs-type3-2-->



<div id="tabs-type3-3">
<h3>กิจกรรม ของโครงการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กิจกรรม</th>
<th>ระยะเวลา</th>
<th>ค่าใช้จ่าย</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<h3>กิจกรรม ของโครงการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th><label for="fid-news_id">กิจกรรม<span class="Txt_red_12"> *</span></label>
     </th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:250px;"/></td>
</tr>
<tr>
  <th>ระยะเวลา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield14" type="text" id="textfield14" style="width:250px;"/></td>
</tr>
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield" type="text" id="textfield" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>

</div> <!--tabs-type3-3-->



<div id="tabs-type3-4">
<table class="tbadd">
  <tr>
    <th>ค่าใช้จ่ายสมทบ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield22" type="text" id="textfield28" style="width:100px;" readonly="readonly"/>
      บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ขอรับสนับสนุน<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield22" type="text" id="textfield27" style="width:100px;" readonly="readonly"/>
      บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ได้รับ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield22" type="text" id="textfield26" style="width:100px;" readonly="readonly"/>
      บาท</td>
  </tr>
</table>

<h3>ค่าใช้จ่าย ของโครงการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th style="width:40%">ชื่อค่าใช้จ่าย</th>
<th>คชจ.ทั้งโครงการ (บาท)</th>
<th>คชจ.ที่เสนอขอ (บาท)</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>1.1 จัดสัมมนาเชิงปฏิบัติการเพื่อสร้างความรู้ความเข้าใจแก่เครือข่าย การทำงานด้านการช่วยเหลือเด็กไร้สถานะทางกฎหมายเขตกรุงเทพฯ</td>
<td>955,000.00</td>
<td>955,000.00</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>



<h3>ค่าใช้จ่ายสมทบ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example83"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ชื่อองค์กร</th>
<th>ค่าใช้จ่ายสมทบ</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>โรงพยาบาลการไฟฟ้านครหลวง </td>
<td>955,000.00</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>ค่าใช้จ่าย ของโครงการ (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span>
     </th>
  <td><input name="textfield7" type="text" id="textfield7" style="width:350px;"/></td>
</tr>
<tr>
  <th>คชจ.ทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/>
บาท</td>
</tr>
<tr>
  <th>คชจ. ย่อยของทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield8" rows="5" id="textfield8" style="width:500px;"></textarea></td>
</tr>
<tr>
  <th>คชจ.ที่เสนอขอ</th>
  <td><input name="textfield3" type="text" id="textfield3" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example83" style="padding:10px; background:#fff;">
<h3>ค่าใช้จ่ายสมทบ (เพิ่ม/แก้ไข)</h3>

<table class="tbadd">
  <tr>
    <th>องค์กร<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield23" type="text" id="textfield29" style="width:350px;" />
      <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield22" type="text" id="textfield26" style="width:100px;"/>
      บาท</td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>
</div> <!--tabs-type3-4-->



<div id="tabs-type3-5">
<h3>กลุ่มเป้าหมาย</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example84"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ชื่อกลุ่มเป้าหมาย</th>
<th>จำนวน</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>เด็กและเยาวชน</td>
<td>270</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example84" style="padding:10px; background:#fff;">
<h3>กลุ่มเป้าหมาย (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th><label for="fid-news_id">ชื่อกลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></label>
     </th>
  <td><select name="select21" id="select20">
    <option>-- เลือกกลุ่มเป้าหมาย --</option>
  </select></td>
</tr>
<tr>
  <th>จำนวน<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield24" type="text" id="textfield30" style="width:100px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>

</div> <!--tabs-type3-5-->



<div id="tabs-type3-6">
<h3>พื้นที่ดำเนินงาน</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example85"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>จังหวัด</th>
<th>อำเภอ</th>
<th>ตำบล</th>
<th>หมู่บ้าน</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
    <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:block">
<div id="inline_example85" style="padding:10px; background:#fff;">
<h3>พื้นที่ดำเนินงาน (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span>
     </th>
  <td><select name="select22" id="select21">
    <option>-- เลือกจังหวัด --</option>
  </select></td>
</tr>
<tr>
  <th>อำเภอ<span class="Txt_red_12"> *</span></th>
  <td><select name="select23" id="select22">
    <option>-- เลือกอำเภอ --</option>
  </select></td>
</tr>
<tr>
  <th>ตำบล</th>
  <td><select name="select24" id="select23">
    <option>-- เลือกตำบล --</option>
  </select></td>
</tr>
<tr>
  <th>หมู่บ้าน<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield" type="text" id="textfield" style="width:300px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>

</div> <!--tabs-type3-6-->




</div><!--tabs--><!-- กองทุนส่งเสริมการจัดสวัสดิการสังคม -->




<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
