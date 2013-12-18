<script type="text/javascript">
$(document).ready(function(){
	$("input").setMask();
	$(".number").keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });

})
function check_limit(pBudgetTypeID){
	var current_val = Number($("#withdraw_"+pBudgetTypeID).val().replace(/[^0-9\.]+/g,""));
	var tmp_val = Number($("#tmp_withdraw_"+pBudgetTypeID).val().replace(/[^0-9\.]+/g,""));
	var limit  = Number($("#limit_"+pBudgetTypeID).val().replace(/[^0-9\.]+/g,""));
	if(current_val <= limit)
	{
		$("#tmp_withdraw_"+pBudgetTypeID).val(new NumberFormat(current_val).toFormatted());
	}
	else
	{
		$("#withdraw_"+pBudgetTypeID).val(new NumberFormat(tmp_val).toFormatted());
	}
	
}
</script>
<form method="post" enctype="multipart/form-data" action="monitor_operation_withdraw/save?<?=$url;?>">
<h3>บันทึก ผลการดำเนินงานและเบิกจ่าย  <? if($provinceid==2)echo "[ส่วนกลาง]";else echo "[จังหวัด]";?> (บันทึก / แก้ไข)</h3>
<h5>รายละเอียดผลการดำเนินงานและเบิกจ่าย   <? if($provinceid==2)echo "[ส่วนกลาง]";else echo "[จังหวัด]";?> </h5>
<table class="tbadd">
<tr>
  <th>จังหวัด</th>
  <td><?=$province['title'];?></td>
</tr>
<tr>
  <th>ปีงบประมาณ/เดือน/ไตรมาส</th>
  <td>
  	<?
  	$month = @$_GET['month'];	
	if($month >= 10)
	{
		$quarter = 1;
	}else if($month>=1 && $month <=3){
		$quarter =2 ;		
	}else if($month>=4 && $month <=6){
		$quarter = 3;
	}else if($month>=7 && $month <=9){
		$quarter=4;
	}	
  	//$quarter = $month >= 10 && $month <=12 ? 1 : $month >=1 && $month <=3 ? 2 : $month >=4 && $month <= 6 ? 3 : $month  >= 7 && $month <=9 ? 4 : 0; 
  	echo ($subactivity['mtyear']+543).'/'.@$_GET['month'].'/'.$quarter;
  	?>  </td>
</tr>
<tr>
  <th>ยุทธศาสตร์กระทรวง/กรม</th>
  <td><? $ministryStrategy = GetStrategyDetail($subactivity['ministrystrategyid']);echo @$ministryStrategy['title'];?></td>
</tr>
<tr>
  <th>เป้าประสงค์ 4 ปี</th>
  <td><? $ministryTargetYear = GetStrategyDetail($subactivity['ministrytargetyear']);echo @$ministryTargetYear['title'];?></td>
</tr>
<tr>
  <th>ตัวชี้วัด</th>
  <td>
  	<? $strategyKey = GetStrategyKey($subactivity['productivityid']);
	foreach($strategyKey as $item):
  	echo $item['title'].'<br />';    
	endforeach;
    ?></td>
</tr>
<tr>
  <th>ผลผลิต </th>
  <td><? $productivity = GetStrategyDetail($subactivity['productivityid']);echo $productivity['title'];?></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td><? echo $mainProject['title'];?></td>
</tr>
<? if(@$subProject!=''){?>
<tr>
  <th>โครงการย่อย</th>
  <td><? echo $subProject['title'];?>&nbsp;</td>
</tr>
<? } ?>
<tr>
  <th>เป้าหมาย</th>
  <td><?=$project_record['target_value'];?> <?=$project['targettitle'];?></td>
</tr>
<tr>
  <th>แผนงบประมาณ</th>
  <td class="line">
  	<? foreach($projectDetail as $item):  	
  	 echo '<div><span>'.$item['budgettypetitle'].'</span>'.number_format($item['sbudget'],2).' บาท</div>';
	 endforeach;
  	?></td>
</tr>
<tr>
  <th><label for="fid-news_id">ผลการดำเนินงาน</label>
    <span class="Txt_red_12">(เป้าหมาย)*</span></th>
  <td><input name="targetresult" type="text" size="5" value="<?=@number_format($wdproject['targetresult']);?>" style="text-align: right;" />
    <?=$project['targettitle'];?></td>
</tr>
<tr>
  <th>เบิกจ่าย
     <span class="Txt_red_12">*</span></th>
  <td class="line">
  	<? foreach($projectDetail as $item): ?>
  	<div><span><?=$item['budgettypetitle'];?></span><input type="hidden" name="budgettypeid[]" value="<?=$item['sbudgettypeid'];?>">
  	<input name="withdraw[]" id="withdraw_<?=$item['sbudgettypeid'];?>" type="text" value="<?=@$wddetail[$item['sbudgettypeid']];?>" class="taRight" alt="decimal" onkeyup="check_limit('<?=$item['sbudgettypeid'];?>');"/>
  	<input name="tmp_withdraw[]" id="tmp_withdraw_<?=$item['sbudgettypeid'];?>" type="hidden" value="<?=@number_format($wddetail[$item['sbudgettypeid']],2);?>"> 
  	คงเหลือ  <? 
  	$limit = CalculateBudgetNet(@$_GET['mtyear'],$item['sbudgettypeid'],$item['masterid'],@$wdproject['id'],@$province['id']);
	$limit = $limit + @$wddetail[$item['sbudgettypeid']];
  	echo number_format($limit);?> บาท
  	<input type="hidden" name="limit_<?=$item['sbudgettypeid'];?>" id="limit_<?=$item['sbudgettypeid'];?>" value="<?=number_format(($limit),2);?>">  	
  	</div>
    <? endforeach;?>    
	<?  if($productivity['title']=="ส่งเสริมประสานและดำเนินการช่วยเหลือผู้ประสบปัญหาทางสังคม") {?>
    <div>จำนวนคนที่ได้รับการช่วยเหลือจากเงินอุดหนุน 
    <input type="text" id="supportvalue" name="supportvalue"  value="<?=@number_format($wdproject['supportvalue']);?>" class="taRight number" alt="" style="text-align: right;" /> 
    <?php echo form_dropdown('supportunit',get_option('id','title','cnf_count_unit'),@$wdproject['supportunit'],'','-- เลือกหน่วยนับ --',"0");?>
           จะแสดงเฉพาะกิจกรรม ส่งเสริมประสานและดำเนินการช่วยเหลือผู้ประสบปัญหาทางสังคม </div>
    </div>
	<? } ?>    </td>
</tr>
<tr>
  <th>ผู้รายงาน</th>
  <td class="line">
  	<input type="text" name="reporter" value="<?=@$wdproject['reporter'];?>" size="40"/>  </td>
</tr>
<tr>
  <th>เบอร์โทรศัพท์ติดต่อ</th>
  <td class="line"><input type="text" name="contactno" value="<?=@$wdproject['contactno'];?>" size="40"/></td>
</tr>
<tr>
  <th>ปัญหาอุปสรรคและข้อเสนอแนะ</th>
  <td class="line"><textarea name="suggestion" cols="70" rows="4"><?=@$wdproject['suggestion'];?></textarea></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>