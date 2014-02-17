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
			
			$('.metrics_dtl_6').show();
			<?php if(@$rs['sem_9'] != '9'){ ?>
				$('.metrics_dtl_9').hide();
				$('#sem_9_6').attr('checked','checked');
			<? } ?>
			<?php if(@$rs['sem_12'] != '12'){ ?>
				$('.metrics_dtl_12').hide();
				$('#sem_12_6').attr('checked','checked');
			<? } ?>
			
		}else if($('#metrics_start').val() == 9){
			$('.metrics_cancel_6').hide();
			$('.metrics_cancel_9').show();
			$('.metrics_cancel_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').show();
			$('.metrics_12').show();
			
			$('.metrics_dtl_6').hide();
			$('.metrics_dtl_9').show();
			$('#sem_9_9').attr('checked','checked');
			<?php if(@$rs['sem_12'] != '12'){ ?>
				$('.metrics_dtl_12').hide();
				$('#sem_12_9').attr('checked','checked');
			<? } ?>
			
		}else if($('#metrics_start').val() == 12){
			$('.metrics_cancel_6').hide();
			$('.metrics_cancel_9').hide();
			$('.metrics_cancel_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').hide();
			$('.metrics_12').show();
			
			$('.metrics_dtl_6').hide();
			$('.metrics_dtl_9').hide();
			$('.metrics_dtl_12').show();
			$('#sem_12_12').attr('checked','checked');
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
	
	$('#metrics_on').live('keyup',function(){
		var metrics_on =  $('#metrics_on').val();
		if( metrics_on > '<?=@$max_mrtrics_on?>'){
			$('#metrics_on').val('<?=@$max_mrtrics_on?>');
		}
	});
	
	$('#metrics_start').live('change', function(){
		chang_strat()
	});
	chang_strat();
	
			<?php if(@$rs['sem_9'] == '9'){ ?>
					$('.metrics_dtl_9').show();
			<?php }
			 if(@$rs['sem_12'] == '12'){ ?>
					$('.metrics_dtl_12').show();
			<?php } ?>
			
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
	$('[name=sem_9]').live('click',function(){
		if($(this).val()=='9'){
			$('.metrics_dtl_9').show();
		}else{
			$('.metrics_dtl_9').hide();
		}
	});
	
	$('[name=sem_12]').live('click',function(){
		//alert(55);
		if($(this).val()=='12'){
			$('.metrics_dtl_12').show();
		}else{
			$('.metrics_dtl_12').hide();
		}
	});
	
	$('.bt_add_keyer').click(function(){
	var ref_m = $(this).attr('ref_m');
	var num = $('#keyer_num_'+ref_m).val();
	var i =  parseInt(num)+parseInt(1);
		$('.bt_add_keyer').attr('disabled', 'disabled');
		$("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>").appendTo(".loading-icon_"+ref_m);
		$.get('<? echo site_url(); ?>mds_set_indicator/add_keyer',
		{ month:ref_m , num:i },
			function(data){
				$(".loading").remove();
				$('#keyer_div_'+ref_m).before(data);
		 		$('#keyer_num_'+ref_m).val(i);	
		 		$('.bt_add_keyer').removeAttr('disabled');
		 		$("[name='keyer_"+ref_m+"["+i+"]']").rules( 'add', {required: function(element) {
	        						       							  return $("#metrics_start").val() == '6';}
											           , messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
											           	});
				if(ref_m == 9){
					
					$("[name='keyer_"+ref_m+"["+i+"]']").rules( 'add', {required: function(element) {
	        						       											 return ($("[name=sem_9]:checked").val() == '9' || $("#metrics_start").val() <= '9');}
											           						, messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
											           						});
				}
				if(ref_m == 12){
					
					
					$("[name='keyer_"+ref_m+"["+i+"]']").rules( 'add', {required: function(element) {
	        						       											 return ($("#metrics_start").val() <= parseInt('12') || $("[name=sem_12]:checked").val() == parseInt('12'));}
											           						, messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
											           						});
					//alert($("[name=sem_12]:checked").val());
				}			
				validate_form();
				
		});		 
	});
	$('.bt_remove_keyer').live("click",function(){
		//alert(55);
		var i = $(this).attr("ref");
		var m = $(this).attr("ref_m");
		$("#keyer_div_"+m+"_"+i).remove();
	});
	function validate_form(){
		$("form").validate({
				rules: {
					metrics_on:{ required:true,
								 max: <?=@$max_mrtrics_on?>
								},
					metrics_weight:"required",
					metrics_name:"required",
					mds_set_assessment_id:"required",
					mds_set_measure_id:"required",
					metrics_target:"required",
					metrics_responsible:"required",
					metrics_start:{ required : function(element) {
	        						   return $("[name=metrics_responsible]:checked").val() == 'Y';}
	        			  },
					kpr_6:{ required : function(element) {
	        						   return $("#metrics_start").val() == '6';}
	        			  },
	        		control_6:{ required : function(element) {
	        						       return $("#metrics_start").val() == '6';}
	        				 },
	        		kpr_9:{ required : function(element) {
	        						   return $("#metrics_start").val() == '9';}
	        			  },
	        		control_9:{ required : function(element) {
	        						       return $("#metrics_start").val() == '9';}
	        				 },
	        		kpr_9:{ required : function(element) {
	        						   return $("[name=sem_9]:checked").val() == '9';}
	        			  },
	        		control_9:{ required : function(element) {
	        						       return $("[name=sem_9]:checked").val() == '9';}
	        				 },
	        		kpr_12:{ required : function(element) {
	        						   return $("#metrics_start").val() == '12';}
	        			  },
	        		control_12:{ required : function(element) {
	        						       return $("#metrics_start").val() == '12';}
	        				 },
	        		kpr_12:{ required : function(element) {
	        						   return $("[name=sem_12]:checked").val() == '12';}
	        			  },
	        		control_12:{ required : function(element) {
	        						       return $("[name=sem_12]:checked").val() == '12';}
	        				  }
	        						   
				},
				messages:{
					metrics_on:{required:"กรุณาระบุตัวชี้วัดที่", max:"ลำดับที่ใส่ได้มากที่สุด คือ  <?=@$max_mrtrics_on?> " },
					metrics_weight:"กรุณาระบุน้ำหนักตัวชี้วัด",
					metrics_name:"กรุณาระบุชื่อตัวชี้วัด",
					mds_set_assessment_id:"กรุณาระบุประเด็นการประเมินผล",
					mds_set_measure_id:"กรุณาระบุหน่วยวัด",
					metrics_target:"กรุณาระบุเป้าหมาย",
					metrics_responsible:"กรุณาระบุว่ามีผู้รับผิดชอบ หรือไม่",
					metrics_start:"กรุณาระบุตัวชี้วัดเริ่มที่รอบ",
					kpr_6:"กรุณาเลือก กพร. ",
					control_6:"กรุณาเลือก ผู้กำกับดูแลตัวชี้วัด",
					kpr_9:"กรุณาเลือก กพร. ",
					control_9:"กรุณาเลือก ผู้กำกับดูแลตัวชี้วัด",
					kpr_12:"กรุณาเลือก กพร. ",
					control_12:"กรุณาเลือก ผู้กำกับดูแลตัวชี้วัด"
					
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
	}
	validate_form();
});
</script>
<h3>ตั้งค่า  มิติและตัวชี้วัด (เพิ่ม / แก้ไข)</h3>
<h5>ตัวชี้วัด</h5>
<form action="<?php echo $urlpage;?>/save_2" id="Myform" method="POST">
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
  <? if(@$parent_on != ''){ ?>
  <tr>
    <th>ลำดับตัวชี้วัดหลัก<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="parent_on" id="parent_on" style="width:70px;" readonly="readonly" value="<?=@$parent_on?>" class="numOnly" /></td>
  </tr>
  <tr>
    <th>ลำดับตัวชี้วัดย่อยที่<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_on" id="metrics_on" style="width:70px;" value="<?=@$rs['metrics_on']?>" class="numOnly" <? if(@$rs['id'] != ''){ echo "readonly='readonly'" ;} ?> /></td>
  </tr>
  <? }else{ ?>
  <tr>
    <th>ตัวชี้วัดที่<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_on" id="metrics_on" style="width:70px;" value="<?=@$rs['metrics_on']?>" class="numOnly" <? if(@$rs['id'] != ''){ echo "readonly='readonly'" ;} ?> /></td>
  </tr>
  <? } ?>
  <tr>
    <th>น้ำหนักตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_weight" id="metrics_weight" style="width:50px;" value="<?=@$rs['metrics_weight']?>" class="numDecimal"  />  (ร้อยละ) <div id="error_metrics_weight"></div></td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="metrics_name" id="metrics_name" value="<?=@$rs['metrics_name']?>" style="width:500px;"/></td>
  </tr>
  <? if(@$rs['parent_id'] == '0'){ ?>
  <tr>
    <th>ประเด็นการประเมินผล<span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_assessment_id',get_option('id','ass_name','mds_set_assessment'),@$rs['mds_set_assessment_id'],'','-- เลือกประเด็นการประเมินผล --') ?></td>
  </tr>
  <? }else{ ?>
  	<input type="hidden" name="mds_set_assessment_id" value="<?=@$mds_set_assessment_id?>" />
  <? } ?>
  <tr>
    <th><span style="width:15%">หน่วยวัด</span><span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_measure_id',get_option('id','measure_name','mds_set_measure'),@$rs['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?></td>
  </tr>
  <tr>
    <th><span style="width:5%">เป้าหมาย<span class="Txt_red_12"> *</span><br />
    </span></th>
    <td><input type="text" name="metrics_target" id="metrics_target" style="width:30px;" value="<?=@$rs['metrics_target']?>" class="numOnly" /></td>
  </tr>
  <? 
  	$sql_result = "select * from mds_metrics_result where mds_set_metrics_id = '".@$rs['id']."' ";
  	$chk_result = $this->metrics_result->get($sql_result);
	$num_chk_result = count($chk_result);
  ?>
  <tr>
    <th>ผู้รับผิดชอบ<span class="Txt_red_12"> *</span></th> 
    <td>
    	<? if($num_chk_result > 0){?>
    		<input type="hidden" name="metrics_responsible" value="<?=@$rs['metrics_responsible']?>" />
    		
    	<?  if(@$rs['metrics_responsible']== 'Y'){
    		 	echo "มี";
    		}else{
    			echo "ไม่มี";
    		}
		  }else{ ?>
    	<span><input type="radio" name="metrics_responsible" id="metrics_responsible_y" value="Y" <? if(@$rs['metrics_responsible']== 'Y' || @$rs['metrics_responsible'] == ''){ echo 'checked="checked"'; } ?> />      มี</span>
        <span><input type="radio" name="metrics_responsible" id="metrics_responsible_n" value="N" <? if(@$rs['metrics_responsible']== 'N'){ echo 'checked="checked"'; } ?> /> ไม่มี</span>
    	<div id="error_responsible"></div>
        <? } ?>
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
    <td>
    <? if($num_chk_result > 0){ ?> 
    	<input type="hidden" name="metrics_start" id="metrics_start" value="<?=@$rs['metrics_start']?>" />
    <?	echo "เริ่มที่รอบ ".@$rs['metrics_start']." เดือน";
      }else{ ?>
      <select name="metrics_start" id="metrics_start">
	      <option value="">-- เลือกรอบตัวชี้วัด --</option>
	      <option value="6" <?=@$selcet_6?>>เริ่มที่รอบ 6 เดือน</option>
	      <option value="9" <?=@$selcet_9?>>เริ่มที่รอบ 9 เดือน</option>
	      <option value="12" <?=@$selcet_12?>>เริ่มที่รอบ 12 เดือน</option>
   	  </select>
   	  <? } ?>
    </td>
  </tr>
  <tr>
    <th>ตัวชี้วัดนี้ยกเลิกที่รอบ</th>
    <td>
      <span class="metrics_cancel_6"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" <? if(@$rs['metrics_cancel']== '6'){ echo 'checked="checked"'; } ?> value="6" /> 6 เดือน </span>
      <span class="metrics_cancel_9"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" value="9" <? if(@$rs['metrics_cancel']== '9'){ echo 'checked="checked"'; } ?> /> 9 เดือน </span>
  	  <span class="metrics_cancel_12"><input type="checkbox" name="metrics_cancel" id="metrics_cancel" class="metrics_cancel" value="12" <? if(@$rs['metrics_cancel']== '12'){ echo 'checked="checked"'; } ?> /> 12 เดือน </span></td>
  </tr>
</table>

<table class="tbadd metrics_dtl">
<?php 
$month = 6;
for ($i=1; $i <= 3; $i++) {
	 
?>
	
<tr class="metrics_<?=$month?>">
<th colspan="2" class="topic">ผู้รับผิดชอบรอบ <?=$month?> เดือน</th>
</tr>
<tr class="metrics_<?=$month?>">
<th>น้ำหนักตัวชี้วัดรอบ <?=$month?> เดือน</th>
<td><input type="text" name="metrics_weight_<?=$month?>" id="metrics_weight_<?=$month?>"style="width:50px;" class="numDecimal" value="<?=@$rs['metrics_weight_'.$month]?>" /></td>
</tr>
<?php 
	$sql_result_round = "select * from mds_metrics_result where mds_set_metrics_id = '".@$rs['id']."' and round_month = '".$month."' ";
  	$chk_result_round = $this->metrics_result->get($sql_result_round);
	$num_chk_round = count($chk_result_round);
	if($month == '9'){ ?>
	<th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
	<td>
	<? if($num_chk_round == 0 && $month == '9'){ ?>  
	  	<span class="metrics_6">
	    <input type="radio" name="sem_9" id="sem_9_6" value="6" <? if(@$rs['sem_9'] == '6' || @$rs['sem_9']==''){ echo  'checked="checked"'; } ?> />
	    กลุ่มเดียวกับ รอบ 6 เดือน  </span> 
	  <span>
	  <input type="radio" name="sem_9" id="sem_9_9" value="9" <? if(@$rs['sem_9'] == '9'){ echo  'checked="checked"'; } ?> />
	  เปลี่ยนกลุ่มรับผิดชอบ</span>
	 <? }else{?>
	 	<input type="hidden" name="sem_9" value="<?=@$rs['sem_9']?>" />
	 	<?
		 	if(@$rs['sem_9'] == '6'){
		 		echo "กลุ่มเดียวกับ รอบ 6 เดือน";
		 	}else if(@$rs['sem_9'] == '9'){
		 		echo "เปลี่ยนกลุ่มรับผิดชอบ";
			}
	 	} ?>
	</td>
	</tr>
<? }else if($month == '12'){ ?>
	<tr class="metrics_12">
	  <th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
	  <td>
	  	<? if($num_chk_round == 0 && $month == '12'){ ?>
	  	<span class="metrics_6">
	    <input type="radio" name="sem_12" id="sem_12_6" value="6" <? if(@$rs['sem_12'] == '6' || @$rs['sem_12']==''){ echo  'checked="checked"'; } ?> />
	    	กลุ่มเดียวกับ รอบ 6 เดือน</span>
	    <span class="metrics_9"><input type="radio" name="sem_12" id="sem_12_9" value="9" <? if(@$rs['sem_12'] == '9'){ echo  'checked="checked"'; } ?> />
		กลุ่มเดียวกับ รอบ 9 เดือน</span> <span>
	    <input type="radio" name="sem_12" id="sem_12_12" value="12" <? if(@$rs['sem_12'] == '12'){ echo  'checked="checked"'; } ?> />
	   	 เปลี่ยนกลุ่มรับผิดชอบ</span>
	   	 <? }else{ ?>
	   	 	<input type="hidden" name="sem_12" value="<?=@$rs['sem_12']?>" />
	   	 <?
	   	 		if(@$rs['sem_12'] == '6'){
		 			echo "กลุ่มเดียวกับ รอบ 6 เดือน";
			 	}else if(@$rs['sem_12'] == '9'){
			 		echo "กลุ่มเดียวกับ รอบ 9 เดือน";
				}else if(@$rs['sem_12'] == '12'){
					echo "เปลี่ยนกลุ่มรับผิดชอบ";
				}
	   	 } ?>
	  </td>
	</tr>
<? } ?>

<?php 
	$sql_kpr[$month] = "select * from mds_set_metrics_kpr where mds_set_metrics_id = '".@$rs['id']."' AND round_month = '".@$month."' ";
	$result_kpr = $this->kpr->get($sql_kpr[$month]);
	$kpr[$month] = @$result_kpr['0'];
	
	$sql_keyer[$month] = "select * from mds_set_metrics_keyer where mds_set_metrics_id = '".@$rs['id']."' AND round_month = '".@$month."' order by id asc ";
	$result_keyer[$month] = $this->keyer->get($sql_keyer[$month]);
	
?>
<?if($num_chk_round == 0){// ตรวจสอบว่ามีการบันทึกข้อมูลแล้วหรือยัง ?>
<tr class="metrics_dtl_<?=$month?>">
<th>กพร.<span class="Txt_red_12"> * </span></th>
<td>
<input type="hidden" name="kpr_id_<?=$month?>" id="kpr_id_<?=$month?>" value="<?=@$kpr[$month]['id']?>" />
<?php echo form_dropdown("kpr_$month",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 1'),@$kpr[$month]['kpr_users_id'],'','-- กำหนดผู้รับผิดชอบ (กพร.) --') ?>
</td>
</tr>
<tr class="metrics_dtl_<?=$month?>">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td>
    <?php echo form_dropdown("control_$month",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 2'),@$kpr[$month]['control_users_id'],'','-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --') ?>
   </td>
</tr>
<tr class="metrics_dtl_<?=$month?>">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td>
  	<div style="width: 780px;text-align: right;"><input type="button" class="bt_add_keyer" style="width: 150px" ref_m="<?=$month?>" value=" เพิ่มผู้จัดเก็บข้อมูล " /></div>
  	<? 
  		@$num_keyer = 1;
		if(@$rs['id'] != ''){
		@$num_keyer = 0;
		foreach ($result_keyer[$month] as $key => $keyer) {
		$num_keyer++;			
  	?>	
  		<div id="keyer_div_<?=$month?>_<?=@$num_keyer?>">
	    <?php echo form_dropdown("keyer_".$month."[".$num_keyer."]",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 3'),@$keyer['keyer_users_id'],'','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
	    <input type="text" name="activity_<?=$month?>[<?=$num_keyer?>]" id="activity_<?=$month?>[<?=$num_keyer?>]" style="width:500px;" value="<?=@$keyer['activity']?>" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
	 	<input type="button" class="bt_remove_keyer" style="width: 50px" ref_m="<?=@$month?>" ref="<?=@$num_keyer?>" value=" ลบ " />
	 	<samp id="error_keyer"></samp>
	 	</div>
	 	 	
  <? 	}
		}else{ ?>
  		<div id="keyer_div_<?=$month?>_<?=@$num_keyer?>">
	    <?php echo form_dropdown("keyer_".$month."[".$num_keyer."]",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 3'),@$keyer['keyer_users_id'],'','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
	    <input type="text" name="activity_<?=$month?>[<?=$num_keyer?>]" id="activity_<?=$month?>[<?=$num_keyer?>]" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
	 	<input type="button" class="bt_remove_keyer" style="width: 50px" ref_m="<?=@$month?>" ref="<?=@$num_keyer?>" value=" ลบ " />
	 	<samp id="error_keyer"></samp>
	 	</div>
  	<? } ?>
  
  		<div id="keyer_div_<?=$month?>"></div>
	 	<span class="loading-icon_<?=$month?>"></span>
  		<input type="hidden" name="keyer_num_<?=$month?>" id="keyer_num_<?=@$month?>" value="<?=@$num_keyer?>" />
  		<script language="JavaScript">
  		$(function(){
  			for (var i=1; i <= '<?=@$num_keyer?>'; i++) {
  					
					$("[name='keyer_<?=$month?>["+i+"]']").rules( 'add', {required: function(element) {
		        						       											 return $("#metrics_start").val() <= parseInt('<?=$month?>');}
												           						, messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
												           						});
					
					if(i == 9){
						$("[name='keyer_<?=$month?>["+i+"]']").rules( 'add', {required: function(element) {
		        						       											 return $("[name=sem_9]:checked").val() == '9';}
												           						, messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
												           						});
					}
					if(i == 12){
						$("[name='keyer_<?=$month?>["+i+"]']").rules( 'add', {required: function(element) {
		        						       											 return $("[name=sem_12]:checked").val() == '12';}
												           						, messages: {required: "กรุณาเลือก ผู้จัดเก็บข้อมูล" }
												           						});
					
				  }
			  }
		});
  		</script>
 </td>
</tr>
<? }else{?>
	
	<tr><th>กพร.<span class="Txt_red_12"> * </span></th>
	<td>
		<input type="hidden" name="kpr_id_<?=$month?>" id="kpr_id_<?=$month?>" value="<?=@$kpr[$month]['id']?>" />
		<input type="hidden" name="kpr_<?=$month?>" value="<?=@$kpr[$month]['kpr_users_id']?>" />
	<?echo get_one("name","users","id",@$kpr[$month]['kpr_users_id']); ?>
	</td></tr>
	<tr><th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
	<td>
		<input type="hidden" name="control_<?=$month?>" value="<?=@$kpr[$month]['control_users_id']?>" />
	<?echo get_one("name","users","id",@$kpr[$month]['control_users_id']); ?>
	</td></tr>
	<tr><th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
		<td>
	<? 	@$num_keyer =0;
		foreach ($result_keyer[$month] as $key => $keyer) {
			$num_keyer++;
		echo "<div><div style='display: inline-block;width: 300px;'>";
		echo  get_one("name","users","id",@$keyer['keyer_users_id'])."</div>";
		echo  " กิจกรรม ".(empty($keyer['activity'])?" - ":$keyer['activity']);
		echo "</div>";
		?>
		<input type="hidden" name="keyer_<?=$month?>[<?=$num_keyer?>]" value="<?=@$keyer['keyer_users_id']?>" />
		<input type="hidden" name="activity_<?=$month?>[<?=$num_keyer?>]" value="<?=@$keyer['activity']?>" />
	   <?} ?>
	   <input type="hidden" name="keyer_num_<?=$month?>" id="keyer_num_<?=@$month?>" value="<?=@$num_keyer?>" />
	   </td>
	</tr>
<?  } ?>
<? $month = $month+3; } ?>

</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>