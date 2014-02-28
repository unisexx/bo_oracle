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
});
</script>

<h3>บันทึก รายชื่อคณะทำงาน (บันทึก / แก้ไข)</h3>

<form method="post" action="act/workinggroup/save">
<table class="tbadd">
  <tr>
    <th>จังหวัด </th>
    <td><?php echo form_dropdown('province_type', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$officer['province_type'], '', '- เลือกจังหวัด -'); ?></td>
  </tr>
  <tr>
    <th>ชื่อ - สกุล <span class="Txt_red_12"> *</span></th>
    <td>
      <?php echo form_dropdown('title_id', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$officer['title_id'], null, '-- คำนำหน้า --'); ?> 
      
      <input name="fname" type="text" value="<?php echo $officer['fname']?>" style="width:150px;" placeholder="ชื่อ"/>
      <input name="lname" type="text" value="<?php echo $officer['lname']?>" style="width:250px;" placeholder="นามสกุล"/></td>
  </tr>
  <tr>
    <th>เพศ <span class="Txt_red_12"> *</span></th>
    <td><span>
      <input type="radio" name="sex" value="M" <?php echo ($officer['sex'] == 'M')?'checked=chedked':'';?> />
      ชาย </span> <span>
	  <input type="radio" name="sex" value="F" <?php echo ($officer['sex'] == 'F')?'checked=chedked':'';?> />
        หญิง </span></td>
  </tr>
  <tr>
    <th>วันที่ได้รับการแต่งตั้งให้เป็นคณะทำงาน</th>
    <td><input name="date_receive" type="text" class="datepicker" value="<?php echo $officer['date_receive']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>ประเภทสังกัด</th>
    <td><span>
      <input type="radio" name="under_type" value="1" <?php echo ($officer['under_type'] == '1')?'checked=chedked':'';?> /> ราชการ </span> <span>
	  <input type="radio" name="under_type" value="2" <?php echo ($officer['under_type'] == '2')?'checked=chedked':'';?> /> เอกชน </span></td>
  </tr>
<tr>
  <th><label for="fid-full_name4">ชื่อหน่วยงานที่สังกัด</label>    </th>
  <td>
  	<?php echo form_dropdown('under_id', get_option('under_id', 'under_name', 'act_under', '1=1 order by under_name asc'), @$officer['under_id'], null, '-- เลือกหน่วยงานที่สังกัด --'); ?> 
  	
    <input name="under_position" type="text" value="<?php echo $officer['under_position']?>" style="width:300px;" placeholder="ยศ/ตำแหน่ง"/></td>
</tr>
<tr>
  <th>สถานที่ทำงาน/ติดต่อ <span class="Txt_red_12"> *</span></th>
  <td>เลขที่
    <input name="home_no" type="text" value="<?php echo $officer['home_no']?>" style="width:50px;"/>
    หมู่ที่
    <input name="moo" type="text" value="<?php echo $officer['moo']?>"  style="width:30px;"/>
    ตรอก/ซอย
    <input name="soi" type="text" value="<?php echo $officer['soi']?>"  style="width:200px;"/>
    ถนน
    <input name="road" type="text" value="<?php echo $officer['road']?>" style="width:200px;"/>
    <br />
     จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$officer['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($officer['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$officer['province_code'].' order by ampor_name'), @$officer['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($officer['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$officer['ampor_code'].' order by tumbon_name'), @$officer['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="post_code" type="text" value="<?php echo $officer['post_code']?>" style="width:70px;"/></td>
</tr>
<tr>
  <th>โทรศัพท์</th>
  <td><input name="tel" type="text" value="<?php echo $officer['tel']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>แฟกช์</th>
  <td><input name="fax" type="text" value="<?php echo $officer['fax']?>" style="width:200px;"/></td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="email" type="text" value="<?php echo $officer['email']?>" style="width:250px;"/></td>
</tr>
<tr>
  <th>หมายเหตุ
  </th>
  <td><textarea name="note" rows="3" style="width:500px;"><?php echo $officer['note']?></textarea></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input type='hidden' name="id" value="<?php echo $officer['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>

