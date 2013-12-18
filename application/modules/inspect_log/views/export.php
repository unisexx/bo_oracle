<script type="text/javascript">
</script>
<h3>ประวัติการใช้งาน</h3>
<table class="tblist" border="1">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">วันที่/เวลา</th>
  <th align="left">ประวัติการใช้งาน</th>
  <th align="left">ผู้ใช้</th>
  <th align="left">หน่วยงาน</th>
  </tr>
  <?php 
  $i=1;
  foreach($result as $row):	  
  ?>  
<tr <? if(@$rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td ><?=stamp_to_th($row['process_date'],TRUE);?></td>
  <td ><?=$row['action'];?></td>           
  <td ><?=$row['name'];?></td>   
  <td>
  	  <?=$row['department_title'].'<br>'.$row['division_title']."<br>".$row['workgroup_title'];?>
  </td>
</tr>
<? 	
  $i++;
  endforeach;
?>
</table>