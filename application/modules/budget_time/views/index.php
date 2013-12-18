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
	  		$.post('budget_time/update_status',{
	  			'id':asset_id,
	  			'used':status
	  		},function(data){
	  			
	  		})
	  })
    });
    
</script>
<h3>ตั้งค่า ตั้งเวลา</h3>
<div id="btnBox">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='budget_time/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
<th width="10%" rowspan="2" align="left" >ลำดับ</th>
<th width="28%" rowspan="2" align="left" >ปีงบประมาณ</th>
<th width="28%" rowspan="2" align="left" >สถานะ</th>
<th colspan="8" align="center">วันกำหนดส่ง (ครั้งที่)</th>
<th width="14%" align="left" >&nbsp;</th>
</tr>
<tr>
  <th align="center">1</th>
  <th align="center">2</th>
  <th align="center">3</th>
  <th align="center">4</th>
  <th  align="center">5</th>
  <th  align="center">6</th>
  <th  align="center">7</th>
  <th  align="center">8</th>
  <th align="left" >&nbsp;</th>
</tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td ><a href="budget_time/form/<?=$row['id'];?><?=$url_parameter;?>"><?=$row['byear'];?></a></td>
  <td>
	  <input type="checkbox" name="chkStatus" id="chkStatus" <? if($row['status']!='')echo "checked";?> value="1" />
  </td> 
		<? for($t=1;$t<=8;$t++){ ?><td  nowrap="nowrap"><?=mysql_to_date($row['bdate_'.$t],TRUE);?> </td><? }?>  
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