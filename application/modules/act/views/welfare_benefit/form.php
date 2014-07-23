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
	  $(this).closest('td.td_service').find('input[name=service]').filter(function(){return this.value==inputval}).attr('checked','checked');
	  $(this).closest('td.td_process').find('input[name=process]').filter(function(){return this.value==inputval}).attr('checked','checked');
	});
	
	$('.td_chkboxType2 input[type=checkbox]').change(function(){
		if(this.checked){
			$(this).closest('span').find('input').removeAttr('disabled');
		}else{
			$(this).closest('span').find('input').slice(1).attr('disabled','disabled');
		}
	});
    
});
</script>
<form method="post" action="act/welfare_benefit/save">
<h3>บันทึก องค์กรสาธาณประโยชน์ (บันทึก / แก้ไข)</h3>
<div id="tabs2" class="type2" style="display:block;">
  <ul>
    <li><a href="#tabs-type2-1">ข้อมูลทั่วไป</a></li>
    <li><a href="#tabs-type2-2">ข้อมูลบุคลากร</a></li>
    <li><a href="#tabs-type2-3">วัตถุประสงค์และกลุ่มเป้าหมาย</a></li>
    <li><a href="#tabs-type2-4">อื่นๆ</a></li>
    <li><a href="#tabs-type2-5">สถานะขั้นตอน</a></li>
  </ul>
  
<div id="tabs-type2-1" >
<table class="tbadd">
<tr>
    <th>องค์กรสาธารณประโยชน์</th>
    <td>
    	<span><input type="radio" name="UNDER_TYPE_SUB" value="3" <?=@$orgmain['under_type_sub']==3?"checked":"";?> />มูลนิธิ</span> 
		<span><input type="radio" name="UNDER_TYPE_SUB" value="4" <?=@$orgmain['under_type_sub']==4?"checked":"";?>/>สมาคม</span> 
		<span><input type="radio" name="UNDER_TYPE_SUB" value="5" <?=@$orgmain['under_type_sub']==5?"checked":"";?>/>องค์กรภาคเอกชน</span>
	</td>
  </tr>
  <tr>
    <th>ทะเบียนเลขที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NO" type="text" style="width:200px;" value="<?=@$orgmain['organ_no']?>"/></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" style="width:350px;" placeholder="ภาษาไทย (Thai)" value="<?=@$orgmain['organ_name']?>"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)" value="<?=@$orgmain['organ_name_eng']?>"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียนก่อตั้งหน่วยงานหรือปีที่เริ่มดำเนินการ</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" type="text" style="width:80px;" value="<?=@$orgmain['establish_date']?>"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" type="text" id="textfield8" style="width:50px;" value="<?=@$orgmain['home_no']?>"/>
    หมู่ที่
    <input name="MOO" type="text" id="textfield9" style="width:30px;" value="<?=@$orgmain['moo']?>"/>
    ตรอก/ซอย
    <input name="SOI" type="text" id="textfield10" style="width:200px;" value="<?=@$orgmain['soi']?>"/>
    ถนน
    <input name="ROAD" type="text" id="textfield11" style="width:200px;" value="<?=@$orgmain['road']?>"/>
    <br />
    จังหวัด 
    <?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$orgmain['province_code'], null, '- เลือกจังหวัด -'); ?>
    อำเภอ
    <?php echo form_dropdown('ampor_code', (empty($orgmain['province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$orgmain['province_code'].' order by ampor_name'), @$orgmain['ampor_code'], null, '- เลือกอำเภอ -'); ?>
    ตำบล
    <?php echo form_dropdown('tumbon_code', (empty($orgmain['ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$orgmain['ampor_code'].' order by tumbon_name'), @$orgmain['tumbon_code'], null, '-- เลือกตำบล --'); ?>
    รหัสไปรณีย์
    <input name="POST_CODE" type="text" style="width:70px;" value="<?=@$orgmain['post_code']?>"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ <span class="Txt_red_12"> *</span></th>
    <td><input name="TEL" type="text" style="width:200px;" value="<?=@$orgmain['tel']?>"/></td>
  </tr>
  <tr>
    <th>แฟกช์</th>
    <td><input name="FAX" type="text" style="width:200px;" value="<?=@$orgmain['fax']?>"/></td>
  </tr>
  <tr>
    <th>อีเมล์</th>
    <td><input name="EMAIL" type="text" style="width:250px;" value="<?=@$orgmain['email']?>"/></td>
  </tr>
  <tr>
    <th>เว็บไซต์
     </th>
    <td><input name="WEBSITE" type="text" style="width:250px;" value="<?=@$orgmain['website']?>"/></td>
  </tr>
</table>
</div><!--tabs-type2-1-->



<div id="tabs-type2-2">
<table class="tbadd">
<tr>
    <th>ผู้บริหารองค์การ</th>
    <td>
    	<?php echo form_dropdown('ma_title', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$orgmain['ma_title'], null, '-- คำนำหน้า --'); ?>    
    <input name="MA_NAME" type="text" style="width:250px;" value="<?=@$orgmain['ma_name']?>"/> 
    ตำแหน่ง 
    <input name="MA_POSITION" type="text" style="width:300px;" value="<?=@$orgmain['ma_position']?>"/></td>
  </tr>
  <tr>
    <th>ผู้ประสานงาน</th>
    <td>
    	<?php echo form_dropdown('co_title', get_option('title_id', 'title_name', 'act_title_name', '1=1 order by title_name asc'), @$orgmain['co_title'], null, '-- คำนำหน้า --'); ?>
      <input name="CO_NAME" type="text" style="width:250px;" value="<?=@$orgmain['co_name']?>"/>
ตำแหน่ง
<input name="CO_POSITION" type="text" style="width:300px;" value="<?=@$orgmain['co_position']?>"/></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ ผู้ประสานงาน
    </th>
    <td>เลขที่
      <input name="CO_HOME_NO" type="text" id="textfield25" style="width:50px;" value="<?=@$orgmain['co_home_no']?>"/>
      หมู่ที่
      <input name="CO_MOO" type="text" id="textfield26" style="width:30px;" value="<?=@$orgmain['co_moo']?>"/>
      ตรอก/ซอย
      <input name="CO_SOI" type="text" id="textfield27" style="width:200px;" value="<?=@$orgmain['co_soi']?>"/>
      ถนน
      <input name="CO_ROAD" type="text" id="textfield28" style="width:200px;" value="<?=@$orgmain['co_road']?>"/>
      <br />
       จังหวัด
      <?php echo form_dropdown('co_province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$orgmain['co_province_code'], null, '- เลือกจังหวัด -'); ?>
      อำเภอ
      <?php echo form_dropdown('co_ampor_code', (empty($orgmain['co_province_code'])) ? array() : get_option('ampor_code', 'ampor_name', 'act_ampor', 'province_code = '.$orgmain['co_province_code'].' order by ampor_name'), @$orgmain['co_ampor_code'], null, '- เลือกอำเภอ -'); ?>
      ตำบล
      <?php echo form_dropdown('co_tumbon_code', (empty($orgmain['co_ampor_code'])) ? array() : get_option('tumbon_code', 'tumbon_name', 'act_tumbon', 'ampor_code = '.$orgmain['co_ampor_code'].' order by tumbon_name'), @$orgmain['co_tumbon_code'], null, '-- เลือกตำบล --'); ?>
      รหัสไปรณีย์
      <input name="CO_POST_CODE" type="text" style="width:70px;" value="<?=@$orgmain['co_post_code']?>"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์ ผู้ประสานงาน</th>
    <td><input name="CO_TEL" type="text" style="width:200px;" value="<?=@$orgmain['co_tel']?>"/></td>
  </tr>
  <tr>
    <th>โทรสาร
    ผู้ประสานงาน</th>
    <td><input name="CO_FAX" type="text" style="width:200px;" value="<?=@$orgmain['co_fax']?>"/></td>
  </tr>
  <tr>
    <th>โทรศัพท์มือถือ ผู้ประสานงาน
     </th>
    <td><input name="CO_PHONE" type="text" style="width:200px;" value="<?=@$orgmain['co_phone']?>"/></td>
  </tr>
  <tr>
    <th>อีเมล์
    ผู้ประสานงาน</th>
    <td><input name="CO_EMAIL" type="text" style="width:250px;" value="<?=@$orgmain['co_email']?>"/></td>
  </tr>
  <tr>
    <th>จำนวนบุคลากร</th>
    <td><input name="STAFF_NUMBER" type="text" style="width:50px;" value="<?=@$orgmain['staff_number']?>"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนนักสังคมสงเคราะห์
     </th>
    <td><input name="SUPPORTER_NUMBER" type="text" style="width:50px;" value="<?=@$orgmain['supporter_number']?>"/> 
      คน</td>
  </tr>
  <tr>
    <th>จำนวนอาสาสมัคร
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" style="width:50px;" value="<?=@$orgmain['volunteer_number']?>"/>
คน</td>
  </tr>
</table>
</div> <!--tabs-type2-2-->



<div id="tabs-type2-3">
<table class="tbadd">
<tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" style="width:500px;"><?=@$orgmain['objective']?></textarea></td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="N_AREA" type="text" style="width:80px;" value="<?=@$orgmain['n_area']?>"/>
หมู่บ้าน/ชุมชน    
<input name="M_AREA" type="text" style="width:50px;" value="<?=@$orgmain['m_area']?>"/> 
ตำบล/แขวง 
<input name="O_AREA" type="text" style="width:50px;" value="<?=@$orgmain['o_area']?>"/>

   อำเภอ/เขต 
      <input name="P_AREA" type="text" style="width:50px;" value="<?=@$orgmain['p_area']?>"/>
จังหวัด 
<input name="Q_AREA" type="text" style="width:50px;" value="<?=@$orgmain['q_area']?>"/>
   </td>
  </tr>
  <tr>
    <th>กลุ่มเป้าหมายผู้รับบริการสวัสดิการสังคม</th>
    <td class="td_targetgroup">
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
</table>
</div><!--tabs-type2-3-->


<div id="tabs-type2-4">
<table class="tbadd">
<tr>
    <th>รูปแบบการดำเนินการ</th>
    <td class="td_chkboxType2">
    	<? 
    		// echo "<pre>";
			// echo print_r($format_select);
			// echo "</pre>";
			
			function searchForId($id, $array) {
			   foreach ($array as $key => $val) {
			       if ($val['answer_id'] === $id) {
			           return $key;
			       }
			   }
			   return null;
			}
    	?>
    	<?php foreach($formats as $row):?>
		<?@$searchkey = searchForId($row['format_id'], $format_select);?>
		<span>
			<input name="answer_id[]" type="checkbox" value="<?php echo $row['format_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>> <?php echo $row['format_name']?>
			<input name="other[]" type="text" style="width:100px;" value="<?=@$format_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
			<input name="question_name[]" type="hidden" value="format" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
		</span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>วิธีการดำเนินการ</th>
    <td class="td_chkboxType2">
    	<?php foreach($methods as $row):?>
    	<?@$searchkey = searchForId($row['method_id'], $method_select);?>
    	<span>
    		<input name="answer_id[]" type="checkbox" value="<?php echo $row['method_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>> <?php echo $row['method_name']?>
    		<input name="other[]" type="text" style="width:100px;" value="<?=@$method_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
    		<input name="question_name[]" type="hidden" value="method" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
    	</span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>รูปแบบการให้บริการ </th>
    <td class="td_chkboxType2">
    	<?php foreach($service_types as $row):?>
    	<?@$searchkey = searchForId($row['service_type_id'], $service_type_select);?>
    		<span>
    			<input name="answer_id[]" type="checkbox" value="<?php echo $row['service_type_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>/><?php echo $row['service_type_name']?> 
    			<input name="other[]" type="text" style="width:100px;" value="<?=@$service_type_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
				<input name="question_name[]" type="hidden" value="service_type" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>>
    		</span>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>การส่งเสริมและสนับสนุนให้องค์กรต่างๆ ได้มีส่วนร่วมในการจัดสวัสดิการสังคม </th>
    <td class="td_chkboxType2">
    	<?php foreach($promotes as $row):?>
    	<?@$searchkey = searchForId($row['promote_id'], $promote_select);?>
		<span>
			<input name="answer_id[]" type="checkbox" value="<?php echo $row['promote_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>> <?php echo $row['promote_name']?> 
			<input name="other[]" type="text" style="width:100px;" value="<?=@$promote_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
			<input name="question_name[]" type="hidden" value="promote" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
		</span>
    	<?php endforeach;?>
    	</td>
  </tr>
  <tr>
    <th>ได้รับการสนับสนุนตาม พ.ร.บ. ส่งเสริมการจัดสวัสดิการทางสังคม พ.ศ. 2546 </th>
    <td class="td_chkboxType2">
    	<?php foreach($promote_gets as $row):?>
    	<?@$searchkey = searchForId($row['promote_get_id'], $promote_get_select);?>
    		<span>
    			<input name="answer_id[]" type="checkbox" value="<?php echo $row['promote_get_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>> <?php echo $row['promote_get_name']?>
    			<input name="other[]" type="text" style="width:100px;" value="<?=@$promote_get_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
    			<input name="question_name[]" type="hidden" value="promote_get" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
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
        <option value=<?=$i?> <?=@$orgmain['year_money'] == $i ? 'selected' : '' ;?>><?=$i?></option>
        <?}?>
      </select>
<span>จำนวนเงิน
<input name="BUDGET1" type="text" style="width:120px;" value="<?=@$orgmain['budget1']?>"/>
บาท</span>เงินทุน
<input name="BUDGET2" type="text" style="width:120px;" value="<?=@$orgmain['budget2']?>" />
บาท</td>
  </tr>
  <tr>
    <th>เอกสารตีพิมพ์ </th>
    <td><span style="width:40%">
      <input name="DOCUMENT_PRINT" type="text" style="width:350px;" value="<?=@$orgmain['document_print']?>" />
    </span></td>
  </tr>
  <tr>
    <th>หมายเหตุ
     </th>
    <td><textarea name="NOTE" rows="3" style="width:500px;"><?=@$orgmain['note']?></textarea></td>
  </tr>
</table>
</div><!--tabs-type2-4-->


<div id="tabs-type2-5">
<table class="tbadd">
  <tr>
    <th>จดทะเบียนองค์กร</th>
    <td><input type="checkbox" name="ORGAN_HELP_CHECK" value="Y" <?=@$orgmain['organ_help_check'] == "Y" ? 'checked' : '' ;?> />
    จดทะเบียน</td>
  </tr>
  <tr>
    <th>สถานะขั้นตอน</th>
    <td><select name="STEP_STATUS">
    <option value="">-- สถานะ --</option>
    <option value="1" <?=@$orgmain['step_status'] == 1 ? 'selected="selected"' : '' ;?>>รับเรื่อง</option>
    <option value="2" <?=@$orgmain['step_status'] == 2 ? 'selected="selected"' : '' ;?>>อนุรับรอง</option>
    <option value="3" <?=@$orgmain['step_status'] == 3 ? 'selected="selected"' : '' ;?>>ส่งใบสำคัญ</option>
    <option value="4" <?=@$orgmain['step_status'] == 4 ? 'selected="selected"' : '' ;?>>ประกาศกิจจานุเบกษา</option>
    <option value="5" <?=@$orgmain['step_status'] == 5 ? 'selected="selected"' : '' ;?>>ไม่รับรอง</option>
  </select></td>
  </tr>
</table>
</div> <!--tabs-type2-5-->


</div><!--tabs-type2-->
<!-- องค์กรสาธารณประโยชน์ -->



<div id="btnBoxAdd">
  <input type="hidden" name="UNDER_TYPE" value="2">
  <input type="hidden" name="id" value="<?=@$orgmain['id']?>">
  <input type="hidden" name="organ_id" value="<?=@$orgmain['organ_id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>

