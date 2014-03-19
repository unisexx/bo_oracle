<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				typep_main_id:{required:true},
				typep_sub_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_typep_sub/chk_typep_sub_name',
							 data: { 
							 		 typep_sub_name:function(){ return $('[name=typep_sub_name]').val(); },
							 		 typep_main_id:function(){ return $('[name=typep_main_id]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				typep_main_id:{required:"กรุณาระบุประเภทโครงการ"},
				typep_sub_name:{required:"กรุณาระบุชื่อประเภทโครงการย่อย", remote:"มีชื่อประเภทโครงการย่อยนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ประเภทโครงการย่อย   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_typep_sub/save'); ?>
<table class="tbadd">
<tr>
  <th>ประเภทโครงการ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('typep_main_id',get_option('id','typep_name','fund_project_typep_main order by seq asc'),@$rs['typep_main_id'],'','-- เลือกประเภทโครงการ --'); ?>
  </td>
</tr>
<tr>
  <th>ชื่อประเภทโครงการย่อย<span class="Txt_red_12"> *</span></th>
  <td><input name="typep_sub_name" type="text"  style="width:500px;" value="<?php echo @$rs['typep_sub_name']; ?>" /></td>
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