<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename='ผู้ใช้งาน.xls'");
?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อ - สกุล</th>
  <th align="left">User Name</th>
  <th align="left">หน่วยงาน / กลุ่มงาน</th>
  <th align="left">อีเมล์</th>
  </tr>
  <?php 
  foreach($result as $key=>$item):
	  $workgroup = $item['workgroupid'] > 0 ? $this->workgroup->get_one('title','id',$item['workgroupid']) : '';
	  $division = $this->division->get_row($item['divisionid']);   	 
	  $usergroup = $this->usertype_title->get_row($item['usertype']);	 
  ?>  
	<tr>
	  <td><?=$key+1;?></td>
	  <td><?=$item['name'];?> </td>
	  <td><?=$item['username'];?></td>
	  <td><?php echo $division['title'];?> <?php echo @$workgroup;?></td>        
	  <td><?php	echo $item['email'];?></td>    
	</tr>
  <?php endforeach; ?>
</table>