<h4><strong>ผลการพิจารณาของอนุกรรมการพิจารณากลั่นกรองโครงการที่ขอรับการสนับสนุนจากกองทุนคุ้มครองเด็ก</strong></h4>
<form method="post" action="fund/project/project_support_result/save_subform">
<input type="hidden" name="fund_project_support_id" value="<?php echo $id; ?>" />
<input type="hidden" name="result_type" value="<?php echo $type; ?>" />
<table class="tbadd">
    <tr>
      <th>ครั้งที่ / วัน เดือน ปี <span class="Txt_red_12"> *</span></th>
      <td>
      	  <input type="text"  name="time" id="time" class="Number" style="width:50px;" /> / 
      	  <input type="text" class="datepicker" name="date_appoved" readonly style="width:80px;"/>
      	  <span id="error_span_time"></span>
      </td>
    </tr>
    <?php if($type == '3') { ?>
    <tr>
      <th>ผลการพิจารณา <span class="Txt_red_12"> *</span> <div id="error_div_appoved_id"></div></th>
      <td><input type="radio" name="appoved_id" id="appoved_id" value="5" />ส่งเข้าพิจารณาในระบบปกติ (ส่วนกลาง)
       	  <div style="margin-left:30px; margin-top:10px" class="appoved_id_5">
       	  	<select name="sub_appoved_id_5">
	 	  		<option value="">--กรุณาเลือก---</option>
	 	  		<option value="1">เกินกรอบวงเงินระบบกระจาย</option>
	 	  		<option value="2">ขนาดโครงการเกิน 150,000 บาท</option>
	 	  	</select>
       	  </div>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <th><?php if ($type != '3') { ?> ผลการพิจารณา <span class="Txt_red_12"> *</span> <div id="error_div_appoved_id"></div><?php } ?></th>
      <?php if ($type == '1') { ?> 
      		<td><input type="radio" name="appoved_id" id="appoved_id" value="1" />เห็นชอบ</td>
      <?php } else { ?>
			<td><input type="radio" name="appoved_id" id="appoved_id" value="1" />อนุมัติ จำนวนเงิน
				<input name="appoved_budget" type="text" id="appoved_budget" class="Number" style="width:150px;" />บาท จากวงเงินที่เสนอขอ
				<input name="budget" type="text" id="budget" disabled="disabled" style="width:150px;" value="<?php echo number_format(@$budget,2) ?>" /> บาท
				<span id="error_span_appoved_budget"></span>
			</td>
      <?php } ?>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td><input type="radio" name="appoved_id" id="appoved_id" value="2" />
      	  <?php if ($type == '1') { ?> 
      	  			 เห็นชอบในหลักการ 
      	  <?php } else { ?>
      	  			อนุมัติในหลักการ
      	  <?php } ?>
      	   
		  <p style="margin-left:20px;" class="appoved_id_2"><textarea name="note2" cols="" rows="" style="width:500px; height:100px;" placeholder="ระบุข้อสังเกตุของคณะอนุฯ"></textarea></p>
	  </td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td><input type="radio" name="appoved_id" id="appoved_id" value="3" />ขอรายละเอียดเพิ่มเติม 
		  <p style="margin-left:20px;" class="appoved_id_3"><textarea name="note3" cols="" rows="" style="width:500px; height:100px;" placeholder="ระบุ"></textarea></p>
	  </td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td>
      	  <input type="radio" name="appoved_id" id="appoved_id" value="4" />ไม่เห็นชอบ

	 	  <div style="margin-left:20px; margin-top:15px;" class="appoved_id_4">
	 	  	<select name="sub_appoved_id_4">
	 	  		<option value="">--กรุณาเลือก---</option>
	 	  		<option value="1">ไม่สอดคล้องกับวัตถุประสงค์ของกองทุนฯ</option>
	 	  		<option value="2">ซ้ำซ้อนกับภาระกิจองค์กร</option>
	 	  		<option value="3">โครงการไม่ได้แสดงให้เห็นโอกาสแห่งความสำเร็จ</option>
	 	  		<option value="4">อื่นๆ</option>
	 	  	</select>
	 	  	<span style="margin-left: 10px" class="note_4">
	 	  		<input type="text" name="note4" style="width:250px;" placeholder="ระบุ" />
	 	  		<span id="error_span_note4"></span>
	 	  	</span>
		  </div>
	</td>
    </tr>
    </table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Number").bind('keypress', function(e) {
			return ( e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
	    });
	    
		$('.datepicker').datepick({
			showOn: 'both', 
			buttonImageOnly: true, 
			buttonImage: 'js/jquery.datepick/calendar.png'
		});
		
		$(".datepicker").click(function(){
			$(this).val("");
		});
			
		$(".datepick-trigger").click(function(){
			$(this).prev().val("");
		});
		
		appoved_change();
		function appoved_change(){
			var appoved_id = $('[name=appoved_id]:checked').val();
			if(appoved_id == '2'){
				$('.appoved_id_2').show();
				$('.appoved_id_3').hide();
				$('.appoved_id_4').hide();
				$('.appoved_id_5').hide();
			} else if(appoved_id == '3') {
				$('.appoved_id_2').hide();
				$('.appoved_id_3').show();
				$('.appoved_id_4').hide();
				$('.appoved_id_5').hide();
			} else if(appoved_id == '4') {
				$('.appoved_id_2').hide();
				$('.appoved_id_3').hide();
				$('.appoved_id_4').show();
				$('.appoved_id_5').hide();
			} else if(appoved_id == '5') {
				$('.appoved_id_2').hide();
				$('.appoved_id_3').hide();
				$('.appoved_id_4').hide();
				$('.appoved_id_5').show();
			} else {
				$('.appoved_id_2').hide();
				$('.appoved_id_3').hide();
				$('.appoved_id_4').hide();
				$('.appoved_id_5').hide();
			}
		}
		$('[name=appoved_id]').live('change',function(){
			appoved_change();
		});
		
		sub_appoved_change();
		function sub_appoved_change(){
			var sub_appoved_id = $('[name=sub_appoved_id_4]').val();
			if(sub_appoved_id == '4'){
				$('.note_4').show();
			} else {
				$('.note_4').hide();
			}
		}
		$('[name=sub_appoved_id_4]').live('change',function(){
			sub_appoved_change();
		});
		
		$("form").validate({
				rules: {
					time:{required:true, number:true},
					date_appoved:{required:true},
					appoved_id:{required:true},
					note2:{required: function(element) {return $("[name=appoved_id]:checked").val() == '2'} },
					note3:{required: function(element) {return $("[name=appoved_id]:checked").val() == '3'} },
					note4:{required: function(element) {return $("[name=sub_appoved_id_4]").val() == '4'} },
					appoved_budget:{required: function(element) {return $("[name=appoved_id]:checked").val() == '1'} },
					sub_appoved_id_4:{required: function(element) {return $("[name=appoved_id]:checked").val() == '4'} },
					sub_appoved_id_5:{required: function(element) {return $("[name=appoved_id]:checked").val() == '5'} }
				},
				messages:{
					time:{required:"กรุณาระบุ ครั้งที่ / วัน เดือน ปี", number:"กรุณาระบุ ครั้งที่เป็นตัวเลข"},
					date_appoved:{required:"กรุณาระบุ ครั้งที่ / วัน เดือน ปี"},
					appoved_id:{required:"กรุณาระบุ ผลการพิจารณา"},
					note2:{required:"กรุณาระบุ หมายเหตุ"},
					note3:{required:"กรุณาระบุ หมายเหตุ"},
					note4:{required:"กรุณาระบุ หมายเหตุ"},
					appoved_budget:{required:"กรุณาระบุ จำนวนเงินที่อนุมัติ"},
					sub_appoved_id_4:{required:"กรุณาระบุ"},
					sub_appoved_id_5:{required:"กรุณาระบุ"}
				},
				errorPlacement: function(error, element) 
		   		{
					if (element.attr("name") == "time" || element.attr("name") == "date_appoved" ) {
						$('#error_span_time').html(error);
					} else if (element.attr("name") == "appoved_id") {
						$('#error_div_appoved_id').html(error);
					} else if (element.attr("name") == "appoved_budget") {
						$('#error_span_appoved_budget').html(error);
					} else if (element.attr("name") == "note4") {
						$('#error_span_note4').html(error);
					} else {
					   error.insertAfter(element);
					}
				},
			    submitHandler: function(form){
			        form.submit();
			        $('.btn_save').attr('disabled', 'disabled');
	        		//$.colorbox.close();
			    }
			});
	})
</script>