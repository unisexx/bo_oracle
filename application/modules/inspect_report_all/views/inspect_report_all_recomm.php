<script type="text/javascript">
	$(document).ready(function(){
		$(".tblist:first tr:not(:first)").find("td:first").css("background-color","#FFF3FC");
		$(".tblist th").css("background-color","#FFF3FC");
		
		var sumSuggestion = 0;
		$('.suggestion').each(function (j) {
			sumSuggestion += Number($(this).text().replace(/,/g,""));
		});
		$("#sum-suggestion").text(sumSuggestion);
		
		var sumOperationresult = 0;
		$('.operationresult').each(function (j) {
			sumOperationresult += Number($(this).text().replace(/,/g,""));
		});
		$("#sum-operationresult").text(sumOperationresult);
		
		var sumPercent = 0;
		sumPercent = (sumOperationresult/sumSuggestion)*100;
		$("#sum-percent").text(sumPercent.toFixed(2));
		
		var percent = 0;
		var suggestion = 0;
		var operationresult = 0;
		$('.percent').each(function(){
			suggestion = $(this).siblings(".suggestion").text();
			operationresult = $(this).siblings(".operationresult").text();
			percent = (operationresult/suggestion)*100;
			$(this).text(percent.toFixed(2));
		});
		
		var avgSuggestion = 0;
		avgSuggestion = (sumSuggestion/77);
		$("#avg-suggestion").text(new NumberFormat(avgSuggestion).toFormatted());
		
		var avgOperationresult = 0;
		avgOperationresult = (sumOperationresult/77);
		$("#avg-operationresult").text(new NumberFormat(avgOperationresult).toFormatted());
	});
	
   $(document).ready(function(){
		$(".a_export").click(function(){
			var budgetyear = $("select[name=budgetyear]").val();
			var divisionid = $("select[name=divisionid]").val();
 window.location.href ='inspect_report_all/recomm?action=export&budgetyear='+budgetyear+'&divisionid='+divisionid;
		})
	});
</script>
<h3>รายงานข้อเสนอแนะผู้ตรวจ</h3>
<div id="search">
<div id="searchBox">
<form method="get" action="inspect_report_all/recomm">
<?php echo form_dropdown('budgetyear',get_option("mt_year","mt_year+543 as year","insp_round"),@$_GET['budgetyear'],'','-- เลือกปีงบประมาณ --','0')?> 
<?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid = 4 or id = 105"),@$_GET['divisionid'],'','-- เลือกหน่วยงาน --','0');?>
 <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>
<div style="text-align:right;" id="tool-info">
<a class="a_export"><img src="media/images/download.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="ดาวน์โหลด"></a>
</div>
</div>
<style>
.tblist td{padding:0 10px;}
</style>
<?php if(!empty($_GET['budgetyear'])):?>
<table class="tblist">
	<tr>
		<th>จังหวัด</th>
		<th>ข้อเสนอแนะ</th>
		<th>ตอบกลับ</th>
		<th>คิดเป็นร้อยละ</th>
	</tr>
	<?php foreach($province as $key=>$row):?>
		<tr>
			<td><?=$row['title']?></td>
			<?php 
				$sql = "SELECT budgetyear,divisionid,provinceid,provincearea_id,
(select title from cnf_division where id = insp1.divisionid)division_title,
(select title from cnf_province_area where id = insp1.provincearea_id)provincearea_title,
(select title from cnf_province where id = insp1.provinceid)province_title,
(select count(*) from INSP_INSPECTOR_RECOMM 
  WHERE budgetyear=insp1.budgetyear and divisionid=insp1.divisionid and provinceid=insp1.provinceid and provincearea_id=insp1.provincearea_id)nsuggestion
,(select count(*) from INSP_INSPECTOR_RECOMM  
  WHERE VARCHAR(OPERATIONRESULT) <> '' and budgetyear=insp1.budgetyear
 and divisionid=insp1.divisionid and provinceid=insp1.provinceid
 and provincearea_id=insp1.provincearea_id
) noperationresult
FROM INSP_INSPECTOR_RECOMM as insp1
where budgetyear = ".$_GET['budgetyear']." and divisionid = ".$_GET['divisionid']." and provinceid = ".$row['id']."
group by budgetyear,divisionid,provinceid,provincearea_id";
				$result = $this->recomm->get($sql,true);
			?>
			<?php if(empty($result)):?>
					<td>-</td>
					<td>-</td>
					<td>-</td>
			<?php else:?>
				<?php foreach($result as $item):?>
					<td class="suggestion"><?=$item['nsuggestion']?></td>
					<td class="operationresult"><?=$item['noperationresult']?></td>
					<td class="percent"></td>
				<?php endforeach;?>
			<?php endif;?>
		</tr>
	<?php endforeach;?>
	<tr>
		<th>ผลรวม (Summation)</th>
		<th id="sum-suggestion"></th>
		<th id="sum-operationresult"></th>
		<th id="sum-percent"></th>
	</tr>
	<tr>
		<th>ค่าเฉลี่ย (Average)</th>
		<th id="avg-suggestion"></th>
		<th id="avg-operationresult"></th>
		<th></th>
	</tr>
</table>
<?php endif;?>