<h3>รายละเอียดการขอรับเงินสนับสนุน รายบุคคล</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
  <td>กองทุนคุ้มครองเด็ก
    <select name="select" id="select">
      <option>2557</option>
      <option>2556</option>
    </select></td>
</tr>
<tr>
  <th>จังหวัด <span class="Txt_red_12">*</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกจังหวัด --</option>
    </select></td>
</tr>
<tr>
  <th>วันเดือนปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield13" type="text" id="textfield13" style="width:80px;" />
    <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
</tr>
<tr>
  <th>ข้อมูลเด็ก <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield13" id="textfield14" style="width:350px;" />
    <img src="images/see.png" width="24" height="24" /></td>
</tr>
<tr>
  <th>ประเภทขอรับการช่วยเหลือ <span class="Txt_red_12">*</span></th>
  <td><span style="margin-right:20px;"><input type="radio" name="radio" id="radio" value="radio" />
    เด็กและครอบครัว</span>
      <input type="radio" name="radio" id="radio2" value="radio" /> 
      ครอบครัวอุปถัมภ์
</td>
</tr>
<tr>
  <th>สภาพปัญหาความเดือดร้อนโดยสรุป</th>
  <td><textarea name="textarea3" id="textarea3" style="width:500px; height:80px;"></textarea></td>
</tr>
<tr>
  <th>ข้อมูลผู้ขอ <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="textfield2" id="textfield25" style="width:350px;" />
    <img src="images/see.png" width="24" height="24" /></td>
</tr>
<tr>
  <th>ความเกี่ยวข้องกับเด็ก <span class="Txt_red_12">*</span></th>
  <td><span style="margin-right:20px;">
    <input type="radio" name="radio" id="radio3" value="radio" /> 
    บิดา/มารดา
</span>
    <span style="margin-right:20px;"><input type="radio" name="radio" id="radio4" value="radio" />
ญาติ </span>
<span style="margin-right:20px;"><input type="radio" name="radio" id="radio4" value="radio" />
ผู้ดูแล/ผู้อุปถัมภ์ </span>
<span><input type="radio" name="radio" id="radio4" value="radio" />
คนรู้จัก </span>
</td>
</tr>
</table>

<h3>ผลการพิจารณาของคณะอนุกรรมการ</h3>
<table class="tbadd">
<tr>
  <th>มติที่ประชุมครั้งที่ / ลงวันที่<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:50px;"/>
    /
    <input name="textfield2" type="text" id="textfield12" style="width:80px;" />
    <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
</tr>
<tr>
  <th>รายละเอียดการอนุมัติ <span class="Txt_red_12">*</span></th>
  <td><span style="margin-right:20px;">
    <input type="radio" name="radio" id="radio5" value="reject" /> 
    ไม่อนุมัติ
</span>
    <input type="radio" name="radio" id="radio6" value="approve" /> อนุมัติ </td>
</tr>
</table>


<div class="dvReject">
<table class="tbadd" style="margin:0;">
<tr>
  <th>&nbsp;</th>
  <td><textarea name="textarea" cols="" rows="" style="width:500px; height:100px;" placeholder="ระบุเหตุผล"></textarea></td>
</tr>
</table>
</div>


<div class="dvApprove">
<!--<div id="tabs">
<ul>
      <li><a href="#tabs-1">ข้อ 4(1) </a></li>
      <li><a href="#tabs-2">ข้อ 4(2) </a></li>
      <li><a href="#tabs-3">ข้อ 4(3) </a></li>
      <li><a href="#tabs-4">ข้อ 4(4) </a></li>
      <li><a href="#tabs-5">ข้อ 4(5) </a></li>
      <li><a href="#tabs-6">ข้อ 4(6) </a></li>
      <li><a href="#tabs-7">ข้อ 4(7) </a></li>
      <li><a href="#tabs-8">DNA </a></li>
      
    </ul>
    <div id="tabs-1">
ข้อ 4(1) 
        
</div>
    
    
    <div id="tabs-2">
     ข้อ 4(2) 
    </div>

</div>-->



<table class="tbadd" style="margin:0;">
<tr>
  <th>คำสั่งศาล  <span class="Txt_red_12">*</span></th>
  <td><select name="">
    <option value="nocommand">ไม่มีคำสั่งศาล</option>
    <option value="command">มีคำสั่งศาล</option>
  </select>
  <div class="boxAttachfile">
  <p><span>แนบคำสั่งศาล</span> <input name="" type="file" /></p>
  <p><span>แนบสำเนาบัตรประจำตัวประชาชน (เด็ก)</span> <input name="" type="file" /></p>
  <p><span>แนบสำเนาบัตรประจำตัวประชาชน (ผู้ขอ)</span> <input name="" type="file" /></p>
  </div>
  </td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>
 
  <span style="display:block;"> 
    ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ จำนวน
        <input name="textfield" type="text" id="textfield" style="width:20px;" readonly="readonly" />
ครั้ง/เดือน ครั้งละ
<input name="textfield22" type="text" id="textfield23" style="width:100px;" />
    บาท/เดือน  
    <span style="margin-left:20px;">รวมเป็นเงิน <input name="textfield23" type="text" id="textfield26" style="width:120px;" readonly="readonly" /> บาท</span>
  </span>
  <span style="margin-left:20px; display:block;"> ตั้งแต่เดือน 
  <select name="select4" id="select4">
    <option>-- เลือกเดือน --</option>
    <option>มกราคม</option>
    <option>กุมภาพันธ์</option>
  </select>
พ.ศ.

  <select name="select5" id="select5">
    <option>-- เลือกปี --</option>
    <option>2557</option>
    <option>2558</option>
  </select>
ถึง เดือน
<select name="select6" id="select6">
  <option>-- เลือกเดือน --</option>
  <option>มกราคม</option>
  <option>กุมภาพันธ์</option>
</select>
พ.ศ.
<select name="select7" id="select7">
  <option>-- เลือกปี --</option>
  <option>2557</option>
  <option>2558</option>
</select>
  </span></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td><span style="display:block; margin-bottom:20px;"> ข้อ 4(2) ค่าใช้จ่ายทางการศึกษา <span style="margin-left:333px;">รวมเป็นเงิน <input name="textfield23" type="text" id="textfield26" style="width:120px;" value="" readonly="readonly" /> บาท</span></span> 
    <span style="margin-left:50px; display:block;">ระดับ 
    <span style="margin-left:20px; display:inline-block; width:100px;">
    ประถมศึกษา</span>
    <span style="margin-right:20px;">จำนวน <input name="textfield8" type="text" id="textfield9" style="width:20px;" /> ปี</span>
     ปีละ <input name="textfield8" type="text" id="textfield9" style="width:100px;"  /> บาท <span style="margin-left:20px;">รวม <input name="textfield23" type="text" id="textfield26" style="width:120px;" readonly="readonly" /> บาท</span></span>
     
     <span style="margin-left:82px; display:block;">
     <span style="margin-left:20px; display:inline-block; width:100px;">  มัธยมศึกษา</span>
    <span style="margin-right:20px;">จำนวน <input name="textfield8" type="text" id="textfield9" style="width:20px;" /> ปี</span>
     ปีละ <input name="textfield8" type="text" id="textfield9" style="width:100px;"  /> บาท <span style="margin-left:20px;">รวม <input name="textfield23" type="text" id="textfield26" style="width:120px;" readonly="readonly" /> บาท</span>
     </span>
     
     <span style="margin-left:82px; display:block;">
     <span style="margin-left:20px; display:inline-block; width:100px;">  อาชีวศึกษา</span>
    <span style="margin-right:20px;">จำนวน <input name="textfield8" type="text" id="textfield9" style="width:20px;" /> ปี</span>
     ปีละ <input name="textfield8" type="text" id="textfield9" style="width:100px;"  /> บาท <span style="margin-left:20px;">รวม <input name="textfield23" type="text" id="textfield26" style="width:120px;" readonly="readonly" /> บาท</span>
     </span>
    </td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>
   ข้อ 4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล
      <input name="textfield8" type="text" id="textfield3" style="width:100px;" />
    บาท</td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>ข้อ 4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์
    <input name="textfield9" type="text" id="textfield24" style="width:100px;" /> บาท
    <p style="margin-left:20px;">ระบุประเภทกายอุปกรณ์ <input name="textfield9" type="text" id="textfield24" style="width:400px;" /></p>
    </td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td><span style="display:block;"> ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค จำนวน
      <input name="textfield10" type="text" id="textfield15" style="width:20px;" readonly="readonly" /> 
      เดือน
      เดือนละ
      <input name="textfield14" type="text" id="textfield28" style="width:100px;" />
บาท<span style="margin-left:20px;">รวมเป็นเงิน
<input name="textfield24" type="text" id="textfield27" style="width:120px;" readonly="readonly" />
บาท</span></span><span style="margin-left:20px; display:block;">ตั้งแต่เดือน
<select name="select8" id="select8">
  <option>-- เลือกเดือน --</option>
  <option>มกราคม</option>
  <option>กุมภาพันธ์</option>
</select>
พ.ศ.
<select name="select8" id="select9">
  <option>-- เลือกปี --</option>
  <option>2557</option>
  <option>2558</option>
</select>
ถึง เดือน
<select name="select8" id="select10">
  <option>-- เลือกเดือน --</option>
  <option>มกราคม</option>
  <option>กุมภาพันธ์</option>
</select>
พ.ศ.
<select name="select8" id="select11">
  <option>-- เลือกปี --</option>
  <option>2557</option>
  <option>2558</option>
</select>
</span></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td><span style="display:block;"> ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์ จำนวน
      <input name="textfield15" type="text" id="textfield29" style="width:20px;" readonly="readonly" />
เดือน เดือนละ
<input name="textfield15" type="text" id="textfield34" style="width:100px;" />
บาท<span style="margin-left:20px;">รวมเป็นเงิน
<input name="textfield25" type="text" id="textfield30" style="width:120px;" readonly="readonly" />
บาท</span></span><span style="margin-left:20px; display:block;">ตั้งแต่เดือน
<select name="select9" id="select12">
  <option>-- เลือกเดือน --</option>
  <option>มกราคม</option>
  <option>กุมภาพันธ์</option>
</select>
พ.ศ.
<select name="select9" id="select13">
  <option>-- เลือกปี --</option>
  <option>2557</option>
  <option>2558</option>
</select>
ถึง เดือน
<select name="select9" id="select14">
  <option>-- เลือกเดือน --</option>
  <option>มกราคม</option>
  <option>กุมภาพันธ์</option>
</select>
พ.ศ.
<select name="select9" id="select15">
  <option>-- เลือกปี --</option>
  <option>2557</option>
  <option>2558</option>
</select>
</span></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td> ข้อ 4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก
    <input name="textfield9" type="text" id="textfield33" style="width:100px;" />
    บาท</td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td> (พิเศษ) ค่าตรวจ DNA
    <input name="textfield9" type="text" id="textfield32" style="width:100px;" />
    บาท</td>
</tr>
</table>
</div>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>รายละเอียดการขอเงิน</h3>
<table class="tbadd2">
    <tr>
    <th>ประเภทหลักเกณฑ์</th>
    <th>จำนวนเงิน (บาท)</th>
    </tr>
    <tr>
    <td>ค่าเลี้ยงดู ค่าพาหนะ หรือค่าใช้จ่ายอื่น ๆ</td>
    <td><input name="textfield11" type="text" id="textfield10" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ค่าใช้จ่ายในการศึกษาและอุปกรณ์การศึกษา</td>
      <td><input name="textfield12" type="text" id="textfield11" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ค่าใช้จ่ายของครอบครัวเด็ก</td>
      <td><input name="textfield16" type="text" id="textfield16" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์แก่เด็กพิการ </td>
      <td><input name="textfield17" type="text" id="textfield17" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ให้การสงเคราะห์เกี่ยวกับเครื่องอุปโภคบริโภค</td>
      <td><input name="textfield18" type="text" id="textfield18" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ให้ความรู้และฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก</td>
      <td><input name="textfield19" type="text" id="textfield19" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ให้การสงเคราะห์ครอบครัวอุปถัมภ์</td>
      <td><input name="textfield20" type="text" id="textfield20" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ตามคำสั่งศาล</td>
      <td><input name="textfield21" type="text" id="textfield21" style="width:120px;" /></td>
    </tr>
    <tr>
      <td>ค่าตรวจ DNA</td>
      <td><input name="textfield22" type="text" id="textfield22" style="width:120px;" /></td>
    </tr>
    </table>





<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<!-- This contains the hidden content for inline calls -->
<div style="display:none;">
<div id="inline_example83" style="padding:10px; background:#fff;">
<h3>รายละเอียดการจ่ายเงิน</h3>
<table class="tbadd2">
    <tr>
      <th>ครั้งที่</th>
      <th>จำนวนเงิน (บาท)</th>
    <th>วันที่จ่ายเงิน</th>
    <th>ผู้รับเงิน</th>
    </tr>
    <tr>
      <td>1</td>
      <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>2</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>3</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>4</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>5</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>6</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>7</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>8</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>9</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    <tr>
      <td>10</td>
       <td><input name="textfield3" type="text" id="textfield4" style="width:120px;" /></td>
    <td><input name="textfield4" type="text" id="textfield5" style="width:80px;" />
      <img src="../images/calendar.png" alt="" width="16" height="16" /></td>
    <td><input type="text" name="textfield6" id="textfield7" style="width:200px;" placeholder="ชื่อ - สกุล" />      <input type="text" name="textfield5" id="textfield6" style="width:350px;" placeholder="ที่อยู่" /></td>
    </tr>
    </table>





<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>






