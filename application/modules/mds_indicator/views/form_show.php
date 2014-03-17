<style>
	.btn_savesend {
		width: 129px;
		height: 28px;
		border: none;
		background: transparent url(images/btn_savesend.gif) no-repeat center;
		overflow: hidden;
		line-height: 0px;
		display: inline;
		color: #a63606;
		cursor: pointer;
		cursor: hand;
		margin-top: 5px;
	}
	input, textarea, .uneditable-input {
	margin-left: 0;
	}
	
</style>
<script language="JavaScript">
$(function(){
	function cal_weight(){
	
		var weight_perc_tot = $('#weight_perc_tot').val();
		var score_mertics = $('#score_mertics').val();
		var metrics_weight = $('#metrics_weight').val();
		
		var cal = (score_mertics*metrics_weight)/weight_perc_tot;
			cal =cal.toFixed(4);
		$('[name=score_weight]').html(cal); // ปัดเศษ
	}
	
	 cal_weight();

});
</script>
<h3>ตัวชี้วัด  มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?></h3>
<div align="center">
<div style="border: 2px solid;border-color: #999999;width: 80%;margin-top: 10px;text-align: center">
	<table width="100%" style="margin-top: 10px;text-align: center;">
		<tr>
			<td style="font-size: 16px;" colspan="4"><b>รายงานผลการปฎิบัติราชการตามคำรับรองฯ (รายตัวชี้วัด)</b></td>
		</tr>
		<tr>
			<td style="font-size: 16px;text-align: right;" colspan="4"><b>รอบ <?=@$round_month?> เดือน</b><span style="margin-left: 20px;">&nbsp;</span></td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 10px;">&nbsp;</span><b>ชื่อตัวชี้วัด</b></td>
			<td style="text-align: left;padding-top: 10px" colspan="3">
				<?=@$rs['mds_set_metrics_name']?>
				<?=(empty($keyer_activity['activity']))?'':' ('.$keyer_activity['activity'].')'?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 10px;">&nbsp;</span><b>ผู้กำกับดูแลตัวชี้วัด</b></td>
			<td style="text-align: left;width: 40%;padding-top: 10px"><?=@$kpr['pos_name']." (".@$kpr['control_name'].")"?><span style="margin-right: 10px;">&nbsp;</span></td>
			<td style="width: 15%;text-align: left;padding-top: 10px"><b>ผู้จัดเก็บข้อมูล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px">
				<? foreach ($keyer as $key => $temp_keyer) {
					 if($key == '0'){
					 	echo $temp_keyer['keyer_name'];
					 }else{
					 	echo ' , '.$temp_keyer['keyer_name'];
					 }
				   } ?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 10px;">&nbsp;</span><b>โทรศัพท์ผู้กำกับดูแล</b></td>
			<td style="text-align: left;width: 40%;padding-top: 10px"><?=(empty($kpr['control_tle']))?'-':$kpr['control_tle'];?><span style="margin-right: 10px;">&nbsp;</span></td>
			<td style="width: 15%;text-align: left;padding-top: 10px"><b>โทรศัพท์ผู้จัดเก็บข้อมูล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px">
				<? foreach ($keyer as $key => $temp_keyer) {
					 if($key == '0'){
					 	echo (empty($temp_keyer['keyer_tel']))?'-':$temp_keyer['keyer_tel'];
					 }else{
					 	echo ' , ';
					 	echo (empty($temp_keyer['keyer_tel']))?'-':$temp_keyer['keyer_tel'];
					 }
				   } ?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 10px;">&nbsp;</span><b>อีเมลล์ผู้กำกับดูแล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px" colspan="3"><?=(empty($kpr['control_email']))?'-':$kpr['control_email'];?></td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 20px" colspan="4"><span style="margin-right: 10px;">&nbsp;</span><b><u>การคำนวณคะแนนจากผลการดำเนินงาน</u></b></td>
		</tr>
		<tr>
			<td colspan="4">
				<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333" style="margin-top: 10px;">
                                  <tbody>
                                  <tr>
                                    <td width="45%"><div align="center"><strong>ตัวชี้วัด / ข้อมูลพื้นฐานประกอบตัวชี้วัด </strong></div></td>
                                    <td width="15%"><div align="center"><strong>น้ำหนัก<br>
                                      (ร้อยละ)</strong></div></td>
                                    <td width="14%"><div align="center"><strong>ผลการดำเนินงาน</strong></div></td>
                                    <td width="13%"><div align="center"><strong>ค่าคะแนนที่ได้</strong></div></td>
                                    <td width="13%"><div align="center"><strong>ค่าคะแนน<br>ถ่วง<br>น้ำหนัก</strong></div></td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: left;"><?=@$rs['mds_set_metrics_name']?></td>
                                    <td style="height: 50px"><center>
                                    	<? 
                                    		$metrics_weight = '';
                                    		if(@$rs_metrics['metrics_weight_6'] != '' && $round_month == '6'){
                                    			$metrics_weight = $rs_metrics['metrics_weight_6'];
                                    		}else if(@$rs_metrics['metrics_weight_9'] != '' && $round_month == '9'){
                                    			$metrics_weight = $rs_metrics['metrics_weight_9'];
											}else if(@$rs_metrics['metrics_weight_12'] != '' && $round_month == '12'){
												$metrics_weight = $rs_metrics['metrics_weight_12'];
											}else{
												$metrics_weight = $rs_metrics['metrics_weight'];
											}
							
                                    	
										?>
                                        <input type="hidden" name="metrics_weight" style="width: 60px" size="7" value="<?=@$metrics_weight?>"  id="metrics_weight" readonly="readonly" style="color:#999999">
                                        <input type="hidden" name="weight_perc_tot" id="weight_perc_tot" value="<?=@$weight_perc_tot?>">
                                        <?=@$metrics_weight?>
                                    </center></td>
                                    <td><center>
                                      <input type="hidden" name="result_metrics" style="width: 60px" size="7" id="result_metrics" value="<?=(empty($rs['result_metrics']))?'N/A':$rs['result_metrics'];?>" >
                                    </center><?=@$rs['result_metrics']?></td>
                                    <td id="ac"><center> 
                                    <input type="hidden" name="score_metrics" style="width: 60px" id="score_mertics" size="7" value="<?=@$score['score_metrics']?>"  maxlength="6" class="numDecimal2" >
                                    </center><?=@$score['score_metrics']?></td>
                                    <td id="score_weight"><center>
                                      <span name="score_weight"></span>
                                    </center> 
                                    </td>
                                  </tr>
                              </tbody>
                 </table>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 20px" colspan="4"><span style="margin-right: 10px;">&nbsp;</span><b><u>แบบฟอร์มรายงาน</u></b></td>
		</tr>
		<tr>
			<td colspan="5"  style="text-align: left;padding-top: 10px">
				<?
					if(@$rs['id'] != ''){
					
						$sql_doc = "SELECT DISTINCT DOC.* , MDS_METRICS_RESULT.KEYER_USERS_ID , MDS_SET_METRICS_KEYER.ID AS KEYER_ID
									FROM MDS_METRICS_DOCUMENT DOC
									LEFT JOIN MDS_METRICS_RESULT ON DOC.MDS_METRICS_RESULT_ID = MDS_METRICS_RESULT.ID
									LEFT JOIN MDS_SET_METRICS ON MDS_METRICS_RESULT.MDS_SET_METRICS_ID = MDS_SET_METRICS.ID
									JOIN MDS_SET_METRICS_KEYER ON MDS_SET_METRICS.ID = MDS_SET_METRICS_KEYER.MDS_SET_METRICS_ID 
													  AND MDS_METRICS_RESULT.ROUND_MONTH = MDS_SET_METRICS_KEYER.ROUND_MONTH 
														AND MDS_SET_METRICS_KEYER.KEYER_USERS_ID = MDS_METRICS_RESULT.KEYER_USERS_ID
									WHERE  DOC.TYPE_DOC = '1' AND MDS_METRICS_RESULT.MDS_SET_METRICS_ID = '".$rs_metrics['id']."' 
												 AND MDS_METRICS_RESULT.ROUND_MONTH = '".$round_month."' ORDER BY KEYER_ID ASC";
						$result_doc = $this->doc->get($sql_doc,'true');
						foreach ($result_doc as $key => $doc) { ?>
							<div>
								<span style="margin-right: 40px;">&nbsp;</span>
								<div style="width: 900px;display: inline-block">
								<a target="_blank" href="uploads/mds/<?=@$doc['doc_name_upload']?>"><?=@$doc['doc_name_upload']?></a>
								<span style="margin-left: 10px"><?php echo chk_premission_dtl($doc['keyer_users_id'],$rs_metrics['id'],$round_month); ?></span>
								</div>
							</div>
						<?}
					}
					
					if(count(@$result_doc) == '0'){
				?>
					<span style="margin-right: 40px;">&nbsp;</span>
					<input type="file" name="document_plan">
				<? } ?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 20px" colspan="4">
				<span style="margin-right: 10px;">&nbsp;</span><b><u>หลักฐานอ้างอิง</u></b>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: left;padding-top: 10px">
				<? 	$num_ref = 1;
					if(@$rs['id'] != ''){
					
						$sql_doc_ref = "SELECT DISTINCT DOC.* , MDS_METRICS_RESULT.KEYER_USERS_ID , MDS_SET_METRICS_KEYER.ID AS KEYER_ID
										FROM MDS_METRICS_DOCUMENT DOC
										LEFT JOIN MDS_METRICS_RESULT ON DOC.MDS_METRICS_RESULT_ID = MDS_METRICS_RESULT.ID
										LEFT JOIN MDS_SET_METRICS ON MDS_METRICS_RESULT.MDS_SET_METRICS_ID = MDS_SET_METRICS.ID
										JOIN MDS_SET_METRICS_KEYER ON MDS_SET_METRICS.ID = MDS_SET_METRICS_KEYER.MDS_SET_METRICS_ID 
														  AND MDS_METRICS_RESULT.ROUND_MONTH = MDS_SET_METRICS_KEYER.ROUND_MONTH 
															AND MDS_SET_METRICS_KEYER.KEYER_USERS_ID = MDS_METRICS_RESULT.KEYER_USERS_ID
										WHERE  DOC.TYPE_DOC = '2' AND MDS_METRICS_RESULT.MDS_SET_METRICS_ID = '".$rs_metrics['id']."' 
													 AND MDS_METRICS_RESULT.ROUND_MONTH = '".$round_month."' ORDER BY KEYER_ID ASC";
						$result_doc_ref = $this->doc->get($sql_doc_ref,'true');
						foreach ($result_doc_ref as $key => $doc_ref) {?>
							<div style="margin-top: 10px">
								<span style="margin-right: 40px;">&nbsp;</span><?=$key+1?>. 
								<div style="width: 900px;display: inline-block">
									<a target="_blank" href="uploads/mds/<?=@$doc_ref['doc_name_upload']?>"><?=@$doc_ref['doc_name_upload']?></a>
								</div>
								<span style="margin-left: 10px"><?php echo chk_premission_dtl($doc_ref['keyer_users_id'],$rs_metrics['id'],$round_month); ?></span>
							</div>
					<?		
						}
					
				  } ?>
				<div id="document_ref"></div>
				<input type="hidden" name="num_ref" id="num_ref" value="<?=@$num_ref?>" />
			</td>
		</tr>
		<tr><td style="padding-top: 20px"></td></tr>
	</table>
</div>
</div>