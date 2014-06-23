<script type="text/javascript">
	$(document).ready(function(){
			$("form").validate({
				rules: {
					title:{required:true}
				},
				messages:{
					title:{required:"กรุณาระบุชื่อกรอบทิศทางในการจัดสรรเงิน"}
				}
			});
	});
</script>

<style>
	label.error { color: red; }
</style>

<h3>แบบฟอร์มการขอรับเงินสนับสนุน กองทุนเด็กรายโครงการ (เพิ่ม / แก้ไข)</h3>

<?php echo form_open('fund/project/target_set/save'); ?>

<table class="tbadd">
	<tr>
		<th>วัน เดือน ปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
		<td><input name="title" type="text" class='datepicker' style='width:80px;'  value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	<tr>
		<th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
		<td>
			กองทุนคุ้มครองเด็ก
			<? echo form_dropdown(); ?>
			<span class='note'>* เอาไปใส่ในรหัสโครงการ</span> 
		</td>
	</tr>
	
	<tr>
		<th>จังหวัด<span class="Txt_red_12"> *</span></th>
		<td>
			<? echo form_dropdown(); ?>
			<span class='note'>* จังหวัดแสดงตามสิทธิ์ล็อกอิน แต่ถ้าเป็นส่วนกลางก็จะมีให้เลือกทุกจังหวัด</span>
		</td>
	</tr>
	
	<tr>
		<th>รหัสโครงการ<span class="Txt_red_12"> *</span></th>
		<td style='font-size:18px; color:#F00;'><? echo $rs['code']; ?></td>
	</tr>
	
	<tr>
		<th>ชื่อโครงการ<span class="Txt_red_12"> *</span></th>
		<td><input name="title" type="text"  style="width:400px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารโครงการ<span class="Txt_red_12"> *</span></th>
		<td><input type='file'></td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารรายละเอียดค่าใช้จ่ายของโครงการ</th>
		<td><input type='file'></td>
	</tr>
	
	<tr>
		<th>ชื่อองค์กรที่เสนอขอรับ</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>สถานะโครงการที่ขอรับเงินกองทุนฯ</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>ประเภทโครงการ</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>กรอบทิศทางในการจัดสรรเงินกองทุนคุ้มครองเด็ก</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>งบประมาณโครงการและแหล่งสนับสนุน (เฉพาะปีปัจจุบัน)</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>สาเหตุที่เสนอขอรับเงินกองทุน</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>กลุ่มเป้าหมายของโครงการ</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>ประเภทองค์กรที่เสนอขอรับเงินกองทุน</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
	
	<tr>
		<th>แนบไฟล์เอกสารประกอบการพิจารณา</th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
</table>


<h3>สำหรับเจ้าหน้าที่ส่วนกลาง</h3>
<table class="tbadd">
	<tr>
		<th>ลงวันที่ส่วนกลางรับเรื่อง</th>
		<td><input name="title" type="text" class='datepicker' style='width:80px;'  value="<?php echo @$rs['title']; ?>" /></td>
	</tr>
</table>


<div id="btnBoxAdd">
	<input type="submit" value="" class="btn_save"/>
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>

<?php echo form_hidden('id', @$rs['id']); ?>
<?php echo form_close(); ?>