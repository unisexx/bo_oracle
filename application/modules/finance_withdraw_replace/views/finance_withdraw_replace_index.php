<h3>เงินเบิกแทนกัน</h3>
<div class="link_budget_related">ค้นหาข้อมูล
	 <?php finance_budget_menu(3);?>	
</div>
<div id="search">
<form enctype="multipart/form-data" method="get" action="finance_withdraw_replace/index/">
  <div id="searchBox">เลขที่เอกสารเบิกแทน
 <input type="text" name="withdrawid" id="withdrawid" value="<? echo @$_GET['withdrawid'];?>" />
    ช่วงวันที่เบิกแทน
      <input name="datestart" type="text" id="datestart" size="10" class="datepicker" value="<?php echo @$_GET['datestart'];?>" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="dateend" type="text" id="dateend" size="10" class="datepicker" value="<?php echo @$_GET['dateend'];?>" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<?php echo form_dropdown('bg_year',get_option('fnyear','fnyear as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
<span id="dept_id"><?php echo form_dropdown('pdepartment_id',get_option("id","title","cnf_department"," financeuse = 'on'"),@$_GET['pdepartment_id'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
<div id="dvpdivision_id" style="display:inline;">  
		<? $condition = @$_GET['pdepartment_id']!='' ? " departmentid=".@$_GET['pdepartment_id'] : "";?>
		<?php echo form_dropdown('pdivision_id',get_option("id","title","cnf_division",$condition),@$_GET['pdivision_id'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?>		
</div>
  <div id="dvpworkgroup_id" style="display:inline;">
  <? $condition = @$_GET['pdivision_id']!='' ? " divisionid=".@$_GET['pdivision_id'] : "";?>
  <?php echo form_dropdown('pworkgroup_id',get_option("id","title","cnf_workgroup",$condition),@$_GET['pworkgroup_id'],'','-- เลือกกลุ่มงาน  --')  ?></span>
  </div>  
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</form>  
</div>



<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_withdraw_replace/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่เอกสารเบิกแทน</th>
  <th align="left">เลขที่หนังสือแจ้งโอน</th>
  <th align="left">วันที่ผูกพันงบประมาณ </th>
  <th align="left">จำนวนเงิน</th>
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
  <td onclick="window.location='finance_withdraw_replace/form/<?=$row['id'];?>'"> <?=$row['withdrawid'];?></td>
  <td><?=$row['transferid'];?></td>
  <td><? echo ($row['relate_date']>0)? stamp_to_th($row['relate_date']) : "";?></td>
  <td>
  	<?
  		$charge = $this->db->getone("SELECT SUM(BUDGET_COMMIT) FROM FN_WITHDRAW_REPLACE_DETAIL WHERE WITHDRAW_REPLACE_ID=".$row['id']." AND EXPENSETYPE_ID=0 ");
  		echo number_format($charge,2);
  	?>  	
  </td>
  <td>
  	<a href="finance_withdraw_replace/delete/<?php echo $row['id']?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="button" class="btn_delete" /></a>  	
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