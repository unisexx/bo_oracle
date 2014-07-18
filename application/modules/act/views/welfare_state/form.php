<script>
$(document).ready(function(){
	$( "#tabs, #tabs2, #tabs3" ).tabs();
    
    var province_code = $('[name=province_code]').val();
    var ampor_code = $('[name=ampor_code]').val();
    
    $('[name=ampor_code]').chainedSelect({
    	parent: '[name=province_code]',
    	url: 'act/welfare/ajax_ampor?p='+province_code,
    	value: 'ampor_code',
    	label: 'text'
    });
    
    $('[name=tumbon_code]').chainedSelect({
    	parent: '[name=ampor_code]',
    	url: 'act/welfare/ajax_tumbon?p='+province_code+'&q='+ampor_code,
    	value: 'tumbon_code',
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
    
    
    var co_province_code = $('[name=co_province_code]').val();
    var co_ampor_code = $('[name=co_ampor_code]').val();
    
    $('[name=co_ampor_code]').chainedSelect({
    	parent: '[name=co_province_code]',
    	url: 'act/welfare/ajax_ampor',
    	value: 'ampor_code',
    	label: 'text'
    });
    
    $('[name=co_tumbon_code]').chainedSelect({
    	parent: '[name=co_ampor_code]',
    	url: 'act/welfare/ajax_tumbon?p='+co_province_code,
    	value: 'tumbon_code',
    	label: 'text'
    });
    
    $("[name=co_province_code]").live('change',function(){
    	$('[name=co_tumbon_code]').chainedSelect({
    		parent: '[name=co_ampor_code]',
    		url: 'act/welfare/ajax_tumbon?p='+$(this).val(),
    		value: 'tumbon_code',
    		label: 'text'
    	});
    });
});
</script>

<form method="post" action="act/welfare_state/save">

<h3>บันทึก หน่วยงานของรัฐ (บันทึก / แก้ไข)</h3>

<div id="tabs" class="type1" style="display:block;">
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
      <input type="radio" name="UNDER_TYPE_SUB" id="radio" value="1" <?=@$orgmain['under_type_sub'] == 1 ? 'checked' : '' ?> />
ส่วนราชการ</span> <span>
<input type="radio" name="UNDER_TYPE_SUB" id="radio2" value="2" <?=@$orgmain['under_type_sub'] == 2 ? 'checked' : '' ?> />
องค์กรปกครองส่วนท้องถิ่น</span></td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NO" type="text" value="<?=@$orgmain['organ_no']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" value="<?=@$orgmain['organ_name']?>" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" value="<?=@$orgmain['organ_name_eng']?>" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>สังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="UNDER_NAME" type="text" value="<?=@$orgmain['under_name']?>" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>กระทรวง <span class="Txt_red_12"> *</span></th>
    <td><input name="MINISTRY_NAME" type="text" value="<?=@$orgmain['ministry_name']?>" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>หน่วยงานในสังกัด <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_INSIDE" type="text" value="<?=@$orgmain['organ_inside']?>" style="width:350px;"/></td>
  </tr>
  <tr>
    <th>วัน/เดือน/ปี ที่ก่อตั้ง</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" value="<?=@$orgmain['establish_date']?>" type="text" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" value="<?=@$orgmain['home_no']?>" type="text" style="width:50px;"/>
    หมู่ที่
    <input name="MOO" type="text" value="<?=@$orgmain['moo']?>" style="width:30px;"/>
    ตรอก/ซอย
    <input name="SOI" type="text" value="<?=@$orgmain['soi']?>" style="width:200px;"/>
    ถนน
    <input name="ROAD" type="text" value="<?=@$orgmain['road']?>" style="width:200px;"/>
    <br />
    จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$orgmain['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($orgmain['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$orgmain['province_code'].' order by ampor_name'), @$orgmain['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($orgmain['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$orgmain['ampor_code'].' order by tumbon_name'), @$orgmain['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="POST_CODE" type="text" value="<?=@$orgmain['post_code']?>" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="TEL" type="text" value="<?=@$orgmain['tel']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="FAX" type="text" value="<?=@$orgmain['fax']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="EMAIL" type="text" value="<?=@$orgmain['email']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="WEBSITE" type="text" value="<?=@$orgmain['website']?>" style="width:250px;"/></td>
  </tr>
</table>
</div><!--tabs-type1-1-->



<div id="tabs-type1-2">
<table class="tbadd">
 <tr>
    <th>ผู้บริหารองค์การ</th>
    <td>
    	<?php echo form_dropdown('executive_title', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$orgmain['executive_title'], null, '-- คำนำหน้า --'); ?> 
    <input name="EXECUTIVE_NAME" type="text" value="<?=@$orgmain['executive_name']?>" style="width:250px;"/> 
    ตำแหน่ง 
    <input name="EXECUTIVE_POSITION" value="<?=@$orgmain['executive_position']?>" type="text" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td>
    	<?php echo form_dropdown('co_title', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$orgmain['co_title'], null, '-- คำนำหน้า --'); ?> 
      <input name="CO_NAME" type="text" value="<?=@$orgmain['co_name']?>" style="width:250px;"/>
ตำแหน่ง
<input name="CO_POSITION" type="text" value="<?=@$orgmain['co_position']?>" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="CO_HOME_NO" value="<?=@$orgmain['co_home_no']?>" type="text" style="width:50px;"/>
      หมู่ที่
      <input name="CO_MOO" type="text" value="<?=@$orgmain['co_moo']?>" style="width:30px;"/>
      ตรอก/ซอย
      <input name="CO_SOI" type="text" value="<?=@$orgmain['co_soi']?>" style="width:200px;"/>
      ถนน
      <input name="CO_ROAD" type="text" value="<?=@$orgmain['co_road']?>" style="width:200px;"/>
      <br />
      จังหวัด
      <?php echo form_dropdown('co_province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$orgmain['co_province_code'], null, '- เลือกจังหวัด -'); ?>
      อำเภอ
      <?php echo form_dropdown('co_ampor_code', (empty($orgmain['co_province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$orgmain['co_province_code'].' order by ampor_name'), @$orgmain['co_ampor_code'], null, '- เลือกอำเภอ -'); ?>
      ตำบล
      <?php echo form_dropdown('co_tumbon_code', (empty($orgmain['co_ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$orgmain['co_ampor_code'].' order by tumbon_name'), @$orgmain['co_tumbon_code'], null, '-- เลือกตำบล --'); ?>
      รหัสไปรณีย์
      <input name="CO_POST_CODE" value="<?=@$orgmain['co_post_code']?>" type="text" style="width:70px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="CO_TEL" type="text" value="<?=@$orgmain['co_tel']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="CO_FAX" type="text" value="<?=@$orgmain['co_fax']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="CO_PHONE" type="text" value="<?=@$orgmain['co_phone']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="CO_EMAIL" type="text" value="<?=@$orgmain['co_email']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <th>จำนวนข้าราชการและเจ้าหน้าที่
     </th>
    <td><input name="STAFF_NUMBER" type="text" value="<?=@$orgmain['staff_number']?>" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="SUPPORTER_NUMBER" type="text" value="<?=@$orgmain['supporter_number']?>" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" value="<?=@$orgmain['volunteer_number']?>" style="width:50px;"/>
คน</td>
  </tr>
</table>
</div> <!--tabs-type1-2-->



<div id="tabs-type1-3">
<table class="tbadd">
<tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" style="width:500px;"><?=@$orgmain['objective']?></textarea></td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม</th>
    <td class="td_targetgroup">
    	
    	<script type="text/javascript">
    	$(document).ready(function(){
    		$('.chkboxselected').change(function(){
    			var selected_text = $(this).closest('span').text();
    			var selected_id = $(this).val();
    			var select_type = $(this).attr('name');
    				
    			if(this.checked){
    				var count_element = $(this).closest('tr').find('.tb_selected_place tr').length + 1;
	    			var ele = '<tr class="target_'+selected_id+'"><td style="width:10%">'+count_element+'</td><td style="width:30%">'+selected_text+'</td><td style="width:40%"><input type="text" name="other[]" style="width:350px;"><input type="hidden" name="answer_id[]" value="'+selected_id+'"><input type="hidden" name="question_name[]" value="'+select_type+'"></td><td style="width:10%"></td></tr>';
	    			$(this).closest('td').find('.tb_selected_place').append(ele);
    			}else{
    				$(this).closest('td').find('.tb_selected_place').find('.target_'+selected_id).remove();
    			}
    		});
    		
    		// checkbox selected
			$( "input[type=hidden][name=answer_id[]]" ).each(function( index ) {
			  // console.log( index + ": " + $( this ).val() );
			  var inputval = $( this ).val();
			  $(this).closest('td.td_targetgroup').find('input[name=target]').filter(function(){return this.value==inputval}).attr('checked','checked');
			  $(this).closest('td.td_targetgroup').find('input[name=service]').filter(function(){return this.value==inputval}).attr('checked','checked');
			  $(this).closest('td.td_targetgroup').find('input[name=process]').filter(function(){return this.value==inputval}).attr('checked','checked');
			});
    	});
    	</script>
    	<?php foreach($target_groups as $row):?>
    		<span><input class="chkboxselected" name="target" type="checkbox" value="<?=$row['target_id']?>"/> <?php echo $row['target_name']?> </span>
    	<?php endforeach;?>
	    <table class="tblist">
	    <tr>
	    <th>ลำดับ</th>
	    <th>ชื่อกลุ่มเป้าหมาย</th>
	    <th>ระบุ</th>
	    <th></th>
	    </tr>
	    <tbody class="tb_selected_place">
	    	<?if(@$orgmain['organ_id'] > "0"):?>
	    		<?php foreach($targetgroup_select as $key=>$row):?>
		    	<tr class="target_<?=$row['answer_id']?>">
		    		<td style="width:10%"><?=$key+1?></td>
		    		<td style="width:30%"><?=act_get_target_group_name($row['answer_id'])?></td>
		    		<td style="width:40%">
		    			<input type="text" name="other[]" value="<?=$row['other']?>" style="width:350px;">
		    			<input type="hidden" name="answer_id[]" value="<?=$row['answer_id']?>">
		    			<input type="hidden" name="question_name[]" value="<?=$row['question_name']?>">
		    		</td>
		    		<td style="width:10%"></td>
		    	</tr>
		    	<?php endforeach;?>
	    	<?endif;?>
	    </tbody>
	    </table>
    
    </td>
  </tr>
  <tr>
    <th>สาขาการให้บริการ</th>
    <td class="td_service">
    	<?php foreach($services as $row):?>
    		<span><input class="chkboxselected" name="service" value="<?php echo $row['service_id']?>" type="checkbox" />
<?php echo $row['service_name']?> </span>
    	<?php endforeach;?>
    	
		<table class="tblist">
		  <tr>
		    <th>ลำดับ</th>
		    <th>ชื่อสาขาการให้บริการ</th>
		    <th>ระบุ</th>
		    <th></th>
		  </tr>
		  <tbody class="tb_selected_place">
		  	<?if(@$orgmain['organ_id'] > "0"):?>
			  	<?php foreach($service_select as $key=>$row):?>
		    	<tr class="target_<?=$row['answer_id']?>">
		    		<td style="width:10%"><?=$key+1?></td>
		    		<td style="width:30%"><?=act_get_service_name($row['answer_id'])?></td>
		    		<td style="width:40%">
		    			<input type="text" name="other[]" value="<?=$row['other']?>" style="width:350px;">
		    			<input type="hidden" name="answer_id[]" value="<?=$row['answer_id']?>">
		    			<input type="hidden" name="question_name[]" value="<?=$row['question_name']?>">
		    		</td>
		    		<td style="width:10%"></td>
		    	</tr>
		    	<?php endforeach;?>
	    	<?endif;?>
		  </tbody>
		</table>
	</td>
  </tr>
  <tr>
    <th>ลักษณะการดำเนินการ</th>
    <td class="td_process">
    	<?php foreach($processes as $row):?>
    		<span><input class="chkboxselected" name="process" type="checkbox" value="<?php echo $row['process_id']?>" /> <?php echo $row['process_name']?> </span>
    	<?php endforeach;?>
    	
		<table class="tblist">
		  <tr>
		    <th>ลำดับ</th>
		    <th>ชื่อลักษณะการดำเนินการ</th>
		    <th>ระบุ</th>
		    <th></th>
		  </tr>
		  <tbody class="tb_selected_place">
		  	<?if(@$orgmain['organ_id'] > "0"):?>
				<?php foreach($process_select as $key=>$row):?>
		    	<tr class="target_<?=$row['answer_id']?>">
		    		<td style="width:10%"><?=$key+1?></td>
		    		<td style="width:30%"><?=act_get_process_name($row['answer_id'])?></td>
		    		<td style="width:40%">
		    			<input type="text" name="other[]" value="<?=$row['other']?>" style="width:350px;">
		    			<input type="hidden" name="answer_id[]" value="<?=$row['answer_id']?>">
		    			<input type="hidden" name="question_name[]" value="<?=$row['question_name']?>">
		    		</td>
		    		<td style="width:10%"></td>
		    	</tr>
		    	<?php endforeach;?>
	    	<?endif;?>
		  </tbody>
		</table>
	</td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="NOTE" rows="3" style="width:500px;"><?=@$orgmain['note']?></textarea></td>
  </tr>
</table>
</div><!--tabs-type1-3-->


<div id="tabs-type1-4">
<table class="tbadd">
 <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="STEP_STATUS">
    <option value="0">-- สถานะ --</option>
    <option value="1" <?=@$orgmain['step_status'] == 1 ? 'selected="selected"' : '' ;?>>รับเรื่อง</option>
    <option value="2" <?=@$orgmain['step_status'] == 2 ? 'selected="selected"' : '' ;?>>อนุรับรอง</option>
    <option value="3" <?=@$orgmain['step_status'] == 3 ? 'selected="selected"' : '' ;?>>ส่งใบสำคัญ</option>
    <option value="4" <?=@$orgmain['step_status'] == 4 ? 'selected="selected"' : '' ;?>>ประกาศกิจจานุเบกษา</option>
    <option value="5" <?=@$orgmain['step_status'] == 5 ? 'selected="selected"' : '' ;?>>ไม่รับรอง</option>
  </select></td>
  </tr>
</table>
</div> <!--tabs-type1-4-->

</div><!--tabs--><!-- หน่วยงานของรัฐ -->


<div id="btnBoxAdd">
  <input type="hidden" name="UNDER_TYPE" value="1">
  <input type="hidden" name="id" value="<?=@$orgmain['id']?>">
  <input type="hidden" name="organ_id" value="<?=@$orgmain['organ_id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>
