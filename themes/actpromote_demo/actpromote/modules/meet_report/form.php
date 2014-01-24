<h3>บันทึก รายงานการประชุม (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>เรื่องการประชุม <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>วาระการประชุม <span class="Txt_red_12">*</span></th>
    <td><input name="textfield4" type="text" id="textfield4" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>วันที่ประชุม</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:80px;"/>
      <img src="../images/calendar.png" width="16" height="16" />
      เวลา
      <input name="textfield6" type="text" id="textfield6" style="width:50px;"/></td>
  </tr>
  <tr>
    <th>ครั้งที่</th>
    <td><input name="textfield15" type="text" id="textfield15" style="width:30px;"/></td>
  </tr>
  <tr>
    <th>พ.ศ.</th>
    <td><input name="textfield16" type="text" id="textfield16" style="width:50px;"/></td>
  </tr>
  <tr>
    <th>สถานที่</th>
    <td><input name="textfield17" type="text" id="textfield17" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>สรุปสาระสำคัญ</th>
    <td><textarea name="textfield18" rows="3" id="textfield18" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>รายละเอียด</th>
    <td><textarea name="textfield18" rows="3" id="textfield19" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>มติที่ประชุม</th>
    <td><textarea name="textfield" rows="3" id="textfield" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>ผู้จดรายงานการประชุม</th>
    <td><input name="textfield13" type="text" id="textfield13" style="width:200px;"/> 
      ตำแหน่ง 
      <input name="textfield7" type="text" id="textfield7" style="width:250px;"/></td>
</tr>
<tr>
  <th>ผู้ตรวจรายงานการประชุม</th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:200px;"/>
ตำแหน่ง
  <input name="textfield8" type="text" id="textfield8" style="width:250px;"/></td>
</tr>
<tr>
  <th>ไฟล์เอกสาร</th>
  <td><input type="file" name="fileField" id="fileField" /></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

