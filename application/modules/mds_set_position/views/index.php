<link href="themes/mdevsys/js/bootstrap_switch/bootstrap-switch.css" rel="stylesheet">
<script src="themes/mdevsys/js/bootstrap_switch/bootstrap-switch.js"></script>
<script>
	$(document).ready(function(){
		$('.change_status').bootstrapSwitch();

		$('.change_status').live('change', function (){
			var ref_id = $(this).attr('ref_id');
			$('.change_status').attr('disabled', 'disabled');
			
			if(confirm('ท่านต้องการเปลี่ยนสถานะ การใช้งาน')) {	
				if ($("[name='status_id["+ref_id+"]']").is(':checked')){
					$('#status_div_'+ref_id).html("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>")
					$.get('<? echo site_url(); ?>mds_set_position/change_status',
					{ ref_id:ref_id , status_id:0 },
						function(data){
							$(".loading").remove();
							$('#status_div_'+ref_id).html(data);
							$("[name='status_id["+ref_id+"]']").bootstrapSwitch();
					 		$('.change_status').removeAttr('disabled');
					});		 
				}else{
					$('#status_div_'+ref_id).html("<img class='loading' src='images/loading.gif' style='vertical-align:bottom'>")
					$.get('<? echo site_url(); ?>mds_set_position/change_status',
					{ ref_id:ref_id , status_id:1 },
						function(data){
							$(".loading").remove();
							$('#status_div_'+ref_id).html(data);
							$("[name='status_id["+ref_id+"]']").bootstrapSwitch();
					 		$('.change_status').removeAttr('disabled');
					});		
				}
			}else{
				if ($("[name='status_id["+ref_id+"]']").is(':checked')){
					var text = '<input type="checkbox" name="status_id['+ref_id+']" value="1" class="change_status" ref_id="'+ref_id+'" checked="checked" data-on-label="เปิด" data-off-label="ปิด" />';			
						$('#status_div_'+ref_id).html(text);
						$("[name='status_id["+ref_id+"]']").bootstrapSwitch();
				}else{
					var text = '<input type="checkbox" name="status_id['+ref_id+']" value="1" class="change_status" ref_id="'+ref_id+'" data-on-label="เปิด" data-off-label="ปิด" />';			
						$('#status_div_'+ref_id).html(text);
						$("[name='status_id["+ref_id+"]']").bootstrapSwitch();
				}
				$('.change_status').removeAttr('disabled');
			}
		});
	});
</script>
<h3>ตั้งค่า ตำแหน่งสายบริหาร</h3>
<form method="GET">
<div id="search">
<div id="searchBox">ชื่อตำแหน่งสายบริหาร
  <input name="sch_txt" type="text" id="sch_txt" size="50" value="<?=@$_GET['sch_txt']?>" /> 
   สถานะ
	<?php echo form_dropdown("sch_status_id",$option_status,@$_GET['sch_status_id'],'','=== เลือกการแสดง ===') ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<div id="btnBox"><input type="submit" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo @$urlpage;?>/form'" class="btn_add"/></div>

<?=@$pagination;?>        

<table class="tblist">
<tr>
  <th align="left" style="width: 100px">ลำดับ</th>
  <th align="left">ชื่อตำแหน่งสายบริหาร</th>
  <th align="left">สถานะ</th>
  <th align="left" style="width: 50px">ลบ</th>
  </tr>
<? 
	$rowStyle = '';
	$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
	foreach ($rs as $key => $item) {
?>
	<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
			<td><? echo ($key+1)+(($_GET['page']-1)*20);?></td>
			<td onclick="window.location='<?php echo @$urlpage;?>/form/<?=$item['id'];?>'"><? echo $item['pos_name'];?></td>
			<td>
				<div id="status_div_<?=$item['id'];?>">
					<input type="checkbox" name="status_id[<?=$item['id']?>]" value="1" class="change_status" ref_id="<?=$item['id']?>" <?php echo empty($item['status_id'])?'':'checked="checked"'; ?> data-on-label="เปิด" data-off-label="ปิด" />
				</div>
			</td>
			<td>
			  	<a href="<?php echo @$urlpage;?>/delete/<?php echo $item['id'];?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
				<input type="button" class="btn_delete" >
				</a>     	
			</td>		
	</tr>
<?
	}
?>
</table>

<?=@$pagination;?>   