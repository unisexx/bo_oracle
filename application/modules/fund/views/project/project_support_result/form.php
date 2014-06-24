<script type="text/javascript">
	$(document).ready(function(){
		/*
		$('[name=project_status]').change(function(){
			$('[name=project_status_]').val($(this).val());
		});
		
		$('[name=project_type]').change(function(){
			$('[name=project_type_]').val($(this).val());
		});
		
		$('[name=project_framework]').change(function(){
			$('[name=project_framework_]').val($(this).val());
		});
		
		$('[name=budget_request]').change(function(){
			$('[name=budget_request_]').val($(this).val());
		});
		
		$('[name=budget_cause]').change(function(){
			$('[name=budget_cause_]').val($(this).val());
		});
		
		$('[name=organiztion_type]').change(function(){
			$('[name=organiztion_type_]').val($(this).val());
		});
		
			$("form").validate({
				rules: {
					receive_date:{required:true},
					budget_year:{required:true},
					province_id:{required:true},
					project_name:{required:true},
					organization:{required:true},
					project_status_:{required:true},
					project_type_:{required:true},
					project_framework_:{required:true},
					budget_request_:{required:true},
					budget_cause_:{required:true},
					organiztion_type_:{required:true}
				},
				messages:{
					receive_date:{required:"กรุณาระบุข้อมูล"},
					budget_year:{required:"กรุณาระบุข้อมูล"},
					province_id:{required:"กรุณาระบุข้อมูล"},
					project_name:{required:"กรุณาระบุข้อมูล"},
					organization:{required:"กรุณาระบุข้อมูล"},
					project_status_:{required:"กรุณาเลือกข้อมูลก่อนการบันทึก"},
					project_type_:{required:"กรุณาเลือกข้อมูลก่อนการบันทึก"},
					project_framework_:{required:"กรุณาระบุข้อมูล"},
					budget_request_:{required:"กรุณาระบุงบประมาณที่ขอสนับสนุน"},
					budget_cause_:{required:"กรุณาระบุข้อมูล"},
					organiztion_type_:{required:"กรุณาระบุข้อมูล"}
				}
			});
			*/
	});
</script>
	
<h3>ผลการพิจารณา</h3>

<?php echo form_open('fund/project/project_support/save', 'enctype="multipart/form-data"'); ?>

<table class="tbadd">
	<tr>
		<th>รหัสโครงการ</th>
		<td style='font-size:18px; color:#F00;'> 
			<? echo @$rs['project_code']; ?>
			<? echo anchor('fund/project/project_support/form/'.@$rs['id'], "<img src='images/fund/list_info.png' style='margin-left:10px;'>", 'target="_blank"'); ?> 
		</td>
	</tr>
	<tr>
		<th>ระบบการจัดสรร</th>
		<td> 
			<span style='margin-left:20px;'><? echo form_radio(); ?> ปกติ (ส่งเข้าส่วนกลาง)</span>
			<span style='margin-left:20px;'><? echo form_radio(); ?>กระจาย (พิจารณาในจังหวัด) </span>
			<span style='margin-left:20px;' class='note'>* ล็อกแสดงโดยอัตโนมัติ</span>
		</td>
	</tr>
	<tr>
		<th>ผลการพิจารณาของคณะอนุฯ จังหวัด</th>
		<td> 
			<div>ครั้งที่ 1 ขอรายละเอียดเพิ่มเติม</div>
			<div>ครั้งที่ 2 ส่งเข้าพิจารณาในระบบปกติ (ส่วนกลาง)<span class='note'>* แสดงเฉพาะกรณีมีย้ายจาก กระจาย มา ปกติ</span></div> 
		</td>
	</tr>
	
	
	<tr>
		<th>ขนาดโครงการ</th>
		<td>	
			<? 
				if($rs['budget_request'] < 300000) {
					echo 'ขนาดเล็ก (ต่ำกว่า 300,000 บาท)';
				} else if($rs['budget_request'] <= 1000000) {
					echo 'ขนาดกลาง (300,000 – 1,000,000 บาท)';
				} else {
					echo 'ขนาดใหญ่ (มากกว่า 1,000,000 บาท ขึ้นไป)';
				}
				
			?>
			<span class='note'>* ล็อกแสดงโดยอัตโนมัติ</span>
		</td>
	</tr>
	
	
	<tr>
		<th></th>
		<td>
			<h4>ผลการพิจารณาของอนุกรรมการพิจารณากลั่นกรองโครงการที่ขอรับการสนับสนุนจากกองทุนคุ้มครองเด็ก</h4>
			<h4>ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก</h4>
			
			<h4>ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก / หรือ คณะอนุกรรมการบริหารกองทุนคุ้มครองจังหวัด</h4>
		</td>
	</tr>
	
</table>

<div id="btnBoxAdd">
	<input type="submit" value="" class="btn_save"/>
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>

<?php 
	echo form_hidden('id', @$rs['id']); 
	echo form_close(); 
?>