<script type="text/javascript">
$.validator.setDefaults({
	submitHandler: function() { form.submit() }
});

$().ready(function() {
	// validate signup form on keyup and submit
	
	$("#frmSettime").validate({
		rules: {
			byear: "required"
				
		},
		messages: {
			BYear: "กรุณากรอกปีงบประมาณ"
						
		}
	});
	
});
</script>
<h3 id="topic">ตั้งเวลา (แก้ไข / ลบ)</h3>
<form name="frmSettime" id="frmSettime" method="post" enctype="multipart/form-data" action="budget_time/save<?=$url_parameter;?>">
<table class="tbadd">
<tr>
	<th width="18%">ปีงบประมาณ <span class="Txt_red_8">*</span></th>
	<td>
		<input name="byear" type="text" id="byear" size="5" maxlength="4" value="<?=@$row['byear'];?>" />
		<input type="hidden" name="id" id="id" value="<?=@$row['id'];?>">
	</td>
</tr>
<? for($i=1;$i<=8;$i++){ ?>
<tr>
  <th>วันกำหนดส่ง ขั้นตอนที่ <?=$i;?></th>
  <td><input type="text" id="bdate_<?=$i;?>"  name="bdate_<?=$i;?>" value="<?=mysql_to_date(@$row['bdate_'.$i],TRUE);?>"class="datepicker"  />
   </td>
</tr>
<? } ?>
<tr>
	<th>สถานะ</th>
    <td><input type="checkbox" id="status" name="status" value="1" <? if(@$row['status']!='')echo "checked";?> /> เปิดใช้งาน</td>
</tr>
</table>
<div style="padding-left:18%; padding-top:10px;">
  <input type="submit" name="button" id="button" value="" class="btn_save" />
 <input type="button" name="button2" id="button2" value="" class="btn_back" onclick="history.back();" /></div>
</div><!--add-->
</form>