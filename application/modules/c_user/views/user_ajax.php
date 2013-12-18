<!--
<div id="paging" class="frame_page">
<?php //echo $pagination;?>
</div>
-->
<style type="text/css">
.tb_user_list td{
	cursor:pointer;
	cursor:hand;
}	
</style>
<table class="tblist tb_user_list">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อ - สกุล</th>
  <th align="left">หน่วยงาน / กลุ่มงาน</th>
  <th align="left">อีเมล์</th>  
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
	  $workgroup = $this->workgroup->get_row($item['workgroupid']);
	  $division = $this->division->get_row($item['divisionid']);   	 
	  $usergroup = $this->usertype_title->get_row($item['usertype']);	 
	  $exist = $this->db->getone("SELECT COUNT(*) FROM USER_TYPE_TITLE WHERE USER_ID=".$item['id']);
	  $exist = $exist > 0 ?  'exist' : 'nexist';
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>  >
  <td><?=$i;?>
  	<input type="hidden" name="hd_user_id" id="hd_user_id" value="<?=$item['id'];?>">
  	<input type="hidden" name="hd_user_name" id="hd_user_name" value="<?=$item['name'];?>">
  	<input type="hidden" name="hd_user_exist" id="hd_user_exist" value="<?=$exist;?>">  	
  </td>
  <td onclick="" ><?=$item['name'];?> </td>
  <td onclick="" align="center" >
	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $division['title'];?> &lt;br&gt; <?php echo $workgroup['title'];?>" />  
  </td>        
  <td onclick="">
  <?php	echo $item['email'];?>
  </td>    
  </tr>
<tr>
<?php
	$i++;
	endforeach; 
?>
</table>
<!--
<div id="paging" class="frame_page">
<?php //cho $pagination;?>
</div>-->