<style>
	.tbadd .topic { background:#FCC; border-top:1px dashed #ccc; width:100%; color:#000}
</style>
<script language='javascript'>
 function chang_strat(){
		if($('#metrics_start').val()=='' || $('#metrics_start').val() == 6){
			$('.metrics_cancel_6').show();
			$('.metrics_cancel_9').show();
			$('.metrics_cancel_12').show();
			
			$('.metrics_6').show();
			$('.metrics_9').show();
			$('.metrics_12').show();
			
			$('#sem_9_6').attr('checked','checked');
			$('#sem_12_6').attr('checked','checked');
			
			$('.metrics_dtl_9').hide();
			$('.metrics_dtl_12').hide();
			
		}else if($('#metrics_start').val() == 9){
			$('.metrics_cancel_6').hide();
			$('.metrics_cancel_9').show();
			$('.metrics_cancel_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').show();
			$('.metrics_12').show();
			
			$('#sem_9_9').attr('checked','checked');
			$('#sem_12_9').attr('checked','checked');
			$('.metrics_dtl_9').show();
			
		}else if($('#metrics_start').val() == 12){
			$('.metrics_cancel_6').hide();
			$('.metrics_cancel_9').hide();
			$('.metrics_cancel_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').hide();
			$('.metrics_12').show();
			
			$('#sem_12_12').attr('checked','checked');
			$('.metrics_dtl_12').show();
		}
	}
	
	function chang_responsible(respon){
		if(respon == 'Y'){
			$('.metrics_dtl').show();
		}else if(respon == 'N'){
			$('.metrics_dtl').hide();
		}
		
	}
$(function(){
	<?php if(@$rs['sem_9'] == '6' || @$rs['sem_9'] == ''){ ?>
			$('.metrics_dtl_9').hide();
	<?php }
	 if(@$rs['sem_12'] == '6' || @$rs['sem_12'] == '9' || @$rs['sem_12'] == ''){ ?>
			$('.metrics_dtl_12').hide();
	<?php } ?>
	
	$('#metrics_start').live('change', function(){
		chang_strat()
	});
	chang_strat();
	
	$(".metrics_cancel").live('change', function () {
			if ($(this).is(':checked')){
				$(".metrics_cancel").removeAttr('checked');
				$(this).attr('checked','checked');
			}
	});
	
	$('[name=metrics_responsible]').live('click',function(){
		chang_responsible($(this).val());
	});
	chang_responsible('<?=@$rs['metrics_responsible']?>');
	
	$('#sem_9_9').live('click',function(){
		$('.metrics_dtl_9').show();
	});
	$('#sem_9_6').live('click',function(){
		$('.metrics_dtl_9').hide();
	});
	
	$("form").validate({
			rules: {
				metrics_on:"required",
				metrics_weight:"required",
				metrics_name:"required",
				mds_set_assessment_id:"required",
				mds_set_measure_id:"required",
				metrics_target:"required",
				metrics_responsible:"required",
				metrics_start:"required"
			},
			messages:{
				metrics_on:"กรุณาระบุตัวชี้วัดที่",
				metrics_weight:"กรุณาระบุน้ำหนักตัวชี้วัด",
				metrics_name:"กรุณาระบุชื่อตัวชี้วัด",
				mds_set_assessment_id:"กรุณาระบุประเด็นการประเมินผล",
				mds_set_measure_id:"กรุณาระบุหน่วยวัด",
				metrics_target:"กรุณาระบุเป้าหมาย",
				metrics_responsible:"กรุณาระบุว่ามีผู้รับผิดชอบ หรือไม่",
				metrics_start:"กรุณาระบุตัวชี้วัดเริ่มที่รอบ"
				
			},
			errorPlacement: function(error, element) 
   			{
			        if (element.attr("name") == "metrics_responsible" )
			          $('#error_responsible').html(error);
			        else if (element.attr("name") == "metrics_weight" )
	         		  $('#error_metrics_weight').html(error);
			        else
			          error.insertAfter(element);
		     }
	});
});
</script>
<h3>ตั้งค่า  มิติและตัวชี้วัด (เพิ่ม / แก้ไข)</h3>
<h5>ตัวชี้วัด</h5>
<form action="<?php echo $urlpage;?>/save_2" method="POST">
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td>
   	<input type="hidden" name="mds_set_indicator_id" name="mds_set_indicator_id" value="<?=@$rs['mds_set_indicator_id']?>" />
   	<input type="hidden" name="parent_id" name="parent_id" value="<?=@$rs['parent_id']?>" />
   	<input type="hidden" name="id" name="id" value="<?=@$rs['id']?>" />
    <input type="text" name="budget_year" id="budget_year" style="width:70px;" value="<?=@$rs_indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td>
    <input type="text" name="indicator_name" id="indicator_name" style="width:500px;" value="มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>ตัวชี้วัดที่<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_on" id="metrics_on" style="width:70px;" value="<?=@$rs['metrics_on']?>" class="numOnly" /></td>
  </tr>
  <tr>
    <th>น้ำหนักตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_weight" id="metrics_weight" style="width:50px;" value="<?=@$rs['metrics_weight']?>" class="numDecimal"  />  (ร้อยละ) <div id="error_metrics_weight"></div></td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_name" id="metrics_name" value="<?=@$rs['metrics_name']?>" style="width:500px;"/></td>
  </tr>
  <tr>
    <th>ประเด็นการประเมินผล<span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_assessment_id',get_option('id','ass_name','mds_set_assessment'),@$rs['mds_set_assessment_id'],'','-- เลือกประเด็นการประเมินผล --') ?></td>
  </tr>
  <tr>
    <th><span style="width:15%">หน่วยวัด</span><span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_measure_id',get_option('id','measure_name','mds_set_measure'),@$rs['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?></td>
  </tr>
  <tr>
    <th><span style="width:5%">เป้าหมาย<span class="Txt_red_12"> *</span><br />
    </span></th>
    <td><input type="text" name="metrics_target" id="metrics_target" style="width:30px;" value="<?=@$rs['metrics_target']?>" class="numOnly" /></td>
  </tr>
  <tr>
    <th>ผู้รับผิดชอบ<span class="Txt_red_12"> *</span></th> 
    <td>
    	<span><input type="radio" name="metrics_responsible" id="metrics_responsible_y" value="Y" <? if(@$rs['metrics_responsible']== 'Y' || @$rs['metrics_responsible'] == ''){ echo 'checked="checked"'; } ?> />      มี</span>
        <span><input type="radio" name="metrics_responsible" id="metrics_responsible_n" value="N" <? if(@$rs['metrics_responsible']== 'N'){ echo 'checked="checked"'; } ?> /> ไม่มี</span>
    	<div id="error_responsible"></div>
    </td>
  </tr>
  <tr>
    <th>ตัวชี้วัดเริ่มที่รอบ <span class="Txt_red_12">*</span></th>
    <? 
    	if(@$rs['metrics_start'] == 6){
    		$selcet_6 = 'selected="selected"';
    	}else if(@$rs['metrics_start'] == 9){
    		$selcet_9 = 'selected="selected"';
    	}else if(@$rs['metrics_start'] == 12){
    		$selcet_12 = 'selected="selected"';
    	}
    ?>
    <td><select name="metrics_start" id="metrics_start">
      <option value="">-- เลือกรอบตัวชี้วัด --</option>
      <option value="6" <?=@$selcet_6?>>เริ่มที่รอบ 6 เดือน</option>
      <option value="9" <?=@$selcet_9?>>เริ่มที่รอบ 9 เดือน</option>
      <option value="12" <?=@$selcet_12?>>เริ่มที่รอบ 12 เดือน</option>
    </select></td>
  </tr>
  <tr>
    <th>ตัวชี้วัดนี้ยกเลิกที่รอบ</th>
    <td>
      <span class="metrics_cancel_6"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" value="6" /> 6 เดือน </span>
      <span class="metrics_cancel_9"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" value="9" /> 9 เดือน </span>
  	  <span class="metrics_cancel_12"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" value="12" /> 12 เดือน </span></td>
  </tr>
</table>

<table class="tbadd metrics_dtl">
<tr class="metrics_6">
<th colspan="2" class="topic">ผู้รับผิดชอบรอบ 6 เดือน</th>
</tr>
<tr class="metrics_6">
<th>น้ำหนักตัวชี้วัดรอบ 6 เดือน<span class="Txt_red_12"> * </span></th>
<td><input type="text" name="metrics_weight_6" id="metrics_weight_6"style="width:50px;" class="numDecimal"  /></td>
</tr>
<tr class="metrics_6">
<th>กพร.<span class="Txt_red_12"> * </span></th>
<td><select name="kpr_6" id="kpr_6">
  <option value="">-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
</select></td>
</tr>
<tr class="metrics_6">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="control_6" id="control_6">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
    </select></td>
</tr>
<tr class="metrics_6">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td><select name="keyer_6" id="keyer_6">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
    </select>
    <input type="text" name="activity_6_name" id="activity_6_name" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" /></td>
</tr>


<tr class="metrics_9">
  <th colspan="2" class="topic">ผู้รับผิดชอบรอบ 9 เดือน</th>
</tr>
<tr class="metrics_9">
<th>น้ำหนักตัวชี้วัดรอบ 9 เดือน<span class="Txt_red_12"> * </span></th>
<td><input type="text" name="metrics_weight_9" id="metrics_weight_9"style="width:50px;" class="numDecimal"  /></td>
</tr>
<tr class="metrics_9">
  <th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
  <td><span class="metrics_6">
    <input type="radio" name="sem_9" id="sem_9_6" value="6" <? if(@$rs['sem_9'] == '6' || @$rs['sem_9']==''){ echo  'checked="checked"'; } ?> />
    กลุ่มเดียวกับ รอบ 6 เดือน  </span> 
  <span>
  <input type="radio" name="sem_9" id="sem_9_9" value="9" <? if(@$rs['sem_9'] == '9'){ echo  'checked="checked"'; } ?> />
  เปลี่ยนกลุ่มรับผิดชอบ</span></td>
</tr>
<tr class="metrics_dtl_9">
  <th>กพร.<span class="Txt_red_12"> * </span></th>
  <td><select name="kpr_9" id="kpr_9">
    <option value="">-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_9">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="control_9" id="control_9">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
    </select></td>
</tr>
<tr class="metrics_dtl_9">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td>
  	<select name="keyer_9" id="keyer_9">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
 	</select>
  </td>
</tr>


<tr class="metrics_12">
  <th colspan="2" class="topic">ผู้รับผิดชอบรอบ 12 เดือน</th>
</tr>
<tr class="metrics_12">
  <th>น้ำหนักตัวชี้วัดรอบ 12 เดือน<span class="Txt_red_12"> * </span></th>
  <td><input type="text" name="metrics_weight_12" id="metrics_weight_12" style="width:50px;" class="numDecimal"  /></td>
</tr>
<tr class="metrics_12">
  <th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
  <td><span class="metrics_6">
    <input type="radio" name="sem_12" id="sem_12_6" value="6" <? if(@$rs['sem_12'] == '6' || @$rs['sem_12']==''){ echo  'checked="checked"'; } ?> />
    กลุ่มเดียวกับ รอบ 6 เดือน</span>
    <span class="metrics_9"><input type="radio" name="sem_12" id="sem_12_9" value="9" <? if(@$rs['sem_12'] == '9'){ echo  'checked="checked"'; } ?> />
กลุ่มเดียวกับ รอบ 9 เดือน</span> <span>
      <input type="radio" name="sem_12" id="sem_12_12" value="12" <? if(@$rs['sem_12'] == '12'){ echo  'checked="checked"'; } ?> />
    เปลี่ยนกลุ่มรับผิดชอบ</span></td>
</tr>
<tr class="metrics_dtl_12">
  <th>กพร.<span class="Txt_red_12"> * </span></th>
  <td><select name="kpr_12" id="kpr_12">
    <option value="">-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_12">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="control_12" id="control_12">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_12">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td><select name="keyer_12" id="keyer_12">
    <option value="">-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
    </select></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>