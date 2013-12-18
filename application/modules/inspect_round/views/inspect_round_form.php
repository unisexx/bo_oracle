<script type="text/javascript">
$(document).ready(function(){
$('.tblist2').rowCount();
	$('.btn_add').live('click',function(){
		var mtyear=$(this).parents("tr").prev().prev().find("select[name=mtyear] option:selected").val();		
		if(mtyear==""){
			alert("กรุณาระบุปีงบประมาณด้วยคะ");			
		}else{
			var round_name=$(this).closest("tr").prev("tr").children("td").children("input").val();
			if(round_name == ""){
				alert("กรุณากรอกชื่อรอบการตรวจ");
				return false;
			}else{
				var newrow=$('<tr><td></td><td><input type="hidden" name="round_name[]" value="'+round_name+'">'+round_name+'</td><td><input type="submit" name="button" id="button" value=" " class="btn_delete" /></td></tr>')
				$('.tblist2 tr:last').after(newrow);
				$('.tblist2').rowCount();
			}
		}
	});
	
	$('.btn_delete').live('click',function(){
		if (confirm('<?php echo NOTICE_CONFIRM_DELETE?>')) {
	            $(this).closest("tr").remove();
	            $('.tblist2').rowCount();
	     }
	});
	
	$("form").validate({
			rules: {
				mtyear:"required"
			},
			messages:{
				mtyear:"กรุณาระบุข้อมูลด้วย"
			}
		});
	
});
</script>
<h3>ตั้งค่า กำหนดรอบ (เพิ่ม / แก้ไข)</h3>
<form  id="formm" action="inspect_round/save<?=$url_parameter;?>" method="post">
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('mtyear',get_option('distinct(mtyear)','mtyear+543','mt_strategy where MTYEAR not in (select mt_year from insp_round '.@$condition.')'),@$mt_year,'','-- เลือกปีงบประมาณ --','0'); ?>
  	
     <!-- <input type="checkbox" name="checkbox" id="checkbox" />คัดลอกข้อมูลรอบการตรวจของปีงบประมาณนี้ --></td>
</tr>
<tr>
	<th>ชื่อรอบการตรวจ</th>
	<td><input type="text" name="round_name"  size="50" ></td>
</tr>
<tr>
	<th></th>
	<td><input type="button" title="เพิ่มรายการ"  class="btn_add"/></td>
</tr>
</table>
 
<div style="padding:20px 0;"></div>
<h3>กำหนดรอบ</h3>
<table class="tblist2">
<tr class="h_row">

  <th>ชื่อรอบการตรวจ</th>
  <th>ลบ</th>
  </tr>
<?php 
if($result):
foreach ($result as $rs):
	
 ?>
<tr>
  <td><input type="hidden" name="round_name[]" value="<?php echo $rs['round_name'] ?>"><?php echo $rs['round_name']?></td>
  <td><input type="button" name="button" id="button" value=" " class="btn_delete" /></td>
</tr>
<?php endforeach;endif; ?>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo @$id ?>">
  <?php if(permission('inspect_round', 'canedit')):?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>
</form>