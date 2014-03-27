<script language='javascript'>
$(document).ready(function() {
	function chk_budget(){
		var budget_year = $('[name=budget_year]').val();
		var same_budget_year = $('[name=same_budget_year]').val();
		if(same_budget_year > '0'){
			budget_year = same_budget_year;
		}
				$('.score_dtl').html("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>"); 
			$.get('<?php echo $urlpage;?>/chk_budget_year', { budget_year: budget_year }, function(data){ 
				$('.score_dtl').html(data);
				validate_form(); 
				$('input.numDecimal').number( true, 2 );
			} );
	}
	$('[name=budget_year]').live("change",function(){
		chk_budget();
	});
	$('[name=same_budget_year]').live("change",function(){
		var budget_year = $('[name=budget_year]').val();
		var same_budget_year = $('[name=same_budget_year]').val();
		if(same_budget_year < budget_year){
			chk_budget();
		}else{
			alert('กรุณาเลือกปีให้น้อยกว่าปีงบประมาณที่ต้องการตั้งค่า');
			$('[name=same_budget_year]').val('');
		}
		
	});
	chk_budget();
	function validate_form(){
		$("form").validate({
				rules: {
					budget_year:{required:true,remote:{
							    			url:'<? echo $urlpage; ?>/check_budget_year',
							    			data: { 
							    					budget_year:function(){ return $('[name=budget_year]').val(); },
							    					action_type:function(){ return $('[name=action_type]').val(); }					    					
							    				  }
							    			}
							    },
					val_start_1:"required",
					val_end_1:"required",
					val_start_2:"required",
					val_end_2:"required",
					val_start_3:"required",
					val_end_3:"required",
					val_start_4:"required",
					val_end_4:"required",
					val_start_5:"required",
					val_end_5:"required"	
				},
				messages:{
					budget_year:{required:"กรุณาระบุปีงบประมาน",remote:"ปีงบประมาณนี้มีการตั้งค่าไปแล้ว"},
					val_start_1:"กรุณาระบุคะแนน",
					val_end_1:"กรุณาระบุคะแนน",
					val_start_2:"กรุณาระบุคะแนน",
					val_end_2:"กรุณาระบุคะแนน",
					val_start_3:"กรุณาระบุคะแนน",
					val_end_3:"กรุณาระบุคะแนน",
					val_start_4:"กรุณาระบุคะแนน",
					val_end_4:"กรุณาระบุคะแนน",
					val_start_5:"กรุณาระบุคะแนน",
					val_end_5:"กรุณาระบุคะแนน"
					
				},
				errorPlacement: function(error, element) 
   				{
			        if (element.attr("name") == "val_start_1" || element.attr("name") == "val_end_1")
			          $('#error_1').html(error);
			        else if (element.attr("name") == "val_start_2" || element.attr("name") == "val_end_2")
	         		  $('#error_2').html(error);
	         		else if (element.attr("name") == "val_start_3" || element.attr("name") == "val_end_3")
	         		  $('#error_3').html(error);
	         		else if (element.attr("name") == "val_start_4" || element.attr("name") == "val_end_4")
	         		  $('#error_4').html(error);
	         		else if (element.attr("name") == "val_start_5" || element.attr("name") == "val_end_5")
	         		  $('#error_5').html(error);
			        else
			          error.insertAfter(element);
		      	}
			});
	}
});

</script>
<h3>ตั้งค่า คะแนนผลประเมิน (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<input type="hidden" name="action_type" id="action_type" value="<?=@$action_type?>" />
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('budget_year',get_year_option('2556','1'),@$budget_year,'','-- เลือกปีงบประมาณ --'); ?></td>
</tr>
<?php if(@$budget_year == ''){ ?> 
<tr>
  <th>คะแนนเหมือนปีงบประมาณ </th>
  <td><?php echo form_dropdown('same_budget_year',get_year_option('2556','1'),@$same_budget_year,'','-- เลือกปีงบประมาณ --'); ?></td>
</tr>
<?php } ?>
</table>
<div class="score_dtl"></div>

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" "  class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>