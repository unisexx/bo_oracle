<h3>เงินกันเหลื่อมปี </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
<?php finance_budget_menu(5);?>
</div>
<form>
<div id="search">
  <div id="searchBox">เลขที่สำรองเงินกัน
    <input type="text" name="textfield" id="textfield" />
    ช่วงวันที่กันเงินเหลื่อมปี
    <input class="datepicker" name="datestart" type="text" size="10" value="<?php echo @$_GET['datestart']?>" /> 
    ถึง 
    <input class="datepicker" name="dateend" type="text" size="10" value="<?php echo @$_GET['dateend']?>" /><br />
<br />
<?php echo form_dropdown('budgetyear',get_option("fnyear","fnyear+543 as fn","fn_strategy group by fnyear"),@$rs['budgetyear'],'','-- เลือกปีงบประมาณ --')?>
 	<span id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$rs['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
  	<span id="div_id"><?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid=".@$rs['departmentid']),@$rs['divisionid'],'','-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย) --')  ?></span>
  	<span id="workgroup_id"><?php echo @form_dropdown('workgroupid',get_option("id","title","cnf_workgroup where divisionid=".@$rs['divisionid']),@$rs['workgroupid'],'','-- เลือกกลุ่มงาน  --') ?></span>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_year_overlap/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? endif;?>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">เลขที่หนังสืออนุมัติหลักการ</th>
  <th align="left">เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th align="left">วันที่ผูกพัน</th>
  <th align="left">จำนวนเงินผูกพัน</th>
  <th align="left">กรม / หน่วยงาน / กลุ่มงาน</th>
  <th align="left">จำนวนเงินกันเหลื่อม</th>  
  <th align="left">จัดการ</th>
  </tr>
<? 
$rowclass = '';
$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
foreach($result as $row):
$rowclass = $rowclass == '' ? 'class="odd"' : '';
?>	  
<tr <?=$rowclass;?>>
  <td><?=$i;?></td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';"><?=$row['budget_book_id'];?></td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';"><?=$row['book_cost_id'];?></td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';"><? if($row['book_cost_date']>0)echo stamp_to_th_fulldate($row['book_cost_date']);?></td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';" align="left"><?=number_format(GetCostRelatedNet($row['fn_cost_related_id']),2);?></td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';" align="left">
	<?php  	
  		$pdepartment = $this->department->get_row($row['departmentid']);
		$pdivision = $this->division->get_row($row['divisionid']);
		$pworkgroup = $this->workgroup->get_row($row['workgroupid']);
  	?>
  	<img src="images/department.png" width="28" height="28" class="vtip" title="<?php echo $pdepartment['title'];?>&lt;br&gt;<?php echo $pdivision['title'];?> &lt;br&gt;<?php echo $pworkgroup['title'];?>" />  	
  </td>
  <td onclick="window.location='finance_year_overlap/form/<?=$row['id'];?><?=$url_parameter;?>';" align="left"><?=number_format($row['summary'],2);?></td>
  <td>
  	<input type="button" name="button" id="button" value="x" class="btn_delete" onclick="confirmDelete('finance_year_overlap/delete/<?=$row['id'];?>','<?php echo NOTICE_CONFIRM_DELETE?>');">  	
  </td>
</tr>
<? $i++; endforeach;?>
</table>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>