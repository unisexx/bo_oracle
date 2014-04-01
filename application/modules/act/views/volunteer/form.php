<script>
$(document).ready(function(){
    $('[name=ampor_code]').chainedSelect({
    	parent: '[name=province_code]',
    	url: 'act/welfare/ajax_ampor',
    	value: 'ampor_code',
    	label: 'text'
    });
    
    $("[name=province_code]").live('change',function(){
    	$('[name=tumbon_code]').chainedSelect({
	    	parent: '[name=ampor_code]',
	    	url: 'act/welfare/ajax_tumbon?p='+$(this).val(),
	    	value: 'tumbon_code',
	    	label: 'text'
	    });
    });
    
    $("form").validate({
		rules: {
			passport:"required",
			id_card:"required",
			title_id:"required",
			fname:"required",
			lname:"required",
			sex:"required",
			birthday:"required",
			home_no:"required",
			tel:"required",
			status_id:"required"
		},
		messages:{
			passport:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			id_card:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			title_id:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			fname:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			lname:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			sex:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			birthday:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			home_no:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			tel:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			status_id:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});

});
</script>

<h3>บันทึก อาสาสมัคร (บันทึก / แก้ไข) <a href="<?=basename($_SERVER['PHP_SELF'])?>?act=form_en"><img src="themes/act/images/eng_flag.png" width="32" height="32" /></a></h3>

<form method="post" action="act/volunteer/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>เลขที่ Passport <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="passport" id="radio3" value="radio" />
ไม่มี </span> <span>
<input type="radio" name="passport" id="radio4" value="radio" />
มี </span>
<input name="v_id" type="text" style="width:200px;" value="<?=$volunteer['v_id']?>"/></td>
  </tr>
  <tr>
    <th>เลขที่บัตรประชาชน <span class="Txt_red_12"> *</span></th>
    <td><input name="id_card" type="text" value="<?=$volunteer['id_card']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td>
      <?php echo form_dropdown('title_id', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$volunteer['title_id'], null, '-- คำนำหน้า --'); ?>      
      <input name="fname" type="text" style="width:150px;" value="<?=$volunteer['fname']?>" placeholder="ชื่อ"/>
      <input name="lname" type="text" style="width:250px;" value="<?=$volunteer['lname']?>" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>รูปภาพ</th>
    <td>
    	<input type="file" name="UploadFile" />
    	<?php if($volunteer['picture_name']):?>
  		<a href="uploads/act/volunteer/<?php echo $volunteer['picture_name']?>"><?php echo $volunteer['picture_name']?></a>
  		<input type="hidden" name="hdfilename" value="<?php echo $volunteer['picture_name']?>">
	  	<?php endif;?>
    </td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td>
    	<span><input type="radio" name="sex" value="M" <?=($volunteer['sex'] == 'M')?'checked':'';?> /> ชาย</span> 
      	<span><input type="radio" name="sex" value="F" <?=($volunteer['sex'] == 'F')?'checked':'';?> /> หญิง</span>
    </td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี เกิด <span class="Txt_red_12">*</span></th>
    <td><input name="birthday" type="text" class="datepicker" value="<?=$volunteer['birthday']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สัญชาติ  </th>
    <td><input name="national" type="text" value="<?=$volunteer['national']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ศาสนา  </th>
    <td>
    	<select name="religion">
         <option value="0">-- เลือกศาสนา --</option>
         <option value="1" <?=$volunteer['religion'] == 1 ? 'selected' : '' ;?>>พุทธ</option>
         <option value="2" <?=$volunteer['religion'] == 2 ? 'selected' : '' ;?>>คริสต์</option>
         <option value="3" <?=$volunteer['religion'] == 3 ? 'selected' : '' ;?>>อิสลาม</option>
         <option value="4" <?=$volunteer['religion'] == 4 ? 'selected' : '' ;?>>อื่นๆ</option>
		</select>
    </td>
  </tr>
  <tr>
    <th>ประเทศ  </th>
    <td>
    	<?php echo form_dropdown('country_code', get_option('country_id', 'country_name', 'act_country', '1=1 order by country_name asc'), @$volunteer['country_code'], null, '-- เลือกประเทศ --'); ?>
    </td>
  </tr>
  <tr>
    <th>สถานที่ทำงาน/สถานที่ติดต่อ<span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="home_no" type="text" value="<?=$volunteer['home_no']?>" style="width:50px;"/>
    หมู่ที่
    <input name="moo" type="text" value="<?=$volunteer['moo']?>" style="width:30px;"/>
    ตรอก/ซอย
    <input name="soi" type="text" value="<?=$volunteer['soi']?>" style="width:200px;"/>
    ถนน
    <input name="road" type="text" value="<?=$volunteer['road']?>" style="width:200px;"/>
    <br />
   จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$volunteer['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($volunteer['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$volunteer['province_code'].' order by ampor_name'), @$volunteer['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($volunteer['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$volunteer['ampor_code'].' order by tumbon_name'), @$volunteer['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="post_code" type="text" value="<?=$volunteer['post_code']?>" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์<span class="Txt_red_12"> *</span></th>
    <td><input name="tel" type="text" value="<?=$volunteer['tel']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="fax" type="text" value="<?=$volunteer['fax']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ</th>
    <td><input name="phone" type="text" value="<?=$volunteer['phone']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="website" type="text" value="<?=$volunteer['website']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ระดับการศึกษา
     </th>
    <td>
    	<?php echo form_dropdown('education_id', get_option('id', 'education_name', 'act_education', '1=1 order by education_name asc'), @$volunteer['education_id'], '', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>อาชีพ</th>
    <td>
    	<?php echo form_dropdown('occupation_id', get_option('id', 'occupation_name', 'act_occupation', '1=1 order by occupation_name asc'), @$volunteer['occupation_id'], '', '- เลือกอาชีพ -'); ?>
    </td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงานที่ปฏิบัติ</th>
    <td><input name="unit_name" type="text" style="width:350px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
  </tr>
  <tr>
    <th>ประเภทอาสาสมัคร <span class="Txt_red_12">*</span></th>
    <td>
    	<?php echo form_dropdown('status_id', get_option('id', 'volunteer_type_name', 'act_volunteer_type', '1=1 order by volunteer_type_name asc'), @$volunteer['status_id'], '', '- เลือกประเภทอาสาสมัคร -'); ?>
    </td>
  </tr>
  <tr>
    <th>ระยะเวลาที่ปฏิบัติงาน</th>
    <td><input name="work_time" type="text" value="<?=$volunteer['work_time']?>" style="width:30px;"/>
ปี</td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน
     </th>
    <td><span>
      <input type="radio" name="area_work" value="1" <?=($volunteer['area_work'] == 1)?'checked':'';?> />
      หมู่บ้าน</span> <span>
<input type="radio" name="area_work" value="2" <?=($volunteer['area_work'] == 2)?'checked':'';?>/>
ตำบล</span><span>
<input type="radio" name="area_work" value="3" <?=($volunteer['area_work'] == 3)?'checked':'';?>/>
อำเภอ</span> <span>
<input type="radio" name="area_work" value="4" <?=($volunteer['area_work'] == 4)?'checked':'';?>/>
จังหวัด</span><br />

จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$volunteer['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($volunteer['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$volunteer['province_code'].' order by ampor_name'), @$volunteer['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($volunteer['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$volunteer['ampor_code'].' order by tumbon_name'), @$volunteer['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    
หมู่บ้าน/ชุมชน    
<input name="area_work_txt" type="text" style="width:150px;" value="<?=$volunteer['area_work_txt']?>"/></td>
  </tr>
  <tr>
    <th>ประสบการณ์/ความสามารถพิเศษ</th>
    <td><textarea name="experience" rows="3" style="width:500px;"><?=$volunteer['experience']?></textarea></td>
  </tr>
  <tr>
    <th>ประกาศเกียรติคุณที่ได้รับ </th>
    <td><textarea name="notice" rows="3" style="width:500px;"><?=$volunteer['notice']?></textarea></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="note" rows="3" style="width:500px;"><?=$volunteer['note']?></textarea></td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?=$volunteer['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>