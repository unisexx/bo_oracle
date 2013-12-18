<script type="text/javascript">
$(document).ready(function(){
	$("select[name=division]").change(function(){
		var divisionid = $(this).val();
		url = 'c_user/ajax_workgroup_list/0/'+divisionid;						
		$("#workgroup").attr('disabled','disabled'); 
		$("#dvWorkgroup").append("<img src='images/loading.gif' align='absmiddle'>");
		$.get(url,function(data){			
			$("#dvWorkgroup").html(data);
			$("#workgroupid").attr("name","workgroup");
			$("select[name=workgroup]").attr("id","workgroup");
		});		
	})
})				
</script>
<h3>ตั้งค่า สิทธิ์การใช้งาน</h3>
<form enctype="multipart/form-data" method="get" action="c_usergroup/index">
<div id="search">
<div id="searchBox">ชื่อผู้ใช้ 
  <input name="txtsearch" type="text" size="30" value="<?php if(isset($_GET['txtsearch']))echo $_GET['txtsearch'];?>" />
  <?  	
  	echo form_dropdown("division",get_option("id","title","cnf_division order by title asc"),@$_GET['division'],"","-- ทุกหน่วยงาน --");
  ?> 
  <div id="dvWorkgroup" style="display:inline;">
  <?
  	$condition = @$_GET['division'] > 0 ? " divisionid=".$_GET['division'] : " 1=1 "; 
  	echo form_dropdown("workgroup",get_option("id","title","cnf_workgroup",$condition." ORDER BY title asc"),@$_GET['workgroup'],"","-- ทุกกลุ่มงาน --");
  ?>
  </div> 
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

<?php
	// echo "<pre>";
	// print_r($result);
	// echo "</pre>";
?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อผู้ใช้</th>
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
<div style="text-align: right;"><a href="c_usergroup/export<?php echo $url_parameter?>">Export</a></div>
