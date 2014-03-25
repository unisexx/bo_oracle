<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				fund_project_structure_id:{required:true},
				pssub_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_structuresub/chk_pssub_name',
							 data: { 
							 		 pssub_name:function(){ return $('[name=pssub_name]').val(); },	
							 		 fund_project_structure_id:function(){ return $('[name=fund_project_structure_id]').val(); },
							    	 id:function(){ return $('[name=id]').val(); }
							       }
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				fund_project_structure_id:{required:"กรุณาระบุลักษณะโครงการ"},
				pssub_name:{required:"กรุณาระบุชื่อส่วนงานสวัสดิการสังคม", remote:"มีชื่อส่วนงานสวัสดิการสังคมนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ส่วนงานสวัสดิการสังคม (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_structuresub/save'); ?>
<table class="tbadd">
<tr>
  <th>ลักษณะโครงการ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('fund_project_structure_id',get_option('id','ps_name','fund_project_structure order by seq asc'),@$rs['fund_project_structure_id'],'','-- เลือกลักษณะโครงการ --'); ?>
  </td>
</tr>
<tr>
  <th>ชื่อส่วนงานสวัสดิการสังคม<span class="Txt_red_12"> *</span></th>
  <td><input name="pssub_name" type="text"  style="width:500px;" value="<?php echo $rs['pssub_name']; ?>" /></td>
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