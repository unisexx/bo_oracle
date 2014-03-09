<script>
function startDesktop(f)
{
  var desktop = window.open("act/fund_welfare/list_project?var=project_continue", "_blank", "toolbar=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=1024,height=768");
}
</script>

<h3>บันทึก กองทุนส่งเสริมการจัดสวัสดิการสังคม (บันทึก / แก้ไข)</h3>

<form id="composeform" method="post" action="act/fund_welfare/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>กองทุน<span class="Txt_red_12"> *</span></th>
    <td>กองทุนส่งเสริมการจัดสวัสดิการสังคม
    	<?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$project['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>องค์การ
     <span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" value="<?=act_get_organ_name($project['org_id'])?>" style="width:300px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ปีงบประมาณ</th>
    <td>
    	<select name="budget_year">
	      <option value="">-- ปีงบประมาณ --</option>
	      <?php for ($x=date("Y")+543; $x>=2546; $x--):?>
	      <option value="<?php echo $x?>" <?php echo ($x == $project['budget_year'])?'selected':'';?>><?php echo $x?></option>
	      <?php endfor;?>
	    </select>
    </td>
  </tr>
  <tr>
    <th>โครงการ</th>
    <td>
    <p><span>
      <input type="radio" name="project_type" value="1" <?=($project['project_type'] == 1 )?'checked':'';?> />
ชื่อโครงการ </span>
      <input name="project_name" type="text" style="width:300px;" value="<?=$project['project_name']?>"/>
      
      <!-- <input type="text" name="DIS_NAME" id="DIS_NAME" value="ระบบกระจาย" disabled="disabled">
      <input type="hidden" name="DIS" id="DIS" value="2"> -->
      
      <select name="dis2">
        <option value="0">-- เลือกประเภทการกระจาย --</option>
        <option value="1">เชิงประเด็น</option>
        <option value="2">เชิงพื้นที่</option>
        <option value="3">ภาครวมของประเทศ</option>
      </select>
    </p>

<p><span>
<input type="radio" name="project_type" value="2" <?=($project['project_type'] == 2 )?'checked':'';?> />
โครงการต่อเนื่อง </span>
  <input name="project_continue_name" type="text" value="<?=($project['project_type'] == 2)?$project['project_name']:'';?>" style="width:300px;"/>
  <input type="hidden" name="project_continue" value="">
  <input type="hidden" name="project_continue_fund" value="">
  <input type="hidden" name="project_continue_org" value="">  
  <img src="images/see.png" width="24" height="24" onclick='startDesktop ();' /></p></td>
  </tr>
  <tr>
    <th>ลักษณะโครงการ</th>
    <td><select name="select8">
      <option value="">-- เลือกลักษณะโครงการ --</option>
      <option value="1">การจัดสว้สดิการสังคม</option>
      <option value="2">การปฏิบัติด้านสวัสดิการ</option>
      <option value="3">การสมทบโครงการ</option>
    </select>
      <select name="select13">
        <option>-- เลือกการจัดสวัสดิการสังคม --</option>
      </select>
      <select name="select14">
        <option>-- เลือกการปฏิบัติด้านสวัสดิการ --</option>
      </select>
      <select name="select15">
        <option>-- เลือกสมทบโครงการ --</option>
      </select>
      <br />
    <select name="select9">
      <option selected="selected">-- เลือกสาขา --</option>
      <option>บริการทางสังคม</option>
      <option>การศึกษา</option>
      <option>สุขภาพอนามัย</option>
      <option>ที่อยู่อาศัย</option>
      <option>แรงงาน/การฝึกอาชีพ/การประกอบอาชีพ</option>
      <option>กระบวนการยุติธรรม</option>
      <option>นันทนาการ</option>
      <option>อื่น ๆ</option>
    </select>
    <input name="textfield16" type="text" id="textfield16" style="width:300px;"/>
    <br />
    <select name="select10">
      <option>-- เลือกความสอดคล้องกับยุทธศาสตร์และแผน --</option>
      <option>รัฐบาล</option>
      <option>ชาติ</option>
      <option>จังหวัด</option>
      <option>อื่นๆ</option>
    </select>
    <input name="textfield17" type="text" id="textfield17" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>รหัสทะเบียนโครงการ</th>
    <td><input name="textfield18" type="text" id="textfield18" style="width:100px;"/></td>
  </tr>
  <tr>
    <th>แผน</th>
    <td><select name="select11">
      <option>-- เลือกแผน --</option>
    </select>
      <select name="select12">
        <option>-- เลือกแผนย่อย --</option>
    </select></td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายทั้งโครงการ</th>
    <td><input name="textfield20" type="text" id="textfield20" style="width:150px;"/>
      บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบ</th>
    <td><input name="textfield21" type="text" id="textfield21" style="width:150px;"/>
บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบจากองค์กรอื่น</th>
    <td><input name="textfield22" type="text" id="textfield22" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่เสนอขอรับการสนับสนุน</th>
    <td><input name="textfield23" type="text" id="textfield23" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ได้รับอนุมัติ</th>
    <td><input name="textfield24" type="text" id="textfield24" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ขนาดของโครงการ</th>
    <td>ไม่เกิน 50,000 บาท</td>
  </tr>
  <tr>
    <th>แนบไฟล์</th>
    <td><input type="file" name="fileField2" id="fileField2" /></td>
  </tr>
  <tr>
    <th>วันที่อนุมัติโครงการตามเอกสารแนบ</th>
    <td><input name="textfield19" type="text" id="textfield19" style="width:80px;"/>
    <img src="../images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:150px;"/>
บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ได้รับอนุมัติ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield8" type="text" id="textfield8" style="width:150px;"/>
บาท</td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>







<h3>กลุ่มเป้าหมาย</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กลุ่มเป้าหมาย</th>
<th>จำนวนกลุ่มเป้าหมาย</th>
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
<div id="inline_example1" style="padding:10px; background:#fff;">
<h3>กลุ่มเป้าหมาย (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>กลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select2">
    <option>-- เลือกกลุ่มเป้าหมาย --</option>
  </select></td>
</tr>
<tr>
  <th>จำนวนกลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>พื้นที่ดำเนินงาน</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
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
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>พื้นที่ดำเนินงาน (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select2">
    <option>-- เลือกจังหวัด --</option>
  </select></td>
</tr>
<tr>
  <th>อำเภอ<span class="Txt_red_12"> *</span></th>
  <td><select name="select2" id="select">
    <option>-- เลือกอำเภอ --</option>
  </select></td>
</tr>
<tr>
  <th>ตำบล<span class="Txt_red_12"> *</span></th>
  <td><select name="select4" id="select3">
    <option>-- เลือกตำบล --</option>
  </select></td>
</tr>
<tr>
  <th>หมู่บ้าน</th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:200px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>รายการค่าใช้จ่าย</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example83"/></div>
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
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>



<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example83" style="padding:10px; background:#fff;">
<h3>รายการค่าใช้จ่าย (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>รายการค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield4" type="text" id="textfield4" style="width:300px;"/></td>
</tr>
<tr>
  <th>จำนวนเงินค่าใช้จ่ายทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/> 
    บาท</td>
</tr>
<tr>
  <th>รายการ คชจ. ย่อยของทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield27" rows="3" id="textfield33" style="width:500px;"></textarea></td>
</tr>
<tr>
  <th>คชจ.ที่เสนอขอ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/> 
    บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>ค่าใช้จ่ายสมทบจากองค์กรอื่น</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example84"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>จำนวนเงิน</th>
<th>ชื่อโครงการ</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example84" style="padding:10px; background:#fff;">
<h3>ค่าใช้จ่ายสมทบจากองค์กรอื่น (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ค่าใช้จ่ายสมทบจากองค์กรอื่น<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/> 
    บาท (รวมจากรายการค่าใช้จ่าย)</td>
</tr>
<tr>
  <th>แหล่งที่มา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield6" type="text" id="textfield6" style="width:300px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>


<h3>กิจกรรม</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example85"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กิจกรรมตามโครงการ</th>
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
<div id="inline_example85" style="padding:10px; background:#fff;">
<h3>กิจกรรม (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>กิจกรรมตามโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield9" type="text" id="textfield9" style="width:300px;"/></td>
</tr>
<tr>
  <th>ระยะเวลา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/></td>
</tr>
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield10" type="text" id="textfield10" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>
