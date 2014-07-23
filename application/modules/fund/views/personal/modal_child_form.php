<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<base href="<?php echo base_url(); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title><?php echo $template['title']; ?></title>
		<?php require_once('themes/bo/_meta.php')?>
	</head>
	<body>
		<div id="page"><h3>ทะเบียนข้อมูลเด็ก (เพิ่ม / แก้ไข)</h3>

		<form action="fund/personal/form/modal_child_save" method="post" >
			<table class="tbadd">
			  	<tr>
			    	<th>เลขบัตรประชาชน</th>
			    	<td>
			    		<span><label><input type="radio" name="is_idcard" value="1" /> มี</label></span>
			    		<span><label><input type="radio" name="is_idcard" value="0" /> ไม่มี</label></span>
			    		<span>
			    			<label id="label-idcard" ></label>
						</span>
			    		<input type="text" id="idcard" name="idcard" maxlength="13" style="width:150px;" />
					</td>
			  	</tr>
			  	<tr>
			    	<th>ชื่อเด็ก</th>
			    	<td><select name="sex" id="sex">
			      			<option >-- เพศ --</option>
			      			<option value="ชาย" >ชาย</option>
			      			<option value="หญิง" >หญิง</option>
			      			<option value="อื่นๆ" >อื่นๆ</option>
			   			</select>
			    	<input type="text" name="firstname" id="firstname" placeholder="ชื่อ" />
			    	<input type="text" name="lastname" id="lastname" placeholder="นามสกุล" /></td>
			  	</tr>
			  	<tr>
			    	<th>วันเกิด</th>
			    	<td>
			    		<input type="text" class="datepicker" id="birthday" name="birthday" readonly style="width:80px;" />
						อายุ <input type="text" id="personal_age" style="width:50px;" readonly="readonly"/> ปี
					</td>
			  	</tr>
			  	<tr>
			    	<th>ที่อยู่</th>
			    	<td>
			    		เลขที่ <input type="text" name="addr_number" id="addr_number" style="width:50px;"/>
			      		หมู่ที่ <input type="text" name="addr_moo" id="addr_moo" style="width:30px;"/>
			      		ตรอก <input type="text" name="addr_trok" id="addr_trok" style="width:200px;"/><br />
			      		ซอย <input type="text" name="addr_soi" id="addr_soi" style="width:200px;"/>
			      		ถนน <input type="text" name="addr_road" id="addr_road" style="width:200px;"/><br />
			      		จังหวัด <?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",null,"TITLE"),null,"id=\"province_id\"","-- เลือกจังหวัด --",0)?>
			     		อำเภอ <span id="span_amphur" ><select name="amphur_id" id="amphur_id"><option value="0" >-- เลือกอำเภอ --</option></select></span>
			      		ตำบล <span id="span_district"><select name="district_id" id="district_id" ><option value="0" >-- เลือกตำบล --</option></select></span>
			      	</td>
			  	</tr>
			</table>
			
			<div id="btnBoxAdd">
				<button type="submit" class="btn_save" title="บันทึก" ></button>
				<button type="button" class="btn_back" title="ย้อนกลับ" onclick="history.back(-1)" ></button>
			</div>
		
		</form>
		
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
					$("#span_amphur").html('<img src="images/ajax-loader.gif" />');
					$("#span_district").html('<img src="images/ajax-loader.gif" />');
					var province_id = $("#province_id").val();
					var clear_district_id = "<select name='district_id' id='district_id'><option value='0' >-- เลือกตำบล --</option></select>";
					$.get("fund/get_amphur/"+province_id,function(data) {
						$("#span_amphur").html(data);
						$("#span_district").html(clear_district_id);
					})
				})
				
				$("#amphur_id").live("change",function(){
					$("#span_district").html('<img src="images/ajax-loader.gif" />');
					var amphur_id = $("#amphur_id").val();
					$.get("fund/get_district/"+amphur_id,function(data) {
						$("#span_district").html(data)
					})
				})
				
				$("#birthday").click(function(){
					$(this).val("");
				})
		    	
				$("#birthday").change(function(){
		    		var d = new Date();
					var birth_date = $(this).val();
					var age = d.getFullYear()-birth_date.substring(0,4);
					$("#personal_age").val(age);
				})
				
				$("a.child-list").click(function(){
					var value = $(this).attr("data-name");
					var id = $(this).attr("data-id");
					$("#child_name", window.parent.document).val("");
					$("#child_name", window.parent.document).val(value);
					
					$("#child_id", window.parent.document).val("");
					$("#child_id", window.parent.document).val(id);
					parent.$.colorbox.close();
			 	});
				
			});
		</script>
			
		</div> 
		<div id="footer">&nbsp;</div> 
	</body>
</html>
				
