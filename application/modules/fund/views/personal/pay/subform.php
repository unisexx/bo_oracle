<h3><strong>รายละเอียดการจ่ายเงิน</strong></h3>
<form action="fund/personal/pay/save/<?php echo $value["id"]?>" method="post" enctype="multipart/form-data" >
	
	<?php
		switch ($value["payment_type"]) {
			case 1:
				$msg = "<span>ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ</span>";
				$msg .= "ครั้งที่ <span>".$value["fund_month_number"]."</span>";
				$msg .= "เดือน <span>".month_th($value["fund_month"])."</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 2:
				$msg = "<span>ข้อ 4(2) ค่าใช้จ่ายทางการศึกษา</span>";
				$msg .= "ปีที่ <span>".$value["fund_year_number"]."</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 3:
				$msg = "<span>ข้อ 4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 4:
				$msg = "<span>ข้อ 4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 5:
				$msg = "<span>ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค</span>";
				$msg .= "ครั้งที่ <span>".$value["fund_month_number"]."</span>";
				$msg .= "เดือน <span>".month_th($value["fund_month"])."</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 6:
				$msg = "<span>ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์</span>";
				$msg .= "ครั้งที่ <span>".$value["fund_month_number"]."</span>";
				$msg .= "เดือน <span>".month_th($value["fund_month"])."</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			case 7:
				$msg = "<span>ข้อ 4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
			default:
				$msg = "<span>(พิเศษ) ค่าตรวจ DNA</span>";
				$msg .= "จำนวน <span>".number_format($value["fund_cost"])."</span> บาท";
				break;
				
			
		}
	?>
	
	<div class="topicDetail">
		<?php echo $msg?>
	</div>
	
	<table class="tbadd">
		<tr>
			<th>สถานะ<span class="Txt_red_12"> *</span></th>
			<td>
				<select name="status" id="status">
					<option value="">-- เลือกสถานะการจ่ายเงิน --</option>
					<option value="1" <?php if($value["status"]==1) echo "selected"?> >จ่ายเงินไปแล้ว</option>
					<option value="2" <?php if($value["status"]==2) echo "selected"?> >ยุติการช่วยเหลือ</option>
				</select>
				<span class="note">* กรณีเลือกยุติการช่วยเหลือ ให้กรอกเฉพาะหมายเหตุ</span>
			</td>
		</tr>
	</table>    
	
	<div class="boxStop" style="display:none">
		<table class="tbadd">
			<tr>
				<th>หมายเหตุ<span class="Txt_red_12"> *</span></th>
				<td>
					<textarea name="note" cols="" rows="" style="width:500px;" placeholder="หมายเหตุการยุติการช่วยเหลือ" ><?php echo $value["note"]?></textarea>
					<span id="error_span_note"></span>
				</td>
			</tr>
		</table> 
	</div>
	
	<div class="boxPaid">
		<table class="tbadd">
			<tr>
				<th> วัน เดือน ปี ที่จ่ายเงิน<span class="Txt_red_12"> *</span></th>
				<td>
					<input type="text" class="datepicker" name="date_payment" readonly style="width:80px;" value="<?php echo mysql_to_date($value["date_payment"],true) ?>" />
					<span id="error_span_date_payment"></span>
				</td>
			</tr>
		    <tr>
				<th>ผู้รับเงิน<span class="Txt_red_12"> *</span></th>
				<td>
					<span><label><input type="radio" name="personal_accept" id="personal_accept" value="0" <?php if($value["personal_accept"]==0 || $value["personal_accept"]==null) echo "checked" ?> />เป็นบุคคลเดียวกันกับผู้ขอ</label></span>
					<span><label><input type="radio" name="personal_accept" id="personal_accept" value="1" <?php if($value["personal_accept"]==1) echo "checked" ?> />ไม่ใช่บุคคลเดียวกันกับผู้ขอ</label></span>
		        	<span class="note">* กรณีเลือกเป็นบุคคลเดียวกัน ข้อมูลจะแสดงขึ้นโดยอัตโนมัติ</span>
					<div id="error_div_personal_accept"></div>
				</td>
			</tr>

			<tbody id="unlike_personal" >
		    <tr>
				<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
				<td>
					<select name="title" id="title" readonly >
						<option <?php if($person["title"]==null) echo "selected"?> >-- คำนำหน้า --</option>
						<option value="นาย" <?php if($person["title"]=="นาย") echo "selected"?> >นาย</option>
						<option value="นางสาว" <?php if($person["title"]=="นางสาว") echo "selected"?> >นางสาว</option>
						<option value="นาง" <?php if($person["title"]=="นาง") echo "selected"?> >นาง</option>
					</select>
			    	
					<input type="text" name="firstname" id="firstname" value="<?php echo $person["firstname"]?>" readonly placeholder="ชื่อ" />
			    	<input type="text" name="lastname" id="lastname" value="<?php echo $person["lastname"]?>" readonly placeholder="นามสกุล"/>
			    </td>
			</tr>
			<tr>
				<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
				<td>
					เลขที่ <input name="addr_number" type="text" id="addr_number" value="<?php echo $person["addr_number"]?>" readonly style="width:50px;"/>
			    	หมู่ที่ <input name="addr_moo" type="text" id="addr_moo" value="<?php echo $person["addr_moo"]?>" readonly style="width:30px;"/>
			    	ตรอก <input name="addr_trok" type="text" id="addr_trok" value="<?php echo $person["addr_trok"]?>" readonly style="width:200px;"/>
			    	<br />
			    	
			    	ซอย <input name="addr_soi" type="text" id="addr_soi" value="<?php echo $person["addr_soi"]?>" readonly style="width:200px;"/>
			   		ถนน <input name="addr_road" type="text" id="addr_road" value="<?php echo $person["addr_road"]?>" readonly style="width:200px;"/>
			    	<br />
			    	
			    	<?php
						$district = $this->district->get_row($person["district_id"]);
						$amphur = $this->amphur->get_row($person["amphur_id"]);
						$province = $this->province->get_row($person["province_id"]);
			    	?>
			    	
			    	จังหวัด
			      		<span id="span_province">
							<select name="province_id" id="province_id" readonly >
								<option value="<?php echo $person["province_id"]?>" ><?php echo $province["title"]?></option>
							</select>
						</span>
			     			
			    	อำเภอ
			      		<span id="span_amphur">
							<select name="amphur_id" id="amphur_id" readonly >
								<option value="<?php echo $person["amphur_id"]?>" ><?php echo $amphur["title"]?></option>
							</select>
						</span>
						
			    	ตำบล
			      		<span id="span_district">
							<select name="district_id" id="district_id" readonly >
								<option value="<?php echo $person["district_id"]?>" ><?php echo $district["title"]?></option>
							</select>
						</span>
				</td>
			</tr>
		    </tbody>
		    
		    <tr>
				<th>สำเนาบัตรประชาชนผู้มอบ</th>
				<td><input type="file" name="file_payer" id="fileField2" accept="application/pdf,application/jpeg" /></td>
		    </tr>
		    <tr>
				<th>สำเนาบัตรประชาชนผู้รับมอบ</th>
				<td><input type="file" name="file_payee" id="fileField3" accept="application/pdf,application/jpeg" /></td>
		    </tr>
		    <tr>
				<th>ใบมอบฉันทะ</th>
				<td><input type="file" name="file_proxy" id="fileField4" accept="application/pdf,application/jpeg" /></td>
		    </tr>
		    <tr>
				<th>ใบเสร็จการจ่ายเงิน</th>
				<td><input type="file" name="file_receipt" id="fileField" accept="application/pdf,application/jpg" /></td>
		    </tr>
		</table>
	</div>
		
	<div id="btnBoxAdd">
		<input type="hidden" name="fund_request_support_id" value="<?php echo $value["fund_request_support_id"]?>" />
		<input type="hidden" name="payment_type" value="<?php echo $value["payment_type"]?>" />
		<button type="submit" class="btn_save" title="บันทึก" ></button>
	</div>
	
</form>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('.datepicker').datepick({
			showOn: 'both', 
			buttonImageOnly: true, 
			buttonImage: 'js/jquery.datepick/calendar.png'
		});
		<?php if($value["status"]==2):?>
			$(".boxPaid").hide();
			$(".boxStop").show();
		<?php elseif($value["status"]=='0'):?>
			$(".boxPaid").hide();
			$(".boxStop").hide();
		<?php else:?>
			$(".boxPaid").show();
			$(".boxStop").hide();
		<?php endif?>
		
		$("#status").live("change",function(){
			var status_id = $(this).val();
			
			if(status_id==1) {
         		$(".boxPaid").show();
				$(".boxStop").hide();
			} else if (status_id == 2) {
				$(".boxPaid").hide();
				$(".boxStop").show();
			} else {
				$(".boxPaid").hide();
				$(".boxStop").hide();
			}
			
		});
		
		function form_validate() {
			$("form").validate({
				rules: {
					status:{required:true},
					note:{required: function(element) {return $("[name=status]").val() == '2'} },
					date_payment:{required: function(element) {return $("[name=status]").val() == '1'} },
					personal_accept:{required: function(element) {return $("[name=status]").val() == '1'} },
					title:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					firstname:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					lastname:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					addr_number:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					addr_moo:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					addr_trok:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					addr_soi:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					addr_road:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					province_id:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					amphur_id:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					district_id:{required: function(element) {return $("[name=personal_accept]:checked").val() == '1'} },
					file_payer:{accept: "pdf|jpg"},
					file_payee:{accept: "pdf|jpg"},
					file_proxy:{accept: "pdf|jpg"},
					file_receipt:{accept: "pdf|jpg"},
				},
				messages:{
					status:{required:"กรุณาระบุ สถานะ"},
					note:{required:"กรุณาระบุ หมายเหตุ"},
					date_payment:{required:"กรุณาระบุ วัน เดือน ปี ที่จ่ายเงิน"},
					personal_accept:{required:"กรุณาระบุ ผู้รับเงิน"},
					title:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					firstname:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					lastname:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					addr_number:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					addr_moo:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					addr_trok:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					addr_soi:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					addr_road:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					province_id:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					amphur_id:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					district_id:{required:"กรุณาระบุ ชื่อ - สกุล ให้ครบถ้วน"},
					file_payer:{accept:"อัพโหลดได้เฉพาะไฟล์ .pdf, .jpg"},
					file_payee:{accept:"อัพโหลดได้เฉพาะไฟล์ .doc, .docx"},
					file_proxy:{accept:"อัพโหลดได้เฉพาะไฟล์ .pdf, .jpg"},
					file_receipt:{accept:"อัพโหลดได้เฉพาะไฟล์ .doc, .docx"},
				},
				errorPlacement: function(error, element) 
		   		{
					if (element.attr("name") == "date_payment" ) {
						$('#error_span_date_payment').html(error);
					} else if (element.attr("name") == "note") {
						$('#error_span_note').html(error);
					} else if (element.attr("name") == "personal_accept") {
						$('#error_div_personal_accept').html(error);
					} else if (element.attr("name") == "title" || element.attr("name") == "firstname" || element.attr("name") == "lastname") {
						$('#error_span_name').html(error);
					} else if (
								element.attr("name") == "addr_number" || element.attr("name") == "addr_moo" || element.attr("name") == "addr_trok" ||
								element.attr("name") == "addr_soi" || element.attr("name") == "addr_road" || element.attr("name") == "province_id" ||
							  	element.attr("name") == "amphur_id" || element.attr("name") == "district_id"
							  ) {
						$('#error_span_addr').html(error);
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
		}
		form_validate();
		$("#personal_accept").live("change",function(){
			$("#unlike_personal").html("");
			var accept_value = $(this).val();
			var reg_id = '<?php echo $value["fund_reg_personal_id"]?>';
			$("[name=personal_accept]").attr('disabled', 'disabled');
			
			if(accept_value==0) {
				$("#unlike_personal").html("");
        		$('#unlike_personal').html('<tr><th colspan="2" style="text-align: center;" >กำลังโหลด....<br /><img src="images/ajax-loader.gif" /></th></tr>');
				$.post("fund/personal/pay/getpersonal/"+reg_id, function(data){
					$("#unlike_personal").html(data);
					$("[name=personal_accept]").removeAttr('disabled');
					form_validate();
				})
			} else {
				$("#unlike_personal").html("");
        		$('#unlike_personal').html('<tr><th colspan="2" style="text-align: center;" >กำลังโหลด....<br /><img src="images/ajax-loader.gif" /></th></tr>');
				$.post("fund/personal/pay/getblank", function(data){
					$("#unlike_personal").html(data);
					$("[name=personal_accept]").removeAttr('disabled');
					form_validate();
				})
			}
			
		})
		
		$(".datepicker").click(function(){
			$(this).val("");
		})
			
		$(".datepick-trigger").click(function(){
			$(this).prev().val("");
		})
		
	})
</script>