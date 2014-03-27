<script>
$(document).ready(function(){
	$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
	$(".example82").colorbox({width:"50%", inline:true, href:"#inline_example82"});
	$(".example83").colorbox({width:"50%", inline:true, href:"#inline_example83"});
	$(".example84").colorbox({width:"50%", inline:true, href:"#inline_example84"});
	$(".example85").colorbox({width:"50%", inline:true, href:"#inline_example85"});
});

function organ_view_sub() {
	var budget_year = $('select[name=budget_year]').find(":selected").val();
	var province_code = $('select[name=province_code]').find(":selected").val();
	window.open("act/kss/organ_select?budget_year="+budget_year+"&province_code="+province_code, "", "width=1024,height=768,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes");
}

function startDesktop(f)
{
  var desktop = window.open("act/fund_welfare/list_project?var=project_continue", "_blank", "toolbar=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=1024,height=768");
}
</script>

<h3>บันทึก กองทุนส่งเสริมการจัดสวัสดิการสังคม (บันทึก / แก้ไข)</h3>

<form id="composeform_sub" method="post" action="act/fund_welfare/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>กองทุน<span class="Txt_red_12"> *</span></th>
    <td>กองทุนส่งเสริมการจัดสวัสดิการสังคม
    	<?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$project['province_code'], 'id=province', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>องค์การ
     <span class="Txt_red_12"> *</span></th>
    <td>
    	<input name="org_name" type="text" value="<?php echo act_get_organ_name($project['org_id'])?>" style="width:250px;"/>
    	<input name="org_id" type="hidden" value="<?php echo $project['org_id']?>"/>
    	<a href="javascript:organ_view_sub();"><img src="images/see.png" width="24" height="24" /></td></a>
    </td>
  </tr>
  <tr>
    <th>ปีงบประมาณ</th>
    <td>
    	<select name="budget_year">
	      <option value="">-- ปีงบประมาณ --</option>
	      <?php for ($x=date("Y")+543; $x>=2546; $x--):?>
	      <option value="<?php echo $x?>" <?php echo ($x == $project['budget_year'])?'selected':'';?>><?php echo $x?></option>
	      <?php endfor;?>
	    </select>
    </td>
  </tr>
  <tr>
    <th>โครงการ</th>
    <td>
    <p><span>
      <input type="radio" name="project_type" value="1" <?=($project['project_type'] == 1 )?'checked':'';?> />
ชื่อโครงการ </span>
      <input name="project_name" type="text" style="width:300px;" value="<?=$project['project_name']?>"/>
      
      <!-- <input type="text" name="DIS_NAME" id="DIS_NAME" value="ระบบกระจาย" disabled="disabled">
      <input type="hidden" name="DIS" id="DIS" value="2"> -->
      
      <select name="dis2">
        <option value="0">-- เลือกประเภทการกระจาย --</option>
        <option value="1">เชิงประเด็น</option>
        <option value="2">เชิงพื้นที่</option>
        <option value="3">ภาครวมของประเทศ</option>
      </select>
    </p>

<p><span>
<input type="radio" name="project_type" value="2" <?=($project['project_type'] == 2 )?'checked':'';?> />
โครงการต่อเนื่อง </span>
  <input name="project_continue_name" type="text" value="<?=($project['project_type'] == 2)?$project['project_name']:'';?>" style="width:300px;"/>
  <input type="hidden" name="project_continue" value="">
  <input type="hidden" name="project_continue_fund" value="">
  <input type="hidden" name="project_continue_org" value="">  
  <img src="images/see.png" width="24" height="24" onclick='startDesktop ();' /></p></td>
  </tr>
  <tr>
    <th>ลักษณะโครงการ</th>
    <td>
    <select name="chac_project">
      <option value="">-- เลือกลักษณะโครงการ --</option>
      <option value="1">การจัดสว้สดิการสังคม</option>
      <option value="2">การปฏิบัติด้านสวัสดิการ</option>
      <option value="3">การสมทบโครงการ</option>
    </select>
    
    <span id="CHACT2"></span>
      
      <!-- <select name="select13">
        <option>-- เลือกการจัดสวัสดิการสังคม --</option>
      </select>
      <select name="select14">
        <option>-- เลือกการปฏิบัติด้านสวัสดิการ --</option>
      </select>
      <select name="select15">
        <option>-- เลือกสมทบโครงการ --</option>
      </select> -->
      <br />
      
      <script>
      	$(document).ready(function(){
      		$('select[name=chac_project]').change(function(){
      			chac_project_val = $(this).val();
      			console.log(chac_project_val);
      			$.get('act/fund_welfare/ajax_get_chac?type='+chac_project_val,function(data){
      				$('#CHACT2').html(data);
      			});
      		});
      	});
      </script>
      
      
    <?=form_dropdown('branch', get_option('service_id', 'service_name', 'act_service', '1=1 order by seq asc'), @$project['branch'], '', '-- เลือกสาขา --'); ?>
    
    <input name="pol" type="text" value="<?=$project['pol']?>" style="width:300px;"/>
    <br />
    
    <?=form_dropdown('design', get_option('id', 'policy_name', 'act_policy', '1=1 order by seq asc'), @$project['design'], '', '-- เลือกความสอดคล้องกับยุทธศาสตร์และแผน --'); ?>
    
    <input name="design_text" type="text" value="<?=$project['design_text']?>" style="width:300px;"/></td>
  </tr>
  <tr>
    <th>รหัสทะเบียนโครงการ</th>
    <td><input name="doc_id2" type="text" value="<?=$project['doc_id2']?>" style="width:100px;"/></td>
  </tr>
  <tr>
    <th>แผน</th>
    <td>
    	<?=form_dropdown('plan', get_option('id', 'plan_name', 'act_plan', '1=1 order by seq asc'), @$project['design'], 'id=select_plan', '-- เลือกความสอดคล้องกับยุทธศาสตร์และแผน --'); ?>
    <span id="subplan"></span>
    
    <script>
    $(document).ready(function(){
  		$('select[name=plan]').change(function(){
  			plan_id = $(this).val();
  			
  			$.get('act/fund_welfare/ajax_get_subplan?plan_id='+plan_id,function(data){
  				$('#subplan').html(data);
  			});
  		});
  	});
    </script>
    
    </td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายทั้งโครงการ</th>
    <td><input name="cost_all" type="text" value="0.00" style="width:150px;"/>
      บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบ</th>
    <td><input name="cost_associate" type="text" value="0.00" style="width:150px;"/>
บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบจากองค์กรอื่น</th>
    <td><input name="cost_join" type="text" value="0.00" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่เสนอขอรับการสนับสนุน</th>
    <td><input name="cost_request" type="text" value="0.00" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ได้รับอนุมัติ</th>
    <td><input name="cost_get" type="text" value="0.00" style="width:150px;"/>
บาท (รวมจากรายการค่าใช้จ่าย)</td>
  </tr>
  <tr>
    <th>ขนาดของโครงการ</th>
    <td>ไม่เกิน 50,000 บาท</td>
  </tr>
  <tr>
    <th>แนบไฟล์</th>
    <td><input type="file" name="fileField2" id="fileField2" /></td>
  </tr>
  <tr>
    <th>วันที่อนุมัติโครงการตามเอกสารแนบ</th>
    <td><input class="datepicker" name="approve_date" type="text" value="<?=$project['approve_date']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายสมทบ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield7" type="text" id="textfield7" style="width:150px;"/>
บาท</td>
  </tr>
  <tr>
    <th>ค่าใช้จ่ายที่ได้รับอนุมัติ<span class="Txt_red_12"> *</span></th>
    <td><input name="textfield8" type="text" id="textfield8" style="width:150px;"/>
บาท</td>
  </tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="fund_id" id="fund_id" value="7">
  <input type="hidden" name="project_id" value="<?=$project['project_id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>







<h3>กลุ่มเป้าหมาย</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กลุ่มเป้าหมาย</th>
<th>จำนวนกลุ่มเป้าหมาย</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>เด็กและเยาวชน</td>
<td>270</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>

<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<h3>กลุ่มเป้าหมาย (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>กลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select2">
    <option>-- เลือกกลุ่มเป้าหมาย --</option>
  </select></td>
</tr>
<tr>
  <th>จำนวนกลุ่มเป้าหมาย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>พื้นที่ดำเนินงาน</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>จังหวัด</th>
<th>อำเภอ</th>
<th>ตำบล</th>
<th>หมู่บ้าน</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example82" style="padding:10px; background:#fff;">
<h3>พื้นที่ดำเนินงาน (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td><select name="select3" id="select2">
    <option>-- เลือกจังหวัด --</option>
  </select></td>
</tr>
<tr>
  <th>อำเภอ<span class="Txt_red_12"> *</span></th>
  <td><select name="select2" id="select">
    <option>-- เลือกอำเภอ --</option>
  </select></td>
</tr>
<tr>
  <th>ตำบล<span class="Txt_red_12"> *</span></th>
  <td><select name="select4" id="select3">
    <option>-- เลือกตำบล --</option>
  </select></td>
</tr>
<tr>
  <th>หมู่บ้าน</th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:200px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>รายการค่าใช้จ่าย</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example83"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ค่าใช้จ่าย</th>
<th>คชจ.ทั้งโครงการ (บาท)</th>
<th>คชจ.ที่เสนอขอ (บาท)</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>



<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example83" style="padding:10px; background:#fff;">
<h3>รายการค่าใช้จ่าย (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>รายการค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield4" type="text" id="textfield4" style="width:300px;"/></td>
</tr>
<tr>
  <th>จำนวนเงินค่าใช้จ่ายทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/> 
    บาท</td>
</tr>
<tr>
  <th>รายการ คชจ. ย่อยของทั้งโครงการ<span class="Txt_red_12"> *</span></th>
  <td><textarea name="textfield27" rows="3" id="textfield33" style="width:500px;"></textarea></td>
</tr>
<tr>
  <th>คชจ.ที่เสนอขอ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield5" type="text" id="textfield5" style="width:100px;"/> 
    บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>



<h3>ค่าใช้จ่ายสมทบจากองค์กรอื่น</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example84"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>จำนวนเงิน</th>
<th>ชื่อโครงการ</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example84" style="padding:10px; background:#fff;">
<h3>ค่าใช้จ่ายสมทบจากองค์กรอื่น (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ค่าใช้จ่ายสมทบจากองค์กรอื่น<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/> 
    บาท (รวมจากรายการค่าใช้จ่าย)</td>
</tr>
<tr>
  <th>แหล่งที่มา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield6" type="text" id="textfield6" style="width:300px;"/>
    <img src="images/see.png" width="24" height="24" /></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>


<h3>กิจกรรม</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example85"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>กิจกรรมตามโครงการ</th>
<th>ระยะเวลา</th>
<th>ค่าใช้จ่าย</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip" />
  <input type="submit" name="button" id="button" title="ลบ" value=" " class="btn_delete vtip" /></td>
</tr>
</table>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example85" style="padding:10px; background:#fff;">
<h3>กิจกรรม (เพิ่ม/แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>กิจกรรมตามโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield9" type="text" id="textfield9" style="width:300px;"/></td>
</tr>
<tr>
  <th>ระยะเวลา<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" style="width:100px;"/></td>
</tr>
<tr>
  <th>ค่าใช้จ่าย<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield10" type="text" id="textfield10" style="width:100px;"/>
บาท</td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>

</div>
</div>
