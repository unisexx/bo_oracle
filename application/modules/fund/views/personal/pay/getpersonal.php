<tr>
	<th>ชื่อ - สกุล <span class="Txt_red_12">*</span></th>
	<td>
		<select name="title" id="title" disabled >
			<option <?php if($value["title"]==null) echo "selected"?> >-- คำนำหน้า --</option>
			<option value="นาย" <?php if($value["title"]=="นาย") echo "selected"?> >นาย</option>
			<option value="นางสาว" <?php if($value["title"]=="นางสาว") echo "selected"?> >นางสาว</option>
			<option value="นาง" <?php if($value["title"]=="นาง") echo "selected"?> >นาง</option>
		</select>
    	
		<input type="text" name="firstname" id="firstname" value="<?php echo $value["firstname"]?>" disabled placeholder="ชื่อ" />
    	<input type="text" name="lastname" id="lastname" value="<?php echo $value["lastname"]?>" disabled placeholder="นามสกุล"/></td>
</tr>
<tr>
	<th>ที่อยู่ <span class="Txt_red_12">*</span></th>
	<td>
		เลขที่ <input name="addr_number" type="text" id="addr_number" value="<?php echo $value["addr_number"]?>" disabled style="width:50px;"/>
    	หมู่ที่ <input name="addr_moo" type="text" id="addr_moo" value="<?php echo $value["addr_moo"]?>" disabled style="width:30px;"/>
    	ตรอก <input name="addr_trok" type="text" id="addr_trok" value="<?php echo $value["addr_trok"]?>" disabled style="width:200px;"/>
    	<br />
    	
    	ซอย <input name="addr_soi" type="text" id="addr_soi" value="<?php echo $value["addr_soi"]?>" disabled style="width:200px;"/>
   		ถนน <input name="addr_road" type="text" id="addr_road" value="<?php echo $value["addr_road"]?>" disabled style="width:200px;"/>
    	<br />
    	
    	<?php
			$district = $this->district->get_row($value["district_id"]);
			$amphur = $this->amphur->get_row($value["amphur_id"]);
			$province = $this->province->get_row($value["province_id"]);
    	?>
    	
    	จังหวัด
      		<span id="span_province">
				<select name="province_id" id="province_id" disabled >
					<option value="<?php echo $value["province_id"]?>" ><?php echo $province["title"]?></option>
				</select>
			</span>
     			
    	อำเภอ
      		<span id="span_amphur">
				<select name="amphur_id" id="amphur_id" disabled >
					<option value="<?php echo $value["amphur_id"]?>" ><?php echo $amphur["title"]?></option>
				</select>
			</span>
			
    	ตำบล
      		<span id="span_district">
				<select name="district_id" id="district_id" disabled >
					<option value="<?php echo $value["district_id"]?>" ><?php echo $district["title"]?></option>
				</select>
			</span>
			
	</td>
</tr>