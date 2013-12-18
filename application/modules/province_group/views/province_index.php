<h3>ตั้งค่า จังหวัด</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_province/index">
<div id="search">
<div id="searchBox">
ชื่อจังหวัด
  <input name="txtsearch" type="text" size="40" value="<? if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <select name="zone" id="zone">
    <option value="">กรุณาเลือกภาค</option>  
    <?
    $getzone = isset($_GET['zone'])? $_GET['zone'] : '';	
    $sresult = $this->province_zone->get();
	foreach($sresult as $srow):
	?>
      <option value="<?=$srow['code'];?>" <? if($getzone==$srow['code'])echo "selected";?>><?=$srow['title'];?></option>
   <? endforeach; ?>
    </select>
  	<select name="group" id="group">
    <option value="0">กรุณาเลือกกลุ่มภาค</option>
  	<? 
  	$getprovincegroup = isset($_GET['group'])? $_GET['group'] : '';
  	$sresult = $this->province_group->get();
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($getprovincegroup==$srow['id'])echo "selected";?>><?=$srow['description'];?></option>
    <? endforeach; ?>
	</select>
<select name="area" id="area">
    <option selected="selected" value="0">กรุณาเลือกเขตจังหวัด</option>
    <? 
  	$getprovincearea = isset($_GET['area'])? $_GET['area'] : '';
  	$sresult = $this->province_area->get();
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($getprovincearea==$srow['id'])echo  "selected";?>><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_province/form'" class="btn_add"/>
</div>
<div id="paging" class="pagination">
<?=$pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อจังหวัด</th>
  <th align="left">เขตจังหวัด</th>
  <th align="left">กลุ่มภาค</th>
  <th align="left">ภาค</th>
  <th align="left">ลบ</th>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
  foreach($result as $row):	  
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_province/form/<?=$row['id'];?>'"><?=$row['title'];?> </td>
  <td onclick="window.location='c_province/form/<?=$row['id'];?>'">
  <?
  		$provincearea = $this->province_area->get_row($row['area']);   		
		echo $provincearea['title'];
  ?> 
  </td>        
  <td onclick="window.location='c_province/form/<?=$row['id'];?>'">
  <?   		
   		$provincegroup = $this->province_group->get_row($row['pgroup']);
		echo $provincegroup['description'];
  ?> 
  </td>    
  <td onclick="window.location='c_province/form/<?=$row['id'];?>'">
  <?   		
		$provincezone = $this->province_zone->get_row("CODE",$row['zone']);
		echo $provincezone['title'];
  ?> 
  </td>  
  <td>
  	<input type="button" name="button" id="button" value="x" class="btn_delete" onclick="confirmDelete('c_province/delete/<?=$row['id'];?>/<?=$page;?>','<?php echo NOTICE_CONFIRM_DELETE?>');">  	
  </td>
  </tr>
<tr>
<? 	
  $i++;
  endforeach;
?>
</table>
<div id="paging" class="pagination">
<?=$pagination;?>
</div>