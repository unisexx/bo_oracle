<h3>ตั้งค่า หน่วยงาน (กอง/สำนัก)</h3>
<div id="search">
<div id="searchBox">ชื่อหน่วยงาน
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_division/index">
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <select name="department" id="department">
    <option value="">-- ทุกกรม --</option>
    <?
	$sresult = $this->department->get();
	$getDepartment = isset($_GET['department']) ? $_GET['department'] : '';
	foreach($sresult as $srow): 
	?>
    <option value="<?=$srow['id'];?>" <? if($getDepartment==$srow['id'])echo "selected";?> ><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>
</div>

<?php if(permission('c_division', 'canadd')): ?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_division/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">กรม</th>
  <?php if(permission('c_division', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
  ?> 
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_division/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> </td>
  <td  >
  <?
	$department = $this->department->get_row($row['departmentid']);
	echo $department['title'];
  ?>
  </td>
  <?php if(permission('c_division', 'candelete')): ?>
  <td>
  	<a href="c_division/delete/<?php echo $row['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
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