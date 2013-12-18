<table border="1">
<tr>
  	<th align="left">ลำดับ</th>
  	<th align="left">ชื่อ - สกุล</th>
  	<th align="left">User Name</th>
  	<th align="left">หน่วยงาน / กลุ่มงาน</th>
  	<th align="left">ระบบงานทะเบียนเครือข่าย</th>
  	<th align="left">ระบบงานพ.ร.บ. ส่งเสริมการจัดสวัสดิการสังคมฯ </th>
  	<th align="left">ระบบงานติดตามและประเมินผล</th>
  	<th align="left">ระบบงานตรวจราชการ</th>
  	<th align="left">ระบบงานบริหารกองทุน</th>
  	<th align="left">ระบบงานพัฒนาระบบบริหาร</th>
  	<th align="left">ระบบพ.ร.บ.คุ้มครองเด็ก</th>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 100)+1:1;
  //$i=1;
  foreach($result as $item):
	  $upermission = check_permission($item['username']); 
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>  >
  <td><?=$i;?></td>
  <td><?=$item['name'];?> </td>
  <td><?=$item['username'];?> </td>
  <td>
	<?php
		if($item['division_title']==''){
			echo $upermission['sub_unit_name'];
		} else{
		echo $item['division_title']."<br>".$item['workgroup_title'];
		}
	?>  
  </td>        
  <td style="text-align: center"><? echo $upermission['network_canuse'];?>&nbsp;</td>
  <td style="text-align: center"><? echo $upermission['msolaws_canuse'];?>&nbsp;</td>
  <td style="text-align: center"><? echo $upermission['monitor_canuse'];?>&nbsp;</td>
  <td style="text-align: center"><? echo $upermission['inspect_canuse'];?>&nbsp;</td>
  <td style="text-align: center"><? echo $upermission['funds_canuse'];?>&nbsp;</td>
  <td style="text-align: center"><? echo $upermission['management_canuse'];?>&nbsp;</td>    
  <td style="text-align: center"><? echo $upermission['child_canuse'];?>&nbsp;</td>         
</tr>
<?php
	$i++;
	endforeach; 
?>
</table>