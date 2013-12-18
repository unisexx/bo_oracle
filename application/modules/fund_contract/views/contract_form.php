<link rel="stylesheet" href="js/jquery-autocomplete/lib/thickbox.css" />
<link rel="stylesheet" href="js/jquery-autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery-autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-autocomplete/lib/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="js/jquery-autocomplete/lib/jquery.ajaxQueue.js"></script>
<script type="text/javascript" src="js/jquery-autocomplete/lib/thickbox-compressed.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	<?php 			
		foreach($attorney as $o){
			$name[]=$o['name'];
		}
		$arr_name=implode("/",$name);
	?>
	
 	var str_name='<?php echo trim($arr_name); ?>';	
	var arr_name = str_name.split("/");	
 	
	$("#funding_name").autocomplete( arr_name );		
	$("#funding_name").autocomplete( arr_name , {
		//multiple: true, //ยอมให้ป้อนได้หลายค่า
		//mustMatch: true, //ป้อนได้เฉพาะค่าที่เตรียมไว้ให้
		autoFill: true, //เติมคำอัตโนมัติ
		matchContains: true //หาค่าที่ไม่ใช่ตัวเริ่มต้น
	});
	
	$('input:text').setMask();
	
	$('#addAttach').click(function(){
		$('#fileField').clone().removeAttr('id').appendTo('#xxx');
	});
	
	radioChk('<?=$contract['type']?>');
	radioChk('<?=$contract['funding_type']?>');
	
	function radioChk(value){
		$('input:radio').each(function(){
			var radioVal = $(this).val();
			if(radioVal == value){
				$(this).attr('checked',true);
			}
		});
	}
	
	selectChk('status','<?=$contract['status']?>');
	
	function selectChk(name,value){
		$('select[name='+name+'] option[value='+value+']').attr('selected', 'selected')
	}
	
	$('input[type=submit]').click(function(){
		$('input[name=amount]').val($('input[name=amount]').val().replace(/[^0-9\.]+/g,""));
	});
	
	$("form").validate({
		rules: {
			type:"required",
			contract_number_1:"required",
			contract_number_2:"required",
			made_at:"required",
			funding_type:"required",
			funding_name:"required",
			order:"required",
			order_date:"required",
			recipient:"required",
			project:"required",
			amount:"required",
			approve_date:"required"
		},
		messages:{
			type:"กรุณาระบุข้อมูลด้วย",
			contract_number_1:"กรุณาระบุข้อมูลด้วย",
			contract_number_2:"กรุณาระบุข้อมูลด้วย",
			made_at:"กรุณาระบุข้อมูลด้วย",
			funding_type:"กรุณาระบุข้อมูลด้วย",
			funding_name:"กรุณาระบุข้อมูลด้วย",
			order:"กรุณาระบุข้อมูลด้วย",
			order_date:"กรุณาระบุข้อมูลด้วย",
			recipient:"กรุณาระบุข้อมูลด้วย",
			project:"กรุณาระบุข้อมูลด้วย",
			amount:"กรุณาระบุข้อมูลด้วย",
			approve_date:"กรุณาระบุข้อมูลด้วย"
		}
	});
	
	$('.box_file_main ul.show_file li span input.cursor').click(function(){
		if (confirm ("คุณต้องการลบไฟล์นี้หรือไม่?")) {
			$.get('fund_contract/delete_file', {
				'attach_id': $(this).siblings('input.attach').val()
			});
			$(this).parent().parent('li').fadeOut();
		}
	});
	
	$("#find_project").click(function(){
		$(this).colorbox({inline:true, href:"#pjblock", width:"80%", height:"65%"});
	});
	
	$("#find_organize").click(function(){
		$(this).colorbox({inline:true, href:"#orgblock", width:"80%", height:"65%"});
	});
	
	var current_val = 0;
	var tmp_val = 0;

	$("#amount").keyup(function(){
		var fundiongType = $('input[name=funding_type]:checked').val();
		if(fundiongType == 3){
			current_val = Number($("#amount").val().replace(/[^0-9\.]+/g,""));
			tmp_val = Number($("#tmp_amount").val().replace(/[^0-9\.]+/g,""));
			if(current_val > 15000){	 				
				$("#amount").val(new NumberFormat(tmp_val).toFormatted());
			}else{					
				$("#tmp_amount").val(new NumberFormat(current_val).toFormatted());
			}
		}
	});
});
</script>
<h3>สัญญารับเงินอุดหนุน (เพิ่ม / แก้ไข)</h3>
<form method="post" action="fund_contract/save" enctype="multipart/form-data">
<table class="tbadd">
<tr>
  <th>ประเภท <span class="Txt_red_12">*</span></th>
  <td>
  	<label for="x1"><input id="x1" type="radio" name="type" value="กองทุนคุ้มครองเด็ก" /> กองทุนคุ้มครองเด็ก</label>
  	<label for="x2"><input type="radio" name="type" value="กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์" /> กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</label>
  	<label for="x3"><input type="radio" name="type" value="กองทุนส่งเสริมการจัดสวัสดิการสังคม" /> กองทุนส่งเสริมการจัดสวัสดิการสังคม</label>
  </td>
</tr>
<tr>
  <th>สัญญาเลขที่<span class="Txt_red_12"> *</span></th>
  <td> 
	<input name="contract_number_1" type="text" id="date_1" style="width:50px;" value="<?=$contract['contract_number_1']?>" maxlength="" />/
	<input name="contract_number_2" type="text" id="date_2" style="width:50px;" value="<?=$contract['contract_number_2']?>" maxlength="4" />    
  </td>
</tr>
<tr>
  <th>สัญญาฉบับนี้ทำขึ้น ณ  <span class="Txt_red_12">*</span></th>
  <td>
  	<input type="text" name="made_at" style="width:350px;" value="<?=($contract['user_id']!="")?$contract['made_at']:login_data("workgroup_title");?>" />
  </td>
</tr>
<tr>
  <th>เมื่อวันที่  <span class="Txt_red_12">*</span></th>
  <td>
    <input name="made_date" type="text" size="10" class="datepicker" value="<?php if(@$contract['made_date']!='0'){ echo @stamp_to_th($contract['made_date']);} ?>"/>
  </td>
</tr>
<tr>
  <th>ผู้ให้เงินอุดหนุน <span class="Txt_red_12">*</span></th>
  <td>
  	<input type="radio" name="funding_type" value="1" onclick="document.getElementById('textposition').value='ปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์';" />
    ปลัด พม.
    <input type="radio" name="funding_type" value="2" onclick="document.getElementById('textposition').value='ปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์';"/>
    รองปลัด  พม.
    <input type="radio" id="pmgChk" name="funding_type" value="3" onclick="document.getElementById('textposition').value='';"/>
    มอบอำนาจ พมจ.   
    <input id="funding_name" name="funding_name" type="text" style="width:300px;" value="<?=$contract['funding_name']?>" />
  </td>
</tr>
<tr>
  <th>ตำแหน่ง</th>
  <td>
  	<input type="text" name="position" id="textposition" style="width:300px;" value="<?=$contract['position']?>" />
  </td>
</tr>
<tr>
  <th>ตามคำสั่งที่ <span class="Txt_red_12">*</span></th>
  <td>
  	<input name="order" type="text" style="width:100px;" value="<?=$contract['order']?>" /> ลงวันที่
    <input name="order_date" type="text" size="10" class="datepicker" value="<?php if(@$contract['order_date']!='0'){ echo @stamp_to_th($contract['order_date']);} ?>"/>
  </td>
</tr>
<tr>
  <th>ผู้รับเงินอุดหนุน <span class="Txt_red_12">*</span></th>
  <td>
  	<input type="text" name="recipient" value="<?=$contract['recipient']?>" style="width:300px;" />
  </td>
</tr>
<tr>
  <th>โครงการ / กิจกรรม <span class="Txt_red_12">*</span></th>
  <td>
  	<input type="text" name="project" value="<?=$contract['project']?>" style="width:350px;" disabled='disabled' />
  	<input type="hidden" name="project" value="<?=$contract['project']?>">
    <input type="button" value=" ค้นหา " id="find_project" />
  </td>
</tr>
<tr>
  <th>องค์กร/หน่วยงานที่รับเงินอุดหนุน</th>
  <td>
  	<input name="organization" type="text" value="<?=$contract['organization']?>" style="width:400px;" value="" />
  	<input type="hidden" name="organize_id" value="<?=$contract['organize_id']?>">
    <input type="button" value=" ค้นหา " id="find_organize" />
  </td>
</tr>
<tr>
  <th>จำนวนเงิน <span class="Txt_red_12">*</span></th>
  <td>
  	<input type="text" id="amount" name="amount" value="<?=$contract['amount']?>" alt="decimal" /> บาท <!-- (จำนวนเงินกับในระบบ app4 ไม่ตรงกัน) -->
  	<input type="hidden" id="tmp_amount" name="tmp_amount" value="<?=$contract['amount']?>" alt="decimal" />
  </td>
</tr>
<tr>
  <th>ได้รับอนุมัติวันที่ <span class="Txt_red_12">*</span></th>
  <td>
  	<input name="approve_date" type="text" size="10" class="datepicker" value="<?php if(@$contract['approve_date']!='0'){ echo @stamp_to_th($contract['approve_date']);} ?>"/>
  </td>
</tr>
<tr>
  <th>ไฟล์เอกสารแนบ <input type="button" name="button2" id="addAttach" value=" เพิ่ม " /></th>
  <td id='xxx'>
  	
		<?php if(@$attach):?>
		<div class="box_file_main" style="width:600px;">
				<ul class="show_file">
		<?php foreach($attach as $key=>$file):?>
					<li>
						<a href="fund_contract/download_file/<?php echo $file['id']?>"><?php echo $file['attach_name']?></a>			
						<span>
							<input type="button" title="ลบ" class="cursor" name="del" value=" x ">
							<input class="attach" type="hidden" value="<?php echo $file['id']?>">
						</span>
					</li>
		<?php endforeach;?>
				</ul>
		</div>
		<br clear="all">
		<?php endif;?>
									
  	<input type="file" name="attach[]" class="fileField" id="fileField" style="display:block; margin:5px 0 0 0;" />
  </td>
</tr>
<tr>
  <th>สถานะ</th>
  <td>
  	<select name="status" id="select">
    <option value="สัญญาใหม่">สัญญาใหม่</option>
    <option value="ตรวจสอบถูกต้องแล้ว">ตรวจสอบถูกต้องแล้ว</option>
    <option value="กลับไปแก้ไขสัญญา">กลับไปแก้ไขสัญญา</option>
  	</select>
  </td>
</tr>
<tr>
  <th>หมายเหตุกรณีส่งกลับไปแก้ไข</th>
  <td>
  	<textarea name="send_back" id="textarea" style="width:400px; height:80px;"><?=$contract['send_back']?></textarea>
  </td>
</tr>
</table>

<div id="btnBoxAdd">
  <input name="id" type="hidden" value="<?=$contract['id']?>">
  <input name="user_id" type="hidden" value="<?=($contract['user_id']!="")?$contract['user_id']:login_data("id");?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>

<!-- project colorbox -->
<script type="text/javascript">
$(document).ready(function(){
	$("#searchSubmit").click(function(){
		$("<img class='loading' src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#loadingicon");
		var projectName = $('input[name=project_name]').val();
		$.get('fund_contract/ajax_search_project',{
			'projectName':projectName
		},function(data){
			$('#result').html(data);
			$('.loading').remove();
		});
	});
	
	$(".pjlist").livequery('click',function(){
		$('input[name="project"]').val($(this).text());
		$.colorbox.close();
	});
});
</script>
<div style="display:none;">
<div id="pjblock" style='padding:10px; background:#fff;'>
	<h3>เลือกโครงการ</h3>
	<div class="paddT20"></div>
	โครงการ / กิจกรรม <input type="text" name="project_name" value="" style="width:300px;">
	<input type="button" id="searchSubmit" value=" ค้นหา "><div id="loadingicon" style="display:inline;"></div>
	<div id="result"></div>
</div>
</div>


<!-- organize colorbox -->
<script type="text/javascript">
$(document).ready(function(){
	$("#searchSubmit2").click(function(){
		$("<img class='loading' src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#loadingicon");
		var organizeName = $('input[name=organize_name]').val();
		$.get('fund_contract/ajax_search_organize',{
			'organizeName':organizeName
		},function(data){
			$('#result2').html(data);
			$('.loading').remove();
		});
	});
	
	$('.ozlist').livequery('click',function(){
		$('input[name=organization]').val($(this).text());
		$('input[name=organize_id]').val($(this).find('input[name=org_id]').val());
		$.colorbox.close();
	});
});
</script>
<div style="display: none;">
<div id="orgblock" style="padding:10px; background:#fff;">
	<h3>เลือกหน่วยงาน</h3>
	<div class="paddT20"></div>
	ชื่อองค์กร / หน่วยงาน <input type="text" name="organize_name" value="" style="width:300px;">
	<input type="button" id="searchSubmit2" value=" ค้นหา "><div id="loadingicon" style="display:inline;"></div>
	<div id="result2"></div>
</div>
</div>
