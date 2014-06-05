<h3>ทะเบียนบุคคลขอรับเงินกองทุน (เพิ่ม / แก้ไข)</h3>

<table class="tbadd">
	<tr>
		<th>กองทุน <span class="Txt_red_12">*</span></th>
		<td>
			<select name="select4" id="select">
				<option selected="selected">-- เลือกกองทุน --</option>
				<option>กองทุนคุ้มครองเด็ก</option>
				<option>กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
				<option>กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
			</select>
		</td>
	</tr>
	<tr>
    	<th>เลขบัตรประชาชน</th>
		<td><input name="textfield5" type="text" id="textfield5" style="width:150px;" maxlength="13"/></td>
	</tr>
	<tr>
		<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
		<td>
			<select name="select3" id="select3">
				<option>-- คำนำหน้า --</option>
			</select>
			
			<input type="text" name="textfield" id="textfield" placeholder="ชื่อ" />
			<input type="text" name="textfield2" id="textfield2" placeholder="นามสกุล"/></td>
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
			<input type="text" class="datepicker" id="birth_date" name="BIRTH_DATE" date style="width:70px;"/>
			อายุ <input type="text" id="personal_age" style="width:50px;" readonly="readonly"/> ปี
		</td>
	</tr>
	<tr>
    	<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
		<td>
			เลขที่ <input name="textfield8" type="text" id="textfield8" style="width:50px;"/>
			หมู่ที่ <input name="textfield9" type="text" id="textfield9" style="width:30px;"/>
      		ตรอก <input name="textfield10" type="text" id="textfield10" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="textfield3" type="text" id="textfield3" style="width:200px;"/>
      		ถนน <input name="textfield11" type="text" id="textfield11" style="width:200px;"/>
      		<br />
      		
      		จังหวัด 
			<?php echo form_dropdown("PROVINCE_CODE",get_option("ID","TITLE","CNF_PROVINCE",NULL,"TITLE"),@$value->PROVINCE_CODE,"id=\"province_code\"","-- เลือกจังหวัด --",0)?>
     		
      		อำเภอ
			<select name="AMPOR_CODE" id="ampor_code" >
				<option value="0" >-- เลือกอำเภอ --</option>
			</select>
			
			ตำบล
			<select name="AMPOR_CODE" id="tumbon_code" >
				<option value="0" >-- เลือกตำบล --</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>โทรศัพท์ <span class="Txt_red_12">*</span></th>
		<td><input name="textfield4" type="text" id="textfield4" style="width:200px;"/></td>
	</tr>
	<tr>
		<th>ชื่อที่ทำงาน</th>
		<td><input name="textfield14" type="text" id="textfield23" style="width:200px;"/></td>
	</tr>
	<tr>
    	<th>ที่อยู่ที่ทำงาน</th>
    	<td>
    		เลขที่ <input name="textfield7" type="text" id="textfield17" style="width:50px;"/>
      		หมู่ที่ <input name="textfield7" type="text" id="textfield18" style="width:30px;"/>
      		ตรอก <input name="textfield7" type="text" id="textfield19" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="textfield7" type="text" id="textfield20" style="width:200px;"/>
      		ถนน <input name="textfield7" type="text" id="textfield21" style="width:200px;"/>
      		<br />
      		
      		จังหวัด
			<?php echo form_dropdown("PROVINCE_CODE",get_option("ID","TITLE","CNF_PROVINCE",NULL,"TITLE"),@$value->PROVINCE_CODE,"id=\"province_code_office\"","-- เลือกจังหวัด --",0)?>
			
			อำเภอ
			<select name="AMPOR_CODE" id="ampor_code_office" >
				<option value="0" >-- เลือกอำเภอ --</option>
			</select>
			<?php //echo form_dropdown("AMPOR_CODE",get_option("AMPOR_CODE","AMPOR_NAME","ACT_AMPOR",NULL,"AMPOR_NAME"),@$value->AMPOR_CODE,"id=\"ampor_code\"","-- เลือกอำเภอ --",0)?>
		      
			ตำบล
			<select name="AMPOR_CODE" id="tumbon_code_office" >
				<option value="0" >-- เลือกตำบล --</option>
			</select>
			<?php //echo form_dropdown("TUMBON_CODE",get_option("TUMBON_CODE","TUMBON_NAME","ACT_TUMBON",NULL,"TUMBON_NAME"),@$value->TUMBON_CODE,"id=\"tumbon_code\"","-- เลือกตำบล --",0)?>
  </tr>
  <tr>
    <th>โทรศัพท์ที่ทำงาน</th>
    <td><input name="textfield15" type="text" id="textfield24" style="width:200px;"/></td>
  </tr>
</table>
			
<div id="btnBoxAdd">
	<button type="submit" class="btn_save" title="บันทึก" ></button>
	<button type="button" class="btn_back" title="ย้อนกลับ" onclick="history.back(-1)" ></button>
</div>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("#province_code").change(function(){
			var province_id = $(this).val();
			$.get("fund/province/"+province_id,
				function(data) {
					$("#ampor_code").html(data)
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