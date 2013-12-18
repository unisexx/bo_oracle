<script type="text/javascript">
	$(document).ready(function(){
		$('select[name=budget_type]').live('change',function(){
			var budget_type_id = ($(this).val());			
			if(budget_type_id != 0){
				
				$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dv_expense_type");
				$.post('ajax/load_expense_type',{
					'budget_type_id' : budget_type_id,
					'control_name' : 'expense_type'
				},function(data){
					$("#dv_expense_type").html(data);												
				})
			}
			else
			{
				$('select[name=budget_type]').attr("disabled","disabled");
			}
		
		});	
	})
</script>
<h3>หักเงินตามนโยบายพิเศษ %</h3>
<form>
<div id="search">
  <div id="searchBox">
    <select name="select" id="select">
      <option value="">-- ทุกปีงบประมาณ --</option>
      <?=$option;?>
    </select>
    <? echo form_dropdown("budget_type",get_option("id","title","fn_budget_type","pid < 1 "),@$_GET['budget_type'],"","-- ทุกหมวดงบประมาณ --","");?>
    <div id="dv_expense_type" style="display: inline">
    	<? echo form_dropdown("expense_type",get_option("id","title","fn_budget_type","pid > 0 and expensetypeid < 1 "),@$_GET['expense_type'],"disable","-- ทุกหมวดค่าใช้จ่าย --","");?>	
    </div>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<? if(!permission('fn_percent','canadd')){?>
<div id="btnBox">  
  <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_percent/form<?=$url_parameter;?>'" class="btn_add"/> 
</div><br><br>
<? } ?>

<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ปีงบประมาณ</th>
  <th align="left">หน่วยงาน</th>
  <th align="left">หมวดงบประมาณ </th>
  <th align="left">หมวดค่าใช้จ่าย </th>
  <th align="left">หักจำนวน (%)</th>
  <th align="left">ลบ</th>
  </tr>
<?
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1; 
foreach($result as $item): 
?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd cursor"';else $rowStyle = 'class="cursor"';echo $rowStyle;?> onclick="window.location='finance_percent/form/<?=$item['id'];?><?=$url_parameter;?>';">
  <td><?=$i;?></td>
  <td nowrap="nowrap">
  	<?=$item['budget_year']+543;?>
  </td>
  <td>
  	<?=$item['division_name'];?>
  	&nbsp;
  </td>
  <td>
  	<?=$item['budget_type_title'];?>
  	&nbsp;
  </td>
  <td>
  	<?=$item['expense_type_title'];?>
  	&nbsp;
  </td>
  <td>
  	<?=number_format($item['percent_value'],2);?>&nbsp;
  </td>
  <td>
  	<a href="fn_percent/delete/<?php echo $item['id']?><?=$url_parameter;?>" style="text-decoration:none;" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">
  		<input type="button" class="btn_delete" />  		
  	</a>  
  </td>
</tr>
<? $i++;endforeach; ?>
</table>
<div id="paging" class="frame_page">
<?php echo $pagination;?>
</div>