<script type="text/javascript">
$(document).ready(function(){
		$("form").validate({
			rules: {
				indicator_on:{required:true, 
							    		remote:{
							    			url:'<? echo $urlpage; ?>/check_indicator_on',
							    			data: { indicator_on:function(){ return $('[name=indicator_on]').val(); }, 
							    					budget_year:function(){ return $('[name=budget_year]').val(); },
							    					id:function(){ return $('[name=id]').val(); } 
							    				  }
							    			},
							    			min: 1,
							    			max: <?=@$max_indicator_on?>
				    			},
				indicator_name:{required:true, 
							    		remote:{
							    			url:'<? echo $urlpage; ?>/check_indicator_name',
							    			data: { indicator_name:function(){ return $('[name=indicator_name]').val(); }, 
							    					budget_year:function(){ return $('[name=budget_year]').val(); },
							    					id:function(){ return $('[name=id]').val(); } 
							    				  }
							    			}
				    				  }
			},
			messages:{
				indicator_on:{required:"กรุณาระบุมิติที่", remote:"มีลำดับมิตินี้แล้ว",min:"ลำดับน้อยสุดคือ 1",max:"ลำดับมากสุดคือ <?=@$max_indicator_on?>"},
				indicator_name:{required:"กรุณาระบุชื่อมิติ", remote:"มีชื่อมิตินี้แล้ว"}
			}
		});
		
		
});
</script>
<h3>ตั้งค่า  มิติและตัวชี้วัด (เพิ่ม / แก้ไข)</h3>
<h5>มิติ</h5>
<form action="<?php echo $urlpage;?>/save" method="POST">
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo @$rs['id']?>" style="width:500px;" />
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
    <td><input type="text" name="budget_year" id="budget_year" readonly="readonly" value="<?=@$rs['budget_year']?>" /></td>
  </tr>
  <tr>
    <th>มิติที่<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="indicator_on" id="indicator_on"style="width:50px;" maxlength="5" value="<?=@$rs['indicator_on']?>" <?php echo empty($rs['id'])?'':'readonly="readonly"' ?> class="numOnly" /></td>
  </tr>
  <tr>
    <th>ชื่อมิติ<span class="Txt_red_12"> *</span></th>
    <td><input type="text" name="indicator_name" id="indicator_name" class="form-control" value="<?=@$rs['indicator_name']?>" style="width:500px;" /></td>
  </tr>
  <tr>
    <th>เป้าประสงค์</th>
    <td><input type="text" id="objective_name" name="objective_name" value="<?=@$rs['objective_name']?>" style="width:500px;"/></td>
  </tr>
  <tr>
    <th>ประเด็นยุทธศาสตร์</th>
    <td><input type="text" name="subject_name"  id="subject_name" value="<?=@$rs['subject_name']?>" style="width:500px;"/></td>
  </tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>