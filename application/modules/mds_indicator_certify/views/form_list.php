<style>
	.btn_confirm_indicator {
							width: 168px;
							height: 28px;
							border: none;
							background: transparent url(images/btn_confirm_indicator.gif) no-repeat center;
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
				document.location = 'mds_indicator/delete/?id='+id+'&metrics_id='+metrics_id;
			}
		});
	
});
</script>

<h3>บันทึก ตรวจรับรองผลการทำตัวชี้วัด  (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$rs_indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>หน่วยงานรับผิดชอบ</th>
    <td><input name="textfield" type="text" id="textfield" style="width:500px;" value="<?=@$kpr['department_name']." - ".@$kpr['title']?>" readonly="readonly"/></td>
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
	<?
			$chk_control_indicator = chk_control_indicator(@$rs_indicator['id'],$rs_metrics['id'],$result_id);
			$chk_kpr_indicator = chk_kpr_indicator(@$rs_indicator['id'],$rs_metrics['id'],$result_id);	
			if($chk_control_indicator == 'Y' || $chk_kpr_indicator == 'Y'){
					
	?>
	<div id="btnBox"><input type="button" title="ตรวจรับรองผลตัวชี้วัด" value=" " onclick="document.location='<?=$urlpage?>/form_2/<?=@$result_id?>/<?=@$rs_metrics['id']?>'" class="btn_confirm_indicator vtip"></div>
	<? }  ?>
<?=@$pagination;?> 
<table class="tblist2">
<tr>
	<th style="width: 5%">ลำดับ</th>
	<th style="width: 10%">วันที่</th>
	<th style="width: 10%">ขั้นตอน</th>
	<th style="width: 25%">ผู้รับรอง/ผู้ส่งรายงาน</th>
	<th style="width: 10%">สถานะ </th>
	<th>หมายเหตุ </th>
</tr>
<? 
$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
foreach ($rs as $key => $result_status) { ?>
	
<tr>
  <td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
  <td>
  	<? 
  		$create = explode('-', @$result_status['create_date']);
		$year =  substr($create['0'],2)+43;
		echo $date_create = @$create['2'].'/'.@$create['1'].'/'.$year;
	?>
  </td>
  <?
  	

	  	$steps = $result_status['status_steps'];
	  	$status = $result_status['status_dtl'];
	

  ?>
  <td><?=$steps?></td>
  <td><?=get_one('name','mds_set_permission_dtl','mds_set_permission_id',@$result_status['permission_id'])?></td>
  <td><?=$status?></td>
  <td><?=@$result_status['result_comment']?></td>
</tr>

<? } ?>
</table>
<?=@$pagination;?> 