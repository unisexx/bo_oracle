<script>
$(document).ready(function(){
	// $(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
	
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
    
    $("#sform").validate({
		rules: {
			title_id:"required",
			fname:"required",
			lname:"required",
			sex:"required"
		},
		messages:{
			title_id:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			fname:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			lname:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			sex:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
	
});

function organ_view_sub() {
	window.open("act/welfare/organ_select", "", "width=1024,height=768,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");
}

Cufon.replace('h1, h3, h4, h5, ul#navmenu-h');
</script>

<form id="sform" method="post" name="composeform_sub" action="act/director/subcommittee_save">
<h3>รายชื่อคณะกรรมการ (เพิ่ม/แก้ไข)</h3>

<table class="tbadd">
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td>
      <?php echo form_dropdown('title_id', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$sub['title_id'], null, '-- คำนำหน้า --'); ?> 
    	
      <input name="fname" type="text" value="<?php echo $sub['fname']?>" style="width:150px;" placeholder="ชื่อ"/>
      <input name="lname" type="text" value="<?php echo $sub['lname']?>" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td>
    	<span><input type="radio" name="sex" value="M" <?php echo ($sub['sex'] == "M")?'checked=checked':'';?> /> ชาย </span> 		<span><input type="radio" name="sex" value="F" <?php echo ($sub['sex'] == "F")?'checked=checked':'';?> /> หญิง </span>
    </td>
  </tr>
<tr>
  <th>ตำแหน่งในคณะกรรมการ</th>
  <td>
  	<?php echo form_dropdown('position_id', get_option('id', 'position_name', 'act_committee_position', '1=1 order by position_name asc'), @$sub['position_id'], null, '-- เลือกตำแหน่ง --'); ?> 
  </td>
</tr>
<tr>
  <th><label for="fid-full_name3">ประเภทกรรมการ</label>
     </th>
  <td>
  	<SELECT name="sub_type_id">
     <option>-- เลือกประเภทกรรมการ --</option>
     <option value="1" <?if (@$sub['sub_type_id']==1) print "selected"?>>ส่วนราชการ</option>
     <option value="2" <?if (@$sub['sub_type_id']==2) print "selected"?>>ผู้แทนองค์กรสาธารณประโยชน์</option>
     <option value="3" <?if (@$sub['sub_type_id']==3) print "selected"?>>ผู้แทนองค์กรปกครองส่วนท้องถิ่น</option>
     <option value="4" <?if (@$sub['sub_type_id']==4) print "selected"?>>ผู้แทนองค์กรสวัสดิการชุมชน</option>
     <option value="5" <?if (@$sub['sub_type_id']==5) print "selected"?>>ผู้ทรงคุณวุฒิ</option>
	</SELECT>
  </td>
</tr>
<tr>
  <th><label for="fid-full_name4">ชื่อหน่วยงานที่สังกัด</label>
     </th>
  <td>
  	<input name="organ_name" type="text" value="<?php echo act_get_organ_name($sub['organ_id'])?>" style="width:250px;"/>
  	<input name="organ_id" type="hidden" value="<?php echo $sub['organ_id']?>">
    <a href="javascript:organ_view_sub();"><img src="images/see.png" width="24" height="24" /></td></a>
</tr>
<tr>
  <th>ตำแหน่งหน้าที่การงาน</th>
  <td><input name="position" type="text" value="<?php echo $sub['position']?>" style="width:250px;"/></td>
</tr>
<tr>
  <th>สถานที่ทำงาน/สถานที่ติดต่อ</th>
  <td>เลขที่
    <input name="home_no" type="text" value="<?php echo $sub['home_no']?>" style="width:50px;"/>
    หมู่ที่
    <input name="moo" type="text" value="<?php echo $sub['moo']?>" style="width:30px;"/>
    ตรอก/ซอย
    <input name="soi" type="text" value="<?php echo $sub['soi']?>" style="width:200px;"/>
    ถนน
    <input name="road" type="text" value="<?php echo $sub['road']?>" style="width:200px;"/>
    <br />
     จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$sub['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($sub['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$sub['province_code'].' order by ampor_name'), @$sub['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($sub['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$sub['ampor_code'].' order by tumbon_name'), @$sub['tumbon_code'], null, '-- เลือกตำบล --'); ?> <br>
    รหัสไปรณีย์
    <input name="post_code" type="text" value="<?php echo $sub['post_code']?>" style="width:70px;"/></td>
</tr>
<tr>
  <th>โทรศัพท์</th>
  <td><input name="tel" type="text" value="<?php echo $sub['tel']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>แฟกช์</th>
  <td><input name="fax" type="text" value="<?php echo $sub['fax']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="email" type="text" value="<?php echo $sub['email']?>" style="width:250px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo $sub['id']?>">
  <input type="hidden" name="committee_id" value="<?php echo @$_GET['committee_id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>