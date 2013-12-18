<script type="text/javascript">
$(document).ready(function(){
	$('input:text').setMask();
});
</script>

<table class="tblist">
	<tbody>
		<tr>
			<th colspan="2">งบประมาณ</th>
		</tr>
		<tr>
			<td>งบประมาณที่ได้รับ จำนวน</td>
			<td><input type="text" alt="decimal" name="budget" value="<?php echo @$disbursement['budget']?>"> บาท</td>
		</tr>
		<tr>
			<td>งบดำเนินงาน</td>
			<td><input type="text" alt="decimal" name="statement" value="<?php echo @$disbursement['statement']?>"> บาท</td>
		</tr>
		<tr>
			<td>งบอุดหนุน</td>
			<td><input type="text" alt="decimal" name="subsidy" value="<?php echo @$disbursement['subsidy']?>"> บาท</td>
		</tr>
		<tr>
			<td>งบลงทุน</td>
			<td><input type="text" alt="decimal" name="investment" value="<?php echo @$disbursement['investment']?>"> บาท</td>
		</tr>
		<tr>
			<td>อื่นๆ (ระบุ)</td>
			<td><input type="text" alt="decimal" name="other" value="<?php echo @$disbursement['other']?>"> บาท</td>
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
			<td width="410">ไตรมาส ๑</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_1" value="<?php echo @$disbursement['target_1']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input type="text" alt="decimal" name="total_1" value="<?php echo @$disbursement['total_1']?>"> บาท</td>
			<td>คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_1" value="<?php echo @$disbursement['percent_1']?>" size="5"></td>
		</tr>
		<tr>
			<td>ไตรมาส ๒</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_2" value="<?php echo @$disbursement['target_2']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input type="text" alt="decimal" name="total_2" value="<?php echo @$disbursement['total_2']?>"> บาท</td>
			<td>คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_2" value="<?php echo @$disbursement['percent_2']?>" size="5"></td>
		</tr>
		<tr>
			<td>ไตรมาส ๓</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_3" value="<?php echo @$disbursement['target_3']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input type="text" alt="decimal" name="total_3" value="<?php echo @$disbursement['total_3']?>"> บาท</td>
			<td>คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_3" value="<?php echo @$disbursement['percent_3']?>" size="5"></td>
		</tr>
		<tr>
			<td>ไตรมาส ๔</td>
			<td>เป้าหมาย <input type="text" alt="decimal" name="target_4" value="<?php echo @$disbursement['target_4']?>" size="4" maxlength="3"> %</td>
			<td>จำนวน <input type="text" alt="decimal" name="total_4" value="<?php echo @$disbursement['total_4']?>"> บาท</td>
			<td>คิดเป็นร้อยละ <input type="text" alt="decimal" name="percent_4" value="<?php echo @$disbursement['percent_4']?>" size="5"></td>
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
				<input type="hidden" name="mt_year" value="<?php echo @$mt_year?>">
				<input type="hidden" name="division_id" value="<?php echo login_data("divisionid");?>"/>
				<input type="hidden" name="province_id" value="<?php echo login_data("user_province_id");?>">
			    <input name="input" type="submit" title="บันทึก" value=" " class="btn_save">
			    <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back">
			</div>
		</td>
	</tr>
</table>