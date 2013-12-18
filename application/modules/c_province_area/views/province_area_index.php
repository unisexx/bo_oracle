<h3>ตั้งค่า เขตจังหวัด</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_province_area/index">
<div id="search">
<div id="searchBox">ชื่อเขตจังหวัด
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
    <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
    </div>
</div>
</form>

<? if(permission('c_province_area','canadd')){?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_province_area/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? } ?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>


<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อเขตจังหวัด</th>
  <?php if(permission('c_province_area', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_province_area/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> </td>
  <?php if(permission('c_province_area', 'candelete')): ?>
  <td>
  	<input type="button" name="button" id="button" value="x" class="btn_delete" onclick="confirmDelete('c_province_area/delete/<?=$row['id'];?><?=$url_parameter;?>','<?php echo NOTICE_CONFIRM_DELETE?>');">  	
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