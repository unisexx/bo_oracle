<table class="tbadd">
<tr>
  <th><img src="themes/mdevsys/images/circle_0.png" alt="" width="16" height="16" /></th>
  <td>ยังไม่ผ่านการรับรอง</td>
</tr>
<?
	for ($i=1; $i <= 5 ; $i++) { 
		$sql_score = "select * from mds_set_score where score_id = '".$i."' and budget_year = '".@$budget_year."' ";
		$score = $this->score->get($sql_score); $score=@$score['0'];
	 
?>
<tr>
  <input type="hidden" name="id_<?=@$i?>" id="id_<?=@$i?>" value="<?=@$score['id']?>" />
  <th><img src="themes/mdevsys/images/circle_<?=@$i?>.png" width="16" height="16" /><span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="val_start_<?=@$i?>" id="val_start_<?=@$i?>"style="width:50px;" value="<?php echo @$score['val_start'];?>" class="numDecimal"  /> 
    - 
    <input type="text" name="val_end_<?=@$i?>" id="val_end_<?=@$i?>"style="width:50px;" value="<?php echo @$score['val_end'];?>" class="numDecimal"  />
  	<div id="error_<?=@$i?>"></div>
  </td>
</tr>

<?
	}
?>
</table>