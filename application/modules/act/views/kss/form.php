<script type="text/javascript">
$(document).ready(function(){
	$("#find_project").live("click",function(){
	    var province_code = $("select[name=province_code]").val();
		var org_id = $("input[name=org_id]").val();
		
		$.get('act/kss/project_list',{
			'province_code': province_code,
			'org_id' : org_id
		},function(data){
			$(".project-list").html(data);	
		})
		
		return false;
	})
	
	<?php if($kss['id']):?>
		var province_code = $("select[name=province_code]").val();
		var org_id = $("input[name=org_id]").val();
		
		$.get('act/kss/project_list',{
			'province_code': province_code,
			'org_id' : org_id,
			'project_id' : "<?php echo $kss['project_id']?>"
		},function(data){
			$(".project-list").html(data);	
		})
	<?php endif;?>

});

function organ_view_sub() {
	var budget_year = $('select[name=budget_year]').find(":selected").val();
	var province_code = $('select[name=province_code]').find(":selected").val();
	window.open("act/kss/organ_select?budget_year="+budget_year+"&province_code="+province_code, "", "width=1024,height=768,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");
}
</script>

<h3>บันทึก แบบฟอร์มผลการปฏิบัติงานกองทุนส่งเสริม (แบบกสส.๐๓) (บันทึก / แก้ไข)</h3>

<form method="post" action="act/kss/save" enctype="multipart/form-data" id="composeform_sub">
<table class="tbadd">
  <tr>
    <th>จังหวัด</th>
    <td>
    	<?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$kss['province_code'], '', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>ปีงบประมาณ</th>
    <td>
    	<select name="budget_year">
	      <option value="">-- ปีงบประมาณ --</option>
	      <?php for ($x=date("Y")+543; $x>=2546; $x--):?>
	      <option value="<?php echo $x?>" <?php echo ($x == $kss['budget_year'])?'selected':'';?>><?php echo $x?></option>
	      <?php endfor;?>
	    </select>
    </td>
  </tr>
  <tr>
    <th>องค์กร</th>
    <td>
    	<input name="org_name" type="text" value="<?php echo act_get_organ_name($kss['org_id'])?>" style="width:250px;"/>
    	<input name="org_id" type="hidden" value="<?php echo $kss['org_id']?>"/>
    	<a href="javascript:organ_view_sub();"><img src="images/see.png" width="24" height="24" /></td></a>
    </td>
  </tr>
  <tr>
    <th>โครงการ</th>
    <td>
    	<?php if($kss['id']):?>
    		
    	<?php else:?>
    	<?php endif;?>
    	<span class="project-list"></span><img id="find_project" src="images/see.png" width="24" height="24" />
    </td>
  </tr>
  <tr>
    <th>รายงานผลครั้งที่</th>
    <td>
    	<span><input type="radio" name="round_no" value="1" <?php echo ($kss['round_no'] == 1)?'checked':'';?>/> 1</span>
		<span><input type="radio" name="round_no" value="2" <?php echo ($kss['round_no'] == 2)?'checked':'';?>/> 2</span>
	</td>
  </tr>
  <tr>
    <th>เครื่องมือที่ใช้วัดความสำเร็จของโครงการ</th>
    <td>
    	<?
	   	$cb_tools = $kss['cb_tools'];
		$cb_tools_1 =  strpos($cb_tools, '1') !== false ? '1' : '';
		$cb_tools_2 =  strpos($cb_tools, '2') !== false ? '2' : '';
		$cb_tools_3 =  strpos($cb_tools, '3') !== false ? '3' : '';
		$cb_tools_4 =  strpos($cb_tools, '4') !== false ? '4' : '';						
	   ?>
    	<span><input type="checkbox" name="cb_tools_1" value="1" <?php echo ($cb_tools_1 == 1)?'checked':'';?>/> แบบสอบถาม </span> 
		<span><input type="checkbox" name="cb_tools_2" value="2" <?php echo ($cb_tools_2 == 2)?'checked':'';?>/> แบบสัมภาษณ์</span>
		<span><input type="checkbox" name="cb_tools_3" value="3" <?php echo ($cb_tools_3 == 3)?'checked':'';?>/> แบบสังเกตุ</span>
		<span><input type="checkbox" name="cb_tools_4" value="4" <?php echo ($cb_tools_4 == 4)?'checked':'';?>/>อื่น ๆ (ระบุ) <input name="cb_tools_other" type="text" style="width:200px;" value="<?php echo $kss['cb_tools_other']?>"/></span>
	</td>
  </tr>
  <tr>
    <th>ผลที่ได้จากโครงการ(Output)</th>
    <td><textarea name="output" rows="3" style="width:500px;"><?php echo $kss['output']?></textarea></td>
  </tr>
  <tr>
    <th>
          ผลที่เกิดขึ้นภายหลังโครงการสิ้นสุดลง(Outcome)
</th>
    <td><textarea name="outcome" rows="3" style="width:500px;"><?php echo $kss['outcome']?></textarea></td>
  </tr>
  <tr>
    <th>ปัญหาและอุปสรรค</th>
    <td>ปัญหาอุปสรรคในการทำงานขององค์กร 
    	<span><input type="radio" name="org_problem" value="มี" <?php echo ($kss['org_problem'] == 'มี')?'checked':'';?>/> มี</span>
    	<span><input type="radio" name="org_problem" value="ไม่มี" <?php echo ($kss['org_problem'] == 'ไม่มี')?'checked':'';?>/>ไม่มี </span>
    	<input name="org_problem_desc" type="text" style="width:200px;" value="<?php echo $kss['org_problem_desc']?>"/>
    <br />
    ปัญหาอุปสรรคในการดำเนินโครงการ 
    <span><input type="radio" name="project_problem" value="มี" <?php echo ($kss['project_problem'] == 'มี')?'checked':'';?>/>มี </span> 
    <span><input type="radio" name="project_problem" value="ไม่มี" <?php echo ($kss['project_problem'] == 'ไม่มี')?'checked':'';?>/>ไม่มี </span>
	<input name="project_problem_desc" type="text" style="width:200px;" value="<?php echo $kss['project_problem_desc']?>"/>
<br /></td>
  </tr>
  <tr>
    <th>ข้อเสนอแนะ</th>
    <td><textarea name="suggestion" rows="3" style="width:500px;"><?php echo $kss['suggestion']?></textarea></td>
  </tr>
  <tr>
    <th>การขยายเวลาโครงการ</th>
    <td><select name="project_time_increase">
      <option value="1" <?php echo ($kss['project_time_increase'] == 1)?'selected':'';?>>ไม่อนุมัติ</option>
      <option value="2" <?php echo ($kss['project_time_increase'] == 2)?'selected':'';?>>อนุมัติ โดยคณะอนุกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
      <option value="3" <?php echo ($kss['project_time_increase'] == 3)?'selected':'';?>>อนุมัติ โดยคณะกรรมการบริการกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    </select></td>
  </tr>
  <tr>
    <th>เหตุผลที่อนุมัติ/ไม่อนุมัติ</th>
    <td><input name="reason" type="text" style="width:400px;" value="<?php echo $kss['reason']?>"/></td>
  </tr>
  <tr>
    <th>ตามมติที่ประชุมครั้ง/วันที่</th>
    <td><input name="meeting_round" type="text" style="width:300px;" value="<?php echo $kss['meeting_round']?>"/></td>
  </tr>
  <tr>
    <th>ระยะเวลาเดิม</th>
    <td><input name="pre_timeline" type="text" style="width:300px;" value="<?php echo $kss['pre_timeline']?>"/></td>
  </tr>
  <tr>
    <th>ระยะเวลาใหม่</th>
    <td><input name="new_timeline" type="text" style="width:300px;" value="<?php echo $kss['new_timeline']?>"/></td>
  </tr>
  <tr>
    <th>การคืนเงิน</th>
    <td>
    <span><input type="radio" name="return_type" value="1" <?php echo ($kss['return_type'] == 1)?'checked':'';?>/> ยกเลิกโครงการ </span> 
    <span><input type="radio" name="return_type" value="2" <?php echo ($kss['return_type'] == 2)?'checked':'';?>/> คืนเงินจากการดำเนินโครงการ
</span>
	</td>
  </tr>
  <tr>
    <th>จำนวนเงิน</th>
    <td><input name="return_cost" type="text" style="width:200px;" value="<?php echo $kss['return_cost']?>"/> 
    บาท</td>
  </tr>
  <tr>
    <th>เหตุผลที่ยกเลิกโครงการ</th>
    <td><textarea name="return_reason" rows="3" style="width:500px;"><?php echo $kss['return_reason']?></textarea></td>
  </tr>
  <tr>
    <th colspan="2" class="topic">การติดตามผลของเจ้าหน้าที่ที่ตรวจเยี่ยมองค์กร/โครงการ</th>
  </tr>
  <tr>
    <th>จำนวนการติดตามผลการตรวจเยี่ยม</th>
    <td>
    <select name="audit_count">
      <option value="0" <?php echo ($kss['audit_count'] == 0)?'selected':'';?>>ยังไม่ได้มีการติดตามผล</option>
      <option value="1" <?php echo ($kss['audit_count'] == 1)?'selected':'';?>>1 ครั้ง</option>
      <option value="2" <?php echo ($kss['audit_count'] == 2)?'selected':'';?>>2 ครั้ง</option>
      <option value="3" <?php echo ($kss['audit_count'] == 3)?'selected':'';?>>มากกว่า 2 ครั้งขึ้นไป</option>
    </select>
    </td>
  </tr>
  <tr>
    <th>ผลการติดตามผล</th>
    <td><textarea name="audit_result" rows="3" style="width:500px;"><?php echo $kss['audit_result']?></textarea></td>
  </tr>
  <tr>
    <th>ข้อเสนอแนะ</th>
    <td><textarea name="audit_suggestion" rows="3" style="width:500px;"><?php echo $kss['audit_suggestion']?></textarea></td>
  </tr>
  <tr>
    <th>คณะตรวจเยี่ยมโครงการ</th>
    <td><select name="audit_group_type">
		<option value="1" <?php echo ($kss['audit_group_type'] == 1)?'selected':'';?>>คณะทำงาน</option>
        <option value="2" <?php echo ($kss['audit_group_type'] == 2)?'selected':'';?>>คณะอนุกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
        <option value="3" <?php echo ($kss['audit_group_type'] == 3)?'selected':'';?>>อื่น ๆ(ระบุ)</option>
    </select>
    <input name="audit_group_type_other" type="text" style="width:300px;" value="<?php echo $kss['audit_group_type_other']?>"/></td>
  </tr>
  <tr>
    <th>หน่วยงานที่ตรวจเยี่ยมโครงการ</th>
    <td>
    <select name="audit_org">
      <option value="1" <?php echo ($kss['audit_org'] == 1)?'selected':'';?>>พมจ.</option>
      <option value="2" <?php echo ($kss['audit_org'] == 2)?'selected':'';?>>กทม.</option>
      <option value="3" <?php echo ($kss['audit_org'] == 3)?'selected':'';?>>อื่น ๆ(ระบุ)</option>
    </select>
    <input name="audit_org_other" type="text" style="width:300px;" value="<?php echo $kss['audit_org_other']?>"/></td>
  </tr>
  <tr>
    <th>วันที่ตรวจเยี่ยมโครงการ</th>
    <td><input class="datepicker" name="audit_date" type="text" style="width:80px;" value="<?php echo $kss['audit_date']?>"/></td>
  </tr>
  <tr>
    <th>แนบไฟล์</th>
    <td>
    	<input type="file" name="UploadFile" />
	  	<?php if($kss['file_data']):?>
	  		<a href="uploads/kss/<?php echo $kss['file_data']?>"><?php echo $kss['file_data']?></a>
	  		<input type="hidden" name="hdfilename" value="<?php echo $kss['file_data']?>">
	  	<?php endif;?>
    </td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo $kss['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>