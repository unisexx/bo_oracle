<h3>ทะเบียนข้อมูลเด็ก (เพิ่ม / แก้ไข)</h3>

<?php echo form_open('fund/personal/reg_child/save/'.$value["id"]); ?>
<table class="tbadd">
  	<tr>
    	<th>เลขบัตรประชาชน</th>
    	<td>
    		<span><label><input type="radio" name="is_idcard" value="1" <?php if($value["is_idcard"]==1) echo "checked"?> /> มี</label></span>
    		<span><label><input type="radio" name="is_idcard" value="0" <?php if($value["is_idcard"]==0) echo "checked"?> /> ไม่มี</label></span>
    		<span>
    			<label id="label-idcard" >
    				<?php
    					if($value["is_idcard"]==1) {
    						echo null;
    					} else {
    						echo "หมายเลขบัตรอื่นๆ";
    					}
    				?>
    			</label>
			</span>
    		<input type="text" id="idcard" name="idcard" maxlength="13" value="<?php echo $value["idcard"]?>" style="width:150px;" />
		</td>
  	</tr>
  	<tr>
    	<th>ชื่อเด็ก</th>
    	<td><select name="sex" id="sex">
      			<option >-- เพศ --</option>
      			<option value="ชาย" <?php if($value["sex"]=="ชาย") echo "selected"?> >ชาย</option>
      			<option value="หญิง" <?php if($value["sex"]=="หญิง") echo "selected"?> >หญิง</option>
      			<option value="อื่นๆ" <?php if($value["sex"]=="อื่นๆ") echo "selected"?> >อื่นๆ</option>
   			</select>
    	<input type="text" name="firstname" id="firstname" placeholder="ชื่อ" value="<?php echo $value["firstname"]?>" />
    	<input type="text" name="lastname" id="lastname" placeholder="นามสกุล" value="<?php echo $value["lastname"]?>" /></td>
  	</tr>
  	<tr>
    	<th>วันเกิด</th>
    	<td>
			<?php
				if($value["birthday"]) {
					$value["age"] = date("Y",strtotime("now")) - date("Y",strtotime($value["birthday"]));
				}
			?>
    		<input type="text" class="datepicker" id="birthday" name="birthday" value="<?php echo mysql_to_date($value["birthday"],TRUE)?>" readonly style="width:80px;" />
			อายุ <input type="text" id="personal_age" style="width:50px;" value="<?php echo $value["age"]?>" readonly="readonly"/> ปี
		</td>
  	</tr>
  	<tr>
    	<th>ที่อยู่</th>
    	<td>
    		เลขที่ <input type="text" name="addr_number" id="addr_number" value="<?php echo $value["addr_number"]?>" style="width:50px;"/>
      		หมู่ที่ <input type="text" name="addr_moo" id="addr_moo" value="<?php echo $value["addr_moo"]?>" style="width:30px;"/>
      		ตรอก <input type="text" name="addr_trok" id="addr_trok" value="<?php echo $value["addr_trok"]?>" style="width:200px;"/><br />
      		ซอย <input type="text" name="addr_soi" id="addr_soi" value="<?php echo $value["addr_soi"]?>" style="width:200px;"/>
      		ถนน <input type="text" name="addr_road" id="addr_road" value="<?php echo $value["addr_road"]?>" style="width:200px;"/><br />
      		จังหวัด <?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",null,"TITLE"),@$value["province_id"],"id=\"province_id\"","-- เลือกจังหวัด --",0)?>
     		อำเภอ <span id="span_amphur" ><select name="amphur_id" id="amphur_id"><option value="0" >-- เลือกอำเภอ --</option></select></span>
      		ตำบล <span id="span_district"><select name="district_id" id="district_id" ><option value="0" >-- เลือกตำบล --</option></select></span>
      	</td>
  	</tr>
</table>

<div id="btnBoxAdd">
	<button type="submit" class="btn_save" title="บันทึก" ></button>
	<button type="button" class="btn_back" title="ย้อนกลับ" onclick="history.back(-1)" ></button>
</div>


<?php echo form_close(); ?>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("input[name=is_idcard]").click(function(){
			var value = $(this).val();
			if(value==1) {
				$("#label-idcard").html("")
			} else {
				var textLabel = "หมายเลขบัตรอื่นๆ";
				$("#label-idcard").html(textLabel)
			}
		})
		
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
