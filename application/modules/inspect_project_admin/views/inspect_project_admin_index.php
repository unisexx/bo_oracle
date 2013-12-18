<script type="text/javascript">
$(document).ready(function(){
	$('.btn_expand').click(function(){
		$(this).closest('tr').next().toggle();
		
		if($(this).closest("tr").next("tr.boxSub").is(':hidden')){
				$(this).removeAttr('src');
				$(this).attr('src','themes/bo/images/tree/add.jpg');
		}else{
				$(this).removeAttr('src');
				$(this).attr('src','themes/bo/images/tree/minimize.png');
		}
	})
})
</script>
<h3>ผู้ดูแล โครงการ</h3>
<form enctype="multipart/form-data" method="get">
<div id="search">
<div id="searchBox">
  <select name="budgetyear" id="budgetyear">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($byear as $item){
    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
    }
    ?>
  </select>  
  <input name="title" type="text" size="50" value="<?=@$_GET['title']?>" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?=$pagination;?>  
      
<table class="tblist">
<tr>
  <th align="left">&nbsp;</th>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อโครงการ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">ลบ</th>
</tr>
<?php
  $rowStyle = ""; 
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
  foreach($result as $row){ 
?>    
<tr class="odd">
  <td>
  	<? if(CheckExistProjectDetail($row['id'])>0)echo '<img src="themes/inspect/images/tree/add.jpg" width="16" height="15" class="btn_expand" />';?>
  </td>
  <td><?=$i;?></td>
  <td class="cursor" onclick="window.location='inspect_project_admin/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> <?php echo $row['projecttitle'] != "" ?"(".$row['projecttitle'].")":""; ?></td>
  <td><?=$row['budgetyear']+543;?></td>
  <td>
  	<a href="inspect_project_admin/delete/<?php echo $row['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>  	
  </td>
</tr>
<? echo GetProjectDetail($row['id']);?>
<?php $i++;?>
<? } ?>
</table>

<?=$pagination;?>