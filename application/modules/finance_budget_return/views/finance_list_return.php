<script type="text/javascript">
$(document).ready(function(){
	$("select[name=fnyear]").attr("class","mustChoose");
	$('select[name=department_id]').live('change',function(){
			var department_id = ($(this).val());				
			if(department_id != 0){
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#division_id");
				$.post('finance_money_during_year/select_department_find_division',{
					'department_id' : department_id,
				},function(data){
					$("#division_id").html(data);
				})
			}else{
				$('select[name=division_id] option:first,select[name=workgroup_id] option:first').attr('selected','selected');
				$('select[name=division_id],select[name=workgroup_id]').attr('disabled','disabled');
			}
		});
		
		$('select[name=division_id]').live('change',function(){
			var division_id = ($(this).val());	
			
			if(division_id != 0){
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#workgroup_id");
				$.post('finance_money_during_year/select_division_find_workgroup',{
					'division_id' : division_id,
				},function(data){
					$("#workgroup_id").html(data);
				})
			}else{
				$('select[name=workgroup_id] option:first').attr('selected','selected');
				$('select[name=workgroup_id]').attr('disabled','disabled');
			}
		});
})
</script>
<h3>คืนงบประมาณ</h3>
<form action="finance_budget_return/list_return" method="get"> 
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติหลักการ / เลขที่หนังสืออนุมัติค่าใช้จ่าย
    <input type="text" name="book_no" id="book_no" value="<?=@$_GET['book_no'];?>" />
	ช่วงเวลา
<input name="startdate" type="text" id="startdate" size="10" class="datepicker" value="<?=@$_GET['startdate'];?>" />
ถึง
<input name="enddate" type="text" id="enddate" size="10" class="datepicker" value="<?=@$_GET['enddate'];?>" />
<br />
<select name="related_type" id="related_typed" class="mustChoose">
      <option>-- เลือกประเภทเงินผูกพันธ์ --</option>
      <option value="budget" <? if(@$_GET['related_type']=='budget')echo "selected";?>>เงินผูกพันธ์หลักการ</option>
      <option value="cost" <? if(@$_GET['related_type']=='cost')echo "selected";?>>เงินผูกพันธ์ค่าใช้จ่าย</option>
</select>
	<?php echo form_dropdown('fnyear',get_option('fnyear','(fnyear+543) as years','fn_strategy'),@$_GET['fnyear'],'','-- เลือกปีงบประมาณ --');?>
	<span id="department_id">
 	<?php echo form_dropdown('department_id',get_option('id','title','cnf_department'," financeuse='on' "),@$_GET['department_id'],'-- เลือกกรม --')?>
 	</span>
 	<? $condition = @$_GET['departmentid'] != '' ? " departmentid=".$_GET['departmentid'] : ""; ?>
 	<span id="division_id">
  	<?php echo @form_dropdown('division_id',get_option('id','title','cnf_division ',$condiion),@$_GET['division_id'],'','-- เลือกหน่วยงาน --')?>
    </span>
  	<? $condition = @$_GET['division_id'] != '' ? " divisionid=".$_GET['division_id'] : ""; ?>
  	<span id="workgroup_id">
	<?php echo @form_dropdown('workgroup_id',get_option('id','title','cnf_workgroup ',$condition),@$_GET['workgroup_id'],'','-- เลือกกลุ่มงาน --')?>
	</span>
	
	
	
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<? if(@$_GET['fnyear']!='' && @$_GET['related_type']!=''){?>
<div id="paging" class="frame_page">
<?=$pagination;?>        
</div>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>เลขที่หนังสืออนุมัติหลักการ</th>
  <th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
  <th>วันที่ทำรายการ</th>
  <th style="text-align:right;">จำนวนเงิน</th>
  <th style="text-align:right;">คืนงบประมาณจำนวน</th>
  <th style="text-align:center;">จัดการ</th>
  </tr>
  <?=$dataList;?>
</table>

<div id="paging" class="frame_page">
<?=$pagination;?>        
</div>
<? } ?>