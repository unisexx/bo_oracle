<h3>ทะเบียนบุคคลขอรับเงินกองทุน (เพิ่ม / แก้ไข)</h3>

<form action="fund/personal/reg_fund/save/<?php echo $value["id"]?>" method="post" >
<table class="tbadd">
	<tr>
		<th>กองทุน <span class="Txt_red_12">*</span></th>
		<td>
			<?php echo form_dropdown("FUND_MST_FUND_NAME_ID",get_option("ID","FUND_NAME","FUND_MST_FUND_NAME",NULL,"FUND_CODE"),@$value->FUND_MST_FUND_NAME_ID,"id=\"fund_mst_fund_name\"","-- เลือกกองทุน --",0)?>
		</td>
	</tr>
	<tr>
    	<th>เลขบัตรประชาชน</th>
		<td><input type="text" id="textfield5" name="IDCARD" maxlength="13" style="width:150px;" /></td>
	</tr>
	<tr>
		<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
		<td>
			<select name="select3" id="select3">
				<option>-- คำนำหน้า --</option>
			</select>
			
			<input type="text" name="FIRSTNAME" id="FIRSTNAME" placeholder="ชื่อ" />
			<input type="text" name="LASTNAME" id="LASTNAME" placeholder="นามสกุล"/></td>
	</tr>
	<tr>
    	<th>เพศ <span class="Txt_red_12">*</span></th>
		<td>
			<span><label><input type="radio" />ชาย</label></span>
			<span><label><input type="radio" />หญิง</label></span>
			<span>
		</td>
	</tr>
	<tr>
		<th>วันเกิด <span class="Txt_red_12">*</span></th>
		<td>
			<input type="text" class="datepicker" id="BIRTHDAY" name="BIRTHDAY" date style="width:70px;"/>
			อายุ <input type="text" id="personal_age" style="width:50px;" readonly="readonly"/> ปี
		</td>
	</tr>
	<tr>
    	<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
		<td>
			เลขที่ <input name="ADDR_NUMBER" type="text" id="ADDR_NUMBER" style="width:50px;"/>
			หมู่ที่ <input name="ADDR_MOO" type="text" id="ADDR_MOO" style="width:30px;"/>
      		ตรอก <input name="ADDR_TROK" type="text" id="ADDR_TROK" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="ADDR_SOI" type="text" id="ADDR_SOI" style="width:200px;"/>
      		ถนน <input name="ADDR_ROAD" type="text" id="ADDR_ROAD" style="width:200px;"/>
      		<br />
      		
      		จังหวัด 
			<?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$value->PROVINCE_CODE,"id=\"province_id\"","-- เลือกจังหวัด --",0)?>
     		
      		อำเภอ
      		<span id="span_amphur">
				<select name="amphur_id" id="amphur_id" >
					<option value="0" >-- เลือกอำเภอ --</option>
				</select>
			</span>
			
			ตำบล
      		<span id="span_district">
				<select name="district_id" id="district_id" >
					<option value="0" >-- เลือกตำบล --</option>
				</select>
			</span>
			
		</td>
	</tr>
	<tr>
		<th>โทรศัพท์ <span class="Txt_red_12">*</span></th>
		<td><input name="PHONE" type="text" id="textfield4" style="width:200px;"/></td>
	</tr>
	<tr>
		<th>ชื่อที่ทำงาน</th>
		<td><input name="OFFICE_NAME" type="text" id="OFFICE_NAME" style="width:200px;"/></td>
	</tr>
	<tr>
    	<th>ที่อยู่ที่ทำงาน</th>
    	<td>
    		เลขที่ <input name="OFFICE_ADDR_NUMBER" type="text" id="OFFICE_ADDR_NUMBER" style="width:50px;"/>
      		หมู่ที่ <input name="OFFICE_ADDR_MOO" type="text" id="OFFICE_ADDR_MOO" style="width:30px;"/>
      		ตรอก <input name="OFFICE_ADDR_TROK" type="text" id="OFFICE_ADDR_TROK" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="OFFICE_ADDR_SOI" type="text" id="OFFICE_ADDR_SOI" style="width:200px;"/>
      		ถนน <input name="OFFICE_ADDR_ROAD" type="text" id="OFFICE_ADDR_ROAD" style="width:200px;"/>
      		<br />
      		
      		จังหวัด
			<?php echo form_dropdown("OFFICE_PROVINCE_ID",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$value->PROVINCE_CODE,"id=\"office_province_id\"","-- เลือกจังหวัด --",0)?>
     		
      		อำเภอ
      		<span id="span_amphur_office">
				<select name="OFFICE_AMPHUR_ID" id="office_amphur_id" >
					<option value="0" >-- เลือกอำเภอ --</option>
				</select>
			</span>
			
			ตำบล
      		<span id="span_district_office">
				<select name="OFFICE_DISTRICT_ID" id="office_district_id" >
					<option value="0" >-- เลือกตำบล --</option>
				</select>
			</span>
  </tr>
  <tr>
    <th>โทรศัพท์ที่ทำงาน</th>
    <td><input name="OFFICE_PHONE" type="text" id="OFFICE_PHONE" style="width:200px;"/></td>
  </tr>
</table>
			
<div id="btnBoxAdd">
	<button type="submit" class="btn_save" title="บันทึก" ></button>
	<button type="button" class="btn_back" title="ย้อนกลับ" onclick="history.back(-1)" ></button>
</div>
</form>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("#province_id").live("change",function(){
			var province_id = $("#province_id").val();
			$.get("fund/get_amphur/"+province_id,function(data) {
				$("#span_amphur").html(data)
			})
		})
		
		$("#amphur_id").live("change",function(){
			var amphur_id = $("#amphur_id").val();
			$.get("fund/get_district/"+amphur_id,function(data) {
				$("#span_district").html(data)
			})
		})
		
		$("#office_province_id").live("change",function(){
			var province_id = $("#office_province_id").val();
			$.get("fund/get_amphur/"+province_id,function(data) {
				$("#span_amphur_office").html(data)
			})
		})
		
		$("#office_amphur_id").live("change",function(){
			var amphur_id = $("#amphur_id").val();
			$.get("fund/get_district/"+amphur_id,function(data) {
				$("#span_district_office").html(data)
			})
		})
    	
		$("#birth_date").change(function(){
    		var d = new Date();
			var birth_date = $(this).val();
			var age = d.getFullYear()-birth_date.substring(0,4);
			$("#personal_age").val(age);
		})
		
	});
</script>