<script type="text/javascript">
    $(document).ready(function() {
      $(':checkbox').iphoneStyle(
	  {
		    checkedLabel: 'เปิด',
		    uncheckedLabel: 'ปิด'
	  }
	  );
	  
	  $(".iPhoneCheckContainer").click(function(){
	  		var status = $(this).find('input:checked').length;
	  		var asset_id = $(this).closest('tr').find('.asset_id').val();	  		 
	  		$.post('budget_asset/update_status',{
	  			'id':asset_id,
	  			'used':status
	  		},function(data){
	  			
	  		})
	  })
    });
    
  </script>
<h3>ตั้งค่า รายการสินทรัพย์</h3>
<div id="search">
<div id="searchBox">ชื่อสินทรัพย์
<form name="frmSearch" method="get" enctype="multipart/form-data" action="">
  <input name="txtsearch" type="text" size="40" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
  </form>
</div>
</div>


<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='budget_asset/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  	<th  align="left">ลำดับ</th>
	<th  align="left">ชื่อรายการ</th>
	<th  align="left">หน่วยนับ</th>
	<th  align="left">ราคา</th>
	<th  align="left">ประเภท</th>
	<th  align="left">ใช้งาน</th>
	<th>&nbsp;</th>
  </tr> 
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='budget_asset/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['assetname'];?> </td>  
  <td onclick="window.location='budget_asset/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['unit_title'];?>&nbsp;</td>
  <td onclick="window.location='budget_asset/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=number_format($row['price']);?>&nbsp;</td>
  <td onclick="window.location='budget_asset/form/<?=$row['id'];?><?=$url_parameter;?>'"><?=$row['asset_type_title'];?>&nbsp;</td>
  <!--  <td>?=ConvertDateFromDB($row['STARTDATE']);?>&nbsp;</td>
  <td>?=ConvertDateFromDB($row['ENDDATE']);?>&nbsp;</td>-->
  <td>
  	<input type="hidden" id="asset_id" name="asset_id" class="asset_id" value="<?=$row['id'];?>">
  	<input type="checkbox" id="chkused" name="chkused" class="chk_used" value="1" <? if($row['used']>0)echo "checked";?>  />
  </td>  
  <td>
  	<a href="budget_asset/delete/<?php echo $row['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
	<input type="button" class="btn_delete" >
	</a>    	  	
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