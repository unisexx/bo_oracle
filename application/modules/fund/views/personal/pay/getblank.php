<tr>
	<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
	<td>
		<select name="title" id="title" >
			<option >-- คำนำหน้า --</option>
			<option value="นาย" >นาย</option>
			<option value="นางสาว" >นางสาว</option>
			<option value="นาง" >นาง</option>
		</select>
    	
		<input type="text" name="firstname" id="firstname" placeholder="ชื่อ" />
    	<input type="text" name="lastname" id="lastname" placeholder="นามสกุล"/></td>
</tr>
<tr>
	<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
	<td>
		เลขที่ <input name="addr_number" type="text" id="addr_number" style="width:50px;"/>
    	หมู่ที่ <input name="addr_moo" type="text" id="addr_moo" style="width:30px;"/>
    	ตรอก <input name="addr_trok" type="text" id="addr_trok" style="width:200px;"/>
    	<br />
    	
    	ซอย <input name="addr_soi" type="text" id="addr_soi" style="width:200px;"/>
   		ถนน <input name="addr_road" type="text" id="addr_road" style="width:200px;"/>
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

<script type="text/javascript">
		
		$("#province_id").live("change",function(){
			$('#span_amphur').html('<img src="images/ajax-loader.gif" />');
			$('#span_district').html('<img src="images/ajax-loader.gif" />');
			
			var province_id = $("#province_id").val();
			var clear_district_id = "<select name='district_id' id='district_id'><option value='0' >-- เลือกตำบล --</option></select>";
			$.get("fund/get_amphur/"+province_id,function(data) {
				$("#span_amphur").html(data);
				$("#span_district").html(clear_district_id);
			})
		})
		
		$("#amphur_id").live("change",function(){
			$('#span_district').html('<img src="images/ajax-loader.gif" />');
				
			var amphur_id = $("#amphur_id").val();
			$.get("fund/get_district/"+amphur_id,function(data) {
				$("#span_district").html(data)
			})
		})
</script>