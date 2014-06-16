<h3>ทะเบียนบุคคลขอรับเงินกองทุน (เพิ่ม / แก้ไข)</h3>

<form action="fund/personal/reg_fund/save/<?php echo $value["id"]?>" method="post" >
<table class="tbadd">
	<tr>
		<th>กองทุน <span class="Txt_red_12">*</span></th>
		<td>
			<?php echo form_dropdown("FUND_MST_FUND_NAME_ID",get_option("ID","FUND_NAME","FUND_MST_FUND_NAME",NULL,"FUND_CODE"),@$value["fund_mst_fund_name_id"],"id=\"fund_mst_fund_name\"","-- เลือกกองทุน --",0)?>
		</td>
	</tr>
	<tr>
    	<th>เลขบัตรประชาชน</th>
		<td><input type="text" id="idcard" name="IDCARD" maxlength="13" style="width:150px;" value="<?php echo $value["idcard"]?>" /></td>
	</tr>
	<tr>
		<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
		<td>
			<select name="title" id="title">
				<option <?php if($value["title"]==null) echo "selected"?> >-- คำนำหน้า --</option>
				<option value="นาย" <?php if($value["title"]=="นาย") echo "selected"?> >นาย</option>
				<option value="นางสาว" <?php if($value["title"]=="นางสาว") echo "selected"?> >นางสาว</option>
				<option value="นาง" <?php if($value["title"]=="นาง") echo "selected"?> >นาง</option>
			</select>
			
			<input type="text" name="FIRSTNAME" id="FIRSTNAME" value="<?php echo $value["firstname"]?>" placeholder="ชื่อ" />
			<input type="text" name="LASTNAME" id="LASTNAME" value="<?php echo $value["lastname"]?>" placeholder="นามสกุล"/></td>
	</tr>
	<tr>
    	<th>เพศ <span class="Txt_red_12">*</span></th>
		<td>
			<span><label><input type="radio" name="sex" value="ชาย" <?php if($value["sex"]=="ชาย") echo "checked"?> />ชาย</label></span>
			<span><label><input type="radio" name="sex" value="หญิง" <?php if($value["sex"]=="หญิง") echo "checked"?> />หญิง</label></span>
		</td>
	</tr>
	<tr>
		<th>วันเกิด <span class="Txt_red_12">*</span></th>
		<td>
			<?php
				if($value["birthday"]) {
					$value["age"] = date("Y",strtotime("now")) - date("Y",strtotime($value["birthday"]));
				}
			?>
			<input type="text" class="datepicker" id="birthday" name="birthday" value="<?php echo mysql_to_date($value["birthday"],TRUE)?>" readonly style="width:80px;"/>
			อายุ <input type="text" id="personal_age" style="width:50px;" value="<?php echo $value["age"]?>" readonly="readonly"/> ปี
		</td>
	</tr>
	<tr>
    	<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
		<td>
			เลขที่ <input name="ADDR_NUMBER" type="text" id="ADDR_NUMBER" value="<?php echo $value["addr_number"]?>" style="width:50px;"/>
			หมู่ที่ <input name="ADDR_MOO" type="text" id="ADDR_MOO" value="<?php echo $value["addr_moo"]?>" style="width:30px;"/>
      		ตรอก <input name="ADDR_TROK" type="text" id="ADDR_TROK" value="<?php echo $value["addr_trok"]?>" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="ADDR_SOI" type="text" id="ADDR_SOI" value="<?php echo $value["addr_soi"]?>" style="width:200px;"/>
      		ถนน <input name="ADDR_ROAD" type="text" id="ADDR_ROAD" value="<?php echo $value["addr_road"]?>" style="width:200px;"/>
      		<br />
      		
      		จังหวัด 
			<?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",null,"TITLE"),@$value["province_id"],"id=\"province_id\"","-- เลือกจังหวัด --",0)?>
     		
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
		<td><input name="phone" type="text" id="phone" value="<?php echo $value["phone"]?>" style="width:200px;"/></td>
	</tr>
	<tr>
		<th>ชื่อที่ทำงาน</th>
		<td><input name="office_name" type="text" id="office_name" value="<?php echo $value["office_name"]?>" style="width:200px;"/></td>
	</tr>
	<tr>
    	<th>ที่อยู่ที่ทำงาน</th>
    	<td>
    		เลขที่ <input name="office_addr_number" type="text" id="office_addr_number" value="<?php echo $value["office_addr_number"]?>" style="width:50px;"/>
      		หมู่ที่ <input name="office_addr_moo" type="text" id="office_addr_moo" value="<?php echo $value["office_addr_moo"]?>" style="width:30px;"/>
      		ตรอก <input name="office_addr_trok" type="text" id="office_addr_trok" value="<?php echo $value["office_addr_trok"]?>" style="width:200px;"/>
      		<br />
      		
      		ซอย <input name="office_addr_soi" type="text" id="office_addr_soi" value="<?php echo $value["office_addr_soi"]?>" style="width:200px;"/>
      		ถนน <input name="office_addr_road" type="text" id="office_addr_road" value="<?php echo $value["office_addr_road"]?>" style="width:200px;"/>
      		<br />
      		
      		จังหวัด
			<?php echo form_dropdown("OFFICE_PROVINCE_ID",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$value["office_province_id"],"id=\"office_province_id\"","-- เลือกจังหวัด --",0)?>
     		
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
    <td><input name="OFFICE_PHONE" type="text" id="OFFICE_PHONE" value="<?php echo $value["office_phone"]?>" style="width:200px;"/></td>
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
			var clear_district_id = "<select name='district_id' id='district_id'><option value='0' >-- เลือกตำบล --</option></select>";
			$.get("fund/get_amphur/"+province_id,function(data) {
				$("#span_amphur").html(data);
				$("#span_district").html(clear_district_id);
			})
		})
		
		$("#amphur_id").live("change",function(){
			var amphur_id = $("#amphur_id").val();
			$.get("fund/get_district/"+amphur_id,function(data) {
				$("#span_district").html(data)
			})
		})
		
		<?php if($value["province_id"]):?>
			var is_province_id = <?php echo $value["province_id"]?>;
			$.get("fund/get_amphur/"+is_province_id,function(data) {
				$("#span_amphur").html(data)
				$("#amphur_id option[value=<?php echo $value["amphur_id"]?>]").attr("selected","selected");
			})
			
				<?php if($value["amphur_id"]):?>
				var is_amphur_id = <?php echo $value["amphur_id"]?>;
				$.get("fund/get_district/"+is_amphur_id,function(data) {
					$("#span_district").html(data)
					$("#district_id option[value=<?php echo $value["district_id"]?>]").attr("selected","selected");
				})
				<?php endif?>
		
		<?php endif?>
		
		$("#office_province_id").live("change",function(){
			var province_id = $("#office_province_id").val();
			var clear_district_id = "<select name='office_district_id' id='office_district_id'><option value='0' >-- เลือกตำบล --</option></select>";
			$.get("fund/get_amphur/"+province_id,function(data) {
				$("#span_amphur_office").html(data);
				$("#span_amphur_office select").attr("id","office_amphur_id");
				$("#span_amphur_office select").attr("name","office_amphur_id");
				$("#span_district_office").html(clear_district_id);
			})
		})
		
		$("#office_amphur_id").live("change",function(){
			var amphur_id = $("#office_amphur_id").val();
			$.get("fund/get_district/"+amphur_id,function(data) {
				$("#span_district_office").html(data);
				$("#span_district_office select").attr("id","office_district_id");
				$("#span_district_office select").attr("name","office_district_id");
			})
		})
		
		<?php if($value["office_province_id"]):?>
			var is_office_province_id = <?php echo $value["office_province_id"]?>;
			$.get("fund/get_amphur/"+is_office_province_id,function(data) {
				$("#span_amphur_office").html(data)
				$("#span_amphur_office select").attr("id","office_amphur_id");
				$("#span_amphur_office select").attr("name","office_amphur_id");
				$("#office_amphur_id option[value=<?php echo $value["office_amphur_id"]?>]").attr("selected","selected");
			})
			
				<?php if($value["office_amphur_id"]):?>
				var is_office_amphur_id = <?php echo $value["office_amphur_id"]?>;
				$.get("fund/get_district/"+is_office_amphur_id,function(data) {
					$("#span_district_office").html(data)
					$("#span_district_office select").attr("id","office_district_id");
					$("#span_district_office select").attr("name","office_district_id");
					$("#office_district_id option[value=<?php echo $value["office_district_id"]?>]").attr("selected","selected");
				})
				<?php endif?>
		
		<?php endif?>
		
		$("#birthday").click(function(){
			$(this).val("");
		})
    	
		$("#birthday").change(function(){
    		var d = new Date();
			var birth_date = $(this).val();
			var age = d.getFullYear()-birth_date.substring(0,4);
			$("#personal_age").val(age);
		})
		
	});
</script>