<style>
	.tbadd .topic { background:#FCC; border-top:1px dashed #ccc; width:100%; color:#000}
</style>
<script language='javascript'>
 function chang_strat(){
		if($('#metrics_start').val()=='' || $('#metrics_start').val() == 6){
			$('.metrics_end_6').show();
			$('.metrics_end_9').show();
			$('.metrics_end_12').show();
			
			$('.metrics_6').show();
			$('.metrics_9').show();
			$('.metrics_12').show();
			
			
		}else if($('#metrics_start').val() == 9){
			$('.metrics_end_6').hide();
			$('.metrics_end_9').show();
			$('.metrics_end_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').show();
			$('.metrics_12').show();
			
			$('#sem_9_9').attr('checked','checked');
			
		}else if($('#metrics_start').val() == 12){
			$('.metrics_end_6').hide();
			$('.metrics_end_9').hide();
			$('.metrics_end_12').show();
			
			$('.metrics_6').hide();
			$('.metrics_9').hide();
			$('.metrics_12').show();
			
			$('#sem_12_12').attr('checked','checked');
		}
	}
$(function(){
	$('#metrics_start').live('change', function(){
		chang_strat()
	});
	
	$(".metrics_end").live('change', function () {
			if ($(this).is(':checked')){
				$(".metrics_end").removeAttr('checked');
				$(this).attr('checked','checked');
			}
	});
	
	$('.metrics_dtl_9').hide();
	$('.metrics_dtl_12').hide();
});
</script>
<h3>ตั้งค่า  มิติและตัวชี้วัด (เพิ่ม / แก้ไข)</h3>
<h5>ตัวชี้วัด</h5>
<form action="<?php echo $urlpage;?>/save_2" method="POST">
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td>
   	<input type="hidden" name="mds_set_indicator_id" name="mds_set_indicator_id" value="<?=@$rs['mds_set_indicator_id']?>" />
    <input type="text" name="budget_year" id="budget_year" style="width:70px;" value="2556" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td>
    <input type="text" name="indicator_name" id="indicator_name" style="width:500px;" value="มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>ตัวชี้วัดที่</th>
    <td><input type="text" name="metrics_on" id="metrics_on" style="width:70px;" value="1.auto" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>น้ำหนักตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield" type="text" id="textfield"style="width:50px;" value="auto" class="numDecimal"  />  (ร้อยละ)</td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield8" type="text" id="textfield11" style="width:500px;"/></td>
  </tr>
  <tr>
    <th>ประเด็นการประเมินผล<span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_assessment_id',get_option('id','ass_name','mds_set_assessment'),@$rs['mds_set_assessment_id'],'','-- เลือกประเด็นการประเมินผล --') ?></td>
  </tr>
  <tr>
    <th><span style="width:15%">หน่วยวัด</span><span class="Txt_red_12"> *</span></th>
    <td><?php echo form_dropdown('mds_set_measure_id',get_option('id','measure_name','mds_set_measure'),@$rs['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?></td>
  </tr>
  <tr>
    <th><span style="width:5%">เป้าหมาย<span class="Txt_red_12"> *</span><br />
    </span></th>
    <td><input name="textfield9" type="text" class="numOnly" id="textfield8" style="width:30px;" maxlength="3" /></td>
  </tr>
  <tr>
    <th>ผู้รับผิดชอบ<span class="Txt_red_12"> *</span></th>
    <td><span><input type="radio" name="radio" id="radio" value="radio" />      มี</span>
        <span><input type="radio" name="radio" id="radio2" value="radio" /> ไม่มี</span></td>
  </tr>
  <tr>
    <th>ตัวชี้วัดเริ่มที่รอบ <span class="Txt_red_12">*</span></th>
    <td><select name="metrics_start" id="metrics_start">
      <option value="">-- เลือกรอบตัวชี้วัด --</option>
      <option value="6">เริ่มที่รอบ 6 เดือน</option>
      <option value="9">เริ่มที่รอบ 9 เดือน</option>
      <option value="12">เริ่มที่รอบ 12 เดือน</option>
    </select></td>
  </tr>
  <tr>
    <th>ตัวชี้วัดนี้ยกเลิกที่รอบ</th>
    <td>
      <span class="metrics_end_6"><input type="checkbox" name="metrics_end[]" id="metrics_end[]" class="metrics_end" value="6" /> 6 เดือน </span>
      <span class="metrics_end_9"><input type="checkbox" name="metrics_end[]" id="metrics_end[]" class="metrics_end" value="9" /> 9 เดือน </span>
  	  <span class="metrics_end_12"><input type="checkbox" name="metrics_end[]" id="metrics_end[]" class="metrics_end" value="12" /> 12 เดือน </span></td>
  </tr>
</table>

<table class="tbadd">
<tr class="metrics_6">
<th colspan="2" class="topic">ผู้รับผิดชอบรอบ 6 เดือน</th>
</tr>
<tr class="metrics_6">
<th>น้ำหนักตัวชี้วัดรอบ 6 เดือน<span class="Txt_red_12"> * </span></th>
<td><input name="textfield2" type="text" id="textfield2"style="width:50px;" value="auto" class="numDecimal"  /></td>
</tr>
<tr class="metrics_6">
<th>กพร.<span class="Txt_red_12"> * </span></th>
<td><select name="select3" id="select3">
  <option>-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
</select></td>
</tr>
<tr class="metrics_6">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="select4" id="select4">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
    </select></td>
</tr>
<tr class="metrics_6">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td><select name="select6" id="select7">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
    </select>
    <input name="textfield7" type="text" id="textfield7" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" /></td>
</tr>


<tr class="metrics_9">
  <th colspan="2" class="topic">ผู้รับผิดชอบรอบ 9 เดือน</th>
</tr>
<tr class="metrics_9">
<th>น้ำหนักตัวชี้วัดรอบ 9 เดือน<span class="Txt_red_12"> * </span></th>
<td><input name="textfield2" type="text" id="textfield2"style="width:50px;" value="auto" class="numDecimal"  /></td>
</tr>
<tr class="metrics_9">
  <th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
  <td><span class="metrics_6">
    <input type="radio" name="sem_9" id="sem_9_6"  value="6" />
    กลุ่มเดียวกับ รอบ 6 เดือน  </span> 
  <span>
  <input type="radio" name="sem_9" id="sem_9_9" value="9" />
  เปลี่ยนกลุ่มรับผิดชอบ</span></td>
</tr>
<tr class="metrics_dtl_9">
  <th>กพร.<span class="Txt_red_12"> * </span></th>
  <td><select name="select3" id="select3">
    <option>-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_9">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="select4" id="select4">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
    </select></td>
</tr>
<tr class="metrics_dtl_9">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td><select name="select6" id="select6">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
  </select></td>
</tr>


<tr class="metrics_12">
  <th colspan="2" class="topic">ผู้รับผิดชอบรอบ 12 เดือน</th>
</tr>
<tr class="metrics_12">
  <th>น้ำหนักตัวชี้วัดรอบ 12 เดือน<span class="Txt_red_12"> * </span></th>
  <td><input name="textfield2" type="text" id="textfield2"style="width:50px;" value="auto" class="numDecimal"  /></td>
</tr>
<tr class="metrics_12">
  <th>ผู้รับผิดชอบ<span class="Txt_red_12"> * </span></th>
  <td><span class="metrics_6">
    <input type="radio" name="sem_12" id="sem_12_6" value="6" />
    กลุ่มเดียวกับ รอบ 6 เดือน</span>
    <span class="metrics_9"><input type="radio" name="sem_12" id="sem_12_9" value="9" />
กลุ่มเดียวกับ รอบ 9 เดือน</span> <span>
      <input type="radio" name="sem_12" id="sem_12_12" value="12" />
    เปลี่ยนกลุ่มรับผิดชอบ</span></td>
</tr>
<tr class="metrics_dtl_12">
  <th>กพร.<span class="Txt_red_12"> * </span></th>
  <td><select name="select3" id="select3">
    <option>-- กำหนดผู้รับผิดชอบ (กพร.) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_12">
  <th>ผู้กำกับดูแลตัวชี้วัด<span class="Txt_red_12"> * </span></th>
  <td><select name="select4" id="select4">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้กำกับดูแลตัวชี้วัด) --</option>
  </select></td>
</tr>
<tr class="metrics_dtl_12">
  <th>ผู้จัดเก็บข้อมูล<span class="Txt_red_12"> * </span></th>
  <td><select name="select5" id="select5">
    <option>-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --</option>
    </select></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>