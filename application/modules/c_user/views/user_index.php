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
<h3>ตั้งค่า ผู้ใช้งาน</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" action="c_user/index">
<div id="search">
<div id="searchBox">
ชื่อ-สกุล / อีเมล์
  <input name="txtsearch" type="text" size="30" value="<?php echo @$_GET['txtsearch'];?>" />     
  <?  	
  	echo form_dropdown("division",get_option("id","title","cnf_division order by title asc"),@$_GET['division'],"","-- ทุกหน่วยงาน --");
  ?> 
  <div id="dvWorkgroup" style="display:inline;">
  <?
  	$condition = @$_GET['division'] > 0 ? " divisionid=".$_GET['division'] : " 1=1 "; 
  	echo form_dropdown("workgroup",get_option("id","title","cnf_workgroup",$condition." ORDER BY title asc"),@$_GET['workgroup'],"","-- ทุกกลุ่มงาน --");
  ?>
  </div>  
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<?php if(permission('c_user', 'canadd')): ?>
<div id="btnBox" style="text-align:right;float:right;">
  <input type="button" title="เพิ่มรายการ" value=" " onclick="window.location='c_user/form<?=$url_parameter;?>'" class="btn_add"/>
</div><br><br>
<?php endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อ - สกุล</th>
  <th align="left">User Name</th>
  <th align="left">หน่วยงาน / กลุ่มงาน</th>
  <th align="left">อีเมล์</th>
  
  <?php if(permission('c_user', 'candelete')): ?><th align="left">ลบ</th><?php endif;?>
  </tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
	  $workgroup = $item['workgroupid'] > 0 ? $this->workgroup->get_one('title','id',$item['workgroupid']) : '';
	  $division = $this->division->get_row($item['divisionid']);   	 
	  $usergroup = $this->usertype_title->get_row($item['usertype']);	 
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>  >
  <td><?=$i;?></td>
  <td onclick="window.location='c_user/form/<?php echo $item['id'];?><?=$url_parameter;?>'"><?=$item['name'];?> </td>
  <td onclick="window.location='c_user/form/<?php echo $item['id'];?><?=$url_parameter;?>'"><?=$item['username'];?> </td>
  <td onclick="window.location='c_user/form/<?php echo $item['id'];?><?=$url_parameter;?>'" align="center" >
	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $division['title'];?> &lt;br&gt; <?php echo @$workgroup;?>" />  
  </td>        
  <td onclick="window.location='c_user/form/<?php echo $item['id'];?><?=$url_parameter;?>'" >
  <?php	echo $item['email'];?> 
  </td>    
  
  <?php if(permission('c_user', 'candelete')): ?>
  <td>
  	<a href="c_user/delete/<?php echo $item['id'];?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">	 
	<input type="button" class="btn_delete" >
	</a>  	
  </td>
  <?php endif;?>
  </tr>
<tr>
<?php
	$i++;
	endforeach; 
?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<div style="text-align: right;"><a href="c_user/export<?php echo $url_parameter?>">Export</a></div>
