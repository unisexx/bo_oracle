<h3>รับเงินกันเหลือมปี </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
  <?php finance_budget_menu(6);?>	
</div>
<form enctype="multipart/form-data" method="get" action="finance_receive_year_overlap/index/">
<div id="search">
  <div id="searchBox">
  	เลขที่สำรองเงินกัน <input type="text" id="documentno" name="documentno" value="<?=@$_GET['documentno'];?>" >
      ช่วงวันที่
<input name="datestart" type="text" id="datestart" size="10" class="datepicker" value="<?=@$_GET['datestart'];?>" />
<input name="dateend" type="text" id="dateend" size="10" class="datepicker" value="<?=@$_GET['dateend'];?>" />
<?php echo form_dropdown('bg_year',get_option('fnyear','fnyear as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- เลือกกรม --')?>  
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_receive_year_overlap/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่สำรองเงินกัน</th>
  <th align="left">รายการ</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่กันเหลื่อมปี</th>
  <th align="left">เงินกันเหลื่อมปี</th>
  <th align="left">จัดการ</th>
  </tr>
<?php
  $rowStyle = ""; 
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item): 
  ?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd cursor"';else $rowStyle = "";echo $rowStyle;?> >
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'"><?=$i;?></td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'" nowrap="nowrap"><?=$item['reserve_no'];?></td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'">
  	<?php echo $item['subject']; ?>  	
  </td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'">
	<?php echo $item['book_no'];?>  	
  </td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'">
  	<?php echo $item['cost_no'];?>
  </td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'">
  	  <?php echo stamp_to_th($item['receive_date']);?>
  	&nbsp;
  </td>
  <td onclick="window.location='finance_receive_year_overlap/form/<?php echo $item['id'];?><?=$url_parameter;?>'">
  	  <?php echo number_format(GetFNReceiveOverLapSummary($item['id']),2);?>
  </td>
  <td>  	
	<a href="finance_receive_year_overlap/delete/<?php echo $item['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>
</td>	    
  </tr>
  <?php
  $i++; 
  endforeach; 
  ?>  
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>