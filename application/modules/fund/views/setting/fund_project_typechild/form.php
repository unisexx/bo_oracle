<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				typep_child_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_typechild/chk_typep_child_name',
							 data: { typep_child_name:function(){ return $('[name=typep_child_name]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				typep_child_name:{required:"กรุณาระบุชื่อประเภทเด็ก", remote:"มีชื่อประเภทเด็กนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ประเภทเด็ก (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_typechild/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อประเภทเด็ก<span class="Txt_red_12"> *</span></th>
  <td><input name="typep_child_name" type="text"  style="width:500px;" value="<?php echo $rs['typep_child_name']; ?>" /></td>
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