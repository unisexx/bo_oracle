<h3><strong>รายละเอียดการจ่ายเงิน</strong></h3>

<form>
	
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
				<select name="status" id="select">
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
				<td><input type="text" class="datepicker" name="date" value="" style="width:80px;" /></td>
			</tr>
		    <tr>
				<th>ผู้รับเงิน<span class="Txt_red_12"> *</span></th>
				<td>
					<span><label><input type="radio" name="personal_accept" id="radio" value="0" <?php if($value["personal_accept"]==0) echo "checked" ?> />เป็นบุคคลเดียวกันกับผู้ขอ</label></span>
					<span><label><input type="radio" name="personal_accept" id="radio" value="1" <?php if($value["personal_accept"]==1) echo "checked" ?> />ไม่ใช่บุคคลเดียวกันกับผู้ขอ</label></span>
		        	<span class="note">* กรณีเลือกเป็นบุคคลเดียวกัน ข้อมูลจะแสดงขึ้นโดยอัตโนมัติ</span>
				</td>
			</tr>
		    <tr>
				<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
				<td>
					<select name="title" id="select3">
						<option>-- คำนำหน้า --</option>
		        	</select>
		        	
					<input type="text" name="textfield" id="textfield" value="<?php echo $value["firstname"]?>" placeholder="ชื่อ" />
		        	<input type="text" name="textfield" id="textfield" value="<?php echo $value["lastname"]?>" placeholder="นามสกุล"/></td>
		    </tr>
		    <tr>
				<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
				<td>
					เลขที่ <input name="addr_number" type="text" id="addr_number" value="<?php echo $value["addr_number"]?>" style="width:50px;"/>
		        	หมู่ที่ <input name="addr_moo" type="text" id="addr_moo" value="<?php echo $value["addr_moo"]?>" style="width:30px;"/>
		        	ตรอก <input name="addr_trok" type="text" id="addr_trok" value="<?php echo $value["addr_trok"]?>" style="width:200px;"/>
		        	<br />
		        	
		        	ซอย <input name="addr_soi" type="text" id="addr_soi" value="<?php echo $value["addr_soi"]?>" style="width:200px;"/>
		       		ถนน <input name="addr_road" type="text" id="addr_road" value="<?php echo $value["addr_road"]?>" style="width:200px;"/>
		        	<br />
		        	
		        	จังหวัด
		        		<select name="select5" id="select4">
		          		</select>
		          		
		        	อำเภอ
						<select name="select5" id="select5">
		          		</select>
		        	ตำบล
		        	
						<select name="select5" id="select6">
						</select>
				</td>
		    </tr>
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
		<button type="submit" class="btn_save" title="บันทึก" ></button>
	</div>
	
</form>