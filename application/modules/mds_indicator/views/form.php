<style>
	.btn_add_indicator {
						width: 162px;
						height: 28px;
						border: none;
						background: transparent url(images/btn_add_indicator.gif) no-repeat center;
						overflow: hidden;
						line-height: 0px;
						display: inline;
						color: #a63606;
						cursor: pointer;
						cursor: hand;
						margin-top: 5px;
						}
</style>
<script language="JavaScript">
$(function(){
		$('.btn_delete').live('click', function(){
			var id = $(this).attr('ref_id');
			var metrics_id = $(this).attr('ref_metrics');
			if(confirm('ท่านลบผลปฎิบัติราชการ ใช่ หรือ ไม่')) {
				document.location = '<?php echo base_url();?>mds_indicator/delete/?id='+id+'&metrics_id='+metrics_id;
			}
		});
	
});
</script>

<h3>บันทึก ตัวชี้วัด (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$rs_indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:500px;" value="มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด</th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:600px;" value="<?=@$parent_on?> : <?=@$rs_metrics['metrics_name']?>" readonly="readonly"/></td>
  </tr>
</table>
	<div id="btnBox">
		<input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="window.location='<?php echo @$urlpage;?>'" class="btn_back">
	</div>
<?
		$premit = is_permit(login_data('id',3));
		if($premit != "")
		{
			$chk_keyer_indicator = chk_keyer_indicator(@$rs_indicator['id'],$rs_metrics['id']);	
			if($chk_keyer_indicator == 'Y'){
					
?>
<div id="btnBox"><input type="button" title="เพิ่มผลปฎิบัติราชการ" value=" " onclick="document.location='<?=base_url().$urlpage?>/form_2/<?=$rs_metrics['id']?>'" class="btn_add_indicator vtip"/></div>
<? } }?>
<table class="tblist2">
<tr>
  	<th style="width: 10%">แบบฟอร์มรายงานผล</th>
  	<th style="width: 15%">ชื่อตัวชี้วัด</th>
	<th style="width: 25%">ผู้กำกับดูแล</th>
	<th style="width: 25%">ผู้จัดเก็บข้อมูล</th>
	<th style="width: 5%">วันที่</th>
	<th style="width: 10%">ขั้นตอน</th>
	<th style="width: 10%">สถานะ</th>
	<th style="width: 5%">ลบ </th>
</tr>
<? 	
foreach ($rs as $key => $item_result) { 

	$chk_keyer_indicator = chk_keyer_indicator(@$rs_indicator['id'],$rs_metrics['id'],@$item_result['round_month']);	
	if($chk_keyer_indicator == 'Y' || $premit != ''){
?>	
<tr>
  <td><?=@$item_result['round_month']?> เดือน <a href="<?=$urlpage?>/form_2/<?=$rs_metrics['id']?>/<?=@$item_result['id']?>"><img src="images/see.png" alt="" width="24" height="24" /></a></td>
  <td><?=@$item_result['mds_set_metrics_name']?> </td>
  <td>
  	<?
  			   $chk_kpr = "select mds_set_metrics_kpr.*,
							mds_set_position.pos_name , cnf_division.title , cnf_department.title as department_name 
							from mds_set_metrics_kpr 
							left join mds_set_position on mds_set_metrics_kpr.control_position_id = mds_set_position.id 
							left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
							left join cnf_department on mds_set_metrics_kpr.control_department_id = cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".$item_result['mds_set_metrics_id']."' and mds_set_metrics_kpr.round_month = '".@$item_result['round_month']."' ";
				$result_kpr = $this->kpr->get($chk_kpr);
				$kpr = @$result_kpr['0'];
  	?>
  	<?=@$kpr['control_name']?> <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : <?=(empty($kpr['control_tel']))?'-':$kpr['control_tel'];?>&lt;br&gt; อีเมล์ : <?=(empty($kpr['control_email']))?'-':$kpr['control_email'];?>" /></td>
  <td><?=@$item_result['keyer_name']?> <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : <?=(empty($item_result['keyer_tel']))?'-':$item_result['keyer_tel'];?>&lt;br&gt; อีเมล์ : <?=(empty($item_result['keyer_email']))?'-':$item_result['keyer_email'];?>" /></td> 
  <td>
  	<? 
  		
		
  		if($item_result['update_date'] == ''){
			$create = explode('-', @$item_result['create_date']);
			$year =  substr($create['0'],2)+43;
			$date = @$create['2'].'/'.@$create['1'].'/'.$year;
		}else{
			$update = explode('-', @$item_result['update_date']);
			$year =  substr($update['0'],2)+43;
			$date = @$update['2'].'/'.@$update['1'].'/'.$year;
		}
		if($item_result['is_save'] == 1){
			$date_2 = " - ";
			$date_3 = " - ";
			$date_4 = " - ";
		}else{
			$date_2 = chk_date_approve($item_result['id'],'3','2');
			$date_3 = chk_date_approve($item_result['id'],'2','1');
			$date_4 = chk_date_approve($item_result['id'],'1','1');
		}
  	?>
  	<img src="images/date.png" alt="" width="24" height="24" class="vtip" title="บันทึก : <?=@$date?> &lt;br&gt; ขออนุมัติส่ง : <?=@$date_2?> &lt;br&gt; พิจารณาส่ง : <?=@$date_3?> &lt;br&gt; กพร.พิจารณาอนุมัติ : <?=@$date_4?> " /></td>
  <td><? 
  	   	$sql_chk_status = "SELECT RESULT_STATUS.ID,RESULT_STATUS.RESULT_STATUS_ID,RESULT_STATUS.PERMIT_TYPE_ID,TOPIC.STATUS_DTL,TOPIC.STATUS_STEPS,TOPIC.CODE_COLORS
							FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
							LEFT JOIN MDS_STATUS_TOPIC TOPIC ON RESULT_STATUS.PERMIT_TYPE_ID = TOPIC.PERMIT_TYPE_ID AND RESULT_STATUS.RESULT_STATUS_ID = TOPIC.STATUS_ID
							WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$item_result['id']."' ORDER BY RESULT_STATUS.ID DESC";
		$result_status = $this->result_status->get($sql_chk_status);
		
  		if($item_result['is_save'] == 1 && count($result_status) == '0'){
  			echo "บันทึก";
  		}else{
  			echo @$result_status['0']['status_steps'];
  		}
  	  ?>
  </td>
  <td>
  	  <? 
  		if($item_result['is_save'] == 1 && count($result_status) == '0'){
  			echo " - ";
  		}else{
  			echo "<span style='color:".@$result_status['0']['code_colors']." '>";
  			echo @$result_status['0']['status_dtl'];
			echo "</span>";
  		}
  	  ?>
  </td>
  <td><input type="submit" name="button" id="button" ref_id="<?=@$item_result['id']?>" ref_metrics="<?=@$rs_metrics['id']?>" value="" class="btn_delete" /></td>
</tr>
<? } // if()
} // foreach ?>

</table>
