<script>
$(document).ready(function(){
	$(".btn_add,.btn_edit").click(function(){
    	$.get('act/welfare_service/ajax_customer_sub2_form',{
    		id : $(this).prev('input[name=id]').val(),
    		id_card : $("input[name=id_card]").val()
    	},function(data){
    		$("#csubs2_form").html(data);
    	});
    });
	
	$('[name=ampor_code]').chainedSelect({
    	parent: '#province',
    	url: 'act/welfare/ajax_ampor',
    	value: 'ampor_code',
    	label: 'text'
    });
    
    $("#province").live('change',function(){
    	$('[name=tumbon_code]').chainedSelect({
	    	parent: '[name=ampor_code]',
	    	url: 'act/welfare/ajax_tumbon?p='+$(this).val(),
	    	value: 'tumbon_code',
	    	label: 'text'
	    });
    });
});

function organ_view_sub() {
	window.open("act/social_worker/organ_select", "", "width=1024,height=768,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");
}
</script>

<h3>บันทึก นักสังคมสงเคราะห์ (บันทึก / แก้ไข)</h3>

<form id="composeform_sub" method="post" action="act/social_worker/save" enctype="multipart/form-data">

<table class="tbadd">
  <tr>
    <th>เลขที่บัตรประชาชน <span class="Txt_red_12"> *</span></th>
    <td><input name="id_card" type="text" value="<?=$supporter['id_card']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td>
      <?php echo form_dropdown('title_id', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$supporter['title_id'], null, '-- คำนำหน้า --'); ?>    
      <input name="fname" type="text" value="<?=$supporter['fname']?>" style="width:150px;" placeholder="ชื่อ"/>
      <input name="lname" type="text" value="<?=$supporter['lname']?>" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
  <th>ไฟล์เอกสาร</th>
  <td>
  	<input type="file" name="UploadFile" />
  	<?php if($supporter['file_data']):?>
  		<a href="uploads/act/social_worker/<?php echo $supporter['file_data']?>"><?php echo $supporter['file_data']?></a>
  		<input type="hidden" name="hdfilename" value="<?php echo $supporter['file_data']?>">
  	<?php endif;?>
  </td>
</tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td>
    	<span><input type="radio" name="sex" value="M" <?=($supporter['sex'] == 'M')?'checked':'';?> /> ชาย</span> 
      	<span><input type="radio" name="sex" value="F" <?=($supporter['sex'] == 'F')?'checked':'';?> /> หญิง</span>
    </td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี เกิด <span class="Txt_red_12">*</span></th>
    <td><input name="birthday" type="text" class="datepicker" value="<?=$supporter['birthday']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ทำงาน/สถานที่ติดต่อ<span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="home_no" type="text" value="<?=$supporter['home_no']?>" style="width:50px;"/>
    หมู่ที่
    <input name="moo" type="text" value="<?=$supporter['moo']?>" style="width:30px;"/>
    ตรอก/ซอย
    <input name="soi" type="text" value="<?=$supporter['soi']?>" style="width:200px;"/>
    ถนน
    <input name="road" type="text" value="<?=$supporter['road']?>" style="width:200px;"/>
    <br />
   จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$supporter['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($supporter['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$supporter['province_code'].' order by ampor_name'), @$volunteer['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($supporter['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$supporter['ampor_code'].' order by tumbon_name'), @$volunteer['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="post_code" type="text" value="<?=$supporter['post_code']?>" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์<span class="Txt_red_12"> *</span></th>
    <td><input name="tel" type="text" value="<?=$supporter['tel']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="fax" type="text" value="<?=$supporter['fax']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ</th>
    <td><input name="phone" type="text" value="<?=$supporter['phone']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="email" type="text" value="<?=$supporter['email']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="website" type="text" value="<?=$supporter['website']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ระดับการศึกษา
     </th>
    <td>
    	<?php echo form_dropdown('education_id', get_option('id', 'education_name', 'act_education', '1=1 order by education_name asc'), @$supporter['education_id'], '', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>คณะ/สาขา
     </th>
    <td><input name="faculty" type="text" value="<?=$supporter['faculty']?>" style="width:250px;" placeholder="คณะ"/>
    /
      <input name="major" type="text" value="<?=$supporter['major']?>" style="width:250px;" placeholder="สาขา"/></td>
  </tr>
  <tr>
    <th>สถาบัน </th>
    <td><input name="institute" type="text" value="<?=$supporter['institute']?>" style="width:300px;"/> 
      เมื่อปี 
      <input name="institute_year" type="text" value="<?=$supporter['institute_year']?>" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>ตำแหน่งปัจจุบัน</th>
    <td><input name="position_now" type="text" value="<?=$supporter['position_now']?>" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงานที่ปฏิบัติงาน
     </th>
    <td>
    	<input name="organ_name" type="text" value="<?php echo act_get_organ_name($supporter['organ_id'])?>" style="width:250px;"/>
    	<input name="organ_id" type="hidden" value="<?php echo $supporter['organ_id']?>"/>
    	<a href="javascript:organ_view_sub();"><img src="images/see.png" width="24" height="24" /></a>
    </td>
  </tr>
  <tr>
    <th>ลักษณะงานที่ปฏิบัติ</th>
    <td>
    	<?foreach($specifics as $row):?>
    		<?php
    			$sub = $this->supporter_sub->where("id_card = ".$supporter['id_card']." and question_name = 'specific' and answer_id = ".$row['id'])->get_row();
    		?>
    		<span><input name="specific_id[]" type="checkbox" value="<?=$row['id']?>" <?=($row['id'] == @$sub['answer_id'])?'checked':'';?> /> <?=$row['specific_name']?> ระบุ <input name="other[]" type="text" value="<?=@$sub['other']?>" style="width:100px;" /></span>
    	<?endforeach;?>
    </td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายที่ปฏิบัติงาน</th>
    <td>
    <?foreach($target_groups as $row):?>
	    <?php
			$sub = $this->supporter_sub->where("id_card = ".$supporter['id_card']." and question_name = 'target' and answer_id = ".$row['target_id'])->get_row();
		?>
	    <span><input name="target_id[]" type="checkbox" value="<?=$row['target_id']?>" <?=($row['target_id'] == @$sub['answer_id'])?'checked':'';?> /> <?=$row['target_name']?>  ระบุ <input name="other2[]" type="text" value="<?=@$sub['other']?>" style="width:100px;" /></span>
    <?endforeach;?>
    </td>
  </tr>
  <tr>
    <th>ระยะเวลาที่ปฏิบัติงาน </th>
    <td><input name="work_time" type="text" value="<?=$supporter['work_time']?>" style="width:30px;"/> 
      ปี</td>
  </tr>
  <tr>
    <th>คุณสมบัติของนักสังคมสงเคราะห์ที่ปฏิบัติงานด้านการจัดสวัสดิการสังคม</th>
    <td>
    <p>
    	<input type="checkbox" name="spec1" value="1" <?=($supporter['spec1'] == 1)?'checked':'';?> /> สำเร็จการศึกษาไม่ต่ำกว่าปริญญาตรีสาขาสังคมสงเคราะห์ศาสตร์ เมื่อปี 
       <input name="spec1_year" type="text" value="<?=$supporter['spec1_year']?>" style="width:50px;"/>
    </p>
    <p>
    	<input type="checkbox" name="spec2" value="1" <?=($supporter['spec2'] == 1)?'checked':'';?>/> สำเร็จการศึกษาไม่ต่ำกว่าปริญญาตรีสาขาอื่น และผ่านการฝึกอบรมหลักสูตรเพื่อเป็นนักสังคมสงเคราะห์ตามที่คณะกรรมการกำหนด เมื่อปี	
    	<input name="spec2_year" type="text" value="<?=$supporter['spec2_year']?>" style="width:50px;"/>
    </p>
    <p>
    	<input type="checkbox" name="spec3" value="1" <?=($supporter['spec3'] == 1)?'checked':'';?>/> มีคุณสมบัติเหมาะสมหรือปฏิบัติงานด้านสังคมสงเคราะห์ เมื่อปี <input name="spec3_year" type="text" value="<?=$supporter['spec3_year']?>" style="width:50px;" />
    </p>
    </td>
  </tr>
  <tr>
    <th>เป็นนักสังคมสงเคราะห์ตามกฎหมายอื่น </th>
    <td><input name="is_supporter" type="text" value="<?=$supporter['is_supporter']?>" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="note" rows="3" style="width:500px;"><?=$supporter['note']?></textarea></td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?=$supporter['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>