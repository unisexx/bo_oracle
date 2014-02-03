<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				budget_year:{required:true}
			},
			messages:{
				budget_year:{required:"กรุณาระบุชื่อหน่วยวัด"}
			}
		});
});
</script>
<style>
	.tblist3 th{
		border-right: 1px solid #ccc;
	}
</style>
<h3>บันทึก หน่วยวัดและเป้าหมาย (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:500px;" value="มิติที่ <?=@$indicator['indicator_on']?> : <?=@$indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
</table>
<table class="tblist3">
<tr>
	<th rowspan="2" style="width:5%">ลำดับตัวชี้วัด</th>
	<th rowspan="2" style="width:35%">ชื่อตัวชี้วัด</th>
	<th rowspan="2" style="width:15%">หน่วยวัด</th>
	<th rowspan="2" style="width:5%">เป้าหมาย<br />
	  ปี <?php echo substr(@$indicator['budget_year'], 2); ?></th>
	<th rowspan="2" style="width:5%">น้ำหนัก<br />
	  ร้อยละ</th>
	<th colspan="2" style="width:10%"> 6 เดือน</th>
	<th colspan="2" style="width:10%"> 9 เดือน</th>
	<th colspan="2" style="width:10%"> 12 เดือน</th>
</tr>
<tr>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
  <td style="text-align: center;">ผลงาน</td>
  <td style="text-align: center;">คะแนนประเมิน<br />
    ตนเอง</td>
</tr>
<? 	$ass_name = '';
    $i = 1;
	foreach ($rs_ass as $key => $assessment) { 
	if($ass_name != $assessment['ass_name']){
		$ass_name=$assessment['ass_name'];
?>
	
<tr>
	<td colspan="11"><strong><?=@$ass_name?></strong></td>
</tr>
		
<? 			$sql_metrics = "select *
							from mds_set_metrics
							where mds_set_metrics.parent_id = '0' 
							and mds_set_metrics.mds_set_indicator_id = '".$mds_set_indicator_id."' 
							and mds_set_assessment_id = '".$assessment['mds_set_assessment_id']."'  ";
			$result_metrics = $this->metrics->get($sql_metrics);
			foreach ($result_metrics as $key => $metrics) { ?>
				<tr>
				  <td><?=$metrics['metrics_on']?></td>
				  <td><?=$metrics['metrics_name']?></td>
				  <td>
				  	<input type="hidden" name="id[<?=$i?>]" name="id[<?=$i?>]" value="<?=$metrics['id']?>" />
				  	<?php echo form_dropdown('mds_set_measure_id['.$i.']',get_option('id','measure_name','mds_set_measure'),@$metrics['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?>
				  </td>
				  <td>
				  	<label>
				    	<input type="text" name="metrics_target[<?=$i?>]" id="metrics_target[<?=$i?>]" style="width:30px;" value="<?=@$metrics['metrics_target']?>" class="numOnly" />
				  	</label>
				  </td>
				  <td><?=$metrics['metrics_weight']?></td>
				  <td>N/A</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
			  </tr>
			  <script language="JavaScript">
		  		$(function(){
					$("[name='mds_set_measure_id[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเลือกหน่วยวัด" } });
					$("[name='metrics_target[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเป้าหมาย" } });
				});
		  	  </script>
<?				$i++;
				$sql_metrics_sub_1 = "select *
									from mds_set_metrics
									where mds_set_metrics.parent_id = '".$metrics['id']."' 
									and mds_set_metrics.mds_set_indicator_id = '".$mds_set_indicator_id."'  ";
				$result_metrics_sub_1 = $this->metrics->get($sql_metrics_sub_1);
				foreach ($result_metrics_sub_1 as $key => $metrics_sub_1) {?>
						<tr>
						  <td><?=$metrics['metrics_on']?>.<?=$metrics_sub_1['metrics_on']?></td>
						  <td><?=$metrics_sub_1['metrics_name']?></td>
						  <td>
						  	<input type="hidden" name="id[<?=$i?>]" name="id[<?=$i?>]" value="<?=$metrics_sub_1['id']?>" />
						  	<?php echo form_dropdown('mds_set_measure_id['.$i.']',get_option('id','measure_name','mds_set_measure'),@$metrics_sub_1['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?>
						  </td>
						  <td>
						  	<label>
						    	<input type="text" name="metrics_target[<?=$i?>]" id="metrics_target[<?=$i?>]" style="width:30px;" value="<?=@$metrics_sub_1['metrics_target']?>" class="numOnly" />
						  	</label>
						  </td>
						  <td><?=$metrics_sub_1['metrics_weight']?></td>
						  <td>N/A</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
					  <script language="JavaScript">
				  		$(function(){
							$("[name='mds_set_measure_id[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเลือกหน่วยวัด" } });
							$("[name='metrics_target[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเป้าหมาย" } });
						});
				  	  </script>
				<?
					$i++;
					$sql_metrics_sub_2 = "select *
										from mds_set_metrics
										where mds_set_metrics.parent_id = '".$metrics_sub_1['id']."' 
										and mds_set_metrics.mds_set_indicator_id = '".$mds_set_indicator_id."'  ";
					$result_metrics_sub_2 = $this->metrics->get($sql_metrics_sub_2);
					foreach ($result_metrics_sub_2 as $key => $metrics_sub_2) {?>
							<tr>
							  <td><?=$metrics['metrics_on']?>.<?=$metrics_sub_1['metrics_on']?>.<?=$metrics_sub_2['metrics_on']?></td>
							  <td><?=$metrics_sub_2['metrics_name']?></td>
							  <td>
							  	<input type="hidden" name="id[<?=$i?>]" name="id[<?=$i?>]" value="<?=$metrics_sub_2['id']?>" />
							  	<?php echo form_dropdown('mds_set_measure_id['.$i.']',get_option('id','measure_name','mds_set_measure'),@$metrics_sub_2['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?>
							  </td>
							  <td>
							  	<label>
							    	<input type="text" name="metrics_target[<?=$i?>]" id="metrics_target[<?=$i?>]" style="width:30px;" value="<?=@$metrics_sub_2['metrics_target']?>" class="numOnly" />
							  	</label>
							  </td>
							  <td><?=$metrics_sub_2['metrics_weight']?></td>
							  <td>N/A</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
						  </tr>
						  <script language="JavaScript">
					  		$(function(){
									$("[name='mds_set_measure_id[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเลือกหน่วยวัด" } });
									$("[name='metrics_target[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเป้าหมาย" } });
							});
					  	  </script>
					<?
						$i++;
						$sql_metrics_sub_3 = "select *
											from mds_set_metrics
											where mds_set_metrics.parent_id = '".$metrics_sub_2['id']."' 
											and mds_set_metrics.mds_set_indicator_id = '".$mds_set_indicator_id."'  ";
						$result_metrics_sub_3 = $this->metrics->get($sql_metrics_sub_3);
						foreach ($result_metrics_sub_3 as $key => $metrics_sub_3) { ?>
							<tr>
							  <td><?=$metrics['metrics_on']?>.<?=$metrics_sub_1['metrics_on']?>.<?=$metrics_sub_2['metrics_on']?>.<?=$metrics_sub_3['metrics_on']?></td>
							  <td><?=$metrics_sub_3['metrics_name']?></td>
							  <td>
							  	<input type="hidden" name="id[<?=$i?>]" name="id[<?=$i?>]" value="<?=$metrics_sub_3['id']?>" />
							  	<?php echo form_dropdown('mds_set_measure_id['.$i.']',get_option('id','measure_name','mds_set_measure'),@$metrics_sub_3['mds_set_measure_id'],'','-- เลือกหน่วยวัด --') ?>
							  </td>
							  <td>
							  	<label>
							    	<input type="text" name="metrics_target[<?=$i?>]" id="metrics_target[<?=$i?>]" style="width:30px;" value="<?=@$metrics_sub_3['metrics_target']?>" class="numOnly" />
							  	</label>
							  </td>
							  <td><?=$metrics_sub_3['metrics_weight']?></td>
							  <td>N/A</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
						  </tr>
						  <script language="JavaScript">
					  		$(function(){
									$("[name='mds_set_measure_id[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเลือกหน่วยวัด" } });
									$("[name='metrics_target[<?=$i?>]']").rules( 'add', {required: true, messages: {required: "กรุณาเป้าหมาย" } });
							});
					  	  </script>
					<?
						$i++;
						}//foreach metrics_sub_3
					} //foreach metrics_sub_2
				} //foreach metrics_sub_1
			} //foreach metrics
		} //if($ass_name != $assessment['ass_name'])
	} 
	
?>
</table>
<input type="hidden" name="num_i" id="num_i" value="<?=$i?>" />
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>