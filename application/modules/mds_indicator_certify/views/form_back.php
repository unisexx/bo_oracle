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
    <td><input name="textfield" type="text" id="textfield" style="width:500px;" value="สำนักงานปลัดกระทรวง (สป.) - สำนักบริหารงานกลาง (รอถาม)" readonly="readonly"/></td>
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

<?=@$pagination;?> 
<table class="tblist2">
<tr>
	<th style="width: 5%">ลำดับ</th>
	<th style="width: 80%">ผู้จัดเก็บข้อมูล</th>
	<th style="width: 15%">ตรวจรับรองตัวชี้วัด</th>
</tr>
<? 	
$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
foreach ($rs as $key => $item_result) { ?>
<tr>
  <td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
 
  <td><?=@$item_result['name']?> <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : <?=(empty($item_result['tel']))?'-':$item_result['tel'];?>&lt;br&gt; อีเมล์ : <?=(empty($item_result['email']))?'-':$item_result['email'];?>" /></td>
  <td><?
		$premit = is_permit(login_data('id'),'1');
		if($premit == "")
			{
			$chk_keyer_indicator = chk_control_indicator(@$rs_indicator['id'],$rs_metrics['id']);	
			if($chk_keyer_indicator == 'Y'){
					
	?>
	<div id="btnBox"><input type="button" title="ตรวจรับรองผลตัวชี้วัด" value=" " onclick="document.location='<?=$urlpage?>/form_list/<?=$item_result['keyer_users_id']?>/<?=@$rs_metrics['id']?>'" class="btn_confirm_indicator vtip"></div>
	<? } } ?>
   </td>
</tr>
<? } ?>

</table>
<?=@$pagination;?> 