<script type="text/javascript">
$(document).ready(function(){
	$('select:not(:first)').attr('disabled',true);
	
	$('select[name=province]').livequery("change",function(){
		$('select:not(:first)').val($('select option:first').val()).attr('disabled',true);
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom;'>").appendTo(".loadingicon:eq(0)");
		var province_id = $(this).val();
		$.post("fund_organize/select_district_ajax",{
			'province_id':province_id
		},function(data){
			$("#district").html(data);
			$(".loading").remove();
		});
	});
	
	$('select[name=district]').livequery('change',function(){
		$('select:eq(2)').val($('select:eq(2) option:first').val()).attr('disabled',true);
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom;'>").appendTo(".loadingicon:eq(1)");
		var district_id = $(this).val();
		$.post('fund_organize/select_sub_ajax',{
			'district_id':district_id
		},function(data){
			$('#subdistrict').html(data);
			$(".loading").remove();
		});
	});
});
</script>

<h3>ตั้งค่า องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน   (บันทึก / แก้ไข)</h3>
<form method="post" action="fund_organize/save">
<table class="tbadd">
	<tr>
	  <th>ชื่อองค์กร/หน่วยงาน<span class="Txt_red_12"> *</span></th>
	  <td>
	  	<?=$organize->org_name;?>
	  </td>
	</tr>
	<tr>
	  <th>อยู่เลขที่ <span class="Txt_red_12">*</span></th>
	  <td>
	  	<?=$organize->org_home_no;?>
	  </td>
	</tr>
	<tr>
	  <th>หมู่ที่<span class="Txt_red_12"> *</span></th>
	  <td>
	  	<?=$organize->org_moo;?>
	  </td>
	</tr>
	<tr>
	  <th>ถนน <span class="Txt_red_12">*</span></th>
	  <td>
	  	<?=$organize->org_road;?>
	  </td>
	</tr>
	<tr>
	  <th>ตำบล/แขวง <span class="Txt_red_12">*</span></th>
	  <td id="subdistrict">
	  	<?php echo $organize->org_tumbon_name;?>
	  </td>
	</tr>
	<tr>
	  <th>อำเภอ/เขต <span class="Txt_red_12">*</span></th>
	  <td id="district">
		<?php echo $organize->org_ampor_name;?>
	  </td>
	</tr>	
	<tr>
	  <th>จังหวัด <span class="Txt_red_12">*</span></th>
	  <td>
	  	<?=$organize->org_province_name;?>	  	
	  </td>
	</tr>	
	<tr>
	  <th>รหัสไปรษณีย์</th>
	  <td>
	  	<?=$organize->org_postcode;?>
	  </td>
	</tr>
</table>

<div id="btnBoxAdd">
	<input name="id" type="hidden" value="<?=$organize['id']?>">	
	<input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>