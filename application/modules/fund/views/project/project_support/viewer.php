<style type='text/css'>
	.div_attach {
		margin:5px;
	}
	
	.div_attach>div {
		display:inline-block;
		border:solid 1px #AAA; 
		padding:10px; 
		border-radius:4px; 
		background:#EEE;
		line-height:30px;
		min-width:420px;
	}
	
	.btn_delete_file {
		display:inline-block;
		width:70px; 
		float:right;
	}
</style>

<script language='javascript'>
	$(function(){
		$('input, select').attr('disabled', 'disabled');
		$('.btn_back').removeAttr('disabled');
	});
</script>
	
<h3>แบบฟอร์มการขอรับเงินสนับสนุน กองทุนเด็กรายโครงการ</h3>

<table class="tbadd">
	<tr>
		<th>วัน เดือน ปี ที่รับเรื่อง</th>
		<td> <? echo form_input('receive_date', @$rs['receive_date'], 'style="width:80px;" class="datepicker"'); ?> </td>
	</tr>

	<tr>
		<th>ปีงบประมาณ</th>
		<td> กองทุนคุ้มครองเด็ก <? echo form_dropdown('budget_year', array(2555=>2555, 2556=>2556), @$rs['budget_year']); ?> <span class='note'>* เอาไปใส่ในรหัสโครงการ</span> </td>
	</tr>
	
	<tr>
		<th>จังหวัด</th>
		<td> <? echo form_dropdown('province_id', get_option('ID', 'TITLE', 'fund_province'), @$rs['province_id']); ?> <span class='note'>* จังหวัดแสดงตามสิทธิ์ล็อกอิน แต่ถ้าเป็นส่วนกลางก็จะมีให้เลือกทุกจังหวัด</span> </td>
	</tr>
	
	<? if(!empty($rs['id'])) { ?> 
		<tr>
			<th>รหัสโครงการ</th>
			<td style='font-size:18px; color:#F00;'><? echo @$rs['project_code']; ?></td>
		</tr>
	<? } ?>
	
	<tr>
		<th>ชื่อโครงการ</th>
		<td><input name="project_name" type="text"  style="width:400px;" value="<?php echo @$rs['project_name']; ?>" /></td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารโครงการ</th>
		<td>
			<div id='file_sector1'>
				<? foreach($attach_file as $item) { ?>
					<div class='div_attach'>
						<div> <? echo anchor('fund/project/project_support/file_download/'.$item['id'], $item['attach_name']); ?> </div>
					</div>
				<? } ?>
			</div>
		</td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารรายละเอียดค่าใช้จ่ายของโครงการ </th>
		<td>
			<div id='file_sector2'>
				<? foreach($attach_file_pay as $item) { ?>
					<div class='div_attach'>
						<div> <? echo anchor('fund/project/project_support/file_download/'.$item['id'], $item['attach_name']); ?> </div>
					</div>
				<? } ?>
			</div>
		</td>
	</tr>
	
	<tr>
		<th>ชื่อองค์กรที่เสนอขอรับ </th>
		<td><input name="organization" type="text"  style="width:400px;" value="<?php echo @$rs['organization']; ?>" /></td>
	</tr>
	
	<tr>
		<th>สถานะโครงการที่ขอรับเงินกองทุนฯ </th>
		<td style='line-height:28px;'>
			<?
				$project_status_ary = array(
					'1' => 'โครงการริเริ่มใหม่ (โครงการที่มีแนวคิดหรือนโยบายใหม่ไม่เคยทำมาก่อน)',
					'2' => 'โครงการใหม่ (โครงการที่ไม่เคยดำเนินการในพื้นที่ หรือกลุ่มเป้าหมายนั้นมาก่อน)',
					'3' => 'โครงการเดิม (โครงการที่เคยดำเนินการในพื้นที่ หรือกลุ่มเป้าหมายนั้นแล้ว และต้องการดำเนินการต่อ โดยจะต้องมีทุนเพื่อใช้ในการดำเนินงานตามโครงการนี้อยู่แล้วบางส่วน)'
				);
				
				if(!empty($rs['project_status'])) {
					echo $project_status_ary[$rs['project_status']];
				}
			?>
		</td>
	</tr>

	<tr>
		<th>ประเภทโครงการ </th>
		<td>
			<?
				$project_type_ary = array(
					'1' => 'การสงเคราะห์เด็ก',
					'2' => 'การคุ้มครองสวัสดิภาพเด็ก',
					'3' => 'การดำเนินงานของสถานรองรับเด็ก 5 สถาน',
					'4' => 'การส่งเสริมความประพฤติเด็ก (นักเรียน/นักศึกษา)'
				);
				
				if(!empty($rs['project_type'])) {
					echo $project_type_ary[$rs['project_type']];
				}
			?>
		</td>
	</tr>
	
	<tr>
		<th>กรอบทิศทางในการจัดสรรเงินกองทุนคุ้มครองเด็ก </th>
		<td> 
			<div>
				<?
					$project_framework_ary = array(
						'1' => 'การป้องกันและแก้ไขปัญหาเด็กและเยาวชน',
						'2' => 'การพัฒนาเด็กและเยาวชน',
						'3' => 'การพัฒนาระบบคุ้มครองเด็ก 5 สถาน',
						'4' => 'การส่งเสริมศักยภาพครอบครัวเพื่อการเลี้ยงดูบุตรอย่างเหมาะสม'
					);
					
					if(!empty($rs['project_framework'])) {
						echo $project_framework_ary[$rs['project_framework']];
					}
				?>
			</div> 
		</td>
	</tr>
	
	<tr>
		<th>งบประมาณโครงการและแหล่งสนับสนุน (เฉพาะปีปัจจุบัน) </th>
		<td>
			<div>
				<span style='width:240px;'>งบประมาณทั้งโครงการ </span><? echo form_input('project_budget', @$rs['project_budget'], 'style="width:180px; background:#EEE;" readonly="readonly"'); ?>  บาท
			</div>
			<div>
				<span style='width:240px;'>งบประมาณที่ขอรับการสนับสนุน  </span><? echo form_input('budget_request', @$rs['budget_request'], 'class="cal_project_budget" style="width:180px;"'); ?> บาท
				<span class='note'>* จะคำนวณเป็นขนาดโครงการ</span>
			</div>
			<div>
				<span style='width:240px;'>งบประมาณที่ได้รับสมทบจากแหล่งอื่น*(ถ้ามี) </span><? echo form_input('budget_other', @$rs['budget_other'], 'class="cal_project_budget" style="width:180px;"'); ?> บาท
				<span style='margin-left:20px;'>
					<? echo form_checkbox(false,1,@$rs['budget_other_type'][1]); ?> หน่วยงานภาครัฐ 
					<? echo form_checkbox(false,2,@$rs['budget_other_type'][2]); ?> ท้องถิ่น  
					<? echo form_checkbox(false,3,@$rs['budget_other_type'][3]); ?> ธุรกิจ/องค์กรเอกชน
				</span>
			</div>
		</td>
	</tr>
	
	<tr>
		<th>สาเหตุที่เสนอขอรับเงินกองทุน </th>
		<td>
			<?
				$budget_cause_ary = array(
					'1' => 'ไม่ได้รับงบประมาณปกติของหน่วยงาน',
					'2' => 'ได้รับงบประมาณปกติจากหน่วยงานแต่ไม่เพียงพอ'
				);
				
				if(!empty($rs['budget_cause'])) {
					echo $budget_cause_ary[$rs['budget_cause']];
				}
			?>
		</td>
	</tr>

	<!-- ========================================================================================================================================================================================================== -->	
		
	<tr>
		<th>กลุ่มเป้าหมายของโครงการ </th>
		<td>
			 <span><? echo form_checkbox('child_checked', 1, @$rs['child_checked']); ?> เด็ก <? echo form_input('child_unit', @$rs['child_unit'], "style='width:50px;'"); ?> คน </span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('family_checked', 1, @$rs['family_checked']); ?> ผู้ปกครอง/ครอบครัวอุปถัมภ์ <? echo form_input('family_unit', @$rs['family_unit'], "style='width:50px;'"); ?> คน</span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('officer_checked', 1, @$rs['officer_checked']); ?> เจ้าหน้าที่ที่ทำงานด้านเด็ก <? echo form_input('officer_unit', @$rs['officer_unit'], "style='width:50px;'"); ?> คน</span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('leader_checked', 1, @$rs['leader_checked']); ?> แกนนำชุมชน <? echo form_input('leader_unit', @$rs['leader_unit'], "style='width:50px;'"); ?>  คน</span>
		</td>
	</tr>
	
	<tr>
		<th>ประเภทองค์กรที่เสนอขอรับเงินกองทุน </th>
		<td>
			<?
				$organiztion_type_ary = array(
					'1' => 'องค์กรภาคเอกชน',
					'2' => 'หน่วยงานของรัฐ'
				);
				
				if(!empty($rs['organiztion_type'])) {
					echo $organiztion_type_ary[$rs['organiztion_type']];
				}
			?>
		</td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารประกอบการพิจารณา </th>
		<td>ทำหน้า lightbox ตั้งแต่ 1.3 - 3.7</td>
	</tr>
</table>


<h3>สำหรับเจ้าหน้าที่ส่วนกลาง</h3>
<table class="tbadd">
	<tr>
		<th>ลงวันที่ส่วนกลางรับเรื่อง</th>
		<td><input name="center_receive_date" type="text" class='datepicker' style='width:80px;'  value="<? echo @$rs['center_receive_date']; ?>" /></td>
	</tr>
</table>

<div id="btnBoxAdd">
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
