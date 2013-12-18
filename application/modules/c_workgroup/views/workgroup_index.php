<script type="text/javascript">
function ReloadDivision(pDepartmentID)
{
				url = 'c_user/ajax_division_list/'+pDepartmentID;
				url = urlEncode(url,false);
				$("#division").attr('disabled','disabled'); 
				$("#dvDivision").append("<img src='images/loading.gif' align='absmiddle'>");
				$.get(url,function(data){			
				$("#dvDivision").html(data);				
				});							
				$("#division").removeAttr("onchange","null");					
}
</script>
<h3>ตั้งค่า กลุ่มงาน (กลุ่ม/ฝ่าย)</h3>
<div id="search">
<div id="searchBox">

<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_workgroup/index">
	ชื่อกลุ่มงาน
  <input name="txtsearch" type="text" size="40" value="<? if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  	กรม  
  <select name="department" id="department" onchange="ReloadDivision(this.value);">
    <option value="">-- ทุกกรม --</option>
    <?
    $getdepartment = isset($_GET['department']) ? $_GET['department']:"";
	$sresult = $this->department->get(FALSE,TRUE);	
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($getdepartment==$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach ?>
 </select>  
 	หน่วยงาน
  <div id="dvDivision" style="display:inline;">  	
  <select name="division" id="division">
    <option value="">-- ทุกหน่วยงาน --</option>
    <?
    $getdivision = isset($_GET['division']) ? $_GET['division']:"";
	$condition =   @$_GET['department'] != ''  ? "departmentid=".$_GET['department']:"";
	$sresult = $this->division->where($condition)->order_by("title","asc")->get(FALSE,TRUE);
	foreach($sresult as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if($getdivision==$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
  </div>
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>  
  </div>
</div>


<?php if(permission('c_workgroup', 'canadd')): ?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_workgroup/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อกลุ่มงาน</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">กรม</th>
  <?php if(permission('c_workgroup', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
  ?> 
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_workgroup/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> </td>
  <td onclick="window.location='c_workgroup/form/<?=$row['id'];?><?=$url_parameter;?>'" >
  <?
  	 @$division = $this->division->get_row($row['divisionid']);
	 echo @$division['title'];	
  ?>
  </td>
  <td  >
  <?
  	@$department = $this->department->get_row($division['departmentid']);
	echo @$department['title'];
  ?>
  </td>
  <?php if(permission('c_workgroup', 'candelete')): ?>
  <td>
  	<a href="c_workgroup/delete/<?php echo $row['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
	<input type="button" class="btn_delete" >
	</a>
  </td>
  <?php endif;?>
  </tr>
<tr>
<? 	
	$i++;
	endforeach;
?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>