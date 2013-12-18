<script type="text/javascript">
$(document).ready(function(){
	$('#result2 table tr:odd').addClass('odd');
});	
</script>
<table class="tblist">
<tr>
  <th align="left">ชื่อองค์กร / หน่วยงาน</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
	foreach($xml as $row):
		$address = $row->org_home_no;
		$address.= $row->org_moo != '' && $row->org_moo != '-' ? " หมู่".$row->org_moo : "";
		$address.= $row->org_soi != '' ? " ซ.".$row->org_soi : "";
		$address.= $row->org_road != '' ? " ถนน ".$row->org_road : "";
		$address.= $row->org_tumbon_name != '' ? " แขวง/ตำบล ".$row->org_tumbon_name : "";
		$address.= $row->org_ampor_name != '' ? "  ".$row->org_ampor_name : "";
		$province_name = $row->org_province_name != '' ? $row->org_province_name : "";
		$postcode = $row->org_postcode != '' ? $row->org_postcode : "";
		$tel = $row->org_tel != '' ? $row->org_tel : "";
		$fax= $row->org_fax != '' ? $row->org_fax : "";
?>
	<tr>
	  <td nowrap="nowrap" class="cursor ozlist"><?=$row->org_name?><input type='hidden' name='org_id' value="<?=$row->org_id?>"></td>
	</tr>
	<?php $i++;?>
<?php endforeach;?>
</table>