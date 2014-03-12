<script>
$(document).ready(function(){
	$.get('act/welfare_service/ajax_customer_sub2_form',{
		id_card : $("input[name=id_card]").val()
	},function(data){
		$("#csubs2_form").html(data);
	});
    
	$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
    
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
</script>

<h3>บันทึก ผู้รับบริการสวัสดิการสังคม (บันทึก / แก้ไข)</h3>

<form method="post" action="act/welfare_service/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>เลขที่บัตรประชาชน <span class="Txt_red_12"> *</span></th>
    <td><input name="id_card" type="text" value="<?php echo $cmain['id_card']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td>
    	<?php echo form_dropdown('title_id', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$cmain['title_id'], null, '-- คำนำหน้า --'); ?>
    	      
      <input name="fname" type="text" value="<?php echo $cmain['fname']?>" style="width:150px;" placeholder="ชื่อ"/>
      <input name="lname" type="text" value="<?php echo $cmain['lname']?>" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>รูปภาพ</th>
    <td>
    	<input type="file" name="UploadFile" />
	  	<?php if($cmain['file_data']):?>
	  	<a href="uploads/act/welfare_service/<?php echo $cmain['file_data']?>"><?php echo $cmain['file_data']?></a>
	  	<input type="hidden" name="hdfilename" value="<?php echo $cmain['file_data']?>">
	  	<?php endif;?>
    </td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="sex" value="M" <?php echo ($cmain['sex'] == "M")?'checked=checked':'';?>/> 
      ชาย
</span> <span>
<input type="radio" name="sex" value="F" <?php echo ($cmain['sex'] == "F")?'checked=checked':'';?>/> 
หญิง
</span></td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี เกิด</th>
    <td><input name="birthday" type="text" class="datepicker" value="<?php echo $cmain['birthday']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ทำงาน/สถานที่ติดต่อ<span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="home_no" type="text" value="<?php echo $cmain['home_no']?>" style="width:50px;"/>
    หมู่ที่
    <input name="moo" type="text" value="<?php echo $cmain['moo']?>" style="width:30px;"/>
    ตรอก/ซอย
    <input name="soi" type="text" value="<?php echo $cmain['soi']?>" style="width:200px;"/>
    ถนน
    <input name="road" type="text" value="<?php echo $cmain['road']?>" style="width:200px;"/>
    <br />
     จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$cmain['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($cmain['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$cmain['province_code'].' order by ampor_name'), @$sub['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($cmain['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$cmain['ampor_code'].' order by tumbon_name'), @$sub['tumbon_code'], null, '-- เลือกตำบล --'); ?> <br>
    รหัสไปรณีย์
    <input name="post_code" type="text" value="<?php echo $cmain['post_code']?>" style="width:70px;"/></td>
</tr>
<tr>
  <th>โทรศัพท์</th>
  <td><input name="tel" type="text" value="<?php echo $cmain['tel']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>แฟกช์</th>
  <td><input name="fax" type="text" value="<?php echo $cmain['fax']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="email" type="text" value="<?php echo $cmain['email']?>" style="width:250px;"/></td>
 </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="website" type="text" value="<?php echo $cmain['website']?>"  style="width:250px;"/></td>
  </tr>
  <tr>
    <th>ระดับการศึกษา
     </th>
    <td>
    	<?php echo form_dropdown('education_id', get_option('id', 'education_name', 'act_education', '1=1 order by id asc'), @$cmain['education_id'], null, '-- ระดับการศึกษา --'); ?>
    </td>
  </tr>
  <tr>
    <th>อาชีพ
     </th>
    <td>
    	<?php echo form_dropdown('occupation_id', get_option('id', 'occupation_name', 'act_occupation', '1=1 order by id asc'), @$cmain['occupation_id'], null, '-- เลือกอาชีพ --'); ?>
    </td>
  </tr>
  <tr>
    <th>ประเภทของผู้รับบริการ</th>
    <td>
    	<?php foreach($target_groups as $row):?>
    		<?php
    			$sub = $this->csub->where("id_card = ".$cmain['id_card']." and question_name = 'target' and answer_id = ".$row['target_id'])->get_row();
				// print_r($sub);
    		?>
    		<span>
    			<input name="answer_id[]" type="checkbox" value="<?php echo $row['target_id']?>" <?php echo ($row['target_id'] == @$sub['answer_id'])?'checked':'';?>/> <?php echo $row['target_name']?> 
    			<input name="other[]" type="text" value="<?php echo @$sub['other']?>" style="width:100px;" />
    		</span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="note" rows="3" style="width:500px;"><?php echo $cmain['note']?></textarea></td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?php echo $cmain['id']?>"/>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>

<?php if($this->uri->segment(4) != ""):?>
<h3>หน่วยงานที่เข้ารับบริการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
<th>ชื่อหน่วยงาน</th>
<th>วันที่</th>
<th>ปัญหา</th>
<th>บริการที่ได้รับ</th>
<th>จัดการ</th>
</tr>
<?php foreach($csubs as $row):?>
<tr>
<td><?=$row['sub2_name']?></td>
<td><?=$row['sub2_date']?></td>
<td><?=$row['problem']?></td>
<td><?=$row['detail']?></td>
<td>
	<input type="hidden" name="id" value="<?=$row['id']?>">
	<input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip example8" />
    <a href="act/welfare_service/customer_sub2_delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</td>
</tr>
<?php endforeach;?>
</table>
<?php endif;?>

<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<div id="csubs2_form">

</div>
</div>
</div>