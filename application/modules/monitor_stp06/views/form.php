<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/tinymce.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=addMain]").click(function(){
		var form = $(this).closest("fieldset").find("tr:eq(1)").clone();
		form.find("input:text").val("");
		form.find("input.maintitle_id").remove();
		$(".c2 tr:last").after(form);
	});
	
	$("input[name=addSub]").livequery("click",function(){
		//var subid = $(this).prev('input[name=main_indexId]').val();
		var subid = $("input[name=addSub]").index(this);
		var form = $("<tr><td colspan='3' style='padding:0 0 0 20px;'>- หัวข้อย่อย : <input type='text' name='subtitle_"+subid+"[]' size='75'> <input class='delSub' type='button' value=' x '></td></tr>");
		$(this).closest("tr").after(form);
	});
	
	$(".delSub").livequery('click',function(){
		var $this = $(this);
		if(confirm("ยืนยันการลบข้อมูล")){
			$.get('monitor_stp06/delSub',{
				'id':$(this).prev("input.subtitle_id").val()
			},function(data){
				$this.closest("tr").remove();
			});
		}
	});
	
	$(".delMain").livequery('click',function(){
		var $this = $(this);
		if(confirm("ยืนยันการลบข้อมูล ( ข้อมูลหลักและข้อมูลย่อย )")){
			$.get('monitor_stp06/delMain',{
				'id':$(this).closest(".mainTr").find("input.maintitle_id").val()
			},function(){
				$this.closest("tr").nextUntil(".mainTr").remove();
				$this.closest("tr").remove();
			});
		}
	});
	
	$('.mainTr').each(function(){
		if($(this).find('option:selected').val() == 3){
			$(this).closest('.mainTr').find('input[name=addSub]').hide();
	   		$(this).closest('.mainTr').nextUntil('.mainTr').hide();
		}
	});
	
	$('.mainTr select').livequery('change',function(){
	   	var target = $(this).find('option:selected').val();
	   	if(target == 3){
	   		$(this).closest('.mainTr').find('input[name=addSub]').hide();
	   		$(this).closest('.mainTr').nextUntil('.mainTr').hide();
	   	}else{
	   		$(this).closest('.mainTr').find('input[name=addSub]').show();
	   		$(this).closest('.mainTr').nextUntil('.mainTr').show();
	   	}
	});
	
});
</script>
<form method="post" action="monitor_stp06/save">
<h3>สร้างแบบสอบถาม สตป.06</h3>

<fieldset>
	<legend>ตั้งค่าทั่วไป</legend>
	<table class="tbadd c0">
		<tr>
			<th>สถานะ</th>
			<td><?=form_dropdown('status',array('1'=>'เปิดใช้งาน','0'=>'ปิดการใช้งาน'),$topic['status'],'','','')?></td>
		</tr>
	</table>
</fieldset>

<fieldset>
<legend>แบบประเมินผลการดำเนินงาน</legend>
	<table class="tbadd c0">
		<tr>
			<th>ชื่อโครงการ</th>
			<td><input type="text" name="title" size="75" value="<?=$topic['title']?>"></td>
		</tr>
	</table>
</fieldset>

<fieldset>
<legend>คำชี้แจง</legend>
	<table class="tbadd c0">
		<tr>
			<th>คำชี้แจง</th>
			<td><textarea class="editor" name="explanation"><?=$topic['explanation']?></textarea></td>
		</tr>
	</table>
</fieldset>

<!-- <fieldset>
<legend>ตอนที่ 1 ข้อมูลทั่วไป</legend>
	<table class="tbadd c1">
		<tr>
			<th>1. ผู้ตอบแบบประเมิน ตำแหน่ง</th>
			<td><input type="text" name="" size="75"></td>
		</tr>
		<tr>
			<th>2. งบประมาณสนับสนุนการดำเนินงานโครงการ รวมทั้งหมดจำนวนเงิน</th>
			<td>
				<input type="text" name=""/> บาท ได้รับจัดสรรจาก <br /><br />
				หน่วยงาน <input type="text" name="" size="45"> จำนวนเงิน <input type="text" name="" /> บาท <br /><br />
				หน่วยงาน <input type="text" name="" size="45"> จำนวนเงิน <input type="text" name="" /> บาท <br /><br />
				หน่วยงาน <input type="text" name="" size="45"> จำนวนเงิน <input type="text" name="" /> บาท <br /><br />
			</td>
		</tr>
	</table>
</fieldset> -->

<fieldset>
	<legend>ตอนที่ 2 ข้อมูลการดำเนินการด้านสภาพแวดล้อม <input type="button" name="addMain" value=" เพิ่มหัวข้อหลัก "></legend>
	<table class="tbadd c2">
		<tr>
			<th>ชื่อหัวข้อหลัก</th>
			<th>ประเภทฟอร์ม</th>
			<th></th>
		</tr>
		<?php if($mt_topic_id): ?>
		<?php foreach($maintitled as $key=>$maintitle):?>
			<tr class="mainTr">
				<td>
					<input type="text" name="maintitle[]" size="75" value="<?=$maintitle['maintitle']?>">
					<input type="button" class="delMain" value=" x ">
				</td>
				<td>
					<select name="form_type[]">
						<option value="1" <?=($maintitle['form_type'] == 1)?"selected='selected'":"";?>>5 ตัวเลือก</option>
						<option value="2" <?=($maintitle['form_type'] == 2)?"selected='selected'":"";?>>2 ตัวเลือก</option>
						<option value="3" <?=($maintitle['form_type'] == 3)?"selected='selected'":"";?>>กล่องข้อความ</option>
					</select>
				</td>
				<th>
					<input type="hidden" class="maintitle_id" name="maintitle_id[]" value="<?=$maintitle['id']?>">
					<input type="button" name="addSub" value=" เพิ่มหัวข้อย่อย ">
				</th>
			</tr>
			<?php
				$subtitled = $this->subtitle->where("mt_maintitle_id = ".$maintitle['id'])->get();
				foreach($subtitled as $subtitle):
			?>
				<tr>
					<td colspan="3" style="padding:0 0 0 20px;">- หัวข้อย่อย : <input type="text" name="subtitle_<?=$key?>[]" size="75" value="<?=$subtitle['subtitle']?>"> <input type="hidden" class="subtitle_id" name="subtitle_id_<?=$key?>[]" value="<?=$subtitle['id']?>"><input class="delSub" type="button" value=" x "></td>
				</tr>
			<?php endforeach;?>
		<?php endforeach;?>
		<?php endif;?>
		<tr class="mainTr">
			<td>
				<input type="text" name="maintitle[]" size="75">
				<input type="button" name="delMain" value=" x ">
			</td>
			<td>
				<select name="form_type[]">
					<option value="1">5 ตัวเลือก</option>
					<option value="2">2 ตัวเลือก</option>
					<option value="3">กล่องข้อความ</option>
				</select>
			</td>
			<th>
				<input type="button" name="addSub" value=" เพิ่มหัวข้อย่อย ">
			</th>
		</tr>
	</table>
</fieldset>
<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?=$mt_topic_id?>">
	<input type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>