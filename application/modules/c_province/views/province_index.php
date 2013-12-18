<script type="text/javascript">
	$('select[name=zonetype]').live('change',function(){
		var zone_type_id = ($(this).val());	
		
		if(zone_type_id != 0){
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvprovincezone");
			$.post('c_province/select_zone',{
				'zone_type_id' : zone_type_id,
			},function(data){
				$("#dvprovincezone").html(data);												
			})
		}
		else
		{
			$('select[name=zone]').attr("disabled","disabled");
		}
		
	});		
</script>
<h3>ตั้งค่า จังหวัด</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" >
<div id="search">
<div id="searchBox">
ชื่อจังหวัด
  <input name="txtsearch" type="text" size="40" value="<? if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <select name="zonetype" id="zonetype">
  	<option value="0">กรุณาเลือกประเภทภาค</option>
  	<?    
    $sresult = $this->province_zone_type->get(FALSE,TRUE);
	foreach($sresult as $srow):
	?>
      <option value="<?=$srow['id'];?>" <? if(@$_GET['zonetype']==$srow['id'])echo "selected";?>><?=$srow['title'];?></option>
   <? endforeach; ?>
  </select>
  <div id="dvprovincezone" style="display:inline;">
  <select name="zone" id="zone">
    <option value="">กรุณาเลือกภาค</option>  
    <?
    if(@$_GET['zonetype']!=''){
    $sresult = $this->province_zone->where("zone_type_id=".@$_GET['zonetype'])->get(FALSE,TRUE);
	foreach($sresult as $srow):
	?>
      <option value="<?=$srow['id'];?>" <? if(@$_GET['zone']==$srow['id'])echo "selected";?>><?=$srow['title'];?></option>
   <? endforeach;} ?>
    </select>
  </div>

<select name="area" id="area">
    <option selected="selected" value="0">กรุณาเลือกเขตจังหวัด</option>
    <? 
  	$getprovincearea = isset($_GET['area'])? $_GET['area'] : '';
  	$sresult = $this->province_area->get(FALSE,TRUE);
	foreach($sresult as $srow):
	?>
    <option value="<?=$srow['id'];?>" <? if($getprovincearea==$srow['id'])echo  "selected";?>><?=$srow['title'];?></option>
    <? endforeach; ?>
  </select>
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>

<? if(permission('c_province','canadd')){?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='c_province/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? } ?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อจังหวัด</th>
  <th align="left">เขตจังหวัด</th>
  <th align="left">ภาค</th>
  <?php if(permission('c_province', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):	  
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='c_province/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['title'];?> </td>
  <td onclick="window.location='c_province/form/<?=$row['id'];?><?=$url_parameter;?>'">
  <?
  		$provincearea = $this->province_area->get_row($row['area']);   		
		echo $provincearea['title'];
  ?> 
  </td>        
   
  <td onclick="window.location='c_province/form/<?=$row['id'];?><?=$url_parameter;?>'">
  <? 
			   foreach($zonetype as $item):				   				  
				  	$sresult = $this->province_zone->where("zone_type_id=".$item['id'])->get(FALSE,TRUE);
				   echo $item['title']." : ";					
					foreach($sresult as $srow):		
						$zonerow = $this->province_detail_zone->where("zoneid=".$srow['id']." AND provinceid=".$row['id'])->get_row();
						echo $select = @$zonerow['id'] < 1 ? "" : $srow['title'];						
				    endforeach; 
						echo "<br/>";
			   endforeach;
  ?>
  </td>
  <?php if(permission('c_province', 'candelete')): ?>
  <td>
  		<a href="c_province/delete/<?php echo $row['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">
  		<input type="button" class="btn_delete" />  		
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