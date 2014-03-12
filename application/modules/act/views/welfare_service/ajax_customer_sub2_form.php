<link type="text/css" href="../../js/jquery.datepick/redmond.datepick.css" rel="stylesheet">
<style>
body #datepick-div {
z-index: 10000;
}
</style>
<script type="text/javascript" src="../../themes/bo/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="../../js/jquery.datepick/jquery.datepick-th.js"></script>
<script>
$(document).ready(function(){
	$('.datepicker').datepick({showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery.datepick/calendar.png'});
});
</script>

<form method="post" action="act/welfare_service/customer_sub2_save">
<h3>หน่วยงานที่เข้ารับบริการ</h3>
<table class="tbadd">
<tr>
<th>ชื่อหน่วยงาน  <span class="Txt_red_12"> *</span></th>
<td><input name="sub2_name" type="text" value="<?=$csub2['sub2_name']?>" style="width:300px;"/></td>
</tr>
<tr>
<th>วันที่เข้ารับบริการ  <span class="Txt_red_12"> *</span></th>
<td><input name="sub2_date" type="text" class="datepicker" value="<?=$csub2['sub2_date']?>" style="width:80px;"/></td>
</tr>
<tr>
<th>ปัญหา   <span class="Txt_red_12"> *</span></th>
<td><input name="problem" type="text" value="<?=$csub2['problem']?>" style="width:500px;"/></td>
</tr>
<tr>
<th>บริการที่ได้รับ  <span class="Txt_red_12"> *</span></th>
<td><input name="detail" type="text" value="<?=$csub2['detail']?>" style="width:500px;"/></td>
</tr>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?=$csub2['id']?>">
  <input type="hidden" name="id_card" value="<?=$_GET['id_card']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>