<script type="text/javascript">
$(document).ready(function(){
	
	if($('input[name=total_1]').val() != 0){
		total_1();
	}
	if($('input[name=total_2]').val() != 0){
		total_2();
	}
	if($('input[name=total_3]').val() != 0){
		total_3();
	}
	if($('input[name=total_4]').val() != 0){
		total_4();
	}
		
	$('input:text').setMask();
	
	var mt_year;
	$("select[name=year]").change(function(){
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom'>").appendTo(".loading-icon");
		
		var round_id = $(this).val();
		mt_year = parseInt($(this + "option:selected").text()) - 543;
		$("input[name=mt_year]").val(mt_year);
		
		$.post('inspect_disbursement/select_round_ajax',{
			'round_id':round_id
		},function(data){
			$(".loading").remove();
			$("#xxx").html(data);
		});
	});
	
	$(".budget").keyup(function(){
		var summary = 0;
		var total = 0;
		$(".budget").each(function(){
			summary += Number($(this).val().replace(/,/g,""));
		});
		$(".sum-budget,input[name=budget]").val(new NumberFormat(summary).toFormatted());
		
		total_1();
		total_2();
		total_3();
		total_4();
	});
	
	$('input[name=total_1]').keyup(function(){
		var percent = 0;
		var budget = Number($("input[name=budget]").val().replace(/,/g,""));
		var total = Number($(this).val().replace(/,/g,""));
		percent = (total/budget)*100;
		$(this).parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
		
		if(Number($("input[name=total_2]").val().replace(/,/g,"")) > 0){
			total_2();
		}
		if(Number($("input[name=total_3]").val().replace(/,/g,"")) > 0){
			total_3();
		}
		if(Number($("input[name=total_4]").val().replace(/,/g,"")) > 0){
			total_4();
		}
	});
	
	$('input[name=total_2]').keyup(function(){
		if(Number($(this).val().replace(/,/g,"")) == 0){
			$(this).parent().next('td').children('input').val(new NumberFormat(0).toFormatted());
		}else{
			var percent = 0;
			var budget = Number($("input[name=budget]").val().replace(/,/g,""));
			var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
			var total = Number($(this).val().replace(/,/g,"")) + total_1;
			percent = (total/budget)*100;
			$(this).parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
		}
		
		if(Number($("input[name=total_3]").val().replace(/,/g,"")) > 0){
			total_3();
		}
		if(Number($("input[name=total_4]").val().replace(/,/g,"")) > 0){
			total_4();
		}
	});
	
	$('input[name=total_3]').keyup(function(){
		if(Number($(this).val().replace(/,/g,"")) == 0){
			$(this).parent().next('td').children('input').val(new NumberFormat(0).toFormatted());
		}else{
			var percent = 0;
			var budget = Number($("input[name=budget]").val().replace(/,/g,""));
			var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
			var total_2 = Number($("input[name=total_2]").val().replace(/,/g,""));
			var total = Number($(this).val().replace(/,/g,"")) + total_1 + total_2;
			percent = (total/budget)*100;
			$(this).parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
		}
		
		if(Number($("input[name=total_4]").val().replace(/,/g,"")) > 0){
			total_4();
		}
	});
	
	$('input[name=total_4]').keyup(function(){
		if(Number($(this).val().replace(/,/g,"")) == 0){
			$(this).parent().next('td').children('input').val(new NumberFormat(0).toFormatted());
		}else{
			var percent = 0;
			var budget = Number($("input[name=budget]").val().replace(/,/g,""));
			var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
			var total_2 = Number($("input[name=total_2]").val().replace(/,/g,""));
			var total_3 = Number($("input[name=total_3]").val().replace(/,/g,""));
			var total = Number($(this).val().replace(/,/g,"")) + total_1 + total_2 + total_3;
			percent = (total/budget)*100;
			$(this).parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
		}
	});
	
	function total_1(){
		var percent = 0;
		var budget = Number($("input[name=budget]").val().replace(/,/g,""));
		var total = Number($("input[name=total_1]").val().replace(/,/g,""));
		percent = (total/budget)*100;
		$("input[name=total_1]").parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
	}
	
	function total_2(){
		var percent = 0;
		var budget = Number($("input[name=budget]").val().replace(/,/g,""));
		var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
		var total = Number($('input[name=total_2]').val().replace(/,/g,"")) + total_1;
		percent = (total/budget)*100;
		$('input[name=total_2]').parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
	}
	
	function total_3(){
		var percent = 0;
		var budget = Number($("input[name=budget]").val().replace(/,/g,""));
		var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
		var total_2 = Number($("input[name=total_2]").val().replace(/,/g,""));
		var total = Number($("input[name=total_3]").val().replace(/,/g,"")) + total_1 + total_2;
		percent = (total/budget)*100;
		$("input[name=total_3]").parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
	}
	
	function total_4(){
		var percent = 0;
		var budget = Number($("input[name=budget]").val().replace(/,/g,""));
		var total_1 = Number($("input[name=total_1]").val().replace(/,/g,""));
		var total_2 = Number($("input[name=total_2]").val().replace(/,/g,""));
		var total_3 = Number($("input[name=total_3]").val().replace(/,/g,""));
		var total = Number($("input[name=total_4]").val().replace(/,/g,"")) + total_1 + total_2 + total_3;
		percent = (total/budget)*100;
		$("input[name=total_4]").parent().next('td').children('input').val(new NumberFormat(percent).toFormatted());
	}
});
</script>
<h3>ผลการเบิกจ่ายงบประมาณ</h3>
<h2>หน่วยงาน <?php echo (@$disbursement['division_title'] == "")?login_data('division_title'):@$disbursement['division_title'];?> <br>จังหวัด <?php echo (@$disbursement['province_title'] == "")?login_data('user_province_title'):@$disbursement['province_title'];?></h2>
<Br><br>
<form action="inspect_disbursement/save<?=$url_parameter;?>" method="post">
<?php if(@$disbursement['id'] > 0): ?>
<table class="tblist">
	<tr>
		<td width="100">ปีงบประมาณ</td>
		<td> 
			<input type="text" name="mt_year" value="<?php echo @$disbursement['mt_year']+543?>" disabled>
		</td>
	</tr>
	<tr>
		<td>รอบการบันทึก</td>
		<td>
			<?php $roundname = $this->round_detail->get_one('round_name',$disbursement['insp_round_detail_id'])?>
			<input type="text" name="insp_round_detail_id" value="<?php echo $roundname?>" size="75" disabled>
			<input type="hidden" name="insp_round_detail_id" value="<?php echo @$disbursement['insp_round_detail_id']?>">
		</td>
	</tr>
</table>
<?php else:?>
<table class="tblist">
	<tr>
		<td width="100">ปีงบประมาณ</td>
		<td>
			<?php echo form_dropdown('year',get_option("id","mt_year+543 as year","insp_round"),@$disbursement['mt_year'],'','-- เลือกปีงบประมาณ --','0')  ?>
			<span class="loading-icon"></span>
		</td>
	</tr>
	<tr>
		<td>รอบการบันทึก</td>
		<td id="xxx">
			<select name="insp_round_detail_id" disabled>
				<option value="">-- เลือกรอบการบันทึก --</option>
			</select>
		</td>
	</tr>
</table>
<?php endif;?>

<br /><br />
<div id="newForm">
<table class="tblist">
	<tbody>
		<tr>
			<th colspan="2">งบประมาณ</th>
		</tr>
		<tr class="odd">
			<td width="350">งบประมาณที่ได้รับ จำนวน</td>
			<td>
				<input type="text" alt="decimal" class="sum-budget" value="<?php echo @$disbursement['budget']?>" disabled> บาท
				<input type="hidden" alt="decimal" name="budget" value="<?php echo @$disbursement['budget']?>">
			</td>
		</tr>
		<tr>
			<td>งบดำเนินงาน</td>
			<td><input class="budget" type="text" alt="decimal" name="statement" value="<?php echo @$disbursement['statement']?>"> บาท</td>
		</tr>
		<tr>
			<td>งบอุดหนุน</td>
			<td><input class="budget" type="text" alt="decimal" name="subsidy" value="<?php echo @$disbursement['subsidy']?>"> บาท</td>
		</tr>
		<tr>
			<td>งบลงทุน</td>
			<td><input class="budget" type="text" alt="decimal" name="investment" value="<?php echo @$disbursement['investment']?>"> บาท</td>
		</tr>
		<tr>
			<td>อื่นๆ (ระบุ)</td>
			<td><input class="budget" type="text" alt="decimal" name="other" value="<?php echo @$disbursement['other']?>"> บาท</td>
		</tr>
	</tbody>
</table>

<br>
<br>
<table class="tblist">
	<tbody>
		<tr>
			<th colspan="4">ผลการเบิกจ่าย</th>
		</tr>
		<tr>
			<td width="350">ไตรมาส ๑</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_1" value="<?php echo @$disbursement['target_1']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input class="total" type="text" alt="decimal" name="total_1" value="<?php echo @$disbursement['total_1']?>"> บาท</td>
			<td>
				คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_1" value="<?php echo @$disbursement['percent_1']?>" size="5" disabled>
				<input type="hidden" alt="decimal" name="percent_1" value="<?php echo @$disbursement['percent_1']?>" size="5">
			</td>
		</tr>
		<tr>
			<td>ไตรมาส ๒</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_2" value="<?php echo @$disbursement['target_2']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input class="total" type="text" alt="decimal" name="total_2" value="<?php echo @$disbursement['total_2']?>"> บาท</td>
			<td>
				คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_2" value="<?php echo @$disbursement['percent_2']?>" size="5" disabled>
				<input type="hidden" alt="decimal" name="percent_2" value="<?php echo @$disbursement['percent_1']?>" size="5">
			</td>
		</tr>
		<tr>
			<td>ไตรมาส ๓</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_3" value="<?php echo @$disbursement['target_3']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input class="total" type="text" alt="decimal" name="total_3" value="<?php echo @$disbursement['total_3']?>"> บาท</td>
			<td>
				คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_3" value="<?php echo @$disbursement['percent_3']?>" size="5" disabled>
				<input type="hidden" alt="decimal" name="percent_3" value="<?php echo @$disbursement['percent_1']?>" size="5">
			</td>
		</tr>
		<tr>
			<td>ไตรมาส ๔</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_4" value="<?php echo @$disbursement['target_4']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input class="total" type="text" alt="decimal" name="total_4" value="<?php echo @$disbursement['total_4']?>"> บาท</td>
			<td>
				คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_4" value="<?php echo @$disbursement['percent_4']?>" size="5" disabled>
				<input type="hidden" alt="decimal" name="percent_4" value="<?php echo @$disbursement['percent_1']?>" size="5">
			</td>
		</tr>
	</tbody>
</table>

<br /><br />
<table class="tblist">
	<tr>
		<td><input id="tar_1" type="radio" name="on_target" value="1" <?php echo @$disbursement['on_target']==1?"checked":"";?>> <label for="tar_1">เป็นไปตามเป้าหมาย</label></td>
	</tr>
	<tr>
		<td><input id="tar_2" type="radio" name="on_target" value="0" <?php echo @$disbursement['on_target']==0?"checked":"";?>> <label for="tar_2">ไม่เป็นไปตามเป้าหมาย</label></td>
	</tr>
</table>

<br /><br />
<table class="tblist">
	<tr>
		<th>เหตุผลที่ล่าช้า</th>
	</tr>
	<tr>
		<td><textarea name="reason" style="width: 100%;height: 200px;"><?php echo @$disbursement['reason']?></textarea></td>
	</tr>
	<tr>
		<td>
			<div id="btnBoxAdd">
				<input type="hidden" name="id" value="<?php echo @$disbursement['id']?>">
				<input type="hidden" name="create_date" value="<?php echo @$disbursement['create_date']?>">
				<input type="hidden" name="mt_year" value="<?php echo @$disbursement['mt_year']?>">
				<input type="hidden" name="division_id" value="<?php echo @$disbursement['division_id']?>"/>
				<input type="hidden" name="province_id" value="<?php echo @$disbursement['province_id']?>">
			    <input name="input" type="submit" title="บันทึก" value=" " class="btn_save">
			    <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back">
			</div>
		</td>
	</tr>
</table>
</div>
</form>