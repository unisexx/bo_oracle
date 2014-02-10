<script>
$(document).ready(function(){
    $("select[name=UNDER_TYPE]").change(function(){
        if($(this).attr("value")=="1"){
			$(".type_1").show();
            $(".type_2").hide();
			$(".type_3").hide();
        }
        if($(this).attr("value")=="2"){
        	$(".type_1").hide();
            $(".type_2").show();
			$(".type_3").hide();
        }
        if($(this).attr("value")=="3"){
         	$(".type_1").hide();
            $(".type_2").hide();
			$(".type_3").show();
        }
    });
    
    $('[name=ampor_code]').chainedSelect({
    	parent: '[name=province_code]',
    	url: 'act/welfare/ajax_ampor',
    	value: 'ampor_code',
    	label: 'text'
    });
    
    $('[name=tumbon_code]').chainedSelect({
    	parent: '[name=ampor_code]',
    	url: 'act/welfare/ajax_tumbon?p='+$("#province").val(),
    	value: 'tumbon_code',
    	label: 'text'
    });
    
    $('[name=co_ampor_code]').chainedSelect({parent: '[name=co_province_code]',url: 'act/welfare/ajax_ampor',value: 'ampor_code',label: 'text'});
    $('[name=co_tumbon_code]').chainedSelect({parent: '[name=co_ampor_code]',url: 'act/welfare/ajax_tumbon',value: 'tumbon_code',label: 'text'});
});
</script>

<form method="post" action="act/welfare/save">
	
<h3>บันทึก องค์การสวัสดิการสังคม (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ประเภทหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td>
      <select name="UNDER_TYPE" style="margin-right:15px;">
        <option>-- เลือกประเภทหน่วยงาน --</option>
        <option value="1">หน่วยงานของรัฐ</option>
        <option value="2">องค์กรสาธารณประโยชน์</option>
        <option value="3">องค์กรสวัสดิการชุมชน</option>
    </select>
</td>
  </tr>
</table>


<table class="tbadd type_1" style="display:none;">
  <tr>
    <th>หน่วยงานของรัฐ</th>
    <td><span>
      <input type="radio" name="UNDER_TYPE_SUB" id="radio" value="1" />
ส่วนราชการ</span> <span>
<input type="radio" name="UNDER_TYPE_SUB" id="radio2" value="2" />
องค์กรปกครองส่วนท้องถิ่น</span></td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NO" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>สังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="UNDER_NAME" type="text" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>กระทรวง <span class="Txt_red_12"> *</span></th>
    <td><input name="MINISTRY_NAME" type="text" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>หน่วยงานในสังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_INSIDE" type="text" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี ที่ก่อตั้ง</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" type="text" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" type="text" style="width:50px;"/>
    หมู่ที่
    <input name="MOO" type="text" style="width:30px;"/>
    ตรอก/ซอย
    <input name="SOI" type="text" style="width:200px;"/>
    ถนน
    <input name="ROAD" type="text" style="width:200px;"/>
    <br />
    จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$rs['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($rs['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$rs['province_code'].' order by ampor_name'), @$rs['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($rs['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$item['ampor_code'].' order by tumbon_name'), @$item['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="POST_CODE" type="text" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="TEL" type="text" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="FAX" type="text" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="EMAIL" type="text" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="WEBSITE" type="text" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ผู้บริหารองค์การ</th>
    <td><select name="EXECUTIVE_TITLE">
      <option>-- คำนำหน้า --</option>
    </select>      
    <input name="EXECUTIVE_NAME" type="text" style="width:250px;"/> 
    ตำแหน่ง 
    <input name="EXECUTIVE_POSITION" type="text" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td><select name="CO_TITLE">
      <option>-- คำนำหน้า --</option>
    </select>
      <input name="CO_NAME" type="text" style="width:250px;"/>
ตำแหน่ง
<input name="CO_POSITION" type="text" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="CO_HOME_NO" type="text" style="width:50px;"/>
      หมู่ที่
      <input name="CO_MOO" type="text" style="width:30px;"/>
      ตรอก/ซอย
      <input name="CO_SOI" type="text" style="width:200px;"/>
      ถนน
      <input name="CO_ROAD" type="text" style="width:200px;"/>
      <br />
      จังหวัด
      <?php echo form_dropdown('co_province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$rs['co_province_code'], null, '- เลือกจังหวัด -'); ?>
      อำเภอ
      <?php echo form_dropdown('co_ampor_code', (empty($rs['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$rs['province_code'].' order by ampor_name'), @$rs['co_ampor_code'], null, '- เลือกอำเภอ -'); ?>
      ตำบล
      <?php echo form_dropdown('co_tumbon_code', (empty($rs['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$item['ampor_code'].' order by tumbon_name'), @$item['tumbon_code'], null, '-- เลือกตำบล --'); ?>
      รหัสไปรณีย์
      <input name="CO_POST_CODE" type="text" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="CO_TEL" type="text" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="CO_FAX" type="text" id="textfield22" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="CO_PHONE" type="text" id="textfield23" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="CO_EMAIL" type="text" id="textfield24" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>จำนวนข้าราชการและเจ้าหน้าที่
     </th>
    <td><input name="STAFF_NUMBER" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="SUPPORTER_NUMBER" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" id="textfield32" style="width:50px;"/>
คน</td>
  </tr>
  <tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" id="textfield33" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม</th>
    <td>
    	<?php foreach($target_groups as $row):?>
    		<span><input name="<?php echo $row['target_id']?>" type="checkbox"/> <?php echo $row['target_name']?> </span>
    	<?php endforeach;?>
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">2</td>
      <td style="width:30%">สตรี</td>
      <td style="width:40%"><input name="input2" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">3</td>
      <td style="width:30%">ผู้ด้อยโอกาส</td>
      <td style="width:40%"><input name="input" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
    </tr>
    </table>
    
    </td>
  </tr>
  <tr>
    <th>สาขาการให้บริการ</th>
    <td>
    	<?php foreach($services as $row):?>
    		<span><input name="<?php echo $row['service_id']?>" type="checkbox" />
<?php echo $row['service_name']?> </span>
    	<?php endforeach;?>
    	
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">สุขภาพอนามัย</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">บริการทางสังคม</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการ</th>
    <td>
    	<?php foreach($processes as $row):?>
    		<span><input name="<?php echo $row['process_id']?>" type="checkbox" /> <?php echo $row['process_name']?> </span>
    	<?php endforeach;?>
    	
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">การคุ้มครอง</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">การแก้ไข</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="NOTE" rows="3" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="status">
    <option>-- สถานะ --</option>
    <option>รับเรื่อง</option>
    <option>อนุรับรอง</option>
    <option>ส่งใบสำคัญ</option>
    <option>ประกาศกิจจานุเบกษา</option>
    <option>ไม่รับรอง</option>
  </select></td>
  </tr>
</table> 
<!-- หน่วยงานของรัฐ -->











<table class="tbadd type_2"  style="display:none">
  <tr>
    <th>องค์กรสาธารณประโยชน์</th>
    <td><span>
      <input type="radio" name="UNDER_TYPE_SUB" value="3" />
มูลนิธิ</span> <span>
<input type="radio" name="UNDER_TYPE_SUB" value="4" />
สมาคม    </span><span><input type="UNDER_TYPE_SUB" name="radio" value="5" />
องค์กรภาคเอกชน    </span></td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NO" type="text" id="textfield" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" id="textfield3" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" id="textfield5" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียนก่อตั้งหน่วยงานหรือปีที่เริ่มดำเนินการ</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" type="text" style="width:80px;"/>
    <img src="../themes/act/images/calendar.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="MOO" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="SOI" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="ROAD" type="text" id="textfield11" style="width:200px;"/>
    <br />
    จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$rs['province_code'], null, '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($rs['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$rs['province_code'].' order by ampor_name'), @$rs['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($rs['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$item['ampor_code'].' order by tumbon_name'), @$item['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="POST_CODE" type="text" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="TEL" type="text" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="FAX" type="text" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="EMAIL" type="text" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="WEBSITE" type="text" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ผู้บริหารองค์การ</th>
    <td><select name="MA_TITLE" id="select4">
      <option>-- คำนำหน้า --</option>
    </select>      
    <input name="MA_NAME" type="text" id="textfield17" style="width:250px;"/> 
    ตำแหน่ง 
    <input name="MA_POSITION" type="text" id="textfield18" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td><select name="CO_TITLE" id="select5">
      <option>-- คำนำหน้า --</option>
    </select>
      <input name="CO_NAME" type="text" id="textfield19" style="width:250px;"/>
ตำแหน่ง
<input name="CO_POSITION" type="text" id="textfield20" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="CO_HOME_NO" type="text" id="textfield25" style="width:50px;"/>
      หมู่ที่
      <input name="CO_MOO" type="text" id="textfield26" style="width:30px;"/>
      ตรอก/ซอย
      <input name="CO_SOI" type="text" id="textfield27" style="width:200px;"/>
      ถนน
      <input name="CO_ROAD" type="text" id="textfield28" style="width:200px;"/>
      <br />
     จังหวัด
      <?php echo form_dropdown('co_province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$rs['co_province_code'], null, '- เลือกจังหวัด -'); ?>
      อำเภอ
      <?php echo form_dropdown('co_ampor_code', (empty($rs['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$rs['province_code'].' order by ampor_name'), @$rs['co_ampor_code'], null, '- เลือกอำเภอ -'); ?>
      ตำบล
      <?php echo form_dropdown('co_tumbon_code', (empty($rs['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$item['ampor_code'].' order by tumbon_name'), @$item['tumbon_code'], null, '-- เลือกตำบล --'); ?>
      รหัสไปรณีย์
      <input name="CO_POST_CODE" type="text" id="textfield29" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="CO_TEL" type="text" id="textfield21" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="CO_FAX" type="text" id="textfield22" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="CO_PHONE" type="text" id="textfield23" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="CO_EMAIL" type="text" id="textfield24" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>จำนวนบุคลากร</th>
    <td><input name="STAFF_NUMBER" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="SUPPORTER_NUMBER" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" id="textfield32" style="width:50px;"/>
คน</td>
  </tr>
  <tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" id="textfield33" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="N_area" type="text" id="textfield35" style="width:80px;"/>
หมู่บ้าน/ชุมชน    
<input name="M_area" type="text" id="textfield36" style="width:50px;"/> 
ตำบล/แขวง 
<input name="O_area" type="text" id="textfield37" style="width:50px;"/>

   อำเภอ/เขต 
      <input name="P_area" type="text" id="textfield38" style="width:50px;"/>
จังหวัด 
<input name="Q_area" type="text" id="textfield39" style="width:50px;"/>
   </td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม <span class="Txt_red_12"> *</span></th>
    <td>
    	<?php foreach($target_groups as $row):?>
    		<span><input name="<?php echo $row['target_id']?>" type="checkbox"/> <?php echo $row['target_name']?> </span>
    	<?php endforeach;?>
    
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">2</td>
      <td style="width:30%">สตรี</td>
      <td style="width:40%"><input name="input2" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
    </tr>
    <tr>
      <td style="width:10%">3</td>
      <td style="width:30%">ผู้ด้อยโอกาส</td>
      <td style="width:40%"><input name="input" type="text" style="width:350px;" /></td>
      <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
    </tr>
    </table>
    
    </td>
  </tr>
  <tr>
    <th>สาขาการให้บริการ <span class="Txt_red_12"> *</span></th>
    <td>
    	<?php foreach($services as $row):?>
    		<span><input name="<?php echo $row['service_id']?>" type="checkbox" />
<?php echo $row['service_name']?> </span>
    	<?php endforeach;?>
    	
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">สุขภาพอนามัย</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">บริการทางสังคม</td>
    <td style="width:40%"><input name="input4" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการ <span class="Txt_red_12"> *</span></th>
    <td>
    	<?php foreach($processes as $row):?>
    		<span><input name="<?php echo $row['process_id']?>" type="checkbox" /> <?php echo $row['process_name']?> </span>
    	<?php endforeach;?>
    	
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
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">2</td>
    <td style="width:30%">การคุ้มครอง</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
  <tr>
    <td style="width:10%">3</td>
    <td style="width:30%">การแก้ไข</td>
    <td style="width:40%"><input name="input5" type="text" style="width:350px;" /></td>
    <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <th>รูปแบบการดำเนินการ
     </th>
    <td>
    	<?php foreach($formats as $row):?>
		<span><input name="<?php echo $row['format_id']?>" type="checkbox" /> <?php echo $row['format_name']?>
<input name="input6" type="text" style="width:100px;" /></span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>วิธีการดำเนินการ</th>
    <td>
    	<?php foreach($methods as $row):?>
    	<span><input name="<?php echo $row['method_id']?>" type="checkbox" /> <?php echo $row['method_name']?> <input name="input7" type="text" style="width:100px;" /></span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>รูปแบบการให้บริการ </th>
    <td>
    	<?php foreach($service_types as $row):?>
    		<span><input name="<?php echo $row['service_type_id']?>" type="checkbox" />
<?php echo $row['service_type_name']?> <input name="input10" type="text" style="width:100px;" />
    </span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>การส่งเสริมและสนับสนุนให้องค์กรต่างๆ ได้มีส่วนร่วมในการจัดสวัสดิการสังคม </th>
    <td>
    	<?php foreach($promotes as $row):?>
		<span><input name="<?php echo $row['promote_id']?>" type="checkbox" /> <?php echo $row['promote_name']?> <input name="input11" type="text" style="width:100px;" /></span>
    	<?php endforeach;?>
    	</td>
  </tr>
  <tr>
    <th>ได้รับการสนับสนุนตาม พ.ร.บ. ส่งเสริมการจัดสวัสดิการทางสังคม พ.ศ. 2546 </th>
    <td>
    	<?php foreach($promote_gets as $row):?>
    		<span><input name="<?php echo $row['promote_get_id']?>" type="checkbox" /> <?php echo $row['promote_get_name']?> <input name="input13" type="text" style="width:100px;" />
    </span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>งบประมาณดำเนินการ </th>
    <td>ปีที่ผ่านมา
      <select name="YEAR_MONEY">
        <option value="">-- เลือกปี --</option>
        <?for($i=(date(Y)+543);$i>2450;$i--){?>
        <option value=<?=$i?>><?=$i?></option>
        <?}?>
      </select>
<span>จำนวนเงิน
<input name="BUDGET1" type="text" style="width:120px;" />
บาท</span>เงินทุน
<input name="BUDGET2" type="text" style="width:120px;" />
บาท</td>
  </tr>
  <tr>
    <th>เอกสารตีพิมพ์ </th>
    <td><span style="width:40%">
      <input name="DOCUMENT_PRINT" type="text" style="width:350px;" />
    </span></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="NOTE" rows="3" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>จดทะเบียนองค์กร</th>
    <td><input type="checkbox" name="CHECK_HELP" id="checkbox" />
    จดทะเบียน</td>
  </tr>
  <tr>
    <th>สถานะการลงทะเบียน</th>
    <td><select name="select3">
    <option>-- สถานะ --</option>
    <option>ยังไม่ได้ลงทะเบียน</option>
    <option>รออนุมัติ</option>
    <option>อนุมัติ</option>
    <option>ไม่อนุมัติ</option>
  </select></td>
  </tr>
</table> 
<!-- องค์กรสาธารณประโยชน์ -->













<table class="tbadd type_3" style="display:none;">
  <tr>
    <th>องค์กรสวัสดิการชุมชน</th>
    <td><span>
      <input type="radio" name="UNDER_TYPE_SUB" value="10" />
องค์กรสวัสดิการชุมชน</span> <span>
<input type="radio" name="UNDER_TYPE_SUB" value="11" />
เครือข่ายองค์กรสวัสดิการชุมชน</span></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" id="textfield3" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" id="textfield5" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียน</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" type="text" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" id="textfield40" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" type="text" id="textfield8" style="width:50px;"/>
    หมู่ที่
    <input name="MOO" type="text" id="textfield9" style="width:30px;"/>
    ตรอก/ซอย
    <input name="SOI" type="text" id="textfield10" style="width:200px;"/>
    ถนน
    <input name="ROAD" type="text" id="textfield11" style="width:200px;"/>
    <br />
   จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$rs['province_code'], null, '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($rs['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$rs['province_code'].' order by ampor_name'), @$rs['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($rs['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$item['ampor_code'].' order by tumbon_name'), @$item['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="POST_CODE" type="text" id="textfield12" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="TEL" type="text" id="textfield13" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="FAX" type="text" id="textfield14" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="EMAIL" type="text" id="textfield15" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="WEBSITE" type="text" id="textfield16" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการองค์กร</th>
    <td>
    	<?php foreach($pcommunities as $row):?>
		<p><input type="checkbox" name="<?php echo $row['pcommunity_id']?>" /> <?php echo $row['pcommunity_name']?>
			<?php if($row['pcommunity_name'] == "เครือข่ายองค์กรสวัสดิการชุมชน"):?>
			&nbsp;จำนวน <input name="NUM_ORGAN" type="text" style="width:50px;"/> องค์กร
			<?php endif;?>
		</p>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>จำนวนสมาชิก
     </th>
    <td><input name="MEMBER_NUMBER" type="text" id="textfield30" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="N_area" type="text" id="textfield35" style="width:80px;"/>
หมู่บ้าน/ชุมชน    
<input name="M_area" type="text" id="textfield36" style="width:50px;"/> 
ตำบล/แขวง 
<input name="O_area" type="text" id="textfield37" style="width:50px;"/>

   อำเภอ/เขต 
      <input name="P_area" type="text" id="textfield38" style="width:50px;"/>
จังหวัด 
<input name="Q_area" type="text" id="textfield39" style="width:50px;"/>
   </td>
  </tr>
  <tr>
    <th>จำนวนผู้ปฎิบัติงาน
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" id="textfield31" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>สวัสดิการบริการที่จัดให้แก่สมาชิก</th>
    <td>
    	<?php foreach($scommunities as $row):?>
    		<span><input name="<?php echo $row['scommunity_id']?>" type="checkbox"/> <?php echo $row['scommunity_name']?> </span>
    	<?php endforeach;?>
    	
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
          <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /></td>
        </tr>
        <tr>
          <td style="width:10%">2</td>
          <td style="width:30%">แก่</td>
          <td style="width:40%"><input name="input16" type="text" style="width:350px;" /></td>
          <td style="width:10%"><img src="themes/act/images/down.png" width="16" height="16" /><img src="themes/act/images/up.png" width="16" height="16" /></td>
        </tr>
        <tr>
          <td style="width:10%">3</td>
          <td style="width:30%"> เจ็บ/สุขภาพ</td>
          <td style="width:40%"><input name="input16" type="text" style="width:350px;" /></td>
          <td style="width:10%"><img src="themes/act/images/up.png" width="16" height="16" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <th>วิธีการดำเนินการ</th>
    <td>
    	<?php foreach($methods as $row):?>
    		<span><input name="<?php echo $row['method_id']?>" type="checkbox"/> <?php echo $row['method_name']?> <input name="method_<?php echo $row['method_id']?>_note" type="text" style="width:100px;" /></span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>การส่งเสริมและสนับสนุนให้องค์กรต่างๆ ได้มีส่วนร่วมในการจัดสวัสดิการสังคม </th>
    <td>
    	<?php foreach($promotes as $row):?>
    		<span><input name="checkbox16" type="checkbox" id="checkbox39" /> บุคคล ระบุ <input name="input16" type="text" style="width:100px;" /></span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>ได้รับการสนับสนุนตาม พ.ร.บ. ส่งเสริมการจัดสวัสดิการทางสังคม พ.ศ. 2546 </th>
    <td>
    	<?php foreach($promote_gets as $row):?>
    		<span><input name="<?php echo $row['promote_get_id']?>" type="checkbox" /> <?php echo $row['promote_get_name']?> <input name="input16" type="text" style="width:100px;" /> </span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>งบประมาณดำเนินการ </th>
    <td>ปีที่ผ่านมา
      <select name="YEAR_MONEY" id="select10">
        <option value="">-- เลือกปี --</option>
        <?for($i=(date(Y)+543);$i>2450;$i--){?>
        <option value=<?=$i?>><?=$i?></option>
        <?}?>
      </select>
      <span>จำนวนเงิน
        <input name="BUDGET1" type="text" style="width:120px;" />
        บาท</span>
        <p>เงินที่มาจากสมาชิก
        <input name="BUDGET3" type="text" style="width:120px;" />
      บาท</p>
      เงินสมทบจากภายนอก
      <p style="margin-left:30px;">- องค์กรปกครองส่วนท้องถิ่น  จำนวน 
      <input name="BUDGET4" type="text" style="width:120px;" />
บาท </p><p style="margin-left:30px;">
- หน่วยงานอื่น   จำนวน
<input name="BUDGET5" type="text" style="width:120px;" />
บาท </p>
เงินอื่นๆ   จำนวน
<input name="BUDGET6" type="text" style="width:120px;" />
บาท </td>
  </tr>
  <tr>
    <th>อื่นๆ
     </th>
    <td><textarea name="NOTE" rows="3" id="textfield34" style="width:500px;"></textarea></td>
  </tr>
  <tr>
    <th>จดทะเบียนองค์กร</th>
    <td><input type="CHECK_HELP" name="checkbox" id="checkbox" />
    จดทะเบียน</td>
  </tr>
  <tr>
    <th>สถานะการลงทะเบียน</th>
    <td><select name="select3">
    <option>-- สถานะ --</option>
    <option>ยังไม่ได้ลงทะเบียน</option>
    <option>รออนุมัติ</option>
    <option>อนุมัติ</option>
    <option>ไม่อนุมัติ</option>
  </select></td>
  </tr>
</table>
<!-- องค์กรสวัสดิการชุมชน -->

<div id="btnBoxAdd">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>
