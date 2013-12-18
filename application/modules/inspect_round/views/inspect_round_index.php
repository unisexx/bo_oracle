<script type="text/javascript">
	$(document).ready(function(){
		//var col=$('<td><input type="button" name="button"  value="x" class="btn_delete" /></td>');
		//$('.col_round').after(col);
		$('.btn_delete').live('click',function(){
			var id=$(this).parents("td").siblings(".col_round").find("input[name=id]").val();
			if(confirm('<?php echo NOTICE_CONFIRM_DELETE?>'))
			{
				$.ajax({
					type:'GET',
					url:'inspect_round/delete',
					data:'id='+id,
				});
					
				$(this).parents("tr").fadeOut();	
			}
			
		});
			
		
	});
</script>
<h3>ตั้งค่า กำหนดรอบ</h3>
<div id="search">
<div id="searchBox">
<form method="get" action="inspect_round/index">
<?php echo form_dropdown('mtyear',get_option('distinct(mtyear)','mtyear+543','mt_strategy'),@$_GET['mtyear'],'','-- เลีอกปีงบประมาณ --','0'); ?> 
ชื่อรอบ<input name="round_name" type="text" size="50" value="<?php echo @$_GET['round_name'] ?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>
</div>
<?php if(permission('inspect_round', 'canadd')):?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='inspect_round/form'" class="btn_add"/>
</div>
<?php endif;?>

<?php echo $pagination;?>        

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">รอบการตรวจ</th>
  <?php if(permission('inspect_round', 'candelete')):?>
  <th align="left">ลบ</th>
  <?php endif;?>
</tr>
<?php 
$temp_id="";
$i=0;
foreach($result as $key => $item): ?>
<?php 
if($item['id']!=$temp_id){
	$temp_id=$item['id'];
	$i++; 
?>
<tr class="odd cursor" >
  <td onclick="window.location='inspect_round/form/<?php echo $item['id'] ?><?=$url_parameter;?>'"><?php echo $i; ?></td>
  <td nowrap="nowrap" onclick="window.location='inspect_round/form/<?php echo $item['id'] ?><?=$url_parameter;?>'"><?php echo $item['mt_year']+543 ?></td>
  
  <td class="col_round" onclick="window.location='inspect_round/form/<?php echo $item['id'] ?><?=$url_parameter;?>'">
  	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
  	<?php echo $item['round_name'].br(1) ?>
  
<?php }else{ ?>
  <?php echo $item['round_name'].br(1) ?>
<?php } ?>

<?php endforeach; ?>
	<?php if(permission('inspect_round', 'candelete')):?>
	<td><input type="button" name="button"  value=" " class="btn_delete" /></td>
	<?php endif;?>
</table>

<?php echo $pagination;?>