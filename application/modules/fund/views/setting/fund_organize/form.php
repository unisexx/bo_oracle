<script type="text/javascript">
	function chain_amphur(child_obj, parent_id) 
	{
		child_obj.html('<option value="">Loading...</option>').attr('disabled', 'disabled');
		$.get('<? echo site_url(); ?>fund/setting/fund_organize/dd_chain_amphur', { 
			province_id:parent_id 
		}, function(data){
			child_obj.html(data).attr('disabled', false);
		});	
	}

	function chain_district(child_obj, parent_id) 
	{
		child_obj.html('<option value="">Loading...</option>').attr('disabled', 'disabled');
		$.get('<? echo site_url(); ?>fund/setting/fund_organize/dd_chain_district', { 
			amphur_id:parent_id 
		}, function(data){
			child_obj.html(data).attr('disabled', false);
		});	
	}
			
			
	$(document).ready(function(){
		$("form").validate({
			rules: {
				title:{
					required:true, 
					remote:{
						 url:'fund/setting/fund_organize/chk_fund_name',
						 data: { 
						 	title:function(){ return $('[name=title]').val(); },	
						    id:function(){ return $('[name=id]').val(); }
						}
					}
				},
				addr_number:{ required:true },
				addr_moo:{ required:true },
				addr_road:{ required:true },
				province_id:{ required:true },
				amphur_id:{ required:true },
				district_id:{ required:true },
				post_code:{ required:true }
			},
			messages:{
				title:{required:"กรุณาระบุชื่อองค์กร/หน่วยงาน", remote:"มีชื่อองค์กร/หน่วยงานนี้แล้ว"},
				addr_number:{ required:"กรุณาระบุข้อมูลที่อยู่" },
				addr_moo:{ required:"กรุณาระบุข้อมูลที่อยู่" },
				addr_road:{ required:"กรุณาระบุข้อมูลที่อยู่" },
				province_id:{ required:"กรุณาระบุข้อมูลจังหวัด" },
				amphur_id:{ required:"กรุณาระบุข้อมูลอำเภอ/เขต" },
				district_id:{ required:"กรุณาระบุข้อมูลตำบล/แขวง" },
				post_code:{ required:"กรุณาระบุข้อมูลรหัสไปรษณีย์" }
			}
		});
			
		$('[name=province_id]').change(function() {
			chain_amphur($('[name=amphur_id]'), $(this).val());
		});
		
		$('[name=amphur_id]').change(function() {
			chain_district($('[name=district_id]'), $(this).val());
		});
	});
</script>
<style>
	label.error { color: red; }
</style>
<h3>ตั้งค่า องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_organize/save'); ?>


<table class="tbadd">
	<tr>
		<th>ชื่อองค์กร/หน่วยงาน<span class="Txt_red_12"> *</span></th>
		<td><input name="title" type="text"  style="width:500px;" value="<?php echo $rs['title']; ?>" /></td>
	</tr>
	<tr>
		<th>อยู่เลขที่<span class="Txt_red_12"> *</span></th>
		<td><input name="address" type="text"  style="width:500px;" value="<?php echo $rs['address']; ?>" /></td>
	</tr>
	<tr>
		<th>หมู่ที่<span class="Txt_red_12"> *</span></th>
		<td><input name="moo" type="text"  style="width:50px;" value="<?php echo $rs['moo']; ?>" /></td>
	</tr>
	<tr>
		<th>ถนน<span class="Txt_red_12"> *</span></th>
		<td><input name="road" type="text"  style="width:250px;" value="<?php echo $rs['road']; ?>" /></td>
	</tr>
	<tr>
		<th>จังหวัด<span class="Txt_red_12"> *</span></th>
		<td><? echo form_dropdown('province_id', get_option('id', 'title', 'fund_province'), $rs['province_id'], false, '-- เลือกจังหวัด --'); ?></td>
	</tr>
	<tr>
		<th>อำเภอ/เขต<span class="Txt_red_12"> *</span></th>
		<td>
			<?
				if(empty($rs['province_id'])) {
					$goption = array();
				} else {
					$goption = get_option('id', 'title', 'fund_amphur where province_id = '.@$rs['province_id']);
				}
				
				echo form_dropdown('amphur_id', $goption, $rs['amphur_id'], false, '-- เลือกอำเภอ/เขต --'); 
			?>
		</td>
	</tr>
	<tr>
		<th>ตำบล/แขวง<span class="Txt_red_12"> *</span></th>
		<td>
			<? 
				if(empty($rs['amphur_id'])) {
					$goption = array();
				} else {
					$goption = get_option('id', 'title', 'fund_district where amphur_id = '.@$rs['amphur_id']);
				}
				
				echo form_dropdown('district_id', $goption, $rs['district_id'], false, '-- เลือกตำบล/แขวง --'); 
			?>
		</td>
	</tr>
	<tr>
		<th>รหัสไปรษณีย์</th>
		<td><input name="post_code" type="text"  style="width:100px;" value="<?php echo $rs['post_code']; ?>" /></td>
	</tr>
</table>


<div id="btnBoxAdd">
  <input type="submit" value="" class="btn_save"/>
  <input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_hidden('id', $rs['id']); ?>
<?php echo form_close(); ?>