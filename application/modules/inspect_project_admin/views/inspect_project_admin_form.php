<script type="text/javascript">
$(document).ready(function(){
	$('.btn_add').click(function(){
		newrow='<tr>';
		  newrow+='<td>';
		  	newrow+='<input type="hidden" name="hdID[]" id="hdID" value="">';
		  	newrow+='<textarea name="subq1[]" id="subq1" style="width:90%"></textarea>';
		    newrow+='<input type="button" name="button2" id="button2" value=" " class="btn_delete" />';
		  newrow+='</td>';
		  newrow+='<td>';
		  	newrow+='<textarea name="subq2[]" id="subq2" style="width:90%"></textarea>';
		    newrow+='<input type="button" name="button2" id="button2" value=" " class="btn_delete" />';
		  newrow+='</td>';
		  newrow+='<td>';
		  	newrow+='<textarea name="subq3[]" id="subq3" style="width:90%"></textarea>';
		    newrow+='<input type="button" name="button2" id="button2" value=" " class="btn_delete" />';
		  newrow+='</td>';
		  newrow+='<td>';
		  	newrow+='<textarea name="subq4[]" id="subq4" style="width:90%"></textarea>';
		    newrow+='<input type="button" name="button2" id="button2" value=" " class="btn_delete" />';
		  newrow+='</td>';		  
		var addrow =$(newrow+'</tr>');
		$('.total').before(addrow);	
	});
	
	$('.btn_delete').livequery("click",function(){
		$(this).closest('td').find('textarea').text("");
	});
});
</script>
<form enctype="multipart/form-data" method="post" action="inspect_project_admin/save/<?=$id;?><?=$url_parameter;?>">
<h3>ผู้ดูแล โครงการ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ <span class="Txt_red_12"> *</span></th>
  <td>
  	<?=$project['budgetyear']+543;?>
  </td>
</tr>
<tr>
  <th>ชื่อโครงการ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?=$project['title'];?>
  </td>
</tr>
</table>

<h5 style="margin-top:10px;">รายชื่อโครงการย่อย (เพิ่ม / แก้ไข)</h5>

<div id="btnBox"><input type="button" name="btnBoxAdd" title="เพิ่มรายการ" class="btn_add"/></div>

<table class="tblist">
<tr>
  <th style="width:25%">ไตรมาสที่ 1</th>
  <th style="width:25%">ไตรมาสที่ 2</th>
  <th style="width:25%">ไตรมาสที่ 3</th>
  <th style="width:25%">ไตรมาสที่ 4</th>
  </tr>
<?
foreach($detail as $item){
?>
<tr>
  <td>
  	<input type="hidden" name="hdID[]" id="hdID" value="<?=$item['id'];?>">
  	<textarea name="subq1[]" id="subq1" style="width:90%"><?=$item['subq1'];?></textarea>
    <input type="button" name="button2" id="button2" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq2[]" id="subq2" style="width:90%"><?=$item['subq2'];?></textarea>
    <input type="button" name="button" id="button" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq3[]" id="subq3" style="width:90%"><?=$item['subq3'];?></textarea>
    <input type="button" name="button3" id="button3" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq4[]" id="subq4" style="width:90%"><?=$item['subq4'];?></textarea>
    <input type="button" name="button4" id="button4" value=" " class="btn_delete" />
  </td>
</tr>
<? } ?>  
<tr>
  <td>
  	<input type="hidden" name="hdID[]" id="hdID" value="">
  	<textarea name="subq1[]" id="subq1" style="width:90%"></textarea>
    <input type="button" name="button2" id="button2" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq2[]" id="subq2" style="width:90%"></textarea>
    <input type="button" name="button" id="button" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq3[]" id="subq3" style="width:90%"></textarea>
    <input type="button" name="button3" id="button3" value=" " class="btn_delete" />
  </td>
  <td>
  	<textarea name="subq4[]" id="subq4" style="width:90%"></textarea>
    <input type="button" name="button4" id="button4" value=" " class="btn_delete" />
  </td>
</tr>
<tr class="total">
  <td colspan="4" align="right"></td>  
</tr>  
</table>

<div class="paddT20"></div>
<div id="btnBoxAdd">
  <input type="hidden" name="project_title" value="<?=$project['title']?>" />
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>