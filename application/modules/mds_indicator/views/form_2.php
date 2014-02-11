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
					score_metrics:{ required:true,max: 5},
					result_metrics:{ required:true},
					document_plan:{ required : function(element) {
	        				return $("#is_save").val() == '2';}
	        			  }
				},
				messages:{
					score_metrics:{required:"กรุณาระบุค่าคะแนนที่ได้", max:"ลำดับที่ใส่ได้มากที่สุด คือ  5 " },
					result_metrics:{required:"กรุณาระบุผลการดำเนินงาน"},
					document_plan:{required:"กรุณาแนบ แบบฟอร์มรายงาน" }
					
				}
	});
	$('.bt_add_document_ref').live('click',function(){
		var num = $('#num_ref').val();
		var i =  parseInt(num)+parseInt(1);
		
		var upload  = '<div id="div_document_ref_'+i+'" style="margin-top: 10px">';
			upload +=	'<span style="margin-right: 40px;">&nbsp;</span>';
			upload +=	'<div style="width: 426px;display: inline-block"><input type="file" name="document_plan_ref['+i+']" id="document_plan_ref['+i+']">';
			upload +=	'</div>';
			upload +=	'<input type="button" value="ลบ" ref="'+i+'" style="width: 50px;" class="dt_delete_ref_uploads" />';
			upload += '</div>';
		
		$("#document_ref").before(upload);
		$('#num_ref').val(i);
	});
	
	$('.dt_delete_ref_uploads').live('click',function(){
		var i = $(this).attr('ref');
		$("#div_document_ref_"+i).remove();
	});
	
	$('.dt_delete_document').live('click', function(){
		var id = $(this).attr('ref_id');
		var result_id = $(this).attr('ref_result_id');
		var metrics_id = $('#mds_set_metrics_id').val();
		var keyer_users_id = $('#keyer_users_id').val();
		var round_month = $('#round_month').val();
		var type_doc =  $(this).attr('type_doc');
		if(confirm('ท่านต้องการลบเอกสารแนบ ใช่ หรือ ไม่')) {
			document.location = 'mds_indicator/delete_doc/?id='+id+'&result_id='+result_id+'&metrics_id='+metrics_id+'&keyer_users_id='+keyer_users_id+'&round_month='+round_month+'&type_doc='+type_doc;
		}
	});
	
	function cal_weight(){
	
		var weight_perc_tot = $('#weight_perc_tot').val();
		var score_mertics = $('#score_metrics').val();
		var metrics_weight = $('#metrics_weight').val();
		
		var cal = (score_mertics*metrics_weight)/weight_perc_tot;
		
		$('[name=score_weight]').val(cal); // ปัดเศษ
	}
	
	$('#score_metrics').live('keyup',function(){
		if($(this).val() > 5){
			$(this).val('5')
		}
		cal_weight();
	});
	
	 cal_weight();
	 
	$('.btn_save').live('click', function(){
		$('#is_save').val('1');
		$( "#Myform" ).submit();
	});
	$('.btn_savesend').live('click', function(){
		$('#is_save').val('2');
		$( "#Myform" ).submit();
	});
	
});
</script>
<h3>บันทึก ตัวชี้วัด มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?> (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>หน่วยงานรับผิดชอบ</th>
    <td style="font-size: 14px"><?=@$kpr['department_name']."-".@$kpr['title']?></td>
  </tr>
  <tr>
    <th>ผู้กำกับดูแลตัวชี้วัด</th>
    <td style="font-size: 14px"><?=@$kpr['pos_name']." (".@$kpr['name'].")"?></td>
  </tr>
  <tr>
    <th>ติดต่อผู้กำกับ </th>
    <td style="font-size: 14px"><?=(empty($kpr['tle']))?'-':$kpr['tle'];?> <br /> <?=(empty($kpr['email']))?'-':$kpr['email'];?> 
    </td>
  <tr>
    <th>ผู้จัดเก็บข้อมูล</th>
    <td style="font-size: 14px;">
    	<? foreach ($keyer as $key => $temp_keyer) {
			 if($key == '0'){
			 	echo $temp_keyer['name'];
			 }else{
			 	echo ' , '.$temp_keyer['name'];
			 }
		   } ?>
    </td>
  </tr>
  <tr>
    <th>เบอร์โทรผู้จัดเก็บข้อมูล </th>
    <td style="font-size: 14px;">
    	<? foreach ($keyer as $key => $temp_keyer) {
			 if($key == '0'){
			 	echo (empty($temp_keyer['tel']))?'-':$temp_keyer['tel'];
			 }else{
			 	echo ' , ';
			 	echo (empty($temp_keyer['tel']))?'-':$temp_keyer['tel'];
			 }
		   } ?>
    </td>
</table>
<? if(@$rs['is_save'] != '2'){ ?>
<form enctype="multipart/form-data" action="<?php echo $urlpage;?>/save" id="Myform" method="POST">
<? } ?>
	<input type="hidden" name="round_month" id="round_month" value="<?=@$round_month?>" />
	<input type="hidden" name="mds_set_metrics_id" id="mds_set_metrics_id" value="<?=@$rs_metrics['id']?>" />
	<input type="hidden" name="mds_set_indicator_id" id="mds_set_indicator_id" value="<?=@$rs_indicator['id']?>" />
	<input type="hidden" name="keyer_users_id" id="keyer_users_id" value="<?=@$rs['keyer_users_id']?>" />
	<input type="hidden" name="id" id="id" value="<?=@$rs['id']?>" />
	<input type="hidden" name="is_save" id="is_save" value="" />
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
				<?=@$parent_on?> <?=@$rs_metrics['metrics_name']?>
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
                                    <td style="text-align: left;"><?=@$parent_on?> <?=@$rs_metrics['metrics_name']?></td>
                                    <td><center>
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
							
                                    	 $readonly = '';
										 if(login_data('id') != @$rs['keyer_users_id']){
										 	$readonly = 'readonly="readonly"';
										 }
										 if(@$rs['is_save'] == '2'){
										 	$readonly = 'readonly="readonly"';
										 }
										?>
                                        <input type="text" name="metrics_weight" style="width: 60px" size="7" value="<?=@$metrics_weight?>"  id="metrics_weight" readonly="readonly" style="color:#999999">
                                        <input type="hidden" name="weight_perc_tot" id="weight_perc_tot" value="<?=@$weight_perc_tot?>">
                                    </center></td>
                                    <td><center>
                                    	<input type="text" name="result_metrics" style="width: 60px" size="7" id="result_metrics" value="<?=(empty($rs['result_metrics']))?'N/A':$rs['result_metrics'];?>" <?=$readonly?> >
                                    </center></td>
                                    <td id="ac"><center> 
                                    <input type="text" name="score_metrics" style="width: 60px" id="score_metrics" size="7" value="<?=@$rs['score_metrics']?>"  maxlength="6" class="numDecimal2" <?=$readonly?>>
                                    </center></td>
                                    <td id="score_weight"><center>
                                      <input type="text" name="score_weight" style="width: 60px" size="7" value="" class="numDecimal2" readonly="readonly">
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
								<? 
									if(login_data('id') == @$rs['keyer_users_id']){
										if(@$rs['is_save'] != '2'){ 
								?>
								<input type="button" value="ลบ" ref_id="<?=@$doc['id']?>" type_doc='1' ref_result_id="<?=@$rs['id']?>" style="width: 50px;" id="dt_delete_document" />
								<? 
										} 
									}
								?>
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
				<?
					if(login_data('id') == @$rs['keyer_users_id']){
						if(@$rs['is_save'] != '2'){ 
				?>
				<span style="margin-right: 20px;">&nbsp;</span><input type="button" class="bt_add_document_ref" style="width: 150px" value=" เพิ่มแถบอัพโหลด " />
				<?
						}
					}
				?>
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
								<? 
									if(login_data('id') == @$rs['keyer_users_id']){
										if(@$rs['is_save'] != '2'){ 
								?>
								<input type="button" value="ลบ" ref_id="<?=@$doc_ref['id']?>" type_doc='2' ref_result_id="<?=@$rs['id']?>" style="width: 50px;" class="dt_delete_document" />
								<? 
										} 
									}
								?>
							</div>
					<?		
						}
					
				  } 
						if(login_data('id') == @$rs['keyer_users_id']){
							if(@$rs['is_save'] != '2'){ 
					?>
				<div id="div_document_ref_<?=$num_ref?>" style="margin-top: 10px">
					<span style="margin-right: 40px;">&nbsp;</span>
					<div style="width: 422px;display: inline-block">
					<input type="file" name="document_plan_ref[<?=$num_ref?>]" >
					</div>					
					<input type="button" value="ลบ" ref="<?=$num_ref?>" style="width: 50px;" class="dt_delete_ref_uploads" />	
				</div>
				<?
							}
						}		
				?>
				<div id="document_ref"></div>
				<input type="hidden" name="num_ref" id="num_ref" value="<?=@$num_ref?>" />
			</td>
		</tr>
		<tr><td style="padding-top: 20px"></td></tr>
	</table>
</div>
</div>
<? 
if(@$rs['id'] != ''){
	$sql_chk_status = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,RESULT_STATUS.RESULT_COMMENT,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS
						FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
						LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
						WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".@$rs['id']."' ORDER BY RESULT_STATUS.ID DESC";
					$result_status = $this->result_status->get($sql_chk_status);
					$result_status = @$result_status['0'];
	if(@$result_status['permit_type_id'] == '2'){
		$title = "รับรองผลการดำเนินงานจากผู้กำกับดูแลตัวชี้วัด";
	}else if(@$result_status['permit_type_id'] == '1'){
		$title = "รับรองผลการดำเนินงานจาก กพร.";
	}
if((@$result_status['permit_type_id'] == '2' && @$result_status['result_status_id'] == '2' )|| (@$result_status['permit_type_id'] == '1' && @$result_status['result_status_id'] == '2')){
?>
<div align="center">
<div style="border: 2px solid;border-color: #999999;width: 80%;margin-top: 10px;text-align: center">
	<table width="100%" border="0">
            <tbody>
            <tr>
              <th style="padding-top: 20px"><span style="margin-right: 20px;">&nbsp;</span><strong><?=@$title?></strong></th>
            </tr>
            <tr>
             <td style="text-align: left;padding-top: 10px">
				<span style="margin-right: 40px;">&nbsp;</span><strong>ผลการรับรอง : </strong><?=(empty($result_status['status_dtl'])?"รอผลการตรวจสอบ":$result_status['status_dtl'])?><br />
				<? if(@$result_status['result_status_id'] == '2'){ ?>
				<span style="margin-right: 65px;">&nbsp;</span> หมายเหตุ : <?=@$result_status['result_comment']?>
				<? } ?>
			 </td>		
            </tr>
            <tr>
		 	  <td style="text-align: left;padding-top: 10px;padding-bottom: 10px"><span style="margin-right: 40px;">&nbsp;</span><strong>ผู้รับรอง : </strong><?=@$kpr['name']?></td> 
            </tr>
          </tbody></table>
</div>
</div>
<? } }?>
<div align="center" style="margin-top: 10px">
<?
 if(is_permit(login_data('id'),'3') != ''){
	 $chk_keyer_indicator = chk_keyer_indicator(@$rs_indicator['id'],@$rs_metrics['id']);
		 if($chk_keyer_indicator == 'Y'){
		 	if(login_data('id') == @$rs['keyer_users_id']){
		 		if(@$rs['is_save'] != '2'){
?>
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input" type="button" title="บันทึกพร้อมส่ง" value=" " class="btn_savesend"/>
<?   		
				}
			}
		}	
  }
 ?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>