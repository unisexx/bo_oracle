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
	<!--<option value="LOGIN" <? if(@$_GET['actiontype']=='LOGIN')echo 'selected="selected"';?>>เข้าสู่ระบบ</option>
	<option value="LOGOUT" <? if(@$_GET['actiontype']=='LOGOUT')echo 'selected="selected"';?>>ออกจากระบบ</option>-->
	<option value="VIEW" <? if(@$_GET['actiontype']=='VIEW')echo 'selected="selected"';?>>ดูรายละเอียดข้อมูล</option>
	<option value="ADD" <? if(@$_GET['actiontype']=='ADD')echo 'selected="selected"';?>>เพิ่มข้อมูล</option>
	<option value="EDIT" <? if(@$_GET['actiontype']=='EDIT')echo 'selected="selected"';?>>แก้ไขข้อมูล</option>
	<option value="DELETE" <? if(@$_GET['actiontype']=='DELETE')echo 'selected="selected"';?>>ลบข้อมูล</option>
  </select>  
  	<select name="system" id="system">
		<option value="monitor" <? if(@$_GET['system']=='monitor')echo 'selected="selected"';?>>ข้อมูลระบบติดตามและประเมินผล</option>		
    </select>  
วันที่ <input type="text" class="datepicker" name="start_date" id="start_date" style="width:90px;" value="<?=@$_GET['start_date'];?>"> 
ถึง <input type="text" class="datepicker" name="end_date" id="end_date" style="width:90px;" value="<?=@$_GET['end_date'];?>">    
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>

<!-- <? if(permission('c_province','canadd')){?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_province/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? } ?> -->
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
</tr>
<? 	
  $i++;
  endforeach;
?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>