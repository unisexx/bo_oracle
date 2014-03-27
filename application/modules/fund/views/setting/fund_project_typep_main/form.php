<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				typep_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_typep_main/chk_typep_name',
							 data: { typep_name:function(){ return $('[name=typep_name]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				typep_name:{required:"กรุณาระบุชื่อประเภทโครงการ", remote:"มีชื่อประเภทโครงการนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ประเภทโครงการ   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_typep_main/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อประเภทโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="typep_name" type="text"  style="width:500px;" value="<?php echo $rs['typep_name']; ?>" /></td>
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