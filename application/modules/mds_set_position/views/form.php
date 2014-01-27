<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				pos_name:{required:true, 
							    		remote:{
							    			url:'<? echo $urlpage; ?>/check_pos_name',
							    			data: { pos_name:function(){ return $('[name=pos_name]').val(); },	
							    					id:function(){ return $('[name=id]').val(); }
							    				  }
							    			}
				    	}
			},
			messages:{
				pos_name:{required:"กรุณาระบุตำแหน่งสายบริหาร", remote:"มีตำแหน่งสายบริหารชื่อนี้แล้ว"}
			}
		});
});
</script>
<h3>ตั้งค่า ตำแหน่งสายบริหาร (บันทึก / แก้ไข)</h3>
<form action="<?php echo $urlpage;?>/save" method="post">
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo @$rs['id']?>" style="width:500px;" />
<table class="tbadd">
<tr>
  <th>ชื่อตำแหน่งสายบริหาร<span class="Txt_red_12"> *</span></th>
  <td><input type="text" name="pos_name" id="pos_name" value="<?php echo @$rs['pos_name']?>" class="form-control" style="width:500px;" /></td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>