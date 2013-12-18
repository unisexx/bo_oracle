ประวัติการใช้งาน
คำค้นหา  :  <?=$_GET['txtsearch'];?> <br>
ประเภทการใช้งาน : <? if(@$_GET['actiontype']=='')echo "ทั้งหมด"; else echo $_GET['actiontype'];?> <br>
ระบบ : <? if(@$_GET['system']=='')echo "ทุกระบบ"; else echo $system_name; ?> <br>
วันที่ : <? if(@$_GET['start_date']!='' && @$_GET['end_date']!='') echo @$_GET['start_date']. " ถึง ".@$_GET['end_date']; ?>  

<table border="1" cellpadding="5" cellspacing="0">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">วันที่/เวลา</th>
  <th align="left">ประวัติการใช้งาน</th>
  <th align="left">ผู้ใช้</th>
  <th align="left">หน่วยงาน</th>
  <th>จังหวัด</th>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* $perpage)+1:1;
  foreach($result as $row):	  
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td ><?=stamp_to_th($row['process_date'],TRUE);?></td>
  <td ><?=$row['action'];?></td>           
  <td ><?=$row['name'];?></td>   
  <td>
  	  <?=$row['department_title'].'<br>'.$row['division_title']."<br>".$row['workgroup_title'];?>
  </td>
  <td>
  	  <?=$row['wprovince_name'];?>
  </td>
</tr>
<? 	
  $i++;
  endforeach;
?>
</table>