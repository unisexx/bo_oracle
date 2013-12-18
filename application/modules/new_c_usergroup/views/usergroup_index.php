<h3>ตั้งค่า สิทธิ์การใช้งาน</h3>
<form enctype="multipart/form-data" method="get" action="c_usergroup/index">
<div id="search">
<div id="searchBox">ชื่อสิทธิ์การใช้งาน 
  <input name="txtsearch" type="text" size="30" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>

<?php if(permission('c_usergroup', 'canadd')): ?>
<div id="btnBox" style="text-align:right;float:right;">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_usergroup/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อสิทธิ์การใช้งาน</th>
  <th align="left">การใช้ระบบงาน</th>
  <?php if(permission('c_usergroup', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
</tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item): ?>
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>  >
  <td><?php echo $i;?></td>
  <td onclick="window.location='c_usergroup/form/<?php echo $item['id'];?><?=$url_parameter;?>'"><?php echo $item['title'];?></td>
  <td>
	<?php echo ShowUserTypeSystem($item['id']);?>
  </td>
  <?php if(permission('c_usergroup', 'candelete')): ?>
  <td>  	
  	<a href="c_usergroup/delete/<?php echo $item['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
	<input type="button" class="btn_delete" >
	</a>
  </td>
  <?php endif;?>
  </tr>
  <?php
  $i++; 
  endforeach; 
  ?>  
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>