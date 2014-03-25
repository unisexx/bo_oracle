<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				typeps_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_child_support/chk_typeps_name',
							 data: { typeps_name:function(){ return $('[name=typeps_name]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				typeps_name:{required:"กรุณาระบุชื่อประเภทสงเคราะห์เด็ก", remote:"มีชื่อประเภทสงเคราะห์เด็กนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ประเภทสงเคราะห์เด็ก (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_child_support/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อประเภทสงเคราะห์เด็ก<span class="Txt_red_12"> *</span></th>
  <td><input name="typeps_name" type="text"  style="width:500px;" value="<?php echo $rs['typeps_name']; ?>" /></td>
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