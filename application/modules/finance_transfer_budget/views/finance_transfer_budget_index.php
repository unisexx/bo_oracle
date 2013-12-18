<h3>โอนจัดสรรงบประมาณให้ พมจ.</h3>
<div class="link_budget_related">ค้นหาข้อมูล 
<?php finance_budget_menu(8);?>	
</div>
<div id="search">
<form enctype="multipart/form-data" method="get" action="finance_withdraw_replace/index/">
  <div id="searchBox">เลขที่หนังสือ พม.
 <input type="text" name="bookingno" id="bookingno" value="<? echo @$_GET['bookingno'];?>" />
    ช่วงวันที่
      <input name="datestart" type="text" id="datestart" size="10" class="datepicker" value="<?php echo @$_GET['datestart'];?>" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="dateend" type="text" id="dateend" size="10" class="datepicker" value="<?php echo @$_GET['dateend'];?>" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<?php echo form_dropdown('bg_year',get_option('fnyear','fnyear as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- เลือกกรม --')?>
<div id="dvpdivision_id" style="display:inline;">  
<?php echo form_dropdown('pdivision_id',get_option('id','title','cnf_division'),@$_GET['pdivision_id'],'','-- เลือกหน่วยงาน --')?>
</div>
  <div id="dvpworkgroup_id" style="display:inline;">
  <?php echo form_dropdown('pworkgroup_id',get_option('id','title','cnf_workgroup'),@$_GET['pworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
  </div>  
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</form>  
</div>

<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_transfer_budget/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่หนังสือขอโอนจัดสรร</th>
  <th align="left">วันที่โอนจัดสรร</th>
  <th align="left">จำนวนเงินโอน </th>
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
  <td onclick="window.location='finance_transfer_budget/form/<?=$row['id'];?>'" class="cursor"> <?=$row['transfer_no'];?></td>
  <td><? if($row['transfer_date']>0)echo stamp_to_th($row['transfer_date']);?></td>
  <td><?=number_format($row['summary'],2);?></td>
  <td>
  	<a href="finance_transfer_budget/delete/<?php echo $row['id']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>  	
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