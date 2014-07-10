<h3>บันทึก องค์การสวัสดิการสังคม (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ประเภทหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td>
      <select name="select" style="margin-right:15px;">
        <option>-- เลือกประเภทหน่วยงาน --</option>
        <option value="1">หน่วยงานของรัฐ</option>
        <option value="2">องค์กรสาธารณประโยชน์</option>
        <option value="3">องค์กรสวัสดิการชุมชน</option>
    </select>
</td>
  </tr>
</table>

<div id="tabs" class="type1" style="display:none;">
  <ul>
    <li><a href="#tabs-type1-1">ข้อมูลทั่วไป</a></li>
    <li><a href="#tabs-type1-2">ข้อมูลบุคลากร</a></li>
    <li><a href="#tabs-type1-3">วัตถุประสงค์และกลุ่มเป้าหมาย</a></li>
    <li><a href="#tabs-type1-4">สถานะขั้นตอน</a></li>
  </ul>
  
<div id="tabs-type1-1" >
<table class="tbadd">
  <tr>
    <th>หน่วยงานของรัฐ</th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" />
ส่วนราชการ</span> <span>
<input type="radio" name="radio" id="radio2" value="radio" />
องค์กรปกครองส่วนท้องถิ่น</span></td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="textfield5" type="text" id="textfield5" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>สังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>กระทรวง <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield4" type="text" id="textfield4" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>หน่วยงานในสังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield6" type="text" id="textfield6" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี ที่ก่อตั้ง</th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="textfield11" type="text" id="textfield11" style="width:200px;"/>
    <br />
    จังหวัด 
    <select name="select2" id="select">
    </select>
    อำเภอ
    <select name="select3" id="select2">
    </select>
    ตำบล
    <select name="select4" id="select3">
    </select> 
    รหัสไปรณีย์
    <input name="textfield12" type="text" id="textfield12" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="textfield14" type="text" id="textfield14" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="textfield15" type="text" id="textfield15" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="textfield16" type="text" id="textfield16" style="width:250px;"/></td>
  </tr>
  <tr>
</table>
</div><!--tabs-type1-1-->



<div id="tabs-type1-2">
<table class="tbadd">
 <th>ผู้บริหารองค์การ</th>
    <td><select name="select5" id="select4">
      <option>-- คำนำหน้า --</option>
    </select>      
    <input name="textfield17" type="text" id="textfield17" style="width:250px;"/> 
    ตำแหน่ง 
    <input name="textfield18" type="text" id="textfield18" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td><select name="select6" id="select5">
      <option>-- คำนำหน้า --</option>
    </select>
      <input name="textfield19" type="text" id="textfield19" style="width:250px;"/>
ตำแหน่ง
<input name="textfield19" type="text" id="textfield20" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="textfield23" type="text" id="textfield25" style="width:50px;"/>
      หมู่ที่
      <input name="textfield23" type="text" id="textfield26" style="width:30px;"/>
      ตรอก/ซอย
      <input name="textfield23" type="text" id="textfield27" style="width:200px;"/>
      ถนน
      <input name="textfield23" type="text" id="textfield28" style="width:200px;"/>
      <br />
      จังหวัด
      <select name="select7" id="select6">
      </select>
      อำเภอ
      <select name="select7" id="select7">
      </select>
      ตำบล
      <select name="select7" id="select8">
      </select>
      รหัสไปรณีย์
      <input name="textfield23" type="text" id="textfield29" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="textfield20" type="text" id="textfield21" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="textfield21" type="text" id="textfield22" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="textfield22" type="text" id="textfield23" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="textfield23" type="text" id="textfield24" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>จำนวนข้าราชการและเจ้าหน้าที่
     </th>
    <td><input name="textfield24" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="textfield25" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="textfield26" type="text" id="textfield32" style="width:50px;"/>
คน</td>
  </tr>
</table>
</div> <!--tabs-type1-2-->



<div id="tabs-type1-3">
<table class="tbadd">
<tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="textfield27" rows="3" id="textfield33" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม</th>
    <td>
    <span><input name="checkbox2" type="checkbox" id="checkbox2" checked="checked" /> เยาวชน </span>
    <span><input type="checkbox" name="checkbox3" id="checkbox3" /> ผู้สูงอายุ </span>
	<span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้พิการหรือทุพพลภาพ </span>
    <span><input name="checkbox4" type="checkbox" id="checkbox4" checked="checked" /> สตรี </span>
    <span><input name="checkbox4" type="checkbox" id="checkbox4" checked="checked" /> ผู้ด้อยโอกาส </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ถูกละเมิดทางเพศ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ยากไร้ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ต้องโทษ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ว่างงาน </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ประสบภัยพิบัติ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> บุคคลเร่ร่อน </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ชนกลุ่มน้อย </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ติดเชื้อโรคอันตราย </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> เด็ก </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> อื่น ๆ  </span>
    
    <table class="tblist">
    <tr>
    <th>ลำดับ</th>
    <th>ชื่อกลุ่มเป้าหมาย</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
    </tr>
    <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">เยาวชน</td>
    <td style="width:40%"><input name="input3" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">2</td>
      <td style="width:30%">สตรี</td>
      <td style="width:40%"><input name="input2" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">3</td>
      <td style="width:30%">ผู้ด้อยโอกาส</td>
      <td style="width:40%"><input name="input" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
    </tr>
    </table>
    
    </td>
  </tr>
  <tr>
    <th>สาขาการให้บริการ</th>
    <td><span>
      <input name="checkbox5" type="checkbox" id="checkbox5" checked="checked" />
บริการทางสังคม </span> <span>
<input name="checkbox5" type="checkbox" id="checkbox6" checked="checked" />
การศึกษา </span> <span>
<input name="checkbox5" type="checkbox" id="checkbox7" checked="checked" />
สุขภาพอนามัย </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
ที่อยู่อาศัย </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
แรงงาน/การฝึกอาชีพ/การประกอบอาชีพ </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
กระบวนการยุติธรรม </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
นันทนาการ </span><span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
อื่น ๆ </span>
<table class="tblist">
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อสาขาการให้บริการ</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
  </tr>
  <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">การศึกษา</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">สุขภาพอนามัย</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">บริการทางสังคม</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการ</th>
    <td><span>
      <input name="checkbox6" type="checkbox" id="checkbox8" checked="checked" />
การส่งเสริม </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox9" />
การพัฒนา </span> <span>
<input name="checkbox6" type="checkbox" id="checkbox10" checked="checked" />
การคุ้มครอง </span> <span>
<input name="checkbox6" type="checkbox" id="checkbox10" checked="checked" />
การแก้ไข </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การบำบัดฟื้นฟู </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การสงเคราะห์ </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การป้องกัน </span><span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
อื่น ๆ </span>
<table class="tblist">
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อลักษณะการดำเนินการ</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
  </tr>
  <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">การส่งเสริม</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">การคุ้มครอง</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">การแก้ไข</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="textfield28" rows="3" id="textfield34" style="width:500px;"></textarea></td>
  </tr>
 
</table>
</div><!--tabs-type1-3-->


<div id="tabs-type1-4">
<table class="tbadd">
 <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="select3">
    <option>-- สถานะ --</option>
    <option>รับเรื่อง</option>
    <option>อนุรับรอง</option>
    <option>ส่งใบสำคัญ</option>
    <option>ประกาศกิจจานุเบกษา</option>
    <option>ไม่รับรอง</option>
  </select></td>
  </tr>
</table>
</div> <!--tabs-type1-4-->

</div><!--tabs--><!-- หน่วยงานของรัฐ -->





<div id="tabs2" class="type2" style="display:none;">
  <ul>
    <li><a href="#tabs-type2-1">ข้อมูลทั่วไป</a></li>
    <li><a href="#tabs-type2-2">ข้อมูลบุคลากร</a></li>
    <li><a href="#tabs-type2-3">วัตถุประสงค์และกลุ่มเป้าหมาย</a></li>
    <li><a href="#tabs-type2-4">อื่นๆ</a></li>
    <li><a href="#tabs-type2-5">สถานะขั้นตอน</a></li>
  </ul>
  
<div id="tabs-type2-1" >
<table class="tbadd">
<tr>
    <th>องค์กรสาธารณประโยชน์</th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" />
มูลนิธิ</span> <span>
<input type="radio" name="radio" id="radio2" value="radio" />
สมาคม    </span><span><input type="radio" name="radio" id="radio2" value="radio" />
องค์กรภาคเอกชน    </span></td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="textfield5" type="text" id="textfield5" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียนก่อตั้งหน่วยงานหรือปีที่เริ่มดำเนินการ</th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="textfield11" type="text" id="textfield11" style="width:200px;"/>
    <br />
    จังหวัด 
    <select name="select2" id="select">
    </select>
    อำเภอ
    <select name="select3" id="select2">
    </select>
    ตำบล
    <select name="select4" id="select3">
    </select> 
    รหัสไปรณีย์
    <input name="textfield12" type="text" id="textfield12" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="textfield14" type="text" id="textfield14" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="textfield15" type="text" id="textfield15" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="textfield16" type="text" id="textfield16" style="width:250px;"/></td>
  </tr>
</table>s
</div><!--tabs-type2-1-->



<div id="tabs-type2-2">
<table class="tbadd">
 <tr>
    <th>ผู้บริหารองค์การ</th>
    <td><select name="select5" id="select4">
      <option>-- คำนำหน้า --</option>
    </select>      
    <input name="textfield17" type="text" id="textfield17" style="width:250px;"/> 
    ตำแหน่ง 
    <input name="textfield18" type="text" id="textfield18" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td><select name="select6" id="select5">
      <option>-- คำนำหน้า --</option>
    </select>
      <input name="textfield19" type="text" id="textfield19" style="width:250px;"/>
ตำแหน่ง
<input name="textfield19" type="text" id="textfield20" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="textfield23" type="text" id="textfield25" style="width:50px;"/>
      หมู่ที่
      <input name="textfield23" type="text" id="textfield26" style="width:30px;"/>
      ตรอก/ซอย
      <input name="textfield23" type="text" id="textfield27" style="width:200px;"/>
      ถนน
      <input name="textfield23" type="text" id="textfield28" style="width:200px;"/>
      <br />
      จังหวัด
      <select name="select7" id="select6">
      </select>
      อำเภอ
      <select name="select7" id="select7">
      </select>
      ตำบล
      <select name="select7" id="select8">
      </select>
      รหัสไปรณีย์
      <input name="textfield23" type="text" id="textfield29" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="textfield20" type="text" id="textfield21" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="textfield21" type="text" id="textfield22" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="textfield22" type="text" id="textfield23" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="textfield23" type="text" id="textfield24" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>จำนวนบุคลากร</th>
    <td><input name="textfield24" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="textfield25" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="textfield26" type="text" id="textfield32" style="width:50px;"/>
คน</td>
  </tr>
</table>
</div> <!--tabs-type2-2-->



<div id="tabs-type2-3">
<table class="tbadd">
<tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="textfield27" rows="3" id="textfield33" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="textfield29" type="text" id="textfield35" style="width:80px;"/>
หมู่บ้าน/ชุมชน    
<input name="textfield30" type="text" id="textfield36" style="width:50px;"/> 
ตำบล/แขวง 
<input name="textfield31" type="text" id="textfield37" style="width:50px;"/>

   อำเภอ/เขต 
      <input name="textfield32" type="text" id="textfield38" style="width:50px;"/>
จังหวัด 
<input name="textfield33" type="text" id="textfield39" style="width:50px;"/>
   </td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม <span class="Txt_red_12"> *</span></th>
    <td>
	<span><input type="checkbox" name="checkbox4" id="checkbox4" /> เด็ก </span>
    <span><input name="checkbox2" type="checkbox" id="checkbox2" checked="checked" /> เยาวชน </span>
    <span><input name="checkbox4" type="checkbox" id="checkbox4" checked="checked" /> สตรี </span>
    <span><input name="checkbox4" type="checkbox" id="checkbox4" /> คนชรา/ผู้สูงอายุ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้พิการหรือทุพพลภาพ </span> 
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ยากไร้ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> บุคคลเร่ร่อน </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ถูกละเมิดทางเพศ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ต้องโทษ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ว่างงาน </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ประสบภัยพิบัติ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ติดเชื้อเอชไอวี </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ครอบครัว </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> แรงงานนอกระบบ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> แรงงานข้ามชาติและแรงงานต่างด้าว </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ที่มีปัญหาสถานะบุคคล/คนไร้สัญชาติ/ชนกลุ่มน้อย ระบุ รายละเอียด </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ที่อยู่ในกระบวนการยุติธรรม </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> คนจากจังหวัดชายแดนภาคใต้ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> คนไทยในต่างประเทศ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> บุคคลที่มีความหลากหลายทางเพศ </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ด้อยโอกาสหรือกลุ่มเป้าหมายอื่น </span>
    
    
    
    
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> บุคคลเร่ร่อน </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ชนกลุ่มน้อย </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> ผู้ติดเชื้อโรคอันตราย </span>
    <span><input type="checkbox" name="checkbox4" id="checkbox4" /> อื่น ๆ  </span>
    
    <table class="tblist">
    <tr>
    <th>ลำดับ</th>
    <th>ชื่อกลุ่มเป้าหมาย</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
    </tr>
    <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">เยาวชน</td>
    <td style="width:40%"><input name="input3" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">2</td>
      <td style="width:30%">สตรี</td>
      <td style="width:40%"><input name="input2" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">3</td>
      <td style="width:30%">ผู้ด้อยโอกาส</td>
      <td style="width:40%"><input name="input" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
    </tr>
    </table>
    
    </td>
  </tr>
  <tr>
    <th>สาขาการให้บริการ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input name="checkbox5" type="checkbox" id="checkbox5" checked="checked" />
บริการทางสังคม </span> <span>
<input name="checkbox5" type="checkbox" id="checkbox6" checked="checked" />
การศึกษา </span> <span>
<input name="checkbox5" type="checkbox" id="checkbox7" checked="checked" />
สุขภาพอนามัย </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
ที่อยู่อาศัย </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
แรงงาน/การฝึกอาชีพ/การประกอบอาชีพ </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
กระบวนการยุติธรรม </span> <span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
นันทนาการ </span><span>
<input type="checkbox" name="checkbox5" id="checkbox7" />
อื่น ๆ </span>
<table class="tblist">
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อสาขาการให้บริการ</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
  </tr>
  <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">การศึกษา</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">สุขภาพอนามัย</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">บริการทางสังคม</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input name="checkbox6" type="checkbox" id="checkbox8" checked="checked" />
การส่งเสริม </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox9" />
การพัฒนา </span> <span>
<input name="checkbox6" type="checkbox" id="checkbox10" checked="checked" />
การคุ้มครอง </span> <span>
<input name="checkbox6" type="checkbox" id="checkbox10" checked="checked" />
การแก้ไข </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การบำบัดฟื้นฟู </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การสงเคราะห์ </span> <span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
การป้องกัน </span><span>
<input type="checkbox" name="checkbox6" id="checkbox10" />
อื่น ๆ </span>
<table class="tblist">
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อลักษณะการดำเนินการ</th>
    <th>ระบุ</th>
    <th>เลื่อน</th>
  </tr>
  <tr>
    <td style="width:10%">1</td>
    <td style="width:30%">การส่งเสริม</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">การคุ้มครอง</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">การแก้ไข</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
</table>
</div><!--tabs-type2-3-->


<div id="tabs-type2-4">
<table class="tbadd">
<tr>
    <th>รูปแบบการดำเนินการ
     </th>
    <td>
    <span><input name="checkbox7" type="checkbox" id="checkbox11" /> ผ่านการตรวจสอบ(means-test) ระบุ
<input name="input6" type="text" style="width:100px;" /></span>
<span>
<input type="checkbox" name="checkbox7" id="checkbox12" />
มีส่วนร่วม ระบุ <input name="input6" type="text" style="width:100px;" /></span> 
<span>
<input name="checkbox7" type="checkbox" id="checkbox13" />
สิทธิ ระบุ <input name="input6" type="text" style="width:100px;" /></span>
<span>
<input name="checkbox8" type="checkbox" id="checkbox14" /> 
อื่นๆ ระบุ <input name="input6" type="text" style="width:100px;" />
</span></td>
  </tr>
  <tr>
    <th>วิธีการดำเนินการ</th>
    <td><span>
      <input name="checkbox9" type="checkbox" id="checkbox15" />
สังคมสงเคราะห์เฉพาะราย ระบุ
<input name="input7" type="text" style="width:100px;" />
    </span> <span>
    <input type="checkbox" name="checkbox9" id="checkbox16" />
สวัสดิการกลุ่มชน ระบุ
<input name="input7" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox9" type="checkbox" id="checkbox17" />
จัดระเบียบชุมชน/พัฒนาชุมชน ระบุ
<input name="input7" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox9" type="checkbox" id="checkbox18" />
วิจัย  ระบุ
<input name="input7" type="text" style="width:100px;" /></span>
   <span> <input name="checkbox10" type="checkbox" id="checkbox19" />
บริหาร  ระบุ
<input name="input8" type="text" style="width:100px;" /></span>
<span>
<input name="checkbox11" type="checkbox" id="checkbox20" />
การกระทำทางสังคม  ระบุ
<input name="input9" type="text" style="width:100px;" />
    </span></td>
  </tr>
  <tr>
    <th>รูปแบบการให้บริการ </th>
    <td><span>
      <input name="checkbox12" type="checkbox" id="checkbox21" />
เงิน(in cash)  ระบุ
<input name="input10" type="text" style="width:100px;" />
    </span> <span>
    <input type="checkbox" name="checkbox12" id="checkbox22" />
วัสดุอุปกรณ์(in kind)  ระบุ
<input name="input10" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox12" type="checkbox" id="checkbox23" />
บริการ(in service)   ระบุ
<input name="input10" type="text" style="width:100px;" />
    </span></td>
  </tr>
  <tr>
    <th>การส่งเสริมและสนับสนุนให้องค์กรต่างๆ ได้มีส่วนร่วมในการจัดสวัสดิการสังคม </th>
    <td><span>
      <input name="checkbox13" type="checkbox" id="checkbox24" />
บุคคล ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span> <span>
    <input type="checkbox" name="checkbox13" id="checkbox25" />
ครอบครัว ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox13" type="checkbox" id="checkbox26" />
ชุมชน ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox13" type="checkbox" id="checkbox27" />
องค์กรปกครองส่วนท้องถิ่น  ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox13" type="checkbox" id="checkbox28" />
องค์กรวิชาชีพ  ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox13" type="checkbox" id="checkbox29" />
สถาบันศาสนา  ระบุ
<input name="input11" type="text" style="width:100px;" />
    </span><span>
    <input name="checkbox14" type="checkbox" id="checkbox30" />
อื่นๆ ระบุ
 <input name="input12" type="text" style="width:100px;" />
    </span></td>
  </tr>
  <tr>
    <th>ได้รับการสนับสนุนตาม พ.ร.บ. ส่งเสริมการจัดสวัสดิการทางสังคม พ.ศ. 2546 </th>
    <td><span>
      <input name="checkbox15" type="checkbox" id="checkbox31" />
ด้านวิชาการ(อบรม) ระบุ
<input name="input13" type="text" style="width:100px;" />
    </span> <span>
    <input type="checkbox" name="checkbox15" id="checkbox32" />
กองทุน(ทุน) ระบุ
<input name="input13" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox15" type="checkbox" id="checkbox33" />
มาตรฐาน(รับรองมาตรฐาน) ระบุ
<input name="input13" type="text" style="width:100px;" />
    </span> <span>
    <input name="checkbox15" type="checkbox" id="checkbox34" />
อื่นๆ ระบุ
<input name="input13" type="text" style="width:100px;" />
    </span></td>
  </tr>
  <tr>
    <th>งบประมาณดำเนินการ </th>
    <td>ปีที่ผ่านมา
      <select name="select8" id="select9">
        <option>-- เลือกปี --</option>
      </select>
<span>จำนวนเงิน
<input name="input14" type="text" style="width:120px;" />
บาท</span>เงินทุน
<input name="input15" type="text" style="width:120px;" />
บาท</td>
  </tr>
  <tr>
    <th>เอกสารตีพิมพ์ </th>
    <td><span style="width:40%">
      <input name="input16" type="text" style="width:350px;" />
    </span></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="textfield28" rows="3" id="textfield34" style="width:500px;"></textarea></td>
  </tr>

</table>
</div><!--tabs-type2-4-->


<div id="tabs-type2-5">
<table class="tbadd">
  <tr>
    <th>จดทะเบียนองค์กร</th>
    <td><input type="checkbox" name="checkbox" id="checkbox" />
    จดทะเบียน</td>
  </tr>
 <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="select3">
    <option>-- สถานะ --</option>
    <option>รับเรื่อง</option>
    <option>อนุรับรอง</option>
    <option>ส่งใบสำคัญ</option>
    <option>ประกาศกิจจานุเบกษา</option>
    <option>ไม่รับรอง</option>
  </select></td>
  </tr>
</table>
</div> <!--tabs-type2-5-->


</div><!--tabs-type2-->
<!-- องค์กรสาธารณประโยชน์ -->






<div id="tabs3" class="type3" style="display:none;">
  <ul>
    <li><a href="#tabs-type3-1">ข้อมูลทั่วไป</a></li>
    <li><a href="#tabs-type3-2">สวัสดิการและวิธีการดำเนินงาน</a></li>
    <li><a href="#tabs-type3-3">สถานะขั้นตอน</a></li>
  </ul>
  
<div id="tabs-type3-1" >
<table class="tbadd">
<tr>
    <th>องค์กรสวัสดิการชุมชน</th>
    <td><span>
      <input type="radio" name="radio" id="radio" value="radio" />
องค์กรสวัสดิการชุมชน</span> <span>
<input type="radio" name="radio" id="radio2" value="radio" />
เครือข่ายองค์กรสวัสดิการชุมชน</span></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="textfield5" type="text" id="textfield5" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียน</th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="textfield34" rows="3" id="textfield40" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="textfield11" type="text" id="textfield11" style="width:200px;"/>
    <br />
    จังหวัด 
    <select name="select2" id="select">
    </select>
    อำเภอ
    <select name="select3" id="select2">
    </select>
    ตำบล
    <select name="select4" id="select3">
    </select> 
    รหัสไปรณีย์
    <input name="textfield12" type="text" id="textfield12" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="textfield14" type="text" id="textfield14" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="textfield15" type="text" id="textfield15" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="textfield16" type="text" id="textfield16" style="width:250px;"/></td>
  </tr>
</table>
</div><!--tabs-type3-1-->



<div id="tabs-type3-2">
<table class="tbadd">
<tr>
    <th>ลักษณะการดำเนินการองค์กร</th>
    <td><p><input type="checkbox" name="checkbox46" id="checkbox46" />
    การจัดสวัสดิการจากฐานองค์กรการเงินชุมชน</p>
<p>    <input type="checkbox" name="checkbox17" id="checkbox47" />
การจัดสวัสดิการจากฐานการผลิตและธุรกิจชุมชน</p>
<p><input type="checkbox" name="checkbox18" id="checkbox48" />
การจัดสวัสดิการจากฐานทรัพยากรธรรมชาติและสิ่งแวดล้อม</p>
<p><input type="checkbox" name="checkbox19" id="checkbox58" />
การจัดสวัสดิการจากฐานอุดมการณ์/ศาสนา</p>
<p><input type="checkbox" name="checkbox20" id="checkbox59" />
การจัดสวัสดิการจากฐานผู้ยากลำบาก</p>
<p><input type="checkbox" name="checkbox21" id="checkbox60" />
เครือข่ายองค์กรสวัสดิการชุมชน จำนวน   
<input name="textfield35" type="text" id="textfield41" style="width:50px;"/>
องค์กร</p>
<input type="checkbox" name="checkbox22" id="checkbox61" />
อื่นๆ</td>
  </tr>
  <tr>
    <th>จำนวนสมาชิก
     </th>
    <td><input name="textfield24" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="textfield29" type="text" id="textfield35" style="width:80px;"/>
หมู่บ้าน/ชุมชน    
<input name="textfield30" type="text" id="textfield36" style="width:50px;"/> 
ตำบล/แขวง 
<input name="textfield31" type="text" id="textfield37" style="width:50px;"/>

   อำเภอ/เขต 
      <input name="textfield32" type="text" id="textfield38" style="width:50px;"/>
จังหวัด 
<input name="textfield33" type="text" id="textfield39" style="width:50px;"/>
   </td>
  </tr>
  <tr>
    <th>จำนวนผู้ปฎิบัติงาน
     </th>
    <td><input name="textfield25" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>สวัสดิการบริการที่จัดให้แก่สมาชิก</th>
    <td><span>
      <input name="checkbox16" type="checkbox" id="checkbox55" checked="checked" />
      เกิด </span> <span>
        <input name="checkbox16" type="checkbox" id="checkbox56" checked="checked" />
        แก่ </span> <span>
          <input name="checkbox16" type="checkbox" id="checkbox57" checked="checked" />
          เจ็บ/สุขภาพ </span> <span>
            <input type="checkbox" name="checkbox16" id="checkbox57" />
            ตาย </span> <span>
              <input type="checkbox" name="checkbox16" id="checkbox57" />
              การเงิน/อาชีพ </span> <span>
                <input type="checkbox" name="checkbox16" id="checkbox57" />
                การศึกษา </span> <span>
                  <input type="checkbox" name="checkbox16" id="checkbox57" />
                  ผู้ด้อยโอกาส </span><span>
                    <input type="checkbox" name="checkbox16" id="checkbox57" />
                    อื่น ๆ </span>
      <table class="tblist">
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อสวัสดิการบริการ</th>
          <th>ระบุ</th>
          <th>เลื่อน</th>
        </tr>
        <tr>
          <td style="width:10%">1</td>
          <td style="width:30%">เกิด</td>
          <td style="width:40%"><input name="input16" type="text" style="width:350px;" /></td>
          <td style="width:10%"><img src="images/down.png" width="16" height="16" /></td>
        </tr>
        <tr>
          <td style="width:10%">2</td>
          <td style="width:30%">แก่</td>
          <td style="width:40%"><input name="input16" type="text" style="width:350px;" /></td>
          <td style="width:10%"><img src="images/down.png" width="16" height="16" /><img src="images/up.png" width="16" height="16" /></td>
        </tr>
        <tr>
          <td style="width:10%">3</td>
          <td style="width:30%"> เจ็บ/สุขภาพ</td>
          <td style="width:40%"><input name="input16" type="text" style="width:350px;" /></td>
          <td style="width:10%"><img src="images/up.png" width="16" height="16" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <th>วิธีการดำเนินการ</th>
    <td><span>
      <input name="checkbox16" type="checkbox" id="checkbox49" />
      สังคมสงเคราะห์เฉพาะราย ระบุ
      <input name="input16" type="text" style="width:100px;" />
      </span> <span>
        <input type="checkbox" name="checkbox16" id="checkbox50" />
        สวัสดิการกลุ่มชน ระบุ
        <input name="input16" type="text" style="width:100px;" />
        </span> <span>
          <input name="checkbox16" type="checkbox" id="checkbox51" />
          จัดระเบียบชุมชน/พัฒนาชุมชน ระบุ
          <input name="input16" type="text" style="width:100px;" />
          </span> <span>
            <input name="checkbox16" type="checkbox" id="checkbox52" />
            วิจัย  ระบุ
            <input name="input16" type="text" style="width:100px;" />
            </span> <span>
              <input name="checkbox16" type="checkbox" id="checkbox53" />
              บริหาร  ระบุ
              <input name="input16" type="text" style="width:100px;" />
              </span> <span>
                <input name="checkbox16" type="checkbox" id="checkbox54" />
                การกระทำทางสังคม  ระบุ
                <input name="input16" type="text" style="width:100px;" />
              </span></td>
  </tr>
  <tr>
    <th>การส่งเสริมและสนับสนุนให้องค์กรต่างๆ ได้มีส่วนร่วมในการจัดสวัสดิการสังคม </th>
    <td><span>
      <input name="checkbox16" type="checkbox" id="checkbox39" />
      บุคคล ระบุ
      <input name="input16" type="text" style="width:100px;" />
      </span> <span>
        <input type="checkbox" name="checkbox16" id="checkbox40" />
        ครอบครัว ระบุ
        <input name="input16" type="text" style="width:100px;" />
        </span> <span>
          <input name="checkbox16" type="checkbox" id="checkbox41" />
          ชุมชน ระบุ
          <input name="input16" type="text" style="width:100px;" />
          </span> <span>
            <input name="checkbox16" type="checkbox" id="checkbox42" />
            องค์กรปกครองส่วนท้องถิ่น  ระบุ
            <input name="input16" type="text" style="width:100px;" />
            </span> <span>
              <input name="checkbox16" type="checkbox" id="checkbox43" />
              องค์กรวิชาชีพ  ระบุ
              <input name="input16" type="text" style="width:100px;" />
              </span> <span>
                <input name="checkbox16" type="checkbox" id="checkbox44" />
                สถาบันศาสนา  ระบุ
                <input name="input16" type="text" style="width:100px;" />
                </span><span>
                  <input name="checkbox16" type="checkbox" id="checkbox45" />
                  อื่นๆ ระบุ
                  <input name="input16" type="text" style="width:100px;" />
                </span></td>
  </tr>
  <tr>
    <th>ได้รับการสนับสนุนตาม พ.ร.บ. ส่งเสริมการจัดสวัสดิการทางสังคม พ.ศ. 2546 </th>
    <td><span>
      <input name="checkbox16" type="checkbox" id="checkbox35" />
      ด้านวิชาการ(อบรม) ระบุ
      <input name="input16" type="text" style="width:100px;" />
      </span> <span>
        <input type="checkbox" name="checkbox16" id="checkbox36" />
        กองทุน(ทุน) ระบุ
        <input name="input16" type="text" style="width:100px;" />
        </span> <span>
          <input name="checkbox16" type="checkbox" id="checkbox37" />
          มาตรฐาน(รับรองมาตรฐาน) ระบุ
          <input name="input16" type="text" style="width:100px;" />
          </span> <span>
            <input name="checkbox16" type="checkbox" id="checkbox38" />
            อื่นๆ ระบุ
            <input name="input16" type="text" style="width:100px;" />
          </span></td>
  </tr>
  <tr>
    <th>งบประมาณดำเนินการ </th>
    <td>ปีที่ผ่านมา
      <select name="select9" id="select10">
        <option>-- เลือกปี --</option>
      </select>
      <span>จำนวนเงิน
        <input name="input16" type="text" style="width:120px;" />
        บาท</span>
        <p>เงินที่มาจากสมาชิก
        <input name="input16" type="text" style="width:120px;" />
      บาท</p>
      เงินสมทบจากภายนอก
      <p style="margin-left:30px;">- องค์กรปกครองส่วนท้องถิ่น  จำนวน 
      <input name="input17" type="text" style="width:120px;" />
บาท </p><p style="margin-left:30px;">
- หน่วยงานอื่น   จำนวน
<input name="input18" type="text" style="width:120px;" />
บาท </p>
เงินอื่นๆ   จำนวน
<input name="input19" type="text" style="width:120px;" />
บาท </td>
  </tr>
  <tr>
    <th>อื่นๆ
     </th>
    <td><textarea name="textfield28" rows="3" id="textfield34" style="width:500px;"></textarea></td>
  </tr>
</table>
</div> <!--tabs-type3-2-->


<div id="tabs-type3-3">
<table class="tbadd">
  <tr>
    <th>จดทะเบียนองค์กร</th>
    <td><input type="checkbox" name="checkbox" id="checkbox" />
    จดทะเบียน</td>
  </tr>
 <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="select3">
    <option>-- สถานะ --</option>
    <option>รับเรื่อง</option>
    <option>อนุรับรอง</option>
    <option>ส่งใบสำคัญ</option>
    <option>ประกาศกิจจานุเบกษา</option>
    <option>ไม่รับรอง</option>
  </select></td>
  </tr>
</table>
</div> <!--tabs-type2-5-->

</div><!--tabs-type3-->
<!-- องค์กรสวัสดิการชุมชน -->




<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
