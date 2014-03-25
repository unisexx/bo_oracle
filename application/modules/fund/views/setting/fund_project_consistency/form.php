<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				consistency_name:{required:true, 
						  remote:{
							 url:'fund/setting/fund_project_consistency/chk_consistency_name',
							 data: { consistency_name:function(){ return $('[name=consistency_name]').val(); },	
							    	 id:function(){ return $('[name=id]').val(); }
							    	}
							}
				    },
				seq:{required:true,number:true}
			},
			messages:{
				consistency_name:{required:"กรุณาระบุชื่อความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆ", remote:"มีชื่อความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆนี้แล้ว"},
				seq:{required:"กรุณาระบุลำดับการแสดง",number:"กรุณาระบุเป็นตัวเลข"}
			}
		});
});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า ความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆ (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_project_consistency/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อความสอดคล้องกับหลักเกณฑ์ตามมาตรการต่างๆ<span class="Txt_red_12"> *</span></th>
  <td><input name="consistency_name" type="text"  style="width:500px;" value="<?php echo $rs['consistency_name']; ?>" /></td>
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