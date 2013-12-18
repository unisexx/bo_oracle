<h3>ตั้งค่า จัดการโครงการและวัตถุประสงค์</h3>
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
<!--   จังหวัด
  <?= form_dropdown('provinceid',get_option('id','title', 'cnf_province order by title '),@$_GET['provinceid'],'','-- เลือกจังหวัด --','');?> -->
ชื่อโครงการ
<input name="title" type="text" size="50" value="<?=@$_GET['title']?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>
<?php if(permission('inspect_project_management', 'canadd')):?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="window.location='inspect_project_management/form';" class="btn_add"/>
</div>
<?php endif;?>

<?=$pagination;?>        


<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left" width="400">โครงการ</th>
  <!-- <th align="left">จังหวัด</th> -->
  <?php if(permission('inspect_project_management', 'candelete')):?><th align="left">ลบ</th><?php endif;?>
</tr>
<?php
  $rowStyle = ""; 
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
  foreach($result as $key=>$row){ 
?>    
<tr <?php echo cycle($key)?> onclick="window.location='inspect_project_management/form/<?=$row['id'];?><?=$url_parameter;?>';">
  <td><?=$i;?></td>
  <td><?=($row['budgetyear']+543);?></td>
  <td nowrap="nowrap"><?=$row['title'];?> <?php echo @$row['projecttitle'] != "" ?"(".@$row['projecttitle'].")":"";?></td>
  <?php if(permission('inspect_project_management', 'candelete')):?>
  <td><a href="inspect_project_management/delete/<?php echo $row['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a></td>
  <?php endif;?>
</tr>
<? $i++;} ?>
</table>

<?=$pagination;?>