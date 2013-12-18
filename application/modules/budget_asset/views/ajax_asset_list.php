<table class="tblist tb_user_list">
<tr>
  	<th  align="left">ลำดับ</th>
	<th  align="left">ชื่อรายการ</th>
	<th  align="left">หน่วยนับ</th>
	<th  align="left">ราคา</th>
	<th  align="left">ประเภท</th>	 
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):	  	
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>  >
  <td><?=$i;?></td>
  <td onclick="" ><?=$row['assetname'];?>&nbsp;</td>
  <td onclick="" ><?=$row['unit_title'];?>&nbsp;</td>
  <td onclick="" align="right" ><?=number_format($row['price']);?>&nbsp;  
  </td>        
  <td onclick="">
  <?=$row['asset_type_title'];?>&nbsp;
  <input type="hidden" name="hd_item_id" id="hd_item_id" value="<?=$row['id'];?>">
  <input type="hidden" name="hd_item_name" id="hd_item_name" value="<?=$row['assetname'];?>">  	  
  </td>    
  </tr>
<tr>
<?php
	$i++;
	endforeach; 
?>
</table>
<!--