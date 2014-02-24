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
		$("form").validate({
				rules: {
					result_comment:{ required : function(element) {
	        				return $("#control_status:checked").val() == '2' || $("#kpr_status:checked").val() == '2';}
	        			  }
				},
				messages:{
					result_comment:{required:"กรุณาระบุหมายเหตุ" }
					
				}
		});
	function cal_weight(){
	
		var weight_perc_tot = $('#weight_perc_tot').val();
		var score_mertics = $('#score_mertics').val();
		var metrics_weight = $('#metrics_weight').val();
		
		var cal = (score_mertics*metrics_weight)/weight_perc_tot;
			cal =cal.toFixed(4);
		$('[name=score_weight]').html(cal); // ปัดเศษ
	}
	
	 cal_weight();
	function control_status(){
		
			if($('#control_status:checked').val() == 2){
				$('.comment_control').show();
			}else{
				$('.comment_control').hide();
			}
		
	}
	$('#control_status').live('click',function(){ control_status(); });
	control_status();
	
	function kpr_status(){
		
			if($('#kpr_status:checked').val() == 2){
				$('.comment_kpr').show();
			}else{
				$('.comment_kpr').hide();
			}
	}
	$('#kpr_status').live('click',function(){ kpr_status(); });
	kpr_status();
	
	$('.btn_save_control').live('click', function(){
		$('#permit_type_id').val('2');
		$( "#Myform" ).submit();
	});
	$('.btn_save_kpr').live('click', function(){
		$('#permit_type_id').val('1');
		$( "#Myform" ).submit();
	});
});
</script>
<h3>บันทึก ตรวจรับรองผลการทำตัวชี้วัด  มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?> (บันทึก / แก้ไข)</h3>
<? if(@$rs['is_save'] == '2'){ ?>
<form enctype="multipart/form-data" action="<?php echo $urlpage;?>/save" id="Myform" method="POST">
<? } ?>
	<input type="hidden" name="mds_set_metrics_id" id="mds_set_metrics_id" value="<?=@$rs_metrics['id']?>" />
	<input type="hidden" name="mds_set_indicator_id" id="mds_set_indicator_id" value="<?=@$rs_indicator['id']?>"/>
	<input type="hidden" name="keyer_users_id" id="keyer_users_id" value="<?=@$rs['keyer_users_id']?>" />
	<input type="hidden" name="id" id="id" value="<?=@$rs['id']?>" />
	<input type="hidden" name="permit_type_id" id="permit_type_id" value="" />
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
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 20px;">&nbsp;</span><b>ชื่อตัวชี้วัด</b></td>
			<td style="text-align: left;padding-top: 10px" colspan="3">
				<?=@$rs['mds_set_metrics_name']?>
				<?=(empty($keyer_activity['activity']))?'':' ('.$keyer_activity['activity'].')'?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 20px;">&nbsp;</span><b>ผู้กำกับดูแลตัวชี้วัด</b></td>
			<td style="text-align: left;width: 40%;padding-top: 10px"><?=@$kpr['pos_name']." (".@$kpr['name'].")"?><span style="margin-right: 20px;">&nbsp;</span></td>
			<td style="width: 15%;text-align: left;padding-top: 10px"><b>ผู้จัดเก็บข้อมูล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px">
				<?=@$keyer_activity['name']; ?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 20px;">&nbsp;</span><b>โทรศัพท์ผู้กำกับดูแล</b></td>
			<td style="text-align: left;width: 40%;padding-top: 10px"><?=(empty($kpr['tle']))?'-':$kpr['tle'];?><span style="margin-right: 20px;">&nbsp;</span></td>
			<td style="width: 15%;text-align: left;padding-top: 10px"><b>โทรศัพท์ผู้จัดเก็บข้อมูล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px">
				<?=(empty($keyer_activity['tel']))?'-':$keyer_activity['tel']; ?>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 10px"><span style="margin-right: 20px;">&nbsp;</span><b>อีเมลล์ผู้กำกับดูแล</b></td>
			<td style="text-align: left;width: 30%;padding-top: 10px" colspan="3"><?=(empty($kpr['email']))?'-':$kpr['email'];?></td>
		</tr>
		<tr>
			<td style="width: 15%;text-align: left;padding-top: 20px" colspan="4"><span style="margin-right: 20px;">&nbsp;</span><b><u>การคำนวณคะแนนจากผลการดำเนินงาน</u></b></td>
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
			<td style="width: 15%;text-align: left;padding-top: 20px" colspan="4"><span style="margin-right: 20px;">&nbsp;</span><b><u>แบบฟอร์มรายงาน</u></b></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: left;padding-top: 10px">
				<?
					if(@$rs['id'] != ''){
					
						$sql_doc = "SELECT * FROM MDS_METRICS_DOCUMENT WHERE MDS_METRICS_RESULT_ID = '".@$rs['id']."' AND TYPE_DOC = '1' ";
						$result_doc = $this->doc->get($sql_doc,'true');
						foreach ($result_doc as $key => $doc) { ?>
							<div>
								<span style="margin-right: 40px;">&nbsp;</span>
								<div style="width: 420px;display: inline-block">
								<a target="_blank" href="uploads/mds/<?=@$doc['doc_name_upload']?>"><?=@$doc['doc_name']?></a>
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
				<span style="margin-right: 20px;">&nbsp;</span><b><u>หลักฐานอ้างอิง</u></b>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: left;padding-top: 10px">
				<? 	$num_ref = 1;
					if(@$rs['id'] != ''){
					
						$sql_doc_ref = "SELECT * FROM MDS_METRICS_DOCUMENT WHERE MDS_METRICS_RESULT_ID = '".@$rs['id']."' AND TYPE_DOC = '2' ";
						$result_doc_ref = $this->doc->get($sql_doc_ref,'true');
						foreach ($result_doc_ref as $key => $doc_ref) {?>
							<div style="margin-top: 10px">
								<span style="margin-right: 40px;">&nbsp;</span><?=$key+1?>. 
								<div style="width: 405px;display: inline-block">
									<a target="_blank" href="uploads/mds/<?=@$doc_ref['doc_name_upload']?>"><?=@$doc_ref['doc_name']?></a>
								</div>
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
<div align="center"> <!-- ส่วนของผู้กำกับตัวชี้วัด -->
<div style="border: 2px solid;border-color: #999999;width: 80%;margin-top: 10px;text-align: center">
	<table width="100%" border="0">
            <tbody>
            <tr>
              <th style="padding-top: 20px"><span style="margin-right: 20px;">&nbsp;</span><strong>รับรองผลการดำเนินงานจากผู้กำกับดูแลตัวชี้วัด</strong></th>
            </tr>
            <tr>
              <? 				$sql_chk_status = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,RESULT_STATUS.RESULT_COMMENT,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS
												FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
												LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
												WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$rs['id']."' AND RESULT_STATUS.PERMIT_TYPE_ID = '2' ORDER BY RESULT_STATUS.ID DESC";
								$result_status = $this->result_status->get($sql_chk_status);
								$result_status = @$result_status['0'];
              
              					$sql_chk = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,RESULT_STATUS.RESULT_COMMENT,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS
												FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
												LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
												WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$rs['id']."' ORDER BY RESULT_STATUS.ID DESC";
								$result_chk = $this->result_status->get($sql_chk);
								$result_chk = @$result_chk['0'];
								if($result_chk['permit_type_id'] == '3' && $result_chk['result_status_id'] == '2'){
									$result_status['result_status_id'] = '';
									$result_status['result_comment'] = '';
									$result_status['status_dtl'] = '';
								}
		 					if(@$rs['control_status'] != '' && @$rs['is_save'] == '2'){
		 						
              ?>
              				<td style="text-align: left;padding-top: 10px"><span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง :</strong> <?=@$result_status['status_dtl']?></td>
              <? 			}else{
              						
              				if(is_permit(login_data('id'),'2') != '' && $result_chk['permit_type_id'] != '1'){
		              			$chk_control_indicator = chk_control_indicator(@$rs_indicator['id'],@$rs_metrics['id'],$rs['id']);
				 					if($chk_control_indicator == 'Y'){
				 						
              ?>
              	 				<td style="text-align: left;padding-top: 10px">
              	 					<span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง :</strong><br />
              	 					<span style="margin-right: 60px;">&nbsp;</span>
              	 					<?
              	 						$checked_1 = '';
										$checked_2 = '';
              	 						if(@$result_status['result_status_id'] == '2'){
              	 							$checked_2 = 'checked="checked"';
              	 						}else{
              	 							$checked_1 = 'checked="checked"';
              	 						}
              	 					?>
              	 						<input type="radio" name="control_status" id="control_status" value="1" <?=@$checked_1?> /> อนุมัติ <br />
              	 					<span style="margin-right: 60px;">&nbsp;</span>
              	 						<input type="radio" name="control_status" id="control_status" value="2" <?=@$checked_2?> /> ไม่อนุมัติ
              	 					<div style="display: none;margin-top: 10px" class="comment_control">
              	 						<span style="margin-right: 60px;">&nbsp;</span>
              	 						หมายเหตุ : <br />
              	 						<span style="margin-right: 60px;">&nbsp;</span>
              	 						<textarea cols="20" rows="5" name="result_comment" style="width:80%; height:100px"><?=@$result_status['result_comment']?> </textarea>
              	 					</div>
              	 				</td>
              			<?	}
						}else{?>
						<td style="text-align: left;padding-top: 10px">
							<span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง : </strong><?=(empty($result_status['status_dtl'])?"รอผลการตรวจสอบ":$result_status['status_dtl'])?><br />
							<? if(@$result_status['result_status_id'] == '2'){ ?>
								<span style="margin-right: 65px;">&nbsp;</span> หมายเหตุ : <?=@$result_status['result_comment']?>
							<? } ?>
						</td>	
					  <?}
				} 
			  ?>
            </tr>
            <tr>
		 	  <td style="text-align: left;padding-top: 10px;padding-bottom: 10px"><span style="margin-right: 40px;">&nbsp;</span><strong>ผู้รับรอง : </strong><?=@$kpr['name']?></td> 
            </tr>
          </tbody></table>
</div>
</div>

<? 
$sql_chk_status = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,RESULT_STATUS.RESULT_COMMENT,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS
					FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
					LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
					WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$rs['id']."' AND RESULT_STATUS.PERMIT_TYPE_ID = '1' ORDER BY RESULT_STATUS.ID DESC";
		$result_status = $this->result_status->get($sql_chk_status);
		$result_status = @$result_status['0'];
$sql_chk = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,RESULT_STATUS.RESULT_COMMENT,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS
			FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
			LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
			WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$rs['id']."' ORDER BY RESULT_STATUS.ID DESC";
	$result_chk = $this->result_status->get($sql_chk);
	$result_chk = @$result_chk['0'];
	$num_kpr = count($result_status);
	if(($result_chk['permit_type_id'] == '3' && $result_chk['result_status_id'] == '2') || ($result_chk['permit_type_id'] == '2' && $result_chk['result_status_id'] == '1')){
				$result_status['result_status_id'] = '';
				$result_status['result_comment'] = '';
				$result_status['status_dtl'] = '';
				$num_kpr = 0;
	}
if((@$rs['control_status'] == '1' && @$rs['is_save'] == '2') || ($num_kpr > 0)){ 
?>
<div align="center"> <!-- ส่วนของ กพร ตัวชี้วัด -->
<div style="border: 2px solid;border-color: #999999;width: 80%;margin-top: 10px;text-align: center">
	<table width="100%" border="0">
            <tbody>
            <tr>
              <th style="padding-top: 20px"><span style="margin-right: 20px;">&nbsp;</span><strong>รับรองผลการดำเนินงานจาก กพร.</strong></th>
            </tr>
            <tr>
              <? 				
		 			if(@$rs['control_status'] == '1' && @$rs['is_save'] == '2' && @$rs['kpr_status'] != ''){
		 						
              ?>
              <td style="text-align: left;padding-top: 10px"><span style="margin-right: 40px;"></span><strong>ผลการรับรอง :</strong> <?=@$result_status['status_dtl']?></td>
              <? 			}else{
			              	if(is_permit(login_data('id'),'1') != ''){
				              		$chk_kpr_indicator = chk_kpr_indicator(@$rs_indicator['id'],@$rs_metrics['id'],$rs['id']);
						 				if($chk_kpr_indicator == 'Y'){
						 					
              	 						$checked_1 = '';
										$checked_2 = '';
              	 						if(@$result_status['result_status_id'] == '2'){
              	 							$checked_2 = 'checked="checked"';
              	 						}else{
              	 							$checked_1 = 'checked="checked"';
              	 						}
              	 					
              ?>
              	 				<td style="text-align: left;padding-top: 10px">
              	 					<span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง :</strong><br />
              	 					<span style="margin-right: 60px;">&nbsp;</span>
              	 						<input type="radio" name="kpr_status" id="kpr_status" value="1" <?=$checked_1?> /> ผ่าน <br />
              	 					<span style="margin-right: 60px;">&nbsp;</span>
              	 						<input type="radio" name="kpr_status" id="kpr_status" value="2" <?=$checked_2?> /> ไม่ผ่าน
              	 					<div style="display: none;margin-top: 10px" class="comment_kpr">
              	 						<span style="margin-right: 60px;">&nbsp;</span>
              	 						หมายเหตุ : <br />
              	 						<span style="margin-right: 60px;">&nbsp;</span>
              	 						<textarea cols="20" rows="5" name="result_comment" style="width:80%; height:100px"><?=@$result_status['result_comment']?></textarea>
              	 					</div>
              	 				</td>
              			<?	}
						}else{?>
						<td style="text-align: left;padding-top: 10px">
							<span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง : </strong><?=(empty($result_status['status_dtl'])?"รอผลการตรวจสอบ":$result_status['status_dtl'])?><br />
							<? if(@$result_status['result_status_id'] == '2'){ ?>
								<span style="margin-right: 65px;">&nbsp;</span> หมายเหตุ : <?=@$result_status['result_comment']?>
							<? } ?>
						</td>	
					  <?}
					}
			  ?>
            </tr>
            <tr>
		 	  <td style="text-align: left;padding-top: 10px;padding-bottom: 10px"><span style="margin-right: 40px;">&nbsp;</span><strong>ผู้รับรอง : </strong><?=get_one('name','users','id',@$kpr['kpr_users_id'])?></td> 
            </tr>
          </tbody></table>
</div>
</div>
<? } ?>
<div align="center" style="margin-top: 10px">
<?
 if(is_permit(login_data('id'),'2') != '' || is_permit(login_data('id'),'1') != ''){
	 $chk_control_indicator = chk_control_indicator(@$rs_indicator['id'],@$rs_metrics['id'],$rs['id']);
		 if($chk_control_indicator == 'Y'){
		 	
		 	if(@$rs['control_status'] == '' && @$rs['is_save'] == '2'){
?>
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save btn_save_control"/>
<?   		
				
			}
		}	
		$chk_kpr_indicator = chk_kpr_indicator(@$rs_indicator['id'],@$rs_metrics['id'],$rs['id']);
		 if($chk_kpr_indicator == 'Y'){	 	
		 	if(@$rs['control_status'] == '1' && @$rs['is_save'] == '2' && @$rs['kpr_status'] == ''){
?>
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save btn_save_kpr"/>
<?   		
				
			}
		}	
  }
 ?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>