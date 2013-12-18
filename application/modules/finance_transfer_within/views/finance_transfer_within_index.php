<script type="text/javascript">
$(document).ready(function(){	
		$('select[name=pdivision_id],select[name=pworkgroup_id]').attr('disabled','disabled');
		$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#dvpdivision_id").html(data);
				$("#divisionid").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');										
			})
		}
		
	});
	$('select[name=pdivision_id]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){
			$("select[name=pworkgroup_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpworkgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#dvpworkgroup_id").html(data);
				$("#workgroupid").attr("id","pworkgroup_id");				
				$("#pworkgroup_id").attr('name', 'pworkgroup_id');	
			})
		}
		
	});
});
</script>	
<h3>โอนภายในสำนัก </h3>
<div class="link_budget_related">ค้นหาข้อมูล 
<?php finance_budget_menu(9);?>
</div>
<form enctype="multipart/form-data" method="get" action="finance_transfer_within/index/">
<div id="search">
  <div id="searchBox">เลขที่หนังสือ พม.
<input type="text" name="documentno" id="documentno" />
      ช่วงวันที่
<input name="datestart" type="text" id="datestart" size="10" class="datepicker" />
<input name="dateend" type="text" id="dateend" size="10" class="datepicker" />
<br />
<?php echo form_dropdown('bg_year',get_option('fnyear','fnyear as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
<?php echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- เลือกกรม --')?>
<div id="dvpdivision_id" style="display:inline;">  
<?php echo form_dropdown('pdivision_id',get_option('id','title','cnf_division'),@$_GET['pdivision_id'],'','-- เลือกหน่วยงาน --')?>
</div>
  <div id="dvpworkgroup_id" style="display:inline;">
  <?php echo form_dropdown('pworkgroup_id',get_option('id','title','cnf_workgroup'),@$_GET['pworkgroup_id'],'','-- เลือกกลุ่มงาน --')?>
  </div>  
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php if(permission('finance_budget_related', 'canadd')):?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_transfer_within/form<?=$url_parameter;?>'" class="btn_add"/> 
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
  <th align="left">จำนวนเงินโอน</th>
  <th align="left">จัดการ</th>
</tr>
  <?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $row):
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td onclick="window.location='finance_transfer_within/form/<?=$row['id'];?>'" class="cursor"> <?=$row['transfer_no'];?></td>
  <td><? if($row['transfer_date']>0)echo stamp_to_th($row['transfer_date']);?></td>
  <td>
  <?   
  echo number_format($row['summary'],2);
  ?></td>
  <td>
  	<input type="button" name="button" id="button" value="x" class="btn_delete" onclick="confirmDelete('c_department/delete/<?=$row['id'];?>/<?=$page;?>','<?php echo NOTICE_CONFIRM_DELETE?>');">  	
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
