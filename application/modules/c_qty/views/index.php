<h3>ตั้งค่า หน่วยนับ</h3>
<div id="search">
<div id="searchBox">ชื่อเอกสาร
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_qty/index">
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <input name="iskeyunit" type="checkbox" value="1" <? if(@$_GET['iskeyunit']!='')echo 'checked="checked"';?>> เป็นหน่วยนับตัวชี้วัด
  <input name="isassetunit" type="checkbox" value="1" <? if(@$_GET['isassetunit']!='')echo 'checked="checked"';?>> เป็นหน่วยนับสินทรัพย์
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>  
  </div>
</div>
<?php if(permission('c_document', 'canadd')): ?>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_qty/form<?=$url_parameter;?>'" class="btn_add"/>
</div>
<?php endif;?>

<div id="paging" class="pagination">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th >ลำดับ</th>
  <th >รายการ</th>
  <th style="text-align:center;">เป็นหน่วยนับตัวชี้วัด</th>
  <th style="text-align:center;">เป็นหน่วยนับสินทรัพย์</th>
  <?php if(permission('c_document', 'canadd')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
  foreach($result as $item):
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_qty/form/<?=$item['id'];?><?=$url_parameter;?>'"><?=$item['title'];?> </td>
  <td onclick="window.location='c_qty/form/<?=$item['id'];?><?=$url_parameter;?>'" align="center">
  <?
	if($item['iskeyunit']!='')echo '<img src="images/check_mark.png">'; else "";
  ?>
  </td>
  <td onclick="window.location='c_qty/form/<?=$item['id'];?><?=$url_parameter;?>'" align="center">
  <?
	if($item['isassetunit']!='')echo '<img src="images/check_mark.png">'; else "";
  ?>
  </td>
  <?php if(permission('c_qty', 'candelete')): ?>
  <td>
  	<a href="c_qty/delete/<?php echo $item['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
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

<div id="paging" class="pagination">
<?php echo $pagination;?>
</div>