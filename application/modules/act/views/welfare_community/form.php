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
    
    $(document).ready(function(){
		$('.td_chkboxType2 input[type=checkbox]').change(function(){
			if(this.checked){
				$(this).closest('span').find('input').removeAttr('disabled');
			}else{
				$(this).closest('span').find('input').slice(1).attr('disabled','disabled');
			}
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
	  $(this).closest('td.td_targetgroup').find('input[name=service_com]').filter(function(){return this.value==inputval}).attr('checked','checked');
	});
    
});
</script>

<form method="post" action="act/welfare_community/save">
	
<h3>บันทึก องค์กรสวัสดิการชุมชน (บันทึก / แก้ไข)</h3>

<div id="tabs3" class="type3" style="display:block;">
  <ul>
    <li><a href="#tabs-type3-1">ข้อมูลทั่วไป</a></li>
    <li><a href="#tabs-type3-2">สวัสดิการและวิธีการดำเนินงาน</a></li>
    <li><a href="#tabs-type3-3">สถานะขั้นตอน</a></li>
  </ul>
  
<div id="tabs-type3-1" >
<table class="tbadd">
<tr>
    <th>องค์กรสวัสดิการชุมชน</th>
    <td><span>
      <input type="radio" name="UNDER_TYPE_SUB" value="10" <?=@$orgmain['under_type_sub']==10?"checked":"";?>/>
องค์กรสวัสดิการชุมชน</span> <span>
<input type="radio" name="UNDER_TYPE_SUB" value="11" <?=@$orgmain['under_type_sub']==11?"checked":"";?>/>
เครือข่ายองค์กรสวัสดิการชุมชน</span></td>
  </tr>
  <tr>
    <th>ชื่อหน่วยงาน <span class="Txt_red_12"> *</span></th>
    <td><input name="ORGAN_NAME" type="text" value="<?=@$orgmain['organ_name']?>" style="width:350px;" placeholder="ภาษาไทย (Thai)"/> 
      / 
      <input name="ORGAN_NAME_ENG" type="text" value="<?=@$orgmain['organ_name_eng']?>" style="width:350px;" placeholder="ภาษาอังกฤษ (Eng)"/></td>
  </tr>
  <tr>
    <th>ปีที่จดทะเบียน</th>
    <td><input class="datepicker" name="ESTABLISH_DATE" type="text" value="<?=@$orgmain['establish_date']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>วัตถุประสงค์ <span class="Txt_red_12"> *</span></th>
    <td><textarea name="OBJECTIVE" rows="3" style="width:500px;"><?=@$orgmain['objective']?></textarea></td>
  </tr>
  <tr>
    <th>สถานที่ตั้ง/สถานที่ติดต่อ (สำนักงานใหญ่)  <span class="Txt_red_12"> *</span></th>
    <td>เลขที่
      <input name="HOME_NO" type="text" value="<?=@$orgmain['home_no']?>" style="width:50px;"/>
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
</div><!--tabs-type3-1-->



<div id="tabs-type3-2">
<table class="tbadd">
<tr>
    <th>ลักษณะการดำเนินการองค์กร</th>
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
    	<?php foreach($pcommunities as $row):?>
    	<?@$searchkey = searchForId($row['pcommunity_id'], $pcommunity_select);?>
    	<p>
    	<span>
			<input name="answer_id[]" type="checkbox" value="<?php echo $row['pcommunity_id']?>" <?=is_numeric($searchkey) ? 'checked' : '' ;?>> <?php echo $row['pcommunity_name']?>
			<?php if($row['pcommunity_name'] == "เครือข่ายองค์กรสวัสดิการชุมชน"):?>
			&nbsp;จำนวน <input name="other[]" type="text" style="width:100px;" value="<?=@$pcommunity_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/> องค์กร
			<?php else:?>
			<input name="other[]" type="hidden" style="width:100px;" value="<?=@$pcommunity_select[$searchkey]['other']?>" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
			<?php endif;?>
			<input name="question_name[]" type="hidden" value="ProcessCommunity" <?=is_numeric($searchkey) ? '' : 'disabled="disabled"' ;?>/>
		</span>
		</p>
    	<?php endforeach;?>
    </td>
  </tr>
  <tr>
    <th>จำนวนสมาชิก
     </th>
    <td><input name="MEMBER_NUMBER" type="text" value="<?=@$orgmain['member_number']?>" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>พื้นที่ปฏิบัติงาน</th>
    <td>ครอบคุลมจำนวนพื้นที่ 
      <input name="N_AREA" type="text" value="<?=@$orgmain['n_area']?>" style="width:80px;"/>
หมู่บ้าน/ชุมชน    
<input name="M_AREA" type="text" value="<?=@$orgmain['m_area']?>" style="width:50px;"/> 
ตำบล/แขวง 
<input name="O_AREA" type="text" value="<?=@$orgmain['o_area']?>" style="width:50px;"/>

   อำเภอ/เขต 
      <input name="P_AREA" type="text" value="<?=@$orgmain['p_area']?>" style="width:50px;"/>
จังหวัด 
<input name="Q_AREA" type="text" value="<?=@$orgmain['q_area']?>" style="width:50px;"/>
   </td>
  </tr>
  <tr>
    <th>จำนวนผู้ปฎิบัติงาน
     </th>
    <td><input name="VOLUNTEER_NUMBER" type="text" value="<?=@$orgmain['volunteer_number']?>" style="width:50px;"/> 
      คน</td>
  </tr>
  <tr>
    <th>สวัสดิการบริการที่จัดให้แก่สมาชิก</th>
    <td class="td_targetgroup">

    	<?php foreach($scommunities as $row):?>
    		<span><input class="chkboxselected" name="service_com" value="<?php echo $row['scommunity_id']?>" type="checkbox"/> <?php echo $row['scommunity_name']?> </span>
    	<?php endforeach;?>
    	
      <table class="tblist">
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อสวัสดิการบริการ</th>
          <th>ระบุ</th>
          <th></th>
        </tr>
        <tbody class="tb_selected_place">
	    	<?if(@$orgmain['organ_id'] > "0"):?>
	    		<?php foreach($service_com_select as $key=>$row):?>
		    	<tr class="target_<?=$row['answer_id']?>">
		    		<td style="width:10%"><?=$key+1?></td>
		    		<td style="width:30%"><?=act_get_service_com_name($row['answer_id'])?></td>
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
      </table></td>
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
        <option value="<?=$i?>" <?=@$orgmain['year_money']==$i ? 'selected' : '' ;?>><?=$i?></option>
        <?}?>
      </select>
      <span>จำนวนเงิน
        <input name="BUDGET1" type="text" value="<?=@$orgmain['budget1']?>" style="width:120px;" />
        บาท</span>
        <p>เงินที่มาจากสมาชิก
        <input name="BUDGET3" type="text" value="<?=@$orgmain['budget3']?>" style="width:120px;" />
      บาท</p>
      เงินสมทบจากภายนอก
      <p style="margin-left:30px;">- องค์กรปกครองส่วนท้องถิ่น  จำนวน 
      <input name="BUDGET4" type="text" value="<?=@$orgmain['budget4']?>" style="width:120px;" />
บาท </p><p style="margin-left:30px;">
- หน่วยงานอื่น   จำนวน
<input name="BUDGET5" type="text" value="<?=@$orgmain['budget5']?>" style="width:120px;" />
บาท </p>
เงินอื่นๆ   จำนวน
<input name="BUDGET6" type="text" value="<?=@$orgmain['budget6']?>" style="width:120px;" />
บาท </td>
  </tr>
  <tr>
    <th>อื่นๆ
     </th>
    <td><textarea name="NOTE" rows="3" style="width:500px;"><?=@$orgmain['note']?></textarea></td>
  </tr>
</table>
</div> <!--tabs-type3-2-->



<div id="tabs-type3-3">
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

</div><!--tabs-type3-->
<!-- องค์กรสวัสดิการชุมชน -->


<div id="btnBoxAdd">
  <input type="hidden" name="UNDER_TYPE" value="3">
  <input type="hidden" name="id" value="<?=@$orgmain['id']?>">
  <input type="hidden" name="organ_id" value="<?=@$orgmain['organ_id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>
