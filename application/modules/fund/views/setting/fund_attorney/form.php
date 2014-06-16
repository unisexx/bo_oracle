<script type="text/javascript">	
			
	$(document).ready(function(){
		$("form").validate({
			rules: {
				names:{
					required:true, 
					remote:{
						 url:'fund/setting/fund_attorney/chk_fund_name',
						 data: { 
						 	names:function(){ return $('[name=names]').val(); },	
						    id:function(){ return $('[name=id]').val(); }
						}
					}
				}
			},
			messages:{
				names:{required:"กรุณาระบุชื่อองค์กร/หน่วยงาน", remote:"มีชื่อองค์กร/หน่วยงานนี้แล้ว"}
			}
		});
			
	});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ผู้รับมอบอำนาจ   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_attorney/save'); ?>


<table class="tbadd">
	<tr>
		<th>ชื่อผู้รับมอบอำนาจ<span class="Txt_red_12"> *</span></th>
		<td><input name="names" type="text"  style="width:500px;" value="<?php echo $rs['names']; ?>" /></td>
	</tr>
</table>


<div id="btnBoxAdd">
  <input type="submit" value="" class="btn_save"/>
  <input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_hidden('id', $rs['id']); ?>
<?php echo form_close(); ?>