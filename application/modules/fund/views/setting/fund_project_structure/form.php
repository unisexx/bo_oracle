<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				ps_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_structure/chk_ps_name',
							 data: { ps_name:function(){ return $('[name=ps_name]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				ps_name:{required:"กรุณาระบุชื่อลักษณะโครงการ", remote:"มีชื่อลักษณะโครงการนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ลักษณะโครงการ (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_structure/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อลักษณะโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="ps_name" type="text"  style="width:500px;" value="<?php echo $rs['ps_name']; ?>" /></td>
</tr>
<tr>
  <th>ลำดับการแสดง<span class="Txt_red_12"> *</span></th>
  <td><input name="seq" type="text"  style="width:500px;" value="<?php echo $rs['seq']; ?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="submit" value="" class="btn_save"/>
  <input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_hidden('id', $rs['id']); ?>
<?php echo form_close(); ?>