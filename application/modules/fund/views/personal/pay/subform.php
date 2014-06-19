<h3><strong>รายละเอียดการจ่ายเงิน</strong></h3>

<form action="fund/personal/pay/save/<?php echo $value["id"]?>" method="post" >
	
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
					<option>-- เลือกสถานะการจ่ายเงิน --</option>
					<option value="1">จ่ายเงินไปแล้ว</option>
					<option value="2">ยุติการช่วยเหลือ</option>
				</select>
				<span class="note">* กรณีเลือกยุติการช่วยเหลือ ให้กรอกเฉพาะหมายเหตุ</span></td>
		</tr>
	</table>    
	
	<div class="boxStop" style="display:none">
		<table class="tbadd">
			<tr>
				<th>หมายเหตุ<span class="Txt_red_12"> *</span></th>
				<td><textarea name="note" cols="" rows="" style="width:500px;" placeholder="หมายเหตุการยุติการช่วยเหลือ"></textarea></td>
			</tr>
		</table> 
	</div>
	
	<div class="boxPaid">
		<table class="tbadd">
			<tr>
				<th> วัน เดือน ปี ที่จ่ายเงิน<span class="Txt_red_12"> *</span></th>
				<td><input type="text" class="datepicker" name="date_payment" readonly style="width:80px;" /></td>
			</tr>
		    <tr>
				<th>ผู้รับเงิน<span class="Txt_red_12"> *</span></th>
				<td>
					<span><label><input type="radio" name="personal_accept" id="personal_accept" value="0" <?php if($value["personal_accept"]==0 || $value["personal_accept"]==null) echo "checked" ?> />เป็นบุคคลเดียวกันกับผู้ขอ</label></span>
					<span><label><input type="radio" name="personal_accept" id="personal_accept" value="1" <?php if($value["personal_accept"]==1) echo "checked" ?> />ไม่ใช่บุคคลเดียวกันกับผู้ขอ</label></span>
		        	<span class="note">* กรณีเลือกเป็นบุคคลเดียวกัน ข้อมูลจะแสดงขึ้นโดยอัตโนมัติ</span>
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
			    	<input type="text" name="lastname" id="lastname" value="<?php echo $person["lastname"]?>" readonly placeholder="นามสกุล"/></td>
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
				<td><input type="file" name="fileField2" id="fileField2" /></td>
		    </tr>
		    <tr>
				<th>สำเนาบัตรประชาชนผู้รับมอบ</th>
				<td><input type="file" name="fileField2" id="fileField3" /></td>
		    </tr>
		    <tr>
				<th>ใบมอบฉันทะ</th>
				<td><input type="file" name="fileField2" id="fileField4" /></td>
		    </tr>
		    <tr>
				<th>ใบเสร็จการจ่ายเงิน</th>
				<td><input type="file" name="fileField" id="fileField" /></td>
		    </tr>
		</table>
	</div>
		
	<div id="btnBoxAdd">
		<input type="hidden" name="fund_request_support_id" value="<?php echo $value["fund_request_support_id"]?>" />
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

		
		$("#status").live("change",function(){
			var status_id = $(this).val();
			
			if(status_id==1) {
         		$(".boxPaid").show();
				$(".boxStop").hide();
			} else {
				$(".boxPaid").hide();
				$(".boxStop").show();
			}
			
		});
		
		$("#personal_accept").live("change",function(){
			var accept_value = $(this).val();
			var reg_id = <?php echo $value["fund_reg_personal_id"]?>;
			
			if(accept_value==0) {
        		$('#unlike_personal').html('<tr><th colspan="2" style="text-align: center;" >กำลังโหลด....<br /><img src="images/ajax-loader.gif" /></th></tr>');
				$.post("fund/personal/pay/getpersonal/"+reg_id, function(data){
					$("#unlike_personal").html(data);
				})
			} else {
        		$('#unlike_personal').html('<tr><th colspan="2" style="text-align: center;" >กำลังโหลด....<br /><img src="images/ajax-loader.gif" /></th></tr>');
				$.post("fund/personal/pay/getblank", function(data){
					$("#unlike_personal").html(data);
				})
			}
			
		})
		
	})
</script>