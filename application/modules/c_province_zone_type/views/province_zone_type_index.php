<h3>ตั้งค่าประเภท กลุ่มภาค จังหวัด</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_province_zone_type/index">
<div id="search">
<div id="searchBox">ชื่อประเภทภาค
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
    <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
    </div>
</div>
</form>    


<? if(permission('c_province_zone_type','canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_province_zone_type/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อประเภทภาค</th>
  <th align="left">ลบ</th>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_province_zone_type/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> </td>
  <td>
  	<? if(permission('c_province_zone_type','candelete')):?>
  	<a href="c_province_zone_type/delete/<?php echo $row['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">
  		<input type="button" class="btn_delete" />
  	</a>
  	<? endif;?>  	
  </td>
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