<script type="text/javascript">
$(document).ready(function(){
	$('tr:not(:first)').addClass("cursor");
	$("select[name=province_code]").change(function(){
		$('select:not(:first)').val($('select option:first').val()).attr('disabled',true);
		var province_code = $(this).val();
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:text-bottom;'>").appendTo(".loadingicon:eq(0)");
		$.post("fund_organize/reload_ampor",{
			'province_code':province_code
		},function(data){
			$("#district").html(data);
			$(".loading").remove();
		})
	})
	$('.btn_delete').livequery('click',function(){
		var contentId = $(this).prev('#content-id').val();
		if(confirm('<?php echo NOTICE_CONFIRM_DELETE?>')){
			window.location.href = 'fund_organize/delete/'+contentId;
		}
	});
	
	$('tr').each(function(){
		var contentId = $(this).find('#content-id').val();
		$(this).find('td:not(:last)').click(function(){
			window.location.href = 'fund_organize/form/'+contentId;
			return false;
		});
	});
	/*
	$('select[name=province]').livequery("change",function(){
		$('select:not(:first)').val($('select option:first').val()).attr('disabled',true);
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:text-bottom;'>").appendTo(".loadingicon:eq(0)");
		var province_id = $(this).val();
		$.post("fund_organize/select_district_ajax",{
			'province_id':province_id
		},function(data){
			$("#district").html(data);
			$(".loading").remove();
		});
	});*/
});	
</script>

<h3>ตั้งค่า องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน (จะดึงข้อมูลจาก app4 องค์กรเครือข่าย หรือ องค์การสวัสดิการสังคม หรือไม่)</h3>
<form method="get" action="fund_organize/index">
<div id="search">
<div id="searchBox">
  ชื่อองค์กร/หน่วยงาน ผู้รับเงินอุดหนุน  
    <input name="name" type="text" size="30" value="<?=@$_GET['name']?>" />
    <? echo $province_list;?>
    <div id="district" style="display:inline;">
    <? echo $ampor_list;?>
    </div>
<input type="submit" title="ค้นหา" value=" " class="btn_search" /><div class="loadingicon" style="display:inline;"></div>
</div>
</div>
</form>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อองค์กร/หน่วยงาน</th>
  <th align="left">ที่อยู่</th>  
  <th align="left">จังหวัด</th>
  <th align="left">รหัสไปรษณีย์</th>
  <th align="left">โทร</th>
  <th align="left">โทรสาร</th>
</tr>
<?php 
$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
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
  <td><?=$i?><input type="hidden" name="id" id="content-id" value="<?=$row->org_id;?>"></td>
  <td nowrap="nowrap"><?=$row->org_name?></td>
  <td><?=$address?></td>
  <td><?=$province_name;?></td>
  <td><?=$postcode;?></td>
  <td><?=$tel;?></td>
  <td><?=$fax;?></td>  
</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?=$pagination?>