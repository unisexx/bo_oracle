<script type="text/javascript">
	$(document).ready(function(){
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
			
		$('.cal_project_budget').keyup(function(){
			/*project_budget
			budget_request
			budget_other*/
			
			$('[name=project_budget]').val( ($('[name=budget_request]').val() * 1) + ($('[name=budget_other]').val() * 1));
		});
	});
</script>
	
<h3>แบบฟอร์มการขอรับเงินสนับสนุน กองทุนเด็กรายโครงการ (เพิ่ม / แก้ไข)</h3>

<?php echo form_open('fund/project/project_support/save', 'enctype="multipart/form-data"'); ?>

<table class="tbadd">
	<tr>
		<th>วัน เดือน ปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
		<td> <? echo form_input('receive_date', @$rs['receive_date'], 'style="width:80px;" class="datepicker"'); ?> </td>
	</tr>

	<tr>
		<th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
		<td> กองทุนคุ้มครองเด็ก <? echo form_dropdown('budget_year', array(2555=>2555, 2556=>2556), @$rs['budget_year']); ?> <span class='note'>* เอาไปใส่ในรหัสโครงการ</span> </td>
	</tr>
	
	<tr>
		<th>จังหวัด<span class="Txt_red_12"> *</span></th>
		<td> <? echo form_dropdown('province_id', get_option('ID', 'TITLE', 'fund_province'), @$rs['province_id']); ?> <span class='note'>* จังหวัดแสดงตามสิทธิ์ล็อกอิน แต่ถ้าเป็นส่วนกลางก็จะมีให้เลือกทุกจังหวัด</span> </td>
	</tr>
	
	<? if(!empty($rs['id'])) { ?> 
		<tr>
			<th>รหัสโครงการ<span class="Txt_red_12"> *</span></th>
			<td style='font-size:18px; color:#F00;'><? echo @$rs['project_code']; ?></td>
		</tr>
	<? } ?>
	
	<tr>
		<th>ชื่อโครงการ<span class="Txt_red_12"> *</span></th>
		<td><input name="project_name" type="text"  style="width:400px;" value="<?php echo @$rs['project_name']; ?>" /></td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารโครงการ<span class="Txt_red_12"> *</span></th>
		<td>
			<? if(!empty($rs['project_attachment'])) { ?> 
				<div style='display:inline-block; margin-bottom:10px; border:solid 1px #AAA; padding:10px; border-radius:4px; background:#EEE;'>
					<strong>ตัวอย่างไฟล์ : </strong>
					<? echo anchor('uploads/fund/project/project_support/'.@$rs['id'].'/'.$rs['project_attachment'], @$rs['project_attachment'], 'target="_blank"'); ?>
					<? echo anchor('fund/project/project_support/delete_file?id='.$rs['id'].'&type=project_attachment', 'Delete', 'class="btn btn-sm btn-danger"'); ?>
				</div>
			<? } ?>
			
			<div>
				<div style='display:inline-block; border:solid 1px #AAA; padding:10px; border-radius:4px; background:#EEE;'>
					<strong>แนบไฟล์ : </strong>
					<input type='file' name='project_attachment'>
				</div>
			</div>
		</td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารรายละเอียดค่าใช้จ่ายของโครงการ <span class="Txt_red_12"> *</span></th>
		<td>
			<? if(!empty($rs['project_pay_attachment'])) { ?>
				<div style='display:inline-block; margin-bottom:10px; border:solid 1px #AAA; padding:10px; border-radius:4px; background:#EEE;'>
					<strong>ตัวอย่างไฟล์ : </strong>
					<? echo anchor('uploads/fund/project/project_support/'.@$rs['id'].'/'.$rs['project_pay_attachment'], @$rs['project_pay_attachment'], 'target="_blank"'); ?>
					<? echo anchor('fund/project/project_support/delete_file?id='.$rs['id'].'&type=project_pay_attachment', 'Delete', 'class="btn btn-sm btn-danger"'); ?>
				</div>
			<? } ?>
			<div>
				<div style='display:inline-block; border:solid 1px #AAA; padding:10px; border-radius:4px; background:#EEE;'>
					<strong>แนบไฟล์ : </strong>
					<input type='file' name='project_pay_attachment'>
				</div>
			</div>
		</td>
	</tr>
	
	<tr>
		<th>ชื่อองค์กรที่เสนอขอรับ <span class="Txt_red_12"> *</span></th>
		<td><input name="organization" type="text"  style="width:400px;" value="<?php echo @$rs['organization']; ?>" /></td>
	</tr>
	
	<tr>
		<th>สถานะโครงการที่ขอรับเงินกองทุนฯ <span class="Txt_red_12"> *</span></th>
		<td style='line-height:28px;'>
			<div><? echo form_radio('project_status', 1, @$rs['project_status']); ?> โครงการริเริ่มใหม่ (โครงการที่มีแนวคิดหรือนโยบายใหม่ไม่เคยทำมาก่อน)</div>
			<div><? echo form_radio('project_status', 2, @$rs['project_status']); ?> โครงการใหม่ (โครงการที่ไม่เคยดำเนินการในพื้นที่ หรือกลุ่มเป้าหมายนั้นมาก่อน)</div>
			<div><? echo form_radio('project_status', 3, @$rs['project_status']); ?>โครงการเดิม (โครงการที่เคยดำเนินการในพื้นที่ หรือกลุ่มเป้าหมายนั้นแล้ว และต้องการดำเนินการต่อ โดยจะต้องมีทุนเพื่อใช้ในการดำเนินงานตามโครงการนี้อยู่แล้วบางส่วน)</div>
			<? echo form_hidden('project_status_', @$rs['project_status']); ?>
		</td>
	</tr>

	<tr>
		<th>ประเภทโครงการ <span class="Txt_red_12"> *</span></th>
		<td>
			<span><? echo form_radio('project_type', 1, @$rs['project_type']); ?> การสงเคราะห์เด็ก  </span> 
			<span><? echo form_radio('project_type', 2, @$rs['project_type']); ?> การคุ้มครองสวัสดิภาพเด็ก  </span> 
			<span><? echo form_radio('project_type', 3, @$rs['project_type']); ?> การดำเนินงานของสถานรองรับเด็ก 5 สถาน  </span> 
			<span><? echo form_radio('project_type', 4, @$rs['project_type']); ?> การส่งเสริมความประพฤติเด็ก (นักเรียน/นักศึกษา)</span>
			<? echo form_hidden('project_type_', @$rs['project_type']); ?>
		</td>
	</tr>
	
	<tr>
		<th>กรอบทิศทางในการจัดสรรเงินกองทุนคุ้มครองเด็ก <span class="Txt_red_12"> *</span></th>
		<td> 
			<div>
				<span><? echo form_radio('project_framework', 1, @$rs['project_framework']); ?> การป้องกันและแก้ไขปัญหาเด็กและเยาวชน</span>  
				<span><? echo form_radio('project_framework', 2, @$rs['project_framework']); ?> การพัฒนาเด็กและเยาวชน </span> 
				<span><? echo form_radio('project_framework', 3, @$rs['project_framework']); ?> การพัฒนาระบบคุ้มครองเด็ก  </span> 
				<span><? echo form_radio('project_framework', 4, @$rs['project_framework']); ?> การส่งเสริมศักยภาพครอบครัวเพื่อการเลี้ยงดูบุตรอย่างเหมาะสม</span>
			</div> 
			<div>
				<span><? echo form_radio('project_framework', 5, @$rs['project_framework']); ?> การส่งเสริมศักยภาพองค์กรปกครองส่วนท้องถิ่นในการคุ้มครองเด็ก</span> 
				<span><? echo form_radio('project_framework', 6, @$rs['project_framework']); ?> การประชาสัมพันธ์ เผยแพร่ความรู้เกี่ยวกับการคุ้มครองเด็ก</span>	
			</div>
			<? echo form_hidden('project_framework_', @$rs['project_framework']); ?>  
		</td>
	</tr>
	
	<tr>
		<th>งบประมาณโครงการและแหล่งสนับสนุน (เฉพาะปีปัจจุบัน) <span class="Txt_red_12"> *</span></th>
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
					<? echo form_checkbox('budget_other_type[]',1,@$rs['budget_other_type'][1]); ?> หน่วยงานภาครัฐ 
					<? echo form_checkbox('budget_other_type[]',2,@$rs['budget_other_type'][2]); ?> ท้องถิ่น  
					<? echo form_checkbox('budget_other_type[]',3,@$rs['budget_other_type'][3]); ?> ธุรกิจ/องค์กรเอกชน
				</span>
			</div>
			<? echo form_hidden('budget_request_', @$rs['budget_request']); ?>
		</td>
	</tr>
	
	<tr>
		<th>สาเหตุที่เสนอขอรับเงินกองทุน <span class="Txt_red_12"> *</span></th>
		<td>
			<span><? echo form_radio('budget_cause', 1, @$rs['budget_cause']); ?> ไม่ได้รับงบประมาณปกติของหน่วยงาน</span>   
			<span><? echo form_radio('budget_cause', 2, @$rs['budget_cause']); ?> ได้รับงบประมาณปกติจากหน่วยงานแต่ไม่เพียงพอ</span>
			<? echo form_hidden('budget_cause_', @$rs['budget_cause']); ?>
		</td>
	</tr>

	<!-- ========================================================================================================================================================================================================== -->	
		
	<tr>
		<th>กลุ่มเป้าหมายของโครงการ <span class="Txt_red_12"> *</span></th>
		<td>
			 <span><? echo form_checkbox('child_checked', 1, @$rs['child_checked']); ?> เด็ก <? echo form_input('child_unit', @$rs['child_unit'], "style='width:50px;'"); ?> คน </span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('family_checked', 1, @$rs['family_checked']); ?> ผู้ปกครอง/ครอบครัวอุปถัมภ์ <? echo form_input('family_unit', @$rs['family_unit'], "style='width:50px;'"); ?> คน</span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('officer_checked', 1, @$rs['officer_checked']); ?> เจ้าหน้าที่ที่ทำงานด้านเด็ก <? echo form_input('officer_unit', @$rs['officer_unit'], "style='width:50px;'"); ?> คน</span> 
			 <span style='margin-left:20px;'><? echo form_checkbox('leader_checked', 1, @$rs['leader_checked']); ?> แกนนำชุมชน <? echo form_input('leader_unit', @$rs['leader_unit'], "style='width:50px;'"); ?>  คน</span>
		</td>
	</tr>
	
	<tr>
		<th>ประเภทองค์กรที่เสนอขอรับเงินกองทุน <span class="Txt_red_12"> *</span></th>
		<td>
			<span><? echo form_radio('organiztion_type',1 ,@$rs['organiztion_type']); ?> องค์กรภาคเอกชน</span>    
			<span><? echo form_radio('organiztion_type',2 ,@$rs['organiztion_type']); ?> หน่วยงานของรัฐ</span>
			<? echo form_hidden('organiztion_type_', @$rs['organiztion_type']); ?>
		</td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารประกอบการพิจารณา <span class="Txt_red_12"> *</span></th>
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
	<input type="submit" value="" class="btn_save"/>
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>

<?php 
		echo form_hidden('project_code', @$rs['project_code']);
		echo form_hidden('id', @$rs['id']); 
	echo form_close(); 
?>