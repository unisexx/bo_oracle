<script type="text/javascript">		
</script>
<h3>ประวัติการใช้งาน</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" >
<div id="search">
<div id="searchBox">
ประวัติการใช้งาน
  <input name="txtsearch" type="text" size="40" value="<? echo @$_GET['txtsearch'];?>" />
  <select name="actiontype" id="actiontype">
	<option value="" selected="selected">ประเภทการใช้งาน</option>
	<option value="LOGIN" <? if(@$_GET['actiontype']=='LOGIN')echo 'selected="selected"';?>>เข้าสู่ระบบ</option>
	<option value="LOGOUT" <? if(@$_GET['actiontype']=='LOGOUT')echo 'selected="selected"';?>>ออกจากระบบ</option>
	<option value="VIEW" <? if(@$_GET['actiontype']=='VIEW')echo 'selected="selected"';?>>ดูรายละเอียดข้อมูล</option>
	<option value="ADD" <? if(@$_GET['actiontype']=='ADD')echo 'selected="selected"';?>>เพิ่มข้อมูล</option>
	<option value="EDIT" <? if(@$_GET['actiontype']=='EDIT')echo 'selected="selected"';?>>แก้ไขข้อมูล</option>
	<option value="DELETE" <? if(@$_GET['actiontype']=='DELETE')echo 'selected="selected"';?>>ลบข้อมูล</option>
  </select>  
  	<select name="system" id="system">
  		<option value="" selected="selected">ทุกระบบ</option>
		<option value="c" <? if(@$_GET['system']=='c')echo 'selected="selected"';?>>ข้อมูล Back office</option>
		<option value="budget" <? if(@$_GET['system']=='budget')echo 'selected="selected"';?>>ข้อมูลระบบจัดทำคำของบประมาณ</option>
		<option value="finance" <? if(@$_GET['system']=='finance')echo 'selected="selected"';?>>ข้อมูลระบบคลัง</option>
		<option value="monitor" <? if(@$_GET['system']=='monitor')echo 'selected="selected"';?>>ข้อมูลระบบติดตามและประเมินผล</option>
		<option value="inspect" <? if(@$_GET['system']=='inspect')echo 'selected="selected"';?>>ข้อมูลระบบตรวจราชการ</option>
    </select>  
วันที่ <input type="text" class="datepicker" name="start_date" id="start_date" style="width:90px;" value="<?=@$_GET['start_date'];?>"> 
ถึง <input type="text" class="datepicker" name="end_date" id="end_date" style="width:90px;" value="<?=@$_GET['end_date'];?>">    
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>


<div id="btnBox">  
  <span style="font-weight: bold;">Export :>></span>
  <?   
	if($nrow <= $per_export_set) 
	{ 				
		$num_pages =1; 
	} 
	else if(($nrow % $per_export_set)==0) 
	{ 
		$num_pages =($nrow/$per_export_set) ; 
	} 
	else
	{ 
		$num_pages =($nrow/$per_export_set)+1; 
		$num_pages = (int)$num_pages; 
	} 							
	for($i=1;$i<=$num_pages;$i++)
	{
		//echo " <span id=\"spPrintPart\" style=\"cursor:pointer;\" onClick=\"window.open('c_log/export".$url_parameter."&page=".$i."');\">Part".$i."</span>  |   ";
		echo " <a href=\"c_log/export".$url_parameter."&page=".$i."\" target=\"_blank\">Part".$i."</a>  |   ";
	}
?>  
</div><br><br>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
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
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
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
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>