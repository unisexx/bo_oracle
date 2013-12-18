<h3>ตั้งค่า อัพโหลดเอกสาร</h3>
<div id="search">
<div id="searchBox">ชื่อเอกสาร
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_document/index">
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>  
  </div>
</div>

<?php if(permission('c_document', 'canadd')): ?>
<div id="btnBox" style="text-align:right;float:right;">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_document/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อเอกสาร</th>
  <th align="left">หมายเหตุ</th>
  <?php if(permission('c_document', 'canadd')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_document/form/<?=$item['id'];?><?=$url_parameter;?>'"><?=$item['title'];?> </td>
  <td  >
  <?
	echo $item['remark'];
  ?>
  </td>
  <?php if(permission('c_document', 'candelete')): ?>
  <td>
  	<a href="c_document/delete/<?php echo $item['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
	<input type="button" class="btn_delete" >
	</a>  	  	  
  </td>
  <?php endif;?>
  </tr>
<tr>
<?php
	$i++;
 endforeach;?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>