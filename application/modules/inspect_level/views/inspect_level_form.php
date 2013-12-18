<link rel="Stylesheet" type="text/css" href="js/jpicker-1.1.6/css/jpicker-1.1.6.css" />
<link rel="Stylesheet" type="text/css" href="js/jpicker-1.1.6/jPicker.css" />
<script src="js/ui/jquery-ui-1.8.7.custom.js" type="text/javascript"></script>
<script src="js/jpicker-1.1.6/jpicker-1.1.6.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.Multiple').jPicker();
		
		$(".btn_add").click(function(){
			var numRand = Math.floor(Math.random()*99999);
			var rowCount = $('#sort tbody tr').length + 1;
			//--- แบบสลับตำแหน่งได้ ---
			//var row = "<tr id='listItem_"+rowCount+"'><td><img src='themes/inspect/images/arrow.png' alt='move' width='16' height='16' class='handle'></td><td><input type='text' name='range_start[]' value='' size='1'/> ~ <input type='text' name='range_end[]' value='' size='1'/></td><td><input type='text' name='color[]' class='Multiple-"+numRand+"' value='' size='6' /></td><td><input type='text' name='color_detail[]' size='75'></td><td><input type='hidden' name='orderlist[]' value=''><input type='button' class='btn_delete' /></td></tr>";
			var row = "<tr id='listItem_"+rowCount+"'><td><input type='text' name='range_start[]' value='' size='1'/> ~ <input type='text' name='range_end[]' value='' size='1'/></td><td><input type='text' name='color[]' class='Multiple-"+numRand+"' value='' size='6' /></td><td><input type='text' name='color_detail[]' size='75'></td><td><input type='hidden' name='orderlist[]' value=''><input type='button' class='btn_delete' /></td></tr>";
			$(row).appendTo(".tblist2");
			$(".Multiple-"+numRand).jPicker();
		});
		
		// Return a helper with preserved width of cells
		// var fixHelper = function(e, ui) {
		    // ui.children().each(function() {
		        // $(this).width($(this).width());
		    // });
		    // return ui;
		// };
// 		 
		// $("#sort tbody").sortable({
			// handle : '.handle',
		    // helper: fixHelper,
		    // update : function () {
// 				
			// }
		// }).disableSelection();
		
		$(".btn_delete").live("click",function(){
			var answer = confirm("ยืนยันการลบข้อมูลนี้");
			if(answer){
				var id = $(this).closest("tr").find(".id").val();
				if(id > 0){
					$.post('inspect_level/del_row',{
						'id' : id
					});
				}
				$(this).closest("tr").fadeOut(function(){$(this).remove();});
			}
		});
		
		$("form").validate({
			rules: {
				budgetyear:"required"
			},
			messages:{
				budgetyear:"กรุณาระบุข้อมูลด้วย"
			}
		});
		
	});
</script>

<form method="post" action="inspect_level/save<?=$url_parameter;?>">
<h3>กำหนดระดับความเสี่ยง</h3>
<table class="tbadd">
	<tbody>
		<tr>
		  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
		  <td>
			<?php echo form_dropdown('budgetyear',get_option('distinct(mtyear)','mtyear+543','mt_strategy where MTYEAR not in (select budgetyear from insp_level '.@$condition.')'),@$budgetyear,'','-- เลือกปีงบประมาณ --','0'); ?>
		  </td>
		</tr>
	</tbody>
</table>

<h3>กำหนดรายละเอียดระดับความเสี่ยง</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add"/></div>
<table class="tblist2" id="sort">
	<thead>
		<tr>
			<!--<th></th>-->
			<th>ค่าความเสี่ยงระหว่าง</th>
			<th>แสดงด้วยสี</th>
			<th>คำอธิบาย</th>
			<th>ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($level)):?>
		<?php foreach(@$level as $item):?>
			<tr id="listItem">
				<!--
				<td>
					<img src="themes/inspect/images/arrow.png" alt="move" width="16" height="16" class="handle">
				</td>
				-->
				<td><input type="text" name="range_start[]" value="<?php echo @$item['range_start']?>" size="1"/> ~ <input type="text" name="range_end[]" value="<?php echo @$item['range_end']?>" size="1"/></td>
				<td><input type="text" name="color[]" class="Multiple" value="<?php echo @$item['color']?>" size="6"/></td>
				<td><input type="text" name="color_detail[]" size="75" value="<?php echo @$item['color_detail']?>"></td>
				<td>
					<input type="hidden" class="id" name="id[]" value="<?php echo @$item['id']?>">
					<input type="hidden" name="orderlist[]" value="">
					<input type="button" class="btn_delete" />
				</td>
			</tr>
		<?php endforeach;?>
		<?php endif;?>
		<tr id="listItem">
			<!--
			<td>
				<img src="themes/inspect/images/arrow.png" alt="move" width="16" height="16" class="handle">
			</td>
			-->
			<td><input type="text" name="range_start[]" value="" size="1"/> ~ <input type="text" name="range_end[]" value="" size="1"/></td>
			<td><input type="text" name="color[]" class="Multiple" value="" size="6"/></td>
			<td><input type="text" name="color_detail[]" size="75"></td>
			<td>
				<input type="hidden" name="orderlist[]" value="">
				<input type="button" class="btn_delete" >
			</td>
		</tr>
	</tbody>
</table>

<div id="btnBoxAdd">
	<input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>