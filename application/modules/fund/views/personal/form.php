<h3>แบบฟอร์มขอรับเงินสนับสนุน รายบุคคล (เพิ่ม / แก้ไข)</h3>
<form action="fund/personal/form/save" method="post" >
<table class="tbadd">
	<tr>
		<th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
		<td>กองทุนคุ้มครองเด็ก
		    <select name="year_budget" id="select">
				<option>2557</option>
				<option>2556</option>
		    </select>
	    </td>
	</tr>
	<tr>
		<th>จังหวัด <span class="Txt_red_12">*</span></th>
		<td>
			<?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$value["province_id"],"id=\"province_id\"","-- เลือกจังหวัด --",null)?>
		</td>
	</tr>
	<tr>
		<th>วันเดือนปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
		<td>
			<input type="text" id="date_request" class="datepicker" name="date_request" readonly style="width:80px;" />
			<span id="error_span_date_request"></span>
		</td>
	</tr>
	<tr>
		<th>ข้อมูลเด็ก <span class="Txt_red_12">*</span></th>
		<td>
			<input type="text" name="child_name" id="child_name" readonly style="width:350px;" />
			<a href="fund/personal/form/modal_child" class="example7" ><img src="images/see.png" width="24" height="24" /></a>
			<span id="error_span_child_name"></span>
		</td>
	</tr>
	<tr>
		<th>ประเภทขอรับการช่วยเหลือ</th>
		<td>
			<span><label><input type="radio" name="request_type" id="radio" value="1" />เด็กและครอบครัว</label></span>
			<span><label><input type="radio" name="request_type" id="radio2" value="2" /> ครอบครัวอุปถัมภ์</label></span>
		</td>
	</tr>
	<tr>
		<th>สภาพปัญหาความเดือดร้อนโดยสรุป</th>
		<td><textarea name="abstract" id="textarea3" style="width:500px; height:80px;"></textarea></td>
	</tr>
	<tr>
		<th>ข้อมูลผู้ขอ <span class="Txt_red_12">*</span></th>
		<td>
			<input type="text" name="personal_name" id="personal_name" readonly style="width:350px;" />
			<a href="fund/personal/form/modal_request" class="example7" ><img src="images/see.png" width="24" height="24" /></a>
			<span id="error_span_personal_name"></span>
		</td>
	</tr>
	<tr>
		<th>ความเกี่ยวข้องกับเด็ก</th>
		<td>
			<span><label><input type="radio" name="relation_type" id="radio3" value="1" /> บิดา/มารดา</label></span>
	    	<span><label><input type="radio" name="relation_type" id="radio4" value="2" />ญาติ</label></span>
			<span><label><input type="radio" name="relation_type" id="radio4" value="3" />ผู้ดูแล/ผู้อุปถัมภ์</label></span>
			<span><label><input type="radio" name="relation_type" id="radio4" value="4" />คนรู้จัก</label></span>
		</td>
	</tr>
</table>

<div id="btnBoxAdd">
	<input type="hidden" id="child_id" name="child_id" value="<?php echo @$value["fund_child_id"]?>" />
	<input type="hidden" id="personal_id" name="personal_id" value="<?php echo @$value["fund_reg_personal_id"]?>" />
	<button type="submit" class="btn_save" title="บันทึก" ></button>
</div>

</form>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("#date_request").click(function(){
			$(this).val("");
		})
		
		$("form").validate({
			rules: {
				year_budget:{required:true},
				province_id:{required:true},
				date_request:{required:true},
				child_name:{required:true},
				personal_name:{required:true}
			},
			messages:{
				year_budget:{required:"กรุณาระบุ ปีงบประมาณ"},
				province_id:{required:"กรุณาระบุ จังหวัด"},
				date_request:{required:"กรุณาระบุ จังหวัด"},
				child_name:{required:"กรุณาระบุ ข้อมูลเด็ก"},
				personal_name:{required:"กรุณาระบุ ข้อมูลผู้ขอ"}
			},
			errorPlacement: function(error, element) 
	   		{
				if (element.attr("name") == "date_request" ) {
					$('#error_span_date_request').html(error);
				} else if (element.attr("name") == "child_name") {
					$('#error_span_child_name').html(error);
				} else if (element.attr("name") == "personal_name") {
					$('#error_span_personal_name').html(error);
				} else {
				   error.insertAfter(element);
				}
			}
		});
	});
</script>