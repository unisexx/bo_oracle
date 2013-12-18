<style type="text/css">
	tr.icolor > th{
		color:#000;
		font-weight: bold;
		background: url(themes/bo/images/bg_topic.gif);
	}
	legend{
		color:#000;
		font-weight: bold;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('form').find('input, textarea, button, select').attr('disabled','disabled');
	
	$('.ch5frm').each(function(){
		var sum = 0;
		var $this = $(this);
		$(this).nextUntil('.mTitle').each(function(){
			sum += parseInt($(this).find("select option:selected").val());
		});
	});
});
</script>

<form method="post" action="monitor_stp06/save_question">

<center><h3>แบบประเมินผลการดำเนินงานตาม<?=$topic['title']?> ของ สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด<?=$province?></h3></center>

<fieldset>
<legend>คำชี้แจง</legend>
<?=$topic['explanation']?>
</fieldset>

<fieldset>
<legend>ตอนที่ 1 ข้อมูลทั่วไป</legend>
	<table class="tbadd c1">
		<tr>
			<th>1. ผู้ตอบแบบประเมิน ตำแหน่ง</th>
			<td><input type="text" name="user_position" size="75" value="<?=$r1['user_position']?>"></td>
		</tr>
		<tr>
			<th>2. งบประมาณสนับสนุนการดำเนินงานโครงการ รวมทั้งหมดจำนวนเงิน</th>
			<td>
				<input type="text" name="budget" value="<?=$r1['budget']?>"/> บาท ได้รับจัดสรรจาก <br /><br />
				หน่วยงาน <input type="text" name="agency_1" size="45" value="<?=$r1['agency_1']?>"> จำนวนเงิน <input type="text" name="amount_1" value="<?=$r1['amount_1']?>" /> บาท <br /><br />
				หน่วยงาน <input type="text" name="agency_2" size="45" value="<?=$r1['agency_2']?>"> จำนวนเงิน <input type="text" name="amount_2" value="<?=$r1['amount_2']?>" /> บาท <br /><br />
				หน่วยงาน <input type="text" name="agency_3" size="45" value="<?=$r1['agency_3']?>"> จำนวนเงิน <input type="text" name="amount_3" value="<?=$r1['amount_3']?>" /> บาท <br /><br />
			</td>
		</tr>
	</table>
	<table class="tbadd">
		<tr>
			<th colspan="2">3. ผลผลิตตามโครงการ (การบรรลุวัตถุประสงค์)</th>
		</tr>
		<tr class="icolor">
			<th>เป้าหมายตามวัตถุประสงค์</th>
			<th>ผลผลิตที่ได้รับเมื่อเสร็จสิ้นโครงการ</th>
		</tr>
		<tr>
			<td style="width: 50%;"><textarea name="target" style="width:100%; height: 100px;"><?=$r1['target']?></textarea></td>
			<td style="width: 50%;"><textarea name="production" style="width:100%; height: 100px;"><?=$r1['production']?></textarea></td>
		</tr>
	</table>
</fieldset>

<fieldset>
<legend>ตอนที่2 ข้อมูลการดำเนินโครงการด้านสภาวะแวดล้อม (Context) ด้านปัจจัย (Input) ด้านกระบวนการ (Process) ด้านผลผลิต (Product) และด้านผลลัพธ์ (Outcome)</legend>
	<table class="tbadd">
		<?php foreach($maintitled as $maintitle):?>
			<?php $subtitled = $this->subtitle->where("mt_maintitle_id = ".$maintitle['id'])->get();?>
			<tr class="mTitle">
				<th colspan="3">
					<?=$maintitle['maintitle']?>
				</th>
			</tr>
			<?php if($maintitle['form_type'] == 1): ?>
				<tr class="icolor ch5frm">
					<th>รายการประเมิน</th>
					<th>ระดับการปฏิบัติ</th>
					<th>ข้อสังเกตจากการประเมิน</th>
				</tr>
				<?php foreach($subtitled as $subtitle):
					//$this->db->debug = true;
					$r2 = $this->r2->where("mt_subtitle_id = ".$subtitle['id']." and province_id = ".$r1['province_id']." and workgroup_id = ".$r1['workgroup_id'])->get_row();
				?>
				<tr>
					<td>
						<?=$subtitle['subtitle']?>
						<input type="hidden" name="mt_subtitle_id[]" value="<?=$subtitle['id']?>">
					</td>
					<td><?=form_dropdown('choice5[]',array('5'=>'5','4'=>'4','3'=>'3','2'=>'2','1'=>'1'),@$r2['choice5'],'','','')?></td>
					<td>
						<textarea name="choice5_comment[]"><?=@$r2['choice5_comment']?></textarea>
						<input type="hidden" name="choice2[]">
						<input type="hidden" name="choice2_comment[]">
						<input type="hidden" name="textbox_comment[]">
						<input type="hidden" name="mt_maintitle_id[]" value="<?=$maintitle['id']?>">
						<input type="hidden" name="r2_id[]" value="<?=@$r2['id']?>">
					</td>
				</tr>
				<?php endforeach;?>
			<?php elseif($maintitle['form_type'] == 2):?>
				<tr class="icolor">
					<th>รายการประเมิน</th>
					<th>ระดับการปฏิบัติ</th>
					<th>ข้อเท็จจริง ระบุข้อมูลประกอบ</th>
				</tr>
				<?php foreach($subtitled as $subtitle):
					$r2 = $this->r2->where("mt_subtitle_id = ".$subtitle['id']." and province_id = ".$r1['province_id']." and workgroup_id = ".$r1['workgroup_id'])->get_row();
				?>
				<tr>
					<td>
						<?=$subtitle['subtitle']?>
						<input type="hidden" name="mt_subtitle_id[]" value="<?=$subtitle['id']?>">
					</td>
					<td><?=form_dropdown('choice2[]',array('มี'=>'มี','ไม่มี'=>'ไม่มี'),@$r2['choice2'],'','','')?></td>
					<td>
						<textarea name="choice2_comment[]"><?=@$r2['choice2_comment']?></textarea>
						<input type="hidden" name="choice5[]">
						<input type="hidden" name="choice5_comment[]">
						<input type="hidden" name="textbox_comment[]">
						<input type="hidden" name="mt_maintitle_id[]" value="<?=$maintitle['id']?>">
						<input type="hidden" name="r2_id[]" value="<?=@$r2['id']?>">
					</td>
				</tr>
				<?php endforeach;?>
			<?php elseif($maintitle['form_type'] == 3):
				$r2 = $this->r2->where("mt_maintitle_id = ".$maintitle['id']." and province_id = ".$r1['province_id']." and workgroup_id = ".$r1['workgroup_id'])->get_row();
			?>
				<tr>
					<td colspan="3">
						<textarea name="textbox_comment[]" style="width:100%; height: 100px;"><?=@$r2['textbox_comment']?></textarea>
						<input type="hidden" name="choice5[]">
						<input type="hidden" name="choice5_comment[]">
						<input type="hidden" name="choice2[]">
						<input type="hidden" name="choice2_comment[]">
						<input type="hidden" name="mt_maintitle_id[]" value="<?=$maintitle['id']?>">
						<input type="hidden" name="mt_subtitle_id[]">
						<input type="hidden" name="r2_id[]" value="<?=@$r2['id']?>">
					</td>
				</tr>
			<?php endif;?>
			
		<?php endforeach;?>
	</table>
</fieldset>

<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?=$r1['id']?>">
	<input type="hidden" name="workgroup_id" value="<?=$r1['workgroup_id']?>">
	<input type="hidden" name="province_id" value="<?=$r1['province_id']?>">
	<input type="hidden" name="mt_topic_id" value="<?=$topic['id']?>">
	<!-- <input type="submit" title="บันทึก" value=" " class="btn_save"/> -->
</div>
</form>